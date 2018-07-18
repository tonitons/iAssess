<?php 
	$signatory = new Signatory_model;
	$sign = new Signatory_model;
 	$signatory = $sign->getSignPerson('tax reports', 1);
 ?>
<div class="container">
<div class="row register-form">
	<div class="custom-form">	
	<h2>delinquent List</h2>		
	<div class="table-responsive">
	<button class="pull-right" onclick="window.print()"><span class="glyphicon glyphicon-print"></span>&nbsp;PRINT</button>
	<table class="table table-striped" id="tbl_mvland"> 
		<thead>
			<tr>
				<!-- <th><label for="">Trans No.</label></th> -->
				<th><label for="">PIN</label></th>
				<th><label for="">Owner Name</label></th>
				<th><label for="">Location</label></th>
				<th><label for="">Property Type</label></th>
				<th><label for="">Delinquency Count (month)</label></th>
				<th><label for="">Total Payables</label></th>
				<!-- <th><label for="">Status</label></th> -->
				<!-- <th><label for="">DATE</label></th> -->
				<!-- <th><label for="">Options</label></th> -->
			</tr>
		</thead>
		<tbody>
		<?php 

		$datetoday = strtotime(date('Y-m-d'));
		// 
		$year = date('Y');
			


		 ?>
			<?php $ctr =1; ?>
			<?php foreach ($delinquent_list as $list): ?>
				<?php 
					$due_date = strtotime($list->due_date);
					// $datedue = $value->due_date;
					// $assess_value = $list->assessment_value;
					$divisor = 2592000;
					if(date('Y-m-d') > "$year-02-28")
						$divisor = $divisor - 86400;
					$datediff = intval(($due_date - $datetoday)/$divisor);
					$add =0;

					
					if($datetoday > $due_date)
						$add = 1;
					
					$percent = abs($datediff-$add);
					// echo $percent;
					if($percent > 3 || date('Y-m-d') > "$year-03-31"){
					// $tax = $list->tax_amount;

				 ?>
				<tr>

					<!-- <td></?php echo $list->or_no ?></td> -->
					<td><?php echo $list->pin ?></td>
					<td class="text-capitalize text-left"><?php echo $list->lname.', '.$list->fname.' '.substr($list->mname, 0, 1).'.' ?></td>
					<td class="text-left"><?php echo substr($list->barangay_name, 0, 19) ?></td>
					<td><?php echo $list->type_of_property.' ('.$list->classification.')' ?></td>
					
					<td><?php echo $percent ?></td>
					<!-- <td></?php echo if($list->status == '0') ?></td> -->
					<td class="text-right"><?php echo number_format(($list->tax_amount + ($list->tax_amount * ($percent*0.02))), 2) ?></td>
					<!-- <td><button class="btn btn-primary edit_data">Update</button></td> -->
				</tr>
			<?php }
				endforeach; ?>
		</tbody>
	</table>

	</div>
	<div class="signatories pull-left">
	<br>
	    <p>Prepared by:</p>
	    <p class="text-uppercase"><?php echo $signatory[0]->fname.' '.substr($signatory[0]->mname, 0, 1).'. '.$signatory[0]->lname ?>
	    <br><?php echo $signatory[0]->position ?></p>
	</div>
	<div class="clearfix"></div>
	</div>
	</div>
</div>