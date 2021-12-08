<?php
class SupremaQodefWoocommerceDropdownCart extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'qodef_woocommerce_dropdown_cart', // Base ID
			'Select Woocommerce Dropdown Cart', // Name
			array( 'description' => esc_html__( 'Select Woocommerce Dropdown Cart', 'suprema' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );
		
		global $woocommerce; 
		global $suprema_qodef_options;
		
		$cart_style = 'qodef-with-icon';
		
		?>
		<div class="qodef-shopping-cart-outer">
			<div class="qodef-shopping-cart-inner">
				<div class="qodef-shopping-cart-header">
					<a class="qodef-header-cart" href="<?php echo wc_get_cart_url(); ?>">
						<span class="qodef-cart-label"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
					</a>
					
					<div class="qodef-shopping-cart-dropdown">					
						<?php
						//echo "<pre>";print_r($woocommerce->cart->get_cart());exit();
						$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
						$list_class = array( 'qodef-cart-list', 'product_list_widget' );
						?>
						<ul>

							<?php if ( !$cart_is_empty ) : ?>

								<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

									$_product = $cart_item['data'];

									// Only display if allowed
									if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
										continue;
									}

									// Get price
									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
?>


									<li>
										<div class="qodef-item-image-holder">
											<div class="qodef-item-image-holder-inner">
												<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
													<?php echo wp_kses($_product->get_image(), array(
														'img' => array(
															'src' => true,
															'width' => true,
															'height' => true,
															'class' => true,
															'alt' => true,
															'title' => true,
															'id' => true
														)
													)); ?>
												</a>
											</div>
										</div>
										<div class="qodef-item-info-holder">
											<div class="qodef-item-left">
												<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'])); ?>">
													<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
												</a>
												<span class="qodef-quantity"><?php esc_html_e('Quantity: ','suprema'); echo esc_html($cart_item['quantity']); ?></span>
												<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
											</div>
											<div class="qodef-item-right">
												<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon_close"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'suprema')), $cart_item_key); ?>
											</div>
										</div>
									</li>

								<?php endforeach; ?>
								<li class="qodef-cart-bottom">
									<div class="qodef-subtotal-holder clearfix">
										<span class="qodef-total"><?php esc_html_e( 'Total', 'suprema' ); ?>:</span>
										<span class="qodef-total-amount">
											<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
												'span' => array(
													'class' => true,
													'id' => true
												)
											)); ?>
										</span>
									</div>
									<div class="qodef-btns-holder clearfix">
										<a href="<?php echo wc_get_cart_url(); ?>" class="qodef-btn-small view-cart"><span class="icon_bag_alt"></span><?php esc_html_e( 'View Cart', 'suprema' ); ?></a>
										<a href="<?php echo wc_get_checkout_url(); ?>" class="qodef-btn-small checkout"><span class="icon_box-checked"></span><?php esc_html_e( 'Checkout', 'suprema' ); ?></a>
									</div>
								</li>
							<?php else : ?>

								<li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'suprema' ); ?></li>

							<?php endif; ?>

						</ul>
						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
						

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

}

// WooCommerce plugin changed hooks in 3.0 version and because of that we have this condition
if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
    add_filter( 'woocommerce_add_to_cart_fragments', 'suprema_qodef_woocommerce_header_add_to_cart_fragment' );
} else {
    add_filter( 'add_to_cart_fragments', 'suprema_qodef_woocommerce_header_add_to_cart_fragment' );
}
function suprema_qodef_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();
	?>
	<div class="qodef-shopping-cart-header">
		<a class="qodef-header-cart" href="<?php echo wc_get_cart_url(); ?>">
			<span class="qodef-cart-label"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
		</a>		
		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" href="/resources/demos/style.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
		<div class="qodef-shopping-cart-dropdown">
	      	

			<?php
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;			
		    $from_date = WC()->session->get( 'from_date' );
		    $to_date = WC()->session->get( 'to_date' );

		    if (!empty($from_date)) {
		    	$fdt = $from_date;
		    } else {
		    	$fdt = "";
		    }


		    if (!empty($to_date)) {
		    	$edt = $to_date;
		    } else {
		    	$edt = "";
		    }
		    
			?>
			<ul>

				<?php if ( !$cart_is_empty ) : ?>

					<div class="parent_div_datepicker">
			      		<div class="startdate_datepicker">
			      			 	<i class="fa fa-calendar"></i>
			      			 <div class="date-input-box">
							<label for="from">Start Date</label>
					      	<input type="text" id="from" name="from" placeholder="Select start date" value="<?php echo $fdt ?>">
					      </div>
				      	</div>
				      		<span class="separator"> -> </span>
				      	<div class="enddate_datepicker">
				      			<i class="fa fa-calendar"></i>
				      		<div class="date-input-box">
					    	<label for="to">End Date</label>
					    	<input type="text" id="to" name="to" placeholder="Select end date" value="<?php echo $edt ?>">
					    </div>
				    	</div>
				    </div>

					<script>
					  jQuery( function() {
					    var dateFormat = "dd/mm/yy",
					      from = jQuery( "#from" )
					        .datepicker({
					          defaultDate: "+1w",
					          changeMonth: true,
					          numberOfMonths: 1,
					          minDate:0,
					          dateFormat:"dd/mm/yy"
					        })
					        .on( "change", function() {
					          to.datepicker( "option", "minDate", getDate( this ) );
					          jQuery.ajax({
									type: "post",
									url: "/wp-admin/admin-ajax.php",
									data: {
										action:'from_date',
										from_date: jQuery(this).val()
									}
								});
					        }),
					      to = jQuery( "#to" ).datepicker({
					        defaultDate: "+1w",
					        changeMonth: true,
					        numberOfMonths: 1,
					        dateFormat:"dd/mm/yy",
					      })
					      .on( "change", function() {
					      	jQuery(".checkout").attr('href',"https://lighthouserentals.mobilegiz.com/checkout/").css("pointer-events","auto");
					      	jQuery(".display_date_massage").css("display","none");					      	
					        from.datepicker( "option", "maxDate", getDate( this ) );
					        
					        jQuery.ajax({
								type: "post",
								url: "/wp-admin/admin-ajax.php",
								data: {
									action:'to_date',
									to_date: jQuery(this).val()
								}
							});

					      });
					 
					    function getDate( element ) {
					      var date;
					      try {
					        date = jQuery.datepicker.parseDate( dateFormat, element.value );
					      } catch( error ) {
					        date = null;
					      }
					 
					  //alert(date);
					      return date;
					    }
					  } );


		  			</script>

					<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

						$_product = $cart_item['data'];

						// Only display if allowed
						if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
							continue;
						}

						// Get price
						$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
						?>

						<li>
							<div class="qodef-item-image-holder">
								<div class="qodef-item-image-holder-inner">
									<?php echo wp_kses($_product->get_image(), array(
										'img' => array(
											'src' => true,
											'width' => true,
											'height' => true,
											'class' => true,
											'alt' => true,
											'title' => true,
											'id' => true
										)
									)); ?>
								</div>
							</div>
							<div class="qodef-item-info-holder">
								<div class="qodef-item-left">
									<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
										<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
									</a>
									<span class="qodef-quantity"><?php esc_html_e('Quantity: ','suprema'); echo esc_html($cart_item['quantity']); ?></span>
									<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
								</div>
								<div class="qodef-item-right">
									<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><span class="icon_close"></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__('Remove this item', 'suprema')), $cart_item_key); ?>
								</div>
							</div>
						</li>

					<?php endforeach; ?>
						<li class="qodef-cart-bottom">
							<div class="qodef-subtotal-holder clearfix">
								<span class="qodef-total"><?php esc_html_e( 'Total', 'suprema' ); ?>:</span>
								<span class="qodef-total-amount">
									<?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), array(
										'span' => array(
											'class' => true,
											'id' => true
										)
									)); ?>
								</span>
							</div>
							<div class="qodef-btns-holder clearfix">
							<span class="display_date_massage" style="color: #a00">Start date and End date is mandatory.</span>
								<a href="<?php echo wc_get_cart_url(); ?>" class="qodef-btn-small view-cart">
									<span class="icon_bag_alt"></span><?php esc_html_e( 'View Cart', 'suprema' ); ?>
								</a>
								<a href="" class="qodef-btn-small checkout">
									<span class="icon_box-checked"></span><?php esc_html_e( 'Checkout', 'suprema' ); ?>
								</a>
							</div>
						</li>
				<?php else : ?>

					<li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'suprema' ); ?></li>

				<?php endif; ?>

			</ul>
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
			

			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
		</div>
	</div>

	<?php
	$fragments['div.qodef-shopping-cart-header'] = ob_get_clean();
	return $fragments;
}
?>