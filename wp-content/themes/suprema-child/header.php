<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <script src="https://cdn-au.pagesense.io/js/savagegroup/24208518e7a14beeb2cd0e09040fe025.js"></script>

    <?php
    /**
     * @see suprema_qodef_header_meta() - hooked with 10
     * @see qode_user_scalable - hooked with 10
     */
    ?>
	<?php if (!suprema_qodef_is_ajax_request()) do_action('suprema_qodef_header_meta'); ?>
    <?php
 /*if ( is_product() ) {
    global $post, $product;
    echo '<meta property="og:image" content="https://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/16239204661345-1.jpeg"/><meta property="og:image:width" content="1500"><meta property="og:image:height" content="1500">';
 }*/
 ?>


	<?php if (!suprema_qodef_is_ajax_request()) wp_head(); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" >		</script>
      <?php if(is_front_page()) { ?>
    <link href="<?php echo get_theme_file_uri() ?>/css/owl.carousel.min.css" rel="stylesheet">
<script src="<?php echo get_theme_file_uri() ?>/js/owl.carousel.min.js"></script>
    <?php } ?>

<!-- Hotjar Tracking Code for Lighthouse Rentals -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2446769,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>





</head>

<script> 
jQuery(function(){
	/*if (typeof jQuery.cookie('popup_1_2') === 'undefined'){
     //no cookie
     jQuery('.first_pop').show();
    } else {
     //have cookie
     jQuery('.first_pop').remove();
    }
    var defaults = {expires: 365, path:'/'};
    jQuery("#cls_ntc").click(function(){
        jQuery('.first_pop').remove();
        jQuery.cookie("popup_1_2", "2", defaults);
    });*/

    /*if (typeof jQuery.cookie('popup_1_3') === 'undefined'){
     //no cookie
     jQuery('.second_pop').show();
    } else {
     //have cookie
     jQuery('.second_pop').remove();
    }
    var defaults = {expires: 365, path:'/'};
    jQuery("#cls_ntc1").click(function(){
        jQuery('.second_pop').remove();
        jQuery.cookie("popup_1_3", "2", defaults);
    });*/
	
    /*var el = jQuery('.ti-col-4');
        el.addClass('ti-col-3');
        el.removeClass('ti-col-4');
    
    jQuery('.ti-widget .ti-goog').on('change',function(){
        alert(12324);
        var el = jQuery('.ti-col-4');
        el.addClass('ti-col-3');
        el.removeClass('ti-col-4');
    }); */
/*var dt = new Date().toLocaleString("en-US", {timeZone: "Australia/Melbourne"});
var d1 = dt.split(" ");
console.log(dt);
console.log(d1[1]);*/
}); 
</script>


<?php 
    
    /*global $_product;

    $_product = wc_get_product( get_the_ID() );
    $id = "";
    if( $_product->is_type( 'bundle' ) ) {
    $id = 'body_pr_bdl';
    
    } */

        
?>

<body <?php body_class();?> id="<?php echo $id; ?>">
    <div class="loadr_img" id="loadr_img" style="display: none">
    <img src="<?php echo get_stylesheet_directory_uri()."/images/Spin-1s-200px.gif";?>" class="loader_img_tag" id="loader_img_tag">
  </div>
<?php if (!suprema_qodef_is_ajax_request()) suprema_qodef_get_side_area(); ?>


<?php 
if((!suprema_qodef_is_ajax_request()) && suprema_qodef_options()->getOptionValue('preloading_effect') == "yes") {
    $ajax_class = 'qodef-mimic-ajax';
?>
<div class="qodef-smooth-transition-loader <?php echo esc_attr($ajax_class); ?>">
    <div class="qodef-st-loader">
        <div class="qodef-st-loader1">
            <?php suprema_qodef_loading_spinners(); ?>
        </div>
    </div>
</div>
<?php if ((!suprema_qodef_is_ajax_request()) && suprema_qodef_options()->getOptionValue('smooth_wipe_effect') == "yes") { ?>
<div class="qodef-wipe-holder">
    <div class="qodef-wipe-1"></div>
    <div class="qodef-wipe-2"></div>
</div>
<?php } ?>
<?php } ?>

  <!-- <div class="ntc_bar view first_pop" style="display:none;">
                    <?php// dynamic_sidebar('header-notice'); ?>
                </div> -->

               
                
<div class="qodef-wrapper">
    <div class="qodef-wrapper-inner">

    <?php if((!suprema_qodef_is_ajax_request()) && suprema_qodef_options()->getOptionValue('smooth_page_transitions') == "yes") { ?>
        <div class="qodef-fader"></div>
    <?php } ?>

        <?php if (!suprema_qodef_is_ajax_request()) suprema_qodef_get_header(); ?>
<?php

$timezone = date_default_timezone_set("Australia/Melbourne");
$datetime = date('H:i:s');
$day = date('D');
?>
<script type="text/javascript">

    var datetime = "<?php echo $datetime ?>";
    var day = "<?php echo $day ?>";
    var days = new Array("Mon", "Tue", "Wed", "Thu", "Fri");
    if( ( datetime >= '08:00:00' ) && ( datetime <= '17:00:00') && (jQuery.inArray(day, days) !== -1))
    {
        jQuery("#text-20").show();
    } else {
        jQuery("#text-20").hide();
    }

</script>
        <?php if ((!suprema_qodef_is_ajax_request()) && suprema_qodef_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='qodef-back-to-top'  href='#'>
                <span class="qodef-icon-stack">
                     <?php
                        suprema_qodef_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
            </a>
        <?php } ?>
        <?php if (!suprema_qodef_is_ajax_request()) suprema_qodef_get_full_screen_menu(); ?>

        <div class="qodef-content" <?php suprema_qodef_content_elem_style_attr(); ?>>
            <div class="qodef-content-inner">

               <div class="ntc_bar view second_pop">
                    <?php dynamic_sidebar('header-second-notice'); ?>
                </div>