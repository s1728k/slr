<?php 
include($app_key.'/admin/model/Admin.php');
if($_POST['id']!=1){
	Admin::update(null,null,[$_POST['name']=>$_POST['opr']=='1'?1:0]);
}
?>