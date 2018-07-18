
function Calculate_Appraisal() {
	var imp = $('#improvement :selected').text(),
		unit_value = $('#unit-value').val(),
		num_trees = $('#number-trees').val();
		unit_value = unit_value.split(',').join('');
		var market_value = unit_value*num_trees;

		var num = ReplaceNumberWithCommas(market_value);
			// num1 = ReplaceNumberWithCommas(adjustment);
        // $('#total-final-adjusted-mv').val(num);
		 // alert(num + '=== ' + adjustment);
		 $('#imp-input').html(imp);
		 $('#number-input').html(num_trees);
		 $('#base-value').html(unit_value);
		 $('#adjusted-market-value').html(num);
		$('#show-calc').html(unit_value+' x '+num_trees);
		$('#market-value-modal').modal('show');
	
}


function Calculate_Appraisal_land() {
	var land = $('#land :selected').text(),
		classification = $('#classification :selected').text(),
		unit_value = $('#unit-value').val(),
		area = $('#area').val();
		unit_value = unit_value.split(',').join('');
		var market_value = unit_value*area;

		var num = ReplaceNumberWithCommas(market_value);
			// num1 = ReplaceNumberWithCommas(adjustment);
        // $('#total-final-adjusted-mv').val(num);
		 // alert(num + '=== ' + adjustment);
		 $('#type-input').html(land);
		 $('#class-input').html(classification);
		 $('#base-value').html(unit_value);
		 $('#area-input').html(area);
		 $('#adjusted-market-value').html(num);
		$('#show-calc').html(unit_value+' x '+area);
		$('#market-value-modal').modal('show');
	
}

function get_unit_value(){
   
   var plant_id = $('#improvement :selected').val();
   
   // alert(agri_land+'9'+sub_class);
   $.ajax({
      url: '/iassess/Admin/improve_calculator_unit_value?plant_id='+plant_id,
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

function get_unit_value_land(){
   
   var id = $('#land :selected').val(),
   		land_class = $('#classification :selected').val();

   
   // alert(agri_land+'9'+sub_class);
   if(land_class != ''){
	   $.ajax({
	      url: '/iassess/Admin/get_lands?id='+id+'&land_class='+land_class,
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
	}
   // alert(agri_land+sub_class);
}


function ReplaceNumberWithCommas(number) {
  var n = number.toFixed(2).split(".");
  var num = n[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (n[1] ? "." + n[1] : "");
  // n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
  // return n.join(".");
}