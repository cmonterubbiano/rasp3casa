<?php

$responseArray = array();
$responseArray["una_variabile"] = "prima";
$responseArray["esito_exec"] = exec('sudo /usr/bin/python3 /var/www/html/Claudio/leggi_433', $output);	
$responseArray["output"] = $output;
echo json_encode($responseArray);


?>

