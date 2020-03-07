<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
$ca = [
	'comment' => $_POST['comments1'],
	'date' => date('Y-m-d H:i'),
	'auth' => $_SESSION[$app_key]['name'],
];
// print_r($ca);exit;
if($_POST['lead_cat']=='seller'){
	include($app_key.'/model/Seller.php');
	$comments_array = Seller::find(null,null,'comments_array');
	$cad = json_decode($comments_array,true)??[];
	array_push($cad,$ca);
	$_POST['comments_array'] = json_encode($cad);
	Seller::update();
}elseif($_POST['lead_cat']=='buyer'){
	include($app_key.'/model/Buyer.php');
	$comments_array = Buyer::find(null,null,'comments_array');
	$cad = json_decode($comments_array,true)??[];
	array_push($cad,$ca);
	$_POST['comments_array'] = json_encode($cad);
	Buyer::update();
}elseif($_POST['lead_cat']=='member'){
	include($app_key.'/model/Member.php');
	$comments_array = Member::find(null,null,'comments_array');
	$cad = json_decode($comments_array,true)??[];
	array_push($cad,$ca);
	$_POST['comments_array'] = json_encode($cad);
	Member::update();
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>