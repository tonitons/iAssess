$(document).ready(function(){
	 $('.edit_data_building').click(function(){
         // get the current row
         $("#tbl_building tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr"); 
         var uid = currentRow.find("td:eq(0)").text();         
         var building_type=currentRow.find("td:eq(2)").text();
         var name_building=currentRow.find("td:eq(3)").text(); // get current row 1st TD value
         var value=currentRow.find("td:eq(4)").text(); // get current row 2nd TD
         value = value.split(',').join('');
         $('#u_building_type').val(building_type);
         $('#u_name_building').val(name_building);
         $('#u_value').val(value);         
         $('#u_id').val(uid);
         $('#update').modal('show');
         //alert(data);
    });

    $('#tbl_building').dataTable();
    
});
function check_id(type, name){
	var sbuv_id = type+'-'+name;
	$('#sbuv_id').val(sbuv_id);
}