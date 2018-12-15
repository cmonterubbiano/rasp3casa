<?php
http://192.168.1.205/Claudio/recuperaDatiSensore.php?codice_sensore=480048&tipo=A
	require_once("./global_var.php");
	require_once("./function_library.php");
	require_once("./mysql_library.php");
	
	// se non attibuisco $ codice e scrivo direttamente syntax erro
	$codice =$_REQUEST['codice_sensore'];
	$tipo =$_REQUEST['tipo'];

	if ($tipo ==A)
	{
		$query = "SELECT * FROM sensori WHERE `sensori`.`id` ='1' and `sensori`.`Codice` =$codice";
		$result = executeQuery($query);
		
		if ($result->num_rows <1)
			$query = "DELETE FROM `claudio`.`sensori` WHERE `sensori`.`Codice` =$codice";
		else
			$query = "DELETE FROM `claudio`.`sensori` WHERE `sensori`.`id` ='1' and `sensori`.`Codice` =$codice";
		
		$result = executeQuery($query);
		//echo "<h1>Sensore annullato.</h1>";
			//echo "<h2>Inoltro a AUTOMAZIONE CONSUMI....</h2>";
		header('Refresh: 2; ./Gestione_sensori.php'); 
	}
	else
	{
		$query = "SELECT * FROM sensori WHERE `sensori`.`id` !='1' and `sensori`.`Codice` =$codice";
	
		$result = executeQuery($query);

		$fetchedArray = parseResultIntoArray($result);

	//$jsonEndodedArrayOfTipologies = json_encode($fetchedArray);
		$jsonEndodedArrayOfTipologies = json_encode(array_pop($fetchedArray));

		// echo e' il ritorno della funzione
		echo $jsonEndodedArrayOfTipologies;
	}

?>