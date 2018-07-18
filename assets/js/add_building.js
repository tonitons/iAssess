$(document).ready(function(){
	$('#select_build_type').on("change", function(){
		var building_type = $(this).val();
			// $(this).attr('selected', 'selected');
			$('#sub_class').val(building_type);
		$.ajax({
            url: '/iassess/Admin/get_building_value',
            type: 'get',
            data:{
            	sbuv_id: building_type
            },
            beforeSend:function(){
            	$('#loader').html('<img alt="loader.gif" src="../../loader2.gif"/> Getting value.. ')
            },
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                $('#building_value').val(data);
                $('#loader').html('')
            },
            error:function(e, xhr){
                alert('error '+ e.errorCode+xhr.errorCode)
            },
            statusCode: {
                404: function() {
                    alert("page not found");
                }
            }
        });

	});

	//CATEOGRY INI DINI
	$('#category').on("change", function(){
		var category = $(this).val();
		var t = $('#adjusted_market_value').val();
		var adjusted_market_value = t.split(',').join('');
		var assessment_level=0, assessed_value=0, replace=0;

		if(category == 'residential'){
			if(adjusted_market_value <= 175000) assessment_level=0;
			else if(adjusted_market_value >=175000 && adjusted_market_value<300000) assessment_level = 10;
			else if(adjusted_market_value >=300000 && adjusted_market_value<500000) assessment_level = 20;
			else if(adjusted_market_value >=500000 && adjusted_market_value<750000) assessment_level = 25;
			else if(adjusted_market_value >=750000 && adjusted_market_value<1000000) assessment_level = 30;
			else if(adjusted_market_value >=1000000 && adjusted_market_value<2000000) assessment_level = 35;
			else if(adjusted_market_value >=2000000 && adjusted_market_value<5000000) assessment_level = 40;
			else if(adjusted_market_value >=5000000 && adjusted_market_value<10000000) assessment_level = 50;
			else assessment_level = 60;
		}else if(category == 'agricultural'){
			if(adjusted_market_value < 300000) assessment_level = 20;
			else if(adjusted_market_value >=300000 && adjusted_market_value<500000) assessment_level = 30;
			else if(adjusted_market_value >=5000000 && adjusted_market_value<750000) assessment_level = 35;
			else if(adjusted_market_value >=750000 && adjusted_market_value<1000000) assessment_level = 40;
			else if(adjusted_market_value >=1000000 && adjusted_market_value<2000000) assessment_level = 45;
			else assessment_level = 50;
		}else if(category == 'commercial' || category == 'industrial'){
			if(adjusted_market_value <= 300000) assessment_level=30;
			else if(adjusted_market_value >=300000 && adjusted_market_value<500000) assessment_level = 35;
			else if(adjusted_market_value >=500000 && adjusted_market_value<750000) assessment_level = 40;
			else if(adjusted_market_value >=750000 && adjusted_market_value<1000000) assessment_level = 50;
			else if(adjusted_market_value >=1000000 && adjusted_market_value<2000000) assessment_level = 60;
			else if(adjusted_market_value >=2000000 && adjusted_market_value<5000000) assessment_level = 70;
			else if(adjusted_market_value >=5000000 && adjusted_market_value<10000000) assessment_level = 75;
			else assessment_level = 60;
		}

		$('#actual_use').html(category);
		$('#true_market_value').html(t);
		$('#assessment_level').html(assessment_level+'%');
		$('#assess_level').val(assessment_level);
		assessed_value = adjusted_market_value*(assessment_level/100);
		$('#assessed_value_h').val(assessed_value);

		replace = ReplaceNumberWithCommas(assessed_value);
		$('#assessed_value').html(replace);
		$('#total_market_value').html(t);
		$('#total_assessed_value').html(replace);
	});


	$('#list_building').dataTable();
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});

});

function calculateMVBuilding(input){
	var building_value = $('#building_value').val();
	var base_market_value;

	base_market_value = building_value*input;
	var num = ReplaceNumberWithCommas(base_market_value);
	$('#base_market_value').val(num);
}

function depreciation(input) {
	var economic_life = $('#economic_life').val();

	var building_type = $('#select_build_type >option:selected').prop('id');
	var depreciation_rate = 0.0;
	// alert(building_type);
	if(building_type == 'I-A' && input <= 5) depreciation_rate = 1.8;
	else if(building_type == 'I-A' && input >=6 && input <= 10) depreciation_rate = 1.4;
	else if(building_type == 'I-A' && input >=11 && input <= 15) depreciation_rate = 1.2;
	else if(building_type == 'I-A' && input >=16 && input <= 20) depreciation_rate = 1.0;
	else if(building_type == 'I-A' && input >=21) depreciation_rate = 1.0;
	else if(building_type == 'I-B' && input <=5) depreciation_rate = 2.0;
	else if(building_type == 'I-B' && input >=6 && input <= 10) depreciation_rate = 1.8;
	else if(building_type == 'I-B' && input >=11 && input <= 15) depreciation_rate = 1.5;
	else if(building_type == 'I-B' && input >=16 && input <= 20) depreciation_rate = 1.2;
	else if(building_type == 'I-B' && input >=21) depreciation_rate = 1.0;
	else if(building_type == 'I-C' && input <=5) depreciation_rate = 2.2;
	else if(building_type == 'I-C' && input >=6 && input <= 10) depreciation_rate = 2.0;
	else if(building_type == 'I-C' && input >=11 && input <= 15) depreciation_rate = 1.7;
	else if(building_type == 'I-C' && input >=16 && input <= 20) depreciation_rate = 1.3;
	else if(building_type == 'I-C' && input >=21) depreciation_rate = 1.1;
	else if(building_type == 'II-A' || building_type == 'II-B' && input <=5) depreciation_rate = 2.4;
	else if(building_type == 'II-A' || building_type == 'II-B' && input >=6 && input <= 10) depreciation_rate = 2.2;
	else if(building_type == 'II-A' || building_type == 'II-B' && input >=11 && input <= 15) depreciation_rate = 2.0;
	else if(building_type == 'II-A' || building_type == 'II-B' && input >=16 && input <= 20) depreciation_rate = 1.7;
	else if(building_type == 'II-A' || building_type == 'II-B' && input >=21) depreciation_rate = 1.4;
	else if(building_type == 'II-C' || building_type == 'II-D' && input <=5) depreciation_rate = 2.6;
	else if(building_type == 'II-C' || building_type == 'II-D' && input >=6 && input <= 10) depreciation_rate = 2.3;
	else if(building_type == 'II-C' || building_type == 'II-D' && input >=11 && input <= 15) depreciation_rate = 2.2;
	else if(building_type == 'II-C' || building_type == 'II-D' && input >=16 && input <= 20) depreciation_rate = 2.0;
	else if(building_type == 'II-C' || building_type == 'II-D' && input >=21) depreciation_rate = 1.6;
	else if(building_type == 'III-A' || building_type == 'III-B' && input <=5) depreciation_rate = 4.0;
	else if(building_type == 'III-A' || building_type == 'III-B' && input >=6 && input <= 10) depreciation_rate = 3.6;
	else if(building_type == 'III-A' || building_type == 'III-B' && input >=11 && input <= 15) depreciation_rate = 3.2;
	else if(building_type == 'III-A' || building_type == 'III-B' && input >=16 && input <= 20) depreciation_rate = 3.0;
	else if(building_type == 'III-A' || building_type == 'III-B' && input >=21) depreciation_rate = 2.5;
	else if(building_type == 'III-C' || building_type == 'III-D' && input <=5) depreciation_rate = 4.0;
	else if(building_type == 'III-C' || building_type == 'III-D' && input >=6 && input <= 10) depreciation_rate = 3.5;
	else if(building_type == 'III-C' || building_type == 'III-D' && input >=11 && input <= 15) depreciation_rate = 3.0;
	else if(building_type == 'III-C' || building_type == 'III-D' && input >=16 && input <= 20) depreciation_rate = 2.5;
	else if(building_type == 'III-C' || building_type == 'III-D' && input >=21) depreciation_rate = 2.0;
	else if(building_type == 'III-E' && input <=5) depreciation_rate = 3.0;
	else if(building_type == 'III-E' && input >=6 && input <= 10) depreciation_rate = 2.5;
	else if(building_type == 'III-E' && input >=11 && input <= 15) depreciation_rate = 2.5;
	else if(building_type == 'III-E' && input >=16 && input <= 20) depreciation_rate = 2.0;
	else if(building_type == 'III-E' && input >=21) depreciation_rate = 2.0;
	else if(building_type == 'IV' && input <=5) depreciation_rate = 2.6;
	else if(building_type == 'IV' && input >=6 && input <= 10) depreciation_rate = 2.3;
	else if(building_type == 'IV' && input >=11 && input <= 15) depreciation_rate = 2.2;
	else if(building_type == 'IV' && input >=16 && input <= 20) depreciation_rate = 2.0;
	else if(building_type == 'IV' && input >=21) depreciation_rate = 1.6;
		
	var t = $('#base_market_value').val();
	var base_market_value = t.split(',').join('');
	var dep_cost;
	var adjusted_market_value;

	dep_cost = base_market_value*(depreciation_rate/100);
	var num = ReplaceNumberWithCommas(dep_cost);
	adjusted_market_value = base_market_value-dep_cost;
	var adj = ReplaceNumberWithCommas(adjusted_market_value);

	$('#depreciation_cost').val(num);
	$('#depreciation_rate').val(depreciation_rate);
	// $('#percent_depreciation').val((input/economic_life).toFixed(2));
	$('#adjusted_market_value').val(adj);
	
}

function ReplaceNumberWithCommas(number) {
  var n = number.toFixed(2).split(".");
  var num = n[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (n[1] ? "." + n[1] : "");
  // n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
  // return n.join(".");
}