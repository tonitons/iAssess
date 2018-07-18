$(document).ready(function(){
     
	 $('.view').click(function(){
         // get the current row
         $("#tbl_inbox tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var id = currentRow.find("td:eq(0)").text(); 
         var from = currentRow.find("td:eq(1)").text(); 
         var contact = currentRow.find("td:eq(2)").text(); 
         var subject = currentRow.find("td:eq(3)").text(); 
         var o_id = currentRow.find("td:eq(7)").text(); 

         // var name = currentRow.find("td:eq(0)").text(); 
         // alert(nfromame);
         $('#owner_name').val(from);
         $('#owner_id').val(o_id);
        
         $('#from').val(from);
         $('#contact_num').val(contact);
         $('#subject').val(subject);
         // $('#message').val(message);         
         $.ajax({
            url: '/iassess/Admin/get_data_field?id='+id+'&field=f_c',
            type: 'get',
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                $('#message').val(data);
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
            url: '/iassess/Admin/status_read?id='+id,
            type: 'get',
            success:function(data){
                /*change the table content with the results retrieved from the database*/
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
        $("#tbl_inbox tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var id = currentRow.find("td:eq(0)").text(); 
         $('#fb_id').val(id);

         $('#delete').modal("show");
    });

    $('.reply').click(function(){
        $("#tbl_inbox tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         
        $('#view_inbox').modal('hide');
         $('#reply-modal').modal("show");
    });

    $('.table').dataTable();
});