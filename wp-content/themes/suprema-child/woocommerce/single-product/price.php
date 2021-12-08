<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

		
	if (in_array('1007', $product->category_ids)) { 


		$custom_fields = get_post_meta( $product->get_ID(), 'custom_fields', true);
		$custom_field = json_decode($custom_fields);
		?>
		<div itemprop="description">
			<?php echo apply_filters( 'woocommerce_short_description', $product->get_description() ) ?>
		</div>
			<div class="price_label">
		<label>Price Per Day</label>
			
			<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>

			<?php 
					if ( $product->is_on_sale() ) { ?>
					    <span class="tag_line_for_sell">Book Online and Save <?php echo $custom_field->discount_percentage."%"; ?></span>
					<?php } ?>
			
		
	</div>
	<?php }
	

if (!in_array('1007', $product->category_ids)) { 
	if ( ! $product->get_description() ) return;
	?>
	<div itemprop="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->get_description() ) ?>
	</div>
	
	<?php 

		$custom_fields = get_post_meta( $product->get_ID(), 'custom_fields', true);
		$custom_field = json_decode($custom_fields);
	
	?>

	
	<div class="price_label">
		<label>Price Per Day</label>
			
			<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>

			<?php 
					if ( $product->is_on_sale() ) { ?>
					    <span class="tag_line_for_sell">Book Online and Save <?php echo $custom_field->discount_percentage."%"; ?></span>
					<?php } ?>
			
		
	</div>

<?php } ?>

