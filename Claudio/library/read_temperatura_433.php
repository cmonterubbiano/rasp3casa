

<div class="panel_read_realys" >
<style>

.table_relays_row td {
    text-align: center;
	border-bottom: thin solid #ccc;
}

</style>

<table class="relays_table">
	<thead>
    	<tr class="table_relays_title_row">
        	<td width="40%" >
        		Condizionatore
            </td>
        	<td width="30%">
        		Temperatura
            </td>
        	<td width="30%">
        		Umidita
            </td>
        </tr>
    </thead>
    <tbody>
	<tr class="table_relays_row" id="row_temp_SALA">
		<td>SALA</td>
		<td><?php echo getIstantValue('cond_SALA_temp') ; ?></td>
		<td><?php echo getIstantValue('cond_SALA_umid') ; ?></td>
	</tr>
	<tr class="table_relays_row" id="row_temp_SALA">
		<td>SUD</td>
		<td><?php echo getIstantValue('cond_SUD_temp') ; ?></td>
		<td><?php echo getIstantValue('cond_SUD_umid') ; ?></td>
	</tr>
	<tr class="table_relays_row" id="row_temp_SALA">
		<td>NORD</td>
		<td><?php echo getIstantValue('cond_NORD_temp') ; ?></td>
		<td><?php echo getIstantValue('cond_NORD_umid') ; ?></td>
	</tr>

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

.very_cold_temp { background-color:#5fb9fe; color:#1100b5;}
.cold_temp { background-color:#b2faff; color:#1100b5; }
.normal_temp { background-color:#e6fdb6; }
.hot_temp { background-color:#f9fd7e; color:#b20f03; }
.very_hot_temp { background-color:#fd7c3d; color:#b20f03; }

.legend_table { height:5px; width:100%; padding:0; margin:0; font-size:9px; }
</style>



