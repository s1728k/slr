<?php
include($app_key.'/admin/model/Admin.php');
$fav = Admin::find($_SESSION[$app_key]['id'],null,'favorites');
$f = explode(',',$fav);
array_splice($f, array_search($_POST['cat'].$_POST['id'], $f),1);
if(implode(',',$f)){
	Admin::update($_SESSION[$app_key]['id'],null,['favorites'=>implode(',',$f)]);
}else{
	Admin::update($_SESSION[$app_key]['id'],null,['favorites'=>'.']);
}

echo 'success';
?>