<?php

// get access to database
include_once "../../common/base.php";

//if form has been submitted
if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_SESSION['username'])){

// get access to user methods
include "users.php";

// instantiate a user object
$user = new user($db);

// if change password meth returns true, redirect user back to planer page
if($user->changePassword($_SESSION['username'], $_POST['old_password'], $_POST['new_password'])){
	echo "<script> window.location = \"../../planner.php\"; </script>";
}

}
?>