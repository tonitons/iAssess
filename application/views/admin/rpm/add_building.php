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
                <h1>REAL PROPERTY FIELD APPRAISAL &amp; ASSESSMENT &nbsp; </h1>
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
                <h1>BUILDING LOCATION</h1>
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
                        <label class="control-label" for="name-input-field">Building Type: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <select id="select_build_type" class="form-control">
                            <option selected disabled>&nbsp;</option>
                            <?php foreach ($building_types as $key => $type): ?>
                                <option id="<?php echo $type->building_type ?>" value="<?php echo $type->sbuv_id ?>"><?php echo $type->building_type.'&nbsp;&nbsp;|&nbsp;'.$type->name_building ?></option>
                            <?php endforeach ?>
                        </select>
                        <input type="hidden" name="sub_class" id="sub_class"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Base Unit Cons. Cost: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="text" readonly id="building_value" placeholder="Building value" name="base_value">
                         <i id="loader"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Area in sq. m.: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input type="text" id="area_build" placeholder="Area" name="area" onkeyup="calculateMVBuilding(this.value)">
                         <i id="loader"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Unit Construction Cost: P </label>
                    </div>
                    <div class="col-sm-3 input-column">
                        <input class="form-control" type="text" id="base_market_value" name="base_value">
                        <label class="control-label" for="name-input-field"> /sq.m.Building Core: (Use additional Sheets ifnecessary) </label>
                    </div>
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">Sub Total: P</label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-group"></div>
                
                 <div class="form-group">
                   <!--  <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Economic Life (yrs): </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" id="economic_life">
                          <div class="form-group"> 
                    </div> -->
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Used Life (yrs): </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" onkeyup="depreciation(this.value)">
                    </div>
                <!-- </div> -->
                    <!-- </div> -->
                </div>
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Depreciation Rate: </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" id="depreciation_rate">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Depreciation Cost: P </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" id="depreciation_cost">
                    </div>
                </div>
               <!--  <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Unit Construction Cost: P </label>
                    </div>
                    <div class="col-sm-3 input-column">
                        <input class="form-control" type="text">
                        <label class="control-label" for="name-input-field"> </label>
                    </div>
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">Sub Total Total Construction Cost: P</label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text">
                    </div>
                </div> -->
                <!-- <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Total % Depreciation: </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" id="percent_depreciation">
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Market Value: P&nbsp; </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" id="adjusted_market_value" name="adjusted_market_value">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 label-column">
                        <label class="control-label" for="name-input-field">Primary Used (Category): </label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <select name="category" id="category" class="form-control">
                            <option selected disabled></option>
                            <option value="residential">Residential</option>
                            <option value="agricultural">Agricultural</option>
                            <option value="commercial">Commercial</option>
                            <option value="industrial">Industrial</option>
                            <option value="timberland">Timberland</option>
                        </select>
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

                <a href="<?php echo base_url('admin/real_property_mgt/building_property') ?>" class="btn btn-default btn-lg submit" type="button">Cancel </a>                          
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
