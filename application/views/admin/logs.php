
<?php $fullName = new User_model;  ?>

<div class="container">
<div class="row register-form">
<?php if(!empty($message)): ?>
    <!-- <script>alert('dfksjh')</script> -->
    <?php $this->load->view('template/message', ['message' => $message]) ?>
        <script>$('#notification').modal("show");</script> 
<?php endif; ?>

    <div class="custom-form">
    <a data-toggle="modal" data-target="filter-modal" href="#" class="btn btn-default pull-left" id="filter">FILTER RESULTS</a data-toglle>
        <h1>Activity Logs </h1>
        <br>
        <p class="pull-left text-uppercase"><?php echo !empty($_POST) ? 'Showing log entries from '.$this->input->post('from').' to '.$this->input->post('to') : ""; ?></p>
        <div class="clearfix"></div>
        <div class="bs-example bs-example-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist">
              <li class="active aw"><a href="#admin" role="tab" data-toggle="tab"><label for="">ADMIN LOGS</label></a></li>
              <li class="aw"><a href="#staff" role="tab" data-toggle="tab"><label for="">STAFF LOGS</label></a></li>
              <li class="aw"><a href="#treasurer" role="tab" data-toggle="tab"><label for="">TREASURER LOGS</label></a></li>
              <li class="aw"><a href="#owner" role="tab" data-toggle="tab"><label for="">OWNER LOGS</label></a></li>
              <li class="aw"><a href="#all_logs" role="tab" data-toggle="tab"><label for="">ALL LOGS</label></a></li>
            </ul>
            <br>
                    <div id="myTabContent" class="tab-content">
                      <div class="tab-pane active fade in" id="admin">
                      <!-- <br><h2>&nbsp;</h2> -->
                        <div class="table-responsive">
                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">Activity id</label></th>
                                        <th><label for="">User</label></th>
                                        <th><label for="">Activity</label></th>
                                        <th><label for="" title="Click to sort">Date and Time <span class="caret"></span></label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $key ): ?>
                                        <?php if($key->user_type == 'admin'): ?>
                                        <tr>
                                            <td><?php echo $key->activity_id ?></td>
                                            <td class="text-capitalize"><?php echo $fullName->getFullName($key->user_id, 'staff_id' ,'tbl_staff') ?></td>
                                            <td><?php echo $key->activity ?></td>
                                            <td><?php echo $key->act_date ?></td>
                                        </tr>    
                                    <?php endif; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="staff">
                        
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white;">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">Activity id</label></th>
                                        <th><label for="">User</label></th>
                                        <th><label for="">Activity</label></th>
                                        <th><label for="" title="Click to sort">Date and Time <span class="caret"></span></label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $key ): ?>
                                        <?php if($key->user_type == 'staff'): ?>
                                        <tr>
                                            <td><?php echo $key->activity_id ?></td>
                                            <td><?php echo $fullName->getFullName($key->user_id, 'staff_id' ,'tbl_staff') ?></td>
                                            <td><?php echo $key->activity ?></td>
                                            <td><?php echo $key->act_date ?></td>
                                        </tr>    
                                    <?php endif; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="treasurer">
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">Activity id</label></th>
                                        <th><label for="">User</label></th>
                                        <th><label for="">Activity</label></th>
                                        <th><label for="" title="Click to sort">Date and Time</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $key ): ?>
                                        <?php if($key->user_type == 'treasurer'): ?>
                                        <tr>
                                            <td><?php echo $key->activity_id ?></td>
                                            <td><?php echo $fullName->getFullName($key->user_id, 'staff_id' ,'tbl_staff') ?></td>
                                            <td><?php echo $key->activity ?></td>
                                            <td><?php echo $key->act_date ?></td>
                                        </tr>    
                                    <?php endif; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="owner">
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">Activity id</label></th>
                                        <th><label for="">User</label></th>
                                        <th><label for="">Activity</label></th>
                                        <th><label for="" title="Click to sort">Date and Time <span class="caret" ></span></label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $key ): ?>
                                        <?php if($key->user_type == 'owner'): ?>
                                        <tr>
                                            <td><?php echo $key->activity_id ?></td>
                                            <td><?php echo $fullName->getFullName($key->user_id, 'owner_id' ,'tbl_owner') ?></td>
                                            <td><?php echo $key->activity ?></td>
                                            <td><?php echo $key->act_date ?></td>
                                        </tr>    
                                    <?php endif; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="all_logs">
                        <div class="table-responsive">

                            <table class="table table-bordered" style="background-color:white">
                                <thead>
                                    <tr class="bg-primary">
                                        <th><label for="">Activity id</label></th>
                                        <th><label for="">User Type</label></th>
                                        <th><label for="">Name of User</label></th>
                                        <th><label for="">Activity</label></th>
                                        <th><label for="" title="Click to sort">Date and Time <span class="caret" ></span></label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $key ): ?>
                                        <tr>
                                            <td><?php echo $key->activity_id ?></td>
                                            <td><?php echo $key->user_type ?></td>
                                            <td>
                                                <?php if($key->user_type == 'owner'){ ?>
                                                    <?php echo $fullName->getFullName($key->user_id, 'owner_id' ,'tbl_owner') ?>
                                                <?php }else if($key->user_type == 'admin'){ ?>
                                                    <?php echo 'Admin' ?>
                                                <?php }else if($key->user_type == 'staff' || $key->user_type == 'treasurer'){ ?>
                                                    <?php echo $fullName->getFullName($key->user_id, 'staff_id' ,'tbl_staff'); }?>
                                            </td>
                                            <td><?php echo $key->activity ?></td>
                                            <td><?php echo $key->act_date ?></td>
                                        </tr>    
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        
    <!-- </form> -->
    </div>
    </div>
</div>

<!--###########################################start clear logs modal###########################################-->
<div id="clear_logs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">Clear Logs</h2>
        </div>
        <form role="form" action="" name="logs" method="POST">
        <div class="modal-body">
            <label for="">Are you sure you want to clear ALL LOGS of the system?</label>
            <input type="hidden" class="form-control" name="clear_log" value="yes">
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">No</a>
            <button type="submit" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Yes</span></button>
        </div>
        </form>
    </div>
  </div>
</div>
<!--###########################################end clear logs modal###########################################-->

<!--###########################################start delete logs modal###########################################-->
<div id="delete_logs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title" id="myLoginLabel">DELETE Log</h2>
        </div>
        <form role="form" action="" name="logs" method="POST">
        <div class="modal-body">
            <label for="">Are you sure you want to clear LOGS from <b id="date-from"></b> to <b id="date-to"></b> of the system?</label>
            <input type="hidden" class="form-control" name="delete_log" value="yes">
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#increase">No</a>
            <button type="submit" class="btn btn-success" id="save"><span class="glyphicon glyphicon-check"></span>  <span>Yes</span></button>
        </div>
        </form>
    </div>
  </div>
</div>
<!--###########################################end delete logs modal###########################################-->
<!-- filter results -->

<div id="filter-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="myLoginLabel">FILTER LOGS</h3>
        </div>
        <div class="modal-body">
                <form action="" method="POST" name="filter" id="form-filter" onsubmit="return filterDate()">
                    
                    <div class="col-md-4">
                        
                        <label for="">FROM:</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input placeholder="yyyy-mm-dd" class="form-control date datepicker" id="input-from" name="from" value="<?php echo $this->input->post('from') ?>">    
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">TO:</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input placeholder="yyyy-mm-dd" class="form-control datepicker" id="input-to" name="to" value="<?php echo $this->input->post('to') ?>">

                    </div>
                    <!-- <div class="col-md-11 col-md-push-1"> -->
                        
                        <!-- <a href="#" data-toggle="modal" data-target="delete_logs" class="btn btn-danger" id="delete-btn">delete logs</a> -->
                        <!-- <a href="#" data-toggle="modal" data-target="clear_logs" class="btn btn-danger" id="btn-clear">clear all logs</a>  -->  
                    <!-- </div> -->
                    <!-- <br><br> -->
                
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <a href="#" class="btn btn-warning" data-dismiss="modal" id="close" data-target="#filter-modal">Close</a>
                <input type="submit" id="save" class="btn btn-success" value="Filter!">
            </div>
            </form>
    </div>
  </div>
</div>