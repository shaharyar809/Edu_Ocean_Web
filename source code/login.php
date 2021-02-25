<?php
$Username = "";
$Password = "";

// Start the session
session_start();

if(isset($_SESSION["Login"]))
{
		header("Location: index.php");
		exit;
}

if(isset($_POST["Login"])){
	if($_POST["Username"] == $Username && $_POST["Password"] == $Password)
	{
		$_SESSION["Login"] = true;
		header("Location: index.php");
		exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;margin:0%;background-color: #eef2f3;margin-bottom: 10px;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 2px solid #ccc;
  margin-top: 6px;
  margin-bottom: 16px;
}

.btn {
  background-color: #00B4DB;
  color: white;
  padding: 14px 28px;
  border: none;
  cursor: pointer;
  width: 100%;
}

.btn:hover {
  background-color: black;
}

.container {
  background-color: #eef2f3;
}

.info {
  background-color: #00B4DB;
  border-left: 6px solid black;
  color: white;
}

div {
  margin-bottom: 15px;
  padding: 4px 12px;
}

fieldset {
  border: 2px solid black;
}

legend {
  background-color: black;
  color: white;
  padding: 6px 12px;
}
</style>
</head>
<body>

<div class="container">


<div class="info">
	<h1>Edu Ocean</h1>
</div>

<form action="login.php" method="post">
	<fieldset>
	<legend><b>Login</b></legend>
	<label>Username</label>
    <input type="text" name="Username" placeholder="Enter Username..." value="" required>
	<label>Password</label>
    <input type="text" name="Password" placeholder="Enter Pasword..." value="" required>
	<input type="submit" name="Login" value="Login" class="btn">
	</fieldset>
</form>
 
</div>

</body>
</html>
