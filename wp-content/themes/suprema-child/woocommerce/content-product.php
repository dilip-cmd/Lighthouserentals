<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
global $wpdb;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}



		
//Get setting for product list style and create html structure based on type
$tag = suprema_qodef_options()->getOptionValue('qodef_products_list_style');
?>



<?php switch($tag) {
	case 'standard': ?>


		<li <?php wc_product_class( '', $product ); ?>>
				<?php 
				if ( $product->is_on_sale() ) { ?>				    
				    <span class="title_tag"><span class="m-none">ONLINE ONLY</span> SALE</span>
				<?php } ?>
			<div class="qodef-product-standard-image-holder">

					<?php 

						global $wpdb,$get_product_detail;
						$pro_category_ids = $product->category_ids;
						if (in_array("1007",$pro_category_ids)) {

							$product_post_id = $product->get_id();

							if (!class_exists('get_product_detail')) {
			        			include ABSPATH . "/get_product_detail.php";
			        			
			    			}


			    			$accitems =  $get_product_detail->getaccitems($product_post_id);

			    				//echo "<pre>";print_r($accitems);exit();

						//echo "<pre>";print_r($accitems['ul']);exit();
							/*----------------------------------*/
							/*$crms_id = get_post_meta( $product_post_id, 'crms_id');


								print_r($product_post_id);

			                $main_package_id = "";
			                if (isset($crms_id[0])) {
			                    $main_package_id = $crms_id[0];
			                }

			        		$acc_detail = array();
			                $acc_detail_data = array();
			                    $add_ul = "<ul class='new_ul_acc'>";
			                if (!empty($main_package_id)) {
			                    
			                    //$main_package = getProductDetailFormRms($main_package_id);


			                    $url = "https://api.current-rms.com/api/v1/products/".$main_package_id;
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
						        $main_package = json_decode($result);



			                    // echo "<pre>";print_r($main_package);exit();
			                    $custom_fields = get_post_meta( $main_package_id, 'custom_fields', true);
			                    $custom_field = json_decode($custom_fields);

			                    $product_detail_from_rms = $main_package->product;
			                       

			                    $pro_acc_detail = $product_detail_from_rms->accessories;
			                    $price_pro_total = array();
			                    foreach ($pro_acc_detail as $key => $value) {
			                        $qt = $value->quantity;

			                        $url = "https://api.current-rms.com/api/v1/products/".$value->related_id;
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
							        $acc_detail = json_decode($result);


			                        //$acc_detail = getProductDetailFormRms($value->related_id);
			                        $acc_pro_detail = $acc_detail->product;
			                           // echo "<pre>";print_r($acc_detail);exit();
			                        $rental_rate = $acc_pro_detail->rental_rate;
			                        $price = round($rental_rate->price,0);

			                        $price_pro_total[] = $price;

			                        $acc_detail_data[] = '<li><span class="qty_pro">x'.round($value->quantity,0).'</span><h6>'.$acc_pro_detail->name.'</h6><span class="pkg-span-price span">$'.$price.'</span><li>';
			                    }

			                       $package_price =  array_sum($price_pro_total);

			                }*/
			                    $acc_detail_data = implode($acc_detail_data);

			                       // echo "<pre>";print_r($acc_detail_data);

			                    $add_ul .= $accitems['ul'];
							/*----------------------------------*/

							$post_slug = get_post_field( 'post_name', get_post() );
							?>

							<div class='pkg-list-hov'>
			            	<a class='bdl_pkg_lnk_dtl' href='<?php echo site_url()."/product/".$post_slug; ?>'>
			   					<h4 class='pkg-list-head'>Items in package</h4>
			   					<?php echo $add_ul; ?>
			   					<div class='save-per'>
			      					<div class='save-per-txt'>SAVE 20%</div>
			      						<span class='price'>
			      							<ins>
			      								<span class='woocommerce-Price-amount amount'>
			      									<bdi>
			      									<span class='woocommerce-Price-currencySymbol'>$</span><?php echo $accitems['pro_price_meta']; ?>
			      									</bdi>
			      								</span>
			      							</ins>
			      						</span>
			   					</div>
			   				</a>
						</div>

						<?php }

						

					?>


					<?php
					/**
					 * woocommerce_before_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item' );
					?>



					<span class="qodef-original-image">

					<?php

					$result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$product->get_id()."'");
					$ex_meta_value = explode(',', $result[0]->meta_value);
					
					 if (in_array("Popular", $ex_meta_value)) { ?>
						<span class="popular_product cattag_pro-btn">Popular</span>
					 <?php } 
					 if (in_array("New", $ex_meta_value)) { ?>
						<span class="newarrival_product cattag_pro-btn">New Arrival</span>
					<?php  } 
					 if (in_array("Exclusive", $ex_meta_value)) { ?>
						<span class="exclusive_product cattag_pro-btn">Exclusive to LightHouse</span>
					<?php } 
					 if (in_array("Essentials", $ex_meta_value)) { ?>
						<span class="Essentials_product cattag_pro-btn">Essentials Items</span>
					<?php } ?>

					

					<?php

					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 *
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );

					?>
					</span>
					<span class="qodef-hover-image">
					 
					<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked suprema_qodef_woocommerce_shop_loop_hover_image - 10
					 *
					 */
					do_action('suprema_qodef_woocommerce_shop_loop_item_hover_image');

					?>
					</span>
					<?php

					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 15
					 *
					 */

					do_action('suprema_qodef_woocommerce_shop_loop_item_hover_link_close')

					?>

				<div class="qodef-product-standard-button-holder">
					<?php do_action('suprema_qodef_woocommerce_shop_loop_product_simple_button'); ?>
				</div>
			</div>
			<div class="qodef-product-standard-info-top">
				<?php

				/**
				 * suprema_qodef_woocommerce_shop_loop_item_categories hook.
				 *
				 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
				 *
				 */
				do_action( 'suprema_qodef_woocommerce_shop_loop_item_categories' );

				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 5
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_price - 10
				 * @hooked suprema_qodef_woocommrece_template_loop_wishlist - 15
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
			<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
			 * @hooked woocommerce_template_loop_add_to_cart - 10 - REMOVED			 *
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</li>
	<?php
	break;
	case 'simple': ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-simple-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );

				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked woocommerce_template_loop_product_link_close - 15
				 *
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				<div class="qodef-product-simple-overlay">
					<div class="qodef-product-simple-overlay-outer">
						<div class="qodef-product-simple-overlay-inner">
							<?php
							/**
							 * woocommerce_link_overlay hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 5
							 * @hooked woocommerce_template_loop_product_link_close - 10
							 */
							do_action( 'woocommerce_link_overlay');
							/**
							 * woocommerce_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 5
							 * @hooked woocommerce_template_loop_product_title - 10
							 */
							do_action( 'woocommerce_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
							 * @hooked woocommerce_template_loop_product_link_close - 5
							 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
							 * @hooked woocommerce_template_loop_add_to_cart - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item' );
							?>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php
	break;
	case 'boxed': ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-boxed-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );

				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked woocommerce_template_loop_product_link_close - 15
				 *
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				<div class="qodef-product-boxed-overlay">
					<div class="qodef-product-boxed-overlay-outer">
						<div class="qodef-product-boxed-overlay-inner">
							<?php
							/**
							 * woocommerce_link_overlay hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 5
							 * @hooked woocommerce_template_loop_product_link_close - 10
							 */
							do_action( 'woocommerce_link_overlay');

							/**
							 * woocommerce_shop_loop_item_title hook.
							 *
							 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
							 * @hooked woocommerce_template_loop_product_link_open - 10
							 * @hooked woocommerce_template_loop_product_title - 15
							 */
							do_action( 'woocommerce_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
							 * @hooked woocommerce_template_loop_product_link_close - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
							 * @hooked woocommerce_template_loop_add_to_cart - 10 - REMOVED
							 */
							do_action( 'woocommerce_after_shop_loop_item' );
							?>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php
	break;
	default: ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-standard-image-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );

				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked woocommerce_template_loop_product_link_close - 15
				 *
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>

				<div class="qodef-product-standard-button-holder">
					<?php
					do_action('suprema_qodef_woocommerce_shop_loop_product_simple_button');
					?>
				</div>
			</div>
			<div class="qodef-product-standard-info-top">
				<?php

				/**
				 * suprema_qodef_woocommerce_shop_loop_item_categories hook.
				 *
				 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
				 *
				 */
				do_action( 'suprema_qodef_woocommerce_shop_loop_item_categories' );

				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 5
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
			<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
			 * @hooked woocommerce_template_loop_add_to_cart - 10 - REMOVED			 *
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</li>
<?php } ?>