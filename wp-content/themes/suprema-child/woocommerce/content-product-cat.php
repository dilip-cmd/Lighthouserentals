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

<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		
		<option value="menu_order" selected="selected">Sort</option>
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<!-- <option value="<?php //echo esc_attr( $id ); ?>" <?php //selected( $orderby, $id ); ?>><?php// echo esc_html( $name ); ?></option> -->

			<?php 
				//echo "<pre>";print_r($orderby);exit();
			if ($orderby == "menu_order" || $orderby == "relevance") { ?>
				<option value="<?php echo esc_attr( $id ); ?>" ><?php echo esc_html( $name ); ?></option>
			<?php } else {  ?>				
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option> 
			<?php }
			

			?>

			
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>

<li id="<?php echo $category->slug; ?>" <?php wc_product_cat_class( 'sub_cat_product product-package-list', $category ); ?>>


	<?php
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
        $args = array(  'post_type' => 'product', 
        				'product_cat' => $category->slug, 
        				'posts_per_page' => -1, 
        				'orderby' => 'rand',
        				'meta_query' => array(
						        array(
						           'key' => 'tag_list',
						           'value' => 'Package',
						           'compare' => '!='
						        )
						     ) );
        $loop = new WP_Query( $args ); ?>



        
        
       <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

       			<?php 
       			$on_sale = "";
       			if ($product->is_on_sale() ){
       				$on_sale =  '<span class="title_tag"><span class="m-none">ONLINE ONLY</span> SALE</span>';
       			}

       			global $wp_query;
	        	if ($wp_query->query['product_cat'] == "packages") {

	        		$crms_id = get_post_meta( get_the_ID(), 'crms_id');


	        		$ID = get_the_ID();

	        		$price = get_post_meta( get_the_ID(), '_regular_price', true);
	        		if (!class_exists('get_product_detail')) {
	        			include ABSPATH . "/get_product_detail.php";
	        			
	    			}

	        		global $get_product_detail;


	        		$add_ul = '';
	        		$accitems =  $get_product_detail->getaccitems($ID);
	        		$pro_price_meta = $accitems['pro_price_meta'];

	        	}

       			



       			?>

                <li <?php wc_product_class( '', $product ); ?>>    
                	<?php echo $on_sale; ?>	
                	<div class="qodef-product-standard-image-holder">
                		<?php
		                		if ($wp_query->query['product_cat'] == "packages") {

		                		$post_slug = get_post_field( 'post_name', get_post() );

		                		?>
					            <div class='pkg-list-hov'>
					            	<a class='bdl_pkg_lnk_dtl' href='<?php echo site_url()."/product/".$post_slug; ?>'>
					   					<h4 class='pkg-list-head'>Items in package</h4>
					   					<?php echo $accitems['ul']; ?>
					   					<div class='save-per'>
					      					<div class='save-per-txt'>SAVE 20%</div>
					      						<span class='price'>
					      							<ins>
					      								<span class='woocommerce-Price-amount amount'>
					      									<bdi>
					      									<span class='woocommerce-Price-currencySymbol'>$</span><?php echo $pro_price_meta; ?>
					      									</bdi>
					      								</span>
					      							</ins>
					      						</span>
					   					</div>
					   				</a>
								</div>
								<?php
							}
						?>


                		<div class="tags">
	                		<?php
	                		global $wpdb;
							$result = $wpdb->get_results( "SELECT meta_value,post_id FROM wp_postmeta WHERE meta_key = 'tag_list' AND post_id = '".$product->get_id()."'");
							$ex_meta_value = explode(',', $result[0]->meta_value);

								$tag_data = "";
								foreach ($ex_meta_value as $key => $value) {
									if (!empty($value)) {
										$tag_data = $value;
									}
								}
								
							 if ($tag_data == "Popular") { ?>
								<span class="popular_product cattag_pro-btn">Popular</span>
							 <?php } 
							 if ($tag_data == "New") { ?>
								<span class="newarrival_product cattag_pro-btn">New Arrival</span>
							<?php  } 
							 if ($tag_data == "Exclusive") { ?>
								<span class="exclusive_product cattag_pro-btn">Exclusive to LightHouse</span>
							<?php } 
							 if ($tag_data == "Essentials") { ?>
								<span class="Essentials_product cattag_pro-btn">Essentials Items</span>
							<?php } ?>
						</div>

	                    <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

	                        <?php woocommerce_show_product_sale_flash( $post, $product ); ?>

	                        <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="300px" height="300px" />'; ?>

	                                            

	                    </a>
                        <div class="qodef-product-standard-button-holder">
                            <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                        </div>
                	</div>
                    <div class="title_price">
                        <h3><?php the_title(); ?></h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                	

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>





</li>







