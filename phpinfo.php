<?php


//$url = "https://api.current-rms.com/api/v1/products?tags=['essential','Package']";
$url = 'https://api.current-rms.com/api/v1/products?tags=["essential","Package"]&per_page=100';
$ch = curl_init( $url );
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTP_VERSION, "CURL_HTTP_VERSION_1_1");
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('X-SUBDOMAIN:savage','X-AUTH-TOKEN:9Pi5sBfxa5th1kRC_TGy','Content-Type:application/json'));
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$memresult = curl_exec($ch);
curl_close($ch);
$product_detail  = json_decode($memresult,true);

$package_detail_array = array();
foreach ($product_detail['products'] as $key => $value) {

	$package_accessories = array();
	foreach ($value['accessories'] as $key => $a_value) {
		$package_accessories[] = array('acc_id' => $a_value['id']);
	}

	$package_detail_array[] = array('package_rms_id' => $value['id'],'package_accessories' => $package_accessories);
		
}


echo "<pre>test";print_r($package_detail_array);exit();