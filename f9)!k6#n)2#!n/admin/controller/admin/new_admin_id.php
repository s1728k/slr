<?php
include($app_key.'/admin/model/Admin.php');
echo Admin::create(null,[
	'name' => 'New Admin',
	'password' => password_hash("adminuser@123", PASSWORD_DEFAULT),
]);
?>