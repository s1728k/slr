<?php
if($_POST['cat']=='seller'){
	include($app_key.'/model/Seller.php');
	Seller::update(null,null,['status'=>'None']);
}else{
	include($app_key.'/model/Buyer.php');
	Buyer::update(null,null,['status'=>'None']);
}
echo 'success';
?>