<!-- <p>location map na ini dinhe.. :-)</p> -->
<div class="container">
	<div class="container wow fadeInUp">
		
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

		<img src="<?php echo base_url('assets/img/map1.png') ?>" alt="">		
		




		<section style="float:left">
			<b>Legend:</b><br>
			<a>001 - Bonifacio</a><br>
			<a>002 - McArthur</a><br>
			<a>003 - Quezon</a><br>
			<a>004 - Rizal</a><br>
			<a>005 - Amandangay</a><br>
			<a>006 - Aslum</a><br>
			<a>007 - Balingasag</a><br>
			<a>008 - Belisong</a><br>
			<a>009 - Cambucao</a><br>
			<a>010 - Capahuan</a><br>
			<a>011 - Guingauan</a><br>
			<a>012 - Jabong</a><br>
			<a>013 - Mercaduhay</a><br>
			<a>014 - Mering</a><br>
			<a>015 - Mohon</a><br>
			<a>016 - San Pablo</a>
		</section>
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
      	
      		<label for="">New Password</label>
      		<input type="password" class="form-control" name="new_pass" id="new_pass">
      	
      	
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
      		<input type="email" class="form-control" name="email" id="email" required>
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
        	<button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
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
});
</script>
<?php endif  ?>
<script>
	function change_password() {
		$('#change_password').modal('show');
	}
	function change_email(){
		$('#change_email').modal('show');
	}
</script>
