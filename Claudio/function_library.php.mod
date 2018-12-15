<?php

	function example(){
		echo "hello";
	}
	
	// function visitThisExternalPage($urlToVisit){
		// if(!(INTERNET_CONNECTED_MODE)){return("");} // Se lavoriamo senza connessione usciamo subito...
		// $ch = curl_init($urlToVisit);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_URL, $urlToVisit);		
		// $storeresult = curl_exec($ch);
		// curl_close($ch);	
		// return($storeresult);	
	// }
		
	// function visitThisLocalPage($urlToVisit){
		// $ch = curl_init($urlToVisit);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_URL, $urlToVisit);		
		// $storeresult = curl_exec($ch);
		// curl_close($ch);	
		// return($storeresult);	
	// }
		
	function getParameterAssociatedNameByBoardName($boardName, $fileAssociationXml){
		$associatedName = $boardName;
		foreach($fileAssociationXml->assignment as $singleAssignemenrt){
			//echo "looking for: " . $boardName . "  -- comparing with: " .  $singleAssignemenrt[@boardname] . "<br/>";
			if($singleAssignemenrt[@boardname] == $boardName){ $associatedName = $singleAssignemenrt; }
		}
		return($associatedName);
	}
	
	
	
	function getDisplayValueByBoardName($boardName, $fileAssociationXml){
		$displayValue = "true";
		foreach($fileAssociationXml->assignment as $singleAssignemenrt){
			//echo "looking for: " . $boardName . "  -- comparing with: " .  $singleAssignemenrt[@boardname] . "<br/>";
			if($singleAssignemenrt[@boardname] == $boardName){ $displayValue = $singleAssignemenrt[@display]; }
		}
		return($displayValue);
	}
	
	function getValueTypeByBoardName($boardName, $fileAssociationXml){
		$valueType = "";
		foreach($fileAssociationXml->assignment as $singleAssignemenrt){
			//echo "looking for: " . $boardName . "  -- comparing with: " .  $singleAssignemenrt[@boardname] . "<br/>";
			if($singleAssignemenrt[@boardname] == $boardName){ $valueType = $singleAssignemenrt[@type]; }
		}
		return($valueType);
	}
	
	
	
	

	
	
	function getIstantValue($labelName, $nomeCampo){
		$query = "SELECT * FROM stanze WHERE nome_stanza = '".$labelName."'";
		$result = executeQuery($query);
		$fetchedArray = parseResultIntoArray($result);
		return( $fetchedArray[0]->["$nomeCampo"]) ;
	}
	
	
	
	
	
	
?>