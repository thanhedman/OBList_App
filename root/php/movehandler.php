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
//Get patient ID, origin category and destination category
$id = $_POST["id"];
$origin = $_POST["origin"];
$destination = $_POST["destination"];
//SQL connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//check if patient is still in origin category
$result = $con->query("SELECT category FROM master 
WHERE id=$id");
$row = $result->fetch_array(MYSQLI_ASSOC);
$currentCategory = $row['category'];
//change category to destination
if ($currentCategory == $origin OR $origin=='1')
{
$con->query("UPDATE master
SET category='$destination'
WHERE id=$id");
}
//fudge for direct move from search results
if ($origin=='1')
{
$origin = $currentCategory;
}
if ($origin == 'delivered' && $destination != 'billed')
{
$con->query("UPDATE master
SET delMD='', dateDel='0000-00-00', p=p-1
WHERE id=$id");
}
if ($origin == 'billed')
{
if ($destination != 'delivered'){
$con->query("UPDATE master
SET dateBilled='0000-00-00', cirBilled='0000-00-00', delMD='', dateDel='0000-00-00', p=p-1
WHERE id=$id");
}
else{
$con->query("UPDATE master
SET dateBilled='0000-00-00', cirBilled='0000-00-00'
WHERE id=$id");
}
}
//close connection
mysqli_close($con);
}
//login fail
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}