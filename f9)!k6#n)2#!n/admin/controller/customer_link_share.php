<?php include($app_key.'/include/csrf_token.php'); ?>

<?php

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

include($app_key.'/admin/model/LinkShare.php');
$filter['category'] = 'customer';
$total_pages = ceil(LinkShare::where(null,null,'visibles','count',$filter) / $no_of_records_per_page);
$result = LinkShare::where($offset, $no_of_records_per_page,'visibles',null,$filter);
?>

<?php include($app_key.'/admin/view/customer_link_shares.php'); ?>