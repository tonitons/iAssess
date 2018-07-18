$(document).ready(function(){
  var url = window.location.href,
        index = $('#nav-menu-container ul :first-child [href]');
   var page = url.substring(url.lastIndexOf('/')+1);
   // alert(page);
   $('#nav-menu-container [href]').each(function(){
    // alert(this.href);
    var nav = this.href;
    var active = nav.substring(nav.lastIndexOf('/')+1);
    // var li = nav.substring(nav.indexOf('market_value'));
    // alert(nav.substring(nav.hasIndexOf('market_value')));
      if(nav.substring(nav.indexOf('market_value')) == 1){
        $('.nav-menu li:nth-child(2)').addClass('menu-active').css({'color':'skyblue','font-size':'16px'});
      }
       if (active == page) {
           // alert(nav);
           $(this).addClass('menu-active').css({'color':'skyblue','font-size':'16px'});
           $(this).removeAttr('href');
       }
   });

   // $('.nav-menu-container [href]').each(function(){
   //  alert(this.href);
   //  var nav = this.href;

   //     if (nav.substring(nav.lastIndexOf('/')+1) == page) {
   //         alert(nav);
   //         $(this).addClass('menu-active').css({'color':'white','background-color':'blue'});
   //         $(this).removeAttr('href');
   //     }
   // });

   // $(".alert").delay(6000).hide(5000);
   
});