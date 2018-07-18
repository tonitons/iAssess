
<div class="container">
	<div class="register-form">
		<div class="wow fadeInUp custom-form">
		<a class="pull-left btn btn-primary btn-sm" href="<?php echo base_url('home#calculator') ?>">BACK</a>
			<h2>Calculator <p>Category: agricultural lands</p></h2>
			<div class="steps">
				<ul>
					<li class="Agri">Step 1 - Select the type of agricultural land you have and it's classification.</li>
					<li class="Agri">Step 2 - Select appropriate adjustments.</li>
					<li class="Agri">Step 3 - Enter Area in Square meter or in hectare</li>
					<li class="Agri">Step 4 - Click 'Calculate' and wait for the reply of the site.</li>
				</ul>
			</div>
			<br>
			<br>
				<div class="container form-signin" class="col-md-4">
					<form action="">
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Type of Land</label>
							<div class=" col-md-4">
								<select name="" id="agri_class" class="form-control input-lg">
									<option value="" selected disabled>-- SELECT --</option>
									<?php foreach ($market_values as $value): ?>
										<option value="<?php echo $value->agri_id ?>"><?php echo $value->agri_land ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div> 						
						<br class="hidden-sm hidden-xs">
						<br class="hidden-sm hidden-xs"> 
						<br class="hidden-sm hidden-xs"> 
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Road Adjustment</label>
							<div class=" col-md-4">
								<select name="" id="road-adj" class="form-control input-lg">
									<option value="" selected disabled>-- SELECT --</option>
									<option value="0">Along Provincial or National Road</option>
									<option value="-3">For all weather roads</option>
									<option value="-6">Along Dirt road</option>
									<option value="-9">For no road Outlet</option>
								</select>
							</div>
						</div>
						
						<br class="hidden-sm hidden-xs"> 
						<br class="hidden-sm hidden-xs"> 
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Location (From Poblacion)</label>
							<div class=" col-md-4">
								<select name="" id="location-adj" class="form-control input-lg">
									<option value="" selected disabled>-- SELECT --</option>
									<option id="L0-1" value="+5">0 to 1 kms.</option>
									<option id="L1-3" value="-2">Over 1 to 3 kms.</option>
									<option id="L3-6" value="-6">Over 3 to 6 kms.</option>
									<option id="L6-9" value="-10">Over 6 to 9 kms.</option>
									<option id="L9-above" value="-14">Over 9 kms.</option>
								</select>
							</div>
						</div>
						
						<br class="hidden-sm hidden-xs"> 
						<br class="hidden-sm hidden-xs"> 
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Classification</label>
							<div class=" col-md-4">
								<!-- <select name="" id="classification" onchange="get_unit_value()" class="form-control input-lg">
									<option value="" selected disabled> SELECT </option>
									<option value="first">First Class</option>
									<option value="second">Second Class</option>
									<option value="third">Third Class</option>
								</select> -->
								<input type="text" readonly id="classif" class="form-control input-lg">
								<input type="hidden" id="classification">
							</div>
						</div>
						
						<br class="hidden-sm hidden-xs"> 
						<br class="hidden-sm hidden-xs"> 	
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Base Market Value</label>
							<div class=" col-md-4">
								<input type="text" name="" readonly id="unit-value" class="form-control input-lg">
							</div>
						</div>
						
						<br class="hidden-sm hidden-xs"> 
						<br class="hidden-sm hidden-xs"> 
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Land Area (sq. m.): </label>
							<div class=" col-md-4">
								<input type="number" step="any" name="" id="land-area" class="form-control input-lg">
							</div>
						</div>
						
						<br class="hidden-sm hidden-xs"> 
						<br class="hidden-sm hidden-xs"> 
						<div class="form-group col-md-4 center col-md-push-4">
							<a href="#" onclick="Calculate_Appraisal()" class="btn btn-primary form-control">CALCULATE</a>
						</div>
					</form>
					
				</div>
			
		</div>
	</div>
</div>

<!--########################################### START REVISION MODAL ###########################################-->

<div id="market-value-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel">The Calculation</h4>
      	</div>
      	<div class="modal-body">
      	<div class="">
      		<table class="table">
      		<tbody>
      			<tr>
      				<td class="Agri">Type Of Land</td>
      				<td class="Agri" id="type-input"></td>
      				<td class="Agri"></td>
      			</tr>
      			<tr>
      				<td class="Agri">Classification</td>
      				<td class="Agri" id="class-input"></td>
      				<td class="Agri"></td>
      			</tr>
      			<tr>
      				<td class="Agri">Road Adjustment</td>
      				<td class="Agri" id="road-input"></td>
      				<td class="Agri"><span class="Agri" id="road-adj-input"></span>%</td>
      			</tr>
      			<tr>
      				<td class="Agri">Location (from Poblacion)</td>
      				<td class="Agri" id="location-input"></td>
      				<td class="Agri"> <span  class="Agri" id="location-adj-input"></span>%</td>
      			</tr>
      			<tr>
      				<td class="Agri">Percent Adjustment</td>
      				<td class="Agri"></td>
      				<td ><span class="Agri" id="percent"></span>%</td>
      			</tr>
      			<tr class="bg-warning">
      				<td class="Agri">Market Value</td>
      				<td class="Agri" id="show-calc"></td>
      				<td class="Agri" id="market-value"></td>
      			</tr>
      			<tr class="bg-warning">
      				<td class="Agri">Adjustments</td>
      				<td class="Agri" id="show-adjust"></td>
      				<td class="Agri" id="adjustment-value"></td>
      			</tr>
      			<tr class="bg-primary mvalue">
      				<td class="Agri"><span style="">ADJUSTED MARKET VALUE</span></td>
      				<td style=""></td>
      				<td class="Agri">P&nbsp;&nbsp;<b class="Agri" id="adjusted-market-value"></b></td>
      			</tr>
      		</tbody>
      		</table>
      		</div>
      	</div>
      	<div class="modal-footer">
  
        	<button type="submit" id="save" class="btn" data-dismiss="modal" data-target="market-value-modal"><span class="glyphicon glyphicon-check"></span>  <span>OK</span></button>
      	</div>
      	
    </div>
  </div>
</div>
<!--###########################################END REVISION MODAL###########################################-->