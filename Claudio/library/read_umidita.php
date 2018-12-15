
<?php
	$statusXml = simplexml_load_file(URL_TO_STATUS_FILE);
	$remoteControlXml = simplexml_load_file(URL_TO_REMOTE_CONTROL_XML_FILE);
	$associatedNamesXml = simplexml_load_file(ASSOCIATED_NAMES_XML_FILES);
	
	$arrayOfUmidInputs = explode(":", LIST_OF_XML_UMID_INPUT_NAMES);

	
?>
<div class="panel_read_realys" >


<table class="relays_table">
	<thead>
    	<tr class="table_relays_title_row">
        	<td width="60%" >
        		SENSORE
            </td>
        	<td width="40%">
        		VALORE
            </td>
        </tr>
    </thead>
    <tbody>
<?php
	foreach($arrayOfUmidInputs as $singleTempInput){
		$displayThisRow = getDisplayValueByBoardName($singleTempInput, $associatedNamesXml);
		if($displayThisRow == "true"){
			echo '<tr class="table_relays_row" id="row_'.$singleTempInput.'">';
			
				$valueType = getValueTypeByBoardName($singleTempInput, $associatedNamesXml);
				echo '<td class="table_relays_td_interruttore">';
					$paramName = (string)getParameterAssociatedNameByBoardName($singleTempInput, $associatedNamesXml);
					echo $paramName; 
					if($valueType == "umidita"){ ?>
						<table class="legend_table"><tbody><tr><td class="legend_td very_bassa_temp">&nbsp;</td><td class="legend_td bassa_temp">&nbsp;</td><td class="legend_td normal_temp">&nbsp;</td><td class="legend_td alta_temp">&nbsp;</td><td class="legend_td very_alta_temp">&nbsp;</td></tr></tbody></table>
					<?php }
				echo '</td>';
			
				$classComfort = "";
				if($valueType == "umidita"){
					
					if($paramName == "umidita esterna"){
						// get it from DB
						$actualUmid = (float)getIstantValue('esterna', 'umidita');
						
					}
					if($paramName == "umidita cucina"){
						//get it from DB
						$actualUmid = (float)getIstantValue('cucina', 'umidita');
						
					}
					if($paramName == "umidita studio"){
						//get it from DB
						$actualUmid = (float)getIstantValue('studio', 'umidita');
						
					}
					if($paramName == "umidita camera"){
						//get it from DB
						$actualUmid = (float)getIstantValue('camera', 'umidita');
						
					} 					 										
					// else {
						//get from realys board
						// $actualUmid = (int) $statusXml->$singleTempInput;	
					// }

					
					if(($actualUmid < VERY_BASSA_VALUE)){ $classComfort = "very_bassa_temp temperature"; }
					if(($actualUmid >= VERY_BASSA_VALUE) && ($actualUmid < BASSA_VALUE)){ $classComfort = "bassa_temp temperature"; }
					if(($actualUmid >= BASSA_VALUE) && ($actualUmid <= ALTA_VALUE)){ $classComfort = "normal_temp temperature"; }
					if(($actualUmid > ALTA_VALUE) && ($actualUmid <= VERY_ALTA_VALUE)){ $classComfort = "alta_temp temperature"; }
					if(($actualUmid > VERY_ALTA_VALUE)){ $classComfort = "very_alta_temp temperature"; }
				}
				
				echo '<td class="table_sensore_td_valore '.$classComfort.'" id="'. $singleTempInput .'">';
					echo (string) $actualUmid;
				echo '</td>';
			echo '</tr>';
		}
	}
?>
	</tbody>
</table>







</div>









<style>

.relays_table {
	width:100%;
	border-collapse:separate; 
	border-spacing:7px;	
	
}

.table_relays_title_row {
	text-align:center;
	color: #899257;
	font-family: Arial,Helvetica,sans-serif;
    font-size: 15px;
    font-weight: 700;
	border:none;
}



.table_relays_td_interruttore{
	color: #899257;
	border-bottom: thin solid #ADB96E;
    font-weight: 1200;
	font-family: Arial,Helvetica,sans-serif;
    font-size: 25px;
	padding:10px;
	
}

.table_relays_td_stato {
	text-align:center;
	color: #899257;
    font-weight: 1200;
	font-family: Arial,Helvetica,sans-serif;
    font-size: 25px;
	padding:10px;
    border: medium solid #ADB96E;
    border-radius: 15px 15px 15px 15px;
}
.table_relays_row td{
/*	border:solid;*/

}

.table_relays_row{
	height:50px;
}


.table_sensore_td_valore{
	text-align:center;
	border:thin #899257 solid;
	color: #000;
    font-weight: 1200;
	font-family: Arial,Helvetica,sans-serif;
    font-size: 40px;
	padding:5px;
	
}

.very_bassa_temp { background-color:#5fb9fe; color:#1100b5;}
.bassa_temp { background-color:#b2faff; color:#1100b5; }
.normal_temp { background-color:#e6fdb6; }
.alta_temp { background-color:#f9fd7e; color:#b20f03; }
.very_alta_temp { background-color:#fd7c3d; color:#b20f03; }

.legend_table { height:5px; width:100%; padding:0; margin:0; font-size:9px; }
</style>



