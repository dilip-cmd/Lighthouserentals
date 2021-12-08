
<script type="text/javascript">
	

  


 jQuery(document).ready(function(){


                /*var href = jQuery(".checkout").attr("href");
                var from = jQuery("#from").val();
                alert(from);*/
            
           
                  var stickyTopSection = jQuery('.light-img-txt-sec').offset().top;
                var stickyTop = function(){
                    var scrollTop = jQuery(window).scrollTop();
                    if (scrollTop > stickyTopSection) {
                           jQuery(".qodef-sticky-header").addClass('home-sticky');
                            jQuery(".qodef-top-bar").addClass('home-sticky');
                      
                        
                       } else {
                           jQuery(".qodef-sticky-header").removeClass('home-sticky');
                            jQuery(".qodef-top-bar").removeClass('home-sticky');
                         
                         
                       }
                   };

                   stickyTop();

                   jQuery(window).scroll(function() {
                       stickyTop();
                   });
});


 jQuery(document).ready(function(){


jQuery(window).scroll(function(){
  if (jQuery(window).scrollTop() >= 50) {
    jQuery('header.qodef-page-header').addClass('fixed');
    jQuery('.qodef-wrapper-inner').addClass('fixed-wrap');
   }
   else {
    jQuery('header.qodef-page-header').removeClass('fixed');
    jQuery('.qodef-wrapper-inner').removeClass('fixed-wrap');
   }
});


// init daterangepicker 
var picker = jQuery('#daterangepicker1').daterangepicker({
  "parentEl": "#daterangepicker1-container",
  "autoApply": true,
  showDateFilter: function(time, date)
  {
    return '<div style="padding:0 5px;">\
          <span style="font-weight:bold">'+date+'</span>\
          <div style="opacity:0.3;">$'+Math.round(Math.random()*999)+'</div>\
        </div>';
  }
  //"singleDatePicker": true,
});
// range update listener
picker.on('apply.daterangepicker', function(ev, picker) {
  jQuery("#daterangepicker-result").html('Selected date range: ' + picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
});
// prevent hide after range selection
picker.data('daterangepicker').hide = function () {};
// show picker on load
picker.data('daterangepicker').show();


});


    jQuery(".close > span").click(function() {
         jQuery('#myModal').modal('hide')          
      });
 


</script>

<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "5de332edd2395abdae4a53ddbb888342a9dd277712438c378f9462501b84daa8", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zoho.com.au/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>

<?php
suprema_qodef_get_footer();
?>
