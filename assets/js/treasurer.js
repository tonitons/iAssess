$(document).ready(function(){
  $('#search_btn').click(function(){
    $('#owner_results').html('<br><p style="font-family: segoe;font-size:18px;text-align:center">Start typing your search query on the textbox.</p>');
    $('#search_owner').modal('show');
    $('#input-search').val('');
    $('#input-search').attr('autofocus', 'autofocus');
  });

  $('.select').click(function(){
    $("#owner_results tr");
    var currentRow=$(this).closest("tr");          
    var id = currentRow.find("td:eq(0)").text(); 
    var ownername = currentRow.find("td:eq(1)").text(); 
    var address = currentRow.find("td:eq(2)").text(); 
    var contact = currentRow.find("td:eq(3)").text();
     var propertytype = currentRow.find("td:eq(4)").text();
     var location = currentRow.find("td:eq(5)").text();
     var tax_dec = currentRow.find("td:eq(6)").text();
     // var ben_add = currentRow.find("td:eq(7)").text();
     // var ben_tel = currentRow.find("td:eq(8)").text();
    // alert(id);
    $('#pin').val(id);
    $('#owner_name').val(ownername);
    $('#propertytype').val(propertytype);
    $('#location').val(location);
    $('#tax_dec').val(tax_dec);
    //connect to datase to get payment data
    $.ajax({
      url: '/iassess/Treasurer/getTaxAmount',
      data: {
        pin: id
      },
      type: 'get',
      beforeSend: function(){
          $('#owner_results').html('<br><p style="font-family: segoe;font-size:18px;text-align:center"><img alt="loader.gif" src="241.GIF"/>Please wait... Searching for your entry.. :)</p>');
      },
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#tax-yearly').html('');
          $('#tax-yearly').html(data);
          // alert(data);
          //$('#search_owner').modal('hide');
        $('#owner_results').html('<br><p style="font-family: segoe;font-size:18px;text-align:center"><img alt="check.gif" src="smallSuccess.gif"/>&nbsp;&nbsp;Searching complete, please close this window. </p>');
          // alert(data);
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

  $('#quarterly').click(function(){
    var t = $('#amount_due').val();
    var total = t.split(',').join('');
    if(!$('#amount_due').val() == ''){
      
      if(confirm('Proceed?\nAre you sure to continue this action?')){
          var dtoday = $('#datetoday').val();
          var date = dtoday.split('-').join('');
          var year = dtoday.substring(0,4);
          var firstquarter = year+'0331';
          // alert(firstquarter);
          if(date > firstquarter){ 
            alert('Sorry quartely payment is not available, it already exceeds the first quarter of the year.\nOne time payment (yearly) is suggested.');
            $(this).attr('readonly', 'readonly');
            $('#yearly').attr('checked', 'checked');
          }
          else{
            //var total = parseFloat();
            //alert(total);
            var firstquarter = total/4;
            var num = ReplaceNumberWithCommas(firstquarter);
            // alert(num);
            $('#amount_due').val(num);
            $('#quarterly-data').html('');
            $('#quarterly-data').html('<div class="col-sm-5 label-column"><label class="control-label" for="name-input-field">Tax Amount (Payable):</label></div><div class="col-sm-6 input-column"><input class="form-control" type="text" id="quarter-tax"></div></div><div class="col-sm-5 label-column"><label class="control-label" for="name-input-field">Quarter:</label></div><div class="col-sm-6 input-column"><input class="form-control" type="text" value="First Quarter"></div>');
            $('#quarter-tax').val(num);
            $(this).attr('readonly', 'readonly');
          }
      }
    }else{
      alert('Search for owner first before you proceed.');
    }
    // $('#show-loader').html('<br><p style="text-align:center"><img alt="loader.gif" src="241.GIF"/>&nbsp;&nbsp;Please wait... Loading form for yearly payment.. :)</p>');
    // $('#prepend-data').prepend('hala ka daw!');
    // $('#show-loader').html('');
    
  });

   $('#myTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
      $(this).removeClass('sad').addClass('sad');
   });

   $('#myTab li').click(function (e) {
      // e.preventDefault()
      // $(this).tab('show');
      $(this).removeClass('sad').addClass('sad').css({'border':'2px solid black'});
   });

   $('.exclude').click(function(e){
    e.preventDefault();
      if(confirm("Are you sure to exclude this year's tax payment?")){
        var amount = $('#amount_due').val(),
            tax_year = $('#tax_this_year').val(),
            amount_due = amount.split(',').join(''),
            tax_this_year = tax_year.split(',').join('');

        $('#amount_due').val(eval(amount_due - tax_this_year));
        $('#tax-this-year-container').remove();
        $('#hid_tax_this_year').val(0);
        $('#modal_this_year_tax').modal('hide');
        alert('Removed!');

      }
   });

   $('#full_payment').dataTable();
   $('#partial_payment').dataTable();
   $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
   });
});

function searchOwner(name){
  $.ajax({
      url: '/iassess/Treasurer/searchOwner?name='+name,
      type: 'get',
      beforeSend: function(){
          $('#owner_results').html('<br><p style="font-family: segoe script;font-size:18px;text-align:center"><img alt="loader.gif" src="241.GIF"/>&nbsp;&nbsp;Please wait... Searching for your entry.. :)</p>');
      },
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#owner_results').html(data);
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

function calculateChange(){
  // alert(input);
  var t = $('#amount_due').val();
  var a_r = parseFloat($('#amount_received').val());
  var tax = t.split(',').join('');
  var dec = tax.substr(tax.lastIndexOf('.'));
  if(dec == '.00'){
    dec = tax.split('.');
    tax = dec[0];
  }
  // alert(tax);
  var change=0.00;
  // alert(tax);
  if(!a_r.isNan && a_r >= tax ){
    change = eval(a_r - parseFloat(tax));
  }else{
    change = -1; 
    $('#en_save').attr('disabled', 'disabled');
  }
  if(change >= 0.00)
    $('#en_save').removeAttr('disabled');
  // change = $('#change').val() == '0.00' ? 

  $('#change').val(change >= '0.00' ? change.toFixed(2): 'Invalid Amount');
}

function ReplaceNumberWithCommas(number) {
  var n = number.toFixed(2).split(".");
  var num = n[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (n[1] ? "." + n[1] : "");
  // n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
  // return n.join(".");
}