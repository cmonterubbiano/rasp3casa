
function initAutoRefresh(){
	askDbForValues();
	setInterval(function(){ askDbForValues(); }, 3000);
}

function askDbForValues(){
	var objParameters = {};
	objParameters.directoryToAnalize = "prova";
	var parameters = JSON.stringify(objParameters);
	$.getJSON( "ajaxDbRequest_log.php", { message: parameters} )
	  .done(function( json ) {
		//console.log( "JSON Data: " + json.risposta ) ;
		//alert("ANADTA BENE");
		managePhpResponse(json);
	  })
	  .fail(function( jqxhr, textStatus, error ) {
		var err = textStatus + ", " + error;
		//console.log( "Request Failed: " + err );
		//alert("Request Failed fallita un casi : " + err);
		alert(err);
	});

}

function managePhpResponse(json){
	//alert(json.camera_ospiti.temperatura_percepita);
	//alert(json);
	//alert(json.telecamera);
	//alert("RIPOSTA");
	//$("#temp_camera_sud .temp_value").html((json.camera_ospiti.temperatura_percepita).split(".")[0] + "&deg;");
	$("#window_log_tutto .window_log_comando10").html(json.comando10 );
	$("#window_log_tutto .window_log_data10").html(json.orario10 );
	$("#window_log_tutto .window_log_note10").html(json.note10 );
	$("#window_log_tutto .window_log_comando9").html(json.comando9 );
	$("#window_log_tutto .window_log_data9").html(json.orario9 );
	$("#window_log_tutto .window_log_note9").html(json.note9 );
	$("#window_log_tutto .window_log_comando8").html(json.comando8 );
	$("#window_log_tutto .window_log_data8").html(json.orario8 );
	$("#window_log_tutto .window_log_note8").html(json.note8 );
	$("#window_log_tutto .window_log_comando7").html(json.comando7 );
	$("#window_log_tutto .window_log_data7").html(json.orario7 );
	$("#window_log_tutto .window_log_note7").html(json.note7 );
	$("#window_log_tutto .window_log_comando6").html(json.comando6 );
	$("#window_log_tutto .window_log_data6").html(json.orario6 );
	$("#window_log_tutto .window_log_note6").html(json.note6 );
	$("#window_log_tutto .window_log_comando5").html(json.comando5 );
	$("#window_log_tutto .window_log_data5").html(json.orario5 );
	$("#window_log_tutto .window_log_note5").html(json.note5 );
	$("#window_log_tutto .window_log_comando4").html(json.comando4 );
	$("#window_log_tutto .window_log_data4").html(json.orario4 );
	$("#window_log_tutto .window_log_note4").html(json.note4 );
	$("#window_log_tutto .window_log_comando3").html(json.comando3 );
	$("#window_log_tutto .window_log_data3").html(json.orario3 );
	$("#window_log_tutto .window_log_note3").html(json.note3 );
	$("#window_log_tutto .window_log_comando2").html(json.comando2 );
	$("#window_log_tutto .window_log_data2").html(json.orario2 );
	$("#window_log_tutto .window_log_note2").html(json.note2 );
	$("#window_log_tutto .window_log_comando1").html(json.comando1 );
	$("#window_log_tutto .window_log_data1").html(json.orario1 );
	$("#window_log_tutto .window_log_note1").html(json.note1 );

}
