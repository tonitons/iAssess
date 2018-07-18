

<div class="container">
	<div class="row register-form">
		<div class="custom-form">
			<?php if(!empty($message)): ?>
			    <?php $this->load->view('template/message', ['message' => $message]) ?>
			    <script>$('#notification').modal('show');</script>
		    <?php endif; ?>
		    <?php if(!empty(validation_errors())): ?>
			    <?php $this->load->view('template/message', ['message' => $validation]) ?>
			    <script>$('#notification').modal('show');</script>
		    <?php endif; ?>
			<!-- <button class="btn btn-md btn-primary"></button> -->

			<h2>Schedule of Building Unit Value per Square Meter</h2>
			<br>
			<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#mv_land">Add</a>
			<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#increase">Increase Current Value</a>
			<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#mod_rev">Revision</a>
			<hr>
			<?php if(!empty($date)): ?>
				<?php foreach ($date as $value): ?>
					<?php 
						$updated = $value->date_updated;
						$percent = $value->increase;
						// $revision = $value->revision;
					 ?>
				<?php endforeach ?>
				<label class="gwapoak">Revision: <?php echo $this->session->current_revision; ?> </label><br>
				<label class="gwapoak">Last Increase: <?php echo $updated ?></label><br>
				<label class="gwapoak">Increase Value: <?php echo $percent ?>%</label><hr>
			<?php endif; ?>
				<div class="table-responsive">
					<table class="table table-striped" id="tbl_building"> 
						<thead>
							<tr>
								<th class="hidden">Uid</th>
								<th><label for="">No.</label></th>
								<th><label for="">Type of Building</label></th>
								<th><label for="">Building</label></th>
								<th><label for="">Value per sq. m.</label></th>
								<th><label for="">Options</label></th>
							</tr>
						</thead>
						<tbody>
							<?php $ctr =1; ?>
							<?php foreach ($market_values as $mvalue): ?>
								<tr>
									<td class="hidden"><?php echo $mvalue->sbuv_id ?></td>
									<td><?php echo $ctr++; ?>.</td>
									<td><?php echo $mvalue->building_type ?></td>
									<td><?php echo $mvalue->name_building ?></td>
									<td><?php echo number_format($mvalue->value, 2) ?></td>
									<td><button class="btn btn-primary edit_data_building">Update</button></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>
<!--########################################### START INCREASE VALUE MODAL ###########################################-->

<div id="increase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Increase Market Value</label></h4>
      	</div>
      	<form role="form" action="" method="POST" onsubmit="return confirm('Are you sure to increase all current market values to '+$('#percent').val()+'%?')">
      	<div class="modal-body">
      		<input type="hidden" name="action" value="increase">
      		<label for="">How many percent?</label>
      		<input type="number" class="form-control" name="percent" id="percent">
      	</div>
      	<div class="modal-footer">
      		<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
		<button type="submit" class="btn btn-success btn-modal"><span class="glyphicon glyphicon-check"></span>  <span>Add</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!--########################################### START REVISION MODAL ###########################################-->

<div id="mod_rev" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Current Revision</label></h4>
      	</div>
      	<form role="form" action="" method="POST" onsubmit="increase()">
      	<div class="modal-body">
      		<b>Current Revision: <?php echo $n_r = $this->session->current_revision; ?></b><br><br>
      		<input type="hidden" name="action" value="revise">
      		<label for="">New Revision: </label>
      		<input type="number" class="form-control" name="revision" value="<?php echo $n_r+1 ?>" id="revision" readonly>
      	</div>
      	<div class="modal-footer">
      		<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
        <button class="btn btn-default" type="submit" id="save"> <span class="glyphicon glyphicon-check"></span> Update</button>
        	
      	</div>
      	</form>
    </div>
  </div>
</div>
<!--###########################################END REVISION MODAL###########################################-->

<!--###########################################END INCREASE VALUE MODAL###########################################-->

<!--########################################### ADD MARKET VALUE MODAL ###########################################-->
<div class="modal fade col-md-offset-3 col-md-6" id="mv_land" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">BUILDING MARKET VALUE</label></h4>
      </div>
      <div class="modal-body">
		<form role="form" class="form-horizontal" method="POST" action="" onsubmit="check_id($('#building_type :selected').val(), $('#name_building :selected').attr('id'))">
			<input type="hidden" id="sbuv_id" name="sbuv_id">
			<input type="hidden" name="action" value="add">
			<div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Type of Building </h5>
                </div>
		        <div class="col-md-6">
					<select name="building_type" id="building_type" class="form-control" required>
						<option disabled selected>--select--</option>
						<option id="" value="I-A">I-A</option>
						<option id="" value="I-B">I-B</option>
						<option id="" value="I-C">I-C</option>
						<option id="" value="II-A">II-A</option>
						<option id="" value="II-B">II-B</option>
						<option id="" value="II-C">II-C</option>
						<option id="" value="II-D">II-D</option>
						<option id="" value="III-A">III-A</option>
						<option id="" value="III-B">III-B</option>
						<option id="" value="III-C">III-C</option>
						<option id="" value="III-D">III-D</option>
						<option id="" value="III-F">III-F</option>
						<option id="" value="IV">IV</option>
						<option id="" value="V">V</option>
					</select>
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Building </h5>
                </div>
		        <div class="col-md-6">
					<select name="name_building" id="name_building" class="form-control" required>
						<option disabled selected>--select--</option>
						<option id="onef" value="One-Family Dwelling">One-Family Dwelling</option>
						<option id="mult" value="Two Family Dwelling/Multiple Dwelling">Two Family Dwelling/Multiple Dwelling</option>
						<option id="row" value="Access Row/ Apartment House">Access Row/ Apartment House</option>
						<option id="hosb" value="Hotel Office School Building">Hotel Office School Building</option>
						<option id="movie" value="Movie Theater">Movie Theater</option>
						<option id="bodega" value="Bodega Warehouse/ Factory Building">Bodega Warehouse/ Factory Building</option>
						<option id="gas" value="Gas Service Station">Gas Service Station</option>
						<option id="saw" value="Sawmills and Lumber Shed">Sawmills and Lumber Shed</option>
					</select>
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Value </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="value" id="value">
		        </div>
		    </div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
		<button type="submit" class="btn btn-success btn-modal"><span class="glyphicon glyphicon-check"></span>  <span>Add</span></button>
      </div>
  		</form>
  </div>
</div>
</div>     

<!--######################################## END ADD MARKET VALUE LAND MODAL #######################################-->

<!--########################################### EDIT MARKET VALUE MODAL ###########################################-->
<div class="modal fade col-md-offset-3 col-md-6" id="update" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">UPDATE MARKET VALUE</label></h4>
      </div>
      <div class="modal-body">
		<form role="form" class="form-horizontal" method="POST" action="">
			<input type="hidden" id="u_id" name="sbuv_id">
			<input type="hidden" name="action" value="update">
			<div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Type of Building </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" name="building_type" id="u_building_type" readonly>
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Building </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" step="any" class="form-control" name="name_building" id="u_name_building" readonly>
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Value </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="value" id="u_value">
		        </div>
		    </div>

      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
		<button type="submit" class="btn btn-success btn-modal"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
      </div>
  		</form>
  </div>
</div>
</div>     

<!--######################################## END EDIT MARKET VALUE LAND MODAL #######################################-->

<script>

		function changeVal(data){
			$('#rcid').val(data);
			
		}

</script>