<?<?php 
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

			
			$( ".window_panel_comandi_termosifoni_on" ).click(function() { handleClickTermosifoni("On"); });
			$( ".window_panel_comandi_termosifoni_off" ).click(function() { handleClickTermosifoni("Off"); });
			
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
					<div  class="window_panel_allarme_title">STATO TERMOSIFONI:</div>
					<div id="window_panel_camera_tutto">
						<div  class="window_panel_termosifoni">SPENTI</div>
					</font>
					</font>
					</div>
					</h1> 
					<hr>
					<div  class="window_panel_comandi_termosifoni_off window_panel_comandi_allarme">&emsp;</div> 
					
					<div  class="window_panel_comandi_termosifoni_on window_panel_comandi_allarme">&nbsp;</div>
					</br>
					<div id="window_panel_camera_tutto">
						Cucina -> Temp.:
						<div  class="window_cucina_temperatura">20.21</div>
						Umid.:
						<div  class="window_cucina_umidita">20.21</div>
						Perc.:
						<div  class="window_cucina_percepita">20.21</div>	
						</br>
						Esterno-> Temp.:
						<div  class="window_esterna_temperatura">20.21</div>
						Umid.:
						<div  class="window_esterna_umidita">20.21</div>
						Perc.:
						<div  class="window_esterna_percepita">20.21</div>
						</br>
						Camera-> Temp.:
						<div  class="window_camera_temperatura">20.21</div>
						Umid.:
						<div  class="window_camera_umidita">20.21</div>
						Perc.:
						<div  class="window_camera_percepita">20.21</div>	
						</br>
						*Studio-> Temp.:
						<div  class="window_studio_temperatura">20.21</div>
						Umid.:
						<div  class="window_studio_umidita">20.21</div>
						Perc.:
						<div  class="window_studio_percepita">20.21</div>	
						</br></br>
						<div  class="window_esterna_timestamp">2001/01/01 18:19:20</div>
						</br></br>
					</div>

					</center>
			</div>
			<?php 	require_once("./footer.php");  ?>
		</div>		
	</body> 
</html>  