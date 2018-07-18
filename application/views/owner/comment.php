<div class="container">
	<div class="row register-form">
			<?php if(!empty($message)): ?>
				<!-- <script>alert('dfksjh')</script> -->
		    	<?php $this->load->view('template/message', ['message' => $message]) ?>
		    		<script>$('#notification').modal("show");</script> 
		    <?php endif; ?>
		    <?php if(!empty(validation_errors())): ?>
		    	<!-- -->
		    	<!-- <script>alert('dfg')</script> -->
		    	<?php $this->load->view('template/message', ['message' => $validation]) ?>
		    		<script>$('#notification').modal("show");</script> 
		    <?php endif; ?>
        <div class="col-md-8 col-md-offset-2 services">
        <div class="custom-form">
		<h1>SUBMIT FEEDBACK or COMMENT</h1>
			
			<form action="" method="POST" class="form-horizontal">
				
				<div class="form-group">
			        <div class="col-sm-4 label-column">
			            <label class="control-label" for="name-input-field"><span style="color:red">*</span>SUBJECT : </label>
			        </div>
			        <div class="col-sm-6 input-column">
			            <input type="text" placeholder="subject" name="subject">
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-sm-4 label-column">
			            <label class="control-label" for="name-input-field"><span style="color:red">*</span>FEEDBACK : </label>
			        </div>
			        <div class="col-sm-6 input-column">
			            <textarea style="font-family: segoe;font-size: large;" id="" cols="30" rows="10" placeholder="feedback here..." name="feedback"></textarea>
			        </div>
			    </div>
				<div class="form-group">
					<input type="reset" value="CLEAR" class="btn btn-warning">
					<input type="submit" value="SEND" class="btn btn-success">
					
				</div>
			</form>
		</div>
		</div>
	</div>
</div>