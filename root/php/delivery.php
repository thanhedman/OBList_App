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
//Display patient name
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
echo "<h1>Patient: $firstName &nbsp $lastName </h1>\n";
//Delivery form
echo "<form action=\"enterDelivery.php?id=$id\" method=\"post\" name=\"deliveryForm\">
   <label>Delivering MD:</label><br> <select name=\"delMD\" id=\"delMD\"/><option value=\"AR\">AR</option><option value=\"GH\">GH</option><option value=\"HC\">HC</option><option value=\"HF\">HF</option><option value=\"JZ\">JZ</option><option value=\"LS\">LS</option></select><br />
   <label>Hospital:</label><br> <select name=\"hospital\" id=\"hospital\"><option value=\"SRMC\">SRMC</option><option value=\"RMC\">RMC</option><option value=\"PAH\">PAH</option><option value=\"CRAH\">CRAH</option></select><br />
   <label>Delivery Date:</label><br> <input type=\"date\" name=\"dateDel\" required/><br />
   <input type=\"submit\" value=\"Submit\"/><input type=\"button\" value=\"Cancel\" onclick=\"window.location.href = 'http://mob-gyn.com'\"/>
</form>";
}
//login fail
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}