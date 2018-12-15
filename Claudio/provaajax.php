<?php

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
	
		if ($result->num_rows > 0) {
			// output data of each row
			while($riga = $result->fetch_assoc()) {
				//echo "id: " . $riga["id"]. " - nome_stanza: " . $riga["nome_stanza"]. " temperatura: " . $riga["temperatura"]. "<br>\n";
				$responseObj->$riga["nome_stanza"] = new stdClass();
				$responseObj->$riga["nome_stanza"]->temperatura = $riga["temperatura"];
				$responseObj->$riga["nome_stanza"]->umidita = $riga["umidita"];
				$responseObj->$riga["nome_stanza"]->percepita = $riga["percepita"];
				$responseObj->$riga["nome_stanza"]->status = $riga["status"];
				$responseObj->$riga["nome_stanza"]->luce = $riga["luce"];
			}
		} else {
			echo "0 results";
		}	
		
	$conn->close();
	return($responseObj);	
}





?>