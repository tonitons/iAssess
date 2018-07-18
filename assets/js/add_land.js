$(document).ready(function(){
  $('.select').click(function(){
    $("#owner_results tr");
    var currentRow=$(this).closest("tr");          
    var id = currentRow.find("td:eq(0)").text(); 
    var fname = currentRow.find("td:eq(1)").text(); 
    var mname = currentRow.find("td:eq(2)").text(); 
    var lname = currentRow.find("td:eq(3)").text();
     var address = currentRow.find("td:eq(4)").text();
     var contact = currentRow.find("td:eq(5)").text();
     var beneficial = currentRow.find("td:eq(6)").text();
     var ben_add = currentRow.find("td:eq(7)").text();
     var ben_tel = currentRow.find("td:eq(8)").text();
    // alert(id);

    $('#owner_id').val(id);
    $('#fname').val(fname);
    $('#mname').val(mname);
    $('#lname').val(lname);
    $('#address').val(address);
    $('#contact-num').val(contact);
    $('#beneficial').val(beneficial);
    $('#ben_add').val(ben_add);
    $('#ben_tel').val(ben_tel);
    $('#owner_results').html('<br><p style="font-family: segoe script;font-size:18px;text-align:center"><img alt="loader.gif" src="../../smallSuccess.gif"/>&nbsp;Searching complete. Please close tis window :)</p>');
  });
    $('#classification').select(function(){
         // get the current row
         $("#tbl_mvland tr");
         // $(this).addClass('selected').siblings().removeClass('selected');   
         // selected();
        
         //alert(data);
    });
   
    $('#add_row').click(function(){
      $.ajax({
            url: '/iassess/Admin/get_improvements',
            type: 'get',
            success:function(data){
                /*change the table content with the results retrieved from the database*/
                $('#tbl_improvements tbody').append(data);
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

    $('#calculate').click(function(){
      var land_bv = $('#total-mv').text();
      var improve_bv = $('#total-improvement-mv-con').text();
      // alert(improve_bv);
      var totalfamv = 0.00;
      // alert(land_bv+improve_bv);
      $('#land-base-value').val(land_bv);
      $('#adjusted-land-market-value').val(land_bv);
      // if(improve_bv != '.00'){
        if(improve_bv != '.00'){
          $('#improvement-base-value').val(improve_bv);
          $('#adjusted-imp-market-value').val(improve_bv);
        }
        var almv = $('#adjusted-land-market-value').val();
        var aimv = $('#adjusted-imp-market-value').val();
      // }
      if($('#classification :selected').val() != 'agricultural' ){
         $.ajax({
          url: '/iassess/Admin/calculate_adjusted_marketvalue?land='+almv+'&imp='+aimv,
          type: 'get',
          success:function(data){
              /*change the table content with the results retrieved from the database*/
              $('#total-final-adjusted-mv').val(data);

              var total = $('#total-final-adjusted-mv').val();
              // var tfamv = $('#total-final-adjusted-mv').val();
              //call function to calculate property assessment
              // total = total.split(',').join('');
              
              // var num = ReplaceNumberWithCommas(total);
              property_assessment($('#classification :selected').val(), data);

          }
          });
          // $('#total-final-adjusted-mv').val(total);
        
      }else{

              var land_tot = $('#adjusted-land-market-value').val();
              var imp_tot = $('#adjusted-imp-market-value').val();
              land_tot = land_tot.split(',').join('');
              imp_tot = imp_tot.split(',').join('');
              if(imp_tot == '')
              imp_tot = 0.0; 
              var total = parseFloat(land_tot) + parseFloat(imp_tot);
              var num_commas = ReplaceNumberWithCommas(total);
              $('#total-final-adjusted-mv').val(num_commas);
              // alert(total);
              property_assessment('agricultural', total);//balyuan pa ini

      }

        
    });

    $('#new_owner').click(function(){
      $('form input').removeAttr('disabled');
      $('input[name=fname]').val('');
      $('input[name=mname]').val('');
      $('input[name=lname]').val('');
      $('input[name=address]').val('');
      $('input[name=contact]').val('');
      $('input[name=beneficial]').val('');
      $('input[name=ben_add]').val('');
      $('input[name=ben_tel]').val('');
      $('input[name=email]').val('');

    });
    $('#old_owner').click(function(){
      $('input[name=fname]').attr('disabled', 'disabled');
      $('input[name=mname]').attr('disabled', 'disabled');
      $('input[name=lname]').attr('disabled', 'disabled');
      $('input[name=address]').attr('disabled', 'disabled');
      $('input[name=contact]').attr('disabled', 'disabled');
      $('input[name=beneficial]').attr('disabled', 'disabled');
      $('input[name=ben_add]').attr('disabled', 'disabled');
      $('input[name=ben_tel]').attr('disabled', 'disabled');
      $('input[name=email]').attr('disabled', 'disabled');


      $('#search_owner').modal('show');
      $('#owner_results').html('<br><p style="font-family: segoe script;font-size:18px;text-align:center">Please enter your query.</p>');
    });

    $('.radio-btn').click(function (e){
          $(this).removeClass('selected').addClass('btn-primary');
          // $(this).addClass('selected').css({'background-color':'black','font-size':'20px', 'background-color':'white'});
    });
    $('#list_land').dataTable();
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    
    $('#classification').on('change', function(){
      var data = $(this).val();
      if(data == 'agricultural'){
      $.ajax({
          url: '/iassess/Admin/get_agricultural_lands',
          type: 'get',
          success:function(data){
              /*change the table content with the results retrieved from the database*/
              $('#sub-classification').html(data);
              $('#sub-type').html('<select name="sub_class" id="sub-type-menu" class="form-control" onchange="get_unit_value()"><option>--SELECT--</option><option value="first">first class</option><option value="second">second class</option><option value="third">third class</option></select>');
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
      $('#dd_loc').removeAttr('disabled');
      $('#dd_road').removeAttr('disabled');
   }else{
      $('#sub-classification').html('');
      $('#sub-type').html('');
      
      $('#sub-classification').html('<select name="sub_type" id="sub-class-menu" class="form-control" onchange="get_land_unit_value()"><option>--SELECT--</option><option value="first">first class</option><option value="second">second class</option><option value="third">third class</option><option value="fourth">fourth class</option><option value="fifth">fifth class</option></select>');
      $('#dd_loc').attr('disabled', 'disabled');
      $('#dd_road').attr('disabled', 'disabled');
    }
    });
});
function classified(data){
  // alert(data);
  if(data == 'agricultural'){
      $.ajax({
          url: '/iassess/Admin/get_agricultural_lands',
          type: 'get',
          success:function(data){
              /*change the table content with the results retrieved from the database*/
              $('#sub-classification').html(data);
              $('#sub-type').html('<select name="sub_class" id="sub-type-menu" class="form-control" onchange="get_unit_value()"><option>--SELECT--</option><option value="first">first class</option><option value="second">second class</option><option value="third">third class</option></select>');
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
      $('#dd_loc').removeAttr('disabled');
      $('#dd_road').removeAttr('disabled');
   }else{
      $('#sub-classification').html('');
      $('#sub-type').html('');
      //<select name="sub_type" id="sub-class-menu" class="form-control" onchange="get_land_unit_value()"><option>--SELECT--</option><option value="first">first class</option><option value="second">second class</option><option value="third">third class</option><option value="fourth">fourth class</option><option value="fifth">fifth class</option></select>
      $('#sub-classification').html('hala');
      $('#dd_loc').attr('disabled', 'disabled');
      $('#dd_road').attr('disabled', 'disabled');
    }
}
function get_land_unit_value() {

  var land_class = $('#sub-class-menu :selected').val();
  var classification = $('#classification :selected').val();
  var id;
  if(classification == 'residential') id = 'Land_Res';
  else if(classification == 'commercial') id = 'Land_Com'
  else id = 'Land_Ind';
  $.ajax({
      url: '/iassess/Admin/get_lands?id='+id+'&land_class='+land_class,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#unit-value').html(data);
          $('#base_value').val(data);
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
function get_unit_value(){
   // alert(data);
   var agri_land = $('#agri_class :selected').val();
   var sub_class = $('#sub-type-menu :selected').val();
   
   $.ajax({
      url: '/iassess/Admin/get_unit_value?agri_land='+agri_land+'&sub_class='+sub_class,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#unit-value').html(data);
          $('#base_value').val(data)
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
   // alert(agri_land+sub_class);
}

function calculate_mv(area){
   // alert(data);
   var unit = $('#unit-value').text();
   // alert(unit);
   var mv = $('#market_value').val();
   $('#total-area').html(area);
   $.ajax({
      url: '/iassess/Admin/get_market_value?unit='+unit+'&area='+area,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#market_value').val(data);
          $('#total-mv').html(data);

          // $('#tbl_market_value tbody').append($('#total-mv').text());
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
 //function to activate/deactivate table for improvements
function none(){
   if($('#none').is(':checked')){
      $('#tbl_improvements *').attr("disabled", "disabled");
      $('#add_row').hide();
      $('#tbl_improvements tbody').html('');
      $('#total-improvement-mv').html('');
      // alert('sdf');
    }else{
      $('#tbl_improvements *').removeAttr('disabled');
      $('#add_row').show();
      
   }
}
//function to get the unit vaue of selected improvements
function improve_unit_value(unit_id, plant_id){
   // alert(id);
   var plant = $('#'+plant_id+' :selected').val();
   $.ajax({
      url: '/iassess/Admin/improve_unit_value?plant_id='+plant,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#'+unit_id).html(data);
          
          // $('#total-mv').html(data);
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

function improve_mv(area, unit_id, improvemv_id, row){
   var i, total=0.00, temp=0.00, repo=0, mv=0;
   var unit = $('#'+unit_id).text();
   // alert(row);
   var mv = $('#'+improvemv_id).val();
   // $('#total-area').html(area);
   $.ajax({
      url: '/iassess/Admin/get_market_value?unit='+unit+'&area='+area,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
          $('#'+improvemv_id).val(data);

          
          for(i = 0; i<=row; i++){
            mv = $('#improve-market-'+i).val();
            mv = mv.split(',').join('');
            temp = parseFloat(mv);
            total = total + temp;
            // total = total.replace(/,/g, '';)
         }
        // alert(total);
          // var num_commas = ReplaceNumberWithCommas(total);
          $('#total-improvement-mv').html(total);
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
function display_road_adjustment() {
  $('#total-adjustments').val('');
  var total_adj = 0, road = 0, loc = 0, lbmv = 0, ibmv = 0, land_adj_val = 0, imp_adj_val=0;
  lbmv = $('#land-base-value').val();
  ibmv = $('#improvement-base-value').val();

  road = $('#dd_road :selected').val();
  loc = $('#dd_loc :selected').val();
  
  // alert('road'+road+'')
  $('#road_adjustment').val(road);
  total_adj = parseInt(loc) + parseInt(road);
  // alert(total_adj);
  // land_adj_val = ((parseInt(total_adj)/100));
  //CALCULATE ADJUSTED MARKET VALUE
  value_adjustments_road(lbmv, total_adj);
  value_adjustments_loc(ibmv, total_adj);
  $('#total-adjustments').val(total_adj);

}

function display_loc_adjustment() {
  
  $('#total-adjustments').val('');
  var total_adj = 0, road = 0, loc = 0, lbmv = 0, ibmv = 0, land_adj_val = 0, imp_adj_val=0;
  lbmv = $('#land-base-value').val();
  ibmv = $('#improvement-base-value').val();
  
  road = $('#dd_road :selected').val();
  loc = $('#dd_loc :selected').val();
  
  // alert('road'+road+'')
  $('#loc_adjustment').val(loc);
  total_adj = parseInt(loc) + parseInt(road);
  // alert(total_adj);
  value_adjustments_road(lbmv, total_adj);
  value_adjustments_loc(ibmv, total_adj);
  $('#total-adjustments').val(total_adj);
}

function value_adjustments_road(base_value, total_adj){
  // alert(total_adj);
  var lav = 0.00;
  $.ajax({
      url: '/iassess/Admin/calculate_adj_mvalue?base_value='+base_value+'&total_adj='+total_adj,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
            $('#land-adj-value').val(data);
            lav = $('#land-adj-value').val();
            
          // $('#adjusted-land-market-value').val(parseInt(lbmv-lav));
          // alert(base_value);
          $.ajax({
          url: '/iassess/Admin/calculate_mvalue_2?base_value='+base_value+'&lav='+lav+'&total_adj='+total_adj,
          type: 'get',
          success:function(data){
              /*change the table content with the results retrieved from the database*/
              $('#adjusted-land-market-value').val(data); 
              // alert(data);
              var land_tot = $('#adjusted-land-market-value').val();
              var imp_tot = $('#adjusted-imp-market-value').val();
              land_tot = land_tot.split(',').join('');
              imp_tot = imp_tot.split(',').join('');
              if(imp_tot == '')
                imp_tot = 0.0; 
              var total = parseFloat(land_tot) + parseFloat(imp_tot);
              var num = ReplaceNumberWithCommas(total);
              $('#total-final-adjusted-mv').val(num);
              // var tfamv = $('#total-final-adjusted-mv').val();
              //call function to calculate property assessment

              property_assessment('agricultural', total);
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
            //display total adjusted market value
      },
      error:function(e, xhr){
          alert('error '+ e.errorCode+xhr.errorCode)
      },
      statusCode: {
          404: function() {
              alert("page not found");
          }
      }
   })
}
function value_adjustments_loc(base_value, total_adj){
  // alert(total_adj);
  var lav = 0.00;
  $.ajax({
      url: '/iassess/Admin/calculate_adj_mvalue?base_value='+base_value+'&total_adj='+total_adj,
      type: 'get',
      success:function(data){
          /*change the table content with the results retrieved from the database*/
            $('#loc-adj-value').val(data);
            lav = $('#loc-adj-value').val();
            
          // $('#adjusted-land-market-value').val(parseInt(lbmv-lav));

          $.ajax({
          url: '/iassess/Admin/calculate_mvalue_2?base_value='+base_value+'&lav='+lav+'&total_adj='+total_adj,
          type: 'get',
          success:function(data){
              /*change the table content with the results retrieved from the database*/
              $('#adjusted-imp-market-value').val(data);
              var land_tot = $('#adjusted-land-market-value').val();
              var imp_tot = $('#adjusted-imp-market-value').val();
              land_tot = land_tot.split(',').join('');
              imp_tot = imp_tot.split(',').join('');
              if(imp_tot == '')
              imp_tot = 0.0; 
              var total = parseFloat(land_tot) + parseFloat(imp_tot);
              var num_commas = ReplaceNumberWithCommas(total);
              $('#total-final-adjusted-mv').val(num_commas);
              // var tfamv = $('#total-final-adjusted-mv').val();
              //call function to calculate property assessment
              property_assessment('agricultural', num_commas);
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

              
      },
      error:function(e, xhr){
          alert('error '+ e.errorCode+xhr.errorCode)
      },
      statusCode: {
          404: function() {
              alert("page not found");
          }
      }
   })

}

function property_assessment(types, total) {
  // alert(types);
  var use =  $('#classification :selected').text();
  var assess_level =0;
  $('#actual-use').html(use);
  // var value = $('#total-final-adjusted-mv').val();
  // alert(value);
  // var num_commas = ReplaceNumberWithCommas(total);
  // alert(num_commas);
  $('#tblassess-market-value').html(total);
  //get assessment level for each specific nga land

  if(types == 'agricultural'){
    $('#assess-level').val('40%');
    assess_level = 40;
  }else if(types== 'residential'){
    $('#assess-level').val('20%');
    assess_level = 20;
  }else if(types == 'commercial'){
    $('#assess-level').val('50%');
    assess_level = 50;
  }else if(types == 'industrial'){
    $('#assess-level').val('50%');
    assess_level = 50;
  }
   $.ajax({
    url: '/iassess/Admin/calculate_assess_value?value='+total+'&assess_level='+assess_level,
    type: 'get',
    success:function(data){
        /*change the table content with the results retrieved from the database*/
        // $('#'+improvemv_id).val(data);

        $('#final-assessed-value').val(data);
        $('#total-final-assessed-value').html(data);
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

function ReplaceNumberWithCommas(number) {
  var n = number.toFixed(2).split(".");
  var num = n[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + (n[1] ? "." + n[1] : "");
  // n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return num;
  // return n.join(".");
}

function searchOwner(name){
  $.ajax({
      url: '/iassess/Owner/searchOwner?name='+name,
      type: 'get',
      beforeSend: function(){
          $('#owner_results').html('<br><p style="font-family: segoe script;font-size:18px;text-align:center"><img alt="loader.gif" src="../../241.GIF"/>&nbsp;Please wait... Searching for your entry.. :)</p>');
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