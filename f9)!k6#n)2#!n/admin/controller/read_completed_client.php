<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/model/Seller.php');

$filter = ['status' => 'Completed Client'];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_records = Seller::where(null,null,'visibles','union:buyer|count',$filter);
$total_pages = ceil($total_records / $no_of_records_per_page);

$result = Seller::where($offset, $no_of_records_per_page,'visibles','union:buyer|asdf',$filter);
?>

<?php include($app_key.'/admin/view/read_completed_clients.php'); ?>