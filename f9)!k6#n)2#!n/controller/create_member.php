<?php 
include($app_key.'/model/Member.php');
$_POST['accept_terms'] = $_POST['accept_terms']=='on'?1:0;
$varr =[
	'date'=>'required',
	'name'=>'required',
	'phone_no'=>'required',
	'whats_app_no'=>'required',
	'area_of_your_work'=>'required',
	'member_type'=>'required',
	'property_category'=>'required',
];
Member::validate($varr);
$_POST['view_rand'] = rand();
$id = Member::create();
$row = Member::find($id);
$msg1 = "Please check back your information! We will get back to you soon.";
include($app_key.'/view/member_ack.php');
?>