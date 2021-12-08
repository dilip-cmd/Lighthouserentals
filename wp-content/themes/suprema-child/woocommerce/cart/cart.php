<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); 

$replacement_charge_sum = 0;

foreach( WC()->cart->get_cart() as $cart_item ){
        $product_id = $cart_item['product_id'];       
        $crms_id = get_post_meta( $product_id, 'crms_id', true);
        $url = "https://api.current-rms.com/api/v1/products/".$crms_id;
	    $ch = curl_init( $url );
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
	    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	    $memresult = curl_exec($ch);
	    curl_close($ch);
	    $product_detail_for_re_charges  = json_decode($memresult,true);

	    $replacement_charge_sum += $product_detail_for_re_charges['product']['replacement_charge'];

    }
	    	
        	//echo "<pre>";print_r($replacement_charge_sum);exit();


	
?>
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<div class="cart-left-col">	
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
		<tr>
			
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php esc_html_e( 'Product', 'suprema' ); ?></th>
			<th class="product-price"><?php esc_html_e( 'Price', 'suprema' ); ?></th>
			<th class="product-quantity"><?php esc_html_e( 'Quantity', 'suprema' ); ?></th>
			<th class="product-subtotal"><?php esc_html_e( 'Total', 'suprema' ); ?></th>
			<th class="product-remove">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>
		
		<?php
		$cart_prod_ttl;
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					
				
					
					<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						
						if ( ! $product_permalink ) {
							echo wp_kses_post( $thumbnail );
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
						}
						?>
					</td>
					
					<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'suprema' ); ?>"><?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}
						
						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
						
						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item );
						
						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'suprema' ) . '</p>' ) );
						}
						?>
					</td>
					
					<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'suprema' ); ?>">
						<?php
						$pro = wc_get_product( $product_id );

							//echo "<pre>";print_r($pro);exit();



						$cart_prod_ttl += $pro->get_price();
						echo '<div class="cart-price-amout-table">'.$pro->get_price_html().'</div>';
						/*echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.*/
						?>
					</td>
					
					<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'suprema' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}
						
						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
					</td>
					
					<!-- <td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'suprema' ); ?>"> -->
						<?php
						// echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
					<!-- </td> -->
					<td class="product-remove">
						<?php
						// @codingStandardsIgnoreLine
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'suprema' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							),
							$cart_item_key
						);
						?>
					</td>
				</tr>
				<?php
			}
		}
		WC()->session->set( 'cart_prod_ttl', $cart_prod_ttl );
		?>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<div class="cart-update-need-box">
		<div class="cart-need-half-box">
			<div class="support-box cart-bor-box">
				<div class="support-img img-blk">
					<img src="<?php echo get_stylesheet_directory_uri();?>/images/live-chat-img.png" alt="" > 
				</div>
				<div class="need-txt">
					<p class="ins-title">Need a Delivery or 24hr pickup?</p>
					<p>Can’t make our standard collection. Don’t worry, we got your back.</p>	
				<!-- <p>Need Help with your order? Talk to an expert. <a href="#">Live Chat with us.</a></p> -->
				</div>
				<button type="button" class="btn btn-primary site-btn" id="display_popup_dropoff" data-toggle="modal" data-target=".collection_popup_box">View Option</button>	
			</div>
		</div>

		<?php 
		$session_insurance_amount = WC()->session->get( 'insurance_amount' );
		$insurance_per = WC()->session->get( 'insurance_per' );

		if ($insurance_per == "-") {
			$insurance_per = 0;
		}

		if (empty($session_insurance_amount)) { ?>
			<div class="cart-need-half-box">
				<div class="insurance-bx cart-bor-box">
					<div class="Insurance-img img-blk">
						<img src="<?php echo get_stylesheet_directory_uri();?>/images/insurance-img.png" alt="" >
					</div>
					<div class="ins-txt">
					<p class="ins-title">Your job does not have any Insurance</p>
					<p>Protect your production from as little as $3.20</p>	
					</div>
					
					<button type="button" class="btn btn-primary site-btn" id="display_popup" data-toggle="modal" data-target=".popup_box">Update Insurance</button>
				</div>
			</div>
		<?php }else{ ?>
			<div class="cart-need-half-box">
				<div class="insurance-bx cart-bor-box">
					<div class="Insurance-img img-blk">
						<img src="<?php echo get_stylesheet_directory_uri();?>/images/insurance-selected_1.png" alt="" >
					</div>
					<div class="ins-txt">
					<p class="ins-title">Budget Insurance Selected</p>
					<p><?php echo $insurance_per."%"; ?> Surcharge = $<?php echo $session_insurance_amount; ?></p>	
					</div>
					
					<button type="button" class="btn btn-primary site-btn" id="display_popup" data-toggle="modal" data-target=".popup_box">Update Insurance</button>
				</div>
			</div>
		<?php } ?>
	</div>




	

	</div>

	<?php
	$start_date = WC()->session->get( 'from_date' );
	$end_date = WC()->session->get( 'to_date' );



	?>


	<div class="cart-right-col  order-summary">
		<h3>Order Summary</h3>
		<div class="parent_div_datepicker">
	  		<div class="startdate_datepicker">
	  			 	<i class="fa fa-calendar"></i>
	  			 <div class="date-input-box">
				<label for="from_date">Start Date</label>
				<?php
				if (empty($start_date)) {?>
					<input type="text" id="from_date" name="from_date" placeholder="Select start date">
				<?php }else{ ?>					
					<input type="text" id="from_date" name="from_date" value="<?php echo $start_date; ?>" placeholder="Select start date">		      		
				<?php }
				?>

		      </div>
	      	</div>
	      		<span class="separator"> -> </span>
	      	<div class="enddate_datepicker">
	      			<i class="fa fa-calendar"></i>
	      		<div class="date-input-box">
		    	<label for="end_date">End Date</label>

		    	<?php
				if (empty($end_date)) {?>
					<input type="text" id="end_date" name="end_date" placeholder="Select end date">
				<?php }else{ ?>					
					<input type="text" id="end_date" name="end_date" value="<?php echo $end_date; ?>" placeholder="Select end date">
		      		<!-- <label class="end_date"><?php //echo WC()->session->get( 'end_date' ); ?></label> -->
				<?php }
				?>

				<script>
					jQuery( document ).ready(function() {
						var from_date = jQuery('.from_date').text();
						var end_date = jQuery('.end_date').text();

						jQuery('#from_date').change(function(){
							jQuery.ajax({
								type: "post",
								url: "/wp-admin/admin-ajax.php",
								data: {
									action:'from_date',
									from_date: jQuery(this).val()
								},
								success: function(msg){
									console.log(msg);	
									location.reload(true);								
								}
							});
						});
						jQuery('#end_date').change(function(){
							jQuery('#loadr_img').show();
							jQuery.ajax({
								type: "post",
								url: "/wp-admin/admin-ajax.php",
								data: {
									action:'to_date',
									to_date: jQuery(this).val()
								},
								success: function(msg){
									console.log(msg);
									location.reload(true);
									jQuery('#loadr_img').hide();
									
								}
							});
						});
					});

					jQuery( document ).ajaxComplete(function() {
						jQuery('#from_date').change(function(){
							jQuery.ajax({
								type: "post",
								url: "/wp-admin/admin-ajax.php",
								data: {
									action:'from_date',
									from_date: jQuery(this).val()
								},
								success: function(msg){
									console.log(msg);
									location.reload(true);
								},
								complete: function(){
									jQuery("[name='update_cart']").prop("disabled", false);
									jQuery("[name='update_cart']").trigger("click");
									jQuery("#ui-datepicker-div").css("display","none");
								}
							});
						});
						jQuery('#end_date').change(function(){
							jQuery('#loadr_img').show();
							jQuery.ajax({
								type: "post",
								url: "/wp-admin/admin-ajax.php",
								data: {
									action:'to_date',
									to_date: jQuery(this).val()
								},
								success: function(msg){
									jQuery('#loadr_img').hide();
									location.reload(true);
									console.log(msg);
								},
								complete: function(){
									jQuery("[name='update_cart']").prop("disabled", false);
									jQuery("[name='update_cart']").trigger("click");
									jQuery("#ui-datepicker-div").css("display","none");
								}
							});
						});


						jQuery("#from_date").attr("class","add_start_datapicker");
						jQuery("#end_date").attr("class","add_end_datapicker");

						jQuery( function() {
							var dateFormat = "dd/mm/yy",
							from = jQuery( "#from_date" ).datepicker({
								defaultDate: "+1w",
								changeMonth: true,
								numberOfMonths: 1,
								minDate:0,
								dateFormat:"dd/mm/yy",
							}).on( "change", function() {

								var end = jQuery( "#end_date" ).val();
								if(end != ""){
									jQuery("[name='update_cart']").prop("disabled", false);
									jQuery("[name='update_cart']").trigger("click");
									jQuery("#ui-datepicker-div").css("display","none");
								}
											        	
								to.datepicker( "option", "minDate", getDate( this ) );
								var s_date = convert(getDate( this ));
								sessionStorage.setItem(s_date);
							}),
							to = jQuery( "#end_date" ).datepicker({
								defaultDate: "+1w",
								changeMonth: true,
								numberOfMonths: 1,
								dateFormat:"dd/mm/yy",
							}).on( "change", function() {
								var start = jQuery( "#from_date" ).val();
								if(start != ""){
									jQuery("[name='update_cart']").prop("disabled", false);
									jQuery("[name='update_cart']").trigger("click");
									jQuery("#ui-datepicker-div").css("display","none");
								}
								jQuery(".checkout").attr('href',"https://lighthouserentals.mobilegiz.com/checkout/").css("pointer-events","auto");				      	

								from.datepicker( "option", "maxDate", getDate( this ) );
								var e_date = convert(getDate( this ));
								sessionStorage.setItem(e_date);

							});

							function convert(str) {
								var date = new Date(str),
								mnth = ("0" + (date.getMonth() + 1)).slice(-2),
								day = ("0" + date.getDate()).slice(-2);
								return [mnth, day, date.getFullYear()].join("/");
							}

							function getDate( element ) {
								var date;
								try {
									date = jQuery.datepicker.parseDate( dateFormat, element.value );
								} catch( error ) {
									date = null;
								}
								return date;
							}
						});
					});



					jQuery( function() {
						var dateFormat = "dd/mm/yy",
						from = jQuery( "#from_date" ).datepicker({
							defaultDate: "+1w",
							changeMonth: true,
							numberOfMonths: 1,
							minDate:0,
							dateFormat:"dd/mm/yy",
						}).on( "change", function() {

							var end = jQuery( "#end_date" ).val();
							if(end != ""){
								jQuery("[name='update_cart']").prop("disabled", false);
								jQuery("[name='update_cart']").trigger("click");
								jQuery("#ui-datepicker-div").css("display","none");
							}
							to.datepicker( "option", "minDate", getDate( this ) );
							var s_date = convert(getDate( this ));
							sessionStorage.setItem(s_date);
						}),
						to = jQuery( "#end_date" ).datepicker({
							defaultDate: "+1w",
							changeMonth: true,
							numberOfMonths: 1,
							dateFormat:"dd/mm/yy",
						}).on( "change", function() {
							var start = jQuery( "#from_date" ).val();
							if(start != ""){
								jQuery("[name='update_cart']").prop("disabled", false);
								jQuery("[name='update_cart']").trigger("click");
								jQuery("#ui-datepicker-div").css("display","none");
							}
							jQuery(".checkout").attr('href',"https://lighthouserentals.mobilegiz.com/checkout/").css("pointer-events","auto");				      	
							from.datepicker( "option", "maxDate", getDate( this ) );
							var e_date = convert(getDate( this ));
							sessionStorage.setItem(e_date);
						});


						function convert(str) {
							var date = new Date(str),
							mnth = ("0" + (date.getMonth() + 1)).slice(-2),
							day = ("0" + date.getDate()).slice(-2);
							return [mnth, day, date.getFullYear()].join("/");
						}


						function getDate( element ) {
							var date;
							try {
								date = jQuery.datepicker.parseDate( dateFormat, element.value );
								//alert(convert(date));
							} catch( error ) {
								date = null;
							}
							//alert(date);
							return date;
						}
					});
				</script>

		    	<!-- <label class="to_date"><?php //echo WC()->session->get( 'to_date' ); ?></label> -->
		    </div>
	    	</div>
	    </div>
		<div class="actions clearfix">

			<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
			<div class="cart-collaterals cart-booking-information">
				
				<div class="qodef-cart-totals">
					
					<?php do_action( 'woocommerce_cart_collaterals' ); ?>
				
				</div>
			
			</div>
		</div>

	
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
		<div class="billing_email">
			<input type="text" name="billing_emailid" id="billing_emailid" class="billing_emailid" placeholder="Email Address">
			<span class="billing_emailid_error"></span>
		</div>

		<div class="cart-acc-term">
		<div class="check-wrp">
			<span class="required_error"></span>
		<input type="checkbox" name="agree" id="agree">
		<span class="checkmark"></span>
		I Accept the  <a href="#"> terms of hire</a> 
		</div></div>
	<div class="qodef-cart-proceed-update"> 
		
		<?php
		//Override Apply Coupon Button
		do_action( 'suprema_qodef_woocommerce_update_cart_button' );

		?>
		<button class="qodef-btn qodef-btn-medium qodef-btn-solid checkout-button alt wc-forward save-draft" id="save_draft">
		    <?php esc_html_e( 'Save Draft', 'woocommerce' ); ?>
		</button>

		<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>


		<!-- <button type="button" class="btn btn-primary site-btn" data-toggle="book_now" data-target=".bd-example-modal-lg">Book Now</button> -->
		<!-- <a href="#book_now" class="btn btn-primary site-btn display_book qodef-btn" data-toggle="modal">Book Now</a> -->
		<button type="button" id="book_now_button" class="btn btn-primary site-btn display_book qodef-btn" data-toggle="modal" data-target="#book_now">Book Now</button>
		<?php do_action( 'woocommerce_cart_actions' ); ?>
		
		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	
	</div>
	<span class="date_not_selected" style="display:none;">Please Select your Start / End Dates</span>
	<div>
		<span class="info-icn" data-toggle="tooltip" data-html="true" data-container="body" data-placement="top" title="<p>You asked    and we delivered </p> <p>Collaborative Checkout has arrived! 🥳🎉🙌</p>
<p>Collaborative Checkout allows one contact to manage all the booking requirements such as equipment required and pickup / drop off insurance then allocate another contact on their production to manage payment and billing for that job. This is really useful when you are the DOP or Gaffer booking equipment for a production but don't want to be invoiced directly for that job.</p> 

<p>To experience our collaborative checkout simply press Book Now and select Collaborative Checkout after entering your email.</p>" ><img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>">


		</span>

		<span class="ins-head-info">Booking Gear for Someone Else?</span>
	</div>
		</div>
</form>

	<div class="modal fade xxl-modal-cust forgot-pro-mod-main" id="book_now" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	      <div class="modal-content">
	        <div class="modal-header modal-header-center">
			  <div class="for-pro-logo">			
	          <img src="<?php echo get_stylesheet_directory_uri();?>/images/lighthouse_iq_logo.png" alt="" >
	          </div>	
	          <p class="header_content">With the average lighting setup requiring approx 20 items, it's easy to overlook those little items you need. To save you experiencing one of those "I wish I had a..." moments, Lighthouse IQ has automatically compiled a list of things you might need based on the equipment you have on order.</p>

	           <button type="button" class="close book_cancel" data-dismiss="modal" aria-hidden="true">x</button>
	        </div>
	        <div class="modal-body">
	            <h3 class="did-forg-head">Did you forget?</h3>
	          <div class="forget-pro-main-div">
	          		 <div class="for-add-prod-main">
					<?php do_shortcode('[Did_You_Forget2]'); ?>
					 </div>
					 <div class="for-add-prod-horz">
					 	<div class="for-add-prod-horz-head"><h4 class="forget-nor-head">Essential Items that are easy to forget</h4></div>
	             			<?php do_shortcode('[Did_You_Forget]'); ?>
	             	 </div>

	          </div>

	        </div>

	        <?php
	        $date1=WC()->session->get( 'from_date' );
		$date2=WC()->session->get( 'to_date' );

		    $date1 = str_replace('/', '-', $date1);
		    $date2 = str_replace('/', '-', $date2);

		    $date1 = date_create($date1);
		    $date2 = date_create($date2);
		    $diff=date_diff($date1,$date2);
	    		$diff_count = $diff->format("%a Days");
	    			//echo "<pre>";print_r($diff_count);exit();

	    		if ($diff_count != "0 Days") {
	    		$diff_count = $diff_count +1;
    			$diff_count = $diff_count." Days";
	    		}


			global $woocommerce;	
			$tax_data = $woocommerce->cart->tax_total;
			


			$Checkout_link = wc_get_checkout_url();
			?>

	          <div class="ins-table-footer modal-footer">
					<div class="need-txt">
						<p>Don’t know what you need? Talk to an Expert. <a href="#"> Live Chat</a> or <a href="#"> Call Us</a></p>
					</div>
					<div class="price-btn">
						<div class="total-txt-wrp">
							<div class="total-txt">
								<div class="total-txt-label">
									<span>Grand total</span>
								</div>
								
								<div class="total-price"><?php wc_cart_totals_order_total_html(); ?></div>
							</div>
							
							<p><span>Daily Rate: </span><span class="global_total"><?php echo WC()->session->get( 'cart_prod_ttl' ); ?> x <?php echo $diff_count;?> Days + $<?php echo $tax_data; ?> GST</span> </p>
						</div>
						<div class="add-btn">
							<button class="site-btn site-arrow" id="global_submit">Continue</button>
						</div>
					</div>
				</div>

	         
	      </div><!-- /.modal-content -->
	    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<?php 
$service_id_array = array('1365','1639','1121','1119','1118');

$service_id_array_count = count($service_id_array);

$services_api_array = array();
	
for ($i=0; $i < $service_id_array_count; $i++) { 


		$url = "https://api.current-rms.com/api/v1/services/".$service_id_array[$i];
	    $ch = curl_init( $url );
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	    curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
	    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	    $servicesresult = curl_exec($ch);
	    curl_close($ch);
	    $services_detail  = json_decode($servicesresult,true);
	    $services_detail_service  = $services_detail['service'];

	    $services_api_array[] = array('id' => $services_detail_service['id'],'name' => $services_detail_service['name'],'description' => $services_detail_service['description'],'price' => round($services_detail_service['flat_rate_price'],0)); 
	    	
}

	
?>



  	<div class="modal fade bd-example-modal-lg  collection_popup_box xxl-modal-cust collection-return-modal cart-ins-modal" id="dropoff_collection_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title" id="myLargeModalLabel">Collection & Return Options</h4>
	        
	        <div class="heading_content">
	        	<p>Although a standard pickup is our default option, many of our customers may be time poor, shooting back-to-back jobs or have difficulty transporting the items we have. To make things easier for you guys, we offer 5x different collection & return options.</p>
	        </div>
	        <button type="button" class="close cancel_button_dropoff" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	        <form class="collection_return_form">
		        <div class="modal-body">
		        		 
		        		 <table>
		        		 	  <tr>
		        		 	  	   <th></th>
		        		 	  	   <th>Collection</th>
		        		 	  	    <th>Return</th>

		        		 	  </tr>
		        		 	  <tr>
		        		 	  		<td>
		        		 	  			 <h6>Standard Pickup <span>(Free)</span></h6>
		        		 	  			 <p>Pickup your order from our warehouse anytime that<br> suits you within the</p>
		        		 	  		</td>
		        		 	  		 <td>
		        		 	  	 	 <div class="cust-radio-wrp">
		        						<input class="cal button" type="radio" value="0" checked  name="button_collection">
		        						<span class="checkmark"></span>
		        					</div>	
		        		 	  	 </td>
		        		 	  	   <td>
		        		 	  	 	 <div class="cust-radio-wrp">
		        						<input class="cal button" type="radio" value="0" checked name="button_return">
		        						<span class="checkmark"></span>
		        					</div>	
		        		 	  	 </td>
		        		 	  </tr>

		        		 	  <?php 
		        		 	  foreach ($services_api_array as $key => $service_val) { ?>


		        		 	  	<tr>
		        		 	  		<td>
		        		 	  			 <h6><?php echo $service_val['name'] ?><span>($<?php echo $service_val['price']; ?>)</span> <span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="" ><img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span> </h6>
		        		 	  			 <p><?php echo $service_val['description']; ?></p>
		        		 	  		</td>
		        		 	  		 <td>
		        		 	  	 	 <div class="cust-radio-wrp">
		        						<input class="cal button" type="radio" value="<?php echo $service_val['price']; ?>"  name="button_collection" <?php echo (WC()->session->get( 'butoon_collection' ) ==  $service_val['price'])? 'checked' : ''; ?>>
		        						<span class="checkmark"></span>
		        					</div>	
		        		 	  	 </td>
		        		 	  	   <td>
		        		 	  	 	 <div class="cust-radio-wrp">
		        						<input class="cal button" type="radio" value="<?php echo $service_val['price']; ?>" name="button_return" <?php echo (WC()->session->get( 'butoon_return' ) ==  $service_val['price'])? 'checked' : ''; ?>>
		        						<span class="checkmark"></span>
		        					</div>	
		        		 	  	 </td>
		        		 	  </tr>

		        		 	  	
		        		 	 <?php }

		        		 	  ?>



		        		 	  
		        		 	  
		        		 	          		 	  
		        		 	  
		        		 </table>

		                 
		        </div>
		        
		        <div class="ins-table-footer modal-footer">
					<div class="need-txt">
						<p>Need help with insurance? Let's talk.<a href="#"> Live Chat</a> or <a href="#"> Call Us</a></p>
					</div>
					<div class="price-btn">
						<div class="total-txt-wrp">
							<div class="total-txt">
								<div class="total-txt-label">									
									<span>Collection & Return Total</span>
								</div>
								
								<div class="total_collection_price" id="total_collection_price">$0</div>
							</div>
							<input type="hidden" name="cart_ttl" value="<?php echo WC()->cart->total; ?>">
							<?php $fees=WC()->cart->get_fees(); ?>
							<input type="hidden" name="current_selected_ins" value="<?php echo $fees['insurance']->total; ?>">
							
						</div>
						<div class="add-btn">
							<button class="site-btn site-arrow" id="collection_return_submit">Add</button>
						</div>
					</div>
				</div>
	        </form>
	    </div>
	  </div>
	</div>


	<!-- <div class="modal fade bd-example-modal-lg cart-ins-modal popup_box xxl-modal-cust" id="insurance_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title" id="myLargeModalLabel">Insurance</h4>
	        
	        <div class="heading_content">
	        	<p>Lighthouse Rentals has teamed up with N-sure to offer flexible insurence options for our customers. Insurance can not be added after your order has been picked up and is subject to the terms specified in our <a href="#">terms and conditions.</a></p>
	        </div>
	        <button type="button" class="close cancel_button" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	        <form>
		        <div class="modal-body">
		        	<table id="table1">
		        		<tr class="ins-title-rw">
		        			<td></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$name = get_sub_field('name');?>
								<td><?php echo ($name == 'Standard Insurance')? '<div class="rec-ins">Recommended Insurance</div>' : ''; ?><h6 class="ins-head"><?php echo $name; ?></h6></td>
							<?php endwhile; ?>
		        			
		        		</tr>
		        		<tr class="ins-head-subtxt">
		        			<td></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$short_description = get_sub_field('short_description');?>
								<td><p><?php echo $short_description; ?></p></td>
							<?php endwhile; ?>

		        			
		        		</tr>
		        		<tr class="insurence-price-rw">
		        			<td></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$price = get_sub_field('price');?>
								<td class="insurence_price"><span class="price ins-price-cell">$<?php echo $price ?></span></td>
							<?php endwhile; ?>
		        			
		        		</tr>
		        		<tr class="ins-radio-rw">
		        			<?php $rows = get_field('insurance_lists','option'); ?>
		        			<td><span class="req_error"></span></td>  
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row1 = $rows[0]; $p_row1 = $row1['price']; ?>
		        					<input class="button1 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row1)? 'checked' : ''; ?> type="radio" id="r1" name="radio_butoon" value="0.00">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" name="insurence1" value="No">
		        			</td>
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row2 = $rows[1]; $p_row2 = $row2['price']; ?>
		        					<input  class="button2 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row2)? 'checked' : ''; ?> type="radio" id="r2" name="radio_butoon" value="8.10">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" name="insurence2" value="Budget">
		        			</td>
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row3 = $rows[2]; $p_row3 = $row3['price']; ?>
		        					<input class="button3 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row3)? 'checked' : ''; ?> type="radio" id="r3" name="radio_butoon" value="24.30">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" name="insurence3" value="Standard">
		        			</td>
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row4 = $rows[3]; $p_row4 = $row4['price']; ?>
		        					<input class="button4 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row4)? 'checked' : ''; ?> type="radio" id="r4" name="radio_butoon" value="40.50">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" name="insurence4" value="Premium">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td><span class="ins-head-info">Excess</span><span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="<p>The excess is the amount you need to pay when making a claim on insurance. </p>" ><img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$excess = get_sub_field('excess'); ?>
								<td><?php echo (empty($excess))? '-' : '<span class="ins-price-cell">$'.$excess.'</span>'; ?></td>
							<?php endwhile; ?>
		        			
		        		</tr>
		        		<tr>
		        			<td><span class="ins-head-info">Dirty Return</span><span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="<p>Dirty Return</p>

		<p>We always encourage our customers to return their order in the same pristine condition it was sent out in but we know that if you're shooting out in the mud or dusty environments inevitably, this equipment will be returned dirty.</p> 

		<p>The 60 minutes of cover covers 60 minutes of our staff's time cleaning the equipment to get it back to it's default condition. 60 Minutes is the average amount of time it takes to clean an average hire.</p> " > 
		<img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$dirty_return = get_sub_field('dirty_return'); ?>
								<td><span class="ins-close-icn"><?php echo (empty($dirty_return))? '<img src="'.get_template_directory_uri().'/assets/img/close-icn.svg">' : $dirty_return; ?></span></td>
							<?php endwhile; ?>
		        			
		        		</tr>
		        		<tr>
		        			<td><span class="ins-head-info">Surcharge</span></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$surcharge = get_sub_field('surcharge');?>
								<td><?php echo (empty($surcharge))? '-' : '<span class="ins-price-cell">'.$surcharge.'</span>'; ?></td>
							<?php endwhile; ?>
		        			
		        		</tr>
		        		
		        	</table>
		                 <div class="ins-stage-txt">Insurance cannot be added after this stage</div>
		        </div>
		        
		        <div class="ins-table-footer modal-footer">
					<div class="need-txt">
						<p>Don’t know what you need? Talk to an Expert. <a href="#"> Live Chat</a> or <a href="#"> Call Us</a></p>
					</div>
					<div class="price-btn">
						<div class="total-txt-wrp">
							<div class="total-txt">
								<div class="total-txt-label">
									<span class="insurance_name">Standard</span>
									<span>Insurance total</span>
								</div>
								
								<div class="total-price" id="total-price">$24.30</div>
							</div>
							<input type="hidden" name="cart_ttl" value="<?php echo WC()->cart->total; ?>">
							<?php $fees=WC()->cart->get_fees(); ?>
							<input type="hidden" name="current_selected_ins" value="<?php echo $fees['insurance']->total; ?>">
							<p><span>Order Replacement Value: </span><span class="insurance_total">$145,780.69</span></p>
						</div>
						<div class="add-btn">
							
							<button class="site-btn site-arrow" id="insurence_submit">Add</button>
						</div>
					</div>
				</div>
	        </form>
	    </div>
	  </div>
	</div> -->


	<?php 
		$subtotal =$woocommerce->cart->get_subtotal();
		$currency_symbol =  get_woocommerce_currency_symbol();

		$totalWidth = $subtotal;
		$percentage_3 = 3;
		$percentage_9 = 9;
		$percentage_15 = 15;
	

		$percentage_3_detal = ($percentage_3 / 100) * $totalWidth;
		$percentage_9_detal = ($percentage_9 / 100) * $totalWidth;
		$percentage_15_detal = ($percentage_15 / 100) * $totalWidth;
		

			
	?>


	<div class="modal fade bd-example-modal-lg cart-ins-modal popup_box xxl-modal-cust" id="insurance_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title" id="myLargeModalLabel">Insurance</h4>
	        
	        <div class="heading_content">
	        	<p>Lighthouse Rentals has teamed up with N-sure to offer flexible insurence options for our customers. Insurance can not be added after your order has been picked up and is subject to the terms specified in our <a href="#">terms and conditions.</a></p>
	        </div>
	        <button type="button" class="close cancel_button" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	        <form>
		        <div class="modal-body">
		        	<table id="table1">
		        		<tr class="ins-title-rw">
		        			<td></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$name = get_sub_field('name');?>
								<td><?php echo ($name == 'Standard Insurance')? '<div class="rec-ins">Recommended Insurance</div>' : ''; ?><h6 class="ins-head"><?php echo $name; ?></h6></td>
							<?php endwhile; ?>
		        			
		        		</tr>
		        		<tr class="ins-head-subtxt">
		        			<td></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$short_description = get_sub_field('short_description');?>
								<td><p><?php echo $short_description; ?></p></td>
							<?php endwhile; ?>
		        		</tr>
		        		<tr class="insurence-price-rw">
		        			<td></td>		        			
		        			<td class="insurence_price" style="color: #E95F32"><span class="price ins-price-cell">$0.00</span></td>
		        			<td class="insurence_price" style="color: #E95F32"><span class="price ins-price-cell"><?php echo $currency_symbol; ?><?php echo $percentage_3_detal; ?></span></td>
		        			<td class="insurence_price" style="color: #E95F32"><span class="price ins-price-cell"><?php echo $currency_symbol; ?><?php echo $percentage_9_detal; ?></span></td>
		        			<td class="insurence_price" style="color: #E95F32"><span class="price ins-price-cell"><?php echo $currency_symbol; ?><?php echo $percentage_15_detal; ?></span></td>
		        		</tr>
		        		<tr class="ins-radio-rw">
		        			<?php $rows = get_field('insurance_lists','option'); ?>
		        			<td><span class="req_error"></span></td>  
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row1 = $rows[0]; $p_row1 = $row1['price']; ?>
		        					<input class="button1 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row1)? 'checked' : ''; ?> type="radio" id="r1" name="radio_butoon" value="0.00" data-name="No">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence1" name="insurence1" value="No">
		        			</td>
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row2 = $rows[1]; $p_row2 = $row2['price']; ?>
		        					<input  class="button2 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row2)? 'checked' : ''; ?> type="radio" id="r2" name="radio_butoon" value="<?php echo $percentage_3_detal; ?>"  data-name="Budget">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence2" name="insurence2" value="Budget">
		        			</td>
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row3 = $rows[2]; $p_row3 = $row3['price']; ?>
		        					<input class="button3 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row3)? 'checked' : ''; ?> type="radio" id="r3" name="radio_butoon" value="<?php echo $percentage_9_detal; ?>" data-name="Standard">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence3" name="insurence3" value="Standard">
		        			</td>
		        			<td>
		        				<div class="cust-radio-wrp">
		        					<?php $row4 = $rows[3]; $p_row4 = $row4['price']; ?>
		        					<input class="button4 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row4)? 'checked' : ''; ?> type="radio" id="r4" name="radio_butoon" value="<?php echo $percentage_15_detal; ?>" data-name="Premium">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence4" name="insurence4" value="Premium">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td><span class="ins-head-info">Excess</span><span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="<p>The excess is the amount you need to pay when making a claim on insurance. </p>" ><img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$excess = get_sub_field('excess'); ?>
								<td><?php echo (empty($excess))? '-' : '<span class="ins-price-cell">$'.$excess.'</span>'; ?></td>
							<?php endwhile; ?>
		        			<!-- <td>-</td>
		        			<td><h6 class="ins-price-cell">$10,000</span></h6>
		        			<td><h6 class="ins-price-cell">$2,000</span></h6>
		        			<td><h6 class="ins-price-cell">$800</span></h6> -->
		        		</tr>
		        		<tr>
		        			<td><span class="ins-head-info">Dirty Return</span><span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="<p>Dirty Return</p>

<p>We always encourage our customers to return their order in the same pristine condition it was sent out in but we know that if you're shooting out in the mud or dusty environments inevitably, this equipment will be returned dirty.</p> 

<p>The 60 minutes of cover covers 60 minutes of our staff's time cleaning the equipment to get it back to it's default condition. 60 Minutes is the average amount of time it takes to clean an average hire.</p> " > <img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$dirty_return = get_sub_field('dirty_return'); ?>
								<td><span class="ins-close-icn"><?php echo (empty($dirty_return))? '<img src="'.get_template_directory_uri().'/assets/img/close-icn.svg">' : $dirty_return; ?></span></td>
							<?php endwhile; ?>
		        			<!-- <td><span class="ins-close-icn"><img src="<?php echo get_template_directory_uri()."/assets/img/close-icn.svg"; ?>"></span></td>
		        			<td><span class="ins-close-icn"><img src="<?php echo get_template_directory_uri()."/assets/img/close-icn.svg"; ?>"></span></td>
		        			<td><span class="ins-close-icn"><img src="<?php echo get_template_directory_uri()."/assets/img/close-icn.svg"; ?>"></span></td>
		        			<td><span class="ins-close-icn"><span class="ins-price-cell">60</span><span class="minut-cover">Minutes Cover</span></span></td> -->
		        		</tr>
		        		<tr>
		        			<td><span class="ins-head-info">Surcharge</span></td>
		        			<?php while( have_rows('insurance_lists','option') ): the_row();
								$surcharge = get_sub_field('surcharge');?>
								<td><?php echo (empty($surcharge))? '-' : '<span class="ins-price-cell">'.$surcharge.'</span>'; ?></td>
							<?php endwhile; ?>
		        			<!-- <td>-</td>
		        			<td><span class="ins-price-cell">3%</span></td>
		        			<td><span class="ins-price-cell">9%</span></td>
		        			<td><span class="ins-price-cell">15%</span></td> -->
		        		</tr>
		        		
		        	</table>
		                 <div class="ins-stage-txt">Insurance cannot be added after this stage</div>
		        </div>
		        
		        <div class="ins-table-footer modal-footer">
					<div class="need-txt">
						<p>Don’t know what you need? Talk to an Expert. <a href="#"> Live Chat</a> or <a href="#"> Call Us</a></p>
					</div>
					<div class="price-btn">
						<div class="total-txt-wrp">
							<div class="total-txt">
								<div class="total-txt-label">
									<span class="insurance_name">Standard</span>
									<span>Insurance total</span>
								</div>
								
								
								<div class="total-price" id="total-price">$0.00</div>
							</div>
							<input type="hidden" name="cart_ttl" value="<?php echo WC()->cart->total; ?>">
							<?php $fees=WC()->cart->get_fees(); ?>
							<input type="hidden" name="current_selected_ins" value="<?php echo $fees['insurance']->total; ?>">

							<p><span>Order Replacement Value: </span><span class="insurance_total_data"><?php echo get_woocommerce_currency_symbol(); ?><?php echo $replacement_charge_sum; ?></span></p>
						</div>
						<div class="add-btn">
							<button class="site-btn site-arrow" id="insurence_submit_popup">Add</button>
						</div>
					</div>
				</div>
	        </form>
	    </div>
	  </div>
	</div>

	<?php 
		$subtotal =$woocommerce->cart->get_subtotal();
		$currency_symbol =  get_woocommerce_currency_symbol();

		$totalWidth = $subtotal;
		$percentage_3 = 3;
		$percentage_9 = 9;
		$percentage_15 = 15;
	

		$percentage_3_detal = ($percentage_3 / 100) * $totalWidth;
		$percentage_9_detal = ($percentage_9 / 100) * $totalWidth;
		$percentage_15_detal = ($percentage_15 / 100) * $totalWidth;
		

			
	?>




	<div class="modal fade bd-example-modal-lg cart-ins-modal popup_box xxl-modal-cust" id="insurance_modal_data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title" id="myLargeModalLabel">Insurance</h4>
	        
	        <div class="heading_content">
	        	<p>Lighthouse Rentals has teamed up with N-sure to offer flexible insurence options for our customers. Insurance can not be added after your order has been picked up and is subject to the terms specified in our <a href="#">terms and conditions.</a></p>
	        </div>
	        <button type="button" class="close cancel_button" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	      </div>
	        <form>
		        <div class="modal-body">
		        	<table id="table1">
		        		<tr class="ins-title-rw">
		        			<td class="insurance_class_1"></td>

		        			<?php 

		        			$insurance_class = 2;

		        			while( have_rows('insurance_lists','option') ): the_row();
							$name = get_sub_field('name');?>


							<td class="<?php echo "insurance_class_".$insurance_class; ?>"><?php echo ($name == 'Standard Insurance')? '<div class="rec-ins">Recommended Insurance</div>' : ''; ?><h6 class="ins-head"><?php echo $name; ?></h6></td>

						<?php 
							$insurance_class ++;
							endwhile; 

							?>
		        			
		        		</tr>
		        		<tr class="ins-head-subtxt">
		        			<td class="insurance_class_1"></td>
		        			<?php 
		        				$insurance_class = 2;
		        				while( have_rows('insurance_lists','option') ): the_row();
								$short_description = get_sub_field('short_description');?>
								<td class="<?php echo "insurance_class_".$insurance_class; ?>"><p><?php echo $short_description; ?></p></td>
							<?php 	
								$insurance_class ++;
								endwhile; 
							?>

		        			
		        		</tr>
		        		<tr class="insurence-price-rw">
		        			<td class="insurance_class_1"></td>		        			
		        			<td class="insurence_price insurance_class_2" style="color: #E95F32"><span class="price ins-price-cell">$0.00</span></td>
		        			<td class="insurence_price insurance_class_3" style="color: #E95F32"><span class="price ins-price-cell"><?php echo $currency_symbol; ?><?php echo $percentage_3_detal; ?></span></td>
		        			<td class="insurence_price insurance_class_4" style="color: #E95F32"><span class="price ins-price-cell"><?php echo $currency_symbol; ?><?php echo $percentage_9_detal; ?></span></td>
		        			<td class="insurence_price insurance_class_5" style="color: #E95F32"><span class="price ins-price-cell"><?php echo $currency_symbol; ?><?php echo $percentage_15_detal; ?></span></td>
		        		</tr>
		        		<tr class="ins-radio-rw">
		        			<?php $rows = get_field('insurance_lists','option'); ?>
		        			<td class="insurance_class_1"><span class="req_error"></span></td>  
		        			<td class="insurance_class_2">
		        				<div class="cust-radio-wrp">
		        					<?php $row1 = $rows[0]; $p_row1 = $row1['price']; ?>
		        					<input class="button1 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row1)? 'checked' : ''; ?> type="radio" id="r1" name="radio_butoon" value="0.00" data-name="No" data-per="-">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence1" name="insurence1" value="No">
		        			</td>
		        			<td class="insurance_class_3">
		        				<div class="cust-radio-wrp">
		        					<?php $row2 = $rows[1]; $p_row2 = $row2['price']; ?>
		        					<input  class="button2 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row2)? 'checked' : ''; ?> type="radio" id="r2" name="radio_butoon" value="<?php echo $percentage_3_detal; ?>"  data-name="Budget" data-per="3">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence2" name="insurence2" value="Budget">
		        			</td>
		        			<td class="insurance_class_4">
		        				<div class="cust-radio-wrp">
		        					<?php $row3 = $rows[2]; $p_row3 = $row3['price']; ?>
		        					<input class="button3 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row3)? 'checked' : ''; ?> type="radio" id="r3" name="radio_butoon" checked value="<?php echo $percentage_9_detal; ?>" data-name="Standard" data-per="9">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence3" name="insurence3" value="Standard">
		        			</td>
		        			<td class="insurance_class_5">
		        				<div class="cust-radio-wrp">
		        					<?php $row4 = $rows[3]; $p_row4 = $row4['price']; ?>
		        					<input class="button4 button" <?php echo (WC()->session->get( 'insurance_amount' ) == $p_row4)? 'checked' : ''; ?> type="radio" id="r4" name="radio_butoon" value="<?php echo $percentage_15_detal; ?>" data-name="Premium" data-per="15">
		        					<span class="checkmark"></span>
		        				</div>
		        				<input type="hidden" id="insurence4" name="insurence4" value="Premium">
		        			</td>
		        		</tr>
		        		<tr>
		        			<td class="insurance_class_1"><span class="ins-head-info">Excess</span><span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="<p>The excess is the amount you need to pay when making a claim on insurance. </p>" ><img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span></td>
		        			<?php 
		        			$insurance_class = 2;
		        			while( have_rows('insurance_lists','option') ): the_row();
								$excess = get_sub_field('excess'); ?>
								<td class="<?php echo "insurance_class_".$insurance_class; ?>"><?php echo (empty($excess))? '-' : '<span class="ins-price-cell">$'.$excess.'</span>'; ?></td>
							<?php 
							$insurance_class++;
							endwhile; 

							?>
		        		</tr>
		        		<tr>
		        			<td class="insurance_class_1"><span class="ins-head-info">Dirty Return</span><span class="info-icn" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true"  title="<p>Dirty Return</p>

<p>We always encourage our customers to return their order in the same pristine condition it was sent out in but we know that if you're shooting out in the mud or dusty environments inevitably, this equipment will be returned dirty.</p> 

<p>The 60 minutes of cover covers 60 minutes of our staff's time cleaning the equipment to get it back to it's default condition. 60 Minutes is the average amount of time it takes to clean an average hire.</p> " > <img src="<?php echo get_template_directory_uri()."/assets/img/info.svg"; ?>"></span></td>
		        			<?php 
		        			$insurance_class = 2;
		        			while( have_rows('insurance_lists','option') ): the_row();
								$dirty_return = get_sub_field('dirty_return'); ?>
								<td class="<?php echo "insurance_class_".$insurance_class; ?>"><span class="ins-close-icn"><?php echo (empty($dirty_return))? '<img src="'.get_template_directory_uri().'/assets/img/close-icn.svg">' : $dirty_return; ?></span></td>
							<?php 
							$insurance_class++;
							endwhile; 
							?>
		        			
		        		</tr>
		        		<tr>
		        			<td class="insurance_class_1"><span class="ins-head-info">Surcharge</span></td>
		        			<?php 
		        			$insurance_class = 2;
		        			while( have_rows('insurance_lists','option') ): the_row();
								$surcharge = get_sub_field('surcharge');?>
								<td class="<?php echo "insurance_class_".$insurance_class; ?>"><?php echo (empty($surcharge))? '-' : '<span class="ins-price-cell">'.$surcharge.'</span>'; ?></td>
							<?php 
							$insurance_class++;
							endwhile; 
							?>
		        			
		        		</tr>
		        		
		        	</table>
		                 <div class="ins-stage-txt">Insurance cannot be added after this stage</div>
		        </div>
		        
		        <div class="ins-table-footer modal-footer">
					<div class="need-txt">
						<p>Don’t know what you need? Talk to an Expert. <a href="#"> Live Chat</a> or <a href="#"> Call Us</a></p>
					</div>
					<div class="price-btn">
						<div class="total-txt-wrp">
							<div class="total-txt">
								<div class="total-txt-label">
									<span class="insurance_name">Standard</span>
									<span>Insurance total</span>
								</div>
								
								
								<div class="total-price" id="total-price">$0.00</div>
							</div>
							<input type="hidden" name="cart_ttl" value="<?php echo WC()->cart->total; ?>">
							<?php $fees=WC()->cart->get_fees(); ?>
							<input type="hidden" name="current_selected_ins" value="<?php echo $fees['insurance']->total; ?>">
							<p><span>Order Replacement Value: </span><span class="insurance_total_data"><?php echo get_woocommerce_currency_symbol(); ?>
							<?php
								//echo "<pre>";print_r($replacement_charge_sum);exit();
							?>
							<?php echo $replacement_charge_sum; ?></span></p>
						</div>
						<div class="add-btn">
							<button class="site-btn site-arrow" id="insurence_submit">Add</button>
						</div>
					</div>
				</div>
	        </form>
	    </div>
	  </div>
	</div>
	

<?php do_action( 'woocommerce_after_cart' ); ?>
<!-- 13-10-21 -->
<style type="text/css">
	

</style>


<script>
	jQuery(".popup_add_t_cart").on("click",function(){
		var popup_add_t_cart_val = jQuery(this).attr('value');

		var popup_add_t_cart_price = jQuery('.price-btn > .total-txt-wrp > .total-txt > .total-price > strong > span > bdi').text().replace("$", "").replace(/\"/g, "").trim();
		popup_add_t_cart_price = popup_add_t_cart_price.replace(/,/g, '');
		var total_price = parseInt(popup_add_t_cart_price) + parseInt(popup_add_t_cart_val);
		jQuery('.price-btn > .total-txt-wrp > .total-txt > .total-price > strong > span > bdi').text("$"+total_price);
		
	});
</script>