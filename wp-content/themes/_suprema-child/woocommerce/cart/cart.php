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

do_action( 'woocommerce_before_cart' ); ?>
<div class="woocommerce-cart-wrp">
	
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<div class="cart-left-col">	
				<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
					<thead>
					<tr>
						<!-- <th class="product-remove">&nbsp;</th> -->
						<th class="product-quantity"><?php esc_html_e( 'Qty', 'suprema' ); ?></th>
						<th class="product-name"><?php esc_html_e( 'Item', 'suprema' ); ?></th>
						<th class="product-thumbnail">&nbsp;</th>
						<th class="product-price"><?php esc_html_e( 'Price', 'suprema' ); ?></th>
						<th class="product-subtotal"><?php esc_html_e( 'Total Price', 'suprema' ); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>
					
					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
								
								<!-- <td class="product-remove"> -->
									<?php
									
									/*echo apply_filters( 
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											__( 'Remove this item', 'suprema' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);*/
									?>
								<!-- </td> -->
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
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</td>
								
								
								
								<td class="product-subtotal" data-title="<?php esc_attr_e( 'Total', 'suprema' ); ?>">
									<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</td>
							</tr>
							<?php
						}
					}
					?>
					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
					</tbody>
				</table>
				
			</div>

			<div class="cart-right-col">
				<h3>Order Summary</h3>
				<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
				<div class="cart-collaterals">
					
					<div class="qodef-cart-totals">
						
						<?php do_action( 'woocommerce_cart_collaterals' ); ?>
					
					</div>
				
				</div>
			 	  <div class="cart-sidebar">
			 	  			<div class="cart-aside-bx">
			 	  					<div class="cart-support-bx">
			 	  							<div class="cart-support-icn"></div>
			 	  							<h3>Support</h3>
			 	  							<p>Need Help with your order? Talk to an expert. <a href="#">Live Chat with us.</a></p>	
			 	  					</div>
			 	  			</div>
			 	  			<div class="cart-aside-bx">
			 	  					<div class="cart-sharecart-bx">
			 	  							<h3>Share cart</h3>
			 	  							<p>Share this cart with the lighthouse team or other members of your production by copying the below code and sending it over</p>	
			 	  							<div class="cart-sharecart">
			 	  								<input type="text" placeholder="493G8913D3287">
			 	  								<input type="submit">
			 	  							</div>

			 	  					</div>
			 	  			</div>
			 	  			
			 	 
			 	  <?php if ( wc_coupons_enabled() ) { ?>
			 	  	<div class="cart-aside-bx">
						<div class="coupon">
							
							<h3><label for="coupon_code"><?php esc_html_e( 'Discount Code', 'suprema' ); ?></label></h3>
							<p>If you have one, enter your Coupon Code, Referral Code or Credit Code to apply it to this hire.</p>
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
							       placeholder="<?php esc_attr_e( 'Coupon Code', 'suprema' ); ?>"/>
							
							<?php
							//Override Apply Coupon Button
							do_action( 'suprema_qodef_woocommerce_apply_coupon_button' );
							?>
							
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					</div>
				<?php } ?>		
				 </div>
	 		</div>
			
			
			<div class="actions clearfix">
				
				

				<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
				<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
				<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
				<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

				
				<div class="booking_information">
					<div class="project_data">
				        <h3>Booking Information</h3>
				        <div class="book-info-rw">
				        	
						<p class="form-row form-row-first validate-required" id="billing_project_name_field" data-priority="10">
						    <label for="billing_project_name" class="">Project Name&nbsp;</label>
						    <span class="woocommerce-input-wrapper"><input type="text" class="input-text" name="billing_project_name" id="billing_project_name" placeholder="Enter Project Name" value=""></span>
						</p>
						<p class="form-row form-row-last  validate-required" id="billing_project_type_field" >
							<label for="billing_project_type" class="">Project Type&nbsp;</label>
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
						    <label for="billing_booking_start_date" class="">Hire Period&nbsp;</label>
						    <span class="woocommerce-input-wrapper"><input type="text" name="daterange" value="" /></span>				    
						</p>
						
						<p class="form-row form-row-first validate-required" id="calculated_days_field" data-priority="10">
						    <label for="calculated_days" class="">Calculated Days&nbsp;</label>
						    <span class="woocommerce-input-wrapper"><input type="text" class="input-text" name="calculated_days" id="calculated_days" placeholder="" value=""></span>
						</p>
						
						
						<p class="form-row form-row-first validate-required full-row" id="payment_method_cod_field" data-priority="10">
							

							<label for="payment_method_cod" class="cus-checkbox"><input id="payment_method_cod" type="checkbox" class="input-radio" name="payment_method" value="cod"  data-order_button_text=""><span class="checkmark"></span>I Accept the <a href="">terms of hire</a></label>
						</p>
						
						</div>
						<div class="qodef-cart-proceed-update">
				
							<?php
							//Override Apply Coupon Button
							do_action( 'suprema_qodef_woocommerce_update_cart_button' );
							?>
							<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
							
							<?php do_action( 'woocommerce_cart_actions' ); ?>
							
							<?php wp_nonce_field( 'woocommerce-cart' ); ?>
							
							
						
						</div>
					</div>
					<div class="book-info-image">
						

						<img src="<?php echo site_url()."/wp-content/uploads/shake hands.png"; ?>">
					</div>
				</div>
			
				<script>
					$(function() {
					  $('input[name="daterange"]').daterangepicker({
					    opens: 'left'
					  }, function(start, end, label) {
					    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

					    var Difference_In_Time = end - start;
		 
						// To calculate the no. of days between two dates
						var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
						Difference_In_Days =Math.round(Difference_In_Days);
					    $("#calculated_days").val(Difference_In_Days+" Days");
					  });
					});
				</script>
				<!-- <script type="text/javascript">

			    jQuery(document).ready(function($) {
			        jQuery("#billing_booking_start_date").datepicker({
			        	minDate: 0,
			        	dateFormat: 'dd/mm/yy',
			        });

				    jQuery("#billing_booking_end_date").datepicker({
				    	minDate: 0,
				    	dateFormat: 'dd/mm/yy',
					    onSelect: function(dateText, inst) {
					        var startDate = jQuery("#billing_booking_start_date").val(); 
					        var endDate = dateText
					        getBookingDays(startDate,endDate);
					    }
				    });
			    });

			    function getBookingDays(startDate,endDate){
		            var action_data = "days";
		        	jQuery.ajax({
		               url:"<?php //echo admin_url("admin-ajax.php"); ?>",
			                type:"POST",
		                data: "startDate=" + startDate + "&endDate=" + endDate + "&action=" + action_data,
		                success: function(data){
		                	jQuery( document.body ).trigger( "update_checkout" );
		                }
		            });
		        }
		    </script> -->



			</div>
			
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
			
			<div class="notification_section">
				<p>Hey 👋, we’re building a brand new booking website which will be up soon. For now if you want to place a booking please copy or screenshot your cart and email the order to <a href="mailto:bookings@lighthouserentals.com.au">bookings@lighthouserentals.com.au</a></p>
			</div>
			
			

		</form>
	
	 	
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
