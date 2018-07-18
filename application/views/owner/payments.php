
<div class="container">
	<div class="row register-form">
		<div class="custom-form">
			<h2>My Payments</h2>
			
			<div class="table-responsive">
				<table class="table table-bordered" style="background-color:white">
					<thead>
					<tr class="bg-primary">
						<th>PIN</th>
						<th>Property Type</th>
						<th>Area (sq. m.)</th>
						<th>Location</th>
						<th>Amount Paid</th>
						<th>Date Paid</th>
						<th>Received by</th>
						<th>Type of Payment</th>
						
					</tr>
					</thead>
					<tbody>
					<?php foreach ($payments as $key => $value): ?>
						<tr>
							<td><?php echo $value->pin ?></td>
							<td><?php echo $value->type_of_property ?></td>
							<td><?php echo $value->area ?></td>
							<td><?php echo $value->barangay_name ?></td>
							<td><?php echo number_format($value->amount_received, 2) ?></td>
							<td><?php echo $value->pay_date ?>&nbsp;</td>
							<td class="text-capitalize"><?php echo $value->fname.' '.$value->lname ?></td>
							<?php if ($value->status == 1): ?>
								<?php 
									$year = date('Y');
									$quarterly = new Owner_model;
									$text = $quarterly->getQuarterlyPayCount($value->tax_id);
									// var_dump($text);
									if($value->pay_date <= $year.'-03-31') $q = 'First';
									elseif ($value->pay_date <= $year.'-06-30') $q = 'Second';
									elseif ($value->pay_date <= $year.'-09-31') $q = 'Third';
									else $q = 'Fourth'; 

								 ?>
							<?php endif ?>
							<td><?php echo $value->payment_type; echo $value->status == 1 ? '('.$q.')' : '' ?>&nbsp;<img src="../smallSuccess.gif" alt=""></td>
							
						</tr>
					<?php endforeach ?>
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>