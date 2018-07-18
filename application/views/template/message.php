<!-- <div class="alert fade in alert-</?php echo $message['status'] ?>">
     <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4>Notifications</h4>
      </?php echo $message['message'] ?>
 </div> -->
<!--########################################### START notification modal ###########################################-->

<div id="notification" class="modal fade notification" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><label for="" class="text-<?php echo $message['status'] ?>">System Notification</label></h4>
      	</div>
      	<div class="modal-body alert-<?php echo $message['status'] ?>">
      	
			<?php echo '<label>'.$message['message'].'</label>' ?>
      		
      	</div>
      	<div class="modal-footer">
      		<button class="btn btn-default" type="button" id="close" data-dismiss="modal">OK</button>
      	</div>
    </div>
  </div>
</div>
<!--###########################################END notification modal###########################################-->