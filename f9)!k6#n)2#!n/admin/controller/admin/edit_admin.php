<?php include($app_key.'/include/csrf_token.php'); ?>

<?php
include($app_key.'/admin/model/Admin.php');

if(isset($_SESSION['old'])){
	$row = $_SESSION['old'];
	unset($_SESSION['old']);
	$error = $_SESSION['error'];
	unset($_SESSION['error']);

    $row['avatar'] = Admin::find($id,null,'avatar');
}else{
	$row = Admin::find($id);
}
$message = $_SESSION['message'];
unset($_SESSION['message']);
?>

<?php include($app_key.'/admin/view/admin/edit_admin_view.php'); ?>