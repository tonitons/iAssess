
	<table id="owner_results" class="table" >
		 <tr>
            <th class="hidden">ID</th>
            <th>FName</th>
            <th>MName</th>
            <th>LName</th>
            <th>Address</th>
            <th>Contact</th>
            <th class="hidden">Administrator</th>
            <th class="hidden">Add</th>
            <th class="hidden">tel no.</th>
            <th>Action</th>
        </tr>
    <tbody>
    	<?php foreach ($search_results as $value): ?>
        <tr>
            <td class="hidden"><?php echo $value->owner_id ?></td>
            <td><?php echo $value->fname ?></td>
            <td><?php echo $value->mname ?></td>
            <td><?php echo $value->lname ?></td>
            <td><?php echo $value->address ?></td>
            <td><?php echo $value->contact ?></td>
            <td class="hidden"><?php echo $value->beneficial ?></td>
            <td class="hidden"><?php echo $value->ben_add ?></td>
            <td class="hidden"><?php echo $value->ben_tel ?></td>
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

<script src="<?php echo base_url('assets/js/add_land.js') ?>"></script>