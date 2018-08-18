<?php

    // Set page title in header.php
$pageTitle = "Account settings";

    // Prepend header.php to page
include_once "common/header.php";

// redirect user back to login page if not logged in
if(!isset($_SESSION['loggedin']) && !isset($_SESSION['username']) && $_SESSION['loggedin']!=1){

	echo "<script> window.location = \"login.php\"; </script>";
}
else{
	//if form has been submitted
if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_SESSION['username'])){

// get access to user methods
include "scripts/php/users.php";

// instantiate a user object
$user = new user($db);

// if change password meth returns true, redirect user back to planer page
if($user->changePassword($_SESSION['username'], $_POST['old_password'], $_POST['new_password'])){
	echo "<script> window.location = \"planner.php\"; </script>";
}
else{
    
    echo "<script> window.onload = function () { var e = document.getElementById('passwordcheck'); e.style.display='inline'; }; </script>";
}

}

}

?>

<!-- javascript file for form -->
<script type="text/javascript" src="scripts/javascript/account.js"></script>

<div class="container">
	<form id = "password-form" action="account.php" method="POST" class="col-xs-12 col-sm-4 col-sm-offset-4 well">

		<div class="form-group">
			<label for="old_password"><b>Password</b><span id ="passwordcheck" style="color: red; display: none;"> incorect password</span></label>
			<input type="password" name="old_password" placeholder="password" class="form-control"><br>
		</div>

		<div class="form-group">
			<label for="password"><b>Enter new password</b><span id="passwordmatch" style="color: red; display: none;"> passwords do not match</span></label>
			<input id="password"type="password" name="new_password" placeholder="new password" class="form-control" ><br>
		</div>
		<div class="form-group">
			<label for="password"><b>Retype new password</b></label>
			<input id="password2" type="password" name="new_password2" placeholder="new password" class="form-control" ><br>
		</div>

		<button id = "submit" type="button" class="btn btn-primary">Change password</button>

		
	</form>
</div>

<!-- delete account -->
<div class="container">
	<div id="delete-account" class="col-xs-12 col-sm-4 col-sm-offset-4 well">
		<a onclick="return confirm('Are you sure?')" class="btn btn-primary" href="scripts/php/deleteaccount.php">Delete account</a>
	</div>
</div>

<!-- colour picker -->
<div class="container">


	<div id="colour-picker-form" class="col-xs-12 col-sm-4 col-sm-offset-4 well well">
		<p><b>Choose your background colour</b></p>
		<!-- Colour picker image -->
		<div class="center-block"><img id="color-picker" class="center-block img-responsive" src="images/img_colormap.gif"  usemap="#colormap_top" alt="colormap"></div>
		<!-- Colour picker map for image -->
		<map name="colormap_top" id="colormap_top" >
			<area style="cursor:pointer" shape="poly" coords="63,0,72,4,72,15,63,19,54,15,54,4" onclick="clickColor(&quot;#003366&quot;,1,20,54)">
			<area style="cursor:pointer" shape="poly" coords="81,0,90,4,90,15,81,19,72,15,72,4" onclick="clickColor(&quot;#336699&quot;,1,20,72)">
			<area style="cursor:pointer" shape="poly" coords="99,0,108,4,108,15,99,19,90,15,90,4" onclick="clickColor(&quot;#3366CC&quot;,1,20,90)">
			<area style="cursor:pointer" shape="poly" coords="117,0,126,4,126,15,117,19,108,15,108,4" onclick="clickColor(&quot;#003399&quot;,1,20,108)">
			<area style="cursor:pointer" shape="poly" coords="135,0,144,4,144,15,135,19,126,15,126,4" onclick="clickColor(&quot;#000099&quot;,1,20,126)">
			<area style="cursor:pointer" shape="poly" coords="153,0,162,4,162,15,153,19,144,15,144,4" onclick="clickColor(&quot;#0000CC&quot;,1,20,144)">
			<area style="cursor:pointer" shape="poly" coords="171,0,180,4,180,15,171,19,162,15,162,4" onclick="clickColor(&quot;#000066&quot;,1,20,162)">
			<area style="cursor:pointer" shape="poly" coords="54,15,63,19,63,30,54,34,45,30,45,19" onclick="clickColor(&quot;#006666&quot;,1,35,45)">
			<area style="cursor:pointer" shape="poly" coords="72,15,81,19,81,30,72,34,63,30,63,19" onclick="clickColor(&quot;#006699&quot;,1,35,63)">
			<area style="cursor:pointer" shape="poly" coords="90,15,99,19,99,30,90,34,81,30,81,19" onclick="clickColor(&quot;#0099CC&quot;,1,35,81)">
			<area style="cursor:pointer" shape="poly" coords="108,15,117,19,117,30,108,34,99,30,99,19" onclick="clickColor(&quot;#0066CC&quot;,1,35,99)">
			<area style="cursor:pointer" shape="poly" coords="126,15,135,19,135,30,126,34,117,30,117,19" onclick="clickColor(&quot;#0033CC&quot;,1,35,117)">
			<area style="cursor:pointer" shape="poly" coords="144,15,153,19,153,30,144,34,135,30,135,19" onclick="clickColor(&quot;#0000FF&quot;,1,35,135)">
			<area style="cursor:pointer" shape="poly" coords="162,15,171,19,171,30,162,34,153,30,153,19" onclick="clickColor(&quot;#3333FF&quot;,1,35,153)">
			<area style="cursor:pointer" shape="poly" coords="180,15,189,19,189,30,180,34,171,30,171,19" onclick="clickColor(&quot;#333399&quot;,1,35,171)">
			<area style="cursor:pointer" shape="poly" coords="45,30,54,34,54,45,45,49,36,45,36,34" onclick="clickColor(&quot;#669999&quot;,1,50,36)">
			<area style="cursor:pointer" shape="poly" coords="63,30,72,34,72,45,63,49,54,45,54,34" onclick="clickColor(&quot;#009999&quot;,1,50,54)">
			<area style="cursor:pointer" shape="poly" coords="81,30,90,34,90,45,81,49,72,45,72,34" onclick="clickColor(&quot;#33CCCC&quot;,1,50,72)">
			<area style="cursor:pointer" shape="poly" coords="99,30,108,34,108,45,99,49,90,45,90,34" onclick="clickColor(&quot;#00CCFF&quot;,1,50,90)">
			<area style="cursor:pointer" shape="poly" coords="117,30,126,34,126,45,117,49,108,45,108,34" onclick="clickColor(&quot;#0099FF&quot;,1,50,108)">
			<area style="cursor:pointer" shape="poly" coords="135,30,144,34,144,45,135,49,126,45,126,34" onclick="clickColor(&quot;#0066FF&quot;,1,50,126)">
			<area style="cursor:pointer" shape="poly" coords="153,30,162,34,162,45,153,49,144,45,144,34" onclick="clickColor(&quot;#3366FF&quot;,1,50,144)">
			<area style="cursor:pointer" shape="poly" coords="171,30,180,34,180,45,171,49,162,45,162,34" onclick="clickColor(&quot;#3333CC&quot;,1,50,162)">
			<area style="cursor:pointer" shape="poly" coords="189,30,198,34,198,45,189,49,180,45,180,34" onclick="clickColor(&quot;#666699&quot;,1,50,180)">
			<area style="cursor:pointer" shape="poly" coords="36,45,45,49,45,60,36,64,27,60,27,49" onclick="clickColor(&quot;#339966&quot;,1,65,27)">
			<area style="cursor:pointer" shape="poly" coords="54,45,63,49,63,60,54,64,45,60,45,49" onclick="clickColor(&quot;#00CC99&quot;,1,65,45)">
			<area style="cursor:pointer" shape="poly" coords="72,45,81,49,81,60,72,64,63,60,63,49" onclick="clickColor(&quot;#00FFCC&quot;,1,65,63)">
			<area style="cursor:pointer" shape="poly" coords="90,45,99,49,99,60,90,64,81,60,81,49" onclick="clickColor(&quot;#00FFFF&quot;,1,65,81)">
			<area style="cursor:pointer" shape="poly" coords="108,45,117,49,117,60,108,64,99,60,99,49" onclick="clickColor(&quot;#33CCFF&quot;,1,65,99)">
			<area style="cursor:pointer" shape="poly" coords="126,45,135,49,135,60,126,64,117,60,117,49" onclick="clickColor(&quot;#3399FF&quot;,1,65,117)">
			<area style="cursor:pointer" shape="poly" coords="144,45,153,49,153,60,144,64,135,60,135,49" onclick="clickColor(&quot;#6699FF&quot;,1,65,135)">
			<area style="cursor:pointer" shape="poly" coords="162,45,171,49,171,60,162,64,153,60,153,49" onclick="clickColor(&quot;#6666FF&quot;,1,65,153)">
			<area style="cursor:pointer" shape="poly" coords="180,45,189,49,189,60,180,64,171,60,171,49" onclick="clickColor(&quot;#6600FF&quot;,1,65,171)">
			<area style="cursor:pointer" shape="poly" coords="198,45,207,49,207,60,198,64,189,60,189,49" onclick="clickColor(&quot;#6600CC&quot;,1,65,189)">
			<area style="cursor:pointer" shape="poly" coords="27,60,36,64,36,75,27,79,18,75,18,64" onclick="clickColor(&quot;#339933&quot;,1,80,18)">
			<area style="cursor:pointer" shape="poly" coords="45,60,54,64,54,75,45,79,36,75,36,64" onclick="clickColor(&quot;#00CC66&quot;,1,80,36)">
			<area style="cursor:pointer" shape="poly" coords="63,60,72,64,72,75,63,79,54,75,54,64" onclick="clickColor(&quot;#00FF99&quot;,1,80,54)">
			<area style="cursor:pointer" shape="poly" coords="81,60,90,64,90,75,81,79,72,75,72,64" onclick="clickColor(&quot;#66FFCC&quot;,1,80,72)">
			<area style="cursor:pointer" shape="poly" coords="99,60,108,64,108,75,99,79,90,75,90,64" onclick="clickColor(&quot;#66FFFF&quot;,1,80,90)">
			<area style="cursor:pointer" shape="poly" coords="117,60,126,64,126,75,117,79,108,75,108,64" onclick="clickColor(&quot;#66CCFF&quot;,1,80,108)">
			<area style="cursor:pointer" shape="poly" coords="135,60,144,64,144,75,135,79,126,75,126,64" onclick="clickColor(&quot;#99CCFF&quot;,1,80,126)">
			<area style="cursor:pointer" shape="poly" coords="153,60,162,64,162,75,153,79,144,75,144,64" onclick="clickColor(&quot;#9999FF&quot;,1,80,144)">
			<area style="cursor:pointer" shape="poly" coords="171,60,180,64,180,75,171,79,162,75,162,64" onclick="clickColor(&quot;#9966FF&quot;,1,80,162)">
			<area style="cursor:pointer" shape="poly" coords="189,60,198,64,198,75,189,79,180,75,180,64" onclick="clickColor(&quot;#9933FF&quot;,1,80,180)">
			<area style="cursor:pointer" shape="poly" coords="207,60,216,64,216,75,207,79,198,75,198,64" onclick="clickColor(&quot;#9900FF&quot;,1,80,198)">
			<area style="cursor:pointer" shape="poly" coords="18,75,27,79,27,90,18,94,9,90,9,79" onclick="clickColor(&quot;#006600&quot;,1,95,9)">
			<area style="cursor:pointer" shape="poly" coords="36,75,45,79,45,90,36,94,27,90,27,79" onclick="clickColor(&quot;#00CC00&quot;,1,95,27)">
			<area style="cursor:pointer" shape="poly" coords="54,75,63,79,63,90,54,94,45,90,45,79" onclick="clickColor(&quot;#00FF00&quot;,1,95,45)">
			<area style="cursor:pointer" shape="poly" coords="72,75,81,79,81,90,72,94,63,90,63,79" onclick="clickColor(&quot;#66FF99&quot;,1,95,63)">
			<area style="cursor:pointer" shape="poly" coords="90,75,99,79,99,90,90,94,81,90,81,79" onclick="clickColor(&quot;#99FFCC&quot;,1,95,81)">
			<area style="cursor:pointer" shape="poly" coords="108,75,117,79,117,90,108,94,99,90,99,79" onclick="clickColor(&quot;#CCFFFF&quot;,1,95,99)">
			<area style="cursor:pointer" shape="poly" coords="126,75,135,79,135,90,126,94,117,90,117,79" onclick="clickColor(&quot;#CCCCFF&quot;,1,95,117)">
			<area style="cursor:pointer" shape="poly" coords="144,75,153,79,153,90,144,94,135,90,135,79" onclick="clickColor(&quot;#CC99FF&quot;,1,95,135)">
			<area style="cursor:pointer" shape="poly" coords="162,75,171,79,171,90,162,94,153,90,153,79" onclick="clickColor(&quot;#CC66FF&quot;,1,95,153)">
			<area style="cursor:pointer" shape="poly" coords="180,75,189,79,189,90,180,94,171,90,171,79" onclick="clickColor(&quot;#CC33FF&quot;,1,95,171)">
			<area style="cursor:pointer" shape="poly" coords="198,75,207,79,207,90,198,94,189,90,189,79" onclick="clickColor(&quot;#CC00FF&quot;,1,95,189)">
			<area style="cursor:pointer" shape="poly" coords="216,75,225,79,225,90,216,94,207,90,207,79" onclick="clickColor(&quot;#9900CC&quot;,1,95,207)">
			<area style="cursor:pointer" shape="poly" coords="9,90,18,94,18,105,9,109,0,105,0,94" onclick="clickColor(&quot;#003300&quot;,1,110,0)">
			<area style="cursor:pointer" shape="poly" coords="27,90,36,94,36,105,27,109,18,105,18,94" onclick="clickColor(&quot;#009933&quot;,1,110,18)">
			<area style="cursor:pointer" shape="poly" coords="45,90,54,94,54,105,45,109,36,105,36,94" onclick="clickColor(&quot;#33CC33&quot;,1,110,36)">
			<area style="cursor:pointer" shape="poly" coords="63,90,72,94,72,105,63,109,54,105,54,94" onclick="clickColor(&quot;#66FF66&quot;,1,110,54)">
			<area style="cursor:pointer" shape="poly" coords="81,90,90,94,90,105,81,109,72,105,72,94" onclick="clickColor(&quot;#99FF99&quot;,1,110,72)">
			<area style="cursor:pointer" shape="poly" coords="99,90,108,94,108,105,99,109,90,105,90,94" onclick="clickColor(&quot;#CCFFCC&quot;,1,110,90)">
			<area style="cursor:pointer" shape="poly" coords="117,90,126,94,126,105,117,109,108,105,108,94" onclick="clickColor(&quot;#FFFFFF&quot;,1,110,108)">
			<area style="cursor:pointer" shape="poly" coords="135,90,144,94,144,105,135,109,126,105,126,94" onclick="clickColor(&quot;#FFCCFF&quot;,1,110,126)">
			<area style="cursor:pointer" shape="poly" coords="153,90,162,94,162,105,153,109,144,105,144,94" onclick="clickColor(&quot;#FF99FF&quot;,1,110,144)">
			<area style="cursor:pointer" shape="poly" coords="171,90,180,94,180,105,171,109,162,105,162,94" onclick="clickColor(&quot;#FF66FF&quot;,1,110,162)">
			<area style="cursor:pointer" shape="poly" coords="189,90,198,94,198,105,189,109,180,105,180,94" onclick="clickColor(&quot;#FF00FF&quot;,1,110,180)">
			<area style="cursor:pointer" shape="poly" coords="207,90,216,94,216,105,207,109,198,105,198,94" onclick="clickColor(&quot;#CC00CC&quot;,1,110,198)">
			<area style="cursor:pointer" shape="poly" coords="225,90,234,94,234,105,225,109,216,105,216,94" onclick="clickColor(&quot;#660066&quot;,1,110,216)">
			<area style="cursor:pointer" shape="poly" coords="18,105,27,109,27,120,18,124,9,120,9,109" onclick="clickColor(&quot;#336600&quot;,1,125,9)">
			<area style="cursor:pointer" shape="poly" coords="36,105,45,109,45,120,36,124,27,120,27,109" onclick="clickColor(&quot;#009900&quot;,1,125,27)">
			<area style="cursor:pointer" shape="poly" coords="54,105,63,109,63,120,54,124,45,120,45,109" onclick="clickColor(&quot;#66FF33&quot;,1,125,45)">
			<area style="cursor:pointer" shape="poly" coords="72,105,81,109,81,120,72,124,63,120,63,109" onclick="clickColor(&quot;#99FF66&quot;,1,125,63)">
			<area style="cursor:pointer" shape="poly" coords="90,105,99,109,99,120,90,124,81,120,81,109" onclick="clickColor(&quot;#CCFF99&quot;,1,125,81)">
			<area style="cursor:pointer" shape="poly" coords="108,105,117,109,117,120,108,124,99,120,99,109" onclick="clickColor(&quot;#FFFFCC&quot;,1,125,99)">
			<area style="cursor:pointer" shape="poly" coords="126,105,135,109,135,120,126,124,117,120,117,109" onclick="clickColor(&quot;#FFCCCC&quot;,1,125,117)">
			<area style="cursor:pointer" shape="poly" coords="144,105,153,109,153,120,144,124,135,120,135,109" onclick="clickColor(&quot;#FF99CC&quot;,1,125,135)">
			<area style="cursor:pointer" shape="poly" coords="162,105,171,109,171,120,162,124,153,120,153,109" onclick="clickColor(&quot;#FF66CC&quot;,1,125,153)">
			<area style="cursor:pointer" shape="poly" coords="180,105,189,109,189,120,180,124,171,120,171,109" onclick="clickColor(&quot;#FF33CC&quot;,1,125,171)">
			<area style="cursor:pointer" shape="poly" coords="198,105,207,109,207,120,198,124,189,120,189,109" onclick="clickColor(&quot;#CC0099&quot;,1,125,189)">
			<area style="cursor:pointer" shape="poly" coords="216,105,225,109,225,120,216,124,207,120,207,109" onclick="clickColor(&quot;#993399&quot;,1,125,207)">
			<area style="cursor:pointer" shape="poly" coords="27,120,36,124,36,135,27,139,18,135,18,124" onclick="clickColor(&quot;#333300&quot;,1,140,18)">
			<area style="cursor:pointer" shape="poly" coords="45,120,54,124,54,135,45,139,36,135,36,124" onclick="clickColor(&quot;#669900&quot;,1,140,36)">
			<area style="cursor:pointer" shape="poly" coords="63,120,72,124,72,135,63,139,54,135,54,124" onclick="clickColor(&quot;#99FF33&quot;,1,140,54)">
			<area style="cursor:pointer" shape="poly" coords="81,120,90,124,90,135,81,139,72,135,72,124" onclick="clickColor(&quot;#CCFF66&quot;,1,140,72)">
			<area style="cursor:pointer" shape="poly" coords="99,120,108,124,108,135,99,139,90,135,90,124" onclick="clickColor(&quot;#FFFF99&quot;,1,140,90)">
			<area style="cursor:pointer" shape="poly" coords="117,120,126,124,126,135,117,139,108,135,108,124" onclick="clickColor(&quot;#FFCC99&quot;,1,140,108)">
			<area style="cursor:pointer" shape="poly" coords="135,120,144,124,144,135,135,139,126,135,126,124" onclick="clickColor(&quot;#FF9999&quot;,1,140,126)">
			<area style="cursor:pointer" shape="poly" coords="153,120,162,124,162,135,153,139,144,135,144,124" onclick="clickColor(&quot;#FF6699&quot;,1,140,144)">
			<area style="cursor:pointer" shape="poly" coords="171,120,180,124,180,135,171,139,162,135,162,124" onclick="clickColor(&quot;#FF3399&quot;,1,140,162)">
			<area style="cursor:pointer" shape="poly" coords="189,120,198,124,198,135,189,139,180,135,180,124" onclick="clickColor(&quot;#CC3399&quot;,1,140,180)">
			<area style="cursor:pointer" shape="poly" coords="207,120,216,124,216,135,207,139,198,135,198,124" onclick="clickColor(&quot;#990099&quot;,1,140,198)">
			<area style="cursor:pointer" shape="poly" coords="36,135,45,139,45,150,36,154,27,150,27,139" onclick="clickColor(&quot;#666633&quot;,1,155,27)">
			<area style="cursor:pointer" shape="poly" coords="54,135,63,139,63,150,54,154,45,150,45,139" onclick="clickColor(&quot;#99CC00&quot;,1,155,45)">
			<area style="cursor:pointer" shape="poly" coords="72,135,81,139,81,150,72,154,63,150,63,139" onclick="clickColor(&quot;#CCFF33&quot;,1,155,63)">
			<area style="cursor:pointer" shape="poly" coords="90,135,99,139,99,150,90,154,81,150,81,139" onclick="clickColor(&quot;#FFFF66&quot;,1,155,81)">
			<area style="cursor:pointer" shape="poly" coords="108,135,117,139,117,150,108,154,99,150,99,139" onclick="clickColor(&quot;#FFCC66&quot;,1,155,99)">
			<area style="cursor:pointer" shape="poly" coords="126,135,135,139,135,150,126,154,117,150,117,139" onclick="clickColor(&quot;#FF9966&quot;,1,155,117)">
			<area style="cursor:pointer" shape="poly" coords="144,135,153,139,153,150,144,154,135,150,135,139" onclick="clickColor(&quot;#FF6666&quot;,1,155,135)">
			<area style="cursor:pointer" shape="poly" coords="162,135,171,139,171,150,162,154,153,150,153,139" onclick="clickColor(&quot;#FF0066&quot;,1,155,153)">
			<area style="cursor:pointer" shape="poly" coords="180,135,189,139,189,150,180,154,171,150,171,139" onclick="clickColor(&quot;#CC6699&quot;,1,155,171)">
			<area style="cursor:pointer" shape="poly" coords="198,135,207,139,207,150,198,154,189,150,189,139" onclick="clickColor(&quot;#993366&quot;,1,155,189)">
			<area style="cursor:pointer" shape="poly" coords="45,150,54,154,54,165,45,169,36,165,36,154" onclick="clickColor(&quot;#999966&quot;,1,170,36)">
			<area style="cursor:pointer" shape="poly" coords="63,150,72,154,72,165,63,169,54,165,54,154" onclick="clickColor(&quot;#CCCC00&quot;,1,170,54)">
			<area style="cursor:pointer" shape="poly" coords="81,150,90,154,90,165,81,169,72,165,72,154" onclick="clickColor(&quot;#FFFF00&quot;,1,170,72)">
			<area style="cursor:pointer" shape="poly" coords="99,150,108,154,108,165,99,169,90,165,90,154" onclick="clickColor(&quot;#FFCC00&quot;,1,170,90)">
			<area style="cursor:pointer" shape="poly" coords="117,150,126,154,126,165,117,169,108,165,108,154" onclick="clickColor(&quot;#FF9933&quot;,1,170,108)">
			<area style="cursor:pointer" shape="poly" coords="135,150,144,154,144,165,135,169,126,165,126,154" onclick="clickColor(&quot;#FF6600&quot;,1,170,126)">
			<area style="cursor:pointer" shape="poly" coords="153,150,162,154,162,165,153,169,144,165,144,154" onclick="clickColor(&quot;#FF5050&quot;,1,170,144)">
			<area style="cursor:pointer" shape="poly" coords="171,150,180,154,180,165,171,169,162,165,162,154" onclick="clickColor(&quot;#CC0066&quot;,1,170,162)">
			<area style="cursor:pointer" shape="poly" coords="189,150,198,154,198,165,189,169,180,165,180,154" onclick="clickColor(&quot;#660033&quot;,1,170,180)">
			<area style="cursor:pointer" shape="poly" coords="54,165,63,169,63,180,54,184,45,180,45,169" onclick="clickColor(&quot;#996633&quot;,1,185,45)">
			<area style="cursor:pointer" shape="poly" coords="72,165,81,169,81,180,72,184,63,180,63,169" onclick="clickColor(&quot;#CC9900&quot;,1,185,63)">
			<area style="cursor:pointer" shape="poly" coords="90,165,99,169,99,180,90,184,81,180,81,169" onclick="clickColor(&quot;#FF9900&quot;,1,185,81)">
			<area style="cursor:pointer" shape="poly" coords="108,165,117,169,117,180,108,184,99,180,99,169" onclick="clickColor(&quot;#CC6600&quot;,1,185,99)">
			<area style="cursor:pointer" shape="poly" coords="126,165,135,169,135,180,126,184,117,180,117,169" onclick="clickColor(&quot;#FF3300&quot;,1,185,117)">
			<area style="cursor:pointer" shape="poly" coords="144,165,153,169,153,180,144,184,135,180,135,169" onclick="clickColor(&quot;#FF0000&quot;,1,185,135)">
			<area style="cursor:pointer" shape="poly" coords="162,165,171,169,171,180,162,184,153,180,153,169" onclick="clickColor(&quot;#CC0000&quot;,1,185,153)">
			<area style="cursor:pointer" shape="poly" coords="180,165,189,169,189,180,180,184,171,180,171,169" onclick="clickColor(&quot;#990033&quot;,1,185,171)">
			<area style="cursor:pointer" shape="poly" coords="63,180,72,184,72,195,63,199,54,195,54,184" onclick="clickColor(&quot;#663300&quot;,1,200,54)">
			<area style="cursor:pointer" shape="poly" coords="81,180,90,184,90,195,81,199,72,195,72,184" onclick="clickColor(&quot;#996600&quot;,1,200,72)">
			<area style="cursor:pointer" shape="poly" coords="99,180,108,184,108,195,99,199,90,195,90,184" onclick="clickColor(&quot;#CC3300&quot;,1,200,90)">
			<area style="cursor:pointer" shape="poly" coords="117,180,126,184,126,195,117,199,108,195,108,184" onclick="clickColor(&quot;#993300&quot;,1,200,108)">
			<area style="cursor:pointer" shape="poly" coords="135,180,144,184,144,195,135,199,126,195,126,184" onclick="clickColor(&quot;#990000&quot;,1,200,126)">
			<area style="cursor:pointer" shape="poly" coords="153,180,162,184,162,195,153,199,144,195,144,184" onclick="clickColor(&quot;#800000&quot;,1,200,144)">
			<area style="cursor:pointer" shape="poly" coords="171,180,180,184,180,195,171,199,162,195,162,184" onclick="clickColor(&quot;#993333&quot;,1,200,162)">
		</map>

		<!-- change background colour button -->
		<form action="scripts/php/changecolour.php" method="POST">
			<div class="form-group">
				<input id = "colour" name = "colour" style="display: none;"  />
				<button id = "submit" type="submit" class="btn btn-primary" >Change background colour</button>
			</div>
		</form>
	</div>

	<!-- call function to make the image map responsive -->
	<script>
		imageMapResize();
	</script>
</div>

<?php
// endif;
// else:
?>

<!-- javascript file for form -->
<!-- <script type="text/javascript" src="scripts/javascript/account.js"></script> -->

	<!-- <div class="container">
	<form id = "password-form" action="account.php" method="POST" class="col-xs-12 col-md-4 col-md-offset-4 well">

		<div class="form-group">
			<label for="old_password"><b>Password</b><span id="passwordcheck"></span></label>
			<input type="password" name="old_password" placeholder="password" class="form-control"><br>
		</div>

		<div class="form-group">
			<label for="password"><b>Enter new password</b></label>
			<input id="password"type="password" name="new_password" placeholder="new password" class="form-control" ><br>
		</div>
		<div class="form-group">
			<label for="password"><b>Retype new password</b><span id="passwordcheck"></span></label>
			<input id="password2" type="password" name="new_password2" placeholder="new password" class="form-control" ><br>
		</div>

		<button id = "submit" type="button" class="btn btn-primary">Change password</button>

		
	</form>
	</div>

	<div class="container">
	<form id="delete-account-form" action="scripts/php/deleteaccount.php" class="col-xs-12 col-md-4 col-md-offset-4 well">
		<div class="form-group">
			<input id = "delete-account" type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary" value="Delete account"/>
		</div>
	</form>
</div> -->

<?php

// endif;

include_once "common/footer.php";
?>






