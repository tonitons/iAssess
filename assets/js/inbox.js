$(document).ready(function(){
	 $('.view').click(function(){
         // get the current row
        var btn_id = $(this).prop('id');
        $('#'+btn_id).html('Opening...');

         $("#table_inbox tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var id = currentRow.find("td:eq(0)").text(); 
         var loc = currentRow.find("td:eq(2)").text(); 
         var classifi = currentRow.find("td:eq(3)").text();
         var from=currentRow.find("td:eq(4)").text();
         var contact=currentRow.find("td:eq(5)").text(); // get current row 1st TD value
         var message=currentRow.find("td:eq(6)").text(); // get current row 2nd TD
         


         $('#location').val(loc);
         $('#type').val(classifi);
         $('#from').val(from);
         $('#contact_num').val(contact);
         // $('#message').val(message);         
         $.ajax({
            url: '/iassess/Owner/get_data_field?id='+id+'&field=visitor_message',
            type: 'get',
            beforeSend: function(){
                $('#load-message').html('<img src="../241.GIF" alt="Loading Message.. " /> &nbsp;&nbsp; Loading Message....');
            },
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                $('#message').val(data);
                $('#'+btn_id).html('View');
                $('#load-message').html('');
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


          $.ajax({
            url: '/iassess/Owner/status_read?id='+id,
            type: 'get',
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                $(currentRow).removeClass('bg-danger');
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

         $('#view_inbox').modal('show');
         //alert(data);
    });

    $('.delete').click(function(){
        $("#table_inbox tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var id = currentRow.find("td:eq(0)").text(); 
         $('#message_id').val(id);

         $('#delete').modal("show");
    });

    $('.tax-detail').click(function(){
        var modal_id = $(this).prop('id');
        // alert(modal_id);
        $(this).html('pls wait..');
        $('#'+modal_id).modal("show");
        // $(this).html('');
        $(this).html('<span class="glyphicon glyphicon-eye-open"></span>&nbsp;view')
    });

    $('.table').dataTable();
});