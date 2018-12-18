<?php

//http://marietto.duckdns.org:8080/Claudio/scriviArduino.php?mittente=IO&stanza=cucina&azione=apri
//http://marietto.duckdns.org:8080/Claudio/scriviArduino.php?mittente=raspberry&stanza=allarme&azione=APRI
//
//
if(isset($_REQUEST["mittente"])){
	$mittente = $_REQUEST["mittente"];
} else {die("manca mittente");}

if(isset($_REQUEST["stanza"])){
	$stanza = $_REQUEST["stanza"];
} else {die("manca stanza");}

if(isset($_REQUEST["azione"])){
	$azione = $_REQUEST["azione"];
} else {die("manca azione");}
$result = exec('sudo /usr/bin/python /var/www/html/Claudio/arduinoWrite.py '.$mittente.'\|'.$stanza.'\|'.$azione);
		
echo "risultato: ".$result;
// /usr/bin/python /var/www/marietto/arduinoWrite.py raspberry\|camera_ospiti\|serranda_1\|APRI

//http://192.168.1.206/marietto/scriviArduino.php?mittente=raspberry&stanza=camera_ospiti&serranda=serranda_1&azione=APRI


?>
