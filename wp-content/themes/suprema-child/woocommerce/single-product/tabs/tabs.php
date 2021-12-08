<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	//echo "<pre>";print_r("dghj");exit();
/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="qodef-tabs woocommerce-tabs wc-tabs-wrapper qodef-vertical-tab">
		<ul class="qodef-tabs-nav tabs wc-tabs" role="tablist">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>">
						<?php echo wp_kses_post(apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key )); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="qodef-tab-container woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func($product_tab['callback'],$key,$product_tab);
				}
				?>
			</div>
		<?php endforeach; ?>
		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>
<?php endif; ?>


	<?php 
	global $post, $product;
	$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );


		$tag_list = get_post_meta( get_the_ID(), 'tag_list');

		$Package = "no";
		if (in_array("Package",$tag_list)) {
			$Package = "yes";
		}
			//echo "<pre>";print_r($Package);exit();

	if (in_array('1007', $product->category_ids) || $Package == "yes") { ?>

			       		

			       		<div class="full-pkg-list">
					      <h3 class="bor-head">Full Package List</h3>
					      	<ul>
					      	<?php 	
					      			global $wpdb,$get_product_detail;
					      			$ID = $product->get_ID();


					      			if (!class_exists('get_product_detail')) {
					        			include ABSPATH . "/get_product_detail.php";
					        			
					    			}


					      			$query = $wpdb->get_results("SELECT * FROM wp_woocommerce_bundled_items WHERE `bundle_id` LIKE '".$ID."'");

					      			$accessories = array();
					      			foreach ($query as $key => $pro_acc) {

					      				


					      				$accessories_detail = get_post_meta( $pro_acc->product_id, 'accessories', true);
					      				$accessories = json_decode($accessories_detail);

					      				if (!empty($accessories)) {
					      					foreach ($accessories as $key => $acc_name) {

					      						if (!isset($acc_name->related_name)) {
					      							
					      							$result = $wpdb->get_var( "SELECT post_id FROM wp_postmeta WHERE meta_key = 'crms_id' AND meta_value = '".$acc_name->crms_id."'");

					      							echo "<li>".get_the_title($result)."</li>";
					        						


					      						}else{
					      							$name = $acc_name->related_name;
					      							echo "<li>".$name."</li>";
					      						}


					      						
					      						
					      					}
					      				}
					      					
					      			}
					      			?>

					      		



						     	
							</ul>
					   </div>

	<?php } else { ?>
		<div class="item-opt-rw">
			       			<?php 

				       			$custom_fields = get_post_meta( $post->ID, 'custom_fields', true);
				       			$custom_field = json_decode($custom_fields);

				       			if (!empty($custom_field->colour_temperature) && !empty($custom_field->power_type) && !empty($custom_field->power_input_watts) && !empty($custom_field->output_at_2m) && !empty($custom_field->output_at_5m) && !empty($custom_field->output_at_8m)) { ?>
								    <div class="col col-4 specification">
						      			<h3 class="bor-head">Specification</h3>
						       				<div class="pro-dtl-specification">
									       		<ul>

									       			<?php
									       				if (!empty($custom_field->colour_temperature)) { ?>
									       					<li>Colour Temperature <b><?php echo $custom_field->colour_temperature; ?></b></li>
									       				<?php }
									       			?>
									       			<?php
									       				if (!empty($custom_field->power_type)) { ?>
									       					<li>Power Type <b><?php echo $custom_field->power_type; ?></b></li>
									       				<?php }
									       			?>
									       			<?php
									       				if (!empty($custom_field->power_input_watts)) { ?>
									       					<li>Input Watts <b><?php echo $custom_field->power_input_watts; ?></b></li>
									       				<?php }
									       			?>
									       			<?php
									       				if (!empty($custom_field->output_at_2m)) { ?>
									       					<li>Lux at 2M <b><?php echo $custom_field->output_at_2m; ?></b></li>
									       				<?php }
									       			?>
									       			<?php
									       				if (!empty($custom_field->output_at_5m)) { ?>
									       					<li>Lux at 5M <b><?php echo $custom_field->output_at_5m; ?></b></li>
									       				<?php }
									       			?>
									       			<?php
									       				if (!empty($custom_field->output_at_8m)) { ?>
									       					<li>Lux at 8M <b><?php echo $custom_field->output_at_8m; ?></b></li>
									       				<?php }
									       			?>
												</ul>
						      	
									       </div>
									</div>
								<?php }

			       			?>
	<?php 
	$accessories = get_post_meta( $product->get_ID(), 'accessories', true);
 	$explode_acc = explode(',', $accessories);

 		$check_empty = 0;
 		foreach ($explode_acc as $key => $value) {
 			if (!empty($explode_acc[$key])) {
	            $check_empty = 1;
	        }
 		}
	?>		


	<?php 
	if ($check_empty == 1) { ?>
		<div class="col col-4 items-include">
      <h3 class="bor-head">Items Included</h3>
      	<ul>
      	<?php 
	     	foreach ($explode_acc as $explode) {
	     		
	     		$params = array('post_type' => 'product','meta_query' => array(array('key' => 'crms_id','value' => $explode,'compare' => '=',)),);
				$wc_query = new WP_Query($params);

				if( $wc_query->have_posts() ) {

			  		while( $wc_query->have_posts() ) {
				    	$wc_query->the_post(); ?>

				    	<li><?php the_title(); ?></li>
			   <?php }
			    }
	     	}
      	?>
		</ul>
   </div>
	<?php } ?>
   

	<?php 
	      $custom_fields = get_post_meta( $product->get_ID(), 'custom_fields', true);
	      $custom_field = json_decode($custom_fields);

	      	$check_in_for = 0;
	      	for ($i=1; $i <= 4; $i++) { 
				$optional_accessorys = 'optional_accessory_'.$i;
				$optional_accessory = $custom_field->$optional_accessorys;
				$params = array('post_type' => 'product','meta_query' => array(array('key' => 'crms_id','value' => $optional_accessory,'compare' => '=',)),);
				$wc_query = new WP_Query($params);

	      	if ($wc_query->have_posts() != null) { 
	      			$check_in_for = 1;
	     	} } ?>

	     	<?php 
	     	if ($check_in_for == 1) { ?>
	     		<div class="col col-4 optional-acces">
			      <h3 >Optional Accessories</h3>
			      <ul class="ass_data">

	     <?php		
	     		for ($i=1; $i <= 4; $i++) { 
				$optional_accessorys = 'optional_accessory_'.$i;
				$optional_accessory = $custom_field->$optional_accessorys;
				$params = array('post_type' => 'product','meta_query' => array(array('key' => 'crms_id','value' => $optional_accessory,'compare' => '=',)),);
				$wc_query = new WP_Query($params);
					if( $wc_query->have_posts() ) {

				  		while( $wc_query->have_posts() ) {
					    	$wc_query->the_post(); ?>

					    	<li>
								<div class="opt-data-acces-img">
									<?php echo get_the_post_thumbnail($wc_query->ID, 'yourTable'); ?>
								</div>
								<div class="opt-data-acces-title">
									<a href="<?php echo get_permalink(); ?>"> <h4><?php the_title(); ?></h4></a>
									<?php $price = get_post_meta( get_the_ID(), '_price', true ); ?>
									<p><?php echo wc_price( $price ); ?></p>
								</div>
								<!-- <a class="ass_btn" href="<?php echo $product->add_to_cart_url() ?>">+</a> -->
								<a href="<?php echo $product->add_to_cart_url() ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="add_to_cart_button ajax_add_to_cart product_type_simple ass_btn" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()) ?>">+</a>
							</li>
				   <?php }
				    }

	     		?>
	     		
	     	<?php } ?>
 	</ul>
   </div>
	     <?php } ?>
	     	

					
			
		
   </div><?php
	}
	

		




	?>
	



<?php
		
		//echo "<pre>";print_r($product->get_ID());exit();
	$custom_fields = get_post_meta( $product->get_ID(), 'custom_fields', true);
	//$custom_fields = get_post_meta( 125021, 'custom_fields', true);
	$custom_field = json_decode($custom_fields);
	

	if (!empty($custom_field->gaffer_notes) || !empty($custom_field->gaffer_tips) && !empty($custom_field->usability)){ ?>
		<div class="gaffer-notes-rw">
				<h3 class="bor-head">Gaffer Notes</h3>
			   <?php //if(get_field('gaffer_notes') != "") { ?>
			   	 <div class="gaffer-notes-in">
				   <div class="note-ul-list">
				   		<?php 
			   			if (!empty($custom_field->gaffer_notes)) { ?>
			   				<div class="warning">
							   <h6>warning</h6>
							   <ul>
							      <li><?php echo $custom_field->gaffer_notes; ?></li>
							   </ul>
							</div>
			   			<?php } ?>	   
				      	
				      	<?php 
				      	if (!empty($custom_field->gaffer_tips)) { ?>
			      		<div class="tips">
						   <h6>tips</h6>
						   <ul>
						      <li><?php echo $custom_field->gaffer_tips; ?></li>
						   </ul>
						</div>
				      	<?php } ?>
						
				   </div>
				<?php //} ?>
			   <?php 
			      if (!empty($custom_field->usability)) { ?>
				   <div class="usab-grey-box">
				      <h6>usability</h6>
				      
				      	<button class="easy use-status"><?php echo $custom_field->usability; ?></button>
				      
				   </div>
			      <?php } ?>
			</div>
		</div>
	<?php }   

?>


