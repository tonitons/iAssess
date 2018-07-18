$(document).ready(function(){
	$('#add_sign').click(function(){
		$('#add_signatory').modal('show');
	});	

	$('.update1').click(function(){
		$("#tbl_kinds tr");
	    var currentRow=$(this).closest("tr");          
	    var id = currentRow.find("td:eq(0)").text(); 
	    var table_name = currentRow.find("td:eq(1)").text(); 
	    var description = currentRow.find("td:eq(2)").text();
	    var no_of_classess = currentRow.find("td:eq(3)").text();

	    $('#kind_id').val(id);
	    $('#table_name').val(table_name);
	    $('#description').val(description);
	    $('#no_of_classess').val(no_of_classess);
	    $('#update_signatory1').modal('show');
	});

	$('.update2').click(function(){
		$("#tbl_signatories tr");
	    var currentRow=$(this).closest("tr");          
	    var id = currentRow.find("td:eq(0)").text(); 
	    var question = currentRow.find("td:eq(3)").text(); 
	    var answer = currentRow.find("td:eq(2)").text();

	    $('#sign_id2').val(id);
	    $('#signatory_report2').val(question);
	    $('#answer_update').val(answer);
	    $('#update_signatory2').modal('show');
	})


	$('#report_name').on('change', function(){
		var report = $(this).val();

	$.ajax({
      url: '/iassess/Site_details/countExist',
      data: {
        report_name: report
      },
      type: 'get',
      beforeSend: function(){
          $('#load').html(' &nbsp;&nbsp;checking ...');
      },
      success:function(data){
	      /*change the table content with the results retrieved from the database*/
	      if(data == 1){
	      	alert('Sorry, there is already an existing signatory for this report. Please Update the record instead.');
	      	$('#save').attr('disabled', 'disabled');
	      }
          $('#load').html('');
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
});