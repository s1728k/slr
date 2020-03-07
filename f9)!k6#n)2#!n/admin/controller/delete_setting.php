<?php
include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$sm = json_decode($setting[$_POST['setting']],true);
if($_POST['setting']=="messages"){
	unset($sm[$_POST['name']]);
}else{
	array_splice($sm,array_search($_POST['name'],$sm),1);
}
Setting::update(1,null,[$_POST['setting'] => json_encode($sm)]);
echo 'success';
?>