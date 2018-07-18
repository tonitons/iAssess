	
<table class="table table-bordered" style="background-color:white">
	<tr class="bg-primary">
		<th><label for="">User</label></th>
		<th><label for="">User Type</label></th>
		<th><label for="">Owner Name</label></th>
		<!-- <th><label for="">Manage</label></th>									 -->
	</tr>
	<tbody>

	<?php foreach ($users as $value): ?>
	<?php if (($value->user_name != 'admin') && ($value->active !=0) && $value->user_type == 'owner'): ?>
	<tr>
		<td class="text-lowercase"><?php echo $value->user_name ?></td>
		<td><?php echo $value->user_type ?></td>
		<td class="text-capitalize"><?php echo $value->name ?></td>
		<!-- <td>
			
				<a href="#" data-toggle="modal" data-target="#manage" class="btn btn-danger deactivate">deactivate</a
			
		
		</td> -->
	</tr>
	<?php endif ?>
	<?php endforeach; ?>
	<?php if (empty($users)): ?>
    	<tr>
            <td colspan="3">
             <div class="alert alert-warning" style="text-align: center">
                 <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No result found for your query...
              </div>
            </td>
        </tr>
    <?php endif ?>
	</tbody>
</table>