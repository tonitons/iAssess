
	<table id="owner_results" class="table" >
		 <tr>
            <th class="hidden">ID</th>
            <th>Owner Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Property Type</th>
            <th class="hidden">Location</th>
            <th class="hidden">Tax dec</th>
            <!-- <th>tel no.</th> -->
            <th>Action</th>
        </tr>
    <tbody>
    	<?php foreach ($search_results as $value): ?>
        <tr>
            <td class="hidden"><?php echo $value->pin ?></td>
            <td class="text-capitalize"><?php echo $value->fname.' '.$value->mname.' '.$value->lname ?></td>
            <td><?php echo $value->address ?></td>
            <td><?php echo $value->contact ?></td>
            <td><?php echo $value->classification.' '.$value->type_of_property ?></td>
            <td class="hidden"><?php echo $value->barangay_name ?></td>
            <td class="hidden"><?php echo $value->tax_dec ?></td>
            <!-- <td></?php echo $value->ben_tel ?></td> -->
            <td><b class="btn btn-primary select">SELECT</b></td>
        </tr>
        <?php endforeach ?>
        <?php if (empty($search_results)): ?>
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

<script src="<?php echo base_url('assets/js/treasurer.js') ?>"></script>