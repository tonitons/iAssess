
	<div class="row register-form">
			<!-- ################################################ -->
			<?php if(!empty($message)): ?>
		    <?php $this->load->view('template/message', ['message' => $message]) ?>
		    <script>$('#notification').modal("show")</script>
		    <?php endif; ?>
		    <?php if(!empty(validation_errors()) && isset($_POST)): ?>
		    <?php $this->load->view('template/message', ['message' => $validation]) ?>
		    <script>$('#notification').modal("show")</script>
		    <?php endif; ?>
			<!-- ################################################# -->
			
		<div class="custom-form">

			<h2>My Properties</h2>
			

			<div class="table-responsive">
				<table class="table table-bordered" style="background-color:white">
					<thead>
					<tr class="bg-primary">
						<th>PIN</th>
						<th>Cadastral Lot NO.</th>
						<th>Area (sq. m.)</th>
						<th>Location</th>
						<!-- <th>Classification</th> -->
						<th>Sub-class</th>
						<th>Sub-type</th>
						<th>Base Value</th>
						<th>Appraised Value</th>
						<th>Assessed Value</th>
						<th>Tax Amount</th>
						<th>Paid</th>
						<th>Year</th>
						<th>Revision</th
						
					</tr>
					</thead>
					<tbody>
					<?php $ctr = 1; $disc_msg='';?>
					<?php foreach ($properties as $value): ?>
						<tr>
							<td><?php echo $value->pin ?></td>
							<td><?php echo $value->cadastral_lot_no ?></td>
							<td><?php echo $value->area ?></td>
							<td><?php echo $value->barangay_name ?></td>
							<!-- <td class="text-capitalize"></?php echo $value->classification ?></td> -->
							<td><?php echo $value->agri_land ?></td>
							<td class="text-capitalize"><?php echo $value->sub_type ?>&nbsp;Class</td>
							<td><?php echo number_format($value->base_value, 2) ?></td>
							<td><?php echo number_format($value->appraised_value, 2) ?></td>
							<td><?php echo number_format($value->assessment_value, 2) ?></td>
							<td>
							<?php
								if(empty($value->amount_received)){
								$add = 0; 
								$due_date = strtotime($value->due_date);
								$datetoday = strtotime(date('Y-m-d'));
								$year = date('Y');
								if($datetoday > $due_date)
									$add = 1;
								
								$datediff = intval(($due_date - $datetoday)/2635200);

								$percent = abs($datediff-$add);
								if($datetoday <= strtotime("$year-03-31") && $percent <=3){
									$totaltax = number_format($value->tax_amount, 2);
									$percent = 0;
									$disc_msg = "Avail $discount_percent% discount if you pay on or before March 31, $year";
								}else{
									$totaltax = number_format(($value->tax_amount + ($value->tax_amount * ($percent*0.02))), 2);
								}
								//echo number_format($value->tax_amount, 2); 
								// if($percent == 24)
									// $totaltax = number_format(($value->tax_amount + ($value->tax_amount * (12*0.02))), 2);
								// else

								echo $totaltax;
								// echo number_format($value->amount_received, 2);

								$modal_id = 'tax_'.$ctr;
							?><br>
							<a href="#" id="<?php echo $modal_id ?>" class="btn-sm btn-default tax-detail"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;view</a>
							<?php }else{
									echo number_format($value->amount_received, 2);
								} ?>
							</td>
							<?php 
								if($value->status == 0) {$classn = 'text-danger'; $text = 'Not yet';}
								else if($value->status == 1){$classn = 'text-warning'; $text = 'Partial';}
								else {$classn = 'text-success'; $text = 'Fully Paid';}

							?>
							<td class="<?php echo $classn ?>"><?php echo '<b>'.$text.'</b>' ?></td>
							<td><?php echo date('Y', strtotime($value->date_appraised)) ?></td>
							<td><?php echo $value->revision ?></td>
							
						</tr>
						<?php if(empty($value->amount_received)): ?>
						<div id="<?php echo $modal_id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-sm">
						    <div class="modal-content">
						    	<div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						        <h4 style="color:white" id="myLoginLabel">AMOUNT BREAKDOWN</h4>
						      	</div>
						      	
						      	<div class="modal-body">
						      
						      		<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Appraised Value:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo 'P'.number_format($value->appraised_value, 2) ?></c>
						      			</div>
						      		</div>
						      		<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Assessed Value:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo 'P'.number_format($value->assessment_value, 2) ?></c>
						      			</div>
						      		</div>
						      		<!-- <div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Due Date:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c></?php echo $value->due_date ?></c>
						      			</div>
						      		</div> -->
						      		<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Month(s) Delinquency:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo $percent.' ' ?>month(s)</c>
						      			</div>
						      		</div>
									<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Monthly Interest:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c>0.02% or 2%</c>
						      			</div>
						      		</div>
						      		<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Interest Amount:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo 'P'.$value->tax_amount*($percent*0.02) ?></c>
						      			</div>
						      		</div>
						      		<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Initial Tax:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo 'P'.number_format($value->tax_amount, 2) ?></c>
						      			</div>
						      		</div>
						      		<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Total Tax Amt:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo 'P'.$totaltax ?></c>
						      			</div>

						      		</div>

									<div class="row">
						      			<div class="col-md-6 text-left">
						      				<label for="">Date Paid:</label>
						      			</div>
						      			<div class="col-md-6">
						      				<c><?php echo ''.$value->pay_date ?></c>
						      			</div>
						      			
						      		</div>
						      		<!-- <div class="row"> -->
						      			<p><?php echo $disc_msg ?></p>
						      		<!-- </div> -->
						      	</div>
						      	<div class="modal-footer">
						      		<a href="#" class="btn" data-dismiss="modal" id="save" data-target="#tax_details"><span class="glyphicon glyphicon-check"></span>&nbsp;OK</a>
						      	</div>
						      
						    </div>
						  </div>
						</div>
					<?php $ctr++; ?>
					<?php endif; ?>

					
					<?php endforeach ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>


<div id="change_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Change Password</h2>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Old Password</label>
      		<input type="password" class="form-control" name="old_pass" id="old_pass">
      	</div>
      	<div class="modal-body">
      		<label for="">New Password</label>
      		<input type="password" class="form-control" name="new_pass" id="new_pass">
      	</div>
      	<div class="modal-body">
      		<label for="">Confirm Password</label>
      		<input type="password" class="form-control" name="confirm_pass" id="confirm_pass">
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
        	<button type="submit" class="btn btn-success" name="sub" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!--###########################################END REVISION MODAL###########################################-->
<div id="change_email" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Change My E-mail</h2>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Current E-mail address:</label>
      		<input class="form-control" readonly value="<?php echo $email ?>">
      		<label for="">New E-mail address:</label>
      		<input type="email" class="form-control" name="email" id="email">
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
        	<button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!-- tax detail modal -->
<div id="change_contact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Change My Contact</h2>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Current Contact #:</label>
      		<input class="form-control" readonly name="old_contact" value="<?php echo $contact ?>">
      		<label for="">New Contact #:</label>
      		<input type="text" class="form-control" id="contact_num" name="contact" data-mask="___________" placeholder="09123456789" />
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
        	<button type="submit" name="sub2" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>

<?php if(!$this->input->post()): ?>
<script>
$(document).ready(function(){
	var url = window.location.href,
        index = $('#nav ul :first-child [href]'),
        email = $('#email').val(),
        password = $('#new_pass').val(),
        contact = $('#contact_num').val();
    var page = url.substring(url.indexOf('#')+1);
   	//var errors = //<?php //echo validation_errors()?>;
    if(page == 'change_password' && password == '')
   		$('#change_password').modal("show");
    else if(page == 'change_email' && email == '')
   		$('#change_email').modal('show');
   	else if(page == 'change_contact' && contact == '')
   		$('#change_contact').modal('show');
});
</script>
<?php endif  ?>
<script>
	function changepassword() {
		$('#change_password').modal('show');
	}
	function changeemail(){
		$('#change_email').modal('show');
	}

	function changecontact(){
		$('#change_contact').modal('show');
	}
</script>
