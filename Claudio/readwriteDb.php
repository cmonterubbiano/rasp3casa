<?php

require_once("config.php");
/*
	if (isset($argv[0])) { echo $argv[0] . "\n";}
	if (isset($argv[1])) { echo $argv[1] . "\n";}
	
	if (isset($argv[2])) { echo $argv[2] . "\n";}
	if (isset($argv[3])) { echo $argv[3] . "\n";}
	*/


	
	if (isset($argv[1])) 
	{
		//php /var/www/html/Claudio/readwriteDb.php arduino\|termosifoni\|status\|caldini
		logToFile($argv[1]);
//		echo (string)$argv[1] . "\n";
		$array_parametri = preg_split("/[|]+/", (string)$argv[1]);
//		echo (string)$array_parametri[0] . "\n";
		$nome_arduino = trim ($array_parametri[0]);
		if (!strcmp($nome_arduino, "arduino"))
		{
			$nome_stanza = trim ($array_parametri[1]);
			echo $nome_stanza . "\n";
			$nome_colonna = trim ($array_parametri[2]);
			echo $nome_colonna . "\n";
			$valore_colonna = trim ($array_parametri[3]);
			echo $valore_colonna . "\n";
			aggiornaValoriStanze($nome_colonna,$nome_stanza,$valore_colonna);
			leggiValoriStanze();
		}
		if (!strcmp($nome_arduino, "arduino_temp"))
		{
			$valore_data = trim ($array_parametri[1]);
			echo $valore_data . "\n";
			$valore_orario = trim ($array_parametri[2]);
			echo $valore_orario . "\n";
			$nome_colonna = trim ($array_parametri[3]);
			echo $nome_colonna . "\n";
			$valore_colonna = trim ($array_parametri[4]);
			echo $valore_colonna . "\n";
			aggiornaValoriTemperatura($valore_data, $valore_orario, $nome_colonna, $valore_colonna);
//			leggiValoriStanze();
		}
		elseif(!strcmp($nome_arduino, "arduino_allarme"))
		{
			$valore_comando = trim ($array_parametri[1]);
			echo $valore_comando . "\n";
			$valore_note= trim ($array_parametri[2]);
			echo $valore_note . "\n";
			aggiornaValoriLog($valore_comando,$valore_note);
		}
		elseif(!strcmp($nome_arduino, "arduino_select"))
		{
			$nome_stanza = trim ($array_parametri[1]);
			echo "nome_stanza: " . $nome_stanza . "\n";
			$nome_colonna = trim ($array_parametri[2]);
			echo "nome_colonna: " . $nome_colonna . "\n";
			$valoreLetto = leggiSingoloValore($nome_stanza, $nome_colonna);
			echo "valoreLetto: " . $valoreLetto . "\n";
			$result = exec('sudo /usr/bin/python /var/www/html/Claudio/arduinoWrite.py raspberry_select\|'.$valoreLetto);	
			echo "risultato: ".$result;
			
		}else{
			echo $argv[1] . "\n";
		}
	}
	elseif(isset($_REQUEST["nome_colonna"]))
	{
		logToFile($_REQUEST["nome_colonna"]);
		//http://192.168.1.203/marietto/prova.php?nome_colonna=temperatura&nome_stanza=camera_ospiti&valore_colonna=98
		//http://marietto.duckdns.org:8080/Claudio/readwriteDb.php?nome_colonna=status&nome_stanza=termosifoni&valore_colonna=%22molto%20caldi%22
		$nome_colonna = $_REQUEST["nome_colonna"];
		$nome_stanza = $_REQUEST["nome_stanza"];
		$valore_colonna = $_REQUEST["valore_colonna"];
		aggiornaValoriStanze($nome_colonna,$nome_stanza,$valore_colonna);
		leggiValoriStanze();
	}
	else 
	{
		die("no signal to process");
	}
	
	
function logToFile($stringToLog){
		
	file_put_contents("/var/www/html/Claudio/log.txt",date("c") . " - " . $stringToLog . "\n" , FILE_APPEND);
}	

function aggiornaValorilog($comando, $note){
	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error); }

	// query INSERT
	$sqlQueryInsert = "INSERT `log_allarme` SET `comando` = '$comando', `note` = '$note';";
	$result = $conn->query($sqlQueryInsert);
	
	$conn->close();
}	

//	aggiornaValoriStanze("temperatura","camera_ospiti",709);

//	leggiValoriStanze();
	
function aggiornaValoriStanze($nomeColonna, $nomeStanza, $temperatura){
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error); }

	// query UPDATE
	$sqlQueryUpdate = "UPDATE `claudio`.`stanze` SET `$nomeColonna` = '$temperatura' WHERE `stanze`.`nome_stanza` ='$nomeStanza';";
	echo $sqlQueryUpdate. "<br>\n";
	$result = $conn->query($sqlQueryUpdate);
	
	$conn->close();
}	

function aggiornaValoriTemperatura($valore_data, $valore_orario, $nomeColonna, $temperatura){
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error); }

	$sqlQuery = "SELECT * FROM temp_umid_perc WHERE `temp_umid_perc`.`ora` ='$valore_orario' AND `temp_umid_perc`.`data` ='$valore_data'";
	$result = $conn->query($sqlQuery);

		if ($result->num_rows >0) {
			$sqlQueryUpdate = "UPDATE `claudio`.`temp_umid_perc` SET `$nomeColonna` = '$temperatura' WHERE `temp_umid_perc`.`ora` ='$valore_orario' AND `temp_umid_perc`.`data` ='$valore_data'";
			$result = $conn->query($sqlQueryUpdate);
			echo $sqlQueryUpdate. "<br>\n";
		}
		else
		{
			$sqlQueryInsert = "INSERT `temp_umid_perc` SET `data` = '$valore_data', `ora` = '$valore_orario',`$nomeColonna` = '$temperatura' ;";
			$result = $conn->query($sqlQueryInsert);
			echo $sqlQueryInsert. "<br>\n";
		}
	
	$conn->close();
}	

//echo "CIAO: " . DB_NAME;

function leggiValoriStanze(){
	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error); }

	// query SELECT
		$sqlQuery = "SELECT * FROM stanze";
		$result = $conn->query($sqlQuery);

		if ($result->num_rows > 0) {
			// output data of each row
			while($riga = $result->fetch_assoc()) {
				echo "id: " . $riga["id"]. " - nome_stanza: " . $riga["nome_stanza"]. " status: " . $riga["status"]. "<br>\n";
			}
		} else {
			echo "0 results";
		}
	$conn->close();
}



function leggiSingoloValore($nomeStanza, $nomeColonna){
	// Create connection
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error); }

	// query SELECT
		$sqlQuery = "SELECT ".$nomeColonna." FROM stanze WHERE nome_stanza = '".$nomeStanza."'";
		$result = $conn->query($sqlQuery);

		if ($result->num_rows > 0) {
			// output data of each row
			while($riga = $result->fetch_assoc()) {
				//echo "id: " . $riga["id"]. " - nome_stanza: " . $riga["nome_stanza"]. " temperatura: " . $riga["temperatura"]. "<br>\n";
				return($riga[$nomeColonna]);
			}
		} else {
			echo "0 results";
		}
	$conn->close();
}



?>