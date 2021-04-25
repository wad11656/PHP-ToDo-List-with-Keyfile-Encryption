<?php
if (session_status() === PHP_SESSION_NONE){session_start();}
if (isset($_POST['filter'])){$_SESSION['filter'] = $_POST['filter'];}
include 'db.incl.php';

	// Add task
	if (isset($_POST['submit'])) {
		if (empty($_POST['task']) || empty($_POST['due_date'])) {
			$errors = "You must fill in the task and due date fields.";
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

	// Set variables for sorting functionality
	$columns = array('todo_id','todo_task','todo_status','creation_date','due_date');
	if (isset($_GET['column']) && in_array($_GET['column'], $columns)){$column = $_GET['column'];} else{$column = $columns[0];}
	if (isset($_GET['order']) && strtolower($_GET['order']) == 'desc'){$sort_order = 'DESC';} else {$sort_order = 'ASC';}

?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css" />
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
		<label for="due_date">Due Date:</label>
		<input type="date" name="due_date" class="date_input" placeholder="Due Date" min="<?php echo date("Y-m-d", time() + -6 * 60 * 60); ?>" />
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>
	            <?php
                // Query table on page-load
				if(isset($_SESSION['filter']) && $_SESSION['filter'] != 'all'){
                    $todos = mysqli_query($db, 'SELECT * FROM todos_tbl WHERE todo_status = \''.$_SESSION['filter'].'\' ORDER BY '.$column.' '.$sort_order);
                } else {
                    $todos = mysqli_query($db, 'SELECT * FROM todos_tbl ORDER BY '.$column.' '.$sort_order);
                }
				if (!$todos) {
                    printf("Error: %s\n", mysqli_error($db));
                    exit();
                }
                
                // Set variables for the sorting arrows
                $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
                if($sort_order == 'ASC'){ $asc_or_desc = 'desc';} else {$asc_or_desc = 'asc';}
                ?>
	<form method="post" action="index.php<?php if($_SERVER['QUERY_STRING'] != ''){echo '?'.$_SERVER['QUERY_STRING'];}?>" class="filter_form">
	<select name="filter" onchange="this.form.submit();">
		<option value="all">All Tasks</option>
		<option value="pending" <?php if(isset($_SESSION['filter']) && $_SESSION['filter'] == 'pending'){ echo 'selected';} ?>>Pending Tasks</option>
		<option value="complete" <?php if(isset($_SESSION['filter']) && $_SESSION['filter'] == 'complete'){ echo 'selected';} ?>>Completed Tasks</option>
	</select>
	</form>
    <table>
        <thead>
            <tr>
				<th>#</th>
				<th style="width: 60px;"><a href="index.php?column=todo_task&order=<?php echo $asc_or_desc; ?>">Task <i class="fas fa-sort<?php if($column == 'todo_task'){echo '-' . $up_or_down;} ?>"></i></a></th>
				<th><a href="index.php?column=todo_status&order=<?php echo $asc_or_desc; ?>">Status <i class="fas fa-sort<?php if($column == 'todo_status'){echo '-' . $up_or_down;} ?>"></i></a></th>
				<th><a href="index.php?column=creation_date&order=<?php echo $asc_or_desc; ?>">Creation Date <i class="fas fa-sort<?php if($column == 'creation_date'){echo '-' . $up_or_down;} ?>"></i></a></th>
				<th><a href="index.php?column=due_date&order=<?php echo $asc_or_desc; ?>">Due Date <i class="fas fa-sort<?php if($column == 'due_date'){echo '-' . $up_or_down;} ?>"></i></a></th>
				<th>&#128465;&#65039;</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 1; while ($row = mysqli_fetch_array($todos)) { ?>
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
				<td><nobr>
                        <?php echo $row['creation_date']; ?>
				</nobr></td>
				<td>
					<input class="datepicker-input" value="<?php echo $row['due_date']; ?>" onchange="updateValue(this,'due_date','<?php echo $row['todo_id'] ?>')" />
				</td>
				<td class="delete">
					<a href="index.php?del_id=<?php echo $row['todo_id'] ?>">x</a>
				</td>
			</tr>
			<?php $i++;} 
						?>
        </tbody>
    </table>
</body>
</html>

<script src="functions.js"></script>