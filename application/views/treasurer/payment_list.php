<?php 
	$signatory = new Signatory_model;
	$sign = new Signatory_model;
 	$signatory = $sign->getSignPerson('tax reports', 1);
 ?>
<div class="container">
<div class="row register-form">
	<div class="custom-form">	
	<h2>Payment List</h2>		


<div class="bs-example bs-example-tabs">
		    <ul id="myTab" class="nav nav-tabs" role="tablist"> 

		      <!-- <li class="active aw"><a href="#active" role="tab" data-toggle="tab"><label for="">FULL PAYMENTS</label></a></li> -->
		      <!-- <li class="aw"> 	<a href="#deactivated" role="tab" data-toggle="tab"><label for="">DEACTIVATED USERS</label></a></li> -->
		      <!-- <li class="aw"> 	<a href="#staff" role="tab" data-toggle="tab"><label for="">PARTIAL PAYMENTS</label></a></li> -->
		    </ul>
				    <div id="myTabContent" class="tab-content">
				    <br>
				      <div class="tab-pane active fade in" id="active">
									      
				        <div class="table-responsive">
				        	<button class="pull-right" onclick="window.print()"><span class="glyphicon glyphicon-print"></span>&nbsp;PRINT</button>
							<table class="table table-striped" id="full_payment"> 
							<thead>
								<tr>
									<th><label for="">Trans No.</label></th>
									<th><label for="">PIN</label></th>
									<th><label for="">Owner Name</label></th>
									<th><label for="">Location</label></th>
									<th><label for="">Amount Paid</label></th>
									<!-- <th><label for="">Status</label></th> -->
									<th><label for="">DATE</label></th>
									<!-- <th><label for="">Options</label></th> -->
								</tr>
							</thead>
							<tbody>
								<?php $ctr =1; ?>
								<?php foreach ($payment_list as $list): ?>
								<?php if ($list->payment_type == 'yearly'): ?>
									<tr>
									
										<td><?php echo $list->or_no ?></td>
										<td><?php echo $list->pin ?></td>
										<td class="text-capitalize text-left"><?php echo $list->fname.' '.$list->mname.' '.$list->lname ?></td>
										<td class="text-left"><?php echo $list->barangay_name ?></td>
										<td class="text-right"><?php echo number_format($list->amount_received, 2) ?></td>
										<!-- <td></?php echo if($list->status == '0') ?></td> -->
										<td><?php echo $list->pay_date ?></td>
										<!-- <td><button class="btn btn-primary edit_data">Update</button></td> -->
									</tr>
									<?php endif ?>
								<?php endforeach; ?>
							</tbody>
						</table>
						</div>
				      </div>
      				

      				<!-- <div class="tab-pane fade in" id="staff">
				        
				        <div class="table-responsive">
				        
							<table class="table table-striped" id="partial_payment"> 
							<thead>
								<tr>
									<th><label for="">Trans No.</label></th>
									<th><label for="">PIN</label></th>
									<th><label for="">Owner Name</label></th>
									<th><label for="">Location</label></th>
									<th><label for="">Amount Paid</label></th>
									 <th><label for="">Status</label></th> 
									 <th><label for="">DATE</label></th> 
									<th><label for="">Options</label></th> 
								</tr>
							</thead>
							<tbody>
								</?php $ctr =1; ?>
								</?php foreach ($payment_list as $list): ?>
									</?php if ($list->payment_type == 'quarterly'): ?>
									<tr>
									
										<td></?php echo $list->or_no ?></td>
										<td></?php echo $list->pin ?></td>
										<td></?php echo $list->fname.' '.$list->mname.' '.$list->lname ?></td>
										<td></?php echo $list->barangay_name ?></td>
										<td></?php echo number_format($list->amount_received, 2) ?></td>
										 <td></?php echo if($list->status == '0') ?></td> 
										<td></?php echo $list->pay_date ?></td>
										< <td><button class="btn btn-primary edit_data">Update</button></td> 
									</tr>
								</?php endif ?>
								</?php endforeach; ?>
							</tbody>
						</table>
						</div>
      				</div> -->
      				<div class="signatories pull-left">
				    <p>Prepared by:</p>
				    <p class="text-uppercase"><?php echo $signatory[0]->fname.' '.substr($signatory[0]->mname, 0, 1).'. '.$signatory[0]->lname ?>
				    <br><?php echo $signatory[0]->position ?></p>
				</div>
				<div class="clearfix"></div>
    			</div>
  			</div>

	</div>
	</div>
</div>