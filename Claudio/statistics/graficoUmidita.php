
<div id="plot_container"></div>



<style>
#plot_container {
	margin:auto	;
	width:98%;
	height:500px;
	/*border:solid thin;*/
	position:relative;
	margin-top:5px;
	
}


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


        <script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){
var umid1 = [<?php  echo $umid_arrayAnalog_1; ?>];
var umid2 = [<?php  echo $umid_arrayAnalog_2; ?>];
var umid3 = [<?php  echo $umid_arrayAnalog_3; ?>];
var umid4 = [<?php  echo $umid_arrayAnalog_4; ?>];



/*
var temp2=[
	['2008-06-30 8:00',14], 
	['2008-06-30 9:00',16.5], 
	['2008-06-30 10:00',15.7], 
	['2008-06-30 11:00',19], 
	['2008-06-30 12:00',18.2],
	['2008-06-30 13:00',15.2],
	['2008-06-30 14:00',22.2],
	['2008-06-30 15:00',27.2],
	['2008-06-30 16:00',22.2],
	['2008-06-30 17:00',8.2],
	['2008-06-30 18:00',10.2],
	['2008-06-30 19:00',11.2],
	['2008-06-30 20:00',10.2],
	['2008-06-30 21:00',18.2]
	];
*/
//	makeMonthTemperatureGraphOnTop('2008-06', 'plot_container', "temperatura 1", temp1mese, "temperatura 2", temp2mese);
	
//	makeDayTemperatureGraphOnTop('2012-12-27', 'plot_container', "temperatura 1", temp1, "temperatura 2", temp2);
	makeDayUmiditaGraphOnTop('<?php echo $ft_titleDate; ?>', 'plot_container', "umid esterna", umid1, "umid cucina", umid2, "umid studio", umid3, "temp camera", umid4);
});
	

 
 
 
 
 
 
 
 
 
 
 
 function makeDayUmiditaGraphOnTop(dayToRender, divIdToChart, nameData1, dataToChart1, nameData2, dataToChart2, nameData3, dataToChart3, nameData4, dataToChart4){
	 //console.log("hi: " + dataToChart1[dataToChart1.length - 1][0] + " - " + dataToChart1.length);
	 var minimumValueFromChart1 = dataToChart1[dataToChart1.length - 1][0];
	 
 	//http://www.jqplot.com/docs/files/plugins/jqplot-dateAxisRenderer-js.html#$.jqplot.DateAxisRenderer
    var plot2 = $.jqplot(divIdToChart,[dataToChart1, dataToChart2, dataToChart3, dataToChart4], {
      title:'Umidita\' - ' + dayToRender + '<?php if($backdays == 1){ echo " - ultime 24 h";} ?>', 
      gridPadding:{right:35},
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer, 
          tickRenderer:$.jqplot.CanvasAxisTickRenderer,
          tickOptions:{
				formatString:'%H:%M',
                angle:-45,
				fontSize: '14pt'
				
			},
          min:minimumValueFromChart1, 
          tickInterval:'1 hour',
          label:'orario', 
          labelOptions:{
            fontFamily:'Helvetica',
            fontSize: '10pt'
          }

        },
        yaxis:{
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickOptions:{	fontSize: '14pt' },
          label:'Percentuale', 
          labelOptions:{
            angle:-90,
            fontSize: '14pt'
          }
		}
      },
	  seriesDefaults: { 
	    lineWidth:4,
        showMarker:true,
        pointLabels: { 
			show:true,
			stackedValue :true,
			formatString: function(){return '%s';}(),
			labelsFromSeries:true,
			seriesLabelIndex:1
		 } 
      },
	  series:[ 
          { label:nameData1 }, 
          { label:nameData2 },
		  { label:nameData3 },
          { label:nameData4 } 
	],
	  legend: { show: true }
  });
 }





 function makeMonthTemperatureGraphOnTop(dayToRender, divIdToChart, nameData1, dataToChart1, nameData2, dataToChart2, nameData3, dataToChart3, nameData4, dataToChart4){
 	//http://www.jqplot.com/docs/files/plugins/jqplot-dateAxisRenderer-js.html#$.jqplot.DateAxisRenderer
    var plot2 = $.jqplot(divIdToChart,[dataToChart1, dataToChart2, dataToChart3], {
      title:'Temperature mensile - ' + dayToRender, 
      gridPadding:{right:35},
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer, 
          tickRenderer:$.jqplot.CanvasAxisTickRenderer,
          tickOptions:{
				formatString:'%d/%m/%Y',
                angle:-45,
				fontSize: '14pt'
				
			},
          min:dayToRender, 
          tickInterval:'1 day',
          label:'giorni', 
          labelOptions:{
            fontSize: '10pt'
          }

        },
        yaxis:{
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickOptions:{	fontSize: '14pt' },
          label:'gradi centigradi', 
          labelOptions:{
            angle:-90,
            fontSize: '14pt'
          }
		}
      },
	  seriesDefaults: { 
	    lineWidth:4,
        showMarker:true,
        pointLabels: { show:true } 
      }, 
	  series:[ 
          { label:nameData1 }, 
          { label:nameData2 },
		  { label:nameData3 }, 		  
          { label:nameData4 } 
	],
	  legend: { show: true }
	  
  });
 }



</script>
