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
			
			$( ".window_panel_comandi_allarme_on" ).click(function() { handleClickAllarme("allarme","TEST"); });
			$( ".window_panel_comandi_allarme_home" ).click(function() { handleClickAllarme("allarme","TEST_HOME"); });
	
			$( ".window_panel_comandi_allarme_test_1" ).click(function() { handleClickAllarme("allarme","TEST_1"); });
			$( ".window_panel_comandi_allarme_test_2" ).click(function() { handleClickAllarme("allarme","TEST_2"); });
			$( ".window_panel_comandi_allarme_test_3" ).click(function() { handleClickAllarme("allarme","TEST_3"); });
			$( ".window_panel_comandi_allarme_test_4" ).click(function() { handleClickAllarme("allarme","TEST_4"); });
			$( ".window_panel_comandi_allarme_test_5" ).click(function() { handleClickAllarme("allarme","TEST_5"); });

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
					<div  class="window_panel_allarme_title">(TEST) STATO ALLARME:</div>
					<div id="window_panel_camera_tutto">
						<div  class="window_panel_allarme">Acces</div>
					</div>
					</h1>				
					<hr> 
					<table class="mia_tabella" >
				
						<div  class="window_panel_comandi_allarme_on window_panel_comandi_allarme">&ensp;</div>
						<div  class="window_panel_comandi_allarme_home window_panel_comandi_allarme">&nbsp;</div>

						<div id="window_panel_test_tutto">
							<div  class="window_test_sala">T.Sala</div>
							<div  class="window_test_bagno">F.Bag.</div>
							<div  class="window_test_cucina">T.Cuc.</div>
						</div>
					
						<div  class="window_panel_comandi_allarme_test_1 window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_test_2 window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_test_3 window_panel_comandi_allarme">&nbsp;</div>


						<div id="window_panel_test_tutto">
							<div  class="window_test_ingresso">Z.Giorno</div>
							<div  class="window_test_camere">Z.Notte</div>
						</div>

						<div  class="window_panel_comandi_allarme_test_4 window_panel_comandi_allarme">&nbsp;</div>
						<div  class="window_panel_comandi_allarme_test_5 window_panel_comandi_allarme">&nbsp;</div>

					
					</table> 
					</font> 
				</center>
			</div>
			<?php 	require_once("./footer.php");  ?>
		</div>		
	</body> 
</html> 