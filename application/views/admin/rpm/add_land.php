<?php 
$array = array(
    'ctr' => 0
);
$this->session->set_userdata( $array ); ?>
<body onload="none()">

    <!-- <div class="form-group"></div> -->
    <div class="row register-form">

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
    <form class="form-horizontal" enctype="multipart form-data" method="POST" action="">
        <div class="col-md-6 services">
            <div class="custom-form">
                <h1>REAL PROPERTY FIELD APPRAISAL &amp; ASSESSMENT&nbsp; - LAND /OTHER IMPROVEMENTS </h1>
                <div class="form-group">
                    <div class="col-sm-1 label-column">
                        <label class="control-label" for="name-input-field">PIN: </label>
                    </div>
                    <div class="col-sm-5 input-column">
                        <input class="form-control input-lg" data-mask="___-__-___-__-___" value="<?php echo set_value('pin') ?>"  name="pin" id="pin" placeholder="___-__-___-__-___">
                        <!-- <input class="form-control" type="text" name="pin"> -->
                    </div>
                    <div class="col-sm-2 label-column">
                        <label class="control-label" for="name-input-field">DATE: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input placeholder="yyyy-mm-dd" class="form-control input-lg datepicker" name="date_appraised"  value="<?php echo date('Y-m-d') ?>">
                        <!-- <input class="form-control" type="text" name="pin"> -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Cadastral Lot No.:</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" data-mask="____" value="<?php echo set_value('cadastral_lot_no') ?>" id="cln" placeholder="____" name="cadastral_lot_no">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-md-push-2 input-column">
                        <label><input type="radio" value="old" name="owner_on" id="old_owner"> Existing Owner</label>
                        <label><input type="radio" value="new" name="owner_on" id="new_owner"> New Owner</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">First Name: </label>
                    </div>
                        <div class="col-sm-6 input-column">
                        <input type="hidden" name="owner_id" id="owner_id">
                        <input class="form-control" type="text" name="fname" id="fname" disabled value="<?php echo set_value('fname') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Middle Name: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="mname" id="mname" disabled="" value="<?php echo set_value('mname') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Last Name: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="lname" id="lname" disabled="" value="<?php echo set_value('lname') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="address" id="address" disabled="" value="<?php echo set_value('address') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Tel No:</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="contact" id="contact-num" disabled="" value="<?php echo set_value('contact') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">E-mail:</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="email" name="email" id="email" disabled="" value="<?php echo set_value('email') ?>" placeholder="Your e-address (not required)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field"> Administrator/ Beneficial User :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="beneficial" id="beneficial" disabled="" value="<?php echo set_value('beneficial') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="ben_add" id="ben_add" disabled="" value="<?php echo set_value('ben_add') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Tel No:</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="ben_tel" id="ben_tel" disabled="" value="<?php echo set_value('ben_tel') ?>">
                    </div>
                </div>
            <!-- </form> -->
             </div>
        </div>
        
        <div class="col-md-6 services">
            <!-- <form class="form-horizontal custom-form"> -->
            <div class="custom-form">
            <h1>PROPERTY LOCATION </h1>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <select name="brgy_id" id="" class="form-control">
                            <option selected disabled>&nbsp;</option>
                            <?php foreach ($brgys as $key => $row): ?>
                                <option value="<?php echo $row->brgy_id ?>"><?php echo $row->barangay_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <h1>PROPERTY BOUNDARIES&nbsp; </h1>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">North: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="north">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">East: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="east">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">South: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="south">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">West: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="west">
                    </div>
                </div>
           </div>
        </div> 


        <!-- DFGDFGDFGDFGDFGFDGHDFHGDFHDFH -->

        <div class="col-md-12">
            <!-- <form class="form-horizontal custom-form"> -->
            <div class="custom-form">
                <h1>LAND APPRAISAL </h1>
                <div class="table-responsive">
                    <table class="table table-bordered" id="list_land_all">
                        <thead>
                            <tr>
                                <th>Classification </th>
                                <th>Sub-Classification </th>
                                <th>Area in sq. m. (square meter)</th>
                                <th>Unit Value&nbsp; </th>
                                <th>Base Market Value </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="classification" id="classification" class="form-control">
                                        <option selected disabled>--SELECT--</option>
                                        <option id="residential" value="residential">Residential</option>
                                        <option id="agricultural" value="agricultural">Agricultural</option>
                                        <option id="commercial" value="commercial">Commercial</option>
                                        <option id="industrial" value="industrial">Industrial</option>
                                    </select>
                                </td>
                                <td id="sub-classification"></td>
                                <td><input class="form-control" type="number" id="area" step="any" onkeyup="calculate_mv(this.value)" name="area"></td>
                                <td><b id="unit-value"></b><input type="hidden" name="base_value" id="base_value"></td>
                                <td>P <input type="text" id="market_value" name="appraised_value" readonly></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td id="sub-type"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="active">
                                <td> </td>
                                <td>Total </td>
                                <td> <b style="font-size:20px" id="total-area"></b> </td>
                                <td>Total </td>
                                <td>P <b style="font-size:20px" id="total-mv"></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- </form> -->
            </div>
            <!-- <form class="form-horizontal custom-form"> -->
            <div class="custom-form">
                <h1>OTHER IMPROVEMENTS </h1>

                <div class="table-responsive">
                <span class="pull-left btn btn-primary " onclick="none()"><input type="checkbox" id="none" checked> <label for="none" class="control-label">NONE</label></span>
                <span href="#" id="add_row" class="btn btn-primary pull-left"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add row</span>
                    <table class="table table-bordered" id="tbl_improvements">
                        <thead>
                            <tr>
                                <th>Kind </th>
                                <th>Total Number </th>
                                <th>Unit Value </th>
                                <th>Base Market Value </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr class="active">
                            <td>Total </td>
                            <td>&nbsp; </td>
                            <td>Total </td>
                            <td>P <b id="total-improvement-mv-con"><b id="total-improvement-mv"></b></b></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            <!-- </form> -->
            </div>
            <!-- <form class="form-horizontal custom-form"> -->
            <div class="custom-form">
                
                <h1>MARKET VALUE </h1>
                
                <div class="table-responsive">
                    <span class="btn btn-primary pull-left" style="display:inline-block" id="calculate">CALCULATE MARKET VALUE</span>
                    <table class="table table-bordered" id="tbl_market_value">
                        <thead>
                            <tr>
                                <th>Base Market Value&nbsp; </th>
                                <th>Adjustment Factors </th>
                                <th>% Adjustment&nbsp; </th>
                                <th>Value Adjustment </th>
                                <th>Market Value </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" id="land-base-value" readonly class="form-control" name="bmv[]"></td>
                                <td>
                                    <select name="" id="dd_road" onchange="display_road_adjustment()" class="form-control" name="adjustments[]">
                                        
                                        <option selected value="0">NONE</option>
                                        <option value="0">Provincial or National Road</option>
                                        <option value="-3">For all weather Roads</option>
                                        <option value="-6">Along dirt road</option>
                                        <option value="-9">For no road outlet</option>
                                    </select>
                                </td>
                                <td><input type="text" id="road_adjustment" name="percent_adjustment[]" class="form-control" readonly></td>
                                <td><input type="text" id="land-adj-value" readonly name="value_adjustment[]" class="form-control"></td>
                                <td><input type="text" id="adjusted-land-market-value" name="adj_market_value[]"></td>
                            </tr>
                            <tr>
                                <td><input type="text" id="improvement-base-value" readonly class="form-control" name="bmv[]"></td>
                                <td>
                                    <select name="adjustments[]" id="dd_loc" onchange="display_loc_adjustment()" class="form-control">
                                        
                                        <option selected value="0">NONE</option>
                                        <option value="+5">0 to 1 kms.</option>
                                        <option value="-2">Over 1 to 3 kms.</option>
                                        <option value="-6">Over 3 to 6 kms.</option>
                                        <option value="-10">Over 6 to 9 kms.</option>
                                        <option value="-14">Over 9</option>
                                    </select>
                                </td>
                                <td><input type="text" id="loc_adjustment" name="percent_adjustment[]" class="form-control"  readonly></td>
                                <td><input type="text" id="loc-adj-value" name="value_adjustment[]" readonly class="form-control"></td>
                                <td><input type="text" id="adjusted-imp-market-value" name="adj_market_value[]"></td>
                            </tr>
                        </tbody>  
                        <tfoot>
                            <tr class="active">
                                <td>Total</td>
                                <td>&nbsp;</td>
                                <td><input type="number" id="total-adjustments" readonly value="0">% </td>
                                <td>Total </td>
                                <td>P <input style="font-size:20px" type="text" class="form-control" id="total-final-adjusted-mv"> </td>
                            </tr>
                        </tfoot>  
                    </table>
                </div>
            <!-- </form> -->
            </div>
            <!-- <form class="form-horizontal custom-form"> -->
            <div class="custom-form">
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
                                <td><b id="actual-use"></b></td>
                                <td>P <b id="tblassess-market-value"></b></td>
                                <td><input type="text" id="assess-level" name="assess_level" readonly class="form-control"></td>
                                <td>P <input id="final-assessed-value" type="text" name="assessment_value" readonly"></td>
                            </tr>
                            <tr class="active">
                                <td>Total </td>
                                <td>P </td>
                                <td>Total </td>
                                <td>P <b id="total-final-assessed-value" style="font-size:20px"></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="form-group col-md-8 col-md-push-4"> -->
                    <div class="col-sm-1">
                        <p class="btn btn-lg radio-btn"><input type="radio" name="taxable"  value="Taxable" id="Taxable" style="height: auto"><label class="control-label taxable" for="Taxable">Taxable </label></p>
                    </div>
                    <div class="col-sm-2">
                        <p class="btn btn-lg radio-btn"><input type="radio" name="taxable" value="Exempt" id="Exempt" style="height: auto"> <label class="control-label taxable" for="Exempt">Exempt </label></p>
                    </div>
                <!-- </div> -->
            <!-- </form> -->
            <div class="clearfix"></div>
            <a href="<?php echo base_url('admin/real_property_mgt/land_property') ?>" class="btn btn-default btn-lg submit" type="button">Cancel </a>                          
            <button class="btn btn-default btn-lg submit" type="submit">Sumbit </button>
            
        
            </div>
        </div>
        <!-- DKJFHGDLFHGKJDFHGJKDKJFGHDFGH -->
        </form>
    </div>


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