<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
include($app_key.'/admin/model/Admin.php');
Admin::validate([
    'name'=>'required',
	'email'=>'required|email|unique_exists:admins',
	'phone'=>'required',
	'role'=>'required',
]);
Admin::update();
header("Location: ".$_SERVER['HTTP_REFERER']);
?>