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
$patientArray = array();

function fgetcsv_PHP()
{
$id = 0;
$lastName = 1;
$firstName = 2;
$edd = 3;
$weeks = 4;
$g = 5;
$p = 6;
$prenatal = 7;
$dob = 8;
$MD = 9;
$hospital = 10;
$insurance = 11;
$problemList = 12;
$problemListDate = 13;
$tdap = 14;
$gbs = 15;
$rh = 16;
$babySex = 17;
$notes = 18;
$age = 19;
$dateDel = 20;
$dateBilled = 21;
$mdNotified = 22;
$cirBilled = 23;
$oop = 24;
$transMab = 25;
$delMd = 26;
    /*
     * See if we can open a file named oblisttest in
     * read mode, if we can then assign pointer to this
     * file to a variable named $handle
     * 'r' - Open for reading only; place the file
     *  pointer at the beginning of the file.
     */
    if (($handle = fopen("oblisttest.csv", "r")) !== FALSE)
    {
        /*
         * fgetcsv( resource $handle  int $length  string $delimiter )
         *
         * resource $handle
         * A valid file pointer to a file successfully opened by fopen(),
         * popen(), or fsockopen().
         *
         * int $length
         * Must be greater than the longest line (in characters) to be
         * found in the CSV file (allowing for trailing line-end characters).
         * It became optional in PHP 5. Omitting this parameter (or setting
         * it to 0 in PHP 5.0.4 and later) the maximum line length is not
         * limited, which is slightly slower.
         *
         * string $delimiter
         * Set the field delimiter (one character only).
         *
         * RETURN VALUES
         *
         * Returns an indexed array containing the fields read.
         *
         * Note: A blank line in a CSV file will be returned as an array
         *       comprising a single null field, and will not be treated
         *       as an error.
         *
         * Note: If PHP is not properly recognizing the line endings when
         *       reading files either on or created by a Macintosh computer,
         *       enabling the auto_detect_line_endings run-time configuration
         *       option may help resolve the problem.
         *
         * fgetcsv() returns NULL if an invalid handle is supplied or FALSE
         * on other errors, and when the end of file has been reached.
         */
 
 
        $length = 1000;
        $delimiter = ",";

		$i = 0;
		$j = 0;
        /*
         * Loop through the array of values returned by fgetcsv until there are
         * no more lines (indicated by FALSE)
         */
        while ( ( $data = fgetcsv( $handle, $length, $delimiter ) ) !== FALSE )
        {
			if (j>0){
            // Count number of array elements in $data
            $num = count($data);
            // Read each row into patient array
			$patientArray[$i]->id = $data[$id];
			$patientArray[$i]->lastName = $data[$lastName];
			$patientArray[$i]->firstName = $data[$firstName];
			$patientArray[$i]->edd = date("Y-m-d", strtotime($data[$edd]));
			$patientArray[$i]->g = $data[$g];
			$patientArray[$i]->p = $data[$p];
			$patientArray[$i]->prenatal = $data[$prenatal];
			$patientArray[$i]->dob = date("Y-m-d", strtotime($data[$dob]));
			$patientArray[$i]->MD = $data[$MD];
			$patientArray[$i]->hospital = $data[$hospital];
			$patientArray[$i]->insurance = $data[$insurance];
			$patientArray[$i]->problemList = $data[$problemList];
			if ($data[$problemListDate]>0) {$patientArray[$i]->problemListDate = date("Y-m-d", strtotime($data[$problemListDate]));}
			else {$patientArray[$i]->problemListDate = $data[$problemListDate];}
			$patientArray[$i]->tdap = $data[$tdap];
			$patientArray[$i]->gbs = $data[$gbs];
			$patientArray[$i]->rh = $data[$rh];
			$patientArray[$i]->babySex = $data[$babySex];
			$patientArray[$i]->notes = $data[$notes];
			if ($data[$dateDel]>0) {$patientArray[$i]->dateDel = date("Y-m-d", strtotime($data[$dateDel]));}
			else {$patientArray[$i]->dateDel = $data[$dateDel];}
			if ($data[$dateBilled]>0) {$patientArray[$i]->dateBilled = date("Y-m-d", strtotime($data[$dateBilled]));}
			else {$patientArray[$i]->dateBilled = $data[$dateBilled];}
			if ($data[$cirBilled]>0) {$patientArray[$i]->cirBilled = date("Y-m-d", strtotime($data[$cirBilled]));}
			else {$patientArray[$i]->cirBilled = $data[$cirBilled];}
			$patientArray[$i]->oop = $data[$oop];
			if ($data[$transMab]>0) {$patientArray[$i]->transMab = date("Y-m-d", strtotime($data[$transMab]));}
			else {$patientArray[$i]->transMab = $data[$transMab];}
			$patientArray[$i]->delMD = $data[$delMD];
			$i++;}
			$j++;

        }
 

        // Close the file pointed to by $handle
        fclose($handle);

    }
	else
	{
	echo "File not found";
	}
 // Create connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//recreate TempCSV
$con->query("DROP TABLE IF EXISTS tempCSV;");
$con->query("CREATE TABLE tempCSV like master;");
//backup master
$con->query("DROP TABLE IF EXISTS masterBackup");
$con->query("CREATE TABLE masterBackup like master;");
$con->query("INSERT INTO masterBackup SELECT * FROM master;");
// Loops through each patient, adding to db
foreach ($patientArray as $patient)
	{
	$con->query("INSERT INTO tempCSV (id, lastName, firstName, edd, g, p, prenatal, dob, MD, hospital, insurance, problemList, problemListDate, tdap, gbs, rh, babySex, notes, dateDel, dateBilled, mdNotified, cirBilled, oop, transMab, delMD)
VALUES ('$patient->id', AES_ENCRYPT('$patient->lastName', 'dRyuJRquMf7z3D'), AES_ENCRYPT('$patient->firstName', 'dRyuJRquMf7z3D'), '$patient->edd', '$patient->g', '$patient->p', '$patient->prenatal', '$patient->dob', '$patient->MD', '$patient->hospital', '$patient->insurance', '$patient->problemList', '$patient->problemListDate', '$patient->tdap', '$patient->gbs', '$patient->rh', '$patient->babySex', '$patient->notes', '$patient->dateDel', '$patient->dateBilled', '$patient->mdNotified', '$patient->cirBilled', '$patient->oop', '$patient->transMab', '$patient->delMD');");
	}
//set upcoming where EDD in 4 weeks or less	
$con->query("UPDATE tempCSV
SET category='upcoming'
WHERE DATE( edd ) < ADDDATE( CURDATE( ) , INTERVAL 4
WEEK ) AND category='' ;");
//copy master to masterTest
$con->query("DROP masterTest;");
$con->query("CREATE TABLE masterTest like master;");
$con->query("INSERT INTO masterTest SELECT * FROM master;");
//set category in tempCSV where already set in masterTest
$con->query("UPDATE tempCSV t 
INNER JOIN masterTest m 
	ON t.id = m.id
SET t.category = m.category;");

//update masterTest with tempCSV where pt exists in masterTest
$con->query("UPDATE masterTest m 
INNER JOIN tempCSV t 
	ON m.id = t.id
SET m.edd = t.edd, m.prenatal = t.prenatal, m.dob = t.dob, m.MD = t.MD, m.hospital = t.hospital,
m.insurance = t.insurance, m.problemList = t.problemList, m.problemListDate = t.problemListDate, 
m.tdap = t.tdap, m.gbs = t.gbs, m.rh = t.rh, m.babySex = t.babySex, m.notes = t.notes, 
m.dateDel = t.dateDel, m.dateBilled = t.dateBilled, m.cirBilled = t.cirBilled, m.oop = t.oop,
m.transMab = t.transMab, m.delMd = t.delMd;");

//insert tempCSV into masterTest where pt doesn't exist in masterTest
$con->query("INSERT INTO masterTest (id, lastName, firstName, edd, g, p, prenatal, dob, MD, hospital, insurance, problemList, problemListDate, tdap, gbs, rh, babySex, notes, dateDel, dateBilled, mdNotified, cirBilled, oop, transMab, delMD, category)
SELECT t.id, t.lastName, t.firstName, t.edd, t.g, t.p, t.prenatal, t.dob, t.MD, t.hospital, t.insurance, t.problemList, t.problemListDate, t.tdap, t.gbs, t.rh, t.babySex, t.notes, t.dateDel, t.dateBilled, t.mdNotified, t.cirBilled, t.oop, t.transMab, t.delMD, t.category
    FROM tempCSV t
    LEFT OUTER JOIN masterTest m
        ON t.id = m.id
    WHERE m.id IS NULL");
//update category where delivered (based on date)
$con->query("UPDATE masterTest
SET category = 'delivered'
WHERE dateDel > 1969-12-31;");
//update category where transferred (based on date)
$con->query("UPDATE masterTest
SET category = 'billed'
WHERE transMab > 1969-12-31;");
//update category where billed (based on date)
$con->query("UPDATE masterTest
SET category = 'billed'
WHERE dateBilled > 1969-12-31;");
//Display number of patients added
$j = $i - 1;
		echo "$i patients found";
		echo "<br>First listed patient: <br>";
		echo $patientArray[0]->lastName;
		echo "<br>Last listed patient: <br>";
		echo $patientArray[$j]->lastName;
		echo "<br><form action=\"enterCSV.php\" method=\"post\" name=\"entry_form\">
		<div>Submit data?</div><br>
   <input type=\"submit\" value=\"Yes\"/>
   <input type=\"button\" value=\"No\" onclick=\"location.href='/home/content/20/11509220/html/upload.html'\"/>
</form>";
//drop tempCSV
$con->query("DROP TABLE IF EXISTS tempCSV;");
mysqli_close($con);
}
fgetcsv_PHP();
}
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}