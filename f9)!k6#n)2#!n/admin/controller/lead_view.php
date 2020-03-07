<?php include($app_key.'/include/csrf_token.php'); ?>w
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
	}elseif($table == 'buyer'){
		include($app_key.'/model/Buyer.php');
		$row = Buyer::find($id, $_SESSION['admin_role'].'_view');
	}elseif($table == 'member'){
		include($app_key.'/model/Member.php');
		$row = Member::find($id, $_SESSION['admin_role'].'_view');
	}
}
$message = $_SESSION['message'];
unset($_SESSION['message']);
// print_r($row);exit;
?>

<?php 
if($table == 'seller'){
	include($app_key.'/admin/view/seller_lead_view.php'); 
}elseif($table == 'buyer'){
	include($app_key.'/admin/view/buyer_lead_view.php'); 
}elseif($table == 'member'){
	include($app_key.'/admin/view/member_lead_view.php'); 
}
?>