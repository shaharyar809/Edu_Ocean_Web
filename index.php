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

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["Logout"])){
	// destroy the session
	session_destroy();
	header("Location: login.php");
	exit;
}

//mysqli_close($conn);
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

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  //border: 1px solid #ddd;
}

th, td{
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: black;color: white;}
tr:nth-child(odd){background-color: #00B4DB;color: white;}

</style>
</head>
<body>

<div class="container">


<div class="info">
	<h1>Admin Panel</h1>
</div>

<div style="overflow: auto; //height:400px; margin-bottom: 0px; padding: 0px 0px;">
<fieldset>
	<legend><b>Table View</b></legend>
	<table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Education</th>
      <th>Admission</th>
      <th>Tpye</th>
      <th>Location</th>
      <th>Mobile</th>
      <th>Email</th>
    </tr>
	<?php
	
	$sql = "SELECT * FROM data";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	// output data of each row $row["id"]
	while($row = mysqli_fetch_assoc($result)) {
    ?><?php echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."(".$row["namea"].")"."</td><td>".$row["education"]."(".$row["educationa"].")"."</td>
	<td>".$row["addmission"]."</td><td>".$row["type"]."</td><td>".$row["location"]."</td><td>".$row["mobile"]."</td>
	<td>".$row["email"]."</td></tr>";?><?php
	}
	} else {
	echo "0 results";
	}
	mysqli_close($conn);
	?>
	</table>

</fieldset>
</div>
<br>
<fieldset>
	<legend><b>Admin Tools</b></legend>
  <button class="btn" onclick="document.location='insert.php'">Insert</button>
  <br>
  <br>
  <button class="btn" onclick="document.location='update.php'">Update</button>
  <br>
  <br>
  <button class="btn" onclick="document.location='delete.php'">Delete</button>
  <br>
  <br>
  <button class="btn" onclick="document.location='notice.php'">Notice Board</button>
  <br>
  <br>
  <form action="index.php" method="post">
	<input type="submit" name="Logout" value="Logout" class="btn">
  </form>
 </fieldset>

</div>
</body>
</html>
