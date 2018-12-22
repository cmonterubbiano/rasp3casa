<?php 
	require_once("./login.php");

	require_once("./global_var.php");
	require_once("./function_library.php");
	require_once("./mysql_library.php");
	
	$query = "SELECT * FROM sensori WHERE `sensori`.`id` ='1'";
	//$query = "SELECT * FROM sensori";

	$result = executeQuery($query);
	//echo "PPPPPPPPPPPPPPPPPPPPPPPA ". $result->num_rows . "\n";

	if ($result->num_rows <1) {
		$query = "SELECT * FROM sensori WHERE `sensori`.`id` !='1'";
		$result = executeQuery($query);
	}
	//echo "INIZIO ". $result->num_rows  . "\n";
	$fetchedArray = parseResultIntoArray($result);

	$jsonEndodedArrayOfTipologies = json_encode($fetchedArray);
	//echo "INIZIO 1 ". $jsonEndodedArrayOfTipologies  . "\n";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo TITLE_OF_PROJECT; ?> - MENU</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/iphone-style-checkboxes.css" rel="stylesheet" type="text/css" />
<link href="css/start/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" type="text/css" />

<link href="css/jquery.ui.slidespinner.css" rel="stylesheet" type="text/css" />
  
</head>

<body>

<div class="container">
  <div class="header_mini">
  	
  	<a href="./index_lucio.php" class="main_menu_link"><?php echo TITLE_OF_PROJECT; ?> - MAIN MENU</a> 
    <!-- end .header --></div>
 
<?php 	require_once("./top_menu.php");  ?>    
<script src="js/iphone-style-checkboxes.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery-ui-1.10.0.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery-ui-timepicker-addon.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.ui.slidespinner.js" type="text/javascript" charset="utf-8"></script>


  <script type="text/javascript" charset="utf-8">

	
	
  </script>
  
  
<?php 	
	// AGGIUNGIAMO TIPOLOGIA AL DB
	if(isset($_POST['nome_job'])){ 
	echo "<h1>nome_job is set! </h1>";
		if($_POST['generale'] == "on"){ $generale = "SI";} else { $generale = "NO";}
		if($_POST['notte'] == "on"){ $notte = "SI";} else { $notte = "NO";}
		if($_POST['vario'] == "on"){ $vario = "SI";} else { $vario = "NO";}
		if($_POST['messaggi'] == "on"){ $messaggi = "SI";} else { $messaggi = "NO";}
		if($_POST['telefono'] == "on"){ $telefono = "SI";} else { $telefono = "NO";}
		if($_POST['sirena'] == "on"){ $sirena = "SI";} else { $sirena = "NO";}
		// if($_POST['ora_fine'] == ""){ $sqlOrarioFine = "NULL";} else { $sqlOrarioFine = "'" .$_POST['ora_fine']. ":00'" ;}
	
		// $dataEsecuzioneFromPost = $_POST['data_esecuzione'];
		// $data_esecuzione = $dataEsecuzioneFromPost;
		// esempio: 19/02/2013
		// $annoEsecFromPost = substr($dataEsecuzioneFromPost, 6,4);
		// $meseEsecFromPost = substr($dataEsecuzioneFromPost, 3,2);
		// $giornoEsecFromPost = substr($dataEsecuzioneFromPost, 0,2);
		// $data_esecuzione = $annoEsecFromPost ."-". $meseEsecFromPost ."-". $giornoEsecFromPost;
		
		//echo "<h1>data: ". $data_esecuzione ."</h1>";
		$codice =$_POST['Codice'];
		$query = "DELETE FROM `claudio`.`sensori` WHERE `sensori`.`id` ='1'";
		//echo $query;
		$result = executeQuery($query);

		$query = "SELECT * FROM `claudio`.`sensori` WHERE `sensori`.`Codice` =$codice";
		$result = executeQuery($query);
		if ($result->num_rows >0)
		{
			//UPDATE `sensori` SET `descrizione`='"lklklk"' WHERE 1
			$query = "UPDATE `claudio`.`sensori` SET `descrizione`='".$_POST['nome_job']."', `Generale` ='".$generale."', `Notte` ='".$notte."', `Vario` ='".$vario."', `sirena` ='".$sirena."', `messaggi` ='".$messaggi."', `telefono` ='".$telefono."' WHERE `sensori`.`codice` =$codice";
			
			// $query = "UPDATE `claudio`.`sensori` 
			// (`timestamp`, `descrizione`, `Generale`, `Notte`, `Vario`) 
			// VALUES 
			// (CURRENT_TIMESTAMP
			// , '".$_POST['nome_job']."'
			// , '".$generale."'
			// , '".$notte."'
			// , '".$vario."'
			// );";
			
			
		}
		else
		{
			$query = "INSERT INTO `claudio`.`sensori` 
			(`id`, `timestamp`, `descrizione`, `Codice`, `Generale`, `Notte`, `Vario`) 
			VALUES 
			(NULL, CURRENT_TIMESTAMP
			, '".$_POST['nome_job']."'
			, '".$codice."'
			, '".$generale."'
			, '".$notte."'
			, '".$vario."'
			);";
		}
		// risultato di una querry
		//INSERT INTO `claudio`.`sensori` (`id`, `timestamp`, `descrizione`, `Codice`, `Generale`, `Notte`, `Vario`) VALUES (NULL, CURRENT_TIMESTAMP , 'Filippo' , '480003' , 'SI' , 'NO' , 'SI' );

		
		echo $query;
		$result = executeQuery($query);
		if($result){
			echo "<h1>SENSORE inserito correttamente.</h1>";
			//echo "<h2>Inoltro a AUTOMAZIONE CONSUMI....</h2>";
			header('Refresh: 2; ./Gestione_sensori.php'); 
		} else {
			echo "<h1>PROBLEMI durante l'inserimento del JOB</h1>";
		}

		/*foreach($_POST as $postInputIndex => $postInputValue){
			echo $postInputIndex . ": <strong>" . $postInputValue . "</strong><br/>";
		}*/
	
	} else {
	// SE NON E' INSERIMENTO è FORM di INSERIMENTO
  



?>    
    
  <div class="content">
  
  		<table class="input_table">
        <tbody>
<!-- form method="post" onsubmit="return checkFormFields();" action="/action_page.php" -->	
<form method="post" onsubmit="return checkFormFields();" >	
		    <tr><td class="first_column">
		        <label for="Codice" class="new_job_text_label">Codice sensore</label>
            </td><td class="second_column">
                <select name="Codice" class="new_job_select" id="new_job_codice">
					<!-- option value="nessuno" cla_descrizione="nessuno" cla_generale="nessuno" cla_notte="nessuno" >Seleziona un sensosre</option -->
                    <?php
						foreach($fetchedArray as $row){
							echo '<option value="'. $row->Codice .'" cla_descrizione="'. $row->descrizione .'" cla_generale="'. $row->Generale .'" cla_notte="'. $row->Notte .'" >'. $row->Codice .'</option>';
							echo $row->Codice ;
						}
					?>
                </select>
        	<tr><td class="first_column">
		        <label for="nome_job" class="new_job_text_label">Descrizione </label>
            </td><td class="second_column">

            <!--   <input type="text" name="nome_job" class="new_job_text" id="new_job_nome_job" value=<?php echo $idtest ?> > -->
			<input type="text" name="nome_job" class="new_job_text" id="new_job_nome_job">
				
            </td></tr> 
        	<tr><td class="first_column">
		        <label for="generale" class="new_job_text_label_secondary">All. generale</label>
            </td><td class="second_column">
            	<input type="checkbox" name="generale" class="new_job_chebox" id="new_job_generale" checked="checked" />
            </td></tr>
             
        	<tr><td class="first_column">
		        <label for="notte" class="new_job_text_label_secondary">Allarme notte</label>
            </td><td class="second_column">
            	<input type="checkbox" name="notte" class="new_job_chebox" id="new_job_notte" checked="checked" />
            </td></tr>           
              
        	<tr><td class="first_column">
		        <label for="vario" class="new_job_text_label_secondary">Allarme tipo1</label>
            </td><td class="second_column">
            	<input type="checkbox" name="vario" class="new_job_chebox" id="new_job_vario" checked="checked" />
            </td></tr>
  
        	<tr><td class="first_column">
		        <label for="messaggi" class="new_job_text_label_secondary">Messaggi</label>
            </td><td class="second_column">
            	<input type="checkbox" name="messaggi" class="new_job_chebox" id="new_job_messaggi" checked="checked" />
            </td></tr>	
  
        	<tr><td class="first_column">
		        <label for="telefono" class="new_job_text_label_secondary">Telefono</label>
            </td><td class="second_column">
            	<input type="checkbox" name="telefono" class="new_job_chebox" id="new_job_telefono" checked="checked" />
            </td></tr>	
  
        	<tr><td class="first_column">
		        <label for="sirena" class="new_job_text_label_secondary">Sirena</label>
            </td><td class="second_column">
            	<input type="checkbox" name="sirena" class="new_job_chebox" id="new_job_sirena" checked="checked" />
            </td></tr>				
        	<tr><td class="first_column full_line_td" colspan="2">
            	<input type="submit" value="AGGIORNA SENSORE" class="new_job_submit" />
            </td></tr>
			<tr>
				<td class="first_column full_line_td" colspan="2">


				<!-- button type="button" onclick="myFunction('A')" class="new_job_submit">ANNULLA SENSORE</button><br -->

 
            </td></tr> 
            </td></tr>
			<tr>

			<td class="first_column full_line_td" colspan="2">

				<!--<button onclick="myFunction()" style="height: 70px; width:100%; font-size : 40px;">Leggi Sensore</button><br>-->
				<button type="button" onclick="myFunction('L')" class="new_job_submit">Valori iniziali Sensore</button><br>

 
            </td></tr>	 						
            
                
  		</tbody>
  		</table>
</form>
  
<form method="post"  action="./Gestione_sensori.php" >

<button type="submit" onclick="myFunction('A')" class="new_job_submit">ANNULLA SENSORE</button><br>

</form>  		
        
   
   		<div class="clearfloat" ></div>
    <!-- end .content --></div>
<?php 	
	} // FINE FORM INSERIMENTO
	require_once("./footer.php");  ?>    
  <!-- end .container --></div>
</body>
</html>



<style>
.input_table {	width:100%; padding-top:20px; }
.input_table td {
	padding:10px;
	
}

.first_column {
	width:50%;
	text-align:right;
}

.second_column {
	width:50%;
	vertical-align:central;
}

.new_job_text_label {
	color: #8f985c;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 35px;
    font-weight: 700;
    text-align: center;	
}

.new_job_text {
	color: #98022d;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 35px;
    font-weight: 700;
}

.new_job_text_grey {
	color: #666;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 35px;
    font-weight: 700;
}

.new_job_text_grey_small {
	width:50%;
	
}

.new_job_select {
	color: #98022d;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 35px;
    font-weight: 700;
	width:100%;
}

.new_job_select_grey {
	color:#666;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 35px;
    font-weight: 700;
	width:100%;
}

.new_job_text_label_secondary {
	color: #AAAAAA;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 35px;
    font-weight: 700;
    text-align: center;	
}

.new_job_chebox {
	width:30px;
	height:30px;
	
}

.new_job_submit {
	color: #006600;
    border-radius: 15px 15px 15px 15px;
    border-width: 5px;
    cursor: pointer;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 24px;
    font-weight: bold;
    height: 100px;
    margin: auto;
    width: 600px;
	display: block;
}

//.new_job_submit:hover { color:#00FF00;}
.new_job_submit:hover { color:red;}
.full_line_td {text-align:center}

#new_job_durata { width:220px; }
#new_job_consumo { width:220px; }

.ui-slidespinner .ui-slider .ui-slider-handle {	height: 2em; width: 2em; z-index:1; }
.ui-slidespinner {	margin-bottom:20px; }
.ui-widget input {	font-size:1.8em; }

.ui-spinner-button { width:30px; }
.ui-spinner .ui-icon { left:8px; }

.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }



</style>



<script type="text/javascript">

function myFunction(tipo) {
	//$a =document.getElementById("new_job_codice").value;
	// $b =document.getElementById("new_job_generale").checked;
	// alert("myfunction gen ck ->" + $b);
	// alert("myfunction gen ck ->" + tipo);

    //document.getElementById("new_job_nome_job").value= document.getElementById("new_job_codice").value;
	//$('#new_job_nome_job').val( $('#new_job_codice').val() );
	
	/*
	var desc = $('#new_job_codice option:selected').attr("cla_descrizione");
	alert("desc ->" + desc);
	$('#new_job_nome_job').val( desc );
	*/
	$cod =$('#new_job_codice').val();
	if(!$cod)
		return;
	
	if (tipo =="A")
	{
		var r = confirm("Sei sicuro di voler ANNULLARE il sensore?");
		if (r != true)
			return;
	}

    $.post("recuperaDatiSensore.php",
		{
			codice_sensore: $cod,
			tipo: tipo
		},
		function(data, status)
		{
			// alert("Data: " + data + "\nStatus: " + status);
			if (data)
			{
				jQuery('#new_job_nome_job').val( data.descrizione);
				//alert("Generale " + data.Generale);
				if (data.Generale =="SI")
					//document.getElementById("new_job_generale").checked =true;
					$("#new_job_generale").attr("checked",true);
				else
					document.getElementById("new_job_generale").checked =false;
				if (data.Notte =="SI")
					document.getElementById("new_job_notte").checked =true;
				else
					document.getElementById("new_job_notte").checked =false;
				if (data.Vario =="SI")
					document.getElementById("new_job_vario").checked =true;
				else
					document.getElementById("new_job_vario").checked =false;
				if (data.messaggi =="SI")
					document.getElementById("new_job_messaggi").checked =true;
				else
					document.getElementById("new_job_messaggi").checked =false;
				if (data.telefono =="SI")
					document.getElementById("new_job_telefono").checked =true;
				else
					document.getElementById("new_job_telefono").checked =false;
				if (data.sirena =="SI")
					document.getElementById("new_job_sirena").checked =true;
				else
					document.getElementById("new_job_sirena").checked =false;
			}
			else
			{
				jQuery('#new_job_nome_job').val( "");
				//alert("Generale " + data.Generale);
				$("#new_job_generale").attr("checked",true);	
				document.getElementById("new_job_notte").checked =true;
				document.getElementById("new_job_vario").checked =true;
				document.getElementById("new_job_messaggi").checked =true;
				document.getElementById("new_job_telefono").checked =true;
				document.getElementById("new_job_sirena").checked =true;
				// if (tipo =="A")
				// {
					// var urlToCall = "index.php";
					// $.ajax({
						// dataType: "json",
						// url: urlToCall,
						// success: function(data) {
						//alert(data);
						// }
					// });			
					// alert("tipo -> A");
				// }
			}
			//alert("Descrizione -> " + data.descrizione);
		}, "json"
		// if (tipo =="A")
		// {
			// alert("tipo -> A");
		// }
	);

	
// document.getElementById("new_job_nome_job").value="Arturo";
	//$query = "SELECT * FROM sensori WHERE `sensori`.`id` !='1' and `sensori`.`Codice` =document.getElementById("new_job_codice").value";

		//alert("fine myfunction codice ->" + $a);
}

function checkFormFields(){
	var nomeJob = $("#new_job_nome_job").val();
	var codiceJob = $("#new_job_codice").val();
	// var durata = $("#new_job_durata").val();
	// var dataEsecuzione = $("#new_job_data_esecuzione").val();
	// var oraInizio = $("#new_job_ora_inizio").val();
	// var oraFine = $("#new_job_ora_fine").val();
	// var consumoStimato = $("#new_job_consumo").val();

	if(!codiceJob){
		alert("Codice non previsto");
		return(false);	
	}
	if(nomeJob == ""){
		alert("Inserire una Descrizione");
		return(false);	
	}
	
	// if(durata == ""){
		// alert("Inserire un valore per la DURATA");
		// return(false);	
	// }
	
	// if(isNaN(durata)){
		// alert("Inserire un valore NUMERICO per la DURATA");
		// return(false);	
	// }

	// if(durata == "0"){
		// var confirmBox=confirm("Attenzione, DURATA pari a ZERO. Significa che il JOB avrà tempo infinito come ad esempio il condizionamento o il riscaldamento e si fermerà in base ad altri parametri. Si vuole procedere comunque all'inserimento di questa Tipologia?");
		// if(!(confirmBox)){return(false);}
	// }
		
	// if(dataEsecuzione == ""){
		// alert("Inserire un valore per la DATA ESECUZIONE");
		// return(false);	
	// }
	
	// if(!(isValidDate(dataEsecuzione,"dd/mm/yy"))){
		// alert("Inserire una DATA VALIDA in formato DD/MM/YYYY per la DATA ESECUZIONE");
		// return(false);	
	// }
		
	// if(oraInizio == ""){
		// alert("Inserire un valore per ORA INIZIO");
		// return(false);	
	// }
		
	// if(!(isValidTime(oraInizio,"hh:mm"))){
		// alert("Inserire un'ORA VALIDA in formato HH:MM per ORA INIZIO");
		// return(false);	
	// }
		
	// if((!(isValidTime(oraFine,"hh:mm"))) && (oraFine != "")){
		// alert("Inserire un'ORA VALIDA in formato HH:MM per ORA FINE o lasciare vuoto il campo");
		// return(false);	
	// }
		
	// if(isNaN(consumoStimato)){
		// alert("Inserire un valore NUMERICO per il CONSUMO STIMATO");
		// return(false);	
	// }
	
	// if(consumoStimato == "0"){
		// alert("Inserito un CONSUMO STIMATO pari a ZERO. Inutile aggiungere questo tipo di Job");
		// var confirmBox=confirm("Attenzione, CONSUMO STIMATO pari a ZERO. Si vuole procedere comunque all'inserimento di questo JOB?");
		// if(!(confirmBox)){return(false);}
	// }
	
	return(true);	
}



function isValidDate(dateToCheck, format){
    var isValid = true;
    try{         jQuery.datepicker.parseDate(format, dateToCheck);    }
    catch(error){        isValid = false;    }
    return isValid;
}

function isValidTime(timeToCheck){
    var isValid = true;
	if(timeToCheck.length != 5 ){ return(false); }
	var hour = timeToCheck.substr(0,2);
	var minutes = timeToCheck.substr(3,5);
	if(isNaN(hour)){ return(false); }
	if(isNaN(minutes)){ return(false); }
	if(Number(hour) > 23){ return(false); }
	if(Number(minutes) > 59){ return(false); }
    return isValid;
}




var jsonEndodedArrayOfTipologies = <?php echo $jsonEndodedArrayOfTipologies; ?>;

//alert("jsonEndodedArrayOfTipologies: " + jsonEndodedArrayOfTipologies[0]["nome_tipologia"]);

jQuery("#new_job_tipologia").change(function () {
	jQuery("#new_job_tipologia option:selected").each(function () {
		upDateFormWithDataFromTipology( jQuery(this).val() );
	});
}).change();

function upDateFormWithDataFromTipology( idOfSelectedTypology ){
	//alert("selected: " + idOfSelectedTypology);
	var selectedTipologyData;
	if(idOfSelectedTypology == "Nessuna"){ resetAllFormField(); }
	else {
		for(index in jsonEndodedArrayOfTipologies){
			if(jsonEndodedArrayOfTipologies[index]["nome_tipologia"] == idOfSelectedTypology){ 
				selectedTipologyData = jsonEndodedArrayOfTipologies[index];
			}			
		}

		//alert(selectedTipologyData["nome_tipologia"]);
		//console.log("selectedTipologyDataDurata: " + selectedTipologyData["durata"]);
		
		//autoconsumo
		if(selectedTipologyData["autoconsumo"] == "1"){	jQuery("#new_job_autoconsumo").attr('checked', true);} 
		else { jQuery("#new_job_autoconsumo").attr('checked', false); }
		jQuery("#new_job_autoconsumo").iphoneStyle("refresh");
		
		//durata
		jQuery("#new_job_durata").val(selectedTipologyData["durata"] );
		
		//priorita
		$("#new_job_priorita").val(selectedTipologyData["priorita"] );
		
		//ora_inizio
		$("#new_job_ora_inizio").val( (selectedTipologyData["ora_inizio"]).substring(0,5) );
		
		//ora_fine
		if( selectedTipologyData["ora_fine"] != null){ $("#new_job_ora_fine").val( (selectedTipologyData["ora_fine"]).substring(0,5) );		} else { $("#new_job_ora_fine").val("");	}

		//consumo
		jQuery("#new_job_consumo").val(selectedTipologyData["consumo"] );
		
		//canale_rele
		jQuery("#new_job_canale").val(selectedTipologyData["canale_rele"] );
		
		//interrompibile
		if(selectedTipologyData["interrompibile"] == "1"){	jQuery("#new_job_interrompibile").attr('checked', true);} 
		else { jQuery("#new_job_interrompibile").attr('checked', false); }
		jQuery("#new_job_interrompibile").iphoneStyle("refresh");
	
		
	}
}

function resetAllFormField(){
	//alert("reset values");
	
	//autoconsumo
	jQuery("#new_job_autoconsumo").attr('checked', true);
	jQuery("#new_job_autoconsumo").iphoneStyle("refresh");
	
	//durata
	jQuery("#new_job_durata").val("0");
	
	//priorita
	$("#new_job_priorita").val("Media");

	//ora_inizio
	var oraInizio = 
	$("#new_job_ora_inizio").val( "00:00" );
	
	//ora_fine
	$("#new_job_ora_fine").val("");

	//consumo
	jQuery("#new_job_consumo").val("0");

	//canale_rele
	jQuery("#new_job_canale").val("canale_1");

	//interrompibile
	jQuery("#new_job_interrompibile").attr('checked', true);
	jQuery("#new_job_interrompibile").iphoneStyle("refresh");
	
}



jQuery( "#new_job_codice" ).change(function(event) {
	//alert("selectaaa:: " + jQuery(event.target).val() );
	myFunction('L');
  // Check input( $( this ).val() ) for validity here
});


jQuery( document ).ready(function() {
  // Handler for .ready() called.
  myFunction('L');
});



</script>