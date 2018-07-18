 <?php 
 $quarterly = new Quarterly_model;
 $sign = new Signatory_model;
 $signatory = $sign->getSignPerson('quarterly report', 1);

$quarter = !empty($this->input->get('quarter')) ? $this->input->get('quarter') : null;
$year = !empty($this->input->get('year')) ? $this->input->get('year') : null;

  ?>
 <style>
     th{
        text-align: center;

     }
     thead tr th{
        vertical-align: middle;
     }
     td{
        text-align: right;
        padding-left: 10px;
     }
 </style>
<div class="form-group">
        <div class="row register-form">
            <div class="col-md-12 col-md-offset-0 services">
                <form class="form-horizontal custom-form" id="superform">
                    <h1 class="sad">Municipal Quarterly Report on Real Property Assessment</h1>
                    
<div class="table-responsive table2">
<button class="pull-right" onclick="window.print()"><span class="glyphicon glyphicon-print"></span>&nbsp;PRINT</button>
    <table class="table table-bordered table-hover">
        
            <thead style="background-color: rgba(207, 207, 221, 0.2)">
            <tr>
                <th >Municipality:</th>
                <th colspan="4"> TABONTABON, LEYTE</th>
                <th colspan="6">Number of Barangay included in Report</th>
                <th>16 </th>
            </tr>
            <tr>
                <th>Covered:</th>
                <th colspan="10"><?php echo !empty($this->input->get('quarter')) ? $this->input->get('quarter').' '.$this->input->get('year') : '' ?></th>
                <th>&nbsp;</th>
            </tr>
		<tr>	
		<th colspan="10">Summary of Real Property Assessments as of the End of Quarter</th>
		<th rowspan="4">Basic Tax Collectible</th>
        <th rowspan="4">SEF Tax Collectible</th>


            </tr>
		<tr>
			<th colspan="5">Assessed Value</th>
			<th colspan="3">Property with Restrictions</th>
			<th rowspan="3">Total Assessed <br> Value Net <br>Restrictions <br> 15-16-17-18</th>
            <th rowspan="3">Rate of Levy</th>              
        </tr>

		<tr>
			<th colspan="3">Building</th>
			<th rowspan="2">Other Improvement</th>
			<th rowspan="2">Total <br> 10+11+12+13+14</th>
			<th rowspan="2">Under Carp</th>
			<th rowspan="2">Under Litigations</th>
			<th rowspan="2">Others</th>
		</tr>
		<tr>
			<th>Market Value of 175000 Or Less</th>
			<th>Market Value of Over 175000</th>
			<th>Machinery</th>

		</tr>
		<tr>
			<th>11</th>
			<th>12</th>
			<th>13</th>
			<th>14</th>
			<th>15</th>
			<th>16</th>
			<th>17</th>
			<th>18</th>
            <th>19</th>
			<th>20</th>
            <th>21</th>
            <th>22</th>


		</tr>
	</thead>
        <tbody>
            <tr>
                <?php $ten_res = $_GET['res_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('residential', '<=', 1, $quarter, $year) ?>
                <?php $column_11=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('residential', '>', 1, $quarter, $year) ?>
                <?php $column_12=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('residential', 1, $quarter, $year) ?>
                <?php $column_13=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('residential', 1, $quarter, $year) ?>
                <?php $column_14=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_res + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('residential', $quarter, $year) ?>
                <?php $column_16=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('residential', $quarter, $year) ?>
                <?php $column_17=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('residential', $quarter, $year) ?>
                <?php $column_18=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td>1%</td>
                <?php $collectible = $nineteen*0.01 ?>
                <td><?php echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php echo number_format($nineteen*0.01, 2)  ?></td>

            </tr>
            <tr>
                <?php $ten_agr = $_GET['agr_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('agricultural', '<=', 1, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('agricultural', '>', 1, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('agricultural', 1, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('agricultural', 1, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_agr + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('agricultural', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('agricultural', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('agricultural', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td>1%</td>
                <?php $collectible+=$nineteen*0.01 ?>
                <td><?php echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php echo number_format($nineteen*0.01, 2)  ?></td>

            </tr>
            <tr>
                <?php $ten_com = $_GET['com_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('commercial', '<=', 1, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('commercial', '>', 1, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('commercial', 1, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('commercial', 1, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_com + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('commercial', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('commercial', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('commercial', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td>1%</td>
                <?php $collectible+=$nineteen*0.01 ?>
                <td><?php echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr>
                <?php $ten_ind = $_GET['ind_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('industrial', '<=', 1, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('industrial', '>', 1, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('industrial', 1, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('industrial', 1, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_ind + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('industrial', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('industrial', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('industrial', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td>1%</td>
                <?php $collectible+=$nineteen*0.01 ?>
                <td><?php echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr>
                <?php $ten_min = $_GET['min_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('mineral', '<=', 1, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('mineral', '>', 1, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('mineral', 1, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('mineral', 1, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_min + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('mineral', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('mineral', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('mineral', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td>1%</td>
                <?php $collectible+=$nineteen*0.01 ?>
                <td><?php echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>

            <tr>
                <?php $ten_tim = $_GET['tim_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('timberland', '<=', 1, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('timberland', '>', 1, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('timberland', 1, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('timberland', 1, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_tim + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('timberland', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('timberland', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('timberland', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td>1%</td>
                <?php $collectible+=$nineteen*0.01 ?>
                <td><?php echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>1%</td><td></td><td></td></tr>
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr style="font-weight:bold">
                
                <?php $total_col_11 = $column_11; $total_col_12 = $column_12; $total_col_13 = $column_13; $total_col_14 = $column_14; $total_col_15 = $column_15; $total_col_16= $column_16; $total_col_17 = $column_17; $total_col_18 = $column_18; $total_col_19 = $column_19; ?>
                <td><?php echo number_format($column_11, 2) ?></td>
                <td><?php echo number_format($column_12, 2) ?></td>
                <td><?php echo number_format($column_13, 2) ?></td>
                <td><?php echo number_format($column_14, 2) ?></td>
                <td><?php echo number_format($column_15, 2) ?></td>
                <td><?php echo number_format($column_16, 2) ?></td>
                <td><?php echo number_format($column_17, 2) ?></td>
                <td><?php echo number_format($column_18, 2) ?></td>
                <td><?php echo number_format($column_19, 2) ?></td>
                <td></td>
                <td><?php echo number_format($collectible, 2) ?></td>
                <td><?php echo number_format($collectible, 2) ?></td>
            </tr>
            <tr><td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr>
                <?php $ten_gov = $_GET['gov_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('government', '<=', 0, $quarter, $year) ?>
                <?php $column_11=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('government', '>', 0, $quarter, $year) ?>
                <?php $column_12=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('government', 0, $quarter, $year) ?>
                <?php $column_13=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('government', 0, $quarter, $year) ?>
                <?php $column_14=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_gov + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('government', $quarter, $year) ?>
                <?php $column_16=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('government', $quarter, $year) ?>
                <?php $column_17=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('government', $quarter, $year) ?>
                <?php $column_18=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td></td>
                <?php //$collectible = $nineteen*0.01 ?>
                <td><?php //echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php //echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr>
                <?php $ten_rel = $_GET['rel_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('religious', '<=', 0, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('religious', '>', 0, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('religious', 0, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('religious', 0, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_rel + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('religious', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('religious', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('religious', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td></td>
                <?php //$collectible+=$nineteen*0.01 ?>
                <td><?php //echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php //echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr>
                <?php $ten_cha = $_GET['cha_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('charitable', '<=', 0, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('charitable', '>', 0, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('charitable', 0, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('charitable', 0, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_cha + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('charitable', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('charitable', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('charitable', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td></td>
                <?php //$collectible+=$nineteen*0.01 ?>
                <td><?php //echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php //echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr>
                <?php $ten_edu = $_GET['edu_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('educational', '<=', 0, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('educational', '>', 0, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('educational', 0, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('educational', 0, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_edu + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('educational', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('educational', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('educational', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td></td>
                <?php //$collectible+=$nineteen*0.01 ?>
                <td><?php //echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php //echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr>
                <?php $ten_oth = $_GET['oth_10'] ?>
                <?php $eleven = $quarterly->av_sum_building('others', '<=', 0, $quarter, $year) ?>
                <?php $column_11+=$eleven ?>
                <td><?php echo count($eleven) > 0? number_format($eleven, 2) : '-'  ?></td>  
                
                <?php $twelve = $quarterly->av_sum_building('others', '>', 0, $quarter, $year) ?>
                <?php $column_12+=$twelve ?>
                <td><?php echo count($twelve) > 0? number_format($twelve, 2) : '-'  ?></td>  

                <?php $thirteen = $quarterly->av_sum_machinery('others', 0, $quarter, $year) ?>
                <?php $column_13+=$thirteen ?>
                <td><?php echo count($thirteen) > 0? number_format($thirteen, 2) : '-'  ?></td>  

                <?php $fourteen = $quarterly->av_sum_others('others', 0, $quarter, $year) ?>
                <?php $column_14+=$fourteen ?>
                <td><?php echo count($fourteen) > 0? number_format($fourteen, 2) : '-'  ?></td> 
                
                <?php $fifteen = ($ten_oth + $eleven + $twelve + $thirteen + $fourteen) ?>
                <?php $column_15+=$fifteen ?>
                <td><?php echo number_format($fifteen, 2) ?></td>

                <?php $sixteen = $quarterly->under_carp('others', $quarter, $year) ?>
                <?php $column_16+=$sixteen ?>
                <td><?php echo count($sixteen) > 0? number_format($sixteen, 2) : '-'  ?></td> 

                <?php $seventeen = $quarterly->under_carp('others', $quarter, $year) ?>
                <?php $column_17+=$seventeen ?>
                <td><?php echo count($seventeen) > 0? number_format($seventeen, 2) : '-'  ?></td> 
                
                <?php $eighteen = $quarterly->under_carp('others', $quarter, $year) ?>
                <?php $column_18+=$eighteen ?>
                <td><?php echo count($eighteen) > 0? number_format($eighteen, 2) : '-'  ?></td> 
                
                <?php $nineteen = ($fifteen + $sixteen + $seventeen + $eighteen) ?>
                <?php $column_19+=$nineteen ?>
                <td><?php echo number_format($nineteen, 2) ?></td>

                <td></td>
                <?php //$collectible+=$nineteen*0.01 ?>
                <td><?php //echo number_format($nineteen*0.01, 2) ?></td>
                <td><?php //echo number_format($nineteen*0.01, 2)  ?></td>
            </tr>
            <tr style="font-weight:bold">
                 <?php $total_col_11 += $column_11; $total_col_12 += $column_12; $total_col_13 += $column_13; $total_col_14 += $column_14; $total_col_15 += $column_15; $total_col_16 += $column_16; $total_col_17 += $column_17; $total_col_18 += $column_18; $total_col_19 += $column_19;  ?>
                <td><?php echo number_format($column_11, 2) ?></td>
                <td><?php echo number_format($column_12, 2) ?></td>
                <td><?php echo number_format($column_13, 2) ?></td>
                <td><?php echo number_format($column_14, 2) ?></td>
                <td><?php echo number_format($column_15, 2) ?></td>
                <td><?php echo number_format($column_16, 2) ?></td>
                <td><?php echo number_format($column_17, 2) ?></td>
                <td><?php echo number_format($column_18, 2) ?></td>
                <td><?php echo number_format($column_19, 2) ?></td>
                <td></td><td></td><td></td>
            </tr>
            <tr style="font-weight:bold;font-size:20px">
                <td><?php echo number_format($total_col_11, 2) ?></td>
                <td><?php echo number_format($total_col_12, 2) ?></td>
                <td><?php echo number_format($total_col_13, 2) ?></td>
                <td><?php echo number_format($total_col_14, 2) ?></td>
                <td><?php echo number_format($total_col_15, 2) ?></td>
                <td><?php echo number_format($total_col_16, 2) ?></td>
                <td><?php echo number_format($total_col_17, 2) ?></td>
                <td><?php echo number_format($total_col_18, 2) ?></td>
                <td><?php echo number_format($total_col_19, 2) ?></td>
                <td></td>
                <td><?php echo number_format($collectible, 2) ?></td>
                <td><?php echo number_format($collectible, 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="signatories pull-left">
    <p>Prepared by:</p>
    <p class="text-uppercase"><?php echo $signatory[0]->fname.' '.substr($signatory[0]->mname, 0, 1).'. '.$signatory[0]->lname ?>
    <br><?php echo $signatory[0]->position ?></p>
</div>
<div class="clearfix"></div>
<a class="btn btn-md btn-primary" href="<?php echo base_url('admin/reports/quarterly?page=1&quarter='.$quarter.'&year='.$year) ?>">Previous Page</a>
                                    <div class="form-group"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>