<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/admin/model/Admin.php');
include($app_key.'/model/Seller.php');

$fav = Admin::find($_SESSION[$app_key]['id'],null,'favorites');
$sellers = $buyers = ['asdf'];
foreach (explode(',',$fav) as $favorite) {
	if(strpos($favorite,'seller')===0){
		$sellers[]=str_replace('seller','',$favorite);
	}else{
		$buyers[]=str_replace('buyer','',$favorite);
	}
}

$filter = [
	'_UNION_' => ['seller','buyer'],
	'seller' => [['id','in',$sellers]],
	'buyer' => [['id','in',$buyers]],
];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_records = Seller::where(null,null,'visibles','_UNION_|count',$filter);
$total_pages = ceil($total_records / $no_of_records_per_page);

$result = Seller::where($offset, $no_of_records_per_page,'visibles','_UNION_',$filter);

include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$msg = json_decode($setting['messages'],true);
?>

<?php include($app_key.'/admin/view/read_favorites.php'); ?>