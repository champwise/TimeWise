<?php

    // get access to database
include_once "../../common/base.php";

//unset session variables
unset($_SESSION['loggedin']);
unset($_SESSION['username']);
unset($_SESSION['colour']);

?>
<!-- redirect to login page -->
<meta http-equiv="refresh" content="0;../../login.php">