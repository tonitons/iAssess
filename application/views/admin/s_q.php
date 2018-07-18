<div class="container">
	<div class="row register-form">
        <!-- <div class="col-md-12 services"> -->
	        <div class="custom-form">
	        <?php if(!empty($message)): ?>
		    <?php $this->load->view('template/message', ['message' => $message]) ?>
		    	<script>$('#notification').modal('show');</script>
		    <?php endif; ?>
		   <!--  </?php if(!empty(validation_errors())): ?>
		    	</?php $this->load->view('template/message', ['message' => $validation]) ?>
		    		<script>$('#notification').modal("show");</script> 
		    </?php endif; ?> -->
			<h1>Security Questions</h1>
			<!-- <div class="row"></div> -->
			<a href="#add_question" data-target="#add_question" id="add_q" data-toggle="modal" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Question</a>
			<div class="table-responsive">

				<table id="tbl_questions" class="table">
					<!-- <tr> -->
						<thead>
						<th class="hidden">ID</th>
						<th>QUESTION</th>	
						<th style="width:10px">Action</th>
						</thead>
					<!-- </tr> -->
					<tbody>
								
						<?php foreach ($questions as $q): ?>
							<tr>
								<td class="hidden"><?php echo $q->q_id ?></td>
								<td><?php echo $q->question; ?></td>
								<td style="width:10px">
									<a href="#" class="btn btn-primary btn-sm update"> Update</a>
									<!-- <a href="#" class="btn btn-danger btn-sm delete"> Delete</a> -->
								</td>
							</tr>
						<?php endforeach; ?>						

					</tbody>
				</table>
				<!-- </div> -->
			</div>
		</div>
	</div>
</div>
<!-- ################################## MODAL FOR adding question #################################### -->
<div id="add_question" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel">SECURITY QUESTION</h4>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">New Question:</label>
      		
      		<input type="text" class="form-control" name="question" value="<?php echo $this->input->post('question') ?>" required>
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#add_question">Cancel</a>
        	<button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-plus"></span>  <span>Save</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div> 

<!--######################################## END ADD question #######################################-->
<div id="update_question" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel">UPDATE SECURITY QUESTION</h4>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Question:</label>
      		<input type="hidden" id="q_id" name="q_id">
      		<input type="text" class="form-control" name="update_question" id="u_question" required>
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#add_question">Cancel</a>
        	<button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div> 