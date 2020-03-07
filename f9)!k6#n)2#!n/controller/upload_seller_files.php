<?php 
// include($app_key.'/model/Seller.php');
if(empty($_POST['view_rand'])){
	include($app_key.'/controller/create_form_id.php');
	$_POST['id'] = $id;
}else{
	include($app_key.'/model/Seller.php');
}
header('Content-Type:application/json');
$new_files = Seller::upload_files();
$files = json_decode(Seller::find(null,null,'file_paths'),true)??[];
$files = array_merge($files,$new_files);
Seller::update(null,null,['file_paths' => json_encode($files)]);

include('env.php');
header("content-type:application/json");
if(empty($_POST['view_rand'])){
	echo json_encode([
		'id' => $id,
		'view_rand' => $view_rand,
		'lead_cat' => $_POST['page'],
		'lead_type' => $_POST['agent'],
	]);
}else{
	echo json_encode([
		'id' => $_POST['id'],
		'view_rand' => $_POST['view_rand'],
		'lead_cat' => $_POST['lead_cat'],
		'lead_type' => $_POST['lead_type'],
	]);
}
?>