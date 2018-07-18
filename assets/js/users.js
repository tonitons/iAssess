$(document).ready(function(){
	$('.deactivate').click(function(){
		 $("#tbl_user tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var user=currentRow.find("td:eq(0)").text();
         $('#text_action').html('');
         $('#text_action').html('deactivate');
         $('#action').val('deactivate');
         $('#user').val(user);
	});
	$('.activate').click(function(){
		 $("#tbl_user tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var user=currentRow.find("td:eq(0)").text();
         $('#text_action').html('');
         $('#text_action').html('activate');
         $('#action').val('activate');
         $('#user').val(user);
	});

   $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show');
      $(this).removeClass('sad').addClass('sad');
   });

   $('#myTab li').click(function (e) {
      // e.preventDefault()
      // $(this).tab('show');
      $(this).removeClass('sad').addClass('sad').css({'border':'2px solid black'});
   });

   $('.change_role').click(function(){
    $("#tbl_staff tr");
    var currentRow=$(this).closest("tr");          
    var id = currentRow.find("td:eq(0)").text(); 
    var name = currentRow.find("td:eq(3)").text(); 
    
    // alert(id);

    $('#staff-id').val(id);
    $('#full-name').val(name);
    
  });

   $('.table').dataTable();
   // $('#tbl_user').dataTable();
   

});
function searchUser(skey) {
  $.ajax({
        url: '/iassess/User/search?skey='+skey,
        type: 'get',
        beforeSend: function(){
          $('#tbl_user').html('<img alt="loader.gif" src="../loader2.gif"/><p>Please wait... Searching for your entry.. :)</p>');
        },
        success:function(data){
            /*change the table content with the results retrieved from the database*/
            $('#tbl_user').html(data);
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