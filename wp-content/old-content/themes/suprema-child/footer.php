
<script type="text/javascript">
	

 jQuery(document).ready(function(){
                  var stickyTopSection = jQuery('.h-browse-cat-rw').offset().top;
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


});

</script>

<?php
suprema_qodef_get_footer();
?>