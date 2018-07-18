$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});
});

function MachineryMV(){
	var OC = 0, EL = 0, UL = 0, REL = 0, RCN = 0;
	OC = $('#original_cost').val();
	EL = $('#economic_life').val();
	UL = $('#used_life').val();
		

	REL = EL - UL;
	RCN = OC * (REL/EL);
	var temp = ReplaceNumberWithCommas(RCN);
	$('#machine-mv').val(temp);
	MachineryAssessment();
}

function MachineryAssessment(){
	var classification = $('#classification').val(), market_value = $('#machine-mv').val();
	var level = 0, assessed_value = 0;
	if(classification == 'residential')
		level = 50;
	else if (classification == 'industrial')
		level = 80;
	else if (classification == 'commercial')
		level = 80;
	else if (classification == 'agricultural')
		level= 80;
	var market_value1 = market_value.split(',').join('');
	assessed_value = market_value1 * (level/100);
	var a_temp = ReplaceNumberWithCommas(assessed_value);

	$('#actual_use').html(classification);
	$('#true_market_value').html(market_value);
	$('#assessment_level').html(level+'%');
	$('#assess_level').val(level);
	$('#assessed_value').html(a_temp);
	$('#assessed_value_h').val(assessed_value);
	$('#total_assessed_value').html(a_temp);
	$('#total_market_value').html(market_value);
	// alert(temp);
}


function ReplaceNumberWithCommas(number) {
  var n = number.toFixed(2).split(".");
  var num = n[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (n[1] ? "." + n[1] : "");
  // n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
  // return n.join(".");
}