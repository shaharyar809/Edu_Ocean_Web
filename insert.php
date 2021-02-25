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
/////////////////////////////
$info1 = "";
$info2 = "";
$info3 = "";
/////////////////////////
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
/////////////////////////////
if(isset($_POST["Insert"])){
	//////////////////
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
	////////////////////////
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
	$info2 = "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file2)) {
    $info2 = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload2"]["name"])). " has been uploaded.";
	} 
	else {
    $info2 = "Sorry, there was an error uploading your file.";
	}
	}
	/////////////////////////////////
	$sql = "INSERT INTO data (name, namea, education, educationa, fees, addmission, type, system, location, mobile, email, website, address, longitude, latitude, description, logo, background) 
	VALUES ('".$_POST["Name"]."', '".$_POST["NameA"]."', '".$_POST["Education"]."', '".$_POST["EducationA"]."', '".$_POST["Fees"]."', '".$_POST["Admission"]."', 
	'".$_POST["Type"]."', '".$_POST["System"]."', '".$_POST["Location"]."', '".$_POST["Mobile"]."', '".$_POST["Email"]."', 
	'".$_POST["Website"]."', '".$_POST["Address"]."', '".$_POST["Longitude"]."', '".$_POST["Latitude"]."', '".$_POST["Description"]."', '".$target_file1."', '".$target_file2."')";
	if (mysqli_query($conn, $sql)) 
	{
		$info3 = "New record created successfully";
	} else 
	{
		$info3 = "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
/////////////////////////////	
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
	<h1>Insert Education</h1>
</div>


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



  <form action="insert.php" method="post" enctype="multipart/form-data">
  
	<fieldset>
	<legend><b>Information</b></legend>
    <label>Name</label>
    <input type="text" name="Name" placeholder="Enter Name.." required>
	
	<label>Name Abbreviation</label>
    <input type="text" name="NameA" placeholder="Enter Name Abbreviation.." required>

    <label>Education</label>
    <input type="text" name="Education" placeholder="Enter Education.." required>
	
	<label>Education Abbreviation</label>
    <input type="text" name="EducationA" placeholder="Enter Education.." required>
	
	<label>Fees</label>
    <input type="text" name="Fees" placeholder="Enter Fees.." required>
	</fieldset>
	
	
	<br>
	<fieldset>
	<legend><b>Select</b></legend>
	<label>Admission</label>
    <select name="Admission">
      <option value="Open">Open</option>
      <option value="Close">Close</option>
    </select>
	
	<label>Type</label>
    <select name="Type">
      <option value="School">School</option>
      <option value="Collage">Collage</option>
      <option value="University">University</option>
    </select>
	
	<label>System</label>
    <select name="System">
      <option value="Semester">Semester</option>
      <option value="Monthly">Monthly</option>
      <option value="Yearly">Yearly</option>
    </select>
	
	<label>Location</label>
    <select name="Location">
      <option value="Tower">Tower</option>
	  <option value="Steel Town">Steel Town</option>
    </select>
	</fieldset>
	
	
	
	<br>
	<fieldset>
	<legend><b>Contact</b></legend>
	<label>Mobile</label>
    <input type="text" name="Mobile" placeholder="Enter Mobile.." required>
	
	<label>Email</label>
    <input type="text" name="Email" placeholder="Enter Email.." required>
	
	<label>Website</label>
    <input type="text" name="Website" placeholder="Enter Website.." required>
	
	<label>Address</label>
    <input type="text" name="Address" placeholder="Enter Address.." required>
	</fieldset>
	
	<br>
	<fieldset>
	<legend><b>Google Map</b></legend>
	<label>Longitude</label>
    <input type="text" name="Longitude" placeholder="Enter Longitude.." required>
	
	<label>Latitude</label>
    <input type="text" name="Latitude" placeholder="Enter Latitude.." required>
	</fieldset>
	
	
	<br>
	<fieldset>
	<legend><b>Description</b></legend>
    <textarea name="Description" placeholder="Write Description.." style="height:200px" required></textarea>
	</fieldset>
	
	<br>
	<fieldset>
	<legend><b>Images</b></legend>
	<label>Logo</label>
	<input type="file" name="fileToUpload1" class="btn" required>
	
	<label>Background</label>
	<input type="file" name="fileToUpload2" class="btn" required>
	</fieldset>
	
	<br>
    <input type="submit" name="Insert" value="Insert" class="btn">
  </form>
  <br>
  <button class="btn" onclick="document.location='index.php'">Home</button>
</div>

</body>
</html>
