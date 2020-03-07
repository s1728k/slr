<?php 
include($app_key.'/model/Member.php');
if($_POST['lead_cat']=='seller'){
	include($app_key.'/model/Seller.php');
	$row = Seller::find();
}elseif($_POST['lead_cat']=='buyer'){
	include($app_key.'/model/Buyer.php');
	$row = Buyer::find();
}
if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
$rand = rand();
$id = Member::create(null,[
	'view_rand'=>$rand,
	'social_media'=>'Direct',
	'date'=>date('Y-m-d'),
	'name'=>$row['name'],
	'phone_no'=>$row['phone_no'],
	'whats_app_no'=>$row['whats_app_no'],
	'member_type'=>'Agent',
	'property_category'=>'Rent',
	'address'=>$row['address'],
	'comments'=>$row['comments'],
	'accept_terms'=>$row['accept_terms'],
]);
echo $id.'?view_rand='.$rand;
?>