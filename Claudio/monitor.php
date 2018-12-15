<?php 
	require_once("./login.php");

	require_once("./global_var.php");
	require_once("./function_library.php");
	require_once("./mysql_library.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITLE_OF_PROJECT; ?> - MENU</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>


<div class="container">
  <div class="header">
  	
  	<a href="./index.php" class="main_menu_link"><?php echo TITLE_OF_PROJECT; ?> - MAIN MENU</a> 
    <!-- end .header --></div>
 
<?php 	require_once("./top_menu.php");  ?>    
    
  <div class="content">
   
<?php
	require_once("./statistics/preparazioneGrafici.php");
	require_once("./statistics/graficoTemperatura.php");
	require_once("./library/read_temperatura.php");
//	require_once("./library/read_temperatura_433.php");
?>    
   
   		<div class="clearfloat" ></div>
    <!-- end .content --></div>
<?php 	require_once("./footer.php");  ?>    
  <!-- end .container --></div>
  


<div id="throbber_loader"><img src="css/images/ajax_loader.gif" alt="loading..." align="middle" /></div>

  
</body>
</html>




<?php



?>