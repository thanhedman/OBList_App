<?php
//security section
// Includes
include 'db_connect.php';
include 'sec_functions.php';
//secure session start
sec_session_start();
//login check
if(login_check($mysqli) == true) {
//protected content
if(isset($_GET['tab']))
	{
	$tab = $_GET['tab'];
	}
else
	{
	$tab = 1;
	}
// Create connection
$con = mysqli_connect("oblist.db.11509220.hostedresource.com","oblist","Enshin17@","oblist");
// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$hospCount = array();
$mdCount = array();  
$result = $con->query("SELECT COUNT(id) FROM master WHERE ((category ='upcoming' OR category='labor')) AND MD = 'AR'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$mdCount[0] = $row['COUNT(id)'];
$result = $con->query("SELECT COUNT(id) FROM master WHERE ((category ='upcoming' OR category='labor')) AND MD = 'GH'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$mdCount[1] = $row['COUNT(id)'];
$result = $con->query("SELECT COUNT(id) FROM master WHERE ((category ='upcoming' OR category='labor')) AND MD = 'HC'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$mdCount[2] = $row['COUNT(id)'];
$result = $con->query("SELECT COUNT(id) FROM master WHERE ((category ='upcoming' OR category='labor')) AND MD = 'HF'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$mdCount[3] = $row['COUNT(id)'];
$result = $con->query("SELECT COUNT(id) FROM master WHERE ((category ='upcoming' OR category='labor')) AND MD = 'JZ'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$mdCount[4] = $row['COUNT(id)'];
$result = $con->query("SELECT COUNT(id) FROM master WHERE ((category ='upcoming' OR category='labor')) AND MD = 'LS'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$mdCount[5] = $row['COUNT(id)'];
$result = $con->query("SELECT COUNT(id) FROM master WHERE category ='labor' AND hospital = 'SRMC'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$hospCount[0] = $row['COUNT(id)'];
$result  = $con->query("SELECT COUNT(id) FROM master WHERE category ='labor' AND hospital = 'PAH'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$hospCount[1] = $row['COUNT(id)'];
$result  = $con->query("SELECT COUNT(id) FROM master WHERE category ='labor' AND hospital = 'RMC'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$hospCount[2] = $row['COUNT(id)'];
$result  = $con->query("SELECT COUNT(id) FROM master WHERE category ='labor' AND hospital = 'CRAH'");
$row = $result->fetch_array(MYSQLI_ASSOC);
$hospCount[3] = $row['COUNT(id)'];
echo "
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
	<title>mOB-GYN Demo</title>
	<link rel=\"stylesheet\" href=\"http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css\" />
	<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/ui.jqgrid.css\" />
	<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/frontpagetest.css\" />
	<script src=\"js/jquery-1.9.0.min.js\" type=\"text/javascript\"></script>
	<script src=\"js/i18n/grid.locale-en.js\" type=\"text/javascript\"></script>
	<script type=\"text/javascript\" src=\"http://code.jquery.com/ui/1.10.3/jquery-ui.js\"></script>
	<script src=\"js/jquery.jqGrid.min.js\" type=\"text/javascript\"></script>
	<script src=\"js/tablecontroller.js\" type=\"text/javascript\"></script>
	<script src=\"js/movehandler.js\" type=\"text/javascript\"></script>
	<script src=\"js/searchhandler.js\" type=\"text/javascript\"></script>
	<script src=\"js/jquery.searchFilter.js\" type=\"text/javascript\"></script>
	<script src=\"js/detailrequest.js\" type=\"text/javascript\"></script>
	<script src=\"js/delivery.js\" type=\"text/javascript\"></script>
	<script src=\"js/bill.js\" type=\"text/javascript\"></script>
	<script src=\"js/circ.js\" type=\"text/javascript\"></script>
	<script src=\"js/timeout.js\" type=\"text/javascript\"></script>
	<script>
	$(function() {
		$( \"#tabs\" ).tabs({active: $tab});
	});
	</script>
</head>
<body onload=\"populateLabor(); populateUpcoming(); populateDelivered(); populateSearch(); populateBilled();\">
<div id=\"tabs\">
	<ul>
		<li><a href=\"#tabs-1\" onclick=\"$('#upcomingEDD').trigger('reloadGrid')\" id=\"tab1\">Watch List</a></li>
		<li><a href=\"#tabs-2\" onclick=\"$('#inLabor').trigger('reloadGrid')\" id=\"tab2\">Antepartum/Labor</a></li>
		<li><a href=\"#tabs-3\" onclick=\"$('#delivered').trigger('reloadGrid')\" id=\"tab3\">Delivered</a></li>
		<li><a href=\"#tabs-5\" onclick=\"$('#billed').trigger('reloadGrid')\" id=\"tab5\">Billed</a></li>
		<li><a href=\"#tabs-4\" onclick=\"$('#searchResults').trigger('reloadGrid')\" id=\"tab4\">Search</a></li>
		<li><a href=\"#tabs-6\" id=\"tab6\">Dashboard</a></li>
	</ul>
<div id=\"tabs-1\" class=\"tabs\">
	<table id=\"upcomingEDD\"></table> 
	<div id=\"upcomingPager\"></div>
	<div style=\"text-align:center;\">
		<input type=\"BUTTON\" id=\"labor1\" value=\"Mark In Labor\" onclick=\"upcomingToLabor()\" class=\"buttons\" />
		<input type=\"BUTTON\" id=\"udelivered\" value=\"Mark Delivered\" onclick=\"delivered('#upcomingEDD')\" class=\"buttons\" /><br>
		<input type=\"BUTTON\" id=\"detail1\" value=\"Details\" onclick=\"patientDetail('#upcomingEDD')\" class=\"buttons\"/>
		
	</div>
</div>
<div id=\"tabs-2\" class=\"tabs\">
	<table id=\"inLabor\"></table>
	<div id=\"laborPager\"></div>
	<div style=\"text-align:center;\">
		<input type=\"BUTTON\" id=\"del\" value=\"Mark Delivered\" onclick=\"delivered('#inLabor')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"edd\" value=\"Mark Not In Labor\" onclick=\"laborToUpcoming()\" class=\"buttons\"/><br>
		<input type=\"BUTTON\" id=\"detail2\" value=\"Details\" onclick=\"patientDetail('#inLabor')\" class=\"buttons\"/>
	</div>
</div>
<div id=\"tabs-3\" class=\"tabs\">
	<table id=\"delivered\"></table> 
	<div id=\"deliveredPager\"></div>
	<div style=\"text-align:center;\">
		<input type=\"BUTTON\" id=\"labor\" value=\"Mark In Labor\" onclick=\"deliveredToLabor()\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"billedbutton\" value=\"Mark Billed\" onclick=\"bill('#delivered')\" class=\"buttons\"/><br>
		<input type=\"BUTTON\" id=\"detail3\" value=\"Details\" onclick=\"patientDetail('#delivered')\" class=\"buttons\"/>
	</div>
</div>
<div id=\"tabs-5\" class=\"tabs\">
	<table id=\"billed\"></table> 
	<div id=\"billedPager\"></div>
	<div style=\"text-align:center;\">
		<input type=\"BUTTON\" id=\"laborbutton\" value=\"Mark Unbilled\" onclick=\"billedToDelivered()\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"circ\" value=\"Mark Circ Billed\" onclick=\"circ('#billed')\" class=\"buttons\"/><br>
		<input type=\"BUTTON\" id=\"detail4\" value=\"Details\" onclick=\"patientDetail('#billed')\" class=\"buttons\"/>
	</div>
</div>
<div id=\"tabs-4\" class=\"tabs\">
	<table id=\"searchResults\"></table>
	<div id=\"searchPager\"></div>
	<div style=\"text-align:center;\">
		<input type=\"BUTTON\" id=\"toedd\" value=\"Add to Watch List\" onclick=\"assignTo('upcoming')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"tolabor\" value=\"Add to Imminent Labor\" onclick=\"assignTo('labor')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"todel\" value=\"Mark Delivered\" onclick=\"delivered('#searchResults')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"detail5\" value=\"Details\" onclick=\"patientDetail('#searchResults')\" class=\"buttons\"/>
	</div>
</div>
<div id=\"tabs-6\" class=\"tabs\">
<h3>Current Labor/Antepartum Patients by Hospital</h3><br>
<table class=\"dashboard\" border='1'>
<td><b>SRMC</b></td><td><b>PAH</b></td><td><b>RMC</b></td><td><b>CRAH</b></td>
<tr><td>".$hospCount[0]."</td><td>".$hospCount[1]."</td><td>".$hospCount[2]."</td><td>".$hospCount[3]."</td></table><br>
<h3>Patients Due in the Next 4 Weeks by MD</h3><br>
<table class=\"dashboard\" border='1'>
<td><b>AR</b></td><td><b>GH</b></td><td><b>HC</b></td><td><b>HF</b></td><td><b>JZ</b></td><td><b>LS</b></td>
<tr><td>".$mdCount[0]."</td><td>".$mdCount[1]."</td><td>".$mdCount[2]."</td><td>".$mdCount[3]."</td><td>".$mdCount[4]."</td><td>".$mdCount[5]."</td></table><br>
<h3>Labor and Delivery Contact Information</h3><br>
<ul><li>Sky Ridge Medical Center: 720-225-2300</li>
<li>Parker Adventist Hospital: 720-225-2300</li>
<li>Rose Medical Center: 720-225-2300</li>
<li>Castle Rock Adventist Hospital: 720-225-2300</li></ul>
</div>
</div>
<input type=\"BUTTON\" id=\"upload\" value=\"Upload OB List\" onclick=\"window.location.href = 'http://mob-gyn.com/upload.php'\" class=\"buttons\"/>
<input type=\"BUTTON\" id=\"upload\" value=\"Logout\" onclick=\"window.location.href = 'http://mob-gyn.com/logout.php'\" class=\"buttons\"/>
</body>";
}
//login fail
else {
   header('Location: login.html');
}