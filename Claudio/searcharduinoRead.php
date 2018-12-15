<?php

require_once '/var/www/html/Claudio/global_var.php';


// LOOK FOR INVERTE PORT IN SYSTEM

$cmd = "ps -fe | grep arduinoRead.py";
$resultArray = new ArrayObject();
$resultString = shell_exec ( $cmd );
//$resultString = exec ( $cmd, $resultArray );
if(!(isset($resultString))){ return(-1); }
$resultArray = explode("\n", $resultString);
//echo "<br/>DEBUG sRTING:: " . $resultString . "<br/>";

foreach($resultArray as $resultLine){
	
	$pos = strrpos($resultLine, "/usr/bin/python");
	if(!($pos === false)) { 
		//echo $resultLine;
//	$resultLineArray = explode(" ", $resultLine);
//	$devicePort = $resultLineArray[count($resultLineArray) - 1];
//	echo $devicePort;
		echo "TROVATO";
		return;
		//return($devicePort);
	}	
	
}



?>
