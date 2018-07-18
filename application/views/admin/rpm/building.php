<div class="container">
<div class="row register-form">
    <div class="custom-form">
        <h1>LIST of BUILDING PROPERTIES</h1>
        <a class="btn btn-primary pull-left" href="<?php echo base_url('admin/real_property_mgt/add_building') ?>"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add New</a>
        <div class="table-responsive">
            <!-- <form action="" class="form-inline pull-right" >
            <div class="col-md-5 col-md-offset-2">
                <input type="text" name="s" placeholder="Owner" class="form-control">
            </div>
            <div class="col-md-1 col-md-pull-1">
                <select name="by" id="" class="form-control">
                    <option selected disabled> Search By</option>
                    <option value="fname">First Name</option>
                    <option value="mname">Middle Name</option>
                    <option value="lname">Last Name</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn-default btn-sm">Search <span class="glyphicon glyphicon-search"></span></button>
            </div>
            </form> -->
            <table class="table table-bordered" id="list_building">
                <thead>
                    <tr>
                        <th><label for="">PIN</label></th>
                        <!-- <th><label for="">Lot No.</label></th> -->
                        <th><label for="">Owner Name</label></th>
                        <th><label for="">Property Location</label></th>
                        <th><label for="">Classification</label></th>
                        <th><label for="">Manage</label></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_building_property as $key ): ?>
                        <tr>
                            <td><?php echo $key->pin ?></td>
                            <!-- <td></?php echo $key->cadastral_lot_no ?></td> -->
                            <td><?php echo $key->name ?></td>
                            <td><?php echo $key->barangay_name ?></td>
                            <td><?php echo $key->classification ?></td>
                            <td>View</td>
                        </tr>    
                    <?php endforeach ?>
                </tbody>
                <?php if (empty($list_building_property)): ?>
                    <tr>
                        <td colspan="6">
                         <div class="alert alert-warning" style="text-align: center">
                             <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No result found for your query...
                          </div>
                        </td>
                    </tr>
                <?php endif ?>
            </table>
        </div>
    <!-- </form> -->
    </div>
    </div>
</div>