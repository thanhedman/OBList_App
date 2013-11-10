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
$id = $_GET['id'];
$where = "WHERE id = $id";
 // Create connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  
$result = $con->query("SELECT * FROM master ".$where." LIMIT 1;");
$row = $result->fetch_array(MYSQLI_ASSOC);
	$edd = $row['edd'];
	$g = $row['g'];
	$p = $row['p'];
	$MD = $row['MD'];
	$dob = $row['dob'];
    //explode the date to get month, day and year
    $birthDate = explode("-", $dob);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
	$gbs = $row['gbs'];
	$rh = $row['rh'];
	$problemList = $row['problemList'];
	$problemListDate = $row['problemListDate'];
	$insurance = $row['insurance'];
	$hospital = $row['hospital'];
	$oop = $row['oop'];
	$dateDel= $row['dateDel'];
	$delMD = $row['delMD'];
	$delBilled = $row['delBilled'];
	$cirBilled = $row['cirBilled'];
	$transMab = $row['transMab'];
	$babySex = $row['babySex'];
	$tdap = $row['tdap'];
	$prenatal = $row['prenatal'];
	$notes = $row['notes'];
	$secondaryIns = $row['secondaryIns'];
	
$result = $con->query("SELECT AES_DECRYPT(lastName, 'dRyuJRquMf7z3D') AS lastName, AES_DECRYPT(firstName, 'dRyuJRquMf7z3D') AS firstName FROM master ".$where." LIMIT 1;");
$row = $result->fetch_array(MYSQLI_ASSOC);
	$lastName = $row['lastName'];
	$firstName = $row['firstName'];

echo "<h1>Patient: $firstName &nbsp $lastName </h1>\n";
echo "<h2>Basic</h2>\n";
echo "<table border='1'>\n";
echo "<td><b>EDD</b></td><td><b>MD</b></td><td><b>Hospital</b></td><td><b>DOB</b></td><td><b>Age</b></td>";
echo "<tr>\n";
echo "<td>$edd</td><td>$MD</td><td>$hospital</td><td>$dob</td><td>$age</td>\n";
echo "</table>\n";
echo "<h2>Medical</h2>\n";
echo "<table border='1'>\n";
echo "<td><b>G</b></td><td><b>P</b></td><td><b>GBS</b></td><td><b>RH</b></td><td><b>Problem List</b></td><td><b>Problem List Effective</b></td>";
echo "<tr>\n";
echo "<td>$g</td><td>$p</td><td>$gbs</td><td>$rh</td><td>$problemList</td><td>$problemListDate</td>\n";
echo "</table>\n";
echo "<h2>Billing</h2>\n";
echo "<table border='1'>\n";
echo "<td><b>Insurance</b></td><td><b>Secondary</b></td><td><b>OOP</b></td><td><b>Delivered</b></td><td><b>Del. MD</b></td><td><b>Billed</b></td><td><b>Circ Billed</b></td><td><b>Trans/MAB</b></td>";
echo "<tr>\n";
echo "<td>$insurance</td><td>$secondaryIns</td><td>$oop</td><td>$dateDel</td><td>$delMD</td><td>$dateBilled</td><td>$cirBilled</td><td>$transMab</td>\n";
echo "</table>\n";
echo "<h2>Misc</h2>\n";
echo "<table border='1'>\n";
echo "<td><b>Baby Sex</b></td><td><b>TDAP</b></td><td><b>Prenatal</b></td><td><b>Notes</b></td>";
echo "<tr>\n";
echo "<td>$babySex</td><td>$tdap</td><td>$prenatal</td><td>$notes</td>\n";
echo "</table>\n";
echo "<a href='http://mob-gyn.com/'> [Back to Home] </a>";
}
//login fail
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}