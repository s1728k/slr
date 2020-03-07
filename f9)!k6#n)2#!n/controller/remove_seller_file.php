<?php 
include($app_key.'/model/Seller.php');
header('Content-Type:application/json');
$files = json_decode(Seller::find(null,null,'file_paths'),true)??[];
if (!unlink($_SERVER['DOCUMENT_ROOT'].$files[$_POST['index']])) {
  // echo ("Error deleting file");
} else {
  // echo ("Deleted file");
}
array_splice($files,$_POST['index'],1);
Seller::update(null,null,['file_paths' => json_encode($files)]);
echo 'success';
?>