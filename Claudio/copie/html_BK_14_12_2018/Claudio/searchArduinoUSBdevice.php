<?php

require_once '/var/www/html/Claudio/global_var.php';


// LOOK FOR INVERTE PORT IN SYSTEM

$cmd = "dmesg | grep tty";
$resultArray = new ArrayObject();
$resultString = shell_exec ( $cmd );
//$resultString = exec ( $cmd, $resultArray );
if(!(isset($resultString))){ return(-1); }
$resultArray = explode("\n", $resultString);
//echo "<br/>DEBUG sRTING:: " . $resultString . "<br/>";

foreach($resultArray as $resultLine){
	
	$pos = strrpos($resultLine, "ch341-uart converter now attached");
	if(!($pos === false)) { 
		//echo $resultLine;
		$resultLineArray = explode(" ", $resultLine);
		$devicePort = $resultLineArray[count($resultLineArray) - 1];
		echo $devicePort;
		return;
		//return($devicePort);
	}	
	
}



?>