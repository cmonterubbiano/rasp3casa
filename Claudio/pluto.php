<?php
/*
http://marietto.duckdns.org:8080/Claudio/pluto.php

{"corridoio":{"temperatura":"","status":"","luce":"STUTATA","umidita":"","percepita":""},
"cucina":{"temperatura":"20.00","status":"","luce":"STUTATA","umidita":"44.00","percepita":"25.28"},
"studio":{"temperatura":"","status":"","luce":"","umidita":"","percepita":""},
"camera":{"temperatura":"","status":"","luce":"","umidita":"","percepita":""},
"bagno":{"temperatura":"","status":"","luce":"","umidita":"","percepita":""},
"camera_ospiti":{"temperatura":"","status":"","luce":"","umidita":"","percepita":""},
"sala":{"temperatura":"","status":"","luce":"","umidita":"","percepita":""},
"termosifoni":{"temperatura":"","status":"STUTATI","luce":"","umidita":"","percepita":""},
"allarme":{"temperatura":"","status":"TEST","luce":"","umidita":"","percepita":""},
"zona_giorno":{"temperatura":"","status":"attesa","luce":"","umidita":"","percepita":""},
"zona_notte":{"temperatura":"","status":"attesa","luce":"","umidita":"","percepita":""},
"terrazzo_cucina":{"temperatura":"19.70","status":"attesa","luce":"","umidita":"54.30","percepita":"25.09"},
"finestra_bagno":{"temperatura":"","status":"attesa","luce":"","umidita":"","percepita":""},
"terrazzo_sala":{"temperatura":"1.1","status":"attesa","luce":"luce","umidita":"2.2","percepita":"3.3"}}
*/


require_once("config.php");

//if(isset($_REQUEST["message"])){
//	$jsonMessage = json_decode($_REQUEST["message"]);
//} else { die("message is not defined"); }
	$jsonMessage = json_decode($_REQUEST["message"]);








$responseObj = new stdClass();

// analize directory
$returnMessage = "ciao";
$nameOfproperty = "risposta";

$responseObj = getValoriDb();
//$responseObj->$nameOfproperty = $returnMessage . "<br/>";

/*
echo "<br/>--------------------------<br/>";
echo "<pre>" . print_r($responseObj) . "</pre>";
echo "<br/>--------------------------<br/>";
*/

echo json_encode($responseObj);


function getValoriDb(){
	$responseObj = new stdClass();
	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error); }

	// query SELECT
	$sqlQueryUpdate = "SELECT * FROM `claudio`.`stanze` ;";
	$result = $conn->query($sqlQueryUpdate);
	$arrayOggettiRiga = array();
	
		if ($result->num_rows > 0) {
			// output data of each row
			while($riga = $result->fetch_assoc()) {
				
				//echo "<br/> - id: " . $riga["id"]. " - nome_stanza: " . $riga["nome_stanza"]. " temperatura: " . $riga["temperatura"]. "<br>\n";
				
				/*
				$oggettoRiga = new stdClass();
				$oggettoRiga->nome_stanza = $riga["nome_stanza"];
				$oggettoRiga->temperatura = $riga["temperatura"];
				$oggettoRiga->id = $riga["id"];
				$oggettoRiga->status = $riga["status"];
				array_push($arrayOggettiRiga, $oggettoRiga);
				*/
				
				
				//$responseObj->{$riga["nome_stanza"]}->nome_stanza = $riga["nome_stanza"];
				$responseObj->{$riga["nome_stanza"]}->temperatura = $riga["temperatura"];
				$responseObj->{$riga["nome_stanza"]}->status = $riga["status"];
				$responseObj->{$riga["nome_stanza"]}->luce = $riga["luce"];
				$responseObj->{$riga["nome_stanza"]}->umidita = $riga["umidita"];
				$responseObj->{$riga["nome_stanza"]}->percepita = $riga["percepita"];
				



			}
		} else {
			echo "0 results";
		}	
		
	$conn->close();

	

	return($responseObj);	
	//return($arrayOggettiRiga);	
}





?>
