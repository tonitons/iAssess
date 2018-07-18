$(document).ready(function(){
	$('#location-adj').on("change", function(){
		var location = $(this).val();
		var loc = $('#location-adj >option:selected').prop('id');
		// var 
		// alert(loc);
		if(loc == 'L0-1' || loc == 'L1-3'){
			$('#classif').val('First Class');
			$('#classification').val('first');
			get_unit_value();
		}else if(loc == 'L3-6' || loc == 'L6-9'){
			$('#classif').val('Second Class');
			$('#classification').val('second');
			get_unit_value();
		}else{
			$('#classif').val('Third Class');
			$('#classification').val('third');
			get_unit_value();
		}
	});
});

function Calculate_Appraisal() {
	var road_adj = $('#road-adj :selected').val(),
		loc_adj = $('#location-adj').val(),
		unit_value = $('#unit-value').val(),
		area = $('#land-area').val();
		unit_value = unit_value.split(',').join('');
		var adj = eval(road_adj+loc_adj);
		// alert(adj);
		var market_value = unit_value*area,
			adjustment = market_value * (adj/100),
			AMV = 0.0;

		var num = ReplaceNumberWithCommas(market_value);
			// num1 = ReplaceNumberWithCommas(adjustment);
        // $('#total-final-adjusted-mv').val(num);
		 // alert(num + '=== ' + adjustment);
		 $('#type-input').html($('#agri_class :selected').text());
		 $('#class-input').html($('#classification :selected').text());
		 $('#road-adj-input').html(road_adj);
		 $('#road-input').html($('#road-adj :selected').text());
		 $('#location-adj-input').html(loc_adj);
		 $('#location-input').html($('#location-adj :selected').text());
		 $('#percent').html(adj);
		 $('#market-value').html(num);
		 $('#adjustment-value').html(adjustment.toFixed(2));
		 $('#show-calc').html(unit_value+' x '+area);
		 $('#show-adjust').html(num+' x '+ (adj/100));
		 // if(adj < 0){
		 	 AMV = market_value + adjustment;
		 // }else{
		 	 // AMV = market_value + adjustment;
		 // }
		 	num = ReplaceNumberWithCommas(AMV);
		 $('#adjusted-market-value').html(num);
		
		$('#market-value-modal').modal('show');
	
}

function get_unit_value(){
   
   var agri_land = $('#agri_class :selected').val();
   var sub_class = $('#classification').val();
   // alert(agri_land+'9'+sub_class);
   $.ajax({
      url: '/iassess/Admin/get_calculator_unit_value?agri_land='+agri_land+'&sub_class='+sub_class,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#unit-value').val(data);
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
   // alert(agri_land+sub_class);
}


function ReplaceNumberWithCommas(number) {
  var n = number.toFixed(2).split(".");
  var num = n[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (n[1] ? "." + n[1] : "");
  // n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
  // return n.join(".");
}