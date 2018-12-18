<?php

require_once("../config.php");
/*
	if (isset($argv[0])) { echo $argv[0] . "\n";}
	if (isset($argv[1])) { echo $argv[1] . "\n";}
	
	if (isset($argv[2])) { echo $argv[2] . "\n";}
	if (isset($argv[3])) { echo $argv[3] . "\n";}
	*/


	
	if (isset($argv[1])) 
	{
		echo "sono argomenti". "\n";
		//php /var/www/html/Claudio/readwriteDb.php arduino\|termosifoni\|status\|caldini
		logToFile($argv[1]);
	}
	elseif(isset($_REQUEST["nome_colonna"]))
	{
				echo "sono URL". "\n";
		logToFile($_REQUEST["nome_colonna"]);
		//http://192.168.1.203/marietto/prova.php?nome_colonna=temperatura&nome_stanza=camera_ospiti&valore_colonna=98
		//http://marietto.duckdns.org:8080/Claudio/readwriteDb.php?nome_colonna=status&nome_stanza=termosifoni&valore_colonna=%22molto%20caldi%22
		//http://marietto.duckdns.org:8080/Claudio/readwriteDb.php
		$nome_colonna = $_REQUEST["nome_colonna"];
		$nome_stanza = $_REQUEST["nome_stanza"];
		$valore_colonna = $_REQUEST["valore_colonna"];
	}
	else 
	{
		die("no signal to process");
	}
	
	
function logToFile($stringToLog){
		
	file_put_contents("/var/www/html/Claudio/test/log.txt",date("c") . " - " . $stringToLog . "\n" , FILE_APPEND);
}	




?>