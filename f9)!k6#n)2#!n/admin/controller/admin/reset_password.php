<?php 
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
include($app_key.'/admin/model/Admin.php');

Admin::update(null,null,[
    'password' => password_hash('adminuser@123', PASSWORD_DEFAULT)
]);
echo "success";
?>