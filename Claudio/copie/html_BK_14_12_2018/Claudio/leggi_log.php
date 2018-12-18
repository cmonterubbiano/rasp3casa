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
		<script type="text/javascript" src="./js/script_log.js"></script>
		
		<script type="text/javascript">
	
		var firstUpdate = true;
		$(document).ready(function() {
			
			// $( ".window_panel_comandi_allarme_on" ).click(function() { handleClickAllarme("allarme","TEST"); });
			// $( ".window_panel_comandi_allarme_home" ).click(function() { handleClickAllarme("allarme","TEST_HOME"); });
	
			// $( ".window_panel_comandi_allarme_test_1" ).click(function() { handleClickAllarme("allarme","TEST_1"); });
			// $( ".window_panel_comandi_allarme_test_2" ).click(function() { handleClickAllarme("allarme","TEST_2"); });
			// $( ".window_panel_comandi_allarme_test_3" ).click(function() { handleClickAllarme("allarme","TEST_3"); });
			// $( ".window_panel_comandi_allarme_test_4" ).click(function() { handleClickAllarme("allarme","TEST_4"); });
			// $( ".window_panel_comandi_allarme_test_5" ).click(function() { handleClickAllarme("allarme","TEST_5"); });

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
					<div  class="window_panel_allarme_title">(LOG) ALLARME:</div>

					</h1>				
					<hr> 
					</font>					
					<font size="5">
					<table class="mia_tabella" >
						<div id="window_log_tutto">
							<div class="window_log_data10">Data</div>
							<div class="window_log_comando10">Comando</div>
							<div class="window_log_note10">Note</div>
							</br>
							<div  class="window_log_data9">Data</div>							
							<div  class="window_log_comando9">Comando</div>
							<div  class="window_log_note9">Note</div>
							</br>
							<div  class="window_log_data8">Data</div>
							<div  class="window_log_comando8">Comando</div>
							<div  class="window_log_note8">Note</div>
							</br>
							<div  class="window_log_data7">Data</div>							
							<div  class="window_log_comando7">Comando</div>
							<div  class="window_log_note7">Note</div>
							</br>
							<div  class="window_log_data6">Data</div>
							<div  class="window_log_comando6">Comando</div>
							<div  class="window_log_note6">Note</div>
							</br>
							<div  class="window_log_data5">Data</div>							
							<div  class="window_log_comando5">Comando</div>
							<div  class="window_log_note5">Note</div>
							</br>
							<div  class="window_log_data4">Data</div>
							<div  class="window_log_comando4">Comando</div>
							<div  class="window_log_note4">Note</div>
							</br>
							<div  class="window_log_data3">Data</div>							
							<div  class="window_log_comando3">Comando</div>
							<div  class="window_log_note3">Note</div>
							</br>
							<div  class="window_log_data2">Data</div>
							<div  class="window_log_comando2">Comando</div>
							<div  class="window_log_note2">Note</div>
							</br>
							<div  class="window_log_data1">Data</div>							
							<div  class="window_log_comando1">Comando</div>
							<div  class="window_log_note1">Note</div>
							</br>
						</div>
					</table> 
					</font> 
				</center>
			</div>
			<?php 	require_once("./footer.php");  ?>
		</div>		
	</body> 
	<style>
</style>
</html> 