$(document).ready(function(){
    $('.message').click(function(){
         // get the current row
         $("#search_results tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         var currentRow=$(this).closest("tr");          
         var name=currentRow.find("td:eq(2)").text();
         var pin=currentRow.find("td:eq(0)").text(); // get current row 1st TD value         

         $('#recepient').val(name);
         $('#pin').val(pin);
        
    });
});
