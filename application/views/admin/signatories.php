<div class="container">
	<div class="row register-form">
		<div class="custom-form">
		<?php if(!empty($message)): ?>
	    <?php $this->load->view('template/message', ['message' => $message]) ?>
	    	<script>$('#notification').modal('show');</script>
	    <?php endif; ?>
			<h2>Reports Signatories</h2>
			<a href="#add_signatory" data-target="#add_signatory" id="add_sign" data-toggle="modal" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Signatory</a>
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl_signatories" style="background-color:white">
					<thead>
					<tr class="bg-primary">
						<th class="hidden">ID</th>
						<th>Staff Name</th>
						<th>Position</th>
						<th>Signatory Report</th>
						<th>Action</th>						
					</tr>
					</thead>
					<tbody>
					<?php $ctr = 1; ?>
					<?php foreach ($signatories as $sign): ?>
						<tr>
							<td class="hidden"><?php echo $sign->id ?></td>
							<td class="text-capitalize" style="width: 25%"><?php echo $sign->fname.' '.substr($sign->mname, 0, 1).'. '.$sign->lname ?></td>
							<td class="text-capitalize"><?php echo $sign->position ?></td>
							<td class="text-capitalize"><?php echo $sign->report_name ?></td>
							<td><button class="btn btn-primary btn-sm <?php echo 'update'.$ctr ?>">Update</button> </td>						
						</tr>
					<?php $ctr++; ?>
					<?php endforeach ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="add_signatory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Add Signatory</h2>
        </div>
        <form role="form" action="" method="POST">
        <div class="modal-body">
          <label for="">Report Name:</label><span class="load"></span>
          <select name="report_name" id="report_name" class="form-control">
          	<option selected disabled></option>
          	<option value="quarterly report">Quarterly Report</option>
          	<option value="tax reports">Tax Reports</option>
          </select>
          <label for="">New E-mail address:</label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
          <button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Save</span></button>
        </div>
        </form>
    </div>
  </div>
</div>

<div id="update_signatory1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Update Signatory</h2>
        </div>
        <form role="form" action="" method="POST">
        <div class="modal-body">
        <h3>Tax Reports</h3>
          <label for="">Signatory Report:</label><span class="load"></span>
          <input type="hidden" name="sign_id" id="sign_id">
          <input type="text" readonly id="signatory_report" class="form-control">
          <label for="">Staff Name:</label><span class="load"></span>
          <select name="staff_id" id="staff_id" class="form-control" required>
          	<option selected disabled></option>
          		<?php foreach ($treasurer as $t): ?>
          			<option value="<?php echo $t->staff_id ?>"><span class="text-capitalize"><?php echo $t->fname.' '.substr($t->mname, 0, 1).'. '.$t->lname ?></span></option>
          		<?php endforeach ?>
          </select>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
          <button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
        </div>
        </form>
    </div>
  </div>
</div>

<div id="update_signatory2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Update Signatory</h2>
        </div>
        <form role="form" action="" method="POST">
        <div class="modal-body">
        <h3>Quarterly Report</h3>
          <label for="">Signatory Report:</label><span class="load"></span>
          <input type="hidden" name="sign_id2" id="sign_id2">
          <input type="text" readonly id="signatory_report2" class="form-control">
          <label for="">Staff Name:</label><span class="load"></span>
          <select name="staff_id2" id="staff_id" class="form-control" required>
          	<option selected disabled></option>
          		<?php foreach ($assessor as $ass): ?>
          			<option value="<?php echo $ass->staff_id ?>"><span class="text-capitalize"><?php echo $ass->fname.' '.substr($ass->mname, 0, 1).'. '.$ass->lname ?></span></option>
          		<?php endforeach ?>
          </select>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">Cancel</a>
          <button type="submit" name="sub1" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Update</span></button>
        </div>
        </form>
    </div>
  </div>
</div>
	
