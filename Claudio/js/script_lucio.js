
function initAutoRefresh(){
	askDbForValues();
	setInterval(function(){ askDbForValues(); }, 3000);
}

function askDbForValues(){
	var objParameters = {};
	objParameters.directoryToAnalize = "prova";
	var parameters = JSON.stringify(objParameters);
	$.getJSON( "ajaxDbRequest_lucio.php", { message: parameters} )
	  .done(function( json ) {
		//console.log( "JSON Data: " + json.risposta ) ;
		//alert("ANADTA BENE");
		managePhpResponse(json);
	  })
	  .fail(function( jqxhr, textStatus, error ) {
		var err = textStatus + ", " + error;
		//console.log( "Request Failed: " + err );
		alert("Request Failed fallita : " + err);
	});

}

function managePhpResponse(json)
{
	// Non sono riuscito a far accettare valore id
	// $("#window_panel_camera_tutto .window_panel_allarme").html(json.1.status );
	$("#window_panel_camera_tutto .window_panel_allarme").html(json.FISSA.status );
	
}




function handleClickAllarme(comando){
	var urlToCall = "readwriteDb.php?r_allarme_comando="+comando;
	//alert(urlToCall);
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});		
}
