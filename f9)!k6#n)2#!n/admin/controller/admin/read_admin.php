<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/admin/model/Admin.php');

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(Admin::where(null,null,null,'count') / $no_of_records_per_page);

$result = Admin::where($offset, $no_of_records_per_page);
?>

<?php include($app_key.'/admin/view/admin/read_admins.php'); ?>