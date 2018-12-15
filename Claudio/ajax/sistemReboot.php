<?php

$responseArray = array();
$responseArray["una_variabile"] = "prima";
$responseArray["esito_exec"] = exec('sudo /sbin/reboot ', $output);	
$responseArray["output"] = $output;
echo json_encode($responseArray);


?>

