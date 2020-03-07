<?php
include($app_key.'/admin/model/Admin.php');
$fav = Admin::find($_SESSION[$app_key]['id'],null,'favorites');
$f = explode(',',$fav);
array_push($f, $_POST['cat'].$_POST['id']);
Admin::update($_SESSION[$app_key]['id'],null,['favorites'=>implode(',',$f)]);

echo 'success';
?>