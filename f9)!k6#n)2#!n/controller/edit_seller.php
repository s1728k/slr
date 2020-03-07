<?php 
include($app_key.'/model/Seller.php');
$row = Seller::find($id);
?>
<?php 
if($row['view_rand']!=$_GET['view_rand'] || !empty($_SESSION[$app_key]) && !$_SESSION[$app_key]['p24']){
	include($app_key.'/include/404.php');
}else{
	include($app_key.'/view/seller.php');
} 
?>