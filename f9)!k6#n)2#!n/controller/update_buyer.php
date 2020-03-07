<?php 
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
// include($app_key.'/model/Buyer.php');
$_POST['accept_terms'] = $_POST['accept_terms']=='on'?1:0;
$_POST['property_type'] = isset($_POST['property_type']) ? $_POST['property_type'] : null ;
if(empty($_POST['view_rand'])){
	include($app_key.'/controller/create_form_id.php');
	$_POST['id'] = $id;
}else{
	include($app_key.'/model/Buyer.php');
}
if($_POST['submit'] == 'Final Submit'){
	$varr =[
		'date'=>'required',
		'name'=>'required',
		'phone_no'=>'required',
		'whats_app_no'=>'required',
		'your_location'=>'required',
		'address'=>'required',
		'pin'=>'required',
		'dimension'=>'required',
	];
	if(in_array($_POST['property_category'],['House','Flats','Independent House','Form House','Villas'])){
		unset($varr['dimension']);
	}
	Buyer::validate($varr);
	Buyer::update();
	$result = [Buyer::find()];
	$msg1 = "Please check back your information! We will get back to you soon.";
	if(empty($_POST['view_rand'])){
		$edit_link = $app_url."/edit_buyer/".$_POST['id'].'?view_rand='.$view_rand;
	}else{
		$edit_link = $app_url."/edit_buyer/".$_POST['id'].'?view_rand='.$_POST['view_rand'];
	}
	include($app_key.'/view/buyer_props.php');
}else{
	// print_r($_POST);exit;
	Buyer::update();
	$_SESSION['message'] = "Data saved in our database! feel free to change any value and re-submit";
	if(empty($_POST['view_rand'])){
		header("Location: ".$app_url."/edit_".$_POST['page']."/".$id.'?view_rand='.$view_rand);
	}else{
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}
?>