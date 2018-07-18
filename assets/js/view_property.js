$(document).ready(function(){
	$('input').attr('readonly', 'readonly');
	
	$('#btn_edit').click(function(){
		if($(this).html() == 'Edit'){
			$('input').attr('readonly', false);
			$(this).html('Cancel');
			$('#btn_submit').css({'display':'block'});
			$('#btn_submit').attr('disabled', false);
			$('#pin').attr('readonly', 'readonly');
		}else{
			$(this).html('Edit');
			$('#btn_submit').css({'display':'none'});
			$('#btn_submit').attr('disabled', true);
			$('input').attr('readonly', 'readonly');
			$('#pin').attr('readonly', 'readonly');
		}
		
	});
});