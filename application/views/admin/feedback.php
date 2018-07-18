<div class="container">
	<div class="row register-form">
        <!-- <div class="col-md-12 services"> -->
	        <div class="custom-form">
	        <?php if(!empty($message)): ?>
		    <?php $this->load->view('template/message', ['message' => $message]) ?>
		    	<script>$('#notification').modal('show');</script>
		    <?php endif; ?>
			<h1>FEEDBACK / COMMENTS</h1>
			<p class="text-left">Number of Feedback(s): <?php echo $feedback_cnt->count ?></p>
			<div class="table-responsive">
				<table id="tbl_inbox" class="table table-responsive">
					<!-- <tr> -->
						<thead>
						<th class="hidden">ID</th>
						<th>FROM</th>	
						<th>CONTACT</th>
						<th>SUBJECT</th>
						<th>FEEDBACK</th>
						<th>DATE</th>
						<th>Action</th>
						<th class="hidden">O_ID</th>
						</thead>
					<!-- </tr> -->
					<tbody>
								
						<?php foreach ($feedbacks as $fb): ?>
							<?php if($fb->status == 0){$color = 'bg-danger';}else{$color='bg-default';}?>
							<tr class="<?php echo $color ?>">
								<td class="hidden"><?php echo $fb->fb_id ?></td>
								<td class="text-capitalize text-left"><?php echo $fb->name; ?></td>
								<td><?php echo $fb->contact ?></td>
								<td><?php echo $fb->subject ?></td>
								<td><?php echo substr($fb->f_c, 0, 20) ?>..</td>
								<td><?php echo $fb->fb_date ?></td>
								<td>
									<a href="#" class="btn btn-primary btn-sm view" class="<?php echo $fb->owner_id ?>"> View</a>
									<!-- <a href="#" class="btn btn-danger btn-sm delete"> Delete</a> -->
								</td>
								<td class="hidden"><?php echo $fb->owner_id ?></td>
							</tr>
						<?php endforeach; ?>						

					</tbody>
				</table>
				<!-- </div> -->
			</div>
		</div>
	</div>
</div>
<!-- ################################## MODAL FOR VIEWING FEEDBACK #################################### -->
<div class="modal fade col-md-offset-3 col-md-6" id="view_inbox" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">View Feedback</label></h4>
      </div>
      <div class="modal-body">
		    
			<div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">FROM: </h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="from" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">CONTACT:</h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="contact_num" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">SUBJECT:</h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" id="subject" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">FEEDBACK/COMMENT: </h5>
                </div>
		        <div class="col-md-6">
					<textarea id="message" class="form-control" rows="6"></textarea>
		        </div>
		    </div>


      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Close</button>
      	<a href="#" data-toggle="modal" data-target="reply-modal" id="save" class="btn btn-primary reply">Reply</a>
      	
      </div>
  </div>
</div>
</div>     

<!--######################################## END modal for viewing feedback #######################################-->

<!-- ################################## MODAL FOR reply FEEDBACK #################################### -->
<div class="modal fade col-md-offset-3 col-md-6" id="reply-modal" tabindex="-1" role="dialog" aria-labelledby="myMVLand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Reply Feedback</label></h4>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
		    
			<div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">TO: </h5>
                </div>
		        <div class="col-md-6">
		        	<input type="hidden" id="owner_id" name="owner_id">
					<input type="text" class="form-control" id="owner_name" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">SUBJECT:</h5>
                </div>
		        <div class="col-md-6">
					<input type="text" class="form-control" value="reply" id="subject" readonly>
		        </div>
		    </div>
		    <div class="row">
				<div class="col-md-4">
                    <h5 class="text-right">MESSAGE: </h5>
                </div>
		        <div class="col-md-6">
					<textarea id="message" name="fb_reply" class="form-control" rows="6"></textarea>
		        </div>
		    </div>
      </div>
      <div class="modal-footer">
      	<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Close</button>
      	<button type="submit" id="save" class="btn btn-primary">Send</button>
      	
      </div>
      </form>
  </div>
</div>
</div>     

<!--######################################## END modal for viewing feedback #######################################-->


<!--########################################### START delete feedback modal ###########################################-->

<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Delete Confirm</label></h4>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Are you sure you want this feedback to be deleted??</label>
      		<input type="hidden" id="fb_id" name="fb_id">
      	</div>
      	<div class="modal-footer">
      		<button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
		<button type="submit" id="delete-btn" class="btn btn-danger btn-modal"><span>Delete</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!--###########################################END delete feedback modal###########################################-->