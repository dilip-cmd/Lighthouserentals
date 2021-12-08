<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


//$last_opp_id = WC()->session->get( 'last_opp_id' );
$last_opp_id = 3372;
//$last_opp_id = 3375;
	

$url = "https://api.current-rms.com/api/v1/opportunities/".$last_opp_id."/opportunity_items?include=%5Bitem%5D";
$ch = curl_init( $url );
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$memresult = curl_exec($ch);
curl_close($ch);
$product_detail  = json_decode($memresult,true);

$opportunity_items = $product_detail['opportunity_items'];



function getProductDetail($product_crms_id)
{
	$url = "https://api.current-rms.com/api/v1/products/".$product_crms_id;
	$ch = curl_init( $url );
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$productresult = curl_exec($ch);
	curl_close($ch);

	return $decode_productresult = json_decode($productresult);
}

function getOppDetail($last_opp_id)
{

	$url = "https://api.current-rms.com/api/v1/opportunities/".$last_opp_id;
	$ch = curl_init( $url );
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$oppresult = curl_exec($ch);
	curl_close($ch);
	$oppresult_detail  = json_decode($oppresult,true);

	$opportunity = $oppresult_detail['opportunity'];


	$opp_detail_array = array('id' => $opportunity['id'], 'subject' => $opportunity['subject'], 'starts_at' => $opportunity['starts_at'],'ends_at' => $opportunity['ends_at'], 'chargeable_days' => $opportunity['chargeable_days'], 'charge_total' => $opportunity['charge_total']);

	return $opp_detail_array;

	//$opportunity_items = $product_detail['opportunity_items'];

}



$opportunity_detail = getOppDetail($last_opp_id);
		//echo "<pre>";print_r($opportunity_detail);exit();



//echo "<pre>";print_r($opportunity_items);exit();

$response_product_array = array();
$total_product_price = array();
foreach ($opportunity_items as $key => $opportunity_item) {
	if ($opportunity_item['opportunity_item_type_name'] == "Principal") {

		$product_detail = getProductDetail($opportunity_item['item_id']);
				//echo "<pre>";print_r($product_detail);exit();
			$priduct_icons = $product_detail->product->icon;
			$rental_rate = $product_detail->product->rental_rate;

			if (isset($priduct_icons->url)) {
				$thumb_url = $priduct_icons->url;
			}else{
				$thumb_url = "";
			}

			if (isset($rental_rate->price)) {
				$rental_price = $rental_rate->price;
			}else{
				$rental_price = "";
			}

		$total_product_price[] += $opportunity_item['price'];
		$quantity = round($opportunity_item['quantity'],0);
		$response_product_array[] = array('name' => $opportunity_item['name'],'quantity' => $quantity,'price' => $opportunity_item['price'],'rental_price' => $rental_price ,'image_url' => $thumb_url);
		
	}	
}
$total_principal_item = count($response_product_array);
$sum_product_price = array_sum($total_product_price);

/*echo "<pre>";
print_r();
exit();*/
	//echo "<pre>";print_r();exit();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<!-- <div class="woocommerce-only-head">
<h1>Checkout</h1>
</div> -->
<form name="checkout" method="post" class="checkout woocommerce-checkout custom_checkout_form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="custom_billing_form">
			<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>
		</div>
		

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

	<div class="custom_order_review">
		<div class="custom_order_review_inner">
				<!-- <h3 id="order_review_heading"><?php //esc_html_e( 'Your order', 'woocommerce' ); ?></h3> -->

				<?php
				$starts_at = $opportunity_detail['starts_at'];
				$ends_at = $opportunity_detail['ends_at'];
				//echo ;
				$starts = date('d/m/Y', strtotime($starts_at));
				$ends = date('d/m/Y', strtotime($ends_at));

				?>

	
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div class="checkout-eqsummary-head">
			 		<h4><?php echo $opportunity_detail['subject']; ?> <span class="eqsummary_number">(<?php echo $opportunity_detail['id']; ?>)</span></h4>
			 		<div class="check-eqsum-date">
			 				<span class="start-date"><?php echo $starts; ?></span>
			 				<span class="dash">-</span>
			 				<span class="end-date"><?php echo $ends; ?></span> , <?php echo round($opportunity_detail['chargeable_days'],0); ?> Days
			 		</div>
				 </div>  
				 <div class="checkout-eq-summary-item">
					<div class="eq-summary-item-title">
						 <h3>Equipment Summary</h3>
						 <span class="eq-summary-item"><?php echo $total_principal_item; ?> items</span>
					</div>
					<ul>
							<?php
							foreach ($response_product_array as $key => $response_product) { ?> 
							 	<li>
									<div class="qodef-item-image-holder">
										<div class="qodef-item-image-holder-inner">
											<a href="https://lighthouserentals.mobilegiz.com/product/arri-skypanel-s60-c/">
												<img src="<?php echo $response_product['image_url'] ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" width="356" height="356">												</a>
										</div>
									</div>
									<div class="qodef-item-info-holder">
										<div class="qodef-item-left">
											<a href="https://lighthouserentals.mobilegiz.com/product/arri-skypanel-s60-c/">
												<?php echo $response_product['name']; ?>									
											</a>
											<span class="qodef-quantity">Quantity: <?php echo $response_product['quantity']; ?></span>
											<span class="price">
											<ins><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $response_product['price']; ?></bdi></span></ins>
											<del aria-hidden="true"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span><?php echo $response_product['rental_price']; ?></bdi></span></del>		

											</span>									
										</div>
									</div>
							</li>
							 <?php } ?>
							
					</ul>
					<div class="eq-summary-dailyrate">
							<span class="label-title">Daily Rate</span>
							<span class="daily-rate-price">$<?php echo $sum_product_price; ?></span>
					</div>
				 </div>

				 <?php 
				 	//echo "<pre>";print_r(wp_get_all_session()) exit();
				 ?>

				 <div class="eq-coll-ret-sum">
				 	     <div class="eq-coll-ret-sum-grid">
				 		 <h3 class="eq-ret-sum-grid-title">Equipment Collection & Return Summary</h3>		
				 		<div class="eu-col-ret-ulbox collection-ulbox">
				 				<h4>COLLECTION</h4>
				 				<ul>
				 					<li>
				 						<span class="eq-sum-ulh">Collection Type:</span>
				 						<span>Standard Pickup</span>
				 					</li>
				 					<li>
				 						<span class="eq-sum-ulh">Collection Window:</span>
				 						<span>2pm - 5pm Friday 23rd of<br> September 2021</span>
				 					</li>
				 					<li>
				 						<span class="eq-sum-ulh">Collection Contact:</span>
				 						<span>Matt Smith - 0433 517 499</span>
				 					</li>
				 				</ul>
				 		</div>	
				 		<div class="eu-col-ret-ulbox return-ulbox">
				 				<h4>Return</h4>
				 				<ul>
				 					<li>
				 						<span class="eq-sum-ulh">Return Type:</span>
				 						<span>Standard Pickup</span>
				 					</li>
				 					<li>
				 						<span class="eq-sum-ulh">Return Window:</span>
				 						<span>2pm - 5pm Friday 23rd of<br> September 2021</span>
				 					</li>
				 					<li>
				 						<span class="eq-sum-ulh">Return Contact:</span>
				 						<span>Matt Smith - 0433 517 499</span>
				 					</li>
				 				</ul>
				 		</div>	
				 		</div>
				 		<div class="eq-coll-ret-sum-grid ins-summery">
				 			<h3 class="eq-ret-sum-grid-title">Insurance Summary</h3>
				 			<div class="eu-col-ret-ulbox">
				 				<ul>
				 					<li>
				 						<span class="eq-sum-ulh">Equipment Replacement Value:</span>
				 						<span>$56,600</span>
				 					</li>
				 					<li>
				 						<span class="eq-sum-ulh">Insurance Selected:</span>
				 						<span>Budget Insurance (3% Surcharge/ $10,000 Excess)</span>
				 					</li>
				 					
				 				</ul> 
				 			</div>

				 		</div>	
				 </div>


				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
		
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
