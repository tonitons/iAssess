
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

			<h2 class="section-title">Schedule of Base Unit Market Value for Agricultural Lands</h2><br>
			<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#mv_agri">Add</a>
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
				<label class="gwapoak">Revision: <?php echo $this->session->current_revision ?> </label><br>				
				<label class="gwapoak">Last Increase: <?php echo $updated ?></label><br>
				<label class="gwapoak">Increase Value: <?php echo $percent ?>%</label><hr>
			<?php endif; ?>
			<div class="table-responsive">
			<table class="table table-striped" id="tbl_mvland"> 
				<thead>
					<tr>
						<th class="hidden"></th>
						<th><label>No.</label></th>
						<th><label>LANDS</label></th>
						<th><label>1st class</label></th>
						<th><label>2nd class</label></th>
						<th><label>3rd class</label></th>
						<th><label>Options</label></th>
					</tr>
				</thead>
				<tbody>
					<?php $ctr = 1; ?>
					<?php foreach ($market_values as $mvalue): ?>
						<tr>
							<td class="hidden"><?php echo $mvalue->agri_id ?></td>
							<td><?php echo $ctr++; ?>.</td>
							<td><?php echo $mvalue->agri_land ?></td>
							<td><?php echo number_format($mvalue->first, 2) ?></td>
							<td><?php echo number_format($mvalue->second, 2) ?></td>
							<td><?php echo number_format($mvalue->third, 2) ?></td>
							<td><button class="btn btn-primary edit_data">Update</button></td>
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
        <p class="form-help">Note: This will increase all current market for agricultural lands.</p>
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
<!--###########################################END INCREASE VALUE MODAL###########################################-->

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

<!--########################################### ADD MARKET VALUE MODAL ###########################################-->
<div class="modal fade col-md-offset-3 col-md-6" id="mv_agri" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">AGRICULTURAL LAND MARKET VALUE</label></h4>
      </div>
      <div class="modal-body">
		<form role="form" class="form-horizontal" method="POST" action="">
			<input type="hidden" id="agri_id" name="agri_id">
			<input type="hidden" name="action" value="add">
			<div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">Type of Land </h5>
                </div>
		        <div class="col-md-6">
					<select name="agri_land" id="Agri_land" class="form-control"  required>
						<option disabled selected>--select--</option>
						<option id="agri_rice_i" onclick="changeval(this.id)" value="Rice Land Irrigated">Rice Land Irrigated</option>
						<option id="agri_rice_u" onclick="changeval(this.id)" value="Rice Land Unirrigated">Rice Land Unirrigated</option>
						<option id="agri_corn" onclick="changeval(this.id)" value="Corn Land">Corn Land</option>
						<option id="agri_coco" onclick="changeval(this.id)" value="Coconut Land">Coconut Land</option>
						<option id="agri_sugar" onclick="changeval(this.id)" value="Sugar Land">Sugar Land</option>
						<option id="agri_pond" onclick="changeval(this.id)" value="Fish Pond">Fish Pond</option>
						<option id="agri_nipa" onclick="changeval(this.id)" value="Nipa Land">Nipa Land</option>
						<option id="agri_peanut" onclick="changeval(this.id)" value="Peanut Land">Peanut Land</option>
						<option id="agri_pine" onclick="changeval(this.id)" value="Pineapple Land">Pineapple Land</option>
						<option id="agri_abaca" onclick="changeval(this.id)" value="Abaca Land">Abaca Land</option>
						<option id="agri_cassava" onclick="changeval(this.id)" value="Cassava Land">Cassava Land</option>
						<option id="agri_past" onclick="changeval(this.id)" value="Pasture Land">Pasture Land</option>
						<option id="agri_spotato" onclick="changeval(this.id)" value="Sweet Potato Land">Sweet Potato Land</option>
						<option id="agri_mongo" onclick="changeval(this.id)" value="Mongo Land">Mongo Land</option>
						<option id="agri_cac_cof" onclick="changeval(this.id)" value="Cacao and Coffee Land">Cacao and Coffee Land</option>
						<option id="agri_citr" onclick="changeval(this.id)" value="Citrus Land">Citrus Land</option>
						<option id="agri_corn" onclick="changeval(this.id)" value="Corn Land">Corn Land</option>
						<option id="agri_comm_tree" onclick="changeval(this.id)" value="Commercial Tree Farming">Commercial Tree Farming</option>
						<option id="agri_comm_fuit" onclick="changeval(this.id)" value="Commercial Fruit Tree Farming">Commercial Fruit Tree Farming</option>
						<option id="agri_cut_flow" onclick="changeval(this.id)" value="Cut Flower Production">Cut Flower Production</option>
					</select>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">1st Class </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="first" id="first">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">2nd Class </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="second" id="second">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">3rd Class </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="third" id="third">
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
			<input type="hidden" id="u_id" name="agri_id">
			<input type="hidden" name="action" value="update">
			<div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Type of Land</h5>
                </div>
		        <div class="col-md-6">
					<input type="text" step="any" class="form-control" name="agri_land" id="u_kind" readonly>
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">1st Class </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="first" id="u_first">
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">2nd Class </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="second" id="u_second">
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">3rd Class </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="third" id="u_third">
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

		function changeval(data){
			$('#agri_id').val(data);
		}

</script>