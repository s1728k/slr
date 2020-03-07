<?php
include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$sm = json_decode($setting[$_POST['setting']],true);

if($_POST['setting']=='messages'){
	$sm[$_POST['name']] = $_POST['message'];
}else{
	$arr = explode(',',$_POST['name']);
	foreach ($arr as $value) {
		array_push($sm,trim($value));
	}
}

Setting::update(1,null,[$_POST['setting'] => json_encode($sm)]);
echo 'success';
?>