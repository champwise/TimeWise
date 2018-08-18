<?php

    // Set page title in header.php
$pageTitle = "Log In";

    // Prepend header.php to page
include_once "common/header.php";

    //  If login form has been submitted
if(isset($_POST['username']) && isset($_POST['password'])){

    	// include user class
   include "scripts/php/users.php";
        // Create new user object
    $user = new user($db);
        // If login method successful: set session variables and redirect to planner.php page
if($user->logIn($_POST['username'], $_POST['password'])){

   $_SESSION['username'] = $_POST['username'];
   $_SESSION['loggedin'] = 1 ;
   $_SESSION['colour'] = $user->getColour($_POST['username']);
   echo "<script> window.location = \"planner.php\"; </script>";
}
else{
    
    echo "<script> window.onload = function () { var e = document.getElementById('logincheck'); e.style.display='inline'; }; </script>";
}

}

    ?>

    <div class="container">
        <form class = "login-form col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4 well" action="login.php" method="POST">
            <div class="form-group">
                <label for="username"><b>Username</b><span id = "logincheck" style = "color: red; display: none;" > Incorrect username or password</span></label>
                <input type="text" name="username" placeholder="Username" class="form-control"><br>
            </div>
            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" name="password" placeholder="password" class="form-control"><br>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
            <a href="signup.php" >Sign up</a>
        </form>
    </div>

<?php 

    // Append footer to page
include_once "common/footer.php"; 
?>