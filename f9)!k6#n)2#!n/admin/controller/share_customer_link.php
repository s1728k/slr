<?php
include($app_key.'/admin/model/LinkShare.php');
// LinkShare::validate([
// 	'whats_app_no'=>'required',
// 	'shared_props'=>'required',
// ]);

include($app_key.'/model/Seller.php');
include($app_key.'/model/Buyer.php');
include($app_key.'/model/Member.php');
$result = Seller::where(0,1,null,'first',['whats_app_no'=>$_POST['whats_app_no']]);
if(!$result){
	$result = Buyer::where(0,1,null,'first',['whats_app_no'=>$_POST['whats_app_no']]);
}
if(!$result){
	$result = Member::where(0,1,null,'first',['whats_app_no'=>$_POST['whats_app_no']]);
	$result['lead_cat'] = "Member";
}
$urlcode = hash('ripemd256',rand());
$id = LinkShare::create(null,[
	'shared_props' => $_POST['shared_props'],
	'shared_to_id' => $result['id'],
	'shared_to_cat' => $result['lead_cat'],
	'urlcode' => $urlcode,
	'category' => empty($_POST['message']) ? 'Customer' : 'Employee',
	'whats_app_no' => $_POST['whats_app_no'],
	'contact_info' => $_POST['contact_info'],
	'location_info' => $_POST['location_info'],
	'status_info' => $_POST['status_info'],
]);
$first_prop = explode(',',$_POST['shared_props']);
if(strpos($first_prop[0],'seller')===0){
$lead = Seller::find(str_replace('seller','',$first_prop[0]));
}elseif(strpos($first_prop[0],'buyer')===0){
$lead = Buyer::find(str_replace('buyer','',$first_prop[0]));
}elseif(strpos($first_prop[0],'member')===0){
$lead = Member::find(str_replace('member','',$first_prop[0]));
}

include('env.php');
include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$msg = json_decode($setting['messages'],true);
if(empty($_POST['message'])){
	$_POST['message'] = '_common_message';
}
echo str_replace(['{{area}}','{{prop}}','{{dim}}','{{link}}'],[$lead['villege']??$lead['address'],$lead['property_category'].' '.$lead['property_type'],$lead['dimension'].' '.$lead['dim_unit'],$app_url.'/sp/'.$urlcode],$msg[$_POST['message']]);
?>
