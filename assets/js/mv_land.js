$(document).ready(function(){
    $('.edit_data').click(function(){
         // get the current row
         $("#tbl_mvland tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var kind=currentRow.find("td:eq(2)").text();
         var first=currentRow.find("td:eq(3)").text(); // get current row 1st TD value
         var second=currentRow.find("td:eq(4)").text(); // get current row 2nd TD
         var third=currentRow.find("td:eq(5)").text();
         var fourth=currentRow.find("td:eq(6)").text(); // get current row 3rd TD]
         var fifth=currentRow.find("td:eq(7)").text();
         var uid = currentRow.find("td:eq(0)").text();
         //var data=col1+"\n"+col2+"\n"+col3;
         first = first.split(',').join('');
         second = second.split(',').join('');
         third = third.split(',').join('');
         fourth = fourth.split(',').join('');
         fifth = fifth.split(',').join('');

         $('#u_id').val(uid);
         $('#u_kind').val(kind);
         $('#u_first').val(first);
         $('#u_second').val(second);
         $('#u_third').val(third);
         $('#u_fourth').val(fourth);
         $('#u_fifth').val(fifth);
         
         $('#update').modal('show');
         
         //alert(data);
    });

    $('#tbl_mvland').dataTable();
    $('#tbl_mvplant').dataTable();
    $('#myTab a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
    });

});
