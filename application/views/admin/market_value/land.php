

<div class="container">
	<div class="row register-form">
		<div class="custom-form">
			<?php if(!empty($message)): ?>
			    <?php $this->load->view('template/message', ['message' => $message]) ?>
			    <script>$('#notification').modal('show');</script>
			    <?php if (!empty($this->input->post('action') == 'revise') && $message['referrer'] == 'revision'): ?>
			    	<script>$('#increase').modal('show');</script>
			    <?php endif; ?>
		    <?php endif; ?>
		    <?php if(!empty(validation_errors())): ?>
			    <?php $this->load->view('template/message', ['message' => $validation]) ?>
			    <script>$('#notification').modal('show');</script>
		    <?php endif; ?>
			<!-- <button class="btn btn-md btn-primary"></button> -->

			<h2>Schedule of Unit Market Value for Land</h2>
			<br>
			<!-- <a class="btn btn-primary"  href="#" data-toggle="modal" data-target="#mv_land">Add</a> -->
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
				<a href="<?php echo base_url('admin/market_value/history') ?>" class="pull-left btn btn-default btn-xs" style="margin-top:0">Revision History</a>
				<div class="clearfix"></div>
				<div class="table-responsive">
					<table class="table table-striped" id="tbl_mvland"> 
						<thead>
							<tr>
								<th class="hidden">Uid</th>
								<th><label for="">No.</label></th>
								<th><label for="">KIND</label></th>
								<th><label for="">1st</label></th>
								<th><label for="">2nd</label></th>
								<th><label for="">3rd.</label></th>
								<th><label for="">4th</label></th>
								<th><label for="">5th</label></th>
								<th><label for="">Options</label></th>
							</tr>
						</thead>
						<tbody>
							<?php $ctr =1; ?>
							<?php foreach ($market_values as $mvalue): ?>
								<tr>
									<td class="hidden"><?php echo $mvalue->kind ?></td>
									<td><?php echo $ctr++; ?>.</td>
									<td><?php echo $mvalue->kind ?></td>
									<td><?php echo number_format($mvalue->first, 2) ?></td>
									<td><?php echo number_format($mvalue->second, 2) ?></td>
									<td><?php echo number_format($mvalue->third, 2) ?></td>
									<td><?php echo number_format($mvalue->fourth, 2) ?></td>
									<td><?php echo number_format($mvalue->fifth, 2) ?></td>
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
      	</div>
      	<form role="form" action="" method="POST" onsubmit="return confirm('Are you sure to increase all current market values to '+$('#percent').val()+'%?')">
      	<div class="modal-body">
      		<input type="hidden" name="action" value="increase">
      		<label for="">How many percent?</label>
      		<input type="number" class="form-control" name="percent" id="percent">
      	</div>
      	<div class="modal-footer">
      		<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
        <button class="btn btn-default" type="submit" id="save"> <span class="glyphicon glyphicon-check"></span> Increase</button>

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
<div class="modal fade" id="mv_land" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">LAND MARKET VALUE</label></h4>
      </div>
      <div class="modal-body">
		<form role="form" class="form-horizontal" method="POST" action="">
			<input type="hidden" id="rcid" name="rci_id">
			<input type="hidden" name="action" value="add">
			<div class="row">
				<div class="col-md-4">
                    <h5 class="text-right"><label for="">KIND</label></h5>
                </div>
                <div class="col-md-6">
                    <select name="kind" id="kind" class="form-control" required>
						<option disabled selected>--select--</option>
						<option id="Land_Com" onselect="changeVal(this.id)" value="Commercial"><label for="">Commercial</label></option>
						<option id="Land_Res" onselect="changeVal(this.id)" value="Residential"><label for="">Residential</label></option>
						<option id="Land_Ind" onselect="changeVal(this.id)" value="Industrial"><label for="">Industrial</label></option>
					</select>
                </div>
		    </div>
		    <div class="row">
                <div class="col-md-4">
                    <h5 class="text-right"><label for="">1st</label> </h5>
                </div>
                <div class="col-md-6">
                    <input type="number" step="any" class="form-control" name="first" id="first">
                </div>
            </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right"><label for="">2nd </label></h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="second" id="second">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right"><label for="">3rd </label></h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="third" id="third">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right"><label for="">4th</label> </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="fourth" id="fourth">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right"><label for="">5th</label> </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="fifth" id="fifth">
		        </div>
		    </div>

      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
        <button class="btn btn-default" type="submit" id="save"> <span class="glyphicon glyphicon-check"></span> Add</button>
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
			<input type="hidden" id="u_id" name="rci_id">
			<input type="hidden" name="action" value="update">
			<div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">KIND </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" step="any" class="form-control" name="kind" id="u_kind" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">1st </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="first" id="u_first">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">2nd </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="second" id="u_second">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">3rd </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="third" id="u_third">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">4th </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="fourth" id="u_fourth">
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">5th </h5>
                </div>
		        <div class="col-md-6">
					<input type="number" step="any" class="form-control" name="fifth" id="u_fifth">
		        </div>
		    </div>

      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
        <button class="btn btn-default" type="submit" id="save"> <span class="glyphicon glyphicon-check"></span> Update</button>
      </div>
  		</form>
  </div>
</div>
</div>     

<!--######################################## END EDIT MARKET VALUE LAND MODAL #######################################-->

<script>

		function changeVal(data){
			alert(data);
			$('#rcid').val(data);
			
		}

		function increase() {
			$('#increase').modal('show');
		}

</script>