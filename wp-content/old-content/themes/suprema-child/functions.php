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

    wp_enqueue_script( 'jquery-ui', site_url().'/wp-content/themes/suprema-child/js/jquery-ui.js', array( 'jquery' ), $theme_version, true );
   wp_enqueue_script( 'password', site_url().'/wp-content/themes/suprema-child/js/password.js', array( 'jquery' ), $theme_version, true );   
    //wp_enqueue_style( 'jquery-ui', $template_dir . '/css/jquery-ui.css', array(), $theme_version );
    wp_enqueue_style( 'jquery-ui', site_url().'/wp-content/themes/suprema-child/css/jquery-ui.css', array(), $theme_version );
     wp_enqueue_style( 'password',site_url().'/wp-content/themes/suprema-child/css/password.css', array(), $theme_version );
    wp_enqueue_style( 'font-awesome', site_url().'/wp-content/themes/suprema-child/css/font-awesome.css', array(), $theme_version );

    //wp_enqueue_style( 'bootstrap', site_url().'/wp-content/themes/suprema-child/css/bootstrap.min.css', array(), $theme_version );

    wp_enqueue_script( 'jquery', site_url().'/wp-content/themes/suprema-child/js/jquery-3.5.0.min.js', array( 'jquery' ), $theme_version, true );
    wp_enqueue_script( 'bootstrap', site_url().'/wp-content/themes/suprema-child/js/bootstrap.min.js', array( 'jquery' ), $theme_version, true );
     wp_enqueue_script( 'parallax', site_url().'/wp-content/themes/suprema-child/js/TweenMax.min.js', array( 'jquery' ), $theme_version, true );
    wp_enqueue_script( 'custom', site_url().'/wp-content/themes/suprema-child/js/custom.js', array( 'jquery' ), $theme_version, true );


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
    $startdate = $startdt.'T18:30:00.000Z';
    $enddate = $enddt.'T18:30:00.000Z';
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
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:baseboys','X-AUTH-TOKEN:iBnSjFdaWALAyrsx_-WK','Content-Type:application/json'));
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

        if (in_array("NewArrival", $explode_meta_value) && $test < 4)
          {
            
            $test++;
            echo "<li class='qodef-product'> 

                <div class='qodef-product-featured-image-holder'>
                    <a href='". get_the_permalink() ."'>
                        ".get_the_post_thumbnail($loop->post->ID, 'shop_catalog')."
                    </a>
                    <span>New</span>
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

        if (in_array("Populer", $explode_meta_value) && $test < 4)
          {
            
            $test++;
            echo "<li class='qodef-product'> 

                <div class='qodef-product-featured-image-holder'>
                    <a href='". get_the_permalink() ."'>
                        ".get_the_post_thumbnail($loop->post->ID, 'shop_catalog')."
                    </a>
                    <span>New</span>
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



add_shortcode('display_google_review_slider', 'google_review_slider');

function google_review_slider(){

    echo '<div class="owl-carousel review-owl owl-theme">
    <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
     <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
     <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
     <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
     <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
    <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
     <div class="item">
         <div class="review-slide-wrp">
                 <div class="review-slide-cont">
                     <div class="review-cont-in">
                 <div  class="star-reivew">
                      
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i><br>
                            <i class="fa fa-star" aria-hidden="true"></i>
                       
                 </div>
                 <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam<br>
                nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam<br>
                erat, sed diam voluptua.</p>
              </div>

              </div>
               <div class="auther">
                    <img loading="lazy" class="alignnone size-full wp-image-120156" src="http://lighthouserentals.mobilegiz.com/wp-content/uploads/2021/06/user-img.png" alt="" width="64" height="65"><br>
                    <div class="auther-name">
                        <span class="auth">Person Name</span>
                        <span>2 weeks ago</span>

                   </div>
               </div>

         </div>
    </div>
</div>';
}

remove_action('woocommerce_before_add_to_cart_button', 'woocommerce_template_single_meta', 30);

add_shortcode('display_equipment_cat','equipment_cat');
function equipment_cat(){
$args = array(
'hide_empty' => false, 
'number' => 5,
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
echo '<div class="woocommerce ">
            <ul class="products ">';
foreach ($terms as $term) {
        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id ); 
            echo '<li class="product-category product">
                <a href="'. get_term_link($term->term_id) .'"><img src="'. $image .'" alt="Cameras" width="600" height="600"></a>
                    <div class="cat-title">
                        <h6>'. $term->name .'</h6>
                        <a href="'. get_term_link($term->term_id) .'">view all '. $term->count .'types</a>
                    </div>
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