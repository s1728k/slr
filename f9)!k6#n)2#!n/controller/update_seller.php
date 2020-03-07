<?php 
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
// include($app_key.'/model/Seller.php');
$_POST['accept_terms'] = $_POST['accept_terms']=='on'?1:0;
$_POST['property_type'] = isset($_POST['property_type']) ? $_POST['property_type'] : null ;
if(empty($_POST['view_rand'])){
	include($app_key.'/controller/create_form_id.php');
	$_POST['id'] = $id;
}else{
	include($app_key.'/model/Seller.php');
}
if($_POST['submit'] == 'Final Submit'){
	$varr =[
		'date'=>'required',
		'name'=>'required',
		'phone_no'=>'required',
		'whats_app_no'=>'required',
		// 'file_paths'=>'required',
		'address'=>'required',
		'pin'=>'required',
		'villege'=>'required',
		'landmark'=>'required',
		'dimension'=>'required',
		'price'=>'required',
		'accept_terms'=>'required'
	];
	if(in_array($_POST['property_category'],['House','Flats','Independent House','Form House','Villas'])){
		unset($varr['dimension']);
	}
	Seller::validate($varr);
	Seller::update();
	$result = [Seller::find()];
	$msg1 = "Please check back your information! We will get back to you soon.";
	if(empty($_POST['view_rand'])){
		$edit_link = $app_url."/edit_seller/".$_POST['id'].'?view_rand='.$view_rand;
	}else{
		$edit_link = $app_url."/edit_seller/".$_POST['id'].'?view_rand='.$_POST['view_rand'];
	}
	include($app_key.'/view/seller_props.php');
}else{
	Seller::update();
	$_SESSION['message'] = "Data saved in our database! feel free to change any value and re-submit";
	if(empty($_POST['view_rand'])){
		header("Location: ".$app_url."/edit_".$_POST['page']."/".$id.'?view_rand='.$view_rand);
	}elseif(!empty($_POST['file_update'])){
		echo $app_url."/edit_".$_POST['lead_cat']."/".$_POST['id'].'?view_rand='.$_POST['view_rand'];
	}else{
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
}
?>