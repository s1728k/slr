<?php 
$view_rand = hash('tiger128,3', rand());
include($app_key.'/model/Member.php');
if(function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}
$id = Member::create(null,[
	'view_rand' => $view_rand,
	'date'=>date('Y-m-d'),
	'member_type'=>'Agent',
	'property_category'=>'Rent',
	'accept_terms' => 1,
	'referred_by' => $_SESSION[$app_key]['id'],
	'social_media' => $_POST['social_media']??'Direct',
]);
// echo $id.'?view_rand='.$view_rand;
?>