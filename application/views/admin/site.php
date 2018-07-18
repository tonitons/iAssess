<script>
$(document).ready(function(){
    var url = window.location.href,
        modal = url.substr(url.lastIndexOf('#'));

    if(modal == '#discount')
        $('#discount').modal('show');
    $('#discount_link').click(function(){
        $('#discount').modal('show');
    });

    $('form[name=update_discount]').submit(function(e){
        
        if (!confirm('Sure?')) e.preventDefault();
    })
});
</script>
<style>
 .modal h4{
  display:block;
  color:#4c565e;
  font-size:20px;
  font-weight:bold;
  padding:0 10px 15px;
  text-align: center;
  border-bottom:2px solid rgb(108, 174, 224);
}
</style>
	<div class="row register-form">
        <div class="col-md-8 col-md-offset-2 services">
        <div class="custom-form">
	        <?php if(!empty($message)): ?>
                <!-- <script>alert('dfksjh')</script> -->
                <?php $this->load->view('template/message', ['message' => $message]) ?>
                    <script>$('#notification').modal("show");</script> 
            <?php endif; ?>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <h2>SITE DETAILS</h2>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Municipality Logo : </label>
                    </div>
                    <div class="col-sm-6">
                        <input type="file" name="logo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Municipality :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input type="text" class="form-control" value="<?php echo $detail->municipality ?>" name="municipality">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Province :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input type="text" class="form-control" value="<?php echo $detail->province ?>" name="province">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Contact # :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input type="text" class="form-control" value="<?php echo $detail->contact ?>" name="contact">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Email :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input type="text" class="form-control" value="<?php echo $detail->email ?>" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Vision : </label>
                    </div>
                    <div class="col-sm-6 input-column">
                    	<textarea name="vision" class="form-control" rows="7"><?php echo $detail->vision ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Mission : </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <textarea class="form-control" name="mission" rows="7"><?php echo $detail->mission ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">About the site :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <textarea class="form-control" name="description" rows="7"><?php echo $detail->description ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">&nbsp;</label>
                    </div>
                <div class="col-sm-6">
                	<button class="btn btn-success form-control" type="submit">Save </button>
                </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- MODAL FOR CHANGING DISCOUNT -->
<div id="discount" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 style="color:white" id="myLoginLabel">CHANGING DISCOUNT PERCENTAGE</h4>
        </div>
        <form action="" method="POST" name="update_discount">
        <div class="modal-body">                
            <label for="">Current Discount Percentage:</label>
            <input type="text" readonly value="<?php echo $discount_percent ?>%" class="form-control">
            <label for="">New Discount Percentage:</label>
            <input type="number" name="discount_amount" class="form-control" required>
        </div>
        <div class="modal-footer">
            <a href="" class="btn exclude" id="close"><span aria-hidden="true">&times;</span>&nbsp;CANCEL</a>
            <button class="btn" id="save" type="submit"><span class="glyphicon glyphicon-check"></span>&nbsp;UPDATE</button>
        </div>
        </form>
      
    </div>
  </div>
</div>