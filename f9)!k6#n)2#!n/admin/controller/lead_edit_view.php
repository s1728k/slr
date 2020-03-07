<?php include($app_key.'/include/csrf_token.php'); ?>
<?php
if(isset($_SESSION['old'])){
	$row = $_SESSION['old'];
	unset($_SESSION['old']);
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}else{
	if($table == 'seller'){
		include($app_key.'/model/Seller.php');
		$row = Seller::find($id, $_SESSION['admin_role'].'_view');
	}else{
		include($app_key.'/model/Buyer.php');
		$row = Buyer::find($id, $_SESSION['admin_role'].'_view');
	}
}
$message = $_SESSION['message'];
unset($_SESSION['message']);
// print_r($row);exit;
?>

<?php 
if($table == 'seller'){
	include($app_key.'/admin/view/seller_lead_edit_view.php'); 
}else{
	include($app_key.'/admin/view/buyer_lead_edit_view.php'); 
}
?>