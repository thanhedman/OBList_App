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
$page = $_GET['page']; // get the requested page 
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_REQUEST['sidx']; // get index row - i.e. user click to sort
$sord = $_REQUEST['sord']; // get the direction 
if(!$sidx) $sidx =1;

//Runtime time replace the slashes as magic_guotes_gpc is on  
if (get_magic_quotes_gpc()) {
    function stripslashes_gpc(&$value)
    {
        $value = stripslashes($value);
    }    
    array_walk_recursive($_REQUEST, 'stripslashes_gpc');
}
$searchDataArr = json_decode($_REQUEST['filters'],true);

//Get all search parameter and set Conditions
$where="WHERE category='upcoming'";
 if ($searchDataArr['rules']) {
	foreach ($searchDataArr['rules'] as $searchData) {
		if (!empty($searchData['data'])) {
			if ($searchData['field']=='lastName' OR $searchData['field']=='firstName')
			{
				$searchData['field'] = 'AES_DECRYPT(' . $searchData['field'];
				$searchData['field'] .= ",  'dRyuJRquMf7z3D' )";
			}	
				$where .= " AND ".$searchData['field']. " like '".$searchData['data']."%'";		   
		}
	}
}
 
$upcoming = array();
 // Create connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
  
$result = $con->query("SELECT id, AES_DECRYPT(lastName, 'dRyuJRquMf7z3D') AS lastName, AES_DECRYPT( firstName, 'dRyuJRquMf7z3D') AS firstName, edd, g, p, dob, MD, rh, gbs, prenatal, tdap FROM master ".$where." ORDER BY ".$sidx." ".$sord);
$i=0;
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$upcoming[$i]->id = $row['id'];
	$upcoming[$i]->lastName = $row['lastName'];
	$upcoming[$i]->firstName = $row['firstName'];
	$upcoming[$i]->edd = $row['edd'];
	$upcoming[$i]->g = $row['g'];
	$upcoming[$i]->p = $row['p'];
	$birthDate = $row['dob'];
    //explode the date to get month, day and year
    $birthDate = explode("-", $birthDate);
    //get age from date and birthdate
    $upcoming[$i]->age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
	$upcoming[$i]->MD = $row['MD'];
	$upcoming[$i]->rh = $row['rh'];
	$upcoming[$i]->gbs = $row['gbs'];
	$upcoming[$i]->prenatal = $row['prenatal'];
	$upcoming[$i]->tdap = $row['tdap'];
	$i++;
}
$records = count($upcoming);
$total = ceil($records / $limit);

$response->total = $total;
$response->page = $page;
$response->records = $records;


$j=0;
$i=(($page - 1) * $limit);
while($j < $limit) {
	$response->rows[$j]['id']=$upcoming[$i]->id; 	  
	$response->rows[$j]['cell']=array($upcoming[$i]->id,$upcoming[$i]->lastName,$upcoming[$i]->firstName,$upcoming[$i]->edd, $upcoming[$i]->g, $upcoming[$i]->p, $upcoming[$i]->age, $upcoming[$i]->MD, $upcoming[$i]->rh, $upcoming[$i]->gbs, $upcoming[$i]->prenatal, $upcoming[$i]->tdap);
	$i++;
	$j++;
} 
echo json_encode($response);
}
//login fail
else {
   echo 'You are not authorized to access this page, please login. <br/>';
}
