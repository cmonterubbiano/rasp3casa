<?php 
	//require_once("./login.php");

	require_once("./global_var.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo TITLE_OF_PROJECT; ?> - MENU</title>
		<link href="css/style_lucio.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="./js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="./js/script_lucio.js"></script>
		
		<script type="text/javascript">
	
		var firstUpdate = true;
		$(document).ready(function() {

			$( ".window_panel_comandi_allarme_lucio_on" ).click(function() { handleClickAllarme("Accendi"); });
			$( ".window_panel_comandi_allarme_lucio_off" ).click(function() { handleClickAllarme("Spegni"); });
			$( ".window_panel_comandi_allarme_lucio_help" ).click(function() { handleClickAllarme("Aiuto"); });
			$( ".window_panel_comandi_allarme_lucio_home" ).click(function() { handleClickAllarme("Home"); });
			
			$( ".window_panel_comandi_allarme_lucio_test_1" ).click(function() { handleClickAllarme("Tipo_1"); });
			$( ".window_panel_comandi_allarme_lucio_test_2" ).click(function() { handleClickAllarme("Controllo"); });
			
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
						<div  class="window_panel_comandi_allarme_lucio_off window_panel_comandi_allarme">&nbsp;&nbsp;&nbsp;</div> 
						<div  class="window_panel_comandi_allarme_lucio_on window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_lucio_home window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_lucio_help window_panel_comandi_allarme">&nbsp;</div> 
						<div  class="window_panel_comandi_allarme_lucio_test_1 window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_lucio_test_2 window_panel_comandi_allarme">&nbsp;</div>
						<br/>
					
					</table> 
					</font> 
				</center>
			</div>
			<?php 	require_once("./footer.php");  ?>
		</div>		
	</body> 
</html> 