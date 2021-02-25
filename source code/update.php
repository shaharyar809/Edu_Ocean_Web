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
/////////////////////
$info = "";
$info1 = "";
$info2 = "";
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
	$info = "Data fetched Form Database";
	} 
	else {
	$info = "There Is No Data";
	}
}
///////////////////////////////////////////////////////
if(isset($_POST["Update"]) && $_POST["Id"] != ""){

	$sql = "UPDATE data SET name='".$_POST["Name"]."', namea='".$_POST["NameA"]."', education='".$_POST["Education"]."', 
	educationa='".$_POST["EducationA"]."', fees='".$_POST["Fees"]."', addmission='".$_POST["Admission"]."', type='".$_POST["Type"]."', 
	system='".$_POST["System"]."', location='".$_POST["Location"]."', mobile='".$_POST["Mobile"]."', email='".$_POST["Email"]."', 
	website='".$_POST["Website"]."', address='".$_POST["Address"]."', longitude='".$_POST["Longitude"]."', latitude='".$_POST["Latitude"]."', 
	description='".$_POST["Description"]."' WHERE id='".$_POST["Id"]."'";

	if (mysqli_query($conn, $sql)) {
	$info3 = "Record updated successfully";
	} 
	else {
	$info3 = "Error updating record: " . mysqli_error($conn);
	}
///////////////////////////////////////////
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
	$sql = "UPDATE data SET logo='".$target_file1."' WHERE id='".$_POST["Id"]."'";

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
	///
}
/////////////////////////////////////////
if(empty($_FILES['fileToUpload2']['name'])){	
	//echo "Background";	
}
else{
	$target_dir = "uploads/";
	$target_file2 = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
	// Check if file already exists
	if (file_exists($target_file2)) {
	$info2 = "Sorry, file already exists.";
	$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	$info2 = $info2."Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
    $info2 = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload2"]["name"])). " has been uploaded.";
	//////////////////////////////////////
	$sql = "UPDATE data SET background='".$target_file2."' WHERE id='".$_POST["Id"]."'";

	if (mysqli_query($conn, $sql)) {
	$info2 = $info2."Background Updated Successfully";
	} 
	else {
	$info2 = $info2."Error Updating Background: " . mysqli_error($conn);
	}
	//////////////////////////////////////
	} 
	else {
    $info2 = "Sorry, there was an error uploading your file.";
	}
	}
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
	<h1>Update Education</h1>
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

if($info2 != "")
{
	?><div class="info">
  <p><strong>Info2: </strong><?php echo $info2;?></p>
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

<form action="update.php" method="post">
	<fieldset>
	<legend><b>Fetch Education</b></legend>
	<label>ID</label>
    <input type="text" name="Id" placeholder="Enter Id..." value="<?php echo $Id;?>" required>
	<input type="submit" name="Fetch" value="Fetch" class="btn">
	</fieldset>
</form>
<br>
<form action="update.php" method="post" enctype="multipart/form-data">
	<fieldset>
	<legend><b>Information</b></legend>
	
	<input type="hidden" name="Id" placeholder="Enter Id To Update..." value="<?php echo $Id;?>" required>
	
    <label>Name</label>
    <input type="text" name="Name" placeholder="Enter Name.." value="<?php echo $Name;?>" required>
	
	<label>Name Abbreviation</label>
    <input type="text" name="NameA" placeholder="Enter Name Abbreviation.." value="<?php echo $NameA;?>" required>

    <label>Education</label>
    <input type="text" name="Education" placeholder="Enter Education.." value="<?php echo $Education;?>" required>
	
	<label>Education Abbreviation</label>
    <input type="text" name="EducationA" placeholder="Enter Education.." value="<?php echo $EducationA;?>" required>
	
	<label>Fees</label>
    <input type="text" name="Fees" placeholder="Enter Fees.." value="<?php echo $Fees;?>" required>
	</fieldset>
	
	
	<br>
	<fieldset>
	<legend><b>Select</b></legend>
	<label>Admission</label>
    <select name="Admission">
		<option value="<?php echo $Admission;?>"><?php echo $Admission;?></option>
		<option value="Open">Open</option>
		<option value="Close">Close</option>
    </select>
	
	<label>Type</label>
    <select name="Type">
		<option value="<?php echo $Type;?>"><?php echo $Type;?></option>
		<option value="School">School</option>
		<option value="Collage">Collage</option>
		<option value="University">University</option>
    </select>
	
	<label>System</label>
    <select name="System">
		<option value="<?php echo $System;?>"><?php echo $System;?></option>
		<option value="Semester">Semester</option>
		<option value="Monthly">Monthly</option>
		<option value="Yearly">Yearly</option>
    </select>
	
	<label>Location</label>
    <select name="Location">
		<option value="<?php echo $Location;?>"><?php echo $Location;?></option>
		<option value="Tower">Tower</option>
		<option value="Steel Town">Steel Town</option>
    </select>
	</fieldset>
	
	
	
	<br>
	<fieldset>
	<legend><b>Contact</b></legend>
	<label>Mobile</label>
    <input type="text" name="Mobile" placeholder="Enter Mobile.." value="<?php echo $Mobile;?>" required>
	
	<label>Email</label>
    <input type="text" name="Email" placeholder="Enter Email.." value="<?php echo $Email;?>" required>
	
	<label>Website</label>
    <input type="text" name="Website" placeholder="Enter Website.." value="<?php echo $Website;?>" required>
	
	<label>Address</label>
    <input type="text" name="Address" placeholder="Enter Address.." value="<?php echo $Address;?>" required>
	</fieldset>
	
	<br>
	<fieldset>
	<legend><b>Google Map</b></legend>
	<label>Longitude</label>
    <input type="text" name="Longitude" placeholder="Enter Longitude.." value="<?php echo $Longitude;?>" required>
	
	<label>Latitude</label>
    <input type="text" name="Latitude" placeholder="Enter Latitude.." value="<?php echo $Latitude;?>" required>
	</fieldset>
	
	
	<br>
	<fieldset>
	<legend><b>Description</b></legend>
    <textarea name="Description" placeholder="Write Description.." style="height:200px" required><?php echo $Description;?></textarea>
	</fieldset>
	
	<br>
	<fieldset>
	<legend><b>Images</b></legend>
	<label>Logo</label>
	<input type="file" name="fileToUpload1" class="btn">
	
	<label>Background</label>
	<input type="file" name="fileToUpload2" class="btn">
	</fieldset>
	
	<br>
    <input type="submit" name="Update" value="Update" class="btn">
</form>
  <br>
  <button class="btn" onclick="document.location='index.php'">Home</button>
</div>

</body>
</html>
