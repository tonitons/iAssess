
<div class="container">
	<div class="register-form">
		<div class="wow fadeInUp custom-form">
		<a class="pull-left btn btn-primary btn-sm" href="<?php echo base_url('home#calculator') ?>">BACK</a>
			<h2>Calculator <p>Category: Improvements</p></h2>
			<div class="steps">
				<ul>
					<li class="Agri">Step 1 - Select the type of improvement you have.</li>
					<li class="Agri">Step 3 - Enter number of trees or plants.</li>
					<li class="Agri">Step 4 - Click 'Calculate' and wait for the reply of the site.</li>
				</ul>
			</div> <br><br>
				<div class="container form-signin" class="col-md-4">
					<form action="">
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Land Improvements</label>
							<div class=" col-md-4">
								<select name="" id="improvement" onchange="get_unit_value()" class="form-control input-lg">
									<option value="" selected disabled>-- SELECT --</option>
									<?php foreach ($market_values as $value): ?>
										<option value="<?php echo $value->plant_id ?>"><?php echo $value->kind ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	

						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Base Value:</label>
							<div class=" col-md-4">
								<input type="text" readonly id="unit-value" class="form-control input-lg">
							</div>
						</div>
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	

						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Number of Plant/Trees:</label>
							<div class=" col-md-4">
								<input type="number" name="" id="number-trees" class="form-control input-lg">
							</div>
						</div>
						<br class="hidden-sm hidden-xs"> 	
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
        <h2 class="modal-title" id="myLoginLabel">THE CALCULATION</h2>
      	</div>
      	<div class="modal-body">
      		<table class="table">
      			<tr>
      				<td class="Agri">Improvements</td>
      				<td class="Agri" id="imp-input"></td>
      				
      			</tr>
      			<tr>
      				<td class="Agri">Base Value</td>
      				<td class="Agri" id="base-value"></td>
      			</tr>
      			<tr>
      				<td class="Agri">Number of Plant Trees</td>
      				<td class="Agri" id="number-input"></td>
      				
      			</tr>
      			<tr>
      				<td class="Agri"></td>
      				<td class="Agri" id="show-calc"></td>
      			</tr>
      			<tr class="bg-primary ">
      				<td class="Agri"><span style="font-size:20px">ESTIMATED VALUE</span></td>
      				<td class="Agri">P&nbsp;&nbsp;<span id="adjusted-market-value" style="font-size:20px"></span></td>
      				
      			</tr>
      		</table>
      	</div>
      	<div class="modal-footer">
        	<button type="submit" id="save" data-dismiss="modal" data-target="market-value-modal" class="btn"><span class="glyphicon glyphicon-check"></span>  <span>OK</span></button>
      	</div>
      	
    </div>
  </div>
</div>
<!--###########################################END REVISION MODAL###########################################-->