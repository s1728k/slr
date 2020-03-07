<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/admin/model/Admin.php');

if(isset($_SESSION['old'])){
	$row = $_SESSION['old'];
	unset($_SESSION['old']);
	$error = $_SESSION['error'];
	unset($_SESSION['error']);

    $row['avatar'] = Admin::find($_SESSION[$app_key]['id'],null, 'avatar');
}else{
    $row = Admin::find($_SESSION[$app_key]['id']);
}
$message = $_SESSION['message'];
unset($_SESSION['message']);
?>

<?php include($app_key.'/admin/view/admin/my_profile_view.php'); ?>