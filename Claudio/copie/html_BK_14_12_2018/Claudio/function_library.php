<?php

	function example(){
		echo "hello";
	}
			
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
		$query = "SELECT ".$nomeCampo." as risultato FROM stanze WHERE nome_stanza = '".$labelName."'";
		$result = executeQuery($query);
		$fetchedArray = parseResultIntoArray($result);
		return( $fetchedArray[0]->risultato) ;
	}
?>