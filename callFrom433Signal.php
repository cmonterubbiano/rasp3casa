<?php
require_once '/var/www/smartHome/mysql_library.php';
require_once '/var/www/smartHome/global_var.php';
require_once '/var/www/smartHome/function_library.php';
require_once '/var/www/smartHomeDaemon/library/db_connection.php';

	if (isset($argv[1])) {
		$signal = trim ((string)$argv[1]);
		//echo "AA-".$signal."-LL";
		//$returnValue = manageSignalCall($signal);
	} elseif(isset($_REQUEST["signal"])){
		$signal = $_REQUEST["signal"];
		//$returnValue = manageSignalCall($signal);
	} else {
		die("no signal to process");
	}

	
	echo "segnale arrivato:: ".$signal;
	
function manageSignalCall($signal){
	date_default_timezone_set("Europe/Rome"); 
	$stringedSignal = (string)$signal;
	
	//comunque inserire nel LOG:
	// per adesso disabilito il LOG non se sa mai...
	//file_put_contents('logFromArduino.txt', $stringedSignal.PHP_EOL , FILE_APPEND);
	
	//full Log su DB per Debug
	//storeSignalInDbForDebug($stringedSignal);
	
	// Special Cancello
	if($stringedSignal == "13894668"){
		//storeSignalInDbForDebug($stringedSignal);
		apriCancelloSeNonLoHaiApertoDaPoco($stringedSignal);
	}
	
	// Controlla se è Feed USB da Seriale, inizia per FEED:
	$singInitPart = substr($stringedSignal,0,5);
	if($singInitPart == "FEED:"){
		//storeSignalInDbForDebug($stringedSignal);

		$currentTimeStamp = time();	
		$openDbConnection = dbOpenConnection();
		$query = "INSERT INTO 433_ricezione (segnale, descrizione, php_stamp) VALUES ('".$stringedSignal."','FEEDBACK-COMANDO-USB',".$currentTimeStamp.");";
		$result = mysqli_query($openDbConnection, $query);
		
		aggiornaStatoDispositivoInTabellaFeedUSB($stringedSignal,$openDbConnection);
		dbCloseConnection($openDbConnection);			
		return ("inizia con FFED:, viene da Seriale USB, inserito nelDB");
	}	
	
	
	$digit_1 = (int) (substr($stringedSignal, 0, 1));
	
	//solo per test feedback adesso
	if((strlen($stringedSignal) == 8)&&($digit_1 == 1)){

		$digit_5 = (int) (substr($stringedSignal, 4, 1));
		
		if($digit_5 == 1){
			$currentTimeStamp = time();	
			$openDbConnection = dbOpenConnection();
			$query = "INSERT INTO 433_ricezione (segnale, descrizione, php_stamp) VALUES ('".$stringedSignal."','FEEDBACK-COMANDO-WEB',".$currentTimeStamp.");";
			$result = mysqli_query($openDbConnection, $query);
			
			aggiornaStatoDispositivoInTabella($stringedSignal,$openDbConnection);
			dbCloseConnection($openDbConnection);			
		}
		return ("segnale di 8 cifre, inizia con 1, ha cifra feedback = 1, inserito nelDB");
		
	}
	
	if(strlen($stringedSignal) == 4){
		//Humidity signal... probably
		
		$digit_1 = (int) (substr($stringedSignal, 0, 1));
		$digit_2 = (int) (substr($stringedSignal, 1, 1));
		$digit_3 = (int) (substr($stringedSignal, 2, 1));
		$digit_4 = (int) (substr($stringedSignal, 3, 1));

		$sum = $digit_1 + $digit_2 + $digit_3;
		$rest = $sum % 10;
		if($rest != $digit_4){ return ("Non un segnale di humidity, cifra controllo non valida"); }		
		
		// cerchiamo il mittente
		switch ($digit_1) {
			case 1:
				$labelIdentifier = "cond_SALA_temp"; break;
			case 2:
				$labelIdentifier = "cond_SUD_temp"; break;
			case 3:
				$labelIdentifier = "cond_NORD_temp"; break;
			case 6:
				$labelIdentifier = "cond_SALA_umid"; break;
			case 7:
				$labelIdentifier = "cond_SUD_umid"; break;
			case 8:
				$labelIdentifier = "cond_NORD_umid"; break;
			default:
				return ("Non un segnale di humidity, mittente sconosciuto");
		}		
		
		
		// se siamo qui è valida
		
		$valoreTempString = substr($stringedSignal, 1, 2);
		$openDbConnection = dbOpenConnection();
		//Scrivi in DB valori_istantanei l'ultima temperatura-umidita ricevuta
		$sql ="UPDATE valori_istantanei SET valore='".$valoreTempString."' WHERE etichetta='".$labelIdentifier."'";
		$result = mysqli_query($openDbConnection, $sql);
		dbCloseConnection($openDbConnection);
		return ("Segnale humidity registrato");
	}
	
	if(strlen($stringedSignal) != 6){ return ("Non un segnale di consumo, no 6 cifre"); }	
	
	$digit_1 = (int) (substr($stringedSignal, 0, 1));
	$digit_2 = (int) (substr($stringedSignal, 1, 1));
	$digit_3 = (int) (substr($stringedSignal, 2, 1));
	$digit_4 = (int) (substr($stringedSignal, 3, 1));
	$digit_5 = (int) (substr($stringedSignal, 4, 1));
	$digit_6 = (int) (substr($stringedSignal, 5, 1));	

	$sum = $digit_1 + $digit_2 + $digit_3 + $digit_4 + $digit_5;
	$rest = $sum % 10;
	if($rest != $digit_6){ return ("Non un segnale di consumo, cifra controllo non valida"); }
		
	// Lettura Potenza Contatore
	if($digit_1 == 7){ 
		$valoreConsumo = substr($stringedSignal, 1, 4);
		storeValueInDBforContatore($valoreConsumo);
	}
	elseif($digit_1 == 5){ 
	//Lettura Temperatura Esterna Negativa
		$valoreTemp = (float)(substr($stringedSignal, 1, 4));
		$valoreTemp = $valoreTemp * -1 / 100;
		$valoreTempString = (string)$valoreTemp;
		
		storeValueInDBForTemperatura($valoreTempString);

		return ("temperatura_esterna: $valoreTemp salvato in DB");		
				
	}
	elseif($digit_1 == 6){ 
	//Lettura Temperatura Esterna Positiva
		$valoreTemp = (float)(substr($stringedSignal, 1, 4));
		$valoreTemp = $valoreTemp / 100;
		$valoreTempString = (string)$valoreTemp;
		
		storeValueInDBForTemperatura($valoreTempString);

		return ("temperatura_esterna: $valoreTemp salvato in DB");				
	}
	else{
		return ("Non un segnale di consumo, no 5,6,7"); 
	}
		
}

function storeValueInDBForTemperatura($valoreTempString){
	$openDbConnection = dbOpenConnection();
	//Scrivi in DB valori_istantanei l'ultima temperatura ricevuta
	$sql ="UPDATE valori_istantanei SET valore='".$valoreTempString."' WHERE etichetta='temperatura_esterna'";
	$result = mysqli_query($openDbConnection, $sql);
	dbCloseConnection($openDbConnection);	
}



function storeValueInDBforContatore($valoreContatoreEnel){
	$valoreContatoreEnelNumber = (int)$valoreContatoreEnel;
	$openDbConnection = dbOpenConnection();
	//Scrivi in DB valori_istantanei l'ultima consumo_contatore
	$sql ="UPDATE valori_istantanei SET valore='".$valoreContatoreEnelNumber."' WHERE etichetta='consumo_contatore'";
	$result = mysqli_query($openDbConnection, $sql);
	return ("consumo_contatore: $valoreContatoreEnelNumber salvato in DB");		
}

function aggiornaStatoDispositivoInTabella($stringedSignal,$openDbConnection){
	
	$destinatario = (int) (substr($stringedSignal, -1, 1));
	$comando = (int) (substr($stringedSignal, -2, 1));
	//$ripetizione = (int) (substr($stringedSignal, -3, 1));
	//$feedback = (int) (substr($stringedSignal, -4, 1));

	//Escludiamo STUFETTA:
	if($destinatario != 4){
		// azzeriamo gli stati del dispositivo in questione
		$query = "UPDATE `comandi_pulsanti_433` SET stato_attuale='utilizzabile' WHERE destinatario=".$destinatario;
		$result = mysqli_query($openDbConnection, $query);	
		
		// Aggiorniamo l'unico attivo
		$query = "UPDATE `comandi_pulsanti_433` SET stato_attuale='attivo' WHERE destinatario=".$destinatario." AND comando=".$comando;
		$result = mysqli_query($openDbConnection, $query);	
	}
}


function aggiornaStatoDispositivoInTabellaFeedUSB($stringedSignal,$openDbConnection){
	
	$arrayOfUsbCommad = explode(":",$stringedSignal);
	array_shift($arrayOfUsbCommad); // togliamo FEED
	$dispositivoDestinatario = $arrayOfUsbCommad[0];
	$originalSignal = implode(":",$arrayOfUsbCommad);

	//Escludiamo STUFETTA:
	if($dispositivoDestinatario != "cSTUF"){
		// azzeriamo gli stati del dispositivo in questione
		$query = "UPDATE `comandi_pulsanti_433` SET stato_attuale='utilizzabile' WHERE serialCommand LIKE '".$dispositivoDestinatario."%'";
		$result = mysqli_query($openDbConnection, $query);	
		
		// Aggiorniamo l'unico attivo
		$query = "UPDATE `comandi_pulsanti_433` SET stato_attuale='attivo' WHERE serialCommand='".$originalSignal."'";
		$result = mysqli_query($openDbConnection, $query);	
	}
}


function storeSignalInDbForDebug($stringedSignal){
	$currentTimeStamp = time();	
	$openDbConnection = dbOpenConnection();
	$query = "INSERT INTO 433_ricezione (segnale, descrizione, php_stamp) VALUES ('".$stringedSignal."','debug',".$currentTimeStamp.");";
	$result = mysqli_query($openDbConnection, $query);
	dbCloseConnection($openDbConnection);			
}
	
	
function apriCancelloSeNonLoHaiApertoDaPoco($stringedSignal){
	$currentTimeStamp = time();	
	$openDbConnection = dbOpenConnection();
	$lastTime = 0;
	
	$querySelect = "SELECT * from 433_ricezione WHERE segnale='".$stringedSignal."' ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($openDbConnection, $querySelect);
	if(mysqli_num_rows($result) != 0){
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$lastTime = $row["php_stamp"];
	}
	mysqli_free_result($result);
	
	if(($currentTimeStamp - $lastTime) > 30){
		$query = "INSERT INTO 433_ricezione (segnale, descrizione, php_stamp) VALUES ('".$stringedSignal."','debug',".$currentTimeStamp.");";
		$result = mysqli_query($openDbConnection, $query);
		
		$urlToVisit = "http://192.168.1.201/leds.cgi?led=H";
		$resp = visitThisLocalPage($urlToVisit);		
		
	}
	mysqli_free_result($result);
	
	dbCloseConnection($openDbConnection);			
}	


	
	

?>
