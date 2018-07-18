
	<div class="row register-form">
		<div class="custom-form">
			<div class="row">
			<form action="" method="get">
				<!-- <div class="form-group"> -->
					<!-- <div class="col-md-2 text-left">
						<label>Barangay: </label>
					</div> -->
					<div class="col-md-4"> 
					<select name="brgy_id" id="" class="form-control">
						<!-- <option selected disabled></option> -->
						<?php foreach ($barangays as $brgy): ?>
							<option value="<?php echo $brgy->brgy_id ?>" <?php echo $brgy_id == $brgy->brgy_id ? 'selected' : '' ?>><?php echo $brgy->barangay_name ?></option>
						<?php endforeach ?>
					</select>
					
					</div>
					<div class="col-md-2 col-md-pull-1">
					<select name="year" id="" class="form-control">
						<option selected disabled>Choose Year</option>
						<?php $year = date('Y'); ?>
						<?php for ($i = 2017; $i<=$year; $i++): ?>
							<option value="<?php echo $i ?>" <?php echo $i==$this->input->get('year') ? 'selected' : '' ?>><?php echo $i ?></option>
						<?php endfor ?>
					</select>
					</div>
					<div class="col-md-1 col-md-pull-2">
						<button type="submit" class="btn-default btn-sm"> <span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;View &nbsp;</button>
					</div>
				<!-- </div> -->
					
			</form>
			</div>
			<h2 class="section-title">Assessment Roll <br><small>(<?php echo $brgy_name; ?>)</small></h2>

			
			
			<div class="table-responsive">
			<button class="pull-right" onclick="window.print()"><span class="glyphicon glyphicon-print"></span>&nbsp;PRINT</button>
			<table class="table table-striped" id="tbl_mvland"> 
				<thead style="background-color: rgba(207, 207, 221, 0.2)">
					<tr>
						<th><label>Property Owner</label></th>
						<!-- <th><label>Property Index <No class="small">(Sec-Lot)</No></label></th> -->
						<th><label>Arp No.</label></th>
						<th><label>Area (sq.m.)</label></th>
						<th><label>Owner's Address</label></th>
						<th><label>Kind</label></th>
						<th><label>Class</label></th>
						<!-- <th><label>Location of Property</label></th> -->
						<th><label>Market Value</label></th>
						<th><label>Assessed Value</label></th>
						<th><label>Taxability</label></th>
						<th><label>Effectivity</label></th>

					</tr>
				</thead>
				<tbody>
					<?php $arp_no = 1; ?>
					<?php foreach ($assessment_roll as $value): ?>
						
					
						<tr>
							<td class="text-capitalize"><?php echo $value->lname.', '.$value->fname.' '.$value->mname ?></td>
							<!-- <td>03-021</td> -->
							<td><?php 
							if($arp_no <100)
								echo "000".$arp_no;
							else if($arp_no >99)
								echo "00".$arp_no;

							$arp_no++;
							 ?></td>
							<td><?php echo $value->area ?></td>
							<td class="text-capitalize"><?php echo $value->address ?></td>
							<td class="text-capitalize"><?php echo $value->type_of_property ?></td>
							<td class="text-capitalize"><?php echo $value->sub_type ?></td>
							<!-- <td></?php echo $value->barangay_name ?></td> -->
							<td><?php echo number_format($value->appraised_value, 2) ?></td>
							<td><?php echo number_format($value->assessment_value, 2) ?></td>
							<td><?php echo $value->taxable == 1 ? 'T' : 'E' ?></td>
							<td><?php echo $ass_year ?></td>
						</tr>
					<?php endforeach ?>	
				</tbody>

			</table>
			</div>
		</div>
	</div>
