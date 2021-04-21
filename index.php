<?php
	// Create error variable
	$errors = "";

	// Define includes
	require_once __DIR__.'\vendor\autoload.php'; // Composer plugins
	require_once("defuse-crypto.phar"); // "php-encryption" plugin

	// Load .env (contains DB creds)
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
	$dotenv->load();

	// Grab .env decryption key
	$keyContents = file_get_contents('C:\keyfile');
	$key = Defuse\Crypto\Key::loadFromAsciiSafeString($keyContents);

	// Decrypt DB creds stored in .env (using decryption key)
	$server = Defuse\Crypto\Crypto::decrypt($_ENV['SERVER'], $key);
	$user = Defuse\Crypto\Crypto::decrypt($_ENV['USER'], $key);
	$pass = Defuse\Crypto\Crypto::decrypt($_ENV['PASS'], $key);
	$database = Defuse\Crypto\Crypto::decrypt($_ENV['DATABASE'], $key);

	// MySQL connection variable
	$db = mysqli_connect($server, $user, $pass, $database);

	// Add ToDo
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO todos_tbl (todo_task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}
	// Delete ToDo
	if (isset($_GET['del_id'])) {
		mysqli_query($db, "DELETE FROM todos_tbl WHERE todo_id=".$_GET['del_id']);
		header('location: index.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Helvetica';">ToDo List Application PHP and MySQL database</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
	<?php } ?>
		<input type="text" name="task" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

    <table>
        <thead>
            <tr>
				<th>ID</th>
				<th style="width: 60px;">Task</th>
				<th>Status</th>
				<th>Creation Date</th>
				<th>Due Date</th>
				<th>&#128465;&#65039;</th>
			</tr>
		</thead>

		<tbody>
			<?php
			// select all tasks if page is visited or refreshed
			$todos = mysqli_query($db, "SELECT * FROM todos_tbl");
			while ($row = mysqli_fetch_array($todos)) { ?>
			<tr>
				<td>
					<?php echo $row['todo_id']; ?>
				</td>
				<td class="task">
                    <?php echo $row['todo_task']; ?>
				</td>
				<td>
                    <?php echo $row['todo_status']; ?>
				</td>
				<td>
                    <?php echo $row['creation_date']; ?>
				</td>
				<td>
                    <?php echo $row['due_date']; ?>
				</td>
				<td class="delete">
					<a href="index.php?del_id=<?php echo $row['todo_id'] ?>">x</a>
				</td>
			</tr>
			<?php } ?>
        </tbody>
    </table>
</body>
</html>