<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'bootstrap', site_url().'/wp-content/themes/suprema-child/css/bootstrap.min.css', array() );
        wp_enqueue_style( 'stripe', site_url().'/wp-content/themes/suprema-child/vendor/stripe.css', array() );
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'suprema_qodef_default_style','suprema_qodef_default_style','suprema_qodef_modules_plugins','suprema_qodef_modules','qodef_font_awesome','qodef_font_elegant','qodef_ion_icons','qodef_linea_icons','qodef_linear_icons','qodef_simple_line_icons','qodef_dripicons','qode_woocommerce','suprema_qodef_modules_responsive','suprema_qodef_blog_responsive','qode_woocommerce_responsive' ) );

        wp_enqueue_style('password-css', get_theme_file_uri() .'/css/password.css');
        wp_enqueue_script( 'password-js' , get_theme_file_uri() .'/js/password.js');
        
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

/*remove password strength*/
function iconic_remove_password_strength() {
    wp_dequeue_script( 'wc-password-strength-meter' );
}
add_action( 'wp_print_scripts', 'iconic_remove_password_strength', 10 );

// END ENQUEUE PARENT ACTION


function nm_child_theme_styles() {

    //wp_enqueue_style( 'nm-child-theme', get_stylesheet_directory_uri() . '/style.css' );

    //wp_enqueue_style( 'style', site_url().'/wp-content/themes/suprema-child/css/style.css', array(), $theme_version );

    wp_enqueue_script( 'jquery-ui', site_url().'/wp-content/themes/suprema-child/js/jquery-ui.js', array( 'jquery' ), true );
   wp_enqueue_script( 'password', site_url().'/wp-content/themes/suprema-child/js/password.js', array( 'jquery' ), true );   
    //wp_enqueue_style( 'jquery-ui', $template_dir . '/css/jquery-ui.css', array() );
    wp_enqueue_style( 'jquery-ui', site_url().'/wp-content/themes/suprema-child/css/jquery-ui.css', array() );
    wp_enqueue_style( 'password',site_url().'/wp-content/themes/suprema-child/css/password.css', array() );
    wp_enqueue_style( 'custom',site_url().'/wp-content/themes/suprema-child/css/custom.css', array() );
    wp_enqueue_style( 'font-awesome', site_url().'/wp-content/themes/suprema-child/css/font-awesome.css', array() );
    
   // wp_enqueue_style( 'bootstrap', site_url().'/wp-content/themes/suprema-child/css/bootstrap.min.css', array() );

    wp_enqueue_script( 'jquery', site_url().'/wp-content/themes/suprema-child/js/jquery-3.5.0.min.js', array( 'jquery' ), true );
    wp_enqueue_script( 'bootstrap', site_url().'/wp-content/themes/suprema-child/js/bootstrap.min.js', array( 'jquery' ), true );
    wp_enqueue_script( 'bootstrap-bundle', site_url().'/wp-content/themes/suprema-child/js/bootstrap.bundle.min.js', array( 'jquery' ), true );
     wp_enqueue_script( 'parallax', site_url().'/wp-content/themes/suprema-child/js/TweenMax.min.js', array( 'jquery' ), true );
    wp_enqueue_script( 'custom', site_url().'/wp-content/themes/suprema-child/js/custom.js', array( 'jquery' ), true );

    //wp_enqueue_script( 'jquery-js' , get_theme_file_uri() .'/js/jquery.min.js');
    //wp_enqueue_script( 'moment-js' , get_theme_file_uri() .'/js/moment.min.js');
    //wp_enqueue_script( 'daterangepicker-js' , get_theme_file_uri() .'/js/daterangepicker.min.js');
    //wp_enqueue_style('daterangepicker-css', get_theme_file_uri() .'/css/daterangepicker.css');
    /*custom range picker*/
    wp_enqueue_script( 'custom-moment-js' , get_theme_file_uri() .'/js/daterangepicker/moment.min.js');
    wp_enqueue_style('custom-daterangepicker-css', get_theme_file_uri() .'/js/daterangepicker/daterangepicker.css');
    wp_enqueue_script( 'custom-daterangepicker-js' , get_theme_file_uri() .'/js/daterangepicker/daterangepicker.js');


        global $woocommerce;
        if ( $woocommerce->cart->cart_contents_count == 0 ) {  
                WC()->session->set( 'from_date', null );              
                WC()->session->set( 'to_date', null );              
                
        }
    }
    add_action( 'wp_enqueue_scripts', 'nm_child_theme_styles', 1000 );



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


function get_product_item_from_order( $order_id ) {

    //global $wpdb;
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
                        "name":"'.$api_req_data['first_name']." ".$api_req_data['last_name'].'",
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
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'].'','Content-Type:application/json'));
    # Return response instead of printing.
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    # Send request.
    return $result = curl_exec($ch);
} 

function syncOpportunitiesTocrms($api_req_data,$member,$product_detail)
{
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
    
    
    

    $startdt = date("Y-m-d", strtotime($api_req_data['billing_booking_start_date']));
    $enddt = date("Y-m-d", strtotime($api_req_data['billing_booking_end_date']));
        //echo "<pre>";print_r($startdt);exit();



    $prodata = $product_detail;
    $startdate = $startdt.'T17:30:00.000Z';
    $enddate = $enddt.'T17:30:00.000Z';
    $currentdate = date("Y-m-d").'T18:30:00.000Z';
    $memid = $member['member']['id'];
    $memuuid = $member['member']['uuid'];
    $memname = $member['member']['name'];

    $billingid = $member['member']['primary_address']['id'];
    $pre = $startdate ;
    $show_starts_at = date('Y-m-d', strtotime( $startdt . " +1 days"));
    $show_ends_at = date('Y-m-d', strtotime( $enddt . " -1 days"));
    $collection = $enddate;
    $items = array();
    foreach ($prodata as $key => $value) {
        $subitem['opportunity_id'] = 1;
        $subitem['item_id'] = $api_req_data['crms_id'];
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
        $subitem['description'] = $description;
        $subitem['replacement_charge'] = 0;
        $subitem['weight'] = 0.0;
        $subitem['custom_fields'] = json_decode('{}');
        $suballitem[] = $subitem;

    }
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
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'].'','Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec($ch);
    //echo "<pre>";print_r($response);exit();
        //echo "<pre>";print_r($response);exit();
    $response_decode  = json_decode($response);
    $response_decoded = (array)$response_decode;

    if (!empty($response_decoded)) {
        $url = "https://api.current-rms.com/api/v1/opportunities/".$response_decoded['opportunity']->id."/opportunity_items";
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        # Print response.
        $result = json_decode($result);
    }
    $opportunity_items  = $result->opportunity_items;        
    $opportunity_id = $opportunity_items[1]->opportunity_id;
    $desired_opportunity_id = $opportunity_items[1]->id;
    update_post_meta( $order_id, 'crms_opp_id', $opportunity_id );
    update_post_meta( $order_id, 'crms_desired_opp_id', $desired_opportunity_id );

    
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
        $startdate = date("Y-m-d", strtotime($api_req_data['billing_booking_start_date']));
        $enddate = date("Y-m-d", strtotime($api_req_data['billing_booking_end_date']));
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
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'].'','Content-Type:application/json'));
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

    foreach ($order_detail_data as $key => $order_pro_data) {
        $api_req_data['product_name'] = $order_pro_data['name'];
        $api_req_data['product_id'] = $order_pro_data['product_id'];
        $crms_id = get_post_meta( $order_pro_data['product_id'], 'crms_id', true); 
        $sub_domain = get_post_meta( $order_pro_data['product_id'], 'sub_domain', true);
        $api_token = get_post_meta( $order_pro_data['product_id'], 'api_token', true);

        $api_req_data['sub_domain'] = $sub_domain;
        $api_req_data['api_token'] = $api_token;
        $api_req_data['crms_id'] = $crms_id;
        $api_req_data['product_sku'] = $order_pro_data['sku'];
        $api_req_data['product_meta'] = $order_pro_data['meta'];
        $api_req_data['product_discount_amount'] = $order_pro_data['discount_amount'];
        $api_req_data['product_subtotal'] = $order_pro_data['subtotal'];
        $api_req_data['product_subtotal_tax'] = $order_pro_data['subtotal_tax'];
        $api_req_data['product_total'] = $order_pro_data['total'];
        $api_req_data['product_total_tax'] = $order_pro_data['total_tax'];
        $api_req_data['product_price'] = $order_pro_data['price'];
        $api_req_data['product_quantity'] = $order_pro_data['quantity'];
    }



    global $wpdb;
    $local_wp_crms_member = $wpdb->get_results("SELECT * FROM wp_crms_member WHERE `name` LIKE '".$api_req_data['first_name']." ".$api_req_data['last_name']."'");

    if($local_wp_crms_member){
        $url = "https://api.current-rms.com/api/v1/members/".$local_wp_crms_member[0]->id;
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'],'Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $memresult = curl_exec($ch);
        curl_close($ch);
        $member  = json_decode($memresult,true);
    }

    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    $product_detail = array();
    $product_detail[] = array('product_id' => $api_req_data['product_id'],
                            'title' => $api_req_data['product_name'],
                        'sku' => $api_req_data['product_sku'],
                    'price' => $api_req_data['product_price'],
                'qty' => $api_req_data['product_quantity']);
    $sync_opportunity_detail = "";



    if($local_wp_crms_member){    
           
        syncOpportunitiesTocrms($api_req_data,$member,$product_detail);           
    }else{


        global $wpdb;
        if($local_wp_crms_member && isset($member['errors'])){
            $sql = "Delete FROM wp_crms_member Where id = ".$local_wp_crms_member[0]->id ;
            $data_deleted = $wpdb->get_results($sql);
        }
        $sync_member_detail = syncMemberTocrms($api_req_data,$country_name);
        $member  = json_decode($sync_member_detail,true);
        if(!isset($member['errors'])){
                $memid = $member['member']['id'];
                $memuuid = $member['member']['uuid'];
                $memname = $member['member']['name'];
                $billingid = $member['member']['primary_address']['id'];
                $email = $member['member']['emails'][0]['address'];
                $sql = "Insert Into wp_crms_member (id, uuid, email, name, billing_id) Values (".$memid.",'".$memuuid."','".$email."','".$memname."',".$billingid.")";
                $Insert_mamber = $wpdb->get_results($sql);
                syncOpportunitiesTocrms($api_req_data,$member,$product_detail);
            }

    }

}



function shortcode_HelloWorld() {
   return $data = add_star_rating();
}
add_shortcode('helloworld', 'shortcode_HelloWorld');


function add_star_rating(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo "<div class='qodef-product-list-holder'><div class='woocommerce'><ul class='qodef-featured-products featured'>";
    
        $test = 1;
    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);
            //print_r($explode_meta_value);
        if (in_array("New", $explode_meta_value) && $test < 4)
          {
            
            $test++;
            echo "<li class='qodef-product'> 

                <div class='qodef-product-featured-image-holder'>
                    <a href='". get_the_permalink() ."'>
                        ".get_the_post_thumbnail($loop->post->ID, 'shop_catalog')."
                    </a>
                    
                </div>
                <div class='qodef-product-featured-info'>
                    <a href='" . get_the_permalink() ."'>
                <h6 class='qodef-product-list-product-title'>".$product->get_name()."</h6>
                    </a>
                <div class='qodef-product-list-categories'>
                    ".$product->get_categories()."
                </div>
            </li>";
          }
     endwhile;
     echo "</ul></div></div>";
     
    wp_reset_query(); 
}


function shortcode_populerProduct() {
   return $data = DashboardPopulerProduct();
}
add_shortcode('DisplayPopulerProduct', 'shortcode_populerProduct');

function DashboardPopulerProduct(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo "<div class='qodef-product-list-holder'><div class='woocommerce'><ul class='qodef-featured-products featured'>";
    
        $test = 1;
    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);

        if (in_array("Popular", $explode_meta_value) && $test < 4)
          {
            
            $test++;
            echo "<li class='qodef-product'> 

                <div class='qodef-product-featured-image-holder'>
                    <a href='". get_the_permalink() ."'>
                        ".get_the_post_thumbnail($loop->post->ID, 'shop_catalog')."
                    </a>
                    
                </div>
                <div class='qodef-product-featured-info'>
                    <a href='" . get_the_permalink() ."'>
                <h6 class='qodef-product-list-product-title'>".$product->get_name()."</h6>
                    </a>
                <div class='qodef-product-list-categories'>
                    ".$product->get_categories()."
                </div>
            </li>";
          }
     endwhile;
     echo "</ul></div></div>";
     
    wp_reset_query(); 
}


//add_action('woocommerce_after_shop_loop_item', 'add_star_rating' );


remove_action('woocommerce_before_add_to_cart_button', 'woocommerce_template_single_meta', 30);

add_shortcode('display_equipment_cat','equipment_cat');
function equipment_cat(){
$args = array(
'hide_empty' => false, 
'number' => 10,
'orderby' => 'term_order',
'meta_query' => array(
    array(
       'key'       => 'display_in_equipment_category_section',
       'value'     => '1',
       'compare'   => '=='
    )
),
'taxonomy'  => 'product_cat',
);
$terms = get_terms( $args );
echo '<div class="woocommerce  wo-pro-cat">
            <ul class="products ">';
foreach ($terms as $term) {
        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id ); 
            echo '<li class="product-category product">
                <a href="'. get_term_link($term->term_id) .'"><img src="'. $image .'" alt="Cameras" width="600" height="600">
                    
                        <h2 class="woocommerce-loop-category__title">'. $term->name .'</h6>
                  </a>  
                   
            </li>';
          
}
 echo '</ul>
        </div>';
}


/**
* Change the breadcrumb separator
*/
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
// Change the breadcrumb delimeter from '/' to '>'
$defaults['delimiter'] = ' | ';
return $defaults;
}


add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
  function jk_related_products_args( $args ) {
    $args['posts_per_page'] = 5; // 4 related products
    
    return $args;
}
/*exclde products with Hidden tag*/
// The meta query in a function
function custom_meta_query( $meta_query ){
    $meta_query[] = array(
        'key'=>'tag_list',
        'value' => 'hidden',
        'compare'=>'NOT LIKE',
    );
    return $meta_query;
}

// The main shop and archives meta query
add_filter( 'woocommerce_product_query_meta_query', 'custom_product_query_meta_query', 10, 2 );
function custom_product_query_meta_query( $meta_query, $query ) {
    if( ! is_admin() )
        return custom_meta_query( $meta_query );
}

// The shortcode products query
add_filter( 'woocommerce_shortcode_products_query', 'custom__shortcode_products_query', 10, 3 );
function custom__shortcode_products_query( $query_args, $atts, $loop_name ) {
    if( ! is_admin() )
        $query_args['meta_query'] = custom_meta_query( $query_args['meta_query'] );
    return $query_args;
}





/*Registration (Shortcode)*/
/**
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
   
add_shortcode( 'wc_reg_form_bbloomer', 'bbloomer_separate_registration_form' );
    
function bbloomer_separate_registration_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return;
   ob_start();
 
   // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
   // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
 
   do_action( 'woocommerce_before_customer_login_form' );
 
   ?>
      <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
 
         <?php do_action( 'woocommerce_register_form_start' ); ?>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
               <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>
 
         <?php endif; ?>
 
         <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
         </p>
 
         <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
 
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
               <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
               <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
            </p>
 
         <?php else : ?>
 
            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
 
         <?php endif; ?>
 
         <?php do_action( 'woocommerce_register_form' ); ?>
 
         <p class="woocommerce-FormRow form-row">
            <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
         </p>
 
         <?php do_action( 'woocommerce_register_form_end' ); ?>
 
      </form>
 
   <?php
     
   return ob_get_clean();
}


/*Login Shortcode*/
/**
 * @snippet       WooCommerce User Login Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.0
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
add_shortcode( 'wc_login_form_bbloomer', 'bbloomer_separate_login_form' );
  
function bbloomer_separate_login_form() {
   if ( is_admin() ) return;
   if ( is_user_logged_in() ) return; 
   ob_start();
   woocommerce_login_form( array( 'redirect' => 'https://custom.url' ) );
   return ob_get_clean();
}

add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );


/*add_action('create_product_cat', 'my_theme_do_something', 10, 2);

function my_theme_do_something($term_id, $taxonomy_term_id){
    update_term_meta( $term_id, "display_in_equipment_category_section" ,0 );
    update_term_meta( $term_id, "_display_in_equipment_category_section" ,'field_60bf722a11ae2' );*/
    /*$term_var = get_term_by('id', $term_id, 'product_cat');
    wp_update_term( $term_var->term_id, 'product_cat', array(
        'name' => $term_var->name,
        'slug' =>  $term_var->slug
    ) );*/
    /*delete_transient( 'wc_term_counts' );
    wp_clean_update_cache();*/
    //wc_delete_product_transients( $term_id );
    /*$term_var = get_term_by('id', $term_id, 'product_cat');
    wp_insert_term(
        $term_var->name,   // the term 
        'product_cat', // the taxonomy
        array(
            'slug'        => $term_var->slug,
            'parent'      => 1814,
        )
    );*/

    /*delete_option("product_cat_children");
    wp_cache_flush();
}*/


add_action( 'admin_init', 'stDevCleatCache' );
function stDevCleatCache(){  
    delete_option("product_cat_children");  
   _get_term_hierarchy('product_cat');
}


//12/08/2021 Work
add_filter( 'body_class','halfhalf_body_class' );
function halfhalf_body_class( $classes ) {
 
    global $post;

    if( $post->ID == 124688 || $post->ID == 124690 || $post->ID == 124694 || $post->ID == 124696 || $post->ID == 124700 || $post->ID == 124815 || $post->ID == 7 || $post->ID == 125006) {
        $classes[] = 'tax-product_cat';
        $classes[] = 'qodef-woocommerce-page';
        $classes[] = 'qodef-woocommerce-columns-4';
    }


    if($post->ID == 125883){
$classes[] = 'bud-prd-cls';
}
     
    return $classes;
     
}

function sc_for_new_arrivals() {
   return $data = new_arrivals();
}
add_shortcode('New_Arrivals', 'sc_for_new_arrivals');


function new_arrivals(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo '<div class="qodef-content">
    <div class="qodef-content-inner">
    <div class="qodef-container">
    <div class="qodef-container-inner clearfix">
    <ul class="products standard">
    <li class="sub_cat_product product-category product first">
    <ul class="products">';

    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);
            //print_r($explode_meta_value);
        if (in_array("New", $explode_meta_value) ){
            
            echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $product_id ) ) ) . '">';
            echo '<div class="qodef-product-standard-image-holder"><a href="'. get_permalink( $loop->post->ID ) .'" title="'. esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID) .'">'. woocommerce_show_product_sale_flash( $post, $product );
            if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '</a><div class="qodef-product-standard-button-holder">';
            echo woocommerce_template_loop_add_to_cart( $loop->post, $product );
            echo '</div></div><div class="title_price"><h3>'. get_the_title().'</h3><span class="price">'. $product->get_price_html().'</span></div></li>';
        }
    endwhile;
    echo "</ul></li></ul></div></div></div></div>";
}

function sc_for_essentials() {
   return $data = essentials();
}
add_shortcode('Essentials', 'sc_for_essentials');


function essentials(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo '<div class="qodef-content">
    <div class="qodef-content-inner">
    <div class="qodef-container">
    <div class="qodef-container-inner clearfix">
    <ul class="products standard">
    <li class="sub_cat_product product-category product first">
    <ul class="products">';

    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);
            //print_r($explode_meta_value);
        if (in_array("Essentials", $explode_meta_value) || in_array("essential", $explode_meta_value)){
            
            echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $product_id ) ) ) . '">';
            echo '<div class="qodef-product-standard-image-holder"><a href="'. get_permalink( $loop->post->ID ) .'" title="'. esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID) .'">'. woocommerce_show_product_sale_flash( $post, $product );
            if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '</a><div class="qodef-product-standard-button-holder">';
            echo woocommerce_template_loop_add_to_cart( $loop->post, $product );
            echo '</div></div><div class="title_price"><h3>'. get_the_title().'</h3><span class="price">'. $product->get_price_html().'</span></div></li>';
        }
    endwhile;
    echo "</ul></li></ul></div></div></div></div>";
}

function sc_for_exclusive() {
   return $data = exclusive();
}
add_shortcode('Exclusive', 'sc_for_exclusive');


function exclusive(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo '<div class="qodef-content">
    <div class="qodef-content-inner">
    <div class="qodef-container">
    <div class="qodef-container-inner clearfix">
    <ul class="products standard">
    <li class="sub_cat_product product-category product first">
    <ul class="products">';

    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);
            //print_r($explode_meta_value);
        if (in_array("Exclusive", $explode_meta_value) ){
            
            echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $product_id ) ) ) . '">';
            echo '<div class="qodef-product-standard-image-holder"><a href="'. get_permalink( $loop->post->ID ) .'" title="'. esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID) .'">'. woocommerce_show_product_sale_flash( $post, $product );
            if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '</a><div class="qodef-product-standard-button-holder">';
            echo woocommerce_template_loop_add_to_cart( $loop->post, $product );
            echo '</div></div><div class="title_price"><h3>'. get_the_title().'</h3><span class="price">'. $product->get_price_html().'</span></div></li>';
        }
    endwhile;
    echo "</ul></li></ul></div></div></div></div>";
}

function sc_for_popular() {
   return $data = popular();
}
add_shortcode('Popular', 'sc_for_popular');


function popular(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo '<div class="qodef-content">
    <div class="qodef-content-inner">
    <div class="qodef-container">
    <div class="qodef-container-inner clearfix">
    <ul class="products standard">
    <li class="sub_cat_product product-category product first">
    <ul class="products">';

    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);
            //print_r($explode_meta_value);
        if (in_array("Popular", $explode_meta_value) ){
            
            echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $product_id ) ) ) . '">';
            echo '<div class="qodef-product-standard-image-holder"><a href="'. get_permalink( $loop->post->ID ) .'" title="'. esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID) .'">'. woocommerce_show_product_sale_flash( $post, $product );
            if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '</a><div class="qodef-product-standard-button-holder">';
            echo woocommerce_template_loop_add_to_cart( $loop->post, $product );
            echo '</div></div><div class="title_price"><h3>'. get_the_title().'</h3><span class="price">'. $product->get_price_html().'</span></div></li>';
        }
    endwhile;
    echo "</ul></li></ul></div></div></div></div>";
}

function sc_for_sale() {
   return $data = sale();
}
add_shortcode('Sale', 'sc_for_sale');


function sale(){
    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo '<div class="qodef-content">
    <div class="qodef-content-inner">
    <div class="qodef-container">
    <div class="qodef-container-inner clearfix">
    <ul class="products standard">
    <li class="sub_cat_product product-category product first">
    <ul class="products">';

    while ( $loop->have_posts() ) : $loop->the_post(); global $product;
                    //print_r($explode_meta_value);
        if ($product->is_on_sale() ){
            echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $product_id ) ) ) . '">';
            echo '<span class="title_tag"><span class="m-none">ONLINE ONLY</span> SALE</span>';
            echo '<div class="qodef-product-standard-image-holder"><a href="'. get_permalink( $loop->post->ID ) .'" title="'. esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID) .'">'. woocommerce_show_product_sale_flash( $post, $product );
            if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '</a><div class="qodef-product-standard-button-holder">';
            echo woocommerce_template_loop_add_to_cart( $loop->post, $product );
            echo '</div></div><div class="title_price"><h3>'. get_the_title().'</h3><span class="price">'. $product->get_price_html().'</span></div></li>';
        }
    endwhile;
    echo "</ul></li></ul></div></div></div></div>";
}

add_action( 'woocommerce_after_add_to_cart_button', 'add_custom_button', 10, 0 );
function add_custom_button() { 
    $my_custom_link = home_url('/my_page_slug/');
    global $post, $product;
        $custom_fields = get_post_meta( $product->get_ID(), 'custom_fields', true);
        $custom_field = json_decode($custom_fields);

        $image = wp_get_attachment_url( $product->get_image_id() );

        echo '<a class="qodef-btn qodef-btn-medium qodef-btn-solid qodef-btn-icon single_add_to_cart_button alt site-btn check-btn" data-toggle="modal" data-target="#product_'.$post->ID.'"><span class="qodef-btn-text">Check Availability</span>    <i class="qodef-icon-linear-icon lnr lnr-cart "></i></a>';

            //echo "<pre>";print_r();exit();

        $product_modal =  '<div class="modal fade" id="product_'.$post->ID.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal_main_div">
                  <div class="modal-body">
                    <img src='.$image.' data-id='.$post->ID.'>
                    <h4>'.$product->name.'</h4>
                  
                  <div class="price_label">
                    <label>Price Per Day</label>
                    <p class='.esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ).'>'.$product->get_price_html().'</p>';
                if ( $product->is_on_sale() ) {
                   $product_modal .='<span class="tag_line_for_sell">Book Online and Save '.$custom_field->discount_percentage."%" .'</span>'; 
                }

                $product_modal .= '<form class="cart" method="post" enctype="multipart/form-data">
                    <div class="quantity_submit">
                    <div class="quantity">
                        <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Quantity" class="input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
                    </div>

                    <input type="hidden" name="add-to-cart" value='.get_the_ID().'>

                    <button type="submit" class="single_add_to_cart_button button alt"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button></div>
                </form></div></div>
                <div class="calender_div">
                    <h4>Product Availability</h4>
                    <input id="daterangepicker1" type="hidden">
                    <div id="daterangepicker1-container" class="embedded-daterangepicker"></div>
                </div>
                
                </div>';


              echo  $product_modal .=  '<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
            
            ';
    
}; 

function cw_change_product_price_display( $price ) {
    global $product;
    if (in_array('1007', $product->category_ids)) { 
        $price .= '<span class="day"> / DAY</span>';
    }else{
        $price = $price;   
    }
        return $price;
}
add_filter( 'woocommerce_get_price_html', 'cw_change_product_price_display' );

function calculate_gift_wrap_fee( $cart_object ) {
    if( !WC()->session->__isset( "reload_checkout" )) {
        /* Gift wrap price */
        $additionalPrice = 100;
        foreach ( WC()->cart->get_cart() as $key => $value ) {
            if( isset( $value["gift_wrap_fee"] ) ) {                
                if( method_exists( $value['data'], "set_price" ) ) {
                                        /* Woocommerce 3.0 + */
                    $orgPrice = floatval( $value['data']->get_price() );
                    $value['data']->set_price( $orgPrice + $additionalPrice );
                } else {
                        /* Version before 3.0 */
                    $orgPrice = floatval( $value['data']->price );
                    $value['data']->price = ( $orgPrice + $additionalPrice );                    
                }           
            }
        }
    }
}
function from_date(){
    $from_d = $_REQUEST['from_date'];
    WC()->session->set( 'from_date', $from_d );
    echo WC()->session->get( 'from_date' );
    exit();
}

add_action("wp_ajax_from_date", "from_date");
add_action("wp_ajax_nopriv_from_date", "from_date");

function to_date(){
    $to_d =$_REQUEST['to_date'];
    WC()->session->set( 'to_date', $to_d );
    echo WC()->session->get( 'to_date' );
    exit();
}

add_action("wp_ajax_to_date", "to_date");
add_action("wp_ajax_nopriv_to_date", "to_date");


/*function prefix_add_discount_line( $cart ) {
    $date1=date_create(WC()->session->get( 'from_date' ));
    $date2=date_create(WC()->session->get( 'to_date' ));
    $diff=date_diff($date1,$date2);
    
    $cart->subtotal *= $diff->format("%a");

  

}
add_action( 'woocommerce_cart_calculate_fees', 'prefix_add_discount_line' );

add_filter( 'woocommerce_calculated_total', 'custom_calculated_total', 10, 2 );
function custom_calculated_total( $total, $cart ){

    $date1=date_create(WC()->session->get( 'from_date' ));
    $date2=date_create(WC()->session->get( 'to_date' ));
    $diff=date_diff($date1,$date2);

    return round( $total * $diff->format("%a"), $cart->dp );
}*/

add_action( 'woocommerce_before_calculate_totals', 'add_custom_price', 10, 1);
function add_custom_price( $cart_object ) {

    /*$date1=date_create(WC()->session->get( 'from_date' ));
    $date2=date_create(WC()->session->get( 'to_date' ));
        echo "<pre>";print_r($date1);
        echo "<pre>";print_r($date2);exit();*/


    $date1=WC()->session->get( 'from_date' );
    $date2=WC()->session->get( 'to_date' );

    $date1 = str_replace('/', '-', $date1);
    $date2 = str_replace('/', '-', $date2);
    $dateTimestamp1 = strtotime($date1);
    $dateTimestamp2 = strtotime($date2);


    $date1 = date_create($date1);
    $date2 = date_create($date2);
            
    $diff=date_diff($date1,$date2);
    $diff_count = $diff->format("%a Days");

    if ($diff_count != "0 Days") {

    $diff_count = $diff_count +1;
    $diff_count = $diff_count." Days";
    }



        //echo "<pre>";print_r($diff_count);exit();

        





        

        //echo "<pre>";print_r($diff_cont);exit();

    //$diff=date_diff($date1,$date2);
        /*echo "<pre>";  
        print_r($diff);
        echo "<br>";
        print_r($date1);
        echo "<br>";
        print_r($date2);
        exit();*/

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    foreach ( $cart_object->get_cart() as $cart_item ) {
        ## Price calculation ##
        if($diff_count == '0'){
            $price = $cart_item['data']->price;
        }else{
            $price = $cart_item['data']->price * $diff_count;
        }

        ## Set the price with WooCommerce compatibility ##
        if ( version_compare( WC_VERSION, '3.0', '<' ) ) {
            $cart_item['data']->price = $price; // Before WC 3.0
        } else {
            $cart_item['data']->set_price( $price ); // WC 3.0+
        }
    }
}

function insurence(){

    $insurance_amount = $_REQUEST['insurance_amount'];
    $insurance_per = $_REQUEST['insurance_per'];
        
    echo $insurance_amount;
    echo $insurance_per;
    WC()->session->set( 'insurance_amount', $insurance_amount );
    WC()->session->set( 'insurance_per', $insurance_per );
    
    exit();
}

add_action("wp_ajax_insurence", "insurence");
add_action("wp_ajax_nopriv_insurence", "insurence");

function submit_collection_return(){

    $butoon_collection = $_POST['button_collection'];
    $butoon_return = $_POST['button_return'];
    WC()->session->set( 'butoon_collection', $butoon_collection );
    WC()->session->set( 'butoon_return', $butoon_return );
    
    exit();
}

add_action("wp_ajax_submit_collection_return", "submit_collection_return");
add_action("wp_ajax_nopriv_submit_collection_return", "submit_collection_return");

add_action('woocommerce_cart_calculate_fees', function() {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }
    
    $percentage = WC()->session->get( 'insurance_amount' );  // Percentage (5%) in float
    $percentage_fee = $percentage;
    if( WC()->session->get( 'insurance_amount' )){
        WC()->cart->add_fee(__('Insurance', 'txtdomain'), $percentage_fee);
    }
    $butoon_collection = WC()->session->get( 'butoon_collection' );  // Percentage (5%) in float
    $butoon_collection_fee = $butoon_collection;
    $butoon_return = WC()->session->get( 'butoon_return' );  // Percentage (5%) in float
    $butoon_return_fee = $butoon_return;
    $Collection_and_Return_Total = $butoon_collection_fee + $butoon_return_fee;

    
    if( WC()->session->get( 'butoon_collection' ) != "" && WC()->session->get( 'butoon_return' ) != "" ){
        WC()->cart->add_fee(__('Collection & Return Total', 'txtdomain'), $Collection_and_Return_Total);
    }
});


function sc_for_did_you_forget() {
   return $data = did_you_forget();
}
add_shortcode('Did_You_Forget', 'sc_for_did_you_forget');



function checkUpsellProduct()
{
    global $wpdb;
    $url = "https://api.current-rms.com/api/v1/products?page=1&per_page=20000&filtermode=all&q%5Bname_or_product_group_name_or_tags_name_cont%5D=UpsellEssentials";
    $ch = curl_init( $url );
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $memresult = curl_exec($ch);
    curl_close($ch);
    $product_detail  = json_decode($memresult,true);

     //   echo "<pre>";print_r($product_detail['products']);
     $upsell_pro = array();
    foreach($product_detail['products'] as $key => $value){
            

        
            $upsell_pro[] = $value['id'];
        
      
    }   
               

        return $upsell_pro;

       // echo "<pre>";print_r($subArray);

    //return $subArray;
}


function did_you_forget(){

    $UpsellAcc = checkUpsellProduct();
    global $wpdb;
    

    $args = array(
    'post_type' => 'product',
    'stock' => 1,
    'posts_per_page' => -1,
    'orderby' =>'date',
    'order' => 'DESC'
    
    );
    $loop = new WP_Query( $args );

    echo '<div class="qodef-content">
    <div class="qodef-content-inner">
    <div class="qodef-container">
    <div class="qodef-container-inner clearfix">
    <ul class="products standard">
    <li class="sub_cat_product product-category product first">
    <ul class="products">';

    foreach ($UpsellAcc as $key => $value) {
        $result = $wpdb->get_var( "SELECT post_id FROM wp_postmeta WHERE meta_key = 'crms_id' AND meta_value = '".$value."'");
         $cart_pro = WC()->cart->get_cart();

            $product_ids =array();
            foreach( WC()->cart->get_cart() as $cart_item )
            {
                $product_ids[] = $cart_item['product_id'];
            }


             //echo "<pre>";print_r($product_ids);
         if(!empty($result)){
                $prd = wc_get_product( $result );
                $pid = $prd->get_id();

                if (in_array($pid, $product_ids)) {
                    continue;
                }
                //echo "<pre>";print_r($prd->get_id());
                   /* echo "<pre>";print_r($prd);
                    echo $pid;*/
                echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $pid ) ) ) . '">';
            echo '<div class="qodef-product-standard-image-holder">';
            if (has_post_thumbnail( $pid )) echo get_the_post_thumbnail($pid, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '<a href="'.get_permalink( $pid ) .'" value="'. esc_attr( $pid ).'" class="add_to_cart_button ajax_add_to_cart product_type_simple ass_btn" data-product_id="'. $pid .'" target="_self" rel="nofollow" data-product_sku="'.esc_attr($prd->get_sku()) .'" data-quantity="1">+</a>';
            echo '</div><div class="title_price"><h3>'. $prd->get_title().'</h3><span class="price">'. $prd->get_price_html().'</span></div></li>';
        }
    }

    /*while ( $loop->have_posts() ) : $loop->the_post(); global $product;
        global $wpdb;    
        $result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$loop->post->ID."'");
        $explode_meta_value = explode(',', $result[0]->meta_value);



            //print_r($explode_meta_value);
        if (in_array("EssentialUpSell", $explode_meta_value) ){
            
            echo '<li class="' . esc_attr( implode( ' ', wc_get_product_class( '', $product_id ) ) ) . '">';
            echo '<div class="qodef-product-standard-image-holder">'. woocommerce_show_product_sale_flash( $post, $product );
            if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />';
            echo '<a href="'.get_permalink( $loop->post->ID ) .'" value="'. esc_attr( $loop->post->ID ).'" class="add_to_cart_button ajax_add_to_cart product_type_simple ass_btn" data-product_id="'. $loop->post->ID .'" target="_self" rel="nofollow" data-product_sku="'.esc_attr($product->get_sku()) .'" data-quantity="1">+</a>';
            echo '</div><div class="title_price"><h3>'. get_the_title().'</h3><span class="price">'. $product->get_price_html().'</span></div></li>';
        }
    endwhile;*/
    echo "</ul></li></ul></div></div></div></div>";
}

function sc_for_did_you_forget2() {
   return $data = did_you_forget2();
}
add_shortcode('Did_You_Forget2', 'sc_for_did_you_forget2');

function checkForUpsellAcc($product_id)
{
    global $wpdb;
    $url = "https://api.current-rms.com/api/v1/products/".$product_id;
    $ch = curl_init( $url );
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $memresult = curl_exec($ch);
    curl_close($ch);
    $product_detail  = json_decode($memresult,true);

     $subArray = array();
    foreach($product_detail['product']['custom_fields'] as $key => $value){
      if(preg_match('/^upsell_accessory_/',$key)){        

        if (!empty($value)) {
            $subArray[] = $value;
        }
      }
    }
        return $subArray;

       // echo "<pre>";print_r($subArray);

    //return $subArray;
}


function did_you_forget2(){

   
    

    global $wpdb;  
    $count = 1; 
    
    echo '<div class="row">';
    foreach( WC()->cart->get_cart() as $cart_item ){
        $product_id = $cart_item['product_id'];
        $product = wc_get_product( $product_id );
        $crms_id = get_post_meta( $product_id, 'crms_id', true);
         $UpsellAcc = checkForUpsellAcc($crms_id);
        //echo "<pre>";print_r($UpsellAcc);


        $product_name = $product->get_title();
        /*if ($count%2 == 1)
        {  
        }*/
        if(!empty($UpsellAcc)){
        echo '<div class="col"><div class="for-add-prod-box">';
        echo '<h4 class="forget-nor-head">'.$product_name.'</h4>';
        echo '<div class="forgot-pro-col-wrp">';
        echo '<div class="forgate-pro-pop">';
        echo '<img src="'. wp_get_attachment_url( $product->get_image_id() ).'" height="300" width="300" />';
        echo '</div>';
        echo '<div class="optional-acces modal-pop-optional">';
        echo '<ul class="ass_data">';
        $meta = get_post_meta($product_id,'EssentialUpSell',true);
        $exp_meta = explode(',',$meta);
        foreach ( $UpsellAcc as $a ){
            $result = $wpdb->get_var( "SELECT post_id FROM wp_postmeta WHERE meta_key = 'crms_id' AND meta_value = '".$a."'");
            if(!empty($result)){
                $prd = wc_get_product( $result );
                //print_r($prd."test");
                $price = get_post_meta( $result, '_price', true );


                $pid = $prd->get_id();

                $product_ids_data =array();
                foreach( WC()->cart->get_cart() as $cart_item )
                {
                    $product_ids_data[] = $cart_item['product_id'];
                }

                if (in_array($pid, $product_ids_data)) {
                    continue;
                }
                //echo $prd->add_to_cart_url();
                echo '<li>
                        <div class="opt-data-acces-title">
                            <h4>'. $prd->get_title().'</h4></a>
                            <p>'.wc_price( $price ).'</p>
                        </div>
                        <a href="'.get_permalink( $pid ) .'" value="'.round($price,0).'" class="add_to_cart_button ajax_add_to_cart product_type_simple ass_btn popup_add_t_cart" data-product_id="'. $result.'" target="_self" rel="nofollow" data-product_sku="'.esc_attr($prd->get_sku()) .'" data-quantity="1">+</a>
                        </li>';
            }           
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div></div>';
    }
        /*if ($count%2 == 0 )
        {
        }
        $count++;*/
    }
        echo "</div>";
    // if ($count%4 != 1) echo "</div>";
}


function syncMemberdataRMS($api_req_data,$database_country_data)
{


    $url = "https://api.current-rms.com/api/v1/members";
        $ch = curl_init( $url );
        
        $payload = '{
                        "member":
                        {
                            "name":"'.$api_req_data['first_name']." ".$api_req_data['last_name'].'",
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
                            "primary_address":{"name":"'.$api_req_data['first_name'].'","street":"'.$api_req_data['address_1'].'","postcode":"'.$api_req_data['postcode'].'","city":"'.$api_req_data['city'].'","county":"'.$api_req_data['city'].'","country_id":"'.$database_country_data[0]->id.'","country_name":"'.$database_country_data[0]->name.'","type_id":3001,"address_type_name":"Primary","created_at":"'.$api_req_data['currentdate'].'","updated_at":"'.$api_req_data['currentdate'].'"},
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
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'].'','Content-Type:application/json'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        
        $result = curl_exec($ch);
        $result_decode = json_decode($result);
        //echo "<pre>";print_r($result_decode);exit();
        return $result_decode;
}

function syncOppToRMS($api_req_data,$memberDetail,$product_detail)
{   
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
    $sts = trim($api_req_data['sts']);
    $startdt = date("Y-m-d", strtotime($api_req_data['billing_booking_start_date']));
    $enddt = date("Y-m-d", strtotime($api_req_data['billing_booking_end_date']));
    $prodata = $product_detail;
        echo "<pre>";
        print_r($api_req_data['billing_booking_start_date']);
        echo "<br>";
        print_r($startdt);
        exit();

    $startdate = $startdt.'T18:30:00.000Z';
    $enddate = $enddt.'T18:30:00.000Z';
    $currentdate = date("Y-m-d").'T18:30:00.000Z';

    
        //echo "<pre>";print_r($memberDetail);exit();

    $memid = $memberDetail['crms_member_id'];
    $memuuid = $memberDetail['crms_member_uuid'];
    $memname = $memberDetail['crms_member_name'];
    $billing_address_id = $memberDetail['billing_address_id'];


    $billingid = $memberDetail['crms_member_email'];
    $pre = $startdate ;
    $show_starts_at = date('Y-m-d', strtotime( $startdt . " +1 days"));
    $show_ends_at = date('Y-m-d', strtotime( $enddt . " -1 days"));
    $collection = $enddate;
    $items = array();
    foreach ($prodata as $key => $value) {
        $subitem['opportunity_id'] = 1;
        $subitem['item_id'] = $value['item_id'];
        $subitem['item_type'] = 1;
        $subitem['opportunity_item_type'] = 1;
        $subitem['name'] = $value['name'];
        $subitem['transaction_type'] = 1;
        $subitem['accessory_inclusion_type'] = 0;
        $subitem['accessory_mode'] = 0;
        $subitem['quantity'] = $value['quantity'];
        $subitem['revenue_group_id'] = null;
        $subitem['rate_definition_id'] = 5;
        $subitem['service_rate_type'] = 0;
        $subitem['price'] = $value['price'];
        $subitem['discount_percent'] = 0;
        $subitem['starts_at'] = $startdate;
        $subitem['ends_at'] = $enddate;
        $subitem['use_chargeable_days'] = true;
        $subitem['sub_rent'] = false;
        $subitem['description'] = $value['description'];
        $subitem['replacement_charge'] = 0;
        $subitem['weight'] = 0.0;
        $subitem['custom_fields'] = json_decode('{}');
        $suballitem[] = $subitem;

    }
    $items = $suballitem;

    $itmdata = json_encode($items);
        
    $payload = '
    {
        "opportunity":
            {
                "store_id":1,
                "project_id":null,                
                "member_id":'.$memid.',
                "billing_address_id":'.$billing_address_id.',
                "venue_id":null,
                "tax_class_id":1,
                "subject":"Test Drive '.$projectname.'",
                "description":"'.$description.'",
                "number":"",
                "starts_at":"'.$startdate.'",
                "ends_at":"'.$enddate.'",
                "charge_starts_at":"'.$startdate.'",
                "charge_ends_at":"'.$enddate.'",
                "ordered_at":"'.$currentdate.'",
                "quote_invalid_at":"",
                "state":3,
                "state_name":"Order",
                "status": 20,
                "status_name": "Active",
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
                "tag_list":["'.$sts.'"],
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
 echo "<pre>payload";print_r($payload);exit();
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'].'','Content-Type:application/json'));
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec($ch);
        echo "mnsdbaajkh";
        echo "<pre>";print_r(json_decode($response));exit();

        /*if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }
        else
        {
            echo 'Operation completed without any errors';
        }*/
        return $response;
       
        curl_close($ch);
        
}

function opp_save_draft(){
    $billing_emailid =$_REQUEST['billing_emailid'];



    $from_date = WC()->session->get( 'from_date' );
    $to_date = WC()->session->get( 'to_date' );

       // echo "<pre>";print_r("test");exit();

    $country_name = "United Kingdom";
    $trim_country_name = trim($country_name);
    global $wpdb;
    $database_country_data = $wpdb->get_results( "SELECT * FROM wp_crms_country WHERE `name` LIKE '".$trim_country_name."' OR `mname` LIKE '".$trim_country_name."'");
        //echo "<pre>";print_r($database_country_data[0]);exit();
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            $product = $cart_item['data'];
            if(!empty($product)){
                $product_id = $cart_item['product_id'];
                $crms_id = get_post_meta( $product_id, 'crms_id', true); 
                $quantity = $cart_item['quantity'];
                $product_name = $product->get_name();
                $price = $cart_item['data']->get_price();
                $product_desc = $product->get_description();

                $product_detail[] = array('item_id' => $crms_id,'name' => $product_name,'quantity' => $quantity,'price' => $price, 'description' => $product_desc );
            }
        }

            
    $api_req_data = array('is_vat_exempt' => "no",
                        'billing_project_name' => "Test Project",
                        'billing_project_type' => "TV",
                        'billing_booking_start_date' => $from_date,
                        'billing_booking_end_date' => $to_date,
                        'billing_collection' => "",
                        'billing_return' => "",
                        'billing_project_comment' => "test comment",
                        'first_name' => "robert1",
                        'last_name' => "robert Test",
                        'company' => "Light House",
                        'address_1' => "3 Orchard Way",
                        'address_2' => "Horsmonden",
                        'city' => "Horsmonden",
                        'state' => "kent",
                        'postcode' => "TN12 8JX",
                        'country' => "GB",
                        'email' => $billing_emailid,
                        'phone' => "07595219710",
                        'billingtype' => "Personal",
                        'currentdate' => date("Y-m-d").'T18:30:00.000Z',
                        'billid' => "6005",
                        'billtype' => "Home",
                        'emailid' => "4002",
                        'sts' => "Draft",
                        'emailtype' => "Home",
                        'sub_domain' => "savage",
                        'api_token' => "9Pi5sBfxa5th1kRC_TGy"
                     );


    $crms_member = $wpdb->get_results( "SELECT * FROM wp_crms_member WHERE `email` = '".$billing_emailid."'");


       

    if (empty($crms_member)) {

        
           

        $result_decode = syncMemberdataRMS($api_req_data,$database_country_data);

        $rms_member_detail = $result_decode->member;
        $rms_member_detail_emails = $rms_member_detail->emails[0];
        $billing_address = $rms_member_detail->primary_address;
        $email_address = $rms_member_detail_emails->address;

        $billing_address_id = $billing_address->id;
        $crms_member_id = $rms_member_detail->id;
        $crms_member_name = $rms_member_detail->name;
        $crms_member_uuid = $rms_member_detail->uuid;
        $crms_member_email = $email_address;


        $memberDetail = array('crms_member_id' => $crms_member_id,'crms_member_name' => $crms_member_name, 'crms_member_uuid' => $crms_member_uuid, 'crms_member_email' => $crms_member_email,'billing_address_id' => $billing_address_id);

        $insert_member_query = "INSERT INTO wp_crms_member (email,name,id,uuid,billing_id) VALUES ('".$crms_member_email."','".$crms_member_name."','".$crms_member_id."','".$crms_member_uuid."','".$billing_address_id."')";
        $database_insert_member = $wpdb->query($insert_member_query);
           // echo "<pre>";print_r($database_insert_member);exit();

        $opp_data = syncOppToRMS($api_req_data,$memberDetail,$product_detail);

        $opp_data_decode = json_decode($opp_data);   

        
            
    }else{
           
        $rms_user_id = $crms_member[0]->id;

        $url = "https://api.current-rms.com/api/v1/members/".$rms_user_id;
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'],'Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $memresult = curl_exec($ch);
        curl_close($ch);
        $member  = json_decode($memresult,true);

       // echo "<pre>";print_r($member);exit();
            
            $member = $member['member'];

            

        $rms_member_detail_emails = $member['emails'][0];
        $email_address = $rms_member_detail_emails['address'];

        $crms_member_id = $member['id'];
        $crms_member_name = $member['name'];
        $crms_member_uuid = $member['uuid'];
        $crms_member_email = $email_address;

        $billing_address_id = $member['primary_address']['id'];


        $memberDetail = array('crms_member_id' => $crms_member_id,'crms_member_name' => $crms_member_name, 'crms_member_uuid' => $crms_member_uuid, 'crms_member_email' => $crms_member_email,'billing_address_id' => $billing_address_id);

            //echo "<pre>";print_r($memberDetail);exit();
        $opp_data = syncOppToRMS($api_req_data,$memberDetail,$product_detail);

       $opp_sync_responce  = json_decode($opp_data);

            
            


        $opp_data_decode = json_decode($opp_data);
          //  echo "<pre>";print_r($opp_data_decode);exit();

        if (isset($opp_data_decode->errors)) {
            $response_array['status'] = 'error'; 
           
           echo json_encode($response_array);
        }else{
            $response_array['status'] = 'success';             
            echo json_encode($response_array);
            global $woocommerce;
            $woocommerce->cart->empty_cart();
        }
        exit();
        /*$opportunity = $opp_data_decode->opportunity;
        $opportunity_id = $opportunity->id;

        WC()->session->set( 'last_opp_id', $opportunity_id );*/
            //echo "<pre>";print_r($opportunity_id);exit();
    
    }
    
}

add_action("wp_ajax_opp_save_draft", "opp_save_draft");
add_action("wp_ajax_nopriv_opp_save_draft", "opp_save_draft");





function opp_incomplete(){
    $billing_emailid =$_REQUEST['billing_emailid'];
       // echo "<pre>";print_r($billing_emailid);exit();
    //$billing_emailid ="robertaldrich4510@gmail.com";
    $country_name = "United Kingdom";
    $trim_country_name = trim($country_name);
    global $wpdb;
    $database_country_data = $wpdb->get_results( "SELECT * FROM wp_crms_country WHERE `name` LIKE '".$trim_country_name."' OR `mname` LIKE '".$trim_country_name."'");
        //echo "<pre>";print_r($database_country_data[0]);exit();
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            $product = $cart_item['data'];
            if(!empty($product)){
                $product_id = $cart_item['product_id'];
                $crms_id = get_post_meta( $product_id, 'crms_id', true); 
                $quantity = $cart_item['quantity'];
                $product_name = $product->get_name();
                $price = $cart_item['data']->get_price();
                $product_desc = $product->get_description();

                $product_detail[] = array('item_id' => $crms_id,'name' => $product_name,'quantity' => $quantity,'price' => $price, 'description' => $product_desc );
            }
        }

        //echo "<pre>";print_r($product_detail);exit();

        


        //static product data for testing
        //$product_detail = array(array('item_id' => 26,'name' => "G clamp",'quantity' => 2,'price' => 0.00, 'description' => "test product" ),array('item_id' => 18,'name' => "ETC Source 4",'quantity' => 5,'price' => 18.00, 'description' => "test product" ));

    $api_req_data = array('is_vat_exempt' => "no",
                        'billing_project_name' => "Test Project",
                        'billing_project_type' => "TV",
                        'billing_booking_start_date' => "10/12/2021",
                        'billing_booking_end_date' => "10/27/2021",
                        'billing_collection' => "",
                        'billing_return' => "",
                        'billing_project_comment' => "test comment",
                        'first_name' => "robert",
                        'last_name' => "Aldrich",
                        'company' => "Light House",
                        'address_1' => "3 Orchard Way",
                        'address_2' => "Horsmonden",
                        'city' => "Horsmonden",
                        'state' => "kent",
                        'postcode' => "TN12 8JX",
                        'country' => "GB",
                        'email' => $billing_emailid,
                        'phone' => "07595219710",
                        'billingtype' => "Personal",
                        'currentdate' => date("Y-m-d").'T18:30:00.000Z',
                        'billid' => "6005",
                        'billtype' => "Home",
                        'emailid' => "4002",
                        'sts' => "Incomplete",
                        'emailtype' => "Home",
                        'sub_domain' => "savage",
                        'api_token' => "9Pi5sBfxa5th1kRC_TGy"
                     );

                    /*Test sub domain and api key
                        'sub_domain' => "jamescompany",
                        'api_token' => "H5WxVA1moZ1tyjtXi9WL",
                    */

                    /*Test sub domain and api key
                        'sub_domain' => "savage",
                        'api_token' => "9Pi5sBfxa5th1kRC_TGy"
                    */

    $crms_member = $wpdb->get_results( "SELECT * FROM wp_crms_member WHERE `email` = '".$billing_emailid."'");
        
       // echo "<pre>";print_r($crms_member);exit();
    if (empty($crms_member)) {

        $result_decode = syncMemberdataRMS($api_req_data,$database_country_data);

        $rms_member_detail = $result_decode->member;
        $rms_member_detail_emails = $rms_member_detail->emails[0];
        $billing_address = $rms_member_detail->primary_address;
        $email_address = $rms_member_detail_emails->address;

        $billing_address_id = $billing_address->id;
        $crms_member_id = $rms_member_detail->id;
        $crms_member_name = $rms_member_detail->name;
        $crms_member_uuid = $rms_member_detail->uuid;
        $crms_member_email = $email_address;


        $memberDetail = array('crms_member_id' => $crms_member_id,'crms_member_name' => $crms_member_name, 'crms_member_uuid' => $crms_member_uuid, 'crms_member_email' => $crms_member_email,'billing_address_id' => $billing_address_id);

        $insert_member_query = "INSERT INTO wp_crms_member (email,name,id,uuid,billing_id) VALUES ('".$crms_member_email."','".$crms_member_name."','".$crms_member_id."','".$crms_member_uuid."','".$billing_address_id."')";
        $database_insert_member = $wpdb->query($insert_member_query);

        $opp_data = syncOppToRMS($api_req_data,$memberDetail,$product_detail);
            
    }else{
        $rms_user_id = $crms_member[0]->id;

        $url = "https://api.current-rms.com/api/v1/members/".$rms_user_id;
        $ch = curl_init( $url );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:'.$api_req_data['sub_domain'].'','X-AUTH-TOKEN:'.$api_req_data['api_token'],'Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $memresult = curl_exec($ch);
        curl_close($ch);
        $member  = json_decode($memresult,true);

            
            $member = $member['member'];

            

        $rms_member_detail_emails = $member['emails'][0];
        $email_address = $rms_member_detail_emails['address'];

        $crms_member_id = $member['id'];
        $crms_member_name = $member['name'];
        $crms_member_uuid = $member['uuid'];
        $crms_member_email = $email_address;

        $billing_address_id = $member['primary_address']['id'];


        $memberDetail = array('crms_member_id' => $crms_member_id,'crms_member_name' => $crms_member_name, 'crms_member_uuid' => $crms_member_uuid, 'crms_member_email' => $crms_member_email,'billing_address_id' => $billing_address_id);

            //echo "<pre>";print_r($memberDetail);exit();
            

        $opp_data = syncOppToRMS($api_req_data,$memberDetail,$product_detail);
        echo "<pre>";print_r($rms_user_id);exit();
    
    }
}

add_action("wp_ajax_opp_incomplete", "opp_incomplete");
add_action("wp_ajax_nopriv_opp_incomplete", "opp_incomplete");

function hide_coupon_field_on_cart( $enabled ) {
if ( is_checkout() ) {
    $enabled = false;
}
return $enabled;
}
add_filter( 'woocommerce_coupons_enabled', 'hide_coupon_field_on_cart' );



add_filter( 'woocommerce_cart_item_price', 'bbloomer_change_cart_table_price_display', 30, 3 );
  
function bbloomer_change_cart_table_price_display( $price, $values, $cart_item_key ) {
   $slashed_price = $values['data']->get_price_html();
   $is_on_sale = $values['data']->is_on_sale();
   if ( $is_on_sale ) {
      $price = $slashed_price;
   }
   return $price;
}



/*function bd_rrp_sale_price_html( $price, $product ) {
  if ( $product->is_on_sale() ) :
    $has_sale_text = array(
      '</del>' => ' /DAY</del>',
      '</ins>' => ' /DAY</ins>'
    );
    $return_string = str_replace(array_keys( $has_sale_text ), array_values( $has_sale_text ), $price);
  else :
    $return_string = $price." /DAY";
  endif;

  return $return_string;
}
add_filter( 'woocommerce_get_price_html', 'bd_rrp_sale_price_html', 100, 2 );*/


/*add_filter( 'woocommerce_get_price_html', 'njengah_text_after_price' );

function njengah_text_after_price($price){

    $text_to_add_after_price  = '<b>/Day</b>'; //change text in bracket to your preferred text 
          
    return $price .   $text_to_add_after_price;
          
} */



function getaccitems($ID)
{       
        global $product,$wpdb;
        $sum_pro_price_meta = '';
        if (!empty($ID)) {
            $query = $wpdb->get_results("SELECT * FROM wp_woocommerce_bundled_items WHERE `bundle_id` LIKE '".$ID."'");
            $acc_detail_data = array();

            $pro_data_acc = array();
            $pro_price_meta = array();
            foreach ($query as $key => $pro_acc) {
            
                $post   = get_post( $pro_acc->product_id );
                $title=$post->post_title;
                $price = get_post_meta( $pro_acc->product_id, '_regular_price', true);
                $stock = get_post_meta( $pro_acc->product_id, '_stock', true );

               

                $acc_detail_data[] ='<li><span class="qty_pro">x'.round($stock,0).'</span><h6>'.$title.'</h6><span class="pkg-span-price span">$'.$price.'</span><li>';
                $pro_price_meta[] = round($price,0);


            }
               $sum_pro_price_meta = array_sum($pro_price_meta);

        }   
            $acc_detail_data = implode($acc_detail_data);


            $add_ul = "<ul class='new_ul_acc'>".$acc_detail_data."</ul>";

            return $add_ul = array('ul' => $add_ul, 'pro_price_meta' => $sum_pro_price_meta );
                
            /*return */

}


add_action( 'woocommerce_after_shop_loop', 'bbloomer_show_free_shipping_loop', 5 );

function bbloomer_show_free_shipping_loop() {

    if( is_product_category('Packages') ){

    }else{
        $current_category_object = get_queried_object();
        $current_cat_id = $current_category_object->name;
        $current_cat_id = str_replace("&"," ", $current_cat_id);
        $current_cat_id = str_replace('amp;', ' ', $current_cat_id);
        $name = str_replace(" ","-", $current_cat_id);
        $lower_name = strtolower($name);
        $main_cate_slug =preg_replace('/[^A-Za-z0-9\-]/', '', $lower_name);
        $final_main_cat_slug = str_replace("--","-", $main_cate_slug);
        $final_main_cat_slug = str_replace("--","-", $final_main_cat_slug);
        $final_main_cat_slug = trim($final_main_cat_slug, '-');


        $args = array(
                'post_type'             => 'product',
                'post_status'           => 'publish',
                'posts_per_page'        => '-1',
                'meta_query'            => array(
                    array(
                        'key'           => 'tag_list',
                        'value'         => array('Package'),
                        'compare'       => 'IN'
                    )
                ),
                'tax_query'             => array(
                    array(
                        'taxonomy'      => 'product_cat',
                        'field' => 'slug', //This is optional, as it defaults to 'term_id'
                        'terms'         => $final_main_cat_slug,
                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                    )
                )
            );
            $query = new WP_Query( $args );

            $display_or_not = "none";
            $count = $query->post_count;
            if ($count > 0) {
                $display_or_not = "block";
            }

            echo '<div class="sub_cat_product product-package-list product first" id="packages" style="display:'.$display_or_not.'">';
            echo '<a href="#">
                      <h2 class="woocommerce-loop-category__title">
                         Packages   
                      </h2>
                   </a>';


           echo '<ul class="products standard">';
                    
                    global $post;
                    while ( $query->have_posts() ){
                        $query->the_post();
                        $ID = get_the_ID();
                            
                        $price = get_post_meta( get_the_ID(), '_regular_price', true);


                            //echo "<pre>";print_r($price);exit();

                        $add_ul = '';
                        $accitems = getaccitems($ID);

                           
                        $pro_price_meta = $accitems['pro_price_meta'];
                        


            echo '<li class="product type-product  has-post-thumbnail product-type-simple product_cat-packages">
                    <div class="qodef-product-standard-image-holder">';
                        $post_slug = get_post_field( 'post_name', get_post() );
                echo '<div class="pkg-list-hov"><a class="bdl_pkg_lnk_dtl" href='.site_url().'/product/'.$post_slug.'>
                        <h4 class="pkg-list-head">Items in package</h4>'.$accitems['ul'].'<div class="save-per">
                        <div class="save-per-txt">SAVE 20%</div>
                        <span class="price"><ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>'.$pro_price_meta.'</bdi></span> </ins></span>
                       </div></a>
                            </div>';

                echo '<a href="https://lighthouserentals.mobilegiz.com/product/10ft-goal-post-kit/">
                        <img src="'.woocommerce_placeholder_img_src().'"  alt="">
                    </a>
            

                    <div class="qodef-product-standard-button-holder">
                       <a href='.site_url().'/catalogue/led-lights/?add-to-cart='.$ID.' target="_self" class="qodef-btn qodef-btn-medium qodef-btn-solid qodef-btn-icon add_to_cart_button ajax_add_to_cart  " rel="nofollow">    <span class="qodef-btn-text">Add to cart</span>    <i class="qodef-icon-linear-icon lnr lnr-cart "></i></a>  
                    </div>
                </div>
                 <div class="title_price">
                    <h3>'.get_the_title().'</h3>            
                    <span class="price"><ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>'.$price.'</bdi></span></ins></span>
                 </div>
            </li>';


                    }
            echo '</ul>
                </div>';


    }
}







/*function my_plugin_body_class($classes) {
global $_product;

$_product = wc_get_product( get_the_ID() );

if( $_product->is_type( 'bundle' ) ) {
$classes[] = 'body_pr_bdl';
return $classes;
} else {
// do stuff for everything
}
}

add_filter('body_class', 'my_plugin_body_class');*/





/*function ss_cart_updated( $cart_item_key, $cart ) {

    global $woocommerce;
    $items = $woocommerce->cart->get_cart();

        if (empty($items)) {
                echo "<pre>";print_r("out");exit();
        }


};
add_action( 'woocommerce_remove_cart_item', 'ss_cart_updated', 10, 2 );*/




/*add_action( 'wp_footer', 'vazio' );
function vazio() {
    
}*/