<?php

			$temp_arrayAnalog_1 = "";
			$temp_arrayAnalog_2 = "";
			$temp_arrayAnalog_3 = "";
			$temp_arrayAnalog_4 = "";
			$umid_arrayAnalog_1 = "";
			$umid_arrayAnalog_2 = "";
			$umid_arrayAnalog_3 = "";
			$umid_arrayAnalog_4 = "";
			
			if(isset($_REQUEST["ft_backdays"])){ $ft_backdays = $_REQUEST["ft_backdays"]; } else { $ft_backdays = 1; }
			$ft_titleDate = date("d/m/Y", mktime(0, 0, 0, date("m"), date("d")-($ft_backdays - 1) ,date("Y")));
			$ft_startDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-($ft_backdays - 1),date("Y")));
			$ft_endDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-($ft_backdays - 2) ,date("Y")));
			
		
			//$ft_query = "SELECT ora_produzione, valore_medio_produzione FROM `storico_produzione` WHERE `timestamp` >= '". $ft_startDate ."' AND `timestamp` <= '". $ft_endDate ."' ORDER BY timestamp DESC LIMIT 0 , 24"; 	// ultime 24 record maggiori ieri
			
			
			$ft_query = "SELECT * FROM `temp_umid_perc` WHERE `timestamp` >= '". $ft_startDate ."' AND `timestamp` <= '". $ft_endDate ."' ORDER BY timestamp DESC LIMIT 0 , 24"; 	// ultime 24 record maggiori ieri
			
			
			
			//echo "QQQQ: " . $ft_query;
			
			$ft_result = executeQuery($ft_query);
			$ft_fetchedArray = parseResultIntoArray($ft_result);
						
			foreach($ft_fetchedArray as $row){				
				$temp_arrayAnalog_1 .= "['" . $row->ora . ":00', " . $row->temp_esterna . "],"; 
				
				$temp_arrayAnalog_2 .= "['" . $row->ora . ":00', " . $row->temp_cucina . "],"; 
				
				$temp_arrayAnalog_3 .= "['" . $row->ora . ":00', " . $row->temp_studio . "],";
				
				$temp_arrayAnalog_4 .= "['" . $row->ora . ":00', " . $row->temp_camera . "],"; 
				
				$umid_arrayAnalog_1 .= "['" . $row->ora . ":00', " . $row->umid_esterna . "],"; 
				
				$umid_arrayAnalog_2 .= "['" . $row->ora . ":00', " . $row->umid_cucina . "],"; 
				
				$umid_arrayAnalog_3 .= "['" . $row->ora . ":00', " . $row->umid_studio . "],";
				
				$umid_arrayAnalog_4 .= "['" . $row->ora . ":00', " . $row->umid_camera . "],"; 				
								
				
				
			}
			// elimina ultima virgola dall'array
			$temp_arrayAnalog_1[(strlen($temp_arrayAnalog_1) - 1)] = " ";
			$temp_arrayAnalog_2[(strlen($temp_arrayAnalog_2) - 1)] = " ";
			$temp_arrayAnalog_3[(strlen($temp_arrayAnalog_3) - 1)] = " ";
			$temp_arrayAnalog_4[(strlen($temp_arrayAnalog_4) - 1)] = " ";
			

			

?>





<a href="?ft_backdays=<?php echo $ft_backdays + 1;?>" ><input type="button" id="button_giorno_prima" class="day_button" value="&lt; GIORNO PRIMA" /></a>
<?php if($ft_backdays != 1){ ?>	<a href="?ft_backdays=<?php echo $ft_backdays - 1;?>" ><input type="button" id="button_giorno_dopo" class="day_button" value="GIORNO DOPO &gt;" /></a> <?php } ?>
<div id="ft_plot_container"></div>





<style>
// #ft_plot_container {
	// margin:auto	;
	// width:98%;
	// height:500px;
	// position:relative;
	// margin-top:5px;
	
// }

.day_button {
    border-radius: 15px 15px 15px 15px;
    border-width: 5px;
    cursor: pointer;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 24px;
    font-weight: bold;
    height: 80px;
    margin: auto;
    width: 320px;
	color:#006600;
	text-decoration:none;
	margin-top:10px;
}	

.day_button:hover { color:#00FF00; }

#button_giorno_dopo {
	float:right;

}

</style>

<link class="include" rel="stylesheet" type="text/css" href="./css/jquery.jqplot.min.css" />
<script class="include" type="text/javascript" src="./js/jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.logAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" type="text/javascript" src="./js/plugins/jqplot.pointLabels.min.js"></script>



<script class="code" type="text/javascript" language="javascript">


</script>
