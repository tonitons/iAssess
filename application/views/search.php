<div class="container">
    <div class="row register-form">
    <a href="<?php echo base_url('home#services') ?>">BACK</a>
        <div class="custom-form">

            <?php if(!empty($message)): ?>
                <?php $this->load->view('template/message', ['message' => $message]) ?>
                <script>$('#notification').modal('show');</script>
            <?php endif; ?>
            <?php if(!empty(validation_errors())): ?>
                <?php $this->load->view('template/message', ['message' => $validation]) ?>
                <script>$('#notification').modal('show');</script>
            <?php endif; ?>

        <h2>SEARCH RESULT </h2>
        <br>
        <p style="font-size:18px;position:block" class="text-left">You search for: <b style="text-decoration:underline"><?php echo $this->input->get('searchQuery') ?></b></p>
        <div class="table-responsive">
            
            <table class="table table-bordered" id="search_results">
                <thead>
                    <tr>
                        <th><label>PIN</label></th>
                        <th><label>Lot No.</label></th>
                        <th><label>Owner Name</label></th>
                        <th><label>Property Location</label></th>
                        <th><label>Classification</label></th>
                        <th><label>Options</label></th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php if(!empty($property_data)): ?>
                
                        <?php foreach ($property_data as $key ): ?>
                            <tr>
                                <td><?php echo anchor('home/view/'.$key->pin, $key->pin); ?></td>
                                <td><?php echo $key->cadastral_lot_no ?></td>
                                <td><?php echo $key->name ?></td>
                                <td><?php echo $key->barangay_name ?></td>
                                <td><?php echo $key->classification ?></td>
                                <td><a class="btn btn-primary message" href="#" data-toggle="modal" data-target="#message_modal"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Message</a></td>
                            </tr>    
                        <?php endforeach ?>
                    <?php endif; ?>
                    <?php if (empty($property_data)): ?>
                        <tr>
                            <td colspan="6">
                             <div class="alert alert-warning" style="text-align: center">
                                 <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No result found for your query...
                              </div>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
                        
            </table>
        </div>
    <!-- </form> -->
    </div>
    </div>
</div>
<!-- ############################################# MESSAGGE MODAL ################################################### -->
<div id="message_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Create Message</label></h4>
        </div>
        <form action="" method="POST" class="form-horizontal">
        <div class="modal-body">
            
                <div>
                    <p class="col-md-push-2"><span style="color:red">* required fields</span></p>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column text-right">
                        <label class="control-label" for="name-input-field">Recepient : </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" placeholder="your name" id="recepient" readonly>
                    </div>
                </div>
                <input type="hidden" name="pin" id="pin">
                <div class="form-group">
                    <div class="col-sm-4 label-column text-right">
                        <label class="control-label" for="name-input-field"><span style="color:red">*</span>Name : </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" placeholder="your name" name="visitor_name" value="<?php echo $this->input->post('visitor_name') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column text-right">
                        <label class="control-label" for="name-input-field"><span style="color:red">*</span>Contact Number : </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" placeholder="your contact number" name="visitor_contact" value="<?php echo $this->input->post('visitor_contact') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column text-right">
                        <label class="control-label" for="name-input-field"><span style="color:red">*</span>Message: <br> (Min. of 15 caracters) </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <textarea  class="form-control" cols="30" rows="10" placeholder="message here..." name="visitor_message"><?php echo $this->input->post('visitor_message') ?></textarea>
                    </div>
                </div>
                
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" id="close" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success btn-modal"><span>SEND</span></button>
        </div>
        </form>
    </div>
  </div>
</div>
<!--###########################################END MESSAGE MODAL###########################################-->
