<?php

// get access to database
include_once "../../common/base.php";

// if create task from has been submitted
if(isset($_POST['task_text']) && isset($_POST['list_name'])){

	// get access to the task class
	include "tasks.php";

	// instantiate task object
	$task = new Task($db);

	// call create task method
	$task->createTask($_SESSION['username'], $_POST['list_name'], $_POST['task_text']);

}

?>
<!-- redirect to planner.php -->
<meta http-equiv="refresh" content="0;../../planner.php">