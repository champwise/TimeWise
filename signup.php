

<?php

    //  Set page title
$pageTitle = "Sign up";

    //  Prepend header.php to the page
include_once "common/header.php";

    //  If sign up form has been submitted: Create user object
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])):
   include "scripts/php/users.php";
$user = new user($db);

        //  If account creation was successful: set session variables and redirect to planner.php
if($user->createAccount($_POST['username'], $_POST['password'])){
    if($user->logIn($_POST['username'], $_POST['password'])){

       $_SESSION['username'] = $_POST['username'];
       $_SESSION['loggedin'] = 1 ;
       $_SESSION['colour'] = $user->getColour($_POST['username']);
       echo "<script> window.location = \"planner.php\";</script>";
   }
}

else{}

    //  Else, if sign up form not submitted: show signup form
else:
    ?>

    <!-- javascript file for form -->
    <script type="text/javascript" src="scripts/javascript/signup.js"></script>

    <!-- signup form with ajax to check for username availability password double checking -->
    <div class="container">   
    <form id = "signup-form" action="signup.php" method="POST" class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4 well">
        <div class="form-group">
            <label id= "username-label"for="username"><b>Enter username</b><span id="usernamecheck" ></span></label>
            <input id = "username"type="text" name="username" placeholder="Username" class="form-control" ><br>
        </div>
        <div class="form-group">
            <label for="password"><b>Enter password</b></label>
            <input id="password"type="password" name="password" placeholder="password" class="form-control" ><br>
        </div>
        <div class="form-group">
            <label for="password"><b>Retype password</b><span id="passwordcheck"></span></label>
            <input id="password2" type="password" name="password2" placeholder="password" class="form-control" ><br>
        </div>
        <button class="btn btn-primary" id="register" ">Sign up</button>
        <a href="login.php" >Log in</a>
    </form>
    </div>

    <?php 
endif;

    // Append footer.php to the page
include_once "common/footer.php"; 
?>