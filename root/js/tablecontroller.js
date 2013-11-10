

function populateUpcoming(){
var w = $("#inLabor").width();
jQuery("#upcomingEDD").jqGrid({ 
	url:'php/upcoming.php',
	datatype: "json",
	height: "auto",
	rowNum:8,
	rowList:[8,20,40,80],
	sortname: 'edd',
	viewrecords: true,
	gridview: true,
	ignoreCase: true,
	sortorder: "desc",
	width: w,
	shrinkToFit: true,
	pager: '#upcomingPager',
	caption:"Upcoming EDD", 
	colNames:['ID', 'Last Name', 'First Name', 'EDD','G', 'P', 'Age', 'MD','RH', 'GBS', 'Prenatal', 'TDAP'], 
	colModel:[ 	{name:'id',index:'id', width:40, stype:'text', sortable: true}, 
				{name:'lastName',index:'lastName', width:80, search:true, sortable: true}, 
				{name:'firstName',index:'firstName', width:60, sortable: true}, 
				{name:'edd',index:'edd', width:60, sortable: true},
				{name:'g',index:'g', width:20, sortable: true},
				{name:'p',index:'p', width:20, sortable: true},
				{name:'age',index:'age', width:25, sortable: true},
				{name:'md',index:'md', width:25, sortable: true},
				{name:'rh',index:'rh', width:25, sortable: true},
				{name:'gbs',index:'gbs', width:25, sortable: true},
				{name:'prenatal',index:'prenatal', width:40, sortable: true},
				{name:'tdap',index:'tdap', width:25, sortable: true}
				],     
	loadComplete: function() {
			var totalPages = $("#upcomingEDD").getGridParam('lastpage');
			var page = $('#upcomingEDD').getGridParam('page');
            var records =  $("#upcomingEDD").getGridParam("records");
			var reccount =  $("#upcomingEDD").getGridParam("reccount");
			var rowData = $("#upcomingEDD").getDataIDs();
			if (page==totalPages&&(records % reccount)!=0)
			{
				var pageRecords = records % reccount;
			}
			else {
				var pageRecords = reccount;
			}
            for (var i = 0; i < pageRecords; i++) 
            {
                var rowDataCol = jQuery('#upcomingEDD').getRowData(rowData[i]);              
                // Set the color code of where where category value equal to labor
				if(rowDataCol['p']==0){
                    $("#upcomingEDD").jqGrid('setRowData', rowData[i], false, 'conditionalColor');
                }
            } 
        }
});
jQuery("#upcomingEDD").jqGrid('filterToolbar', {
	stringResult: true,
	defaultSearch: "cn",
	beforeSearch: function () {
		modifySearchingFilter.call(this, ' ');
	}
 });
$.extend($.jgrid.search, {
                multipleSearch: true,
                multipleGroup: true,
                recreateFilter: true,
                closeOnEscape: true,
                closeAfterSearch: true,
                overlay: 0
            });
}

function populateLabor(){
jQuery("#inLabor").jqGrid({ 
	url:'php/labor.php',
datatype: "json",
	height: "auto",
	rowNum:8,
	rowList:[8,20,40,80],
	sortname: 'edd',
	viewrecords: true,
	gridview: true,
	ignoreCase: true,
	sortorder: "desc",
	autowidth: true,
	shrinkToFit: true,
	pager: '#laborPager',
	caption:"Antepartum/Labor", 
	colNames:['ID', 'Last Name', 'First Name', 'EDD', 'Age', 'G', 'P', 'MD', 'Hospital', 'GBS'], 
	colModel:[ 	{name:'id',index:'id', width:40, stype:'text', sortable: true}, 
				{name:'lastName',index:'lastName', width:70, search:true, sortable: true}, 
				{name:'firstName',index:'firstName', width:50, sortable: true}, 
				{name:'edd',index:'edd', width:50, sortable: true},
				{name:'age',index:'age', width:25, sortable: true},
				{name:'g',index:'g', width:20, sortable: true},
				{name:'p',index:'p', width:20, sortable: true},
				{name:'md',index:'md', width:30, sortable: true},
				{name:'hospital',index:'hospital', width:40, sortable: true},
				{name:'gbs',index:'gbs', width:25, sortable: true}
				],
	loadComplete: function() {
			var totalPages = $("#inLabor").getGridParam('lastpage');
			var page = $('#inLabor').getGridParam('page');
            var records =  $("#inLabor").getGridParam("records");
			var reccount =  $("#inLabor").getGridParam("reccount");
			var rowData = $("#inLabor").getDataIDs();
			if (page==totalPages&&(records % reccount)!=0)
			{
				var pageRecords = records % reccount;
			}
			else {
				var pageRecords = reccount;
			}
            for (var i = 0; i < pageRecords; i++) 
            {
                var rowDataCol = jQuery('#inLabor').getRowData(rowData[i]);              
                // Set the color code of where where category value equal to labor
				if(rowDataCol['p']==0){
                    $("#inLabor").jqGrid('setRowData', rowData[i], false, 'conditionalColor');
                }
            } 
        }				

});
jQuery("#inLabor").jqGrid('filterToolbar', {
	stringResult: true,
	defaultSearch: "cn",
	beforeSearch: function () {
		modifySearchingFilter.call(this, ' ');
	}
 });
$.extend($.jgrid.search, {
                multipleSearch: true,
                multipleGroup: true,
                recreateFilter: true,
                closeOnEscape: true,
                closeAfterSearch: true,
                overlay: 0
            });
}

function populateDelivered(){
var w = $("#inLabor").width();
jQuery("#delivered").jqGrid({ 
	url:'php/delivered.php',
	datatype: "json",
	height: "auto",
	rowNum:8,
	rowList:[8,20,40,80],
	sortname: 'dateDel',
	viewrecords: true,
	gridview: true,
	ignoreCase: true,
	sortorder: "desc",
	width: w,
	shrinkToFit: true,
	pager: '#deliveredPager',
	caption:"Delivered", 
	colNames:['ID', 'Last Name', 'First Name', 'Delivering MD','Date Delivered','Hospital'], 
	colModel:[ 	{name:'id',index:'id', width:40, stype:'text', sortable: true}, 
				{name:'lastName',index:'lastName', width:120, search:true, sortable: true}, 
				{name:'firstName',index:'firstName', width:100, sortable: true}, 
				{name:'delMD',index:'delMD', width:40, sortable: true},
				{name:'dateDel',index:'dateDel', width:50, sortable: true},
				{name:'hospital',index:'hopsital', width:40, sortable: true}
				]   

});
jQuery("#delivered").jqGrid('filterToolbar', {
	stringResult: true,
	defaultSearch: "cn",
	beforeSearch: function () {
		modifySearchingFilter.call(this, ' ');
	}
 });
$.extend($.jgrid.search, {
                multipleSearch: true,
                multipleGroup: true,
                recreateFilter: true,
                closeOnEscape: true,
                closeAfterSearch: true,
                overlay: 0
            });
}

function populateBilled(){
var w = $("#inLabor").width();
jQuery("#billed").jqGrid({ 
	url:'php/billed.php',
	datatype: "json",
	height: "auto",
	rowNum:8,
	rowList:[8,20,40,80],
	sortname: 'dateDel',
	viewrecords: true,
	gridview: true,
	ignoreCase: true,
	sortorder: "desc",
	width: w,
	shrinkToFit: true,
	pager: '#billedPager',
	caption:"Billed", 
	colNames:['ID', 'Last Name', 'First Name', 'Del MD','Delivered','Hospital','Date Billed','Sex','Circ Billed', 'Trans/MAb'], 
	colModel:[ 	{name:'id',index:'id', width:20, stype:'text', sortable: true}, 
				{name:'lastName',index:'lastName', width:70, search:true, sortable: true}, 
				{name:'firstName',index:'firstName', width:50, sortable: true}, 
				{name:'delMD',index:'delMD', width:35, sortable: true},
				{name:'dateDel',index:'dateDel', width:45, sortable: true},
				{name:'hospital',index:'hopsital', width:35, sortable: true},
				{name:'dateBilled',index:'dateBilled', width:45, sortable: true},
				{name:'babySex',index:'babySex', width:30, sortable: true},
				{name:'cirBilled',index:'cirBilled', width:45, sortable: true},
				{name:'transMab', index:'transMab', width:45, sortable: true}
				],

	loadComplete: function() {
			var totalPages = $("#billed").getGridParam('lastpage');
			var page = $('#billed').getGridParam('page');
            var records =  $("#billed").getGridParam("records");
			var reccount =  $("#billed").getGridParam("reccount");
			var rowData = $("#billed").getDataIDs();
			if (page==totalPages&&(records % reccount)!=0)
			{
				var pageRecords = records % reccount;
			}
			else {
				var pageRecords = reccount;
			}
            for (var i = 0; i < pageRecords; i++) 
            {
                var rowDataCol = jQuery('#billed').getRowData(rowData[i]); 
				// Set the color green where circ billed
				if(rowDataCol['cirBilled']!='0000-00-00'){
                    $("#billed").jqGrid('setRowData', rowData[i], false, 'conditionalColor2');
                }
                // Set the color yellow where male circ unbilled
				if(rowDataCol['cirBilled']=='0000-00-00' && rowDataCol['transMab']=='0000-00-00' && rowDataCol['babySex'].indexOf("f")==-1 && rowDataCol['babySex'].indexOf("F")==-1){
                    $("#billed").jqGrid('setRowData', rowData[i], false, 'conditionalColor');
                }
            } 
        }				

});
jQuery("#billed").jqGrid('filterToolbar', {
	stringResult: true,
	defaultSearch: "cn",
	beforeSearch: function () {
		modifySearchingFilter.call(this, ' ');
	}
 });
$.extend($.jgrid.search, {
                multipleSearch: true,
                multipleGroup: true,
                recreateFilter: true,
                closeOnEscape: true,
                closeAfterSearch: true,
                overlay: 0
            });
}

function populateSearch(){
var w = $("#inLabor").width();
jQuery("#searchResults").jqGrid({ 
	url:'php/searchresults.php',
	datatype: "json",
	height: "auto",
	rowNum:8,
	rowList:[8,20,40,80],
	sortname: 'edd',
	viewrecords: true,
	gridview: true,
	ignoreCase: true,
	sortorder: "desc",
	width: w,
	shrinkToFit: true,
	pager: '#searchPager',
	caption:"Search",
	colNames:['Category','ID', 'Last Name', 'First Name', 'EDD', 'Category'], 
	colModel:[{name:'cathidden',index:'cathidden', hidden:true},
				{name:'id',index:'id', width:40, stype:'text', sortable: true}, 
				{name:'lastName',index:'lastName', width:120, search:true, sortable: true}, 
				{name:'firstName',index:'firstName', width:100, sortable: true}, 
				{name:'edd',index:'edd', width:110, sortable: true},
				{name:'category',index:'category', width: 100, sortable: true} ],

});
jQuery("#searchResults").jqGrid('filterToolbar', {
	stringResult: true,
	defaultSearch: "cn",
	beforeSearch: function () {
		modifySearchingFilter.call(this, ' ');
	}
 });
$.extend($.jgrid.search, {
                multipleSearch: true,
                multipleGroup: true,
                recreateFilter: true,
                closeOnEscape: true,
                closeAfterSearch: true,
                overlay: 0
            });

}

modifySearchingFilter = function (separator) {
                    var i, l, rules, rule, parts, j, group, str,
                        filters = $.parseJSON(this.p.postData.filters);
                    if (filters && typeof filters.rules !== 'undefined' && filters.rules.length > 0) {
                        rules = filters.rules;
                        for (i = 0; i < rules.length; i++) {
                            rule = rules[i];
                            if (rule.op === 'cn') {
                                // make modifications only for the 'contains' operation
                                parts = rule.data.split(separator);
                                if (parts.length > 1) {
                                    if (typeof filters.groups === 'undefined') {
                                        filters.groups = [];
                                    }
                                    group = {
                                        groupOp: 'OR',
                                        groups: [],
                                        rules: []
                                    };
                                    filters.groups.push(group);
                                    for (j = 0, l = parts.length; j < l; j++) {
                                        str = parts[j];
                                        if (str) {
                                            // skip empty '', which exist in case of two separaters of once
                                            group.rules.push({
                                                data: parts[j],
                                                op: rule.op,
                                                field: rule.field
                                            });
                                        }
                                    }
                                    rules.splice(i, 1);
                                    i--; // to skip i++
                                }
                            }
                        }
                        this.p.postData.filters = JSON.stringify(filters);
                    }
                };


function upcomingToLabor(){ 
	var row = jQuery("#upcomingEDD").jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var patientID = row;
		movePatient(patientID, "upcoming", "labor");
		
	} 
	else { 
		alert("Please select row");
	} 
}

function deliveredToLabor(){ 
	var row = jQuery("#delivered").jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var r=confirm("Clear delivery information?");
			if (r==true)
				{
				var patientID = row;
				movePatient(patientID, "delivered", "labor");
				}
	} 
	else { 
		alert("Please select row");
	} 
}

function billedToDelivered(){ 
	var row = jQuery("#billed").jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var r=confirm("Clear billing information?");
			if (r==true)
				{
				var patientID = row;
				movePatient(patientID, "billed", "delivered");
				}
	} 
	else { 
		alert("Please select row");
	} 
}

function laborToDelivered(){ 
	var row = jQuery("#inLabor").jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var patientID = row;
		movePatient(patientID, "labor", "delivered");
	} 
	else { 
		alert("Please select row");
	} 
}

function laborToUpcoming(){ 
	var row = jQuery("#inLabor").jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var patientID = row;
		movePatient(patientID, "labor", "upcoming");
	} 
	else { 
		alert("Please select row");
	} 
}

function assignTo(destination){
	var row = jQuery("#searchResults").jqGrid('getGridParam','selrow'); 
	if (row != null) {
		var r=confirm("This will clear billing and delivery information, if applicable. Continue?");
			if (r==true)
				{
				var patientID = row;
				assignPatient(patientID, '1', destination);
				}
	} 
	else { 
		alert("Please select row");
	} 
}

function deleteEntry(table, id){
	if (table == 'labor'){
		jQuery("#inLabor").jqGrid('delRowData',id);
	}
	if (table == 'delivered'){
		jQuery("#delivered").jqGrid('delRowData',id);
	}
	if (table == 'upcoming'){
		jQuery("#upcomingEDD").jqGrid('delRowData',id);
	}
	if (table == 'billed'){
		jQuery("#billed").jqGrid('delRowData',id);
	}
}