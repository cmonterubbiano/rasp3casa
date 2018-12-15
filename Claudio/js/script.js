
function initAutoRefresh(){
	askDbForValues();
	setInterval(function(){ askDbForValues(); }, 3000);
}

function askDbForValues(){
	var objParameters = {};
	objParameters.directoryToAnalize = "prova";
	var parameters = JSON.stringify(objParameters);
	$.getJSON( "ajaxDbRequest.php", { message: parameters} )
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

function managePhpResponse(json){
	//alert(json.camera_ospiti.temperatura_percepita);
	//alert(json);
	//alert(json.telecamera);
	//alert("RIPOSTA");
	//$("#temp_camera_sud .temp_value").html((json.camera_ospiti.temperatura_percepita).split(".")[0] + "&deg;");
	$("#window_panel_camera_tutto .window_panel_allarme").html(json.allarme.status );
	$("#window_panel_camera_tutto .window_panel_termosifoni").html(json.termosifoni.status );
	$("#window_panel_camera_tutto .window_cucina_temperatura").html(json.cucina.temperatura );
	$("#window_panel_camera_tutto .window_cucina_umidita").html(json.cucina.umidita );
	$("#window_panel_camera_tutto .window_cucina_percepita").html(json.cucina.percepita );
	$("#window_panel_camera_tutto .window_esterna_temperatura").html(json.esterna.temperatura );
	$("#window_panel_camera_tutto .window_esterna_umidita").html(json.esterna.umidita );
	$("#window_panel_camera_tutto .window_esterna_percepita").html(json.esterna.percepita );
	$("#window_panel_camera_tutto .window_studio_temperatura").html(json.studio.temperatura );
	$("#window_panel_camera_tutto .window_studio_umidita").html(json.studio.umidita );
	$("#window_panel_camera_tutto .window_studio_percepita").html(json.studio.percepita );
	$("#window_panel_camera_tutto .window_camera_temperatura").html(json.camera.temperatura );
	$("#window_panel_camera_tutto .window_camera_umidita").html(json.camera.umidita );
	$("#window_panel_camera_tutto .window_camera_percepita").html(json.camera.percepita );
	$("#window_panel_camera_tutto .window_esterna_timestamp").html(json.esterna.timestamp );
	
	$("#window_panel_test_tutto .window_test_sala").removeClass("nero");
	$("#window_panel_test_tutto .window_test_sala").removeClass("rosso");
	$("#window_panel_test_tutto .window_test_bagno").removeClass("nero");
	$("#window_panel_test_tutto .window_test_bagno").removeClass("rosso");
	$("#window_panel_test_tutto .window_test_cucina").removeClass("nero");
	$("#window_panel_test_tutto .window_test_cucina").removeClass("rosso");
	$("#window_panel_test_tutto .window_test_ingresso").removeClass("nero");
	$("#window_panel_test_tutto .window_test_ingresso").removeClass("rosso");
	$("#window_panel_test_tutto .window_test_camere").removeClass("nero");
	$("#window_panel_test_tutto .window_test_camere").removeClass("rosso");
	
	if ((json.terrazzo_sala.status ) =="movimento")
		$("#window_panel_test_tutto .window_test_sala").addClass("rosso");
	else
		$("#window_panel_test_tutto .window_test_sala").addClass("nero");
		
	if ((json.finestra_bagno.status ) =="movimento")
		$("#window_panel_test_tutto .window_test_bagno").addClass("rosso");
	else
		$("#window_panel_test_tutto .window_test_bagno").addClass("nero");
		
	if ((json.terrazzo_cucina.status ) =="movimento")
		$("#window_panel_test_tutto .window_test_cucina").addClass("rosso");
	else
		$("#window_panel_test_tutto .window_test_cucina").addClass("nero");
			
	if ((json.zona_giorno.status ) =="movimento")
		$("#window_panel_test_tutto .window_test_ingresso").addClass("rosso");
	else
		$("#window_panel_test_tutto .window_test_ingresso").addClass("nero");
			
	if ((json.zona_notte.status ) =="movimento")
		$("#window_panel_test_tutto .window_test_camere").addClass("rosso");
	else
		$("#window_panel_test_tutto .window_test_camere").addClass("nero");

		// alert("if ok")
	// else	alert(pippo);
	
	/*
		$("#window_panel_camera_tutto .window_panel_allarme").html("CIAO");
	firstUpdate = false;	
	*/
}




function handleClickAllarme(zona,comando){
	//alert("STO CHIAMANDO");
	var urlToCall = "scriviArduino.php?mittente=raspberry&stanza="+zona+"&azione="+comando;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});		
}

function handleClickTermosifoni(modo){
	//alert("STO CHIAMANDO TERMOSIFONI --> " + modo);
	var urlToCall = "https://maker.ifttt.com/trigger/Termosifoni_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=status&nome_stanza=termosifoni&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}