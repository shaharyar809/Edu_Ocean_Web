<?php
session_start();
if(!isset($_SESSION["Login"]))
{
		header("Location: login.php");
		exit;
}
?>
<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
///////////////////////////
$info = "";
$info1 = "";
$info3 = "";
///////////
$Id = "";
$Title = "";
$Image = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
////////////////////////////
if(isset($_POST["Insert"])){
	$target_dir = "uploads/";
	$target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
	// Check if file already exists
	if (file_exists($target_file1)) {
	$info1 = "Sorry, file already exists.";
	$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	$info1 = "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)) {
    $info1 = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload1"]["name"])). " has been uploaded.";
	} 
	else {
    $info1 = "Sorry, there was an error uploading your file.";
	}
	}
	/////////////////////////////////
	$sql = "INSERT INTO notice (title, image) VALUES ('".$_POST["Title"]."', '".$target_file1."')";
	if (mysqli_query($conn, $sql)) 
	{
		$info3 = "New record created successfully";
	} else 
	{
		$info3 = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	///////////////////////////////////
}
///////////////////////////
if(isset($_POST["Fetch"])){
	//echo $_POST["Update"];
	$sql = "SELECT * FROM notice WHERE id='".$_POST["Id"]."'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
    //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["namea"]. "<br>";
	$Id = $row["id"];
	$Title = $row["title"];
	$Image = $row["image"];
	}
	$info = "Data Fetch Form Database";
	} 
	else {
	$info = "There Is No Data";
	}
}
////////////////////////////
if(isset($_POST["Update"]) && $_POST["Id"] != ""){

	$sql = "UPDATE notice SET title='".$_POST["Title"]."' WHERE id='".$_POST["Id"]."'";

	if (mysqli_query($conn, $sql)) {
	$info3 = "Record updated successfully";
	} 
	else {
	$info3 = "Error updating record: " . mysqli_error($conn);
	}
	/////////////////
if(empty($_FILES['fileToUpload1']['name'])){	
//echo "Logo";	
}
else{
	$target_dir = "uploads/";
	$target_file1 = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
	// Check if file already exists
	if (file_exists($target_file1)) {
	$info1 = "Sorry, file already exists.";
	$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	$info1 = $info1." Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)) {
    $info1 = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload1"]["name"])). " has been uploaded.";
	/////////////////////////////////
	$sql = "UPDATE notice SET image='".$target_file1."' WHERE id='".$_POST["Id"]."'";

	if (mysqli_query($conn, $sql)) {
	$info1 = $info1."Logo updated successfully";
	} 
	else {
	$info1 = $info1."Error updating logo: " . mysqli_error($conn);
	}
	///////////////////////////////////
	} 
	else {
    $info1 = "Sorry, there was an error uploading your file.";
	}
	}
}
//////
}
////////////////////////////////
if(isset($_POST["Delete"]) && $_POST["Id"] != ""){

	$sql = "DELETE FROM notice WHERE id='".$_POST["Id"]."'";

	if (mysqli_query($conn, $sql)) {
	$info3 = "Record Deleted successfully";
	} 
	else {
	$info3 = "Error Delete record: " . mysqli_error($conn);
	}
}
///////////////////////////
mysqli_close($conn);
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

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  //border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

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
	<h1>Notice Board Tools</h1>
</div>

<?php

if($info != "")
{
	?><div class="info">
  <p><strong>Info: </strong><?php echo $info;?></p>
</div><?php
}

?>

<?php

if($info1 != "")
{
	?><div class="info">
  <p><strong>Info1: </strong><?php echo $info1;?></p>
</div><?php
}

?>

<?php

if($info3 != "")
{
	?><div class="info">
  <p><strong>Info3: </strong><?php echo $info3;?></p>
</div><?php
}

?>

<form action="notice.php" method="post" enctype="multipart/form-data">
	<fieldset>
	<legend><b>Insert Notice</b></legend>
	<label>Title</label>
	<input type="text" name="Title" placeholder="Enter Notice Title..."required>
	<input type="file" name="fileToUpload1" class="btn" required>
	<br>
	<br>
	<input type="submit" name="Insert" value="Insert" class="btn">
	</fieldset>
</form>
<br>
<form action="notice.php" method="post">
	<fieldset>
	<legend><b>Fetch Notice</b></legend>
	<label>ID</label>
    <input type="text" name="Id" placeholder="Enter Id..." value="<?php echo $Id;?>" required>
	<input type="submit" name="Fetch" value="Fetch" class="btn">
	</fieldset>
</form>
<br>
<form action="notice.php" method="post" enctype="multipart/form-data">
	<fieldset>
	<legend><b>Update Notice</b></legend>
	<input type="hidden" name="Id" placeholder="Enter Id To Update..." value="<?php echo $Id;?>" required>
	<label>Title</label>
	<input type="text" name="Title" placeholder="Enter Notice Title..." value="<?php echo $Title;?>" required>
	<input type="file" name="fileToUpload1" class="btn">
	<br>
	<br>
	<input type="submit" name="Update" value="Update" class="btn">
	</fieldset>
</form>
<br>
<form action="notice.php" method="post">
	<fieldset>
	<legend><b>Delete Notice</b></legend>
	<input type="hidden" name="Id" placeholder="Enter Id To Update..." value="<?php echo $Id;?>" required>
	
	<table>
	<tr>
    <td>ID</td>
    <td><b><?php echo $Id;?></b></td>
    <td>Title</td>
	<td><b><?php echo $Title;?></b></td>
	<td>Image</td>
	<td><b><?php echo $Image;?></b></td>
	</tr>
	</table>
	
	<input type="submit" name="Delete" value="Delete" class="btn">
	</fieldset>
</form>

  <br>
  <button class="btn" onclick="document.location='index.php'">Home</button>
</div>

</body>
</html>
