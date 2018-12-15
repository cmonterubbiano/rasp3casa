
function initAutoRefresh(){
	askDbForValues();
	setInterval(function(){ askDbForValues(); }, 3000);
}

function askDbForValues(){
	var objParameters = {};
	objParameters.directoryToAnalize = "prova";
	var parameters = JSON.stringify(objParameters);
	$.getJSON( "ajaxDbRequest_luci.php", { message: parameters} )
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

	$("#window_panel_luci_tutto .window_luci_cucina").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_cucina").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_cucinino").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_cucinino").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_corridoio").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_corridoio").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_studio").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_studio").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_camera").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_camera").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_bagno").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_bagno").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_ospiti").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_ospiti").removeClass("rosso");
	$("#window_panel_luci_tutto .window_luci_sala").removeClass("nero");
	$("#window_panel_luci_tutto .window_luci_sala").removeClass("rosso");
	
	if ((json.cucina ) =="On" || (json.cucina ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_cucina").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_cucina").addClass("nero");
	
	if ((json.cucinino ) =="On" || (json.cucinino ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_cucinino").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_cucinino").addClass("nero");
		
	if ((json.corridoio ) =="On" || (json.corridoio ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_corridoio").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_corridoio").addClass("nero");
		
	if ((json.studio ) =="On" || (json.studio ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_studio").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_studio").addClass("nero");
		
	if ((json.camera ) =="On" || (json.camera ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_camera").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_camera").addClass("nero");
		
	if ((json.bagno ) =="On" || (json.bagno ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_bagno").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_bagno").addClass("nero");
		
	if ((json.camera_ospiti ) =="On" || (json.camera_ospiti ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_ospiti").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_ospiti").addClass("nero");
		
	if ((json.sala ) =="On" || (json.sala ) =="PPICCIATA")
		$("#window_panel_luci_tutto .window_luci_sala").addClass("rosso");
	else
		$("#window_panel_luci_tutto .window_luci_sala").addClass("nero");
		// alert("if ok")
	// else	alert(pippo);
	
	/*
		$("#window_panel_camera_tutto .window_panel_allarme").html("CIAO");
	firstUpdate = false;	
	*/
}

function handleClickCucina(modo){
	//alert("STO CHIAMANDO CUCINA --> " + modo);
	var urlToCall = "https://maker.ifttt.com/trigger/Cucina_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=cucina&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickCucinino(modo){
	//alert("STO CHIAMANDO CORRIDOIO --> " + modo);
	var urlToCall = "https://maker.ifttt.com/trigger/Cucinino_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=cucinino&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickCorridoio(modo){
	//alert("STO CHIAMANDO CORRIDOIO --> " + modo);
	var urlToCall = "https://maker.ifttt.com/trigger/Corridoio_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=corridoio&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickStudio(modo){
	// alert("STO CHIAMANDO Studio_ --> " + modo);
	var urlToCall = "https://maker.ifttt.com/trigger/Studio_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
		//https://maker.ifttt.com/trigger/Studio_Off/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG
		// il Successivo e' il vecchio comando
		//https://maker.ifttt.com/trigger/Studio_Off/with/key/j3iWZ8_LnbnG2tfu2Ak6PFxcvYlmF-A1AlDZxCg5b6S
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=studio&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		alert(data);
		}
	});	
}
function handleClickCamera(modo){
	var urlToCall = "https://maker.ifttt.com/trigger/Camera_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=camera&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickBagno(modo){
	var urlToCall = "https://maker.ifttt.com/trigger/Bagno_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=bagno&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickOspiti(modo){
	var urlToCall = "https://maker.ifttt.com/trigger/Ospiti_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=camera_ospiti&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickSala(modo){
	var urlToCall = "https://maker.ifttt.com/trigger/Sala_"+modo+"/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
	var urlToCall = "readwriteDb.php?nome_colonna=luce&nome_stanza=sala&valore_colonna="+modo;
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		  //alert(data);
		}
	});			
}
function handleClickCancello(){
	var urlToCall = "https://maker.ifttt.com/trigger/Cancello/with/key/k0OtlRy3Q_YZWF-zlfF7d-TFWCkVcN0jGlwcFSU6SSG";
	$.ajax({
		dataType: "json",
		url: urlToCall,
		success: function(data) {
		//alert(data);
		}
	});
}