<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	
?>

<li <?php wc_product_cat_class( 'sub_cat_product', $category ); ?>>


	<?php
		//echo "<pre>";print_r("test");exit();
		//echo "<pre>";print_r($category);exit();
	/**
	 * The woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * The woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * The woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * The woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );

	/**
	 * The woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category );
	
	?>

	
        <ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'product_cat' => $category->slug, 'orderby' => 'rand' );
        $loop = new WP_Query( $args ); ?>
        
       <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>


                <li <?php wc_product_class( '', $product ); ?>>    
                	<div class="qodef-product-standard-image-holder">
	                    <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

	                        <?php woocommerce_show_product_sale_flash( $post, $product ); ?>	

	                        <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

	                                            

	                    </a>
                        <div class="qodef-product-standard-button-holder">
                            <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                        </div>
                	</div>
                    <div class="title_price">
                        <h3><?php the_title(); ?> test</h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                	

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>
</li>
