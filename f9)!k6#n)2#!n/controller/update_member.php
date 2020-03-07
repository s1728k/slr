<?php 
// include($app_key.'/model/Member.php');
$_POST['accept_terms'] = $_POST['accept_terms']=='on'?1:0;
if(empty($_POST['view_rand'])){
	include($app_key.'/controller/create_member_id.php');
	$_POST['id'] = $id;
}else{
	include($app_key.'/model/Member.php');
}
if($_POST['submit'] == 'Final Submit'){
	$varr =[
		'date'=>'required',
		'name'=>'required',
		'phone_no'=>'required',
		'whats_app_no'=>'required',
		'address'=>'required',
		'member_type'=>'required',
		'property_category'=>'required',
	];
	Member::validate($varr);
	Member::update();
	$row = Member::find();
	$msg1 = "Please check back your information! We will get back to you soon.";
	if(empty($_POST['view_rand'])){
		$edit_link = $app_url."/edit_member/".$_POST['id'].'?view_rand='.$view_rand;
	}else{
		$edit_link = $app_url."/edit_member/".$_POST['id'].'?view_rand='.$_POST['view_rand'];
	}
	include($app_key.'/view/member_ack.php');
}else{
	Member::update();
	$_SESSION['message'] = "Data saved in our database! feel free to change any value and re-submit";
	if(empty($_POST['view_rand'])){
		header("Location: ".$app_url."/edit_member/".$id.'?view_rand='.$view_rand);
	}else{
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}
?>