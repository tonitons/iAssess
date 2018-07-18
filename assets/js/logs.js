$(document).ready(function(){
  $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
  });

  $('#btn-clear').click(function(){
  	$('#clear_logs').modal("show");
  });

  $('#delete-btn').click(function(){
  	var from = $('#input-from').val();
  	var to = $('#input-to').val();
  	$('#date-from').html(from);
  	$('#date-to').html(to);
  	$('#delete_logs').modal("show");
  });

  $('#filter').click(function(){
    //alert('dty');
    // if($(this).html() == 'FILTER RESULTS'){
    //   $('#form-filter').removeClass('hidden');
    //   $(this).html('HIDE');
    // }else{
    //   $('#form-filter').addClass('hidden');
    //   $(this).html('FILTER RESULTS');
    // }
    $('#filter-modal').modal('show');
  });
  $('.table').dataTable();
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
});

function filterDate() {
  var f = $('#input-from').val();
  var t = $('#input-to').val();
  var from, to;
  from = f.split('-').join('');
  to = t.split('-').join('');
  // alert(from+' - '+to);
  if(from > to){
    alert('OOPS! \nPLEASE CHECK YOUR DATE.'+'\n Must be '+ t + ' AND '+f);

    return false;
    //$('')
  }
}