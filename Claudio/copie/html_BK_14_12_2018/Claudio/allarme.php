<?php 
	require_once("./login.php");

	require_once("./global_var.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo TITLE_OF_PROJECT; ?> - MENU</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="./js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="./js/script.js"></script>
		
		<script type="text/javascript">
	
		var firstUpdate = true;
		$(document).ready(function() {

			//$('.temp_container').fancybox();
			
			// $('.wind_container').fancybox();
			// $('.controller_container').fancybox();
			// $('.heat_container').fancybox();
			// $('.webcam_container').fancybox();
			// $('.temperature_container').fancybox();
			
			// $( ".window_panel_comandi_su" ).click(function() { handleClickSerranda(this,"up"); });
			// $( ".window_panel_comandi_stop" ).click(function() { handleClickSerranda(this,"stop"); });
			// $( ".window_panel_comandi_giu" ).click(function() { handleClickSerranda(this,"down"); });
			
			
			// $( ".window_panel_comandi_giorno_auto" ).click(function() { handleClickRiscaldamento("zona_giorno","AUTOMATICO"); });
			// $( ".window_panel_comandi_giorno_on" ).click(function() { handleClickRiscaldamento("zona_giorno","APRI"); });
			// $( ".window_panel_comandi_giorno_off" ).click(function() { handleClickRiscaldamento("zona_giorno","CHIUDI"); });
			// $( ".window_panel_comandi_notte_auto" ).click(function() { handleClickRiscaldamento("zona_notte","AUTOMATICO"); });
			// $( ".window_panel_comandi_notte_on" ).click(function() { handleClickRiscaldamento("zona_notte","APRI"); });
			// $( ".window_panel_comandi_notte_off" ).click(function() { handleClickRiscaldamento("zona_notte","CHIUDI"); });
			
			$( ".window_panel_comandi_allarme_on" ).click(function() { handleClickAllarme("allarme","APRI"); });
			$( ".window_panel_comandi_allarme_off" ).click(function() { handleClickAllarme("allarme","CHIUDI"); });
			$( ".window_panel_comandi_allarme_help" ).click(function() { handleClickAllarme("allarme","AIUTO"); });
			$( ".window_panel_comandi_allarme_home" ).click(function() { handleClickAllarme("allarme","HOME"); });
			
			// $( ".webcam_panel_comandi_webcam_on" ).click(function() { handleClickAllarme("telecamera","APRI"); });
			// $( ".webcam_panel_comandi_webcam_off" ).click(function() { handleClickAllarme("telecamera","CHIUDI"); });
			// $( ".webcam_panel_comandi_presa_on" ).click(function() { handleClickAllarme("presa_1","APRI"); });
			// $( ".webcam_panel_comandi_presa_off" ).click(function() { handleClickAllarme("presa_1","CHIUDI"); });
			
			
			
			//run auto refresh
			initAutoRefresh();
		});
		</script>
	</head>
	<body>
		
		<div class="container">	
			<div class="header">
			<a href="./index.php" class="main_menu_link"><?php echo TITLE_OF_PROJECT; ?> - MAIN MENU</a> 
			</div>
			<div class="content">
				<center> 
					<font size="10"
					<h1> 
					<font color=red> 
					<div  class="window_panel_allarme_title">STATO ALLARME:</div>
					<div id="window_panel_camera_tutto">
						<div  class="window_panel_allarme">Acces</div>
					</div>
					</font> 
					</h1> 
					<hr> 
					<table class="mia_tabella" >
						<div  class="window_panel_comandi_allarme_off window_panel_comandi_allarme">&nbsp;&nbsp;&nbsp;</div> 
						<div  class="window_panel_comandi_allarme_on window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_home window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_help window_panel_comandi_allarme">&nbsp;</div> 
		
						<br/>
					
					</table> 
					</font> 
				</center>
			</div>
			<?php 	require_once("./footer.php");  ?>
		</div>		
	</body> 
</html> 