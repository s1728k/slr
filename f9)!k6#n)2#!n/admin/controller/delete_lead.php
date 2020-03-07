<?php
if($_POST['table']=='seller'){
	include($app_key.'/model/Seller.php');
	$files = json_decode(Seller::find(null,null,'file_paths'), true);
	foreach ($files as $file) {
		if(unlink($_SERVER['DOCUMENT_ROOT'].$file)){
			// echo "success";
		}else{
			// echo "failed";
		}
	}
	Seller::destroy();
}elseif($_POST['table']=='buyer'){
	include($app_key.'/model/Buyer.php');
	Buyer::destroy();
}if($_POST['table']=='member'){
	include($app_key.'/model/Member.php');
	Member::destroy();
}
?>