<div class="container">
	<div class="row register-form">
		<div class="custom-form">
		<?php if(!empty($message)): ?>
	    <?php $this->load->view('template/message', ['message' => $message]) ?>
	    	<script>$('#notification').modal('show');</script>
	    <?php endif; ?>
			<h2>Kinds Management</h2>
			<a href="#add_signatory" data-target="#add_signatory" id="add_sign" data-toggle="modal" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add New Kind</a>
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl_kinds" style="background-color:white">
					<thead>
					<tr class="bg-primary">
						<th class="hidden">ID</th>
						<th>Table Name</th>
						<th>Description</th>
						<th style="width: 50px">No. of Classes</th>
						<th style="width: 100px">Action</th>						
					</tr>
					</thead>
					<tbody>
            <tr>
              <td class="text-capitalize" style="width: 25%">Land</td>
              <td>Schedule of Unit Market Value for Land</td>
              <td>5</td>
              <td><span class="btn btn-default disabled">default</span></td>
            </tr>
            <tr>
              <td class="text-capitalize" style="width: 25%">Agricultural Land</td>
              <td>Schedule of Base Unit Market Value for Agricultural Lands</td>
              <td>3</td>
              <td><span class="btn btn-default disabled">default</span></td>
            </tr>
            <tr>
              <td class="text-capitalize" style="width: 25%">Plantation</td>
              <td>Improvements: Plants and Trees (Productive and Fruit Bearing) COMMERCIAL/PLANTATION</td>
              <td>N/A</td>
              <td><span class="btn btn-default disabled">default</span></td>
            </tr>
            <tr>
              <td class="text-capitalize" style="width: 25%">Building</td>
              <td>Schedule of Building Unit Value per Square Meter</td>
              <td>N/A</td>
              <td><span class="btn btn-default disabled">default</span></td>
            </tr>
					<?php $ctr = 1; ?>
					<?php foreach ($kinds as $kind): ?>
						<tr>
							<td class="hidden"><?php echo $kind->kind_id ?></td>
							<td class="text-capitalize text-left" style="width: 25%"><?php echo $kind->table_name ?></td>
							<td class="text-capitalize"><?php echo $kind->description ?></td>
							<td class="text-capitalize"><?php echo $kind->no_of_classes ?></td>
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
        <h2 class="modal-title" id="myLoginLabel">Add New Kind</h2>
        </div>
        <form role="form" action="" method="POST">
        <div class="modal-body">
          <label for="">Table Name: </label><span class="load"></span>
          <input type="text" name="table_name" class="form-control" required>
          <label for="">Description:</label>
          <input type="text" class="form-control" name="description">
          <label>No. Of Classes:</label>
          <input type="number" name="no_of_classes" class="form-control" required>
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
        <h2 class="modal-title" id="myLoginLabel">Update Kind</h2>
        </div>
        <form role="form" action="" method="POST">
        <div class="modal-body">
          <input type="hidden" name="kind_id" id="kind_id">
          <label for="">Table Name: </label><span class="load"></span>
          <input type="text" name="table_name" id="table_name" class="form-control" required>
          <label for="">Description:</label>
          <input type="text" class="form-control" id="description" name="description">
          <label>No. Of Classes:</label>
          <input type="text" name="no_of_classes" id="no_of_classes" class="form-control" required>
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
	
