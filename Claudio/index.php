<?php
 
	require_once("./login.php");

	require_once("./global_var.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITLE_OF_PROJECT; ?> - MENU</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="./js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="./js/script.js"></script>
		<script src="./js/throbber.js" type="text/javascript" ></script>
		
</head>

<body>
<div id="throbber_loader"><img src="css/images/ajax_loader.gif" alt="loading..." align="middle" /></div>
<div class="container">
  <div class="header">
 	<a href="./exit.php" class="main_menu_link_exit">EXIT</a> 
  	<a href="./index.php" class="main_menu_link"><?php echo TITLE_OF_PROJECT; ?> - MAIN MENU</a> 
    <!-- end .header --></div>
  <div class="content">
   		<a href="./allarme.php">
   		<div class="main_button_index">
        	GESTIONE<br/>ALLARME
        </div></a>
   
   		<a href="./test_allarme.php">
   		<div class="main_button_index">
        	TEST<br/>ALLARME
        </div></a>
   
   		<a href="./leggi_log.php">
   		<div class="main_button_index">
        	LOG<br/>ALLARME
        </div></a>
   
   		<a href="./termosifoni.php">
   		<div class="main_button_index">
        	GESTIONE<br/>TERMOSIFONI
        </div></a>
   
   		<a href="./gestione_luci.php">
   		<div class="main_button_index">
        	GESTIONE<br/>LUCI
        </div></a>
   
   		<a href="./monitor.php">
   		<div class="main_button_index">
        	MONITOR<br/>TEMPERATURA
        </div></a>
		
    	<a href="./monitor_umi.php">
   		<div class="main_button_index">
        	MONITOR<br/>UMIDITA'
        </div></a>
        
   		<a href="./Gestione_sensori.php">
   		<div class="main_button_index">
        	GESTIONE<br/>SENSORI
        </div></a>
        
   		<div class="main_button_index">

        <input type="button" value="LEGGI SENSORE" class="cmd5 switch_button_direct_reboot switch_button_run" id="leggi_sensore" />
   		</div>
   		<div class="main_button_index">

        <input type="button" value="REBOOT SISTEMA" class="cmd5 switch_button_direct_reboot switch_button_run" id="reboot_sistema" />
		</div>
		
   		<div class="clearfloat" ></div>
		<br/>
    <!-- end .content -->
	</div>
</div>


<?php 	require_once("./footer.php");  ?>    


  <!-- end .container -->
  </div>
<script>

$(document).ready(function() {
	$("#reboot_sistema").click(function() {	rebootSistema();	});
	$("#leggi_sensore").click(function() {	leggiSensore();	});
});
function rebootSistema(){
	var r = confirm("Sei sicuro di voler riavviare il sistema?");
	if (r == true) {
		//alert ("Riavvioa");
		throbberStart();
		//alert ("Riavvio11111a");
		//alert("text: " + $(caller).attr("value"));
		$.ajax({
			dataType: "json",
			url: './ajax/sistemReboot.php',
			success: function(data) {
			  // alert("una_variabile:: " + data.una_variabile);
			  // alert("esito_exec:: " + data.esito_exec);
			  // alert("output:: " + data.output);
			  alert("Il sistema si sta riavviando...: " + data);
			  // console.log("data: ");
			  // console.log(data);
			}
		});
	} else {
		//txt = "You pressed Cancel!";
		//alert("Premuto Cancel");
	}
}
function leggiSensore(){
	var r = confirm("Hai circa 10 secondi per leggere il codice del sensore?");
	if (r == true) {
		throbberStart();
		//alert ("Riavvio11111a");
		//alert("text: " + $(caller).attr("value"));
		$.ajax({
			dataType: "json",
			url: './ajax/leggi433.php',
			success: function(data) {
			  // alert("una_variabile:: " + data.una_variabile);
			  // alert("esito_exec:: " + data.esito_exec);
			  // alert("output:: " + data.output);
			  alert(data.esito_exec);
			  throbberStop();
			  // console.log("data: ");
			  // console.log(data);
			}
		});
	} else {
		//txt = "You pressed Cancel!";
		//alert("Premuto Cancel");
	}
}

</script>
</body>
<style>
.switch_button_direct_reboot {
	height:90px;
	width:100%;
	margin:auto;
    border-radius: 35px 35px 35px 35px;
	border-width:20px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight:bold;
	cursor:pointer;
}
</style>
</html>