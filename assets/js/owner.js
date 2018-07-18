$(document).ready(function(){
	$('#add_q').click(function(){
		$('#add_question').modal('show');
	});

	$('.update').click(function(){
	    $("#tbl_questions tr");
	    var currentRow=$(this).closest("tr");          
	    var id = currentRow.find("td:eq(0)").text(); 
	    var question = currentRow.find("td:eq(1)").text(); 
	    var answer = currentRow.find("td:eq(2)").text();

	    $('#q_id').val(id);
	    $('#u_question').val(question);
	    $('#answer_update').val(answer);
	    $('#update_question').modal('show');
	});
});