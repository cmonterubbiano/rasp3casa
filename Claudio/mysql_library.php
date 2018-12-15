<?php

//	require_once("./global_var.php");
	

	function executeQuery($query){
		$MYSQL_USER = DB_USER;
		$MYSQL_PASS = DB_PASSWORD;
		$MYSQL_DATABASE = DB_NAME;
		$MYSQL_HOST = DB_HOST;
		
		$link = mysqli_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASS, $MYSQL_DATABASE);
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		
		/* Execute Query*/
		//$result = mysqli_query($link, $query, MYSQLI_USE_RESULT);
		$result = mysqli_query($link, $query);
		
		/* close connection */
		mysqli_close($link);		
		
		return($result);
	}
	
	function parseResultIntoArray($result){
		if ($result) {
			
			$fetchedResult = Array();
			/* fetch associative array */

			while ($obj = mysqli_fetch_object($result)) {
				//printf ("%s (%s)\n", $obj->Name, $obj->CountryCode);
				array_push($fetchedResult, $obj);
				
			}			
			
			/* free result set */
			mysqli_free_result($result);
		}		
		
		return($fetchedResult);
	}
	
	
	
	
	
	
?>