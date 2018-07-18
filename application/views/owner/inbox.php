<div class="container">
	<div class="row register-form">
			<?php if(!empty($message)): ?>
		    <?php $this->load->view('template/message', ['message' => $message]) ?>
		    <script>$('#notification').modal("show")</script>
		    <?php endif; ?>
		    <?php //if(!empty(validation_errors())): ?>
		    	<!-- -->
		    	<!-- <script>alert('dfg')</script> -->
		    	<?php //$this->load->view('template/message', ['message' => $validation]) ?>
		    		<!-- <script>$('#notification').modal("show");</script>  -->
		    <?php //endif; ?>
        <div class="col-md-10 col-md-offset-1 services">
	        <div class="custom-form">

			<h1>MY INBOX</h1>
			<p class="text-left">Message count: <?php echo $message_cnt->count ?></p>
			<div class="table-responsive">
				<table class="table" id="table_inbox">
					<tr>
						<thead>
						<th class="hidden">ID</th>
						<th class="hidden">PIN</th>	
						<th class="hidden">LOCATION</th>
						<th class="hidden">CLASSIFICATION</th>
						<th>FROM</th>
						<th>Contact</th>
						<th>Message</th>
						<th>Date Received</th>
						<th>Action</th>
						</thead>
					</tr>
					<tbody>
					<?php if (!empty($inbox)): ?>
						<?php foreach ($inbox as $message): ?>
							<?php if($message->status == 0){$color = 'bg-danger';}else{$color='';}?>
							<tr class="<?php echo $color ?>">
								<td class="hidden"><?php echo $message->message_id ?></td>
								<td class="hidden"><?php echo $message->pin; ?></td>
								<td class="hidden"><?php echo $message->barangay_name ?></td>
								<td class="hidden"><?php echo $message->classification ?></td>
								<td><?php echo $message->visitor_name ?></td>
								<td><?php echo $message->visitor_contact ?></td>
								<td><?php echo substr($message->visitor_message, 0, 30) ?>..</td>
								<td><?php echo $message->date_received ?></td>
								<td>
									<a href="#" id="view-<?php echo $message->message_id?>" class="btn btn-primary btn-sm view"> View</a>
									<a href="#" class="btn btn-danger btn-sm delete"> Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif ?>
						<?php if (empty($inbox)): ?>
							<tr>
	                            <td colspan="6">
	                             <div class="alert alert-warning" style="text-align: center">
	                                 <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No result found for your query...
	                              </div>
	                            </td>
	                        </tr>	
						<?php endif ?>
						
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ################################## MODAL FOR VIEWING INBOX #################################### -->
<div class="modal fade col-md-offset-3 col-md-6" id="view_inbox" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">View Inbox</label></h4>
      </div>
      <div class="modal-body">
      		<div class="row">
				<div class="col-md-4">
                    <h5 class=""><label>PROPERTY LOCATION :</label> </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="location" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class=" modal-inbox"><label>TYPE :</label> </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="type" readonly>
		        </div>
		    </div>
		    
			<div class="row">
				<div class="col-md-4">
                    <h5 class=" modal-inbox"><label>FROM :</label> </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="from" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class=" modal-inbox"><label>CONTACT :</label></h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="contact_num" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">

                    <h5 class=" modal-inbox"><label>MESSAGE :</label> </h5>
                </div>
                <i id="load-message">&nbsp;</i>
		        <div class="col-md-6">
					<textarea id="message" class="form-control" rows="6" id="message"></textarea>
		        </div>
		    </div>


      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>     

<!--######################################## END EDIT MARKET VALUE LAND MODAL #######################################-->

<!--########################################### START INCREASE VALUE MODAL ###########################################-->

<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Delete Confirm</label></h4>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Are you sure you want to delete this message??</label>
      		<input type="hidden" id="message_id" name="message_id">
      	</div>
      	<div class="modal-footer">
      		<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
		<button type="submit" id="delete-btn" class="btn btn-danger btn-modal"><span>Delete</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!--###########################################END INCREASE VALUE MODAL###########################################-->