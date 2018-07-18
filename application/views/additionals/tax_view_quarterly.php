                <h2>Quarterly Payment:</h2>
                <div class="form-group">
                    <div class="input-group input-group-lg col-md-12">
                        <input type="hidden" name="tax_id" value="<?php echo $tax_id ?>">
                      <span class="input-group-addon">P</span>
                      <input type="text" class="form-control" placeholder="Tax Payable" name="amount_due" id="amount_due" value="<?php echo $quarterly_payment ?>" style="font-size:40px; height: auto; text-align: right; font-weight: 600 ">
                    </div> 
                <!-- </div>    -->
                <!-- <div class="form-group"> -->
                    <div class="">
                        <label class="control-label" for="name-input-field">payment type:</label>
                    <!-- </div>
                    <div class="col-sm-8 input-column"> -->
                        <span id="show-loader"></span>
                        <input class="form-control" type="radio" name="payment_type" id="yearly" value="yearly"> Yearly
                        <input class="form-control" type="radio" name="payment_type" id="quarterly" value="quarterly" checked=""> Quarterly
                    </div>
                <!-- </div>  -->
                <!-- <div class="form-group"> -->
                    <!-- <div class="col-sm-4 label-column">
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
                            <label class="control-label" for="name-input-field">Tax Amount (Payable): </label>
                        </div>
                        <div class="col-sm-5 input-column">
                            <input class="form-control" type="text" value="<?php echo $quarterly_payment ?>">
                        </div>
                    <!-- </div> -->
                    <?php 
                        if($pay_count == 1) 
                            $q = 'Second ';
                        else if($pay_count == 2)
                            $q = 'Third ';
                        else 
                            $q = 'Fourth';

                    ?>
                    <!-- <div class="form-group"> -->
                        <div class="col-sm-5 label-column">
                            <label class="control-label" for="name-input-field">Quarter: </label>
                        </div>
                        <div class="col-sm-5 input-column">
                            <input class="form-control" type="text" value="<?php echo $q  ?> Quarter">
                        </div>
                    <!-- </div> -->
                </div>
                    <!-- <div class="form-group"> -->
                        <div class="col-sm-5 label-column">
                            <label class="control-label" for="name-input-field">Amount Received: </label>
                        </div>
                        <div class="col-sm-5 input-column">
                            <input class="form-control" type="number" step="any" id="amount_received" onkeyup="calculateChange()" style="font-size:30px; height: auto;">
                        </div>
                    <!-- </div> -->
                    <!-- <div class="form-group"> -->
                        <div class="col-sm-5 label-column">
                            <label class="control-label" for="name-input-field">Change: </label>
                        </div>
                        <div class="col-sm-5 input-column">
                            <input class="form-control" type="text" id="change" style="font-size: 40px;height: inherit;color: rgb(197, 44, 44);font-weight:600;">
                        </div>
                    </div>
            <div class="col-sm-offset-7">
                <input type="submit" id="en_save" value="SAVE" disabled class="btn btn-default submit col-sm-4">
            </div>
                