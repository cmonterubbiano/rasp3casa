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
		<script type="text/javascript" src="./js/script_luci.js"></script>
		
		<script type="text/javascript">
	
		var firstUpdate = true;
		$(document).ready(function() {
	
			$( ".window_panel_comandi_luci_cucina_off" ).click(function() { handleClickCucina("Off"); });
			$( ".window_panel_comandi_luci_cucina_on" ).click(function() { handleClickCucina("On"); });
			$( ".window_panel_comandi_luci_cucinino_off" ).click(function() { handleClickCucinino("Off"); });
			$( ".window_panel_comandi_luci_cucinino_on" ).click(function() { handleClickCucinino("On"); });
			$( ".window_panel_comandi_luci_corridoio_off" ).click(function() { handleClickCorridoio("Off"); });
			$( ".window_panel_comandi_luci_corridoio_on" ).click(function() { handleClickCorridoio("On"); });
			$( ".window_panel_comandi_luci_studio_off" ).click(function() { handleClickStudio("Off"); });
			$( ".window_panel_comandi_luci_studio_on" ).click(function() { handleClickStudio("On"); });
			$( ".window_panel_comandi_luci_camera_off" ).click(function() { handleClickCamera("Off"); });
			$( ".window_panel_comandi_luci_camera_on" ).click(function() { handleClickCamera("On"); });
			$( ".window_panel_comandi_luci_bagno_off" ).click(function() { handleClickBagno("Off"); });
			$( ".window_panel_comandi_luci_bagno_on" ).click(function() { handleClickBagno("On"); });
			$( ".window_panel_comandi_luci_ospiti_off" ).click(function() { handleClickOspiti("Off"); });
			$( ".window_panel_comandi_luci_ospiti_on" ).click(function() { handleClickOspiti("On"); });
			$( ".window_panel_comandi_luci_sala_off" ).click(function() { handleClickSala("Off"); });
			$( ".window_panel_comandi_luci_sala_on" ).click(function() { handleClickSala("On"); });
			

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
					<div  class="window_panel_allarme_title">SITUAZIONE LUCI:</div>
					</h1>				
					<hr> 
						<div id="window_panel_luci_tutto">
							<div  class="window_luci_cucina">Cucina ----</div>
							<div  class="window_luci_cucinino">---- Cucinino</div>
						</div>
						<div  class="window_panel_comandi_luci_cucina_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_cucina_on window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_cucinino_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_cucinino_on window_panel_comandi_luci">&nbsp;</div>
						<br>
						<div id="window_panel_luci_tutto">
							<div  class="window_luci_corridoio">Corridoio ----</div>
							<div  class="window_luci_studio">--- Studio</div>
						</div>
						<div  class="window_panel_comandi_luci_corridoio_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_corridoio_on window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_studio_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_studio_on window_panel_comandi_luci">&nbsp;</div>
						<div id="window_panel_luci_tutto">
							<div  class="window_luci_camera">Camera ----</div>
							<div  class="window_luci_bagno">--- Bagno</div>
						</div>
						<div  class="window_panel_comandi_luci_camera_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_camera_on window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_bagno_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_bagno_on window_panel_comandi_luci">&nbsp;</div>
						<div id="window_panel_luci_tutto">
							<div  class="window_luci_ospiti">Ospiti -----</div>
							<div  class="window_luci_sala">---- Sala</div>
						</div>
						<div  class="window_panel_comandi_luci_ospiti_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_ospiti_on window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_sala_off window_panel_comandi_luci">&nbsp;</div>
						<div  class="window_panel_comandi_luci_sala_on window_panel_comandi_luci">&nbsp;</div>
					</font> 
				</center>
			</div>
			<?php 	require_once("./footer.php");  ?>
		</div>		
	</body> 
</html> 