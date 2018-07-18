<?php $site = new Site_model;?>
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
			<a href="#add_question" data-target="#add_question" id="add_q" data-toggle="modal" class="btn btn-primary pull-left <?php echo $count_qs > 2 ? 'hidden' : '' ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Question</a>
			<br>
			<p class="pull-left">Maximum of 3 questions only.</p>
			<div class="clearfix"></div>
			<div class="table-responsive">
				
				<table id="tbl_questions" class="table">
					<!-- <tr> -->
						<thead>
						<th class="hidden">ID</th>
						<th>QUESTION</th>	
						<th>ANSWER</th>
						<th style="width:10px">Action</th>
						</thead>
					<!-- </tr> -->
					<tbody>
								
						<?php foreach ($my_questions as $q): ?>
							<tr>
								<td class="hidden"><?php echo $q->id ?></td>
								<td><?php echo $q->question; ?></td>
								<td><?php echo $q->answer; ?></td>
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


<div id="add_question" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel">SECURITY QUESTION</h4>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Question:</label>
      		<input type="hidden" name="action" value="add">
      		<select name="q_id" id="" class="form-control" required>
      		<option selected disabled></option>
      		<?php foreach ($questions as $qs): ?>
				<?php $exist = $site->questionExist($this->session->user_id, $qs->q_id); ?>
      			<?php if ($qs->user_id != $this->session->user_id && !$exist): ?>
      				<option value="<?php echo $qs->q_id ?>"><?php echo $qs->question ?></option>	
      			<?php endif ?>
      		<?php endforeach ?>
      		</select>
      		<label for="">Answer:</label>
      		<input type="text" class="form-control" name="answer" required>
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#add_question">Cancel</a>
        	<button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-plus"></span>  <span>Save</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div> 

<div id="update_question" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel">UPDATE MY SECURITY QUESTION</h4>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<label for="">Question:</label>
      		<input type="hidden" name="action" value="update">
      		<input type="hidden" name="q_id" id="q_id">
      		<input type="text" readonly class="form-control" id="u_question">
      		<label for="">Answer:</label>
      		<input type="text" class="form-control" name="answer_update" required id="answer_update">
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#add_question">Cancel</a>
        	<button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-plus"></span>  <span>Save</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div> 