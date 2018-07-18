<div class="container">
	<div class="row register-form">
	    <div class="custom-form">
	        <h2>LIST of MACHINERY</h2>
	        <a class="btn btn-primary pull-left" href="<?php echo base_url('admin/real_property_mgt/add_machinery') ?>"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add New</a>
	        <div class="table-responsive">
	            <table class="table table-bordered" id="list_land">
	                <thead>
	                    <tr>
	                        <th><label for="">PIN</label></th>
	                        <!-- <th><label for="">Lot No.</label></th> -->
	                        <th><label for="">Owner Name</label></th>
	                        <th><label for="">Property Location</label></th>
	                        <th><label for="">Classification</label></th>
	                        <th><label for="">Type of Machinery</label></th>
	                        <th><label for="">Manage</label></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php foreach ($machineries as $key ): ?>
	                        <tr>
	                            <td><?php echo $key->pin ?></td>
	                            <!-- <td></?php echo $key->cadastral_lot_no ?></td> -->
	                            <td class="text-left text-capitalize"><?php echo $key->name ?></td>
	                            <td class="text-left"><?php echo substr($key->barangay_name, 0, 19) ?>...</td>
	                            <td><?php echo $key->classification ?></td>
	                            <td><?php echo $key->sub_class ?></td>
	                            <td><a href="<?php echo base_url('land/view/'.$key->pin) ?>"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; View</a></td>
	                        </tr>    
	                    <?php endforeach ?>
	                </tbody>
	                <?php if (empty($machineries)): ?>
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