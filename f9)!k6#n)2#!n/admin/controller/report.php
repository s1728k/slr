<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
$_GET['lead_cat'] = $_GET['lead_cat']??'seller';
$table = ucfirst($_GET['lead_cat']);
include($app_key.'/model/'.$table.'.php');

$filter = [
	'id' => $_GET['lid'],
	'social_media' => $_GET['social_media'],
];

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_records = $table::where(null,null,'visibles','count',$filter);
$total_pages = ceil($total_records / $no_of_records_per_page);

$result = $table::where($offset, $no_of_records_per_page,'visibles',null,$filter);

include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$social_media = json_decode($setting['social_media'],true);
?>

<?php include($app_key.'/admin/view/report_view.php'); ?>