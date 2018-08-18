<?php

// get access to database
include_once "../../common/base.php";

if(!empty($_POST['colour'])){

// get access to user methods
include "users.php";

// instantiate a user object
$user = new user($db);

//set session variable
$_SESSION['colour'] = $_POST['colour'];

// Call change colour method
if($user->changeColour($_POST['colour'], $_SESSION['username'])){

// Redirect to planner
echo "<script> window.location = \"../../planner.php\"; </script>";
}
//else redirect to account page
else{
	echo "<script> window.location = \"../../account.php\"; </script>";
}
}

//else redirect to account page
else{
	echo "<script> window.location = \"../../account.php\"; </script>";
}

?>