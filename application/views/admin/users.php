<?php 
	$name = new User_model;
 ?>

<div class="container">
	<div class="row register-form">
	    <div class="custom-form">

		<?php if(!empty($message)): ?>
		    <?php $this->load->view('template/message', ['message' => $message]) ?>
		    <script>$('#notification').modal('show');</script>
	    <?php endif; ?>
			<h1>USERS MANAGEMENT</h1>
	
			<a href="#" class="btn btn-default pull-left" data-toggle="modal" data-target="#add_user"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add user</a>

			<div class="bs-example bs-example-tabs">
		    <ul id="myTab" class="nav nav-tabs" role="tablist"> 

		      <li class="active aw"><a href="#active" role="tab" data-toggle="tab"><label for="">OWNERS (USERS)</label></a></li>
		      <!-- <li class="aw"> 	<a href="#deactivated" role="tab" data-toggle="tab"><label for="">DEACTIVATED USERS</label></a></li> -->
		      <li class="aw"> 	<a href="#staff" role="tab" data-toggle="tab"><label for="">STAFF's USERS</label></a></li>
		      <!-- <div class="form-group">
				<label for="" class="col-md-2">Search</label> -->
				<!-- <div class="col-md-4 pull-right">
					<input type="text" class="form-control" onkeyup="searchUser(this.value)" placeholder="Search.. ">
				</div>
			</div> -->
		    </ul>
				    <div id="myTabContent" class="tab-content">
				    <br>
				      <div class="tab-pane active fade in" id="active">
									      
				        <div class="table-responsive">
				        
							<table id="tbl_user" class="table table-bordered" style="background-color:white">
							<thead>
								<tr class="bg-primary">
									<th><label for="">User</label></th>
									<th><label for="">User Type</label></th>
									<th><label for="">Owner Name</label></th>
									<!-- <th><label for="">Manage</label></th>									 -->
								</tr>
							</thead>
							<tbody>

								<?php foreach ($users as $value): ?>
								<?php if (($value->user_name != 'admin') && ($value->active !=0) && $value->user_type == 'owner'): ?>
								<tr>
									<td class="text-lowercase"><?php echo $value->user_name ?></td>
									<td><?php echo $value->user_type ?></td>
									<td class="text-capitalize"><?php echo $name->getFullName($value->user_id, 'owner_id','tbl_owner') ?></td>
									<!-- <td>
										
											<a href="#" data-toggle="modal" data-target="#manage" class="btn btn-danger deactivate">deactivate</a
										
									
									</td> -->
								</tr>
								<?php endif ?>
								<?php endforeach; ?>
							</tbody>
							<?php if (empty($users)): ?>
								<tr colspan="3">
									<td class="alert alert-warning">No result for your entry.</td>
								</tr>
							<?php endif ?>
							</table>
						</div>
				      </div>
      				

      				<div class="tab-pane fade in" id="staff">
				        
				        <div class="table-responsive">
				        
							<table id="tbl_staff" class="table table-bordered" style="background-color:white">
								<tr class="bg-primary">
									<th class="hidden">User id</th>
									<th><label for="">User Name</label></th>
									<th><label for="">User Type</label></th>
									<th><label for="">Staff Name</label></th>
									<th><label for="">Manage</label></th>
								</tr>
							<tbody>

								<?php foreach ($users as $value): ?>
								<?php if (($value->user_type == 'staff') || ($value->user_type == 'treasurer') && $value->active == 1): ?>
								<tr>
									<td class="hidden"><?php echo $value->user_id ?></td>
									<td class="text-lowercase"><?php echo $value->user_name ?></td>
									<td><?php echo $value->user_type ?></td>
									<td class="text-capitalize"><?php echo $name->getFullName($value->user_id, 'staff_id','tbl_staff') ?></td>
									<td>
										
											<a href="#" data-toggle="modal" data-target="#change-role" class="btn btn-success change_role">Change Role</a
										
									
									</td>
								</tr>
								<?php endif ?>
								<?php endforeach; ?>
							</tbody>
							</table>
						</div>
      				</div>
    			</div>
  			</div>
		</div>
	</div>
</div>
<!--########################################### START INCREASE VALUE MODAL ###########################################-->

<div id="manage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Confirm Action</h2>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<p><b>Are you sure to <b id="text_action"></b> this account?</b></p>
      		<input type="hidden" name="action" id="action">
      		<input type="hidden" name="user_name" id="user">
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" data-dismiss="modal" data-target="#manage">No</a>
        	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>  <span>Yes</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!--########################################### START CHANGE ROLE MODAL ###########################################-->

<div id="change-role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Change Role</h2>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<div class="row">
      			<div class="col-md-4">
      				<h5 class="text-right"><label for="">Full Name:</label></h5>
      			</div>
      			<div class="col-md-6">
      				<input type="hidden" name="action" value="change_role">
      				<input type="hidden" name="user_id" id="staff-id">
      				<input type="text" class="form-control" id="full-name" readonly>
      			</div>
      		</div>
      		<div class="row">
	      			<div class="col-md-4">
	      				<h5 class="text-right"><label for="">User Type:</label></h5>
	      			</div>
	      			<div class="col-md-6">
	      				<select name="user_type" id="" class="form-control">
	      					<option selected disabled>--> SELECT <--</option>
	      					<option value="treasurer">Treasurer</option>
	      					<option value="staff">Staff</option>
	      				</select>
	      			</div>
	      	</div>
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" id="close" data-dismiss="modal" data-target="#change-role">Cancel</a>
        	<button type="submit" id="save" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>  <span>Change Role</span></button>
      	</div>
      	</form>
    </div>
  </div>
</div>
<!-- ############################################ add new user ############################################-->
<div id="add_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myLoginLabel">New Staff</h3>
      	</div>
      	<form role="form" action="" method="POST">
      	<div class="modal-body">
      		<div class="row">
      			<div class="col-md-4">
      				<h5 class="text-right"><label for="">First Name:</label></h5>
      			</div>
      			<div class="col-md-6">
      				<input type="hidden" name="action" value="add">
      				<input type="text" name="fname" class="form-control">
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-4">
      				<h5 class="text-right"><label for="">Middle Name:</label></h5>
      			</div>
      			<div class="col-md-6">
      				<input type="text" name="mname" class="form-control">
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-4">
      				<h5 class="text-right"><label for="">Last Name:</label></h5>
      			</div>
      			<div class="col-md-6">
      				<input type="text" name="lname" class="form-control">
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-4">
      				<h5 class="text-right"><label for="">User name:</label></h5>
      			</div>
      			<div class="col-md-6">
      				<input type="text" name="user_name" class="form-control">
      			</div>
      		</div>
	      	<div class="row">
	      			<div class="col-md-4">
	      				<h5 for="" class="text-right"><label>Password:</label></h5>
	      			</div>
	      			<div class="col-md-6">
	      				<input type="password" name="password" class="form-control">
	      			</div>
	      	</div>
	      	<div class="row">
	      			<div class="col-md-4">
	      				<h5 for="" class="text-right"><label>E-mail:</label></h5>
	      			</div>
	      			<div class="col-md-6">
	      				<input type="email" name="email" class="form-control">
	      			</div>
	      	</div>
	      	<div class="row">
	      			<div class="col-md-4">
	      				<h5 for="" class="text-right"><label>Position:</label></h5>
	      			</div>
	      			<div class="col-md-6">
	      				<input type="text" name="position" class="form-control">
	      			</div>
	      	</div>
	      	<div class="row">
	      			<div class="col-md-4">
	      				<h5 class="text-right"><label for="">User Type:</label></h5>
	      			</div>
	      			<div class="col-md-6">
	      				<select name="user_type" id="" class="form-control">
	      					<option value="treasurer">Treasurer</option>
	      					<option value="staff">Staff</option>
	      				</select>
	      			</div>
	      	</div>
    	</div>

      	<div class="modal-footer">
      		<a href="#" class="btn btn-warning" id="close" data-dismiss="modal" data-target="#add_user">Close</a>
        	<button type="submit" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Add</span></button>
      	</div>
      	</form>
    </div>
</div>
</div>
