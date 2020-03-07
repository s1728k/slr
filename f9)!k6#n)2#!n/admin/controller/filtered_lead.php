<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$member_types = json_decode($setting['member_types']);

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 50;
$offset = ($pageno-1) * $no_of_records_per_page;

if(strpos($_GET['p1'],'Seller')===0){
	$sb = 'seller';
}else{
	$sb = 'buyer';
}
if(strpos($_GET['p1'],'Agent')>0){
	$ad = 'agent';
}else{
	$ad = 'direct';
}
if(strpos($_GET['p1'],'Rent')>0){
	$sr = 'rent';
}else{
	if($sb=='seller'){
		$sr = 'sell';
	}else{
		$sr = 'buy';
	}
}
$filter = [
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'lead_type'=>$ad,
	'property_category'=>$_GET['p2'],
];

if(empty($_GET['p2'])){
	$filter['property_category'] = $_GET['p3'];
}

if($_GET['p2']){
	$filter['property_type'] = $_GET['p3'];
}

if(in_array($_GET['p1'], $member_types)){
		unset($filter['lead_type']);
		$filter['member_type'] = $_GET['p1'];
		$filter['property_category'] = $_GET['p3'];
		include($app_key.'/model/Member.php');
		$total_records = Member::where(null,null,'visibles','count',$filter);
		$total_pages = ceil($total_records / $no_of_records_per_page);
		$result = Member::where($offset, $no_of_records_per_page,'visibles',null,$filter);
}else{
	if($sb=='seller'){
		$filter['sr_type'] = $sr;
		include($app_key.'/model/Seller.php');
		$total_records = Seller::where(null,null,'visibles','count',$filter);
		$total_pages = ceil($total_records / $no_of_records_per_page);
		$result = Seller::where($offset, $no_of_records_per_page,'visibles',null,$filter);
	}else{
		$filter['br_type'] = $sr;
		include($app_key.'/model/Buyer.php');
		$total_records = Buyer::where(null,null,'visibles','count',$filter);
		$total_pages = ceil($total_records / $no_of_records_per_page);
		$result = Buyer::where($offset, $no_of_records_per_page,'visibles',null,$filter);
	}
}
$msg = json_decode($setting['messages'],true);
?>

<?php include($app_key.'/admin/view/filtered_leads.php'); ?>