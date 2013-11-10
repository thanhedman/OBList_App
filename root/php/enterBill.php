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
$dateBilled = $_POST["dateBilled"];
 // Create connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//update delivered date and delivering MD for patient ID
$con->query("UPDATE master
SET dateBilled='$dateBilled', category='billed'
WHERE id=$id;");
header("Location: http://mob-gyn.com/index.php");
}

//login fail
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}
