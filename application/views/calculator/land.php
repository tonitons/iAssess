
<div class="container">
			
	<div class="register-form">
		<div class="wow fadeInUp custom-form">
		<a class="pull-left btn btn-primary btn-sm" href="<?php echo base_url('home#calculator') ?>">BACK</a>
			<h2>Calculator <br><small>Category: Land</small></h2>
			<div class="steps">
				<ul>
					<li class="Agri" >Step 1 - Select the type of improvement you have.</li>
					<li class="Agri" >Step 2 - Enter number of trees or plants.</li>
					<li class="Agri" >Step 3 - Click 'Calculate' and wait for the reply of the site.</li>
				</ul>

			</div> <br><br><br>
			
			<div class="clearfix"></div>
				<div class="container form-signin" class="col-md-4">
					<form action="">
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Land Type</label>
							<div class=" col-md-4">
								<select name="" id="land" onchange="get_unit_value_land()" class="form-control input-lg">
									<option value="" selected disabled>-- SELECT --</option>
									<?php foreach ($market_values as $value): ?>
										<option value="<?php echo $value->rci_id ?>"><?php echo $value->kind ?></option>
									<?php endforeach ?>
								</select>
								</div>
						</div>
						
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						
			<div class="form-group">
					<div class=" col-md-8">
							<ul class="list-inline">
							    <li><a class="post-tag" id="first" href="#" data-toggle="tooltip" data-placement="top" title="" >First Class</a></li>
							    <li><a class="post-tag" id="second" href="#" data-toggle="tooltip" data-placement="top" title="">Second Class</a></li>
							    <li><a class="post-tag" id="third" href="#" data-toggle="tooltip" data-placement="top" title="" >Third Class</a></li>
							    <li><a class="post-tag" id="fourth" href="#" data-toggle="tooltip" data-placement="top" title="" >Fourth Class</a></li>
							    <li><a class="post-tag" id="fourth" href="#" data-toggle="tooltip" data-placement="top" title="">Fifth Class</a></li>
							  </ul>	
					</div>
			</div>								
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Classification</label>
							<div class=" col-md-4">
								<select name="" id="classification" onchange="get_unit_value_land()" class="form-control input-lg">
									<option value="" selected disabled>-- SELECT --</option>
									<option value="first">First Class</option>
									<option value="second">Second Class</option>
									<option value="third">Third Class</option>
									<option value="fourth">Fourth Class</option>
									<option value="fifth">Fifth Class</option>
								</select>
							</div>
						</div>
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 		
						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Base Value:</label>
							<div class=" col-md-4">
								<input type="text" readonly id="unit-value" class="form-control input-lg">
							</div>
						</div>
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	

						<div class="form-group">
							<label for="" class="control-label col-md-4 label-lg text-right">Area (sq.m.):</label>
							<div class=" col-md-4">
								<input type="number" step="any" id="area" class="form-control input-lg">
							</div>
						</div>
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	
						<br class="hidden-sm hidden-xs"> 	

						
						<div class="form-group col-md-4 center col-md-push-4">
							<a href="#" onclick="Calculate_Appraisal_land()" class="btn btn-primary form-control">CALCULATE</a>
						</div>
					</form>
<br><br><br>



  


<script>
$(document).ready(function(){
       
    // alert($('#f_c_land').html());
    $('#first').hover(function(){
    	if($('#land').val() == 'Land_Com'){
    		$('[data-toggle="tooltip"]').tooltip();
    		$('#first').attr('title', $('#firstcom').html());

    	}
    else if($('#land').val() == 'Land_Ind'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#first').attr('title', $('#firstind').html());
		   }
	else if($('#land').val() == 'Land_Res'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#first').attr('title', $('#firstres').html());
		   }
    });

    $('#second').hover(function(){
    	if($('#land').val() == 'Land_Com'){
    		$('[data-toggle="tooltip"]').tooltip();
    		$('#second').attr('title', $('#secondcom').html());
    	}
    else if($('#land').val() == 'Land_Ind'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#second').attr('title', $('#secondind').html());
		   }
	else if($('#land').val() == 'Land_Res'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#second').attr('title', $('#secondres').html());
		   }
    });

	$('#third').hover(function(){
    	if($('#land').val() == 'Land_Com'){
    		$('[data-toggle="tooltip"]').tooltip();
    		$('#third').attr('title', $('#thirdcom').html());
    	}
    else if($('#land').val() == 'Land_Ind'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#third').attr('title', $('#thirdind').html());
		   }
	else if($('#land').val() == 'Land_Res'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#third').attr('title', $('#thirdres').html());
		   }

    });

	$('#fourth').hover(function(){
    	if($('#land').val() == 'Land_Com'){
    		$('[data-toggle="tooltip"]').tooltip();
    		$('#fourth').attr('title', $('#fourthcom').html());
    	}
    else if($('#land').val() == 'Land_Ind'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#fourth').attr('title', $('#fourthind').html());
		   }
	else if($('#land').val() == 'Land_Res'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#fourth').attr('title', $('#fourthres').html());
		   }
    });

	$('#fifth').hover(function(){
    	if($('#land').val() == 'Land_Com'){
    		$('[data-toggle="tooltip"]').tooltip();
    		$('#fifth').attr('title', $('#fifthcom').html());
    	}
    else if($('#land').val() == 'Land_Ind'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#fifth').attr('title', $('#fifthind').html());
		   }
	else if($('#land').val() == 'Land_Res'){
		    $('[data-toggle="tooltip"]').tooltip();
		    $('#fifth').attr('title', $('#fifthres').html());
		   }
    });






});
</script>

				
					<div class="col-md-11" style="font-size:18px;">

<div class="hidden">
A. COMMERCIAL LANDS

<p id="firstcom"> 
I. FIRST CLASS COMMERCIAL LANDS	
 
a) Located along concrete road; 
 
b) Where the highest trading, social (or educational activities of the City / Municipality take place); 
 
c) Where concrete or high grade commercial or business buildings are situated; 
 
d) Where vehicular and pedestrian traffic flow are exceptionally busy; 
 
e) Apparently commands the highest commercial land value in the city or municipality. 
 </p>
 </div>

<div class="hidden"> 
<p id="secondcom">
II. SECOND CLASS COMMERCIAL LANDS – 
 
a) Along concrete or asphalted road; 
 
b) Where trading, social (or educational) activities are considerably high, but fall short from that of the First Class Commercial Lands; 
 
c) Where semi-concrete commercial or business buildings are situated; 
 
d) Where vehicular and pedestrian traffic flow are considerably busy, but fall short from that of the First Class Commercial Lands; 
 
e) Commands lesser value than the First Class Commercial Lands 
</p>
</div>
<div class="hidden">
 <p id="thirdcom"> III. THIRD CLASS COMMERCIAL LANDS – 
 
a) Along  concrete or asphalted road; 
 
b) Where trading, social (or educational) activities are significantly less than the Second Class Commercial Lands; 
 
c) Where average grade commercial or business buildings are situated; 
 
d) Where vehicular and pedestrian traffic follow are fairly busy; 
 
e) Commands lesser value than the Second Class Commercial Lands. 
 </p>
 </div>
 
 <div class="hidden">
<p id="fourthcom">IV. FOURTH CLASS COMMERCIAL LANDS – 
 
a) Along all weather road; 
 
b) Where trading, social (or educational) activities are significantly low but predominant; 
 
c) Where mixed Commercial and Residential buildings are situated; 
 
d) Where vehicular and pedestrian traffic flow are regularly less busy; 
 
e) Commands lesser value than the Third Class Commercial Lands. 
</p>
</div>

<div class="hidden">
B. RESIDENTIAL LANDS 

<p id="firstres">
 
I. FIRST CLASS RESIDENTIAL LANDS – 
a) Along concrete road; 
 
b) Where high grade apartment or residential buildings are predominantly situated; 
 
c) Where public utility transportation facilities are exceptionally regular towards major trading centers; 
 
d) Located next to a commercially classified lands; 
 
e) Where water, electric, and telephone facilities are available; 
 
f) Commands the highest residential land value in the city / municipality; 
 
g) Free from squatters.

</p>
</div>
<p id="secondres">

<div class="hidden">

II. SECOND CLASS RESIDENTIAL LANDS – 
 
a) Along concrete or asphalted road; 
  
b) Where semi-high grade apartments or residential buildings are predominantly situated. 
 
c) Where public utility transportation facilities are fairly regular towards major trading centers; 
 
d) Located next to First Class Residential Lands; 
 
e) Where public utility transportation facilities are fairly regular towards major trading centers; 
 
f) Commands lesser value than the First Class Residential Lands 
 
g) Free from Squatters.
</div>
</p> 
<p id="thirdres">
<div class="hidden">
 
 III. THIRD CLASS RESIDENTIAL LANDS – 
 
a) Along all-weather road; 
 
b) Where average grade residential buildings are predominantly situated; 
 
c) Where public utility transportation facilities are regular towards major trading centers; 
 
d) Located next to Second Class Residential Lands; 
 
e) Where water and electric facilities are available; 
 
f) Commands lesser value than Second Class Residential Lands. 
 </div>
 </p>
<p id="fourthres">
<div class="hidden">
IV. FOURTH CLASS RESIDENTIAL LANDS – 
 
a) Along all-weather road; 
 
b) Where low-grade residential buildings are predominantly situated; 
 
c) Located next to Third Class Residential Lands; 
 
d) Where public Utility transportation facilities are irregular; 
 
e) Where water facilities are commonly pump wells; 
 
f) Commands Lesser value than Third Class Residential Lands. 
</div>
</p>

<p id="fifthres">
<div class="hidden">
V. FIFTH CLASS RESIDENTIAL LANDS – 
 
a) Along all-weather road; 
 
b) Where residential Buildings are still scarcely constructed; 
 
c) Where public water and electric facilities are readily available; 
 
d) Farthest residential lands from the trading centers; 
 
e) Transportation Facilities are exceptionally irregular; 
 
f) Predominantly undeveloped residential area. 
</div>
</p>

<p id="firstind">
<div class="hidden">
B. INDUSTRIAL LANDS 
 
I. FIRST CLASS INDUSTRIAL LANDS – 
 
a)   Along concrete or asphalted road; 
 
b) Located within a distance of not more than 10,000 meters to the major trading centers of the city / municipality; 
 
c) Where the vicinity is extensively used for industrial purposes; 
 
d) Commands the highest industrial land value in the city / municipality. 
 </div>
 </p>
<p id="secondind">
<div class="hidden">
II. SECOND CLASS INDUSTRIAL LANDS - 
 
a)  Along concrete or asphalted public road, pier, seacoast, or navigable river; 
 
b) Located Within a distance of more than 10,000 meters but not beyond 50,000 meters to the major trading centers of the city / municipality; 
 
c) Where the vicinity is extensively used for industrial purposes; 
 
d) Commands lesser land value than first class Industrial Lands. 
 </div>
 </p>
<p id="thirdind">
<div class="hidden">
III. THIRD CLASS INDUSTRIAL LANDS 
 
a) Located more than 50,000 meters to the major trading centers of the city or municipality; 
 
b) Where the vicinity is extremely used for industrial purposes; 
 
c) Commands lesser land value than Second Class Industrial Lands.
</div>
</p> 
				</div>
		</div>

					
				</div>
			
	</div>
</div>

<!--########################################### START REVISION MODAL ###########################################-->

<div id="market-value-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myLoginLabel">THE CALCULATION</h4>
      	</div>
      	<div class="modal-body">
      		<table class="table">
      			<tr>
      				<td class="Agri" >Type of Land</td>
      				<td class="Agri"  id="type-input"></td>
      				
      			</tr>
      			<tr>
      				<td class="Agri" >Classification</td>
      				<td class="Agri"  id="class-input"></td>
      			</tr>
      			<tr>
      				<td class="Agri" >Base Value</td>
      				<td class="Agri"  id="base-value"></td>
      			</tr>
      			<tr>
      				<td class="Agri" >Area (sq.m.)</td>
      				<td class="Agri"  id="area-input"></td>
      			</tr>
      			<tr>
      				<td class="Agri" ></td>
      				<td class="Agri"  id="show-calc"></td>
      			</tr>
      			<tr class="bg-primary ">
      				<td class="Agri" ><span style="font-size:20px">ESTIMATED VALUE</span></td>
      				<td class="Agri" >P&nbsp;&nbsp;<span id="adjusted-market-value" style="font-size:20px"></span></td>
      				
      			</tr>
      		</table>
      	</div>
      	<div class="modal-footer">
      		<!-- <a href="#" class="btn btn" id="close" data-target="#increase">Cancel</a> -->
        	<button type="submit" id="save" data-dismiss="modal" data-target="market-value-modal" class="btn btn"><span class="glyphicon glyphicon-check"></span>  <span>OK</span></button>
      	</div>
      	
    </div>
  </div>
</div>
<!--###########################################END REVISION MODAL###########################################-->