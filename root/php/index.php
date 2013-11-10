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
		<li><a href=\"#tabs-2\" onclick=\"$('#inLabor').trigger('reloadGrid')\" id=\"tab2\">Imminent Labor</a></li>
		<li><a href=\"#tabs-3\" onclick=\"$('#delivered').trigger('reloadGrid')\" id=\"tab3\">Delivered</a></li>
		<li><a href=\"#tabs-5\" onclick=\"$('#billed').trigger('reloadGrid')\" id=\"tab5\">Billed</a></li>
		<li><a href=\"#tabs-4\" onclick=\"$('#searchResults').trigger('reloadGrid')\" id=\"tab4\">Search</a></li>
	</ul>
<div id=\"tabs-1\" class=\"tabs\">
	<table id=\"upcomingEDD\"></table> 
	<div id=\"upcomingPager\"></div>
	<div style=\"text-align:center;\">
		<input type=\"BUTTON\" id=\"labor1\" value=\"Mark In Labor\" onclick=\"upcomingToLabor()\" class=\"buttons\" />
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
		<input type=\"BUTTON\" id=\"toedd\" value=\"Add to Watch List\" onclick=\"assignPatient('upcoming')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"tolabor\" value=\"Add to Imminent Labor\" onclick=\"assignPatient('labor')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"todel\" value=\"Mark Delivered\" onclick=\"assignPatient('delivered')\" class=\"buttons\"/>
		<input type=\"BUTTON\" id=\"detail5\" value=\"Details\" onclick=\"patientDetail('#searchResults')\" class=\"buttons\"/>
	</div>
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