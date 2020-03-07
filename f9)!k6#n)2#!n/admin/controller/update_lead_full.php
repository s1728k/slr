<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
if($_POST['lead_cat']=='seller'){
	include($app_key.'/model/Seller.php');
	Seller::update();
}else{
	include($app_key.'/model/Buyer.php');
	Buyer::update();
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>