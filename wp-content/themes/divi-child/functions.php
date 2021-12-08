<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles1' );

function enqueue_parent_styles1() {
   
  // wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function et_child_divi_load_scripts_styles(){
	global $wp_styles, $et_user_fonts_queue;

	$script_suffix = et_load_unminified_scripts() ? '' : '.unified';
	$style_suffix  = et_load_unminified_styles() && ! is_child_theme() ? '.dev' : '';
	$template_dir  = get_stylesheet_directory_uri();
	$theme_version = et_get_theme_version();

	wp_enqueue_script( 'jquery-ui', $template_dir . '/js/jquery-ui.js', array( 'jquery' ), $theme_version, true );
    wp_enqueue_script( 'password', $template_dir . '/js/password.js', array( 'jquery' ), $theme_version, true );
	wp_enqueue_style( 'jquery-ui', $template_dir . '/css/jquery-ui.css', array(), $theme_version );
    wp_enqueue_style( 'password', $template_dir . '/css/password.css', array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'et_child_divi_load_scripts_styles' );

/*function et_child_divi_load_admin_styles(){
    global $wp_styles, $et_user_fonts_queue;
    
    $script_suffix = et_load_unminified_scripts() ? '' : '.unified';
    $style_suffix  = et_load_unminified_styles() && ! is_child_theme() ? '.dev' : '';
    $template_dir  = get_stylesheet_directory_uri();
    $theme_version = et_get_theme_version();

    wp_enqueue_style( 'custom-admin', $template_dir . '/css/custom-admin.css', array(), $theme_version );
}

add_action( 'admin_enqueue_scripts', 'et_child_divi_load_admin_styles' );*/

//add_action( 'woocommerce_checkout_before_customer_details', 'action_woocommerce_checkout_before_customer_details', 10, 1 ); 

function action_woocommerce_checkout_before_customer_details( $wccm_checkout_text_before ) { 
   ?>
   <div class="project_data">
        <h3>Project Details</h3>
		<p class="form-row form-row-first validate-required" id="billing_project_name_field" data-priority="10">
		    <label for="billing_project_name" class="">Project Name&nbsp;<abbr class="required" title="required">*</abbr></label>
		    <span class="woocommerce-input-wrapper"><input type="text" class="input-text" name="billing_project_name" id="billing_project_name" placeholder="" value=""></span>
		</p>
		<p class="form-row form-row-last  validate-required" id="billing_project_type_field" >
			<label for="billing_project_type" class="">Project Type&nbsp;<abbr class="required" title="required">*</abbr></label>
			<span class="woocommerce-input-wrapper">
				<select name="billing_project_type" id="billing_project_type" class="select" data-placeholder="" tabindex="-1" aria-hidden="true">
					<option value="tv_production">TV Production</option>
					<option value="film">Film</option>
                    <option value="drama">Drama</option>
                    <option value="theatre">Theatre</option>
                    <option value="corperate">Corperate</option>
                    <option value="concert">Concert</option>
				</select>
			</span>	
		</p>
		<p class="form-row form-row-first validate-required" id="billing_booking_start_date_field" data-priority="10">
		    <label for="billing_booking_start_date" class="">Booking Start&nbsp;<abbr class="required" title="required">*</abbr></label>
		    <span class="woocommerce-input-wrapper"><input type="text" class="input-text" name="billing_booking_start_date" id="billing_booking_start_date" placeholder="" value=""></span>
		</p>
		<p class="form-row form-row-last validate-required" id="billing_booking_end_date_field" data-priority="10">
		    <label for="billing_booking_end_date" class="">Booking End&nbsp;<abbr class="required" title="required">*</abbr></label>
		    <span class="woocommerce-input-wrapper"><input type="text" class="input-text" name="billing_booking_end_date" id="billing_booking_end_date" placeholder="" value=""></span>
		</p>
		<p class="form-row form-row-wide" id="billing_project_comment_field" >
			<label for="billing_project_comment" class="">Comment&nbsp;<abbr class="required" title="required">*</abbr></label>
			<span class="woocommerce-input-wrapper">
				<textarea name="billing_project_comment" class="input-text" id="billing_project_comment" placeholder="" rows="2" cols="5"></textarea>
			</span>
		</p>
	</div>
	<div class="collction_data">
		<h3>Collection & return</h3>
        <p class="form-row form-row-wide" id="billing_collection_field">
        	<label for="billing_collection" class="">Your Pickup&nbsp;<abbr class="required" title="required">*</abbr></label>
        	<span class="woocommerce-input-wrapper">
        		<div class="collectdiv">
        		     <input type="radio" class="input-radio billing_collection" value="0" name="billing_collection" id="billing_collection_0"><label for="billing_collection_0" class="radio ">Free Standard Return</label>
        	    </div>
        	    <div class="collectdiv">
        		     <input type="radio" class="input-radio billing_collection" value="25" name="billing_collection" id="billing_collection_25"><label for="billing_collection_25" class="radio ">$25 - 24/7 Return</label>
        		</div>     
        		<div class="collectdiv">     
        		    <input type="radio" class="input-radio billing_collection" value="55" name="billing_collection" id="billing_collection_55"><label for="billing_collection_55" class="radio ">$55 - Lighthouse Express</label>
        		</div>    
        		<div class="collectdiv">    
        		    <input type="radio" class="input-radio billing_collection" value="75" name="billing_collection" id="billing_collection_75"><label for="billing_collection_75" class="radio ">$75 - Lighthouse Express Priority</label>
        		</div>    
        		<div class="collectdiv">    
        		    <input type="radio" class="input-radio billing_collection" value="110" name="billing_collection" id="billing_collection_110"><label for="billing_collection_110" class="radio ">$110 - Lighthouse Express Afterhours</label></span>
        		</div>    
        </p>
        <p class="form-row form-row-wide" id="billing_return_field">
        	<label for="billing_return" class="">You drop off&nbsp;<abbr class="required" title="required">*</abbr></label>
        	<span class="woocommerce-input-wrapper">
        		<div class="collectdiv">
        		    <input type="radio" class="input-radio billing_return" value="0" name="billing_return" id="billing_return_0"><label for="billing_return_0" class="radio ">Free Standard Return</label>
                </div> 
        		<div class="collectdiv">
        		    <input type="radio" class="input-radio billing_return" value="25" name="billing_return" id="billing_return_25"><label for="billing_return_25" class="radio ">$25 - 24/7 Return</label>
        		</div>     
        		<div class="collectdiv">    
        		    <input type="radio" class="input-radio billing_return" value="55" name="billing_return" id="billing_return_55"><label for="billing_return_55" class="radio ">$55 - Lighthouse Express</label>
        		</div>     
        		<div class="collectdiv">    
        		    <input type="radio" class="input-radio billing_return" value="70" name="billing_return" id="billing_return_75"><label for="billing_return_70" class="radio ">$70 - Lighthouse Express Priority</label>
        	    </div> 	    
        		<div class="collectdiv">    
        		    <input type="radio" class="input-radio billing_return" value="110" name="billing_return" id="billing_return_110"><label for="billing_return_110" class="radio ">$110 - Lighthouse Express Afterhours</label>
        		</div>     
        	</span>
 
	</div>
    <script type="text/javascript">
    	jQuery(".billing_collection").change(function($){
	        var val = jQuery(".billing_collection:checked").val();
	        
	        	var action_data = "collection";
	        	jQuery.ajax({
	                url:"<?php echo admin_url('admin-ajax.php'); ?>",
	                type:'POST',
	                data: "collection_value=" + val + "&action=" + action_data,
	                success: function(data){
	                	jQuery( document.body ).trigger( 'update_checkout' );
	                }
	            });   
	        
    	
	    });	
	    jQuery(".billing_return").change(function($){
	        var val = jQuery(".billing_return:checked").val();
	        
	        	var action_data = "return";
	        	jQuery.ajax({
	                url:"<?php echo admin_url('admin-ajax.php'); ?>",
	                type:'POST',
	                data: "return_value=" + val + "&action=" + action_data,
	                success: function(data){
	                	jQuery( document.body ).trigger( 'update_checkout' );
	                }
	            });  
               
	        
	    });	

	    jQuery(document).ready(function($) {
	        jQuery("#billing_booking_start_date").datepicker({
	        	minDate: 0,
	        });

		    jQuery('#billing_booking_end_date').datepicker({
		    	minDate: 0,
			    onSelect: function(dateText, inst) {
			        var startDate = jQuery('#billing_booking_start_date').val(); 
			        var endDate = dateText
			        getBookingDays(startDate,endDate);
			    }
		    });
	    });

	    function getBookingDays(startDate,endDate){
            var action_data = "days";
        	jQuery.ajax({
                url:"<?php echo admin_url('admin-ajax.php'); ?>",
                type:'POST',
                data: "startDate=" + startDate + "&endDate=" + endDate + "&action=" + action_data,
                success: function(data){
                	jQuery( document.body ).trigger( 'update_checkout' );
                }
            });
        }
    </script>
	
   <?php
}; 


add_action('wp_ajax_collection', 'add_collection');
add_action('wp_ajax_nopriv_collection','add_collection');

function add_collection () {

	$collection = $_REQUEST['collection_value'];

	if($collection != '' && $collection != 0){
        WC()->session->set( 'collection', $collection );
    }
    if($collection == 0){
       if (  WC()->session->__isset( 'collection' ) ){
           WC()->session->__unset( 'collection' );
       } 	
    }  	
    exit;
}	


add_action('wp_ajax_return', 'add_return');
add_action('wp_ajax_nopriv_return','add_return');

function add_return () {

    $return = $_REQUEST['return_value'];

	if($return != '' && $return != 0){
        WC()->session->set( 'return', $return );
    }

    if($return == 0){
       if (  WC()->session->__isset( 'return' ) ){
           WC()->session->__unset( 'return' );
       } 	
    }
    exit;
}	

add_action('wp_ajax_days', 'get_booking_days');
add_action('wp_ajax_nopriv_days','get_booking_days');

function get_booking_days () {

    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];

    if($startDate != '' && $endDate != ''){

	    $toDate = date("Y-m-d", strtotime($startDate));  
	    $fromDate = date("Y-m-d", strtotime($endDate));  

	    $date1 =date_create($toDate);
		$date2 =date_create($fromDate);
		$diff = date_diff($date1,$date2);
		$days = $diff->format("%a");

		if($days != ''){
	        WC()->session->set( 'booking_days', $days );
	    }
	    if($days == 0){
	       if (  WC()->session->__isset( 'booking_days' ) ){
	           WC()->session->__unset( 'booking_days' );
	       } 	
	    }
	}    
    exit;
}	





  

add_action( 'woocommerce_cart_calculate_fees', 'sm_checkout_radio_choice_fee', 20, 1 );
  
function sm_checkout_radio_choice_fee( $cart ) {
   
   if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
       
    if (  WC()->session->__isset( 'collection' ) ){
       $collection = WC()->session->get( 'collection' );
       if ( $collection ) {
	      $cart->add_fee( 'Collection', $collection );
	   }
    } 
   
    if (  WC()->session->__isset( 'return' ) ){
       $return = WC()->session->get( 'return' );
       if ( $return ) {
	      $cart->add_fee( 'Return', $return );
	   }
    }   
}
  
add_action( 'woocommerce_before_calculate_totals', 'sm_recalculate_price' );
 
function sm_recalculate_price( $cart_object ) {
	foreach ( $cart_object->get_cart() as $hash => $value ) {
        $days = 1;
        $price = $value['data']->get_price();
		if (  WC()->session->__isset( 'booking_days' ) ){
	       $days = WC()->session->get( 'booking_days' );
	    }
	    if($days > 1 ){
	    	$newPrice = (int)$days*$price;
            $value['data']->set_price($newPrice);
	    }
		
	}
}  

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Add to quote', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Add to quote', 'woocommerce' );
}

add_action('template_redirect', 'remove_shop_breadcrumbs' );
function remove_shop_breadcrumbs(){

        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
 
}

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); 


add_filter( 'woocommerce_get_price_suffix', 'sm_add_price_suffix', 99, 4 );
  
function sm_add_price_suffix( $html, $product, $price, $qty ){
    $html .= '/day';
    return $html;
}


function my_custom_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Corona header', 'your-theme-domain' ),
            'id' => 'corona-header-title',
            'description' => __( 'Corona header', 'your-theme-domain' ),
            'before_widget' => '<div class="corona-header">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="corona-header-title">',
            'after_title' => '</h3>',
        )
    );

}
add_action( 'widgets_init', 'my_custom_sidebar' );

/*-- Start product search filter --*/
/*function searchfilter($query) {
 
    if ($query->is_search) {
        $query->set('post_type',array('product'));
    }
 
    return $query;
}
 
add_filter('pre_get_posts','searchfilter');*/

function lw_search_filter_pages($query) {
    if ($query->is_search) {
        $query->set('post_type', 'product');
        $query->set( 'wc_query', 'product_query' );
    }
    return $query;
}
 
add_filter('pre_get_posts','lw_search_filter_pages');


/*-- End product search filter --*/

/*function my_text_strings( $translated_text, $text, $domain ) {
    switch ( strtolower( $translated_text ) ) {
        case 'View Cart' :
            $translated_text = __( 'Request Quote', 'woocommerce' );
            break;
    }
    return $translated_text;
}
add_filter( 'gettext', 'my_text_strings'-, 20, 3 );*/

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    $fragments['span.sm-count'] = '<span class="sm-count">'. $woocommerce->cart->cart_contents_count .'</span>';
    ob_start();
    ?>

    <div class="sm-content">
      <?php echo woocommerce_mini_cart(); ?>
    </div>
    <?php
    $fragments['div.sm-content'] = ob_get_clean();
    
    return $fragments;
}

add_filter( 'wp_head', 'get_price_display_condition', 10);
function get_price_display_condition(){
     
    if(is_user_logged_in()){
        $user_id = get_current_user_id();
        $display_product_price = get_field('display_product_price', 'user_'. $user_id);

        if($display_product_price != 1){
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        }else{
            add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
            add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        }
    }else{
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    }
}

/*--  Add custom column in product listing -- */
/*add_filter('manage_edit-product_columns', 'elite_userid_product_col');

function elite_userid_product_col($columns) {
    $columns['user_id'] = __( 'User Id', 'woocommerce' );
    $columns['crms_id'] = __( 'CRMS Id', 'woocommerce' );
    $columns['sub_domain'] = __( 'Sub Domain', 'woocommerce' );
    $columns['api_token'] = __( 'Api Token', 'woocommerce' );

    return $columns;
}*/

/*--  Display content in custom column of product listing -- */
/*add_action('manage_product_posts_custom_column', 'elite_product_column_userid', 10, 2);
function elite_product_column_userid($column, $postid) {
    if ( $column == 'user_id' ) {
        echo get_post_meta( $postid, 'user_id', true );
    }
    if ( $column == 'crms_id' ) {
        echo get_post_meta( $postid, 'crms_id', true );
    }
    if ( $column == 'sub_domain' ) {
        echo get_post_meta( $postid, 'sub_domain', true );
    }
    if ( $column == 'api_token' ) {
        echo get_post_meta( $postid, 'api_token', true );
    }
}*/

/**
 * Update the order meta with field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['billing_project_name'] ) || ! empty($_POST['billing_project_type']) || ! empty($_POST['billing_booking_start_date']) || ! empty($_POST['billing_booking_end_date']) || ! empty($_POST['billing_project_comment']) || ! empty($_POST['billing_collection']) || !empty($_POST['billing_return']) || !empty($_POST['billing_project_comment'])
                    ) {
        update_post_meta( $order_id, 'billing_project_name', sanitize_text_field( $_POST['billing_project_name'] ) );
        update_post_meta( $order_id, 'billing_project_type', sanitize_text_field( $_POST['billing_project_type'] ) );
        update_post_meta( $order_id, 'billing_booking_start_date', sanitize_text_field( $_POST['billing_booking_start_date'] ) );
        update_post_meta( $order_id, 'billing_booking_end_date', sanitize_text_field( $_POST['billing_booking_end_date'] ) );
        update_post_meta( $order_id, 'billing_collection', sanitize_text_field( $_POST['billing_collection'] ) );
        update_post_meta( $order_id, 'billing_return', sanitize_text_field( $_POST['billing_return'] ) );
        update_post_meta( $order_id, 'billing_project_comment', sanitize_text_field( $_POST['billing_project_comment'] ) );
    }
}



function et_child_divi_load_admin_styles(){
global $wp_styles, $et_user_fonts_queue;

$script_suffix = et_load_unminified_scripts() ? '' : '.unified';
$style_suffix = et_load_unminified_styles() && ! is_child_theme() ? '.dev' : '';
$template_dir = get_stylesheet_directory_uri();
$theme_version = et_get_theme_version();

wp_enqueue_style( 'custom-admin', $template_dir . '/css/custom-admin.css', array(), $theme_version );
}

add_action( 'admin_enqueue_scripts', 'et_child_divi_load_admin_styles' );

/*-- Add SMTP Details --*/
add_action( 'phpmailer_init', 'send_smtp_email' );
function send_smtp_email( $phpmailer ) {
 $phpmailer->isSMTP();
 $phpmailer->Host = "smtp.gmail.com";
 $phpmailer->SMTPAuth = true;
 //$phpmailer->Port = 25;
 $phpmailer->Username = "smtp@webtechsystem.com";
 $phpmailer->Password = "Abbacus007";
 
}



/*-- Order custom field In mail --*/
add_action( 'woocommerce_email_after_order_table', 'email_product_data_after_order_table', 10, 4 );
function email_product_data_after_order_table( $order, $sent_to_admin, $plain_text, $email )
{ 
    global $woocommerce;
    $order_id = $order->id;

    $project_name = get_post_meta( $order_id, 'billing_project_name', true );
    $project_type = get_post_meta( $order_id, 'billing_project_type', true );
    $start_date = get_post_meta( $order_id, 'billing_booking_start_date', true );
    $end_date = get_post_meta( $order_id, 'billing_booking_end_date', true );

    $project_start_date = str_replace('/', '-', $start_date);
    $project_end_date = str_replace('/', '-', $end_date);





    $comment = get_post_meta( $order_id, 'billing_project_comment', true );
    $collection = get_post_meta( $order_id, 'billing_collection', true );
    $return = get_post_meta( $order_id, 'billing_return', true );

    $html = '';

    if($project_name != ''){
    $html = '<table cellspacing="0" cellpadding="6" border="1" style="color:#636363; margin-bottom:30px; border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:"Helvetica Neue,Helvetica,Roboto,Arial,sans-serif"; border-collapse: collapse;>

                      <tbody>';
                      if($project_name != ''){
                        $html .=
                        '<tr>
                          <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">Project Name:</td>
                          <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">'.$project_name.'</td>
                        </tr>';
                       }
                       if($project_type != ''){
                        $html .=
                        '<tr>
                          <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">Project Type:</td>
                          <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">'.ucwords($project_type).'</td>
                        </tr>';
                       } 
                       if($project_start_date != ''){
                        $startDate = date("d/m/Y", strtotime($project_start_date));  
                         $html .=
                            '<tr>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">Start Date:</td>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">'.$startDate.'</td>
                            </tr>';
                        }
                        if($project_end_date != ''){
                            $endDate = date("d/m/Y", strtotime($project_end_date)); 
                         $html .=
                            '<tr>
                               <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">End Date:</td>
                               <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">'.$endDate.'</td>
                            </tr>';
                        }
                        if($comment != ''){
                        $html .=
                            '<tr>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">Comment:</td>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">'.$comment.'</td>
                            </tr>';   
                        }
                        if($collection != ''){
                        $html .=    
                            '<tr>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">Collection:</td>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">$'.$collection.'</td>
                            </tr>'; 
                        }
                        if($return != ''){   
                        $html .=      
                            '<tr>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">Return:</td>
                              <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:"Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word;">$'.$return.'</td>
                            </tr>';  
                        }
                        $html .= 
                      '</tbody>
                   
       </table>';
    }   
    echo $html;              
}


add_action( 'add_meta_boxes', 'elite_add_meta_boxes' );
if ( ! function_exists( 'elite_add_meta_boxes' ) )
{
    function elite_add_meta_boxes()
    {
        add_meta_box( 'elite_order_fields', __('Project Data','woocommerce'), 'elite_display_project_data', 'shop_order','normal','core');
    }
}

//add_action( 'woocommerce_admin_order_data_after_order_details', 'elite_custom_checkout_field_display_admin_order_meta', 10, 1 );

function elite_display_project_data(){

    global $post;
    $order_id = $post->ID;
    $project_name = get_post_meta( $order_id, 'billing_project_name', true );
    $project_type = get_post_meta( $order_id, 'billing_project_type', true );
    $start_date = get_post_meta( $order_id, 'billing_booking_start_date', true );
    $end_date = get_post_meta( $order_id, 'billing_booking_end_date', true );
    $comment = get_post_meta( $order_id, 'billing_project_comment', true );
    $collection = get_post_meta( $order_id, 'billing_collection', true );
    $return = get_post_meta( $order_id, 'billing_return', true );

    $project_start_date = str_replace('/', '-', $start_date);
    $project_end_date = str_replace('/', '-', $end_date);
    
    
    $startdt = date("d/m/Y", strtotime($project_start_date));
    $enddt = date("d/m/Y", strtotime($project_end_date));

    $html = '';
    if($project_name != ''){
	    $html .= '<p><b style="color:#636363">Project Name :</b> '.$project_name.'</p>';
    }
    if($project_type != ''){
    	$html .= '<p><b style="color:#636363">Project Type :</b> '.ucwords($project_type).'</p>';
    }
    if($start_date != ''){
    	$startDate = $startdt; 
	    $html .= '<p><b style="color:#636363">Start Date :</b> '.$startDate.'</p>';
    }
    if($end_date != ''){
    	$endDate = $enddt;
    	$html .= '<p><b style="color:#636363">End Date :</b> '.$endDate.'</p>';
    }
    if($comment != ''){
	    $html .= '<p><b style="color:#636363">Comment :</b> '.$comment.'</p>';
    }

    echo $html;

}


/*if( !function_exists( 'custom_checkout_question_field' ) ) {
  
  function custom_checkout_question_field( $checkout ) {

    echo "<div class='custom-question-field-wrapper custom-question-1'>";
    woocommerce_form_field( 'custom_question_field', array(
      'type'            => 'radio',
      'required'        => true,
      'class'           => array('custom-question-field', 'form-row-wide'),
      'options'         => array(
        'personal'         => 'Personal',
        'company'    => 'Company',
      ),
    ), $checkout->get_value( 'custom_question_field' ) );

    echo "</div>";

  }

  add_action( 'woocommerce_after_checkout_billing_form', 'custom_checkout_question_field' );
}*/


function get_product_item_from_order( $order_id ) {

    global $wpdb;
    global $woocommerce;
    $order = wc_get_order($order_id);
    $table = $wpdb->prefix . "wc_order_product_lookup";

    $dp = (isset($filter['dp'])) ? intval($filter['dp']) : 2;
    $itemsData = array();
    foreach ($order->get_items() as $item_id => $item) {

    $product = $item->get_product();

    $product_id = null;
    $product_sku = null;
    if (is_object($product)) {
    $product_id = $product->get_id();
    $product_sku = $product->get_sku();
    }

    $product_id = (!empty($item->get_variation_id()) && ('product_variation' === $product->post_type )) ? $product->get_parent_id() : $product_id;
    $variation_id = (!empty($item->get_variation_id()) && ('product_variation' === $product->post_type )) ? $product_id : 0;

    $discount_amount = $order->get_item_coupon_amount( $item );

    $itemsData[] = array(
    'id' => (string)$item_id,
    'subtotal' => wc_format_decimal($order->get_line_subtotal($item, false, false), $dp),
    'subtotal_tax' => wc_format_decimal($item['line_subtotal_tax'], $dp),
    'total' => wc_format_decimal($order->get_line_total($item, false, false), $dp),
    'total_tax' => wc_format_decimal($item['line_tax'], $dp),
    'price' => wc_format_decimal($order->get_item_total($item, false, false), $dp),
    'quantity' => wc_stock_amount($item['qty']),
    'tax_class' => (!empty($item['tax_class']) ) ? $item['tax_class'] : null,
    'name' => $item['name'],
    'product_id' => $product_id,
    'variation_id' => $variation_id,
    'sku' => $product_sku,
    'meta' => wc_display_item_meta($item, ['echo' => false]),
    'discount_amount' => round($discount_amount,2),
    );
    }

    $orderitems = $itemsData;

return $orderitems;
}

function syncMemberTocrms($api_req_data,$country_name)
{   
        
    global $wpdb;
    $query = $wpdb->get_results("SELECT * FROM wp_crms_country WHERE `name` LIKE '".$country_name."' OR `mname` LIKE '".$country_name."'");
    $url = "https://api.current-rms.com/api/v1/members";
    $ch = curl_init( $url );
    $payload = '{
                    "member":
                    {
                        "name":"'.$api_req_data['first_name'].$api_req_data['last_name'].'",
                        "description":"'.$api_req_data['billing_project_comment'].'",
                        "active":true,
                        "bookable":false,
                        "location_type":1,
                        "locale":"en-GB",
                        "membership_type":"Organisation",
                        "sale_tax_class_id":1,
                        "purchase_tax_class_id":1,
                        "tag_list":[],
                        "custom_fields":{},
                        "membership":{"owned_by": 1},
                        "primary_address":{"name":"'.$api_req_data['first_name'].'","street":"'.$api_req_data['address_1'].'","postcode":"'.$api_req_data['postcode'].'","city":"'.$api_req_data['city'].'","county":"'.$api_req_data['city'].'","country_id":"'.$query[0]->id.'","country_name":"'.$query[0]->name.'","type_id":3001,"address_type_name":"Primary","created_at":"'.$api_req_data['currentdate'].'","updated_at":"'.$api_req_data['currentdate'].'"},
                        "emails":[{"address":"'.$api_req_data['email'].'","type_id":'.$api_req_data['emailid'].',"email_type_name":"'.$api_req_data['emailtype'].'"}],
                        "phones":[{"number":"'.$api_req_data['phone'].'","type_id":'.$api_req_data['billid'].',"phone_type_name":"'.$api_req_data['billtype'].'"}],
                        "links":[],
                        "addresses":[],
                        "service_stock_levels":[],
                        "day_cost":"",
                        "hour_cost":"",
                        "distance_cost":"",
                        "flat_rate_cost":"",
                        "icon":{  },
                        "child_members":[],
                        "parent_members":[]
                    }
                }';
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['crms_product'][0]['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['crms_product'][0]['api_token'].'','Content-Type:application/json'));
    # Return response instead of printing.
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    # Send request.
    return $result = curl_exec($ch);
}

function syncOpportunitiesTocrms($api_req_data,$member,$product_detail)
{
       // echo "<pre>";print_r($member);exit();
    $url = "https://api.current-rms.com/api/v1/opportunities/checkout";
    $ch = curl_init( $url );
    $projectname = $api_req_data['billing_project_name'];
    $description = $api_req_data['billing_project_comment'];
    $street = trim($api_req_data['address_1']);
    $city = trim($api_req_data['city']);
    $postcode = trim($api_req_data['postcode']);
    $county = trim($api_req_data['country']);
    $emails = trim($api_req_data['email']);
    $phones = trim($api_req_data['phone']);
    $project_start_date = str_replace('/', '-', $api_req_data['billing_booking_start_date']);
    $project_end_date = str_replace('/', '-', $api_req_data['billing_booking_end_date']);
    
    
    $startdt = date("Y-m-d", strtotime($project_start_date));
    $enddt = date("Y-m-d", strtotime($project_end_date));
    $prodata = $product_detail;
    $startdate = $startdt.'T18:30:00.000Z';
    $enddate = $enddt.'T18:30:00.000Z';
    $currentdate = date("Y-m-d").'T18:30:00.000Z';
    $memid = $member['member']['id'];
    $memuuid = $member['member']['uuid'];
    $memname = $member['member']['name'];

    if ($startdate == $enddate) {
        $pre = "" ;
        $collection = "";
        $show_starts_at = "";
        $show_ends_at = "";
    } else {
        $pre = $startdate ;
        $collection = $enddate;
        $show_starts_at = date('Y-m-d', strtotime( $startdt . " +1 days"));
        $show_ends_at = date('Y-m-d', strtotime( $enddt . " -1 days"));
    }
    $billingid = $member['member']['primary_address']['id'];
    $items = array();
    foreach ($prodata as $key => $value) {
        $subitem['opportunity_id'] = 1;
        $subitem['item_id'] = $api_req_data['crms_product'][$key]['crms_id'];
        $subitem['item_type'] = 1;
        $subitem['opportunity_item_type'] = 1;
        $subitem['name'] = $value['title'];
        $subitem['transaction_type'] = 1;
        $subitem['accessory_inclusion_type'] = 0;
        $subitem['accessory_mode'] = 0;
        $subitem['quantity'] = $value['qty'];
        $subitem['revenue_group_id'] = null;
        $subitem['rate_definition_id'] = 5;
        $subitem['service_rate_type'] = 0;
        $subitem['price'] = $value['price'];
        $subitem['discount_percent'] = 0;
        $subitem['starts_at'] = $startdate;
        $subitem['ends_at'] = $enddate;
        $subitem['use_chargeable_days'] = true;
        $subitem['sub_rent'] = false;
        $subitem['description'] = "";
        $subitem['replacement_charge'] = 0;
        $subitem['weight'] = 0.0;
        $subitem['custom_fields'] = json_decode('{}');
        $suballitem[] = $subitem;

    }
        //echo "<pre>";print_r($suballitem);exit();
    $items = $suballitem;
    $itmdata = json_encode($items);

    $payload = '
    {
        "opportunity":
            {
                "store_id":1,
                "project_id":null,
                "member_id":'.$memid.',
                "billing_address_id":'.$billingid.',
                "venue_id":null,
                "tax_class_id":1,
                "subject":"Web Enquiry '.$projectname.'",
                "description":"'.$description.'",
                "number":"",
                "starts_at":"'.$startdate.'",
                "ends_at":"'.$enddate.'",
                "charge_starts_at":"'.$startdate.'",
                "charge_ends_at":"'.$enddate.'",
                "ordered_at":"'.$currentdate.'",
                "quote_invalid_at":"",
                "state":1,
                "use_chargeable_days":false,
                "chargeable_days":1,
                "open_ended_rental":false,
                "invoiced":false,
                "rating":4,
                "revenue":"0",
                "customer_collecting":false,
                "customer_returning":false,
                "reference":"",
                "external_description":"",
                "owned_by":1,
                "prep_starts_at":"'.$show_starts_at.'",
                "prep_ends_at":"'.$show_ends_at.'",
                "load_starts_at":"'.$show_starts_at.'",
                "load_ends_at":"'.$show_ends_at.'",
                "deliver_starts_at":"'.$show_starts_at.'",
                "deliver_ends_at":"'.$show_ends_at.'",
                "setup_starts_at":"'.$show_starts_at.'",
                "setup_ends_at":"'.$show_ends_at.'",
                "show_starts_at":"'.$show_starts_at.'",
                "show_ends_at":"'.$show_ends_at.'",
                "takedown_starts_at":"'.$pre.'",
                "takedown_ends_at":"'.$pre.'",
                "collect_starts_at":"'.$collection.'",
                "collect_ends_at":"'.$collection.'",
                "unload_starts_at":"",
                "unload_ends_at":"",
                "deprep_starts_at":"",
                "deprep_ends_at":"",
                "tag_list":[],
                "assigned_surcharge_group_ids":[],
                "custom_fields":{},
                "participants":[{"uuid":"'.$memuuid.'",
                "member_id":"'.$memid.'",
                "mute":false,
                "member_name":"'.$memname.'",
                "created_at":"'.$currentdate.'",
                "updated_at":"'.$currentdate.'",
                "assignment_type":"Activity"}]
            },
                "items":'.$itmdata.'
    }';

    //echo "<pre>";print_r($payload);exit();
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['crms_product'][0]['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['crms_product'][0]['api_token'].'','Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec($ch);
     //echo "<pre>";print_r($response);exit();
     exit;   
    curl_close($ch);
}

function putOpportunities($oppid,$api_req_data)
{
    $name = $api_req_data['first_name'];
        $projectname = $api_req_data['billing_project_name'];
        $description = $api_req_data['billing_project_comment'];
        $street = trim($api_req_data['address_1']);
        $city = trim($api_req_data['city']);
        $postcode = trim($api_req_data['postcode']);
        $county = trim($api_req_data['state']);
        $emails = trim($api_req_data['email']);
        $phones = trim($api_req_data['phone']);

        $project_start_date = str_replace('/', '-', $api_req_data['billing_booking_start_date']);
        $project_end_date = str_replace('/', '-', $api_req_data['billing_booking_end_date']);
    
    
        $startdate = date("Y-m-d", strtotime($project_start_date));
        $enddate = date("Y-m-d", strtotime($project_end_date));


        /*$startdate = date("Y-m-d", strtotime($api_req_data['billing_booking_start_date']));
        $enddate = date("Y-m-d", strtotime($api_req_data['billing_booking_end_date']));*/
        $prodata = $product_detail;

        global $wpdb;
        $query = $wpdb->get_results("SELECT * FROM wp_crms_country WHERE `name` LIKE '".$api_req_data['state']."' OR `mname` LIKE '".$api_req_data['state']."'");

        $url = "https://api.current-rms.com/api/v1/opportunities/".$oppid['opportunity']['id'];
        $ch = curl_init( $url );
        $payload = '
                {
                    "opportunity":
                        {"destination":
                                {
                                "source_type":"Opportunity",
                                "address":{"name":"'.$name.'",
                                "street":"'.$street.'",
                                "postcode":"'.$postcode.'",
                                "city":"'.$city.'",
                                "county":"'.$county.'",
                                "country_id":"'.$query[0]->id.'",
                                "country_name":"'.$query[0]->name.'",
                                "created_at":"'.date("Y-m-d").'T18:30:00.000Z",
                                "updated_at":"'.date("Y-m-d").'T18:30:00.000Z"}
                                }
                        }
                }';

        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['crms_product'][0]['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['crms_product'][0]['api_token'].'','Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $response = curl_exec($ch);
        curl_close($ch);


        if (!empty($response)) {
            $url = "https://api.current-rms.com/api/v1/opportunities/".$oppid['opportunity']['id']."/convert_to_order";
            $ch = curl_init( $url );
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'].'','Content-Type:application/json'));
            # Return response instead of printing.
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            # Send request.
            $result = curl_exec($ch);
            curl_close($ch);
             
        }

}

add_action('woocommerce_thankyou', 'elite_CustomReadOrder');
function elite_CustomReadOrder($order_id)
{
    global $wpdb;
    $order = wc_get_order($order_id);
    $order_data = $order->get_data();
    $items = $order->get_items();
    
    $countries = WC()->countries->countries[ $order->get_billing_country() ];
    $states = WC()->countries->get_states( $order->get_billing_country() );
    $state  = ! empty( $states[ $order->get_billing_country() ] ) ? $states[ $order->get_billing_country() ] : '';

    $product_js = [];
    $api_req_data = array();
    foreach ($order_data['meta_data'] as $key => $meta_data) {
        $api_req_data[$meta_data->key] = $meta_data->value;        
    }

    /*order detail*/
    $api_req_data['first_name'] = $order_data['billing']['first_name'];

    /*billing detail*/
    $api_req_data['first_name'] = $order_data['billing']['first_name'];
    $api_req_data['last_name'] = $order_data['billing']['last_name'];
    $api_req_data['company'] = $order_data['billing']['company'];
    $api_req_data['address_1'] = $order_data['billing']['address_1'];
    $api_req_data['address_2'] = $order_data['billing']['address_2'];
    $api_req_data['city'] = $order_data['billing']['city'];
    $api_req_data['state'] = $order_data['billing']['state'];
    $api_req_data['postcode'] = $order_data['billing']['postcode'];
    $api_req_data['country'] = $order_data['billing']['country'];
    $api_req_data['email'] = $order_data['billing']['email'];
    $api_req_data['phone'] = $order_data['billing']['phone'];
    $api_req_data['billingtype'] = 'Personal';
    $api_req_data['currentdate'] = date("Y-m-d").'T18:30:00.000Z';
    $api_req_data['billid'] = 6005;
    $api_req_data['billtype'] = 'Home';
    $api_req_data['emailid'] = 4002;
    $api_req_data['emailtype'] = 'Home';

    if ($countryCode !== "") {
    $country = WC()->countries->countries[$api_req_data['country']];
    }
    if ($countryCode != "" && $stateId != '') {
    $state = WC()->countries->get_states( $api_req_data['country'] )[$stateId];
    }

    $country_data = explode('(', $country);
    $country_name = trim($country_data[0]);
           

    $order_detail_data = get_product_item_from_order($order_id);

    $api_req_data['crms_product'][]=array();
    foreach ($order_detail_data as $key => $order_pro_data) {
        $api_req_data['crms_product'][$key]['product_name'] = $order_pro_data['name'];
        $api_req_data['crms_product'][$key]['product_id'] = $order_pro_data['product_id'];
        $crms_id = get_post_meta( $order_pro_data['product_id'], 'crms_id', true); 
        $sub_domain = get_post_meta( $order_pro_data['product_id'], 'sub_domain', true);
        $api_token = get_post_meta( $order_pro_data['product_id'], 'api_token', true);

        $api_req_data['crms_product'][$key]['sub_domain'] = $sub_domain;
        $api_req_data['crms_product'][$key]['api_token'] = $api_token;
        $api_req_data['crms_product'][$key]['crms_id'] = $crms_id;
        $api_req_data['crms_product'][$key]['product_sku'] = $order_pro_data['sku'];
        $api_req_data['crms_product'][$key]['product_meta'] = $order_pro_data['meta'];
        $api_req_data['crms_product'][$key]['product_discount_amount'] = $order_pro_data['discount_amount'];
        $api_req_data['crms_product'][$key]['product_subtotal'] = $order_pro_data['subtotal'];
        $api_req_data['crms_product'][$key]['product_subtotal_tax'] = $order_pro_data['subtotal_tax'];
        $api_req_data['crms_product'][$key]['product_total'] = $order_pro_data['total'];
        $api_req_data['crms_product'][$key]['product_total_tax'] = $order_pro_data['total_tax'];
        $api_req_data['crms_product'][$key]['product_price'] = $order_pro_data['price'];
        $api_req_data['crms_product'][$key]['product_quantity'] = $order_pro_data['quantity'];
    }

        
    global $wpdb;
    $local_wp_crms_member = $wpdb->get_results("SELECT * FROM wp_crms_member WHERE email='".$api_req_data['email']."'");

           
        

    if($local_wp_crms_member){
        $url = "https://api.current-rms.com/api/v1/members/".$local_wp_crms_member[0]->id;
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['crms_product'][0]['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['crms_product'][0]['api_token'],'Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $memresult = curl_exec($ch);
        curl_close($ch);
        $member  = json_decode($memresult,true);
    }


    

    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    $product_detail = array();
    for ($i=0; $i < count($api_req_data['crms_product']); $i++) { 
    $product_detail[] = array('product_id' => $api_req_data['crms_product'][$i]['product_id'],
                            'title' => $api_req_data['crms_product'][$i]['product_name'],
                        'sku' => $api_req_data['crms_product'][$i]['product_sku'],
                    'price' => $api_req_data['crms_product'][$i]['product_price'],
                'qty' => $api_req_data['crms_product'][$i]['product_quantity']);
    }
    $sync_opportunity_detail = "";
    
        //echo "<pre>";print_r($local_wp_crms_member);exit();

    if(!empty($local_wp_crms_member)){
        syncOpportunitiesTocrms($api_req_data,$member,$product_detail);           
    }else{

        global $wpdb;
        if($local_wp_crms_member && isset($member['errors'])){
            $sql = "Delete FROM wp_crms_member Where id = ".$local_wp_crms_member[0]->id ;
            $data_deleted = $wpdb->get_results($sql);
        }
        $sync_member_detail = syncMemberTocrms($api_req_data,$country_name);

        $member  = json_decode($sync_member_detail,true);
            //echo "<pre>";print_r($member['member']['emails'][0]['address']);exit();

               
        if(!isset($member['errors'])){
                $memid = $member['member']['id'];
                $memuuid = $member['member']['uuid'];
                $memname = $member['member']['name'];
                $billingid = $member['member']['primary_address']['id'];
                $email = $member['member']['emails'][0]['address'];
                $sql = "Insert Into wp_crms_member (id, uuid, email, name, billing_id) Values (".$memid.",'".$memuuid."','".$email."','".$memname."',".$billingid.")";
                $Insert_mamber = $wpdb->get_results($sql);
               //echo "<pre>";print_r($product_detail);exit();
                syncOpportunitiesTocrms($api_req_data,$member,$product_detail);
            }

    }

    

    $oppid  = json_decode($sync_opportunity_detail,true);

    if(!isset($oppid['errors']) && $sync_opportunity_detail != null){        
        putOpportunities($oppid,$api_req_data);
        OrdertoOpportunity($oppid);
        
    }

    function OrdertoOpportunity($oppid){
        $url = "https://api.current-rms.com/api/v1/opportunities/".$oppid['opportunity']['id']."/convert_to_order";
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['crms_product'][0]['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['crms_product'][0]['api_token'].'','Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
    }
}

function iconic_remove_password_strength() {


    wp_dequeue_script( 'wc-password-strength-meter' );

}


add_action( 'wp_print_scripts', 'iconic_remove_password_strength', 10 );

/*remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );*/

/*display extra product custom meta*/
add_action( 'woocommerce_single_product_summary', 'display_product_custom_meta', 20 );
function display_product_custom_meta() {
    global $post;

    echo "<div class='custom_meta'><span class='weight_wrapper'>Weight: <span class='weight'>".get_post_meta($post->ID,'weight',true)."</span></span>";
    /*echo "<span class='replacement_charge_wrapper'>Replacement Charge: <span class='replacement_charge'>".get_post_meta($post->ID,'replacement_charge',true)."</span></span>";
    echo "<span class='purchase_price_wrapper'>Purchase Price: <span class='purchase_price'>".get_post_meta($post->ID,'purchase_price',true)."</span></span></div>";*/
    
}

//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


function filter_related_products($args){    
    global $product;

   $related_product = get_post_meta( $product->id, 'related_products', true );
    

    $related_product = explode(",",$related_product);
   
    $args = array();    
    $args = get_posts( 
      array( 
      'numberposts'  => -1, 
      'post__in' => $related_product,
      'post_type'    => 'product'
      ) 
    );
    
    return $args;
}
add_filter('woocommerce_related_products','filter_related_products');


add_filter( 'gettext', 'wps_translate_words_array' );
add_filter( 'ngettext', 'wps_translate_words_array' );
function wps_translate_words_array( $translated ) {
    $words = array(
    // 'word to translate' = > 'translation'
    'Related Products' => 'Accessories',
    );
    $translated = str_ireplace( array_keys($words), $words, $translated );
    return $translated;
}




// Hide Product Category Count
add_filter( 'woocommerce_subcategory_count_html', 'prima_hide_subcategory_count' );
function prima_hide_subcategory_count() {
  /* empty - no count */
}



/*add_filter( 'woocommerce_product_subcategories_args', 'ts_woocommerce_get_subcategories_ordering_args' );
function ts_woocommerce_get_subcategories_ordering_args( $args ) {
         $args['order'] = 'desc';
         $args['orderby'] = 'title';
         return $args;
    }*/

/*add_filter( 'post_limits', 'product_category_archives_limit', 20, 2 );
function product_category_archives_limit( $limit, $query ) {
    if ( is_product_category() ) {
        $limit = 'LIMIT 25';
    }
    return $limit;
}*/



/**
 * Change the default state and country on the checkout page
 */
add_filter( 'default_checkout_billing_country', 'change_default_checkout_country' );
//add_filter( 'default_checkout_billing_state', 'change_default_checkout_state' );

function change_default_checkout_country() {
  return 'GB'; // country code
}

/*function change_default_checkout_state() {
  return 'XX'; // state code
}*/


/*add_action('template_redirect','check_if_logged_in');
function check_if_logged_in()
{
    $pageid = 7; // your cart page id
    if(!is_user_logged_in() && is_page($pageid))
    {
        $url = add_query_arg(
            'redirect_to',
            get_permalink($pagid),
            site_url('/my-account/') // your my acount url
        );
        wp_redirect($url);
        exit;
    }
}*/


add_filter( 'woocommerce_thankyou_order_received_text', 'custom_thank_you_title', 20, 2 );
 
function custom_thank_you_title( $thank_you_title, $order ){
 
	return  'Thank you. Your Enquiry has been received.';
 
}

add_filter( 'gettext', function( $text ) {
if ( 'View cart' === $text ) {
    $text = 'View Flightcase';
}
if ( 'Checkout' === $text ) {
        $text = 'Flightcase';
    }
return $text;
} );


/*
add_action( 'get_terms', 'ts_get_subcategory_terms', 10, 3 );
function ts_get_subcategory_terms( $terms, $taxonomies, $args ) {
$new_terms = array();
// if it is a product category and on the shop page
if ( in_array( 'product_cat', $taxonomies ) && ! is_admin() &&is_shop() ) {
foreach( $terms as $key => $term ) {
if ( !in_array( $term->slug, array( 'uncategorised','lighting' ) ) ) { //pass the slug name here
$new_terms[] = $term;
}}
$terms = $new_terms;
}
return $terms;
}*/
