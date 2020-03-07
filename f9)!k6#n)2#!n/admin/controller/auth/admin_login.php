<?php
$_SESSION[$_SERVER['HTTP_REFERER'].'_rand']="";
include($app_key.'/admin/model/Admin.php');
Admin::validate([
    'password'=>'required',
    'email'=>'required|email',
]);
$result = Admin::where(0,1,null,'first',[
    'email'=>$_POST['email'],
]);

if(!$result){
    $error['message'] = "Email did not match";
}elseif(!password_verify($_POST['password'], $result['password'])){
    $error['message'] = "Password did not match";
}else{
    $_SESSION[$app_key] = $result;
    header("Location: $app_url/admin/home");
    die();
}
$_SESSION['error'] = $error;
$_SESSION['old'] = Admin::old();
header("Location: ".$_SERVER['HTTP_REFERER']);
?>