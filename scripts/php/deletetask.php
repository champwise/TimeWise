<?php

// get access to databases
include_once "../../common/base.php";

// Check for data
if(isset($_GET["list_name"]) && isset($_GET['task_text']) && isset($_SESSION["username"])){

	// set variables
	$l = $_GET["list_name"];
	$t = $_GET['task_text'];
	$u = $_SESSION["username"];

	// get access to task class
	include_once "tasks.php";

	//create new task object
	$task = new Task($db);

	// call delete task method
	$task->deleteTask($u, $l, $t);
}

?>