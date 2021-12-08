<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * @see suprema_qodef_header_meta() - hooked with 10
     * @see qode_user_scalable - hooked with 10
     */
    ?>
	<?php if (!suprema_qodef_is_ajax_request()) do_action('suprema_qodef_header_meta'); ?>

	<?php if (!suprema_qodef_is_ajax_request()) wp_head(); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js" >		</script>
</head>
<script> 
jQuery(document).ready(function(){
	if (typeof jQuery.cookie('popup_1_2') === 'undefined'){
	 //no cookie
	 jQuery('.first').show();
	} else {
	 //have cookie
	 jQuery('.first').remove();
	}
	var defaults = {expires: 365, path:'/'};
	jQuery(".dismiss_one").click(function(){
		jQuery('.first').remove();
		jQuery.cookie("popup_1_2", "2", defaults);
	});

    if (typeof jQuery.cookie('popup_1_3') === 'undefined'){
     //no cookie
     jQuery('.second').show();
    } else {
     //have cookie
     jQuery('.second').remove();
    }
    var defaults = {expires: 365, path:'/'};
    jQuery(".dismiss_two").click(function(){
        jQuery('.second').remove();
        jQuery.cookie("popup_1_3", "2", defaults);
    });
	
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

<body <?php body_class();?>>
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

                <div class="ntc_bar view first">
                    <?php dynamic_sidebar('header-notice'); ?>
                </div>

                <div class="ntc_bar view second">
                    <?php dynamic_sidebar('header-second-notice'); ?>
                </div>