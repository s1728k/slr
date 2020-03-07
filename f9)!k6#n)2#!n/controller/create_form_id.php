<?php 
$view_rand = hash('tiger128,3', rand());
if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
if($_POST['page']=='seller'){
	include($app_key.'/model/Seller.php');
	$id = Seller::create(null,[
		'view_rand' => $view_rand,
		'lead_cat'=>'seller',
		'lead_type'=>$_POST['agent'],
		'date'=>date('Y-m-d'),
		'sr_type' => 'sell',
		'property_category'=>'House',
		'property_type'=>'1 BHK',
		'accept_terms' => 1,
		'social_media' => $_POST['social_media']??'Direct',
	]);
}else{
	include($app_key.'/model/Buyer.php');
	$id = Buyer::create(null,[
		'view_rand' => $view_rand,
		'lead_cat'=>'buyer',
		'lead_type'=>$_POST['agent'],
		'date'=>date('Y-m-d'),
		'br_type' => 'buy',
		'property_category'=>'House',
		'property_type'=>'1 BHK',
		'accept_terms' => 1,
		'social_media' => $_POST['social_media']??'Direct',
	]);
}
if(!empty($_POST['social_media'])){
	echo $id.'?view_rand='.$view_rand;
}
?>