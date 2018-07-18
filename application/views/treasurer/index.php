
    <div class="row register-form">
        <div class="col-md-8 col-md-offset-2 services">
            
            <form class="form-horizontal custom-form" method="POST" action="">
                <?php if(!empty($message)): ?>
                <?php $this->load->view('template/message', ['message' => $message]) ?>
                    <script>$('#notification').modal('show');</script>
                <?php endif; ?>
                <a href="#searchOwner" id="search_btn" class="btn btn-primary pull-left btn-lg">SEARCH OWNER</a>
                <div class="clearfix"></div><br>
                <div class="row">
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">Date:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control datepicker" placeholder="yyyy-mm-dd" name="date_pay" id="datetoday" value="<?php echo date('Y-m-d');//'2017-12-20';// ?>">
                    </div>
                <!-- </div> -->
                <!-- <div class="form-group"> -->
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">PIN:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" name="pin" type="text" id="pin">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">Owner Name:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" id="owner_name">
                    </div>
                <!-- </div> -->
                <!-- <div class="form-group"> -->
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">Location:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" id="location">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">Type of Property:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" id="propertytype">
                    </div>
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">T.D. No.:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" id="tax_dec">
                    </div>
                </div>
                <hr>
                <div id="tax-yearly">
                    <h1>AMOUNT DUE</h1>
                    
                    <!-- <hr> -->
                  <!--   <div class="form-group">
                        <div class="input-group input-group-lg">
                          <span class="input-group-addon">P</span>
                          <input type="text" class="form-control" name="amount_due" placeholder="Tax Payable" id="amount_due" style="font-size:30px; height: auto; text-align: right ">
                        </div> 
                    </div>   
                    <div class="form-group">
                        <div class="">
                            <label class="control-label" for="name-input-field">payment type:</label>
                        <! </div>
                        <div class="col-sm-8 input-column"> 
                            <span id="show-loader"></span>
                            <input class="form-control" type="radio" name="payment_type" id="yearly" value="yearly"> Yearly
                            <input class="form-control" type="radio" name="payment_type" id="quarterly" value="quarterly"> Quarterly
                        </div>
                    </div>   -->
               </div>
            </form>
        </div>
    </div>

    <!-- search owner modal -->
    <div id="search_owner" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Search Owner <span id="load"></span></label></h4>
        </div>
        <!-- <form role="form" action="" method="POST"> -->
        <div class="modal-body">
        <input type="text" placeholder="Enter name " class="form-control" onkeyup="searchOwner(this.value)" id="input-search">
            <div class="table-responsive">
                <table id="owner_results" class="table">
                    <tr>
                        <th class="hidden">ID</th>
                        <th>FName</th>
                        <th>MName</th>
                        <th>LName</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <!-- <th>Administrator</th>
                        <th>Add</th>
                        <th>tel no.</th>
                        <th>Action</th> -->
                    </tr>
                <tbody>
                    <tr>
                        <td colspan="7">Results here.</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-check"></span>&nbsp;<span>OK</span></button>
        <!-- <button type="submit" id="delete-btn" class="btn btn-danger btn-modal"><span>Delete</span></button> -->
        </div>
        <!-- </form> -->
    </div>
  </div>
</div>