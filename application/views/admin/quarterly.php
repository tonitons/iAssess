<?php 
    $quarterly = new Quarterly_model();
 ?>
 <style>
     th{
        text-align: center;

     }
     thead tr th{
        vertical-align: middle;
     }
 </style>
<div class="form-group">
        <div class="row register-form">
            <div class="col-md-12 col-md-offset-0 services">
            <form method="GET">
            <div class="col-md-8" id="quarter-select">
            <div class="col-md-4">
                <select name="quarter" id="" class="form-control">
                    <option selected disabled>Choose Quarter</option>
                    <option <?php echo $this->input->get('quarter')=='Jan-Mar' ? 'selected' : '' ?> value="Jan-Mar">1st Quarter</option>
                    <option <?php echo $this->input->get('quarter')=='Apr-Jun' ? 'selected' : '' ?> value="Apr-Jun">2nd Quarter</option>
                    <option <?php echo $this->input->get('quarter')=='Jul-Sep' ? 'selected' : '' ?> value="Jul-Sep">3rd Quarter</option>
                    <option <?php echo $this->input->get('quarter')=='Oct-Dec' ? 'selected' : '' ?> value="Oct-Dec">4th Quarter</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="year" id="" class="form-control">
                    <option selected disabled>Choose Year</option>
                    <?php $year = date('Y'); ?>
                    <?php for ($i = 2017; $i<=$year; $i++): ?>
                        <option value="<?php echo $i ?>" <?php echo $i==$this->input->get('year') ? 'selected' : '' ?>><?php echo $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> View</button>
            </div>
            </form>
                <form class="form-horizontal custom-form" id="superform">
                    <h1 class="sad">Municipal Quarterly Report on Real Property Assessment</h1>
                    <?php 
                        $quarter = !empty($this->input->get('quarter')) ? $this->input->get('quarter') : null;
                        $year = !empty($this->input->get('year')) ? $this->input->get('year') : null;
                     ?>
 <div class="table-responsive table2">
 <button class="pull-right" onclick="window.print()"><span class="glyphicon glyphicon-print"></span>&nbsp;PRINT</button>
    <table class="table table-bordered table-hover">
        
            <thead style="background-color: rgba(207, 207, 221, 0.2)"> 
            <tr>
                <th >Municipality:</th>
                <th colspan="3"> TABONTABON, LEYTE</th>
                <th colspan="5">Number of Barangay included in Report</th>
                <th>16 </th>
            </tr>
            <tr>
                <th>Covered:</th>
                <th colspan="8"><?php echo !empty($this->input->get('quarter')) ? $this->input->get('quarter').' '.$this->input->get('year') : '' ?></th>
                <th>&nbsp;</th>
            </tr>
		<tr>	
		<th rowspan="4">Real Property Classification</th>
		<th rowspan="4">Number of Real Property Units</th>
        <th rowspan="4">Land Area <br> (in sq. m.)</th>
        <th colspan="6">Summary of Real Property Assessments as of the end of the Quarter</th>
        <th rowspan="4">Land</th>

        </tr>
		<tr>
			<th colspan="6">Market Value</th>
			<!-- <th colspan="3">Property with Restrictions</th>
			<th rowspan="3">Total Assessed <br> Value Net <br>Restrictions <br> 15-16-17-18</th>
            <th rowspan="3">Rate of Levy</th>  -->             
        </tr>
        
		<tr>
			<th rowspan="2">land</th>
			<th colspan="2">Building</th>
			<th rowspan="2">Machinery</th>
			<th rowspan="2">Other Improvements</th>
			<th rowspan="2">Total</th>
			<!-- <th rowspan="4">Land</th> -->
		</tr>
		<tr>
			<th>Market Value of Over 175,000</th>
			<th>Market Value of Over 175,000</th>
			<!-- <th>Machinery</th> -->

		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
            <th>9 <br>4+5+6+7+8</th>
			<th>10</th>
            


		</tr>
	</thead>
        <tbody>
            <tr>
                <td class="text-left" style="font-weight:bold">Taxable</td>
                <td></td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
               

            </tr>
            <tr>
                <td>Residential</td>

                <td><?php echo $column_2 = $quarterly->num_real_property_unit('residential', 1, $quarter, $year) ?></td>

                <?php $column_3 = $quarterly->sum_real_property_unit_area('residential', 1, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('residential', 1, $quarter, $year)) ?></td>
                
                <?php $four = $quarterly->mv_sum_land('residential', 1, $quarter, $year) ?>
                <?php $column_4 = $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 1, $quarter, $year) ?>
                <?php $column_5=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 1, $quarter, $year) ?>
                <?php $column_6=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 1, $quarter, $year) ?>
                <?php $column_7=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 1, $quarter, $year) ?>
                <?php $column_8 = $eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9=$nine ?>
                <td><?php echo  number_format($nine, 2) ?></td>

                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('residential', 1, $quarter, $year) ?>
                <?php $column_10=$ten ?>
                <?php $col1_land=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>               
            </tr>
            <tr>
                <td>Agricultural</td>

                <?php $column_2 += $quarterly->num_real_property_unit('agricultural', 1, $quarter, $year) ?>
                <td><?php echo $quarterly->num_real_property_unit('agricultural', 1, $quarter, $year) ?></td>

                <?php $column_3 += $quarterly->sum_real_property_unit_area('agricultural', 1, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('agricultural', 1, $quarter, $year)) ?></td>

                <?php $four = $quarterly->mv_sum_land('agricultural', 1, $quarter, $year) ?>
                <?php $column_4 += $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 1, $quarter, $year) ?>
                <?php $column_5=+$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 1, $quarter, $year) ?>
                <?php $column_6+=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('agricultural', 1, $quarter, $year) ?>
                <?php $column_7=+$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 1, $quarter, $year) ?>
                <?php $column_8+=$eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>

                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9+=$nine ?>
                <td><?php echo number_format($nine, 2) ?></td>
                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('agricultural', 1, $quarter, $year) ?>
                <?php $column_10+=$ten ?>
                <?php $col2_land=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>  
            </tr>
            <tr>
                <td>Commercial</td>

                <?php $column_2 += $quarterly->num_real_property_unit('commercial', 1, $quarter, $year) ?>
                <td><?php echo $quarterly->num_real_property_unit('commercial', 1, $quarter, $year) ?></td>

                <?php $column_3 += $quarterly->sum_real_property_unit_area('commercial', 1, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('commercial', 1, $quarter, $year)) ?></td>

                <?php $four = $quarterly->mv_sum_land('commercial', 1, $quarter, $year) ?>
                <?php $column_4+=$four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 1, $quarter, $year) ?>
                <?php $column_5=+$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 1, $quarter, $year) ?>
                <?php $column_6+=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 1, $quarter, $year) ?>
                <?php $column_7+=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 1, $quarter, $year) ?>
                <?php $column_8+=$eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>

                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9+=$nine ?>
                <td><?php echo number_format($nine, 2) ?></td>
                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('commercial', 1, $quarter, $year) ?>
                <?php $column_10+=$ten ?>
                <?php $col3_land=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>  
            </tr>
            <tr>
                <td>Industrial</td>

                <?php $column_2 += $quarterly->num_real_property_unit('industrial', 1, $quarter, $year) ?>
                <td><?php echo $quarterly->num_real_property_unit('industrial', 1, $quarter, $year) ?></td>

                <?php $column_3 += $quarterly->sum_real_property_unit_area('industrial', 1, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('industrial', 1, $quarter, $year)) ?></td>

                <?php $four = $quarterly->mv_sum_land('industrial', 1, $quarter, $year) ?>
                <?php $column_4+=$four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 1, $quarter, $year) ?>
                <?php $column_5+=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 1, $quarter, $year) ?>
                <?php $column_6+=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 1, $quarter, $year) ?>
                <?php $column_7+=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 1, $quarter, $year) ?>
                <?php $column_8+=$eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9+=$nine ?>
                <td><?php echo number_format($nine, 2) ?></td>
                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('industrial', 1, $quarter, $year) ?>
                <?php $column_10+=$ten ?>
                <?php $col4_land=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>  
            </tr>
            <tr>
                <td>Mineral</td>

                <?php $column_2 += $quarterly->num_real_property_unit('mineral', 1, $quarter, $year) ?>
                <td><?php echo $quarterly->num_real_property_unit('mineral', 1, $quarter, $year) ?></td>

                <?php $column_3 += $quarterly->sum_real_property_unit_area('mineral', 1, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('mineral', 1, $quarter, $year)) ?></td>

                <?php $four = $quarterly->mv_sum_land('mineral', 1, $quarter, $year) ?>
                <?php $column_4+=$four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 1, $quarter, $year) ?>
                <?php $column_5+=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 1, $quarter, $year) ?>
                <?php $column_6+=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 1, $quarter, $year) ?>
                <?php $column_7+=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 1, $quarter, $year) ?>
                <?php $column_8+=$eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9+=$nine ?>
                <td><?php echo number_format($nine, 2) ?></td>
                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('mineral', 1, $quarter, $year) ?>
                <?php $column_10+=$ten ?>
                <?php $col5_land=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>  
            </tr>
            <tr>
                <td>Timberland</td>

                <?php $column_2 += $quarterly->num_real_property_unit('timberland', 1, $quarter, $year) ?>
                <td><?php echo $quarterly->num_real_property_unit('timberland', 1, $quarter, $year) ?></td>

                <?php $column_3 += $quarterly->sum_real_property_unit_area('timberland', 1, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('timberland', 1, $quarter, $year)) ?></td>

                <?php $four = $quarterly->mv_sum_land('timberland', 1, $quarter, $year) ?>
                <?php $column_4+=$four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 1, $quarter, $year) ?>
                <?php $column_5+=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 1, $quarter, $year) ?>
                <?php $column_6+=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 1, $quarter, $year) ?>
                <?php $column_7+=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 1, $quarter, $year) ?>
                <?php $column_8+=$eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9+=$nine ?>
                <td><?php echo number_format($nine, 2) ?></td>
                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('timberland', 1, $quarter, $year) ?>
                <?php $column_10+=$ten ?>
                <?php $col6_land=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>  
            </tr>
            <tr>
                <td class="text-left" style="font-weight:bold">Special</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
            </tr>
            <tr>
                <td>Hospital</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>-</td>
            </tr>
            <tr>
                <td>Scientific</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>-</td>
            </tr>
            <tr>
                <td>Cultural</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>-</td>
            </tr>
            <tr>
                <td>Others (Specify)</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>-</td>
            </tr>
            <tr>
                <td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr style="font-weight:bold">
                <td class="text-left"> Taxable Properties</td>
                <?php $total_col_2 = $column_2; $total_col_3 = $column_3; $total_col_4 = $column_4; $total_col_5 = $column_5; $total_col_6 = $column_6; $total_col_7 = $column_7; $total_col_8 = $column_8; $total_col_9 = $column_9; $total_col_10 = $column_10; ?>
                <td><?php echo number_format($column_2) ?></td>
                <td><?php echo number_format($column_3) ?></td>
                <td><?php echo number_format($column_4, 2) ?></td>
                <td><?php echo number_format($column_5, 2) ?></td>
                <td><?php echo number_format($column_6, 2) ?></td>
                <td><?php echo number_format($column_7, 2) ?></td>
                <td><?php echo number_format($column_8, 2) ?></td>
                <td><?php echo number_format($column_9, 2) ?></td>
                <td><?php echo number_format($column_10, 2) ?></td>
            </tr>
            <tr>
                <td class="text-left">Exempt:</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>-</td>
            </tr>
            <td>Government</td>

                <td><?php echo $column_2 = $quarterly->num_real_property_unit('government', 0, $quarter, $year) ?></td>

                <?php $column_3 = $quarterly->sum_real_property_unit_area('government', 0, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('government', 0, $quarter, $year)) ?></td>
                
                <?php $four = $quarterly->mv_sum_land('government', 0, $quarter, $year) ?>
                <?php $column_4 = $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 0, $quarter, $year) ?>
                <?php $column_5=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 0, $quarter, $year) ?>
                <?php $column_6=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 0, $quarter, $year) ?>
                <?php $column_7=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 0, $quarter, $year) ?>
                <?php $column_8 = $eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9=$nine ?>
                <td><?php echo  number_format($nine, 2) ?></td>

                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('government', 0, $quarter, $year) ?>
                <?php $column_10=$ten ?>
                <?php $col10_gov=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>               
            </tr>
            <td>Religious</td>

                <td><?php echo $column_2 = $quarterly->num_real_property_unit('residential', 0, $quarter, $year) ?></td>

                <?php $column_3 = $quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year)) ?></td>
                
                <?php $four = $quarterly->mv_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_4 = $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 0, $quarter, $year) ?>
                <?php $column_5=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 0, $quarter, $year) ?>
                <?php $column_6=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 0, $quarter, $year) ?>
                <?php $column_7=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 0, $quarter, $year) ?>
                <?php $column_8 = $eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9=$nine ?>
                <td><?php echo  number_format($nine, 2) ?></td>

                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_10=$ten ?>
                <?php $col10_rel=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>               
            </tr>
            <td>Charitable</td>

                <td><?php echo $column_2 = $quarterly->num_real_property_unit('residential', 0, $quarter, $year) ?></td>

                <?php $column_3 = $quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year)) ?></td>
                
                <?php $four = $quarterly->mv_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_4 = $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 0, $quarter, $year) ?>
                <?php $column_5=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 0, $quarter, $year) ?>
                <?php $column_6=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 0, $quarter, $year) ?>
                <?php $column_7=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 0, $quarter, $year) ?>
                <?php $column_8 = $eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9=$nine ?>
                <td><?php echo  number_format($nine, 2) ?></td>

                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_10=$ten ?>
                <?php $col10_cha=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>               
            </tr>
            <td>Educational</td>

                <td><?php echo $column_2 = $quarterly->num_real_property_unit('residential', 0, $quarter, $year) ?></td>

                <?php $column_3 = $quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year)) ?></td>
                
                <?php $four = $quarterly->mv_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_4 = $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 0, $quarter, $year) ?>
                <?php $column_5=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 0, $quarter, $year) ?>
                <?php $column_6=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 0, $quarter, $year) ?>
                <?php $column_7=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 0, $quarter, $year) ?>
                <?php $column_8 = $eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9=$nine ?>
                <td><?php echo  number_format($nine, 2) ?></td>

                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_10=$ten ?>
                <?php $col10_edu=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>               
            </tr>
            <td>Others (Specify)</td>

                <td><?php echo $column_2 = $quarterly->num_real_property_unit('residential', 0, $quarter, $year) ?></td>

                <?php $column_3 = $quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year) ?>
                <td><?php echo number_format($quarterly->sum_real_property_unit_area('residential', 0, $quarter, $year)) ?></td>
                
                <?php $four = $quarterly->mv_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_4 = $four ?>
                <td><?php echo number_format($four, 2) ?></td>

                <?php $five = $quarterly->mv_sum_building('building', '<=', 0, $quarter, $year) ?>
                <?php $column_5=$five ?>
                <td><?php echo count($five) > 0? number_format($five, 2): '-' ?></td>

                <?php $six = $quarterly->mv_sum_building('building', '>', 0, $quarter, $year) ?>
                <?php $column_6=$six ?>
                <td><?php echo count($six) > 0? number_format($six, 2) : '-' ?></td>

                <?php $seven = $quarterly->mv_sum_machinery('machinery', 0, $quarter, $year) ?>
                <?php $column_7=$seven ?>
                <td><?php echo  count($seven) > 0? number_format($seven, 2) : '-' ?></td>

                <?php $eight =  $quarterly->mv_sum_others('others', 0, $quarter, $year) ?>
                <?php $column_8 = $eight ?>
                <td><?php echo count($eight) > 0? number_format($eight, 2) : '-'  ?></td>
                
                <?php $nine = ($four + $five + $six + $seven + $eight) ?>
                <?php $column_9=$nine ?>
                <td><?php echo  number_format($nine, 2) ?></td>

                <!-- assessed value for land -->
                <?php $ten = $quarterly->av_sum_land('residential', 0, $quarter, $year) ?>
                <?php $column_10=$ten ?>
                <?php $col10_oth=$ten ?>
                <td><?php echo count($ten) > 0? number_format($ten, 2) : '-'  ?></td>               
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
             <tr style="font-weight:bold">
                <td class="text-left"> Tax Exempt Properties</td>
                 <?php $total_col_2 += $column_2; $total_col_3 += $column_3; $total_col_4 += $column_4; $total_col_5 += $column_5; $total_col_6 += $column_6; $total_col_7 += $column_7; $total_col_8 += $column_8; $total_col_9 += $column_9; $total_col_10 += $column_10;  ?>
                <td><?php echo number_format($column_2) ?></td>
                <td><?php echo number_format($column_3) ?></td>
                <td><?php echo number_format($column_4, 2) ?></td>
                <td><?php echo number_format($column_5, 2) ?></td>
                <td><?php echo number_format($column_6, 2) ?></td>
                <td><?php echo number_format($column_7, 2) ?></td>
                <td><?php echo number_format($column_8, 2) ?></td>
                <td><?php echo number_format($column_9, 2) ?></td>
                <td><?php echo number_format($column_10, 2) ?></td>
            </tr>
            <tr style="font-weight:bold;font-size:20px">
                <td class="text-left">TOTALS</td>
                <td><?php echo number_format($total_col_2) ?></td>
                <td><?php echo number_format($total_col_3) ?></td>
                <td><?php echo number_format($total_col_4, 2) ?></td>
                <td><?php echo number_format($total_col_5, 2) ?></td>
                <td><?php echo number_format($total_col_6, 2) ?></td>
                <td><?php echo number_format($total_col_7, 2) ?></td>
                <td><?php echo number_format($total_col_8, 2) ?></td>
                <td><?php echo number_format($total_col_9, 2) ?></td>
                <td><?php echo number_format($total_col_10, 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>
<a class="btn btn-md btn-primary" href="<?php echo base_url('admin/reports/quarterly?quarter='.$quarter.'&year='.$year.'&page=2&res_10='.$col1_land.'&agr_10='.$col2_land.'&com_10='.$col3_land.'&ind_10='.$col4_land.'&min_10='.$col5_land.'&tim_10='.$col6_land.'&gov_10='.$col10_gov.'&rel_10='.$col10_rel.'&cha_10='.$col10_cha.'&edu_10='.$col10_edu.'&oth_10='.$col10_oth) ?>">Next Page</a>
                                    <div class="form-group"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>