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
		logToFile("argv[1] -> " . $argv[1]);
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
			
		}
		// da qui inizia LUCIO
		elseif(!strcmp($nome_arduino, "lettura_433"))
		{
			$valore_codice = trim ($array_parametri[1]);
			echo $valore_codice . "\n";
			aggiornaValoriSensori($valore_codice);
		}
		elseif(!strcmp($nome_arduino, "arduino_433"))
		{
			$codice_segnale = trim ($array_parametri[1]);
			echo "codice_segnale: " . $codice_segnale . "\n";
			$valoreLetto = leggiSingoloSensore($codice_segnale);
			if ($valoreLetto)
			{
				aggiornaValoriLog("ALLARME",$valoreLetto);
				aggiornaInAllarme("IN ALLARME");
				$valoreLetto =str_replace(' ', '~', $valoreLetto);
				echo "valoreLetto: " . $valoreLetto . "\n";
				$result = exec('sudo /usr/bin/python /var/www/html/Claudio/arduinoWrite.py Allarme\|'.$valoreLetto);	
				echo "risultato: ".$result;
			}
			else
			{
				echo "nessun ritorno".  "\n";
			}
			
		}
		elseif(!strcmp($nome_arduino, "allarme_spento"))
		{
			aggiornaStatusAllarme("SPENTO", 0, 0, 0, 0);
		}
		elseif(!strcmp($nome_arduino, "allarme_generale"))
		{
			aggiornaStatusAllarme("ACCESO", 0, 1, 0, 0);
		}
		elseif(!strcmp($nome_arduino, "allarme_notte"))
		{
			aggiornaStatusAllarme("HOME", 0, 0, 1, 0);
		}
		elseif(!strcmp($nome_arduino, "allarme_tipo_1"))
		{
			aggiornaStatusAllarme("TIPO_1", 0, 0, 0, 1);
		}
		elseif(!strcmp($nome_arduino, "allarme_test"))
		{
			aggiornaStatusAllarme("TEST", 1, 0, 0, 0);
		}
		elseif(!strcmp($nome_arduino, "allarme_aiuto"))
		{
			aggiornaInAllarme("AIUTO");
		}
		elseif(!strcmp($nome_arduino, "arduino_sirena"))
		{
			$valoreLetto = leggiSuoniSirena();
			//echo "valoreLetto: " . $valoreLetto . "\n";
			for(;;)
			{
				$lung =strlen($valoreLetto);
				//echo "lunghezza inizio -> " . $lung . "\n";
				
				if (!$lung)
					break;
				
				if (($title =strpos($valoreLetto, '~')))
				{
					$parz =substr($valoreLetto, 0, $title);
					//echo "porzione -> " . $title . " - " . $parz . "\n";
					logToFile($parz);
					$result = exec('sudo /usr/bin/python /var/www/html/Claudio/arduinoWrite.py raspberry_sirena\|'.$parz);
					sleep(1);
					$valoreLetto =substr($valoreLetto, ($title +1), ($lung -$title));
					//echo $valoreLetto . "\n";
				}
				else
					break;
			}
			$result = exec('sudo /usr/bin/python /var/www/html/Claudio/arduinoWrite.py raspberry_fine_sirena');
		}
		else
		{
			logToFile("Argomento non previsto");
			echo $argv[1] . "\n";
		}
	}
	elseif(isset($_REQUEST["nome_colonna"]))
	{
		//http://192.168.1.203/marietto/prova.php?nome_colonna=temperatura&nome_stanza=camera_ospiti&valore_colonna=98
		//http://marietto.duckdns.org:8080/Claudio/readwriteDb.php?nome_colonna=status&nome_stanza=termosifoni&valore_colonna=%22molto%20caldi%22
		$nome_colonna = $_REQUEST["nome_colonna"];
		$nome_stanza = $_REQUEST["nome_stanza"];
		$valore_colonna = $_REQUEST["valore_colonna"];
		logToFile("nome_colonna-> " . $nome_colonna . "-" . $nome_stanza . "-" . $valore_colonna);
		aggiornaValoriStanze($nome_colonna,$nome_stanza,$valore_colonna);
		leggiValoriStanze();
	}
	// da qui inizia LUCIO
	elseif(isset($_REQUEST["r_allarme_comando"]))
	{
		logToFile("r_allarme_comando-> " . $_REQUEST["r_allarme_comando"]);
		//http://marietto.duckdns.org:8080/Claudio/readwriteDb.php?r_allarme_comando=Spegni
		//http://192.168.1.205/Claudio/readwriteDb.php?r_allarme_comando=Spegni
		$nome_comando = $_REQUEST["r_allarme_comando"];
		$result = exec('sudo /usr/bin/python /var/www/html/Claudio/arduinoWrite.py '.$nome_comando);	
		echo "risultato: ".$result;
	}
	else 
	{
		logToFile("Chiamata senza argomenti non prevista");
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

function aggiornaValoriSensori($valore_codice)
{
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlQuery = "SELECT * FROM sensori WHERE `sensori`.`id` =1";
	$result = $conn->query($sqlQuery);

	if ($result->num_rows >0)
	{
		$sqlQueryUpdate = "UPDATE `claudio`.`sensori` SET `Codice` = '$valore_codice' WHERE `sensori`.`id` =1";
		$result = $conn->query($sqlQueryUpdate);
		echo $sqlQueryUpdate. "<br>\n";
	}
	else
	{
		$sqlQueryInsert = "INSERT `sensori` SET `Codice` = '$valore_codice', `id` = 1 ;";
		$result = $conn->query($sqlQueryInsert);
		echo $sqlQueryInsert. "<br>\n";
	}
	$conn->close();
}	


function leggiSingoloSensore($valore_codice)
{
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlQuery = "SELECT * FROM sensori WHERE `sensori`.`Codice` = '$valore_codice' AND `sensori`.`id` !=1";
	$result = $conn->query($sqlQuery);

	if ($result->num_rows ==1)
	{
		while($riga = $result->fetch_assoc())
		{
			$descrizione =$riga["descrizione"];
			$messaggi =$riga["messaggi"];
			$telefono =$riga["telefono"];
			$sirena =$riga["sirena"];
			$id =$riga["id"];
			$data = date("Y-m-d H:i:s");
			//echo "data -> " . $data . "\n";
			
			//$sqlQueryUpdate = "UPDATE `claudio`.`sensori` SET `aggiornamenti` = `aggiornamenti`+1 WHERE `sensori`.`id` =$id";
			$sqlQueryUpdate = "UPDATE `claudio`.`sensori` SET `timestamp` = '$data' WHERE `sensori`.`id` =$id";
			if ($conn->query($sqlQueryUpdate) === TRUE)
			{
				echo "Record updated successfully". "\n";
			}
			else
			{
				echo "Error updating record: " . $conn->error. "\n";
			}
			if (leggiStatoAllarme($riga["Generale"], $riga["Notte"], $riga["Vario"]))
			{
				return($descrizione."\|".$messaggi."\|".$telefono."\|".$sirena);
			}
		}
	}
	echo "";
	
	$conn->close();
}	

function leggiStatoAllarme($valore_generale, $valore_notte, $valore_vario)
{
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlQuery = "SELECT * FROM allarme WHERE `allarme`.`id` =1";
	$result = $conn->query($sqlQuery);

	if ($result->num_rows ==1)
	{
		while($riga = $result->fetch_assoc()) {
		if (!$riga["in_allarme"])
		{	
			if ($riga["generale"] && $valore_generale =="SI")
				return(1);
			if ($riga["notte"] && $valore_notte =="SI")
				return(1);
			if ($riga["tipo_1"] && $valore_vario =="SI")
				return(1);
		}
		}
	}

	return(0);
	
	$conn->close();
}

function aggiornaInAllarme($valore_status)
{
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlQuery = "SELECT * FROM allarme WHERE  `allarme`.`id` =1";
	$result = $conn->query($sqlQuery);

	if ($result->num_rows ==1)
	{
		while($riga = $result->fetch_assoc())
		{		
			//$sqlQueryUpdate = "UPDATE `claudio`.`allarme` SET `allarme`.`status` =$valore_status";
			$sqlQueryUpdate = "UPDATE `claudio`.`allarme` SET `status` = '$valore_status', `in_allarme` =1  WHERE `allarme`.`id` =1";

			if ($conn->query($sqlQueryUpdate) === TRUE)
			{
				echo "Record updated successfully". "\n";
			}
			else
			{
				echo "Error updating record: " . $conn->error. "\n";
			}
		}
	}
	
	$conn->close();
}

function aggiornaStatusAllarme($valore_status, $con, $gen, $not, $tip )
{
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlQuery = "SELECT * FROM allarme WHERE  `allarme`.`id` =1";
	$result = $conn->query($sqlQuery);

	if ($result->num_rows ==1)
	{
		while($riga = $result->fetch_assoc())
		{		
			//$sqlQueryUpdate = "UPDATE `claudio`.`allarme` SET `allarme`.`status` =$valore_status";
			$sqlQueryUpdate = "UPDATE `claudio`.`allarme` SET `status` = '$valore_status', `in_allarme` =0, `test` =$con, `generale` =$gen, `notte` =$not, `tipo_1` =$tip  WHERE `allarme`.`id` =1";

			if ($conn->query($sqlQueryUpdate) === TRUE)
			{
				echo "Record updated successfully". "\n";
			}
			else
			{
				echo "Error updating record: " . $conn->error. "\n";
			}
		}
	}
	
	$conn->close();
}

function leggiSuoniSirena()
{
	$rito ="";
	// Create connection
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	$sqlQuery = "SELECT * FROM sirena";
	$result = $conn->query($sqlQuery);

	if ($result->num_rows >0)
	{
		while($riga = $result->fetch_assoc())
		{
			$rito .=$riga["azione"]."\|".$riga["cicli"]."\|".$riga["tempo_ciclo"]."\|".$riga["tempo_intervallo"]."~";
			//echo $rito . "\n";
		}
	}

	return($rito);
	
	$conn->close();
}		
?>