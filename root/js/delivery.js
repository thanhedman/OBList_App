function delivered(table) {
	var row = jQuery(table).jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var add1 = 'php/delivery.php?id='
		var patientID = row;
		window.location.href = add1+patientID;
	} 
	else { 
		alert("Please select row");
	} 
}