<?php
include 'db.incl.php';

   echo '<script>console.log("Your stuff here")</script>';

	// Add task
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$due_date = strtr($_POST['due_date'], '/', '-');
			$due_date = date("Y-m-d", strtotime($due_date));
			$cur_date = date('Y-m-d');

			var_dump($POST['due_date']);

			$sql = "INSERT INTO todos_tbl (todo_task, creation_date, due_date) VALUES ('$task', '$cur_date', '$due_date')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}

	// Delete task
	if (isset($_GET['del_id'])) {
		mysqli_query($db, "DELETE FROM todos_tbl WHERE todo_id=".$_GET['del_id']);
		header('location: index.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="jquery-3.6.0.min.js"></script>
    <script src="jquery-ui.min.js"></script>
</head>
<body>
	<div class="heading">
		<h2 style="font-family: 'Helvetica';">ToDo List Application PHP and MySQL database</h2>
	</div>
	<form method="post" action="index.php" class="input_form">
	<?php if (isset($errors)) { ?>
		<p><?php echo $errors; ?></p>
	<?php } ?>
		<input type="text" name="task" class="task_input" placeholder="Task">
		<input type="date" name="due_date" class="date_input" />
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
			// Display ToDo table on page-load
			$todos = mysqli_query($db, "SELECT * FROM todos_tbl");
			$i = 1; while ($row = mysqli_fetch_array($todos)) { ?>
			<tr>
				<td>
					<!-- <?php echo $row['todo_id']; ?> -->
                    <!-- Displaying non-database ID for cleaner appearance & minor vulnerability mitigation -->
					<?php echo $i; ?>
				</td>
				<td class="task">
                    <div contenteditable="true" spellcheck="false" onblur="updateValue(this,'todo_task','<?php echo $row['todo_id'] ?>')">
						<?php echo $row['todo_task']; ?>
					</div>
				</td>
				<td>
						<select onchange="updateValue(this,'todo_status','<?php echo $row['todo_id'] ?>')">
							<option value="pending" <?php if($row['todo_status'] == 'pending'){ echo 'selected';} ?>>Pending</option>
							<option value="complete" <?php if ($row['todo_status'] == 'complete'){ echo 'selected';} ?>>Complete</option>
						</select>
				</td>
				<td>
                        <?php echo $row['creation_date']; ?>
				</td>
				<td>
					<input class="datepicker-input" value="<?php echo $row['due_date']; ?>" onchange="updateValue(this,'due_date','<?php echo $row['todo_id'] ?>')" />
				</td>
				<td class="delete">
					<a href="index.php?del_id=<?php echo $row['todo_id'] ?>">x</a>
				</td>
			</tr>
			<?php $i++;
            } ?>
        </tbody>
    </table>
</body>
</html>
<script src="functions.js"></script>