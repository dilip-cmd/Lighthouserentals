<?php 
/**
 * template name: HMI Product Page Template
 */
get_header();
?>
<div class="qodef-title qodef-standard-type qodef-content-left-alignment qodef-animation-no" style="height:300px;background-color:#50b3ff;" data-height="300">
        <div class="qodef-title-image"></div>
        <div class="qodef-title-holder" style="height:300px;">
            <div class="qodef-container clearfix">
                <div class="qodef-container-inner">
                    <div class="qodef-title-subtitle-holder" style="">
                        <div class="qodef-title-subtitle-holder-inner">
                        	<h1><span>HMI Lights</span></h1> 
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h2>HMI M-Series</h2>
<ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'product_cat' => 'hmi-m-series', 'orderby' => 'rand' );
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
                        <h3><?php the_title(); ?></h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                	

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>
<h2>Joker HMI</h2>
<ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'product_cat' => 'hmi-jokers', 'orderby' => 'rand' );
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
                        <h3><?php the_title(); ?></h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                    

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>
<h2>Dedo HMI</h2>
<ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'product_cat' => 'hmi-dedos', 'orderby' => 'rand' );
        $loop = new WP_Query( $args ); ?>
        
       <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>


                <li <?php wc_product_class( '', $product ); ?>>    
                    <div class="qodef-product-standard-image-holder">
                        <a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">

                            <?php 
                            if ( $product->is_on_sale() ) { ?>                  
                                <span class="title_tag"><span class="m-none">ONLINE ONLY</span> SALE</span>
                            <?php } ?>

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
<h2>HMI Economy</h2>
<ul class="products">
    <?php
        $args = array( 'post_type' => 'product', 'product_cat' => 'hmi-economy', 'orderby' => 'rand' );
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
                        <h3><?php the_title(); ?></h3>

                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                    

                </li>

    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>

<?php 
get_footer();
?>