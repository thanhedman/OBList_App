function movePatient(id, origin, destination) {
     $.ajax({
            type: "POST",
            url: "php/movehandler.php",
            data: {"id": id, "origin": origin, "destination": destination},
     }).done(deleteEntry(origin, id))
		
	};

function assignPatient(id, origin, destination) {
     $.ajax({
            type: "POST",
            url: "php/movehandler.php",
            data: {"id": id, "origin": origin, "destination": destination}
     }).done(setTimeout(function(){$('#searchResults').trigger('reloadGrid')},1000))
	 
	 };
