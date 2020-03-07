<?php 
include($app_key.'/admin/model/LinkShare.php');
$link = LinkShare::where(0,1,null,'first',['urlcode'=>$hash]);
$props = $link['shared_props'];
if(strpos($props,'seller')===0){
	include($app_key.'/model/Seller.php');
	$result = Seller::where(null,null,null,null,[['id','in',explode(',',str_replace('seller','',$props))]]);
}else{
	include($app_key.'/model/Buyer.php');
	$result = Buyer::where(null,null,null,null,[['id','in',explode(',',str_replace('buyer','',$props))]]);
}
$hide_buttons = true;
?>

<?php 
if(strpos($props,'seller')===0){
	include($app_key.'/view/seller_props.php');
}else{
	include($app_key.'/view/buyer_props.php');
}
?>