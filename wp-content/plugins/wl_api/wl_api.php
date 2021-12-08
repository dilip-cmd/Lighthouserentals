<?php

/**
 * Plugin Name: wl api
 * Plugin URI: https://woocommerce.com/
 * Description: this is wl api plugin
 * Version: 5.0.0
 * Author: Automattic
 * Author URI: https://woocommerce.com
 * Text Domain: woocommerce
 * Domain Path: /i18n/languages/
 * Requires at least: 5.4
 * Requires PHP: 7.0
 *
 * @package WooCommerce
 */


function wl_post()
{
	$key_data = array('consumer_key' => 'ck_2143614c0353070abb347f5114e908adefeb9425', 'consumer_secret' => 'cs_b407133e32e3ed957ef67aa79b1b202b9d299b41' );
	return $key_data;
}

add_action('rest_api_init',function(){
	register_rest_route('wl/v1','post',[
		'method' => 'Get',
		'callback' => 'wl_post',
	]);
});