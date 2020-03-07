<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
include($app_key.'/admin/model/Admin.php');
Admin::upload();
$_SESSION['admin_avatar'] = Admin::find($_SESSION['admin_id'],null,'avatar');
echo 'success';
?>