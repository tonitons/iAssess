			<?php if($taxable == 1): ?>
			<?php if ($status == 0 || $status == 1): ?>
				<div class="form-group">
                    <div class="input-group input-group-lg col-md-12">
                    	<input type="hidden" name="tax_id" value="<?php echo $tax_id ?>">
                      <span class="input-group-addon">P</span>
                      <input type="text" class="form-control" placeholder="Tax Payable" name="amount_due" id="amount_due" value="<?php echo $totaltax ?>" style="font-size:40px; height: auto; text-align: right; font-weight: 600" readonly>
                    </div> 
                <!-- </div>    -->
                <!-- <div class="form-group"> -->
	                <?php if ($back_accounts): ?>
	                <div>
	                	<h3>Back Account for year: <?php echo substr($duedate, 0, 4) ?></h3>
	                </div>	
	                <?php else: ?>
                	<div>
                		<h3>Payment for year: <?php echo substr($duedate, 0, 4) ?></h3>
                	</div>
	                <?php endif; ?>
                    <div class="">
                        <label class="control-label" for="name-input-field">payment type:</label>
                    <!-- </div>
                    <div class="col-sm-8 input-column"> -->
                        <span id="show-loader"></span>
                        <input class="form-control" type="radio" name="payment_type" id="yearly" value="yearly" checked=""> Yearly
                        <!-- <input class="form-control" type="radio" name="payment_type" id="quarterly" value="quarterly"> Quarterly -->
                    </div>
                <!-- </div>  -->
                <!-- <div class="form-group"> -->
                    <!-- <div class="col-sm-6 label-column">
                        <label class="control-label" for="name-input-field">Date:</label>
                    </div> -->
                    <!-- <div class="col-sm-4 input-column">
                        <input class="form-control" type="text" name="date_pay" id="datetoday" value="</?php echo '2017-03-15' ?>">
                    </div> -->
                <!-- </div>  -->
               
                <hr>
                <h1>AMOUNT BREAKDOWN</h1>
                <div id="quarterly-data">	                
	                <!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Assessed Value:</label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" value="<?php echo $assessment_value ?>">
	                    </div>
	                <!-- </div> -->
	                <!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Tax Amount (2%):</label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" value="<?php echo $tax ?>">
	                    </div>
	                <!-- </div> -->
	                
	                <!-- <div class="form-group"> -->
	                    <!-- <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Due Date: </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" id="duedate" value="</?php echo $duedate ?>">
	                    </div> -->
	                <!-- </div> -->
	                
	                <!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Number of Months delinquency: </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" name="month_delinquency" value="<?php echo $datediff ?>">
	                    </div>
	                <!-- </div> -->
	                
	                <!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Total Percentage Penalty: </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" value="<?php echo (($datediff*0.02)*100).'%'; ?>">
	                    </div>
	                <!-- </div> -->
	                <!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Penalty Amount: </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" name="penalty_amount" value="<?php echo $penalty ?>">
	                    </div>
						<?php if ($tax_this_year['totaltax'] > 0): ?>
							
						<div id="tax-this-year-container">
						<div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field"><a href="#" data-toggle="modal" data-target="#modal_this_year_tax" style="text-decoration:underline" id="btn-modal-tax" title="View details for this years tax"><span class="glyphicon glyphicon-edit"></span>&nbsp;Tax this year (<?php echo date('Y') ?>):</a> </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" id="tax_this_year" value="<?php echo number_format($tax_this_year['totaltax'], 2) ?>">
	                    </div>
	                    	<!-- hidden inputs for this years tax -->
	                    	<input type="hidden" name="amount_due1" value="<?php echo $tax_this_year['totaltax'] ?>">
	                    	<input type="hidden" name="month_delinquency1" value="<?php echo $tax_this_year['months'] ?>">
	                    	<input type="hidden" name="penalty_amount1" value="<?php echo $tax_this_year['penalty_amount']?>">
	                    </div>
	                    <input type="hidden" id="hid_tax_this_year" name="tax_this_year" value="1">
						<?php endif ?>
	                <!-- </div> -->
	                <?php if ($discounted): ?>
	                	<div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Discount (<?php echo $discount_percent*100 ?>%): </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" name="discount_amount" value="<?php echo $discount_amt ?>">
	                    </div>
	                <?php endif ?>
	                 	
                </div>
					<!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Amount Received: </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" id="amount_received" onkeyup="calculateChange()" style="font-size:30px; height: auto;">
	                    </div>
	                <!-- </div> -->
	                <!-- <div class="form-group"> -->
	                    <div class="col-sm-5 label-column">
	                        <label class="control-label" for="name-input-field">Change: </label>
	                    </div>
	                    <div class="col-sm-5 input-column">
	                        <input class="form-control" type="text" id="change" style="font-size: 40px;height: inherit;color: rgb(197, 44, 44);font-weight:600;">
	                    </div>
	                <!-- </div> -->
					<div class="clearfix"></div>
	                <div class="col-sm-offset-6">
                		<input type="submit" id="en_save" disabled value="SAVE" class="btn btn-default submit col-sm-4">
                	</div>
	            </div>
                <!-- <button class="btn btn-default submit" type="submit">Close </button> -->
			<?php else: ?>
				<h1 style="color: green">Payment for this year's tax has been paid in full.</h1>
			<?php endif ?>
		<?php else: ?>
				<h1 style="color: red">Ooops! this can't be possible, this property is declared as tax exempt.</h1>
		<?php endif; ?>


<div id="modal_this_year_tax" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 style="color:white" id="myLoginLabel">TAX FOR THIS YEAR (BREAKDOWN)</h4>
      	</div>
      	
      	<div class="modal-body">
      
      		<div class="row">
      			<div class="col-md-6 text-left">
      				<label for="">Number of Months Delinquency:</label>
      			</div>
      			<div class="col-md-6">
      				<c><?php echo $tax_this_year['months'].' month(s)' ?></c>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-6 text-left">
      				<label for="">Total Percentage Penalty:</label>
      			</div>
      			<div class="col-md-6">
      				<c><?php echo (($tax_this_year['months']*0.02)*100) ?></c>
      			</div>
      		</div>
      		<div class="row">
      			<div class="col-md-6 text-left">
      				<label for="">Penalty Amount:</label>
      			</div>
      			<div class="col-md-6">
      				<c><?php echo $tax_this_year['penalty_amount'] ?></c>
      			</div>
      		</div>
      		<?php if ($tax_this_year['w_discount']): ?>
      		<div class="row">
      			<div class="col-md-6 text-left">
      				<label for="">Discount (10%):</label>
      			</div>
      			<div class="col-md-6">
      				<c><?php echo number_format(($tax_this_year['totaltax'] * $discount_percent), 2) ?></c>
      			</div>
      		</div>
      		<?php endif ?>
			<div class="row">
      			<div class="col-md-6 text-left">
      				<label for="">Tax Amount:</label>
      			</div>
      			<div class="col-md-6">
      				<?php echo number_format($tax_this_year['totaltax'], 2) ?>
      			</div>
      		</div>
      	</div>
      	<div class="modal-footer">
      		<a href="#" class="btn exclude" id="close"><span aria-hidden="true">&times;</span>&nbsp;EXCLUDE</a>
      		<a href="#" class="btn" data-dismiss="modal" id="save" data-target="#tax_details"><span class="glyphicon glyphicon-check"></span>&nbsp;OK</a>
      	</div>
      
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/treasurer.js') ?>"></script>