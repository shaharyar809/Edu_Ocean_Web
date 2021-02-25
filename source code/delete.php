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
//////////////////////
$info = "";
$info3 = "";
///////////////////////
$Id = "";
$Name = "";
$NameA = "";
$Education = "";
$EducationA = "";
$Fees = "";
$Admission = "";
$Type = "";
$System = "";
$Location = "";
$Mobile = "";
$Email = "";
$Website = "";
$Address = "";
$Longitude = "";
$Latitude = "";
$Description = "";
//////////////////////////////
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
///////////////////////////
if(isset($_POST["Fetch"])){
	//echo $_POST["Update"];
	$sql = "SELECT * FROM data WHERE id='".$_POST["Id"]."'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
    //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["namea"]. "<br>";
	$Id = $row["id"];
	$Name = $row["name"];
	$NameA = $row["namea"];
	$Education = $row["education"];
	$EducationA = $row["educationa"];
	$Fees = $row["fees"];
	$Admission = $row["addmission"];
	$Type = $row["type"];
	$System = $row["system"];
	$Location = $row["location"];
	$Mobile = $row["mobile"];
	$Email = $row["email"];
	$Website = $row["website"];
	$Address = $row["address"];
	$Longitude = $row["longitude"];
	$Latitude = $row["latitude"];
	$Description = $row["description"];
	}
	$info = "Data Fetch Form Database";
	} 
	else {
	$info = "There Is No Data";
	}
}
///////////////////////////////////////////////////////
if(isset($_POST["Delete"]) && $_POST["Id"] != ""){

	$sql = "DELETE FROM data WHERE id='".$_POST["Id"]."'";

	if (mysqli_query($conn, $sql)) {
	$info3 = "Record Deleted successfully";
	} 
	else {
	$info3 = "Error Delete record: " . mysqli_error($conn);
	}
////////////////////////////////////////
}

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
	<h1>Delete Education</h1>
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

if($info3 != "")
{
	?><div class="info">
  <p><strong>Info3: </strong><?php echo $info3;?></p>
</div><?php
}

?>


<form action="delete.php" method="post">
	<fieldset>
	<legend><b>Fetch Education</b></legend>
	<label>ID</label>
	
    <input type="text" name="Id" placeholder="Enter Id To Delete..." value="<?php echo $Id;?>" required>
	<input type="submit" name="Fetch" value="Fetch" class="btn">
	</fieldset>
</form>

<br>

<form action="delete.php" method="post">
	<div style="overflow-x:auto;padding: 0px 0px;margin-bottom: 0px;">
	<fieldset>
	<legend><b>Information</b></legend>
	
	<input type="hidden" name="Id" placeholder="Enter Id To Update..." value="<?php echo $Id;?>" required>
	
	<table>
	<tr>
    <td>Name</td>
    <td><b><?php echo $Name;?></b></td>
    <td>Name Abbreviation</td>
	<td><b><?php echo $NameA;?></b></td>
	<td>Education</td>
	<td><b><?php echo $Education;?></b></td>
	</tr>
	<tr>
	<td>Education Abbreviation</td>
	<td><b><?php echo $EducationA;?></b></td>
    <td>Admission</td>
    <td><b><?php echo $Admission;?></b></td>
    <td>Type</td>
	<td><b><?php echo $Type;?></b></td>
	</tr>
	<tr>
	<td>System</td>
	<td><b><?php echo $System;?></b></td>
	<td>Location</td>
	<td><b><?php echo $Location;?></b></td>
    <td>Mobile</td>
    <td><b><?php echo $Mobile;?></b></td>
	</tr>
	<tr>
	<td>Email</td>
	<td><b><?php echo $Email;?></b></td>
	<td>Website</td>
	<td><b><?php echo $Website;?></b></td>
	<td>Address</td>
	<td><b><?php echo $Address;?></b></td>
	</tr>
	</table>
	
	</fieldset>
	</div>
	<br>
    <input type="submit" name="Delete" value="Delete" class="btn">
</form>
  <br>
  <button class="btn" onclick="document.location='index.php'">Home</button>
</div>

</body>
</html>
