<?php

// get access to database
include_once "../../common/base.php";

// set $u variable as the username
$u = $_SESSION['username'];

// get access to user class
include "users.php";

// instantiate user object
$user = new user($db);

// if delete account is successful: log out
if($user->deleteAccount($u)){

	include_once "logout.php";

}
else{
	echo "<script> window.location = '../../account.php';</script>";
} 



?>