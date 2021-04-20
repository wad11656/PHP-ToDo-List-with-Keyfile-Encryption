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

	// insert a quote if submit button is clicked
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
</body>
</html>