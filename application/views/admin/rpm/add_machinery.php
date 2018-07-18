<div class="row register-form">
    <!-- ############# NOTIFICATION AREA ########## -->
    <div class="custom-form">
    <!-- <a href="</?php echo base_url('admin/real_property_mgt/land_property') ?> " class="pull-left">BACK</a> -->
    <?php if(!empty($message)): ?>
        <?php $this->load->view('template/message', ['message' => $message]) ?>
        <script>$('#notification').modal('show');</script>
    <?php endif; ?>
    <?php if(!empty(validation_errors())): ?>
        <?php $this->load->view('template/message', ['message' => $validation]) ?>
        <script>$('#notification').modal('show');</script>
    <?php endif; ?>
    </div>
    <!-- ############# NOTIFICATION AREA ########## -->
        <div class="col-md-12 services custom-form">
            <form class="form-horizontal " method="POST" action="">
                <h1>MACHINERY APPRAISAL &amp; ASSESSMENT &nbsp; </h1>
                <div class="form-group">
                    <!-- <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">ARP No.: </label>
                    </div>
                    <div class="col-sm-3 input-column">
                        <input class="form-control" type="text">
                    </div> -->
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">PIN: </label>
                    </div>
                    <div class="col-sm-3 input-column">
                       <input class="form-control input-lg" data-mask="___-__-___-__-___" value="<?php echo set_value('pin') ?>"  name="pin" id="pin" placeholder="___-__-___-__-___">
                    </div>

                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">DATE: </label>
                    </div>
                    <div class="col-sm-3 input-column">
                        <input placeholder="yyyy-mm-dd" class="form-control input-lg datepicker" name="date_appraised"  value="<?php echo date('Y-m-d') ?>" style="line-height: 20px;">
                        <!-- <input class="form-control" type="text" name="pin"> -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-md-push-5 input-column">
                        <label><input type="radio" value="old" name="owner_on" id="old_owner"> Existing Owner</label>
                        <label><input type="radio" value="new" name="owner_on" id="new_owner"> New Owner</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">First Name: </label>
                    </div>
                        <div class="col-sm-4 input-column">
                        <input type="hidden" name="owner_id" id="owner_id">
                        <input class="form-control" type="text" name="fname" id="fname" disabled value="<?php echo set_value('fname') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Middle Name: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="mname" id="mname" disabled="" value="<?php echo set_value('mname') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Last Name: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="lname" id="lname" disabled="" value="<?php echo set_value('lname') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">E-mail:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="email" name="email" id="email" disabled="" value="<?php echo set_value('email') ?>" placeholder="Your e-address (not required)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="address" id="address" disabled="" value="<?php echo set_value('address') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Tel No:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="contact" id="contact-num" disabled="" value="<?php echo set_value('contact') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field"> Administrator/ Beneficial User :</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="beneficial" id="beneficial" disabled="" value="<?php echo set_value('beneficial') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="ben_add" id="ben_add" disabled="" value="<?php echo set_value('ben_add') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Tel No:</label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="ben_tel" id="ben_tel" disabled="" value="<?php echo set_value('ben_tel') ?>">
                    </div>
                </div>
                <h1>PROPERTY LOCATION</h1>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <select name="brgy_id" id="" class="form-control">
                            <option selected disabled>&nbsp;</option>
                            <?php foreach ($brgys as $key => $row): ?>
                                <option value="<?php echo $row->brgy_id ?>"><?php echo $row->barangay_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            <!-- </form> -->
        <!-- </div> -->
        
        <!-- <div class="col-md-12 services custom-form"> -->
            <!-- <form class="form-horizontal custom-form"> -->
                <h1>PROPERTY APPRAISAL </h1>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Type of Machinery: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="text" name="property_type" class="input form-control input-lg" placeholder="Ex. Rice Mill"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Classification: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <select name="classification" id="classification" class="form-control input-lg">
                            <option selected disabled>&nbsp;</option>
                            <option value="agricultural">Agricultural</option>
                            <option value="residential">Residential</option>
                            <option value="industrial">Industrial</option>
                            <option value="commercial">Commercial</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Original/Acquisition Cost: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="number" step="any" id="original_cost" name="original_cost" class="input form-control input-lg"> 
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Economic Life/Life Expectancy (years): </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="text" name="economic_life" id="economic_life" class="input form-control input-lg" onkeyup="MachineryMV()"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Used Life (years): </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="text" name="used_life" id="used_life" class="input form-control input-lg" onkeyup="MachineryMV()"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Replacement Cost New (Market Value): </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="text" name="appraised_value" class="input form-control input-lg" id="machine-mv"> 
                    </div>
                </div>
                
                
                <h1>PROPERTY ASSESSMENT </h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Actual Use&nbsp; </th>
                                <th>Market Value&nbsp; </th>
                                <th>Assessment Level </th>
                                <th>Assessed Value&nbsp; </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="actual_use"></td>
                                <td>P <b id="true_market_value"></b></td>
                                <td><i id="assessment_level"></i><input type="hidden" name="assess_level" id="assess_level"></td>
                                <td>P <b id="assessed_value"></b></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            <tr class="active">
                                <td>Total </td>
                                <td>P <b id="total_market_value"></b></td>
                                <td>Total </td>
                                <td>P <b id="total_assessed_value"></b><input type="hidden" id="assessed_value_h" name="assessed_value"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-1">
                    <p class="btn btn-lg radio-btn"><input type="radio" name="taxable"  value="Taxable" id="Taxable" style="height: auto"><label class="control-label taxable" for="Taxable">Taxable </label></p>
                </div>
                <div class="col-sm-2">
                    <p class="btn btn-lg radio-btn"><input type="radio" name="taxable" value="Exempt" id="Exempt" style="height: auto"> <label class="control-label taxable" for="Exempt">Exempt </label></p>
                </div>
                <div class="clearfix"></div>
                <!--<div class="col-md-6 label-column">
                    <label for="name-input-field" class="taxable">Effectivity of Assessment/Reassessment: </label>
                </div>
                 
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Qtr. </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Yr </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text">
                    </div>
                </div> -->

                <a href="<?php echo base_url('admin/real_property_mgt/machinery') ?>" class="btn btn-default btn-lg submit" type="button">Cancel </a>                          
            <button class="btn btn-default btn-lg submit" type="submit">Sumbit </button>
            </form> <!-- END of FORM -->
        </div>
    </div>


<!-- MODAL HERE!!!!! -->
<div id="search_owner" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel"><label for="">Search Owner</label></h4>
        </div>
        <!-- <form role="form" action="" method="POST"> -->
        <div class="modal-body">
        <input type="text" placeholder="Enter name " class="form-control" autofocus onkeyup="searchOwner(this.value)">
            <div class="table-responsive">
                <table id="owner_results" class="table">
                    <tr>
                        <th class="hidden">ID</th>
                        <th>FName</th>
                        <th>MName</th>
                        <th>LName</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Administrator</th>
                        <th>Add</th>
                        <th>tel no.</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    <tr>
                        <td colspan="4">Results here.</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" type="button" data-dismiss="modal">OK</button>
        <!-- <button type="submit" id="delete-btn" class="btn btn-danger btn-modal"><span>Delete</span></button> -->
        </div>
        <!-- </form> -->
    </div>
  </div>
</div>