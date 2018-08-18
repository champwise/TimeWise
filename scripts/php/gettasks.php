<?php

// get access to database
include_once "../../common/base.php";

// Check for data
if(isset($_GET["list_name"]) && isset($_SESSION["username"])){

	// set variables
	$l = $_GET["list_name"];
	$u = $_SESSION["username"];

	// get access to task class
	include_once "tasks.php";

	//create new task object
	$task = new Task($db);

	// call get task method
	$task->gettasks($u, $l);
}

?>