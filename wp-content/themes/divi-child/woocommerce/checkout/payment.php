<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div class="review_data">
   
</div>	
<div id="payment" class="woocommerce-checkout-payment">
	<?php if ( WC()->cart->needs_payment() )  : ?>
		<ul class="wc_payment_methods payment_methods methods">
			<?php
			if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			} else {
				/*echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine*/
			}
			?>
		</ul>
	<?php  endif; ?>
	<div class="form-row place-order">
		<noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>

		<?php //wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php //echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>


		<button type="submit" class="button alt book_rental" name="book_rental" id="book_rental" value="Book Rental" data-value="Book Rental">Send booking request</button>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}



if ( isset( $_POST['book_rental'] ) ) {	

	$billing_project_name = trim($_REQUEST['billing_project_name']);
	$billing_project_type = trim($_REQUEST['billing_project_type']);
	$billing_booking_start_date = trim($_REQUEST['billing_booking_start_date']);
	$billing_booking_end_date = trim($_REQUEST['billing_booking_end_date']);
	$billing_project_comment = trim($_REQUEST['billing_project_comment']);
	$billing_collection = trim($_REQUEST['billing_collection']);
	$billing_first_name = trim($_REQUEST['billing_first_name']);
	$billing_last_name = trim($_REQUEST['billing_last_name']);
	$billing_company = trim($_REQUEST['billing_company']);
	$billing_address_1 = trim($_REQUEST['billing_address_1']);
	$billing_address_2 = trim($_REQUEST['billing_address_2']);
	$billing_city = trim($_REQUEST['billing_city']);
	$billing_state = trim($_REQUEST['billing_state']);
	$billing_postcode = trim($_REQUEST['billing_postcode']);
	$billing_phone = trim($_REQUEST['billing_phone']);
	$billing_email = trim($_REQUEST['billing_email']);
	$order_comments = trim($_REQUEST['order_comments']);
	$book_rental = trim($_REQUEST['book_rental']);
	$woocommerce_process_checkout_nonce = trim($_REQUEST['woocommerce-process-checkout-nonce']);
	$_wp_http_referer = trim($_REQUEST['_wp_http_referer']);
	$woocommerce_login_nonce = trim($_REQUEST['woocommerce-login-nonce']);
	$_wpnonce = trim($_REQUEST['_wpnonce']);
	$woocommerce_reset_password_nonce = trim($_REQUEST['woocommerce-reset-password-nonce']);
	$woocommerce_edit_address_nonce = trim($_REQUEST['woocommerce-edit-address-nonce']);
	$save_account_details_nonce = trim($_REQUEST['save-account-details-nonce']);
	$billingtype = 'Personal';
	$currentdate = date("Y-m-d").'T18:30:00.000Z';
	$billid = 6005;
	$billtype = 'Home';
	$emailid = 4002;
	$emailtype = 'Home';

	global $wpdb;
	$query = $wpdb->get_results("SELECT * FROM wp_crms_country WHERE `name` LIKE '".$billing_state."' OR `mname` LIKE '".$billing_state."'");

	$url = "https://api.current-rms.com/api/v1/members?page=page92&per_page=per_page92&filtermode=filtermode92&view_id=view_id92&q%5Bname_or_primary_address_street_or_work_phone_number_or_work_email_address_or_identity_email_or_tags_name_cont%5D=q%255Bname_or_primary_address_street_or_work_phone_number_or_work_email_address_or_identity_email_or_tags_name_cont%255D92";
    $ch = curl_init( $url );

    $payload = '{
				"member":
					{
						"name":"'.$billing_first_name.'",
						"description":"'.$billing_project_comment.'",
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
						"primary_address":{"name":"'.$billing_first_name.'",
						"street":"'.$billing_address_1.'",
						"postcode":"'.$billing_postcode.'",
						"city":"'.$billing_city.'",
						"county":"'.$billing_state.'",
						"country_id":"'.$query[0]->id.'",
						"country_name":"'.$query[0]->name.'",
						"type_id":3001,
						"address_type_name":"Primary",
						"created_at":"'.$currentdate.'",
						"updated_at":"'.$currentdate.'"},
						"emails":[{"address":"'.$billing_email.'",
						"type_id":'.$emailid.',
						"email_type_name":"'.$emailtype.'"}],
						"phones":[{"number":"'.$billing_phone.'",
						"type_id":'.$billid.',
						"phone_type_name":"'.$billtype.'"}],
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
	        // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:testap','X-AUTH-TOKEN:YHpPrVZ5TGqX4TyQw3jJ','Content-Type:application/json'));
	        # Return response instead of printing.
	        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	        # Send request.
	        $result = curl_exec($ch);

	       	$member  = json_decode($result,true);
	       	
	       	global $woocommerce;
			$items = $woocommerce->cart->get_cart();
			$product_detail = array();
			foreach ($items as $key => $value) {				
	       		$_product = wc_get_product( $value['product_id'] );
				$title = $_product->get_title();
				$sku = $_product->get_sku();
                $price = $_product->get_price();
                $qty = $value['quantity'];
                $product_id = $value['product_id'];
                $product_detail[] = array('product_id' => $product_id,'title' => $title,'sku' => $sku,'price' => $price,'qty' => $qty );
			}
			$_REQUEST['cust_prodata'] = json_encode($product_detail);

	        if(isset($_REQUEST) || isset($member)){

	        	$url = "https://api.current-rms.com/api/v1/opportunities/checkout";
		        $ch = curl_init( $url );
		        $projectname = $_REQUEST['billing_project_name'];
		        $description = $_REQUEST['billing_project_comment'];
		        $street = trim($_REQUEST['billing_address_1']);
		        $city = trim($_REQUEST['billing_city']);
		        $postcode = trim($_REQUEST['billing_postcode']);
		        $county = trim($_REQUEST['billing_state']);
		        $emails = trim($_REQUEST['email']);
		        $phones = trim($_REQUEST['billing_phone']);
		        $startdt = date("Y-m-d", strtotime($_REQUEST['billing_booking_start_date']));
		        $enddt = date("Y-m-d", strtotime($_REQUEST['billing_booking_end_date']));
		        $prodata = json_decode($_REQUEST['cust_prodata'],true);

		        $startdate = $startdt.'T18:30:00.000Z';
		        $enddate = $enddt.'T18:30:00.000Z';
		        $currentdate = date("Y-m-d").'T18:30:00.000Z';

		        $member = json_decode($member,true);
		        $memid = $member['member']['id'];
		        $memuuid = $member['member']['uuid'];
		        $memname = $member['member']['name'];

		        $billingid = $member['member']['primary_address']['id'];
		        $pre = $startdate ;
		        $show_starts_at = date('Y-m-d', strtotime( $startdt . " +1 days"));
		        $show_ends_at = date('Y-m-d', strtotime( $enddt . " -1 days"));
		        $collection = $enddate;
		        $items = array();
		        foreach ($prodata['products'] as $key => $value) {
		            $subitem['opportunity_id'] = 1;
		            $subitem['item_id'] = $value['product_id'];
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
		        			"subject":"Test Drive '.$projectname.'",
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
		        			"prep_starts_at":"'.$pre.'",
		        			"prep_ends_at":"'.$pre.'",
		        			"load_starts_at":"",
		        			"load_ends_at":"",
		        			"deliver_starts_at":"",
		        			"deliver_ends_at":"",
		        			"setup_starts_at":"",
		        			"setup_ends_at":"",
		        			"show_starts_at":"'.$show_starts_at.'",
		        			"show_ends_at":"'.$show_ends_at.'",
		        			"takedown_starts_at":"",
		        			"takedown_ends_at":"",
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


		        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
		        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:testap','X-AUTH-TOKEN:YHpPrVZ5TGqX4TyQw3jJ','Content-Type:application/json'));
		        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		        $response = curl_exec($ch);
				//echo "<pre>";print_r($response);exit();
		        curl_close($ch);
		        
		        $oppid  = json_decode($response,true);
		        if(!isset($oppid['errors'])){

		        	if (!empty($response)) {
		        		$name = $_REQUEST['billing_first_name'];
				        $projectname = $_REQUEST['billing_project_name'];
				        $description = $_REQUEST['billing_project_comment'];
				        $street = trim($_REQUEST['billing_address_1']);
				        $city = trim($_REQUEST['billing_city']);
				        $postcode = trim($_REQUEST['billing_postcode']);
				        $county = trim($_REQUEST['billing_state']);
				        $emails = trim($_REQUEST['billing_email']);
				        $phones = trim($_REQUEST['billing_phone']);
				        $startdate = date("Y-m-d", strtotime($_REQUEST['billing_booking_start_date']));
				        $enddate = date("Y-m-d", strtotime($_REQUEST['billing_booking_end_date']));
				        $prodata = json_decode($_REQUEST['cust_prodata'],true);

						global $wpdb;
						$query = $wpdb->get_results("SELECT * FROM wp_crms_country WHERE `name` LIKE '".$billing_state."' OR `mname` LIKE '".$billing_state."'");


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
				        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:testap','X-AUTH-TOKEN:YHpPrVZ5TGqX4TyQw3jJ','Content-Type:application/json'));
				        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				        $response = curl_exec($ch);
				        curl_close($ch);
		        	}

		        	if (!empty($response)) {

		        		$url = "https://api.current-rms.com/api/v1/opportunities/".$oppid['opportunity']['id']."/convert_to_order";
				        $ch = curl_init( $url );
				        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				        curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
				        // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
				        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:testap','X-AUTH-TOKEN:YHpPrVZ5TGqX4TyQw3jJ','Content-Type:application/json'));
				        # Return response instead of printing.
				        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				        # Send request.
				        $result = curl_exec($ch);
				        curl_close($ch);
				         $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
				        $logger = $objectManager->get('\Psr\Log\LoggerInterface');
				        $logger->info(print_r("---Order----",true));
				        $logger->info(print_r($result,true));
				        $logger->info(print_r("---Order----",true));
		        	}

		        }else{
		            $url = "https://api.current-rms.com/api/v1/members/".$memid;
		            $ch = curl_init( $url );
		            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		            curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
		            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:testap','X-AUTH-TOKEN:YHpPrVZ5TGqX4TyQw3jJ','Content-Type:application/json'));
		            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		            $result = curl_exec($ch);
		            curl_close($ch);
		            $logger->info(print_r("member deleted:".$memid,true));
		            $logger->info(print_r($response,true));
		        }
	        }

}

