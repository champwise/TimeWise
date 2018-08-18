<?php

// get access to database
include_once "../../common/base.php";

// if the ajax message has been sent from signup.js
if(isset($_POST["username"])){

  include "users.php";

  $user = new user($db);

  echo $user->checkUsername($_POST["username"]);

  
}


?>