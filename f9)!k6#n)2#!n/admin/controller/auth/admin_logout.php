<?php
include($app_key.'/admin/model/Admin.php');
$result = Admin::find($_SESSION[$app_key]["id"]);
unset($_SESSION[$app_key]);
header("Location: $app_url/admin");
?>