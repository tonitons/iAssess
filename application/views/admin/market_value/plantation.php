

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
		<h2 class="section-title">Improvements: Plants and Trees (Productive and Fruit Bearing) COMMERCIAL/PLANTATION</h2>
		<br>
		<a class="btn btn-primary" href="#" data-toggle="modal" data-target="#mv_plant">Add</a>
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
		<table class="table table-striped" id="tbl_mvplant"> 
			<thead>
				<tr>
					<th><label for="">No.</label></th>
					<th><label for="">KIND</label></th>
					<th><label for="">Value</label></th>
					<th><label for="">Options</label></th>
				</tr>
			</thead>
			<tbody>
				<?php $ctr = 1; ?>
				<?php foreach ($market_values as $mvalue): ?>
					<tr>
						<td><?php echo $ctr++; ?>.</td>
						<td><?php echo $mvalue->kind ?></td>
						<td><?php echo number_format($mvalue->value, 2) ?></td>
						<td><button class="btn btn-primary edit_data">Update</button></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
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
<div class="modal fade col-md-offset-3 col-md-6" id="mv_plant" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">IMPROVEMENTS: Plant and Trees</label></h4>
      </div>
      <div class="modal-body">
		<form role="form" class="form-horizontal" method="POST" action="">
			<input type="hidden" id="plant_id" name="plant_id">
			<input type="hidden" name="action" value="add">
			<div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Kind </h5>
                </div>
		        <div class="col-md-6">
					<select name="kind" id="Agri_land" class="form-control"  required>
						<option disabled selected>--select--</option>
						<option id="pl_aba" onclick="changeval(this.id)" value="Abaca (per group)">Abaca (per group)</option>
						<option id="pl_atis" onclick="changeval(this.id)" value="Atis">Atis</option>
						<option id="pl_avo" onclick="changeval(this.id)" value="Avocado">Avocado</option>
						<option id="pl_bam" onclick="changeval(this.id)" value="Bamboo (Tangnan, Patong per clump)">Bamboo (Tangnan, Patong per clump)</option>
						<option id="pl_ban" onclick="changeval(this.id)" value="Banana (per group)">Banana (per group)</option>
						<option id="pl_cac" onclick="changeval(this.id)" value="Cacao">Cacao</option>
						<option id="pl_cai" onclick="changeval(this.id)" value="Caimito">Caimito</option>
						<option id="pl_cah" onclick="changeval(this.id)" value="Cahil (Orange)">Cahil (Orange)</option>
						<option id="pl_cal" onclick="changeval(this.id)" value="Calamansi (Lemon)">Calamansi (Lemon)</option>
						<option id="pl_cam" onclick="changeval(this.id)" value="Camachile">Camachile</option>
						<option id="pl_cas" onclick="changeval(this.id)" value="Cassava (per hill)">Cassava (per hill)</option>
						<option id="pl_camo" onclick="changeval(this.id)" value="Camote (per hill)">Camote (per hill)</option>
						<option id="pl_chi" onclick="changeval(this.id)" value="Chico">Chico</option>
						<option id="pl_cit" onclick="changeval(this.id)" value="Citrus (Suha)">Citrus (Suha)</option>
						<option id="pl_coc" onclick="changeval(this.id)" value="Coconut tree (bearing or productive)">Coconut tree (bearing or productive)</option>
						<option id="pl_cof" onclick="changeval(this.id)" value="Coffee">Coffee</option>
						<option id="pl_guy" onclick="changeval(this.id)" value="Guyabano">Guyabano</option>
						<option id="pl_gab" onclick="changeval(this.id)" value="Gabi">Gabi</option>
						<option id="pl_igo" onclick="changeval(this.id)" value="Igot or Malaigang">Igot or Malaigang</option>
						<option id="pl_jack" onclick="changeval(this.id)" value="Jackfruit (Langka)">Jackfruit (Langka)</option>
						<option id="pl_lan" onclick="changeval(this.id)" value="Lansones">Lansones</option>
						<option id="pl_mab" onclick="changeval(this.id)" value="Mabolo">Mabolo</option>
						<option id="pl_mac" onclick="changeval(this.id)" value="Macopa">Macopa</option>
						<option id="pl_man" onclick="changeval(this.id)" value="Mango">Mango</option>
						<option id="pl_nip" onclick="changeval(this.id)" value="Nipa (per hill)">Nipa (per hill)</option>
						<option id="pl_pal" onclick="changeval(this.id)" value="Palawan (per hill)">Palawan (per hill)</option>
						<option id="pl_pil" onclick="changeval(this.id)" value="Pili">Pili</option>
						<option id="pl_pin" onclick="changeval(this.id)" value="Pineapple (per head)">Pineapple (per head)</option>
						<option id="pl_san" onclick="changeval(this.id)" value="Santol">Santol</option>
						<option id="pl_tamb" onclick="changeval(this.id)" value="Tambis">Tambis</option>
						<option id="pl_tama" onclick="changeval(this.id)" value="Tamarindo">Tamarindo</option>
						<option id="pl_tre" onclick="changeval(this.id)" value="Molave, Narra, Mahogany, Gemelina, Acacia, Balite (10 inches diameter)">Molave, Narra, Mahogany, Gemelina, Acacia, Balite (10 inches diameter)</option>
						<option id="pl_other" onclick="changeval(this.id)" value="Other Trees (Ornamental)">Other Trees (Ornamental)</option>
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
			<input type="hidden" id="u_rcid" name="plant_id">
			<input type="hidden" name="action" value="update">
			<div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">KIND </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" name="kind" id="u_kind" readonly>
		        </div>
		    </div>
		    <div class="form-group">
				<div class="col-md-4">
                    <h5 class="text-right">Value </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="value" id="u_first">
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

<!--######################################## END EDIT MARKET VALUE LAND MODAL #######################################-->

<script>

		function changeval(data){
			$('#plant_id').val(data);
		}
		
</script>

