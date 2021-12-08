<?php do_action('suprema_qodef_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="qodef-title <?php echo suprema_qodef_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="qodef-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
        <div class="qodef-title-holder" <?php suprema_qodef_inline_style($title_holder_height); ?>>
            <div class="qodef-container clearfix">
                <div class="qodef-container-inner">
                    <div class="qodef-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">

                        <?php 
                        $current_category_object = get_queried_object();
                   $current_cat_id = $current_category_object->name;
                    $current_cat_id = str_replace("&"," ", $current_cat_id);
                    $current_cat_id = str_replace('amp;', ' ', $current_cat_id);
                   $name = str_replace(" ","-", $current_cat_id);
                    $lower_name = strtolower($name);
                    $main_cate_slug =preg_replace('/[^A-Za-z0-9\-]/', '', $lower_name);
                    $final_main_cat_slug = str_replace("--","-", $main_cate_slug);
                    $final_main_cat_slug = str_replace("--","-", $final_main_cat_slug);
                    $final_main_cat_slug = trim($final_main_cat_slug, '-');



                   


                            $args = array(
                                'post_type'             => 'product',
                                'post_status'           => 'publish',
                                'posts_per_page'        => '-1',
                                'meta_query'            => array(
                                    array(
                                        'key'           => 'tag_list',
                                        'value'         => array('Package'),
                                        'compare'       => 'IN'
                                    )
                                ),
                                'tax_query'             => array(
                                    array(
                                        'taxonomy'      => 'product_cat',
                                        'field' => 'slug', //This is optional, as it defaults to 'term_id'
                                        'terms'         => $final_main_cat_slug,
                                        'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                    )
                                )
                            );
                            $query = new WP_Query( $args );

                            $display_or_not = "none";
                            if ($query->have_posts()) {
                                $display_or_not = "block";
                            } 
                        
                        ?>

                        <div class="qodef-title-subtitle-holder-inner">
                        <?php switch ($type){
                            case 'standard': ?>
                                <h1 <?php suprema_qodef_inline_style($title_color); ?>><span><?php suprema_qodef_title_text(); ?></span></h1>

                                <?php 
                                    $term_object = get_queried_object();
                                    if (isset($term_object->description)) { ?>
                                        <span class="qodef-subtitle"><?php echo $term_object->description; ?></span>
                                        
                                    <?php }

                                    $sub_categories = get_field('sub_categories',$term_object);
                                    if ($sub_categories) { ?>
                                        <ul class="sub_cat_banner_item sab-cat-owl-mob">
                                        <?php
                                            $sub_categories_explode = explode(",", $sub_categories); 

                                            foreach ($sub_categories_explode as $key => $explode) { 
                                                $explode = trim($explode," ");
                                                $explode_title = strtolower(str_replace(" ","-",$explode));
                                                ?>
                                                <li class="<?php echo $explode_title; ?>"><a href="javascript:void(0)"><?php echo $explode; ?></a></li>
                                            <?php } ?>
                                            <li class="packages" style="display: <?php echo $display_or_not; ?>;" ><a href="javascript:void(0)">Packages</a></li>
                                                
                                        </ul>
                                          <?php }
                                            ?>
                                   

                               
                                <?php if($has_subtitle){ ?>
                                    <span class="qodef-subtitle" <?php suprema_qodef_inline_style($subtitle_color); ?>><span><?php suprema_qodef_subtitle_text(); ?></span></span>
                                <?php } ?>
                                <?php if($enable_breadcrumbs){ ?>
                                    <div class="qodef-breadcrumbs-holder"> <?php suprema_qodef_custom_breadcrumbs(); ?></div>
                                <?php } ?>
                            <?php break;
                            case 'breadcrumb': ?>
                                <h1 <?php suprema_qodef_inline_style($title_color); ?>><span><?php suprema_qodef_title_text(); ?></span></h1>
                                <div class="qodef-breadcrumbs-holder"> <?php suprema_qodef_custom_breadcrumbs(); ?></div>
                            <?php break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php do_action('suprema_qodef_after_page_title'); ?>


<script>
    jQuery( document ).ready(function() {
        jQuery(".sub_cat_banner_item li").click(function(){
            var section_id = jQuery(this).attr("class");
                jQuery('html,body').animate({
                scrollTop: jQuery("#"+section_id).offset().top -150},
                'slow');
        })
    });

    jQuery( document ).ready(function() {
        jQuery(".sub_cat_banner_item div").click(function(){
            var section_id = jQuery(this).attr("class");
                jQuery('html,body').animate({
                scrollTop: jQuery("#"+section_id).offset().top -150},
                'slow');
        })
    });
</script>