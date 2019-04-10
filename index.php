<?php
//session must be on the top out of html mean evert thing
session_start();
//conection
include_once("includeConnection/connection.php");
$connection;//in this wariable connection is made in "includeConnection/connection.php"
	if(!$connection){
		echo "Sorry connection error".mysqli_error();
	}
?>
<!doctype html>
<html>

	<head>
		<title>LOGIN | DHIS-2</title>
		<link rel="shortcut icon" href="img/logo.jpg"/> <!--type="image/x-icon" when image is with .ico /-->
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="dhisCss/style.css" type="text/css">
		<script src="dhisJs/script.js"></script>
	</head>
<style>
#capslockon{display:none;color:#fff;}
</style>	
<body>

<!--Divs for CustomAlertBox start ...also have css in external and JS in external-->
<div id="dialogoverlay"></div>
<div id="dialogbox">
  <div>
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
  </div>
</div>
<!--Divs for CustomAlertBox end----------------------------------------------------->

	<img src="img/logo.jpg" width="100px" height="100px"/ style="float:left; margin-left:5%"><br>
	<p class="wellcome">District Health Information System</p>
	<p class="wellcome2">Employees Record</p>
	
<!--Username, password  fields and submit button start--------------->
		<div class="container">
			<img src="img/logo3.png"/>
		<form method="post" action="index.php" enctype="multipart/form-data">

			<div class="form-input">
			<input type="text" name="username" placeholder="Main Login User Name"/><br>
			<!--/div-->
			<!--div class="form-input"-->
			<input type="password"  name="password" id="passwrd" placeholder="Main Login Password"/>
			<span id="capslockon">Caps lock is ON.</span>
			</div>

			<input class="btn-login" type="submit" name="login" value="LOGIN"/>
		</form>
		</div>
<!--Username, password  fields and submit button end------------------>

<?php
//details in lecture 109 0f Jignesh Patel
if(isset($_REQUEST["login"])){
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	$select = "SELECT * FROM loginform WHERE User ='$username' AND Pass ='$password '";
	$sql_query = mysqli_query($connection,$select);
	$rowcount = mysqli_num_rows($sql_query);
	if($rowcount==true){
		//for session.......username will store in manager
		$_SESSION["Manager"] = $username;
		$_SESSION["last_time"] = time();
		header("location:main.php");
	}
	else{
		echo "<script>Alert.render('Sorry ! You have no valid information and are not Authorized');</script>";
	}
}
?>
<!--CapsLock Function-->
<script>
var input = document.getElementById("passwrd");
var text = document.getElementById("capslockon");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
    text.style.display = "block";
  } else {
    text.style.display = "none"
  }
});
</script>
</body>
</html>