<div class="container">
	<div class="row register-form">
        <div class="col-md-8 col-md-offset-2 services">
        <div class="custom-form">
		<h1>SEND MESSAGE</h1>
			<?php if(!empty($message)): ?>
		    <?php $this->load->view('template/message', ['message' => $message]) ?>
		    <?php endif; ?>
		    <?php if(!empty(validation_errors())): ?>
		    <?php $this->load->view('template/message', ['message' => $validation]) ?>
		    <?php endif; ?>
			<form action="" method="POST" class="form-horizontal">
				<div>
					<p><span style="color:red">* required fields</span></p>
				</div>
				<div class="form-group">
			        <div class="col-sm-4 label-column">
			            <label class="control-label" for="name-input-field"><span style="color:red">*</span>Name : </label>
			        </div>
			        <div class="col-sm-6 input-column">
			            <input type="text" placeholder="your name" name="visitor_name" value="<?php echo $this->input->post('visitor_name') ?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-sm-4 label-column">
			            <label class="control-label" for="name-input-field"><span style="color:red">*</span>Contact Number : </label>
			        </div>
			        <div class="col-sm-6 input-column">
			            <input type="text" placeholder="your name" name="visitor_name" value="<?php echo $this->input->post('visitor_contact') ?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <div class="col-sm-4 label-column">
			            <label class="control-label" for="name-input-field"><span style="color:red">*</span>Message : </label>
			        </div>
			        <div class="col-sm-6 input-column">
			            <textarea id="" cols="30" rows="10" placeholder="message here..." name="visitor_message"><?php echo $this->input->post('visitor_message') ?></textarea>
			        </div>
			    </div>
				<div class="form-group">
					<input type="submit" value="SEND" class="btn btn-success">
					<input type="reset" value="CLEAR" class="btn btn-warning">
				</div>
			</form>
		</div>
		</div>
	</div>
</div>
