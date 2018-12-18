<?php
$responseArray = array();
$responseArray["una_variabile"] = "prima rc Local";
$responseArray["esito_exec"] = exec('sudo /etc/rc.local', $output);	
$responseArray["output"] = $output;
echo json_encode($responseArray);
?>

