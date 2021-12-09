<?php
	/**
	 * 
	 */
	class get_product_detail 
	{
		
		public function getaccitems($ID)
		{
		global $product,$wpdb;
        $sum_pro_price_meta = '';
        if (!empty($ID)) {
            $query = $wpdb->get_results("SELECT * FROM wp_woocommerce_bundled_items WHERE `bundle_id` LIKE '".$ID."'");
            $acc_detail_data = array();

            $pro_data_acc = array();
            $pro_price_meta = array();
            foreach ($query as $key => $pro_acc) {
            
                $post   = get_post( $pro_acc->product_id );
                $title=$post->post_title;
                $price = get_post_meta( $pro_acc->product_id, '_regular_price', true);
                $stock = get_post_meta( $pro_acc->product_id, '_stock', true );

               

                $acc_detail_data[] ='<li><span class="qty_pro">x'.round($stock,0).'</span><h6>'.$title.'</h6><span class="pkg-span-price span">$'.$price.'</span><li>';
                $pro_price_meta[] = round($price,0);


            }
               $sum_pro_price_meta = array_sum($pro_price_meta);

        }   
            $acc_detail_data = implode($acc_detail_data);


            $add_ul = "<ul class='new_ul_acc'>".$acc_detail_data."</ul>";

            return $add_ul = array('ul' => $add_ul, 'pro_price_meta' => $sum_pro_price_meta );
		}
	}

	global $get_product_detail;
	$get_product_detail = new get_product_detail();
?>