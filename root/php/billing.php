<?php
//security section
// Includes
$db_connect = $_SERVER['DOCUMENT_ROOT'];
$db_connect .= "/db_connect.php";
include($db_connect);
$sec_functions = $_SERVER['DOCUMENT_ROOT'];
$sec_functions .= "/sec_functions.php";
include($sec_functions);
//secure session start
sec_session_start();
//login check
if(login_check($mysqli) == true) {
//protected content
//Get patient ID
$id = $_GET["id"];
$where = "WHERE id = $id";

// Create connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  
$result = $con->query("SELECT AES_DECRYPT(lastName, 'dRyuJRquMf7z3D') AS lastName, AES_DECRYPT(firstName, 'dRyuJRquMf7z3D') AS firstName FROM master ".$where." LIMIT 1;");
$row = $result->fetch_array(MYSQLI_ASSOC);
	$lastName = $row['lastName'];
	$firstName = $row['firstName'];
echo "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/my_forms.css\" />";
//Display patient name
echo "<h1>Patient: $firstName &nbsp $lastName </h1>\n";
//Billing form
echo "<form action=\"enterBill.php?id=$id\" method=\"post\" name=\"billingForm\">
  <label>Date</label><br> <input type=\"date\" name=\"dateBilled\" required/><br />
   <input type=\"submit\" value=\"Submit\"/><input type=\"button\" value=\"Cancel\" onclick=\"window.location.href = 'http://mob-gyn.com'\"/>
</form>";
}
//login fail
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}