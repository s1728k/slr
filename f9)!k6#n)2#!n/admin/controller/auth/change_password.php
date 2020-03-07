<?php 
$_SESSION['rand']="";
include($app_key.'/admin/model/Admin.php');
Admin::validate([
    'password'=>'required',
    'password_confirmation'=>'password_confirmation:password',
]);
Admin::update(null,null, [
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
]);
$_SESSION['message'] = "Password changed successfully";
header("Location: ".$_SERVER['HTTP_REFERER']);
?>