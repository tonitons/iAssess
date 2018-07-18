 <style>
     .register-form .custom-form .form-group{
        margin-bottom: 2px;
     }
 </style>
  <div class="form-group"></div>
  <div class="custom-form">
    <!-- <a href="</?php echo base_url('admin/real_property_mgt/land_property') ?> " class="pull-left">BACK</a> -->
    <?php if(!empty($message)): ?>
        <?php $this->load->view('template/message', ['message' => $message]) ?>
        <script>$('#notification').modal('show');</script>
    <?php endif; ?>
    </div>
    <div class="row register-form">

    <form class="form-horizontal" method="POST" action="">
        <div class="col-md-6 services">
            <div class="custom-form">
            <p class="btn btn-primary pull-right" id="btn_edit">Edit</p>
                <h1>PROPERTY DATA</h1>
                <div class="form-group">
                    <div class="col-sm-1">
                        <label class="control-label" for="name-input-field">PIN: </label>
                    </div>
                    <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="pin" id="pin" value="<?php echo $property['property_data']->pin ?>" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label" for="name-input-field">Cadastral Lot No.:</label>
                    </div>
                    <div class="col-sm-2 input-column">
                        <input class="form-control" type="text" name="cadastral_lot_no" value="<?php echo $property['property_data']->cadastral_lot_no ?>">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-sm-1">
                        <label class="control-label" for="name-input-field">Owner: </label>
                    </div>
                    <div class="col-sm-10 input-column">
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="fname" value="<?php echo $property['property_data']->fname ?>">
                            <input type="hidden" name="owner_id" value="<?php echo $property['property_data']->owner_id ?>">
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="mname" value="<?php echo $property['property_data']->mname ?>">
                        </div>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="lname" value="<?php echo $property['property_data']->lname ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="address" value="<?php echo $property['property_data']->address ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Tel No:</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="contact" value="<?php echo $property['property_data']->contact ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field"> Administrator/ Beneficial User :</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="beneficial" value="<?php echo $property['property_data']->beneficial ?>">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Address: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="ben_add" value="<?php echo $property['property_data']->ben_add ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Tel No:</label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="ben_tel" value="<?php echo $property['property_data']->ben_tel ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">E-mail: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="email" value="<?php echo $property['property_data']->email ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Type of Property: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="type_of_property" value="<?php echo $property['property_data']->type_of_property ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">Classification: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="classification" value="<?php echo $property['property_data']->classification ?>">
                    </div>
                </div>
                <div class="clearfix"></div>
            
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
                        <input type="text" class="form-control" value="<?php echo $property['property_data']->barangay_name ?>">
                    </div>
                </div>
                <h1>PROPERTY BOUNDARIES&nbsp; </h1>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">North: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="north" value="<?php echo $property['property_data']->north ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">East: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="east" value="<?php echo $property['property_data']->east ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">South: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="south" value="<?php echo $property['property_data']->south ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 label-column">
                        <label class="control-label" for="name-input-field">West: </label>
                    </div>
                    <div class="col-sm-6 input-column">
                        <input class="form-control" type="text" name="west" value="<?php echo $property['property_data']->west ?>">
                    </div>
                </div>

                <input type="submit" value="Update" class="btn btn-succes btn-lg" id="btn_submit" disabled style="display:none">
                <div class="clearfix"></div>
           </div>

        </form>
        </div> 
</div>
<div class="row register-form custom-form">
<div class="container">
    <h3>APPRAISAL and ASSESSMENT HISTORY</h3>
    <div class="table-responsive">

            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>Date Appraised</th>
                        <th>Base Value</th>
                        <th>Appraised Value</th>
                        <th>Assessment Level</th>
                        <th>Assessed Value</th>
                        <th>Revision</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($property['appraisal_history'] as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->date_appraised ?></td>
                        <td><?php echo number_format($value->base_value, 2) ?></td>
                        <td><?php echo number_format($value->appraised_value, 2) ?></td>
                        <td><?php echo $value->assess_level ?>%</td>
                        <td><?php echo number_format($value->assessment_value, 2) ?></td>
                        <td><?php echo $value->revision ?></td>
                    </tr>
                <?php endforeach ?>
                    
                </tbody>
            </table>
        </div>
        <div class="clearfix">&nbsp;</div>
</div>
</div>