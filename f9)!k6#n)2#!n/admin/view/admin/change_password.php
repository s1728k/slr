<?php include($app_key.'/include/csrf_token.php'); ?>
<?php 
require('env.php');
$message = $_SESSION['message'];
unset($_SESSION['message']);
if(isset($_SESSION['old'])){
	$row = $_SESSION['old'];
	unset($_SESSION['old']);
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php $active="change_password"; include($app_key.'/admin/view/layouts/styles.html') ?>
</head>
<body>
<?php include($app_key.'/admin/view/layouts/nav.php') ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" action="/admin/change_password" class="box_form">
				<input type="hidden" name="_token" value="<?php echo $rand ?>">
				<input type="hidden" name="id" value="<?php echo $_SESSION[$app_key]['id'] ?>">
				<div class="row form_heading">
					<div class="col-md-12">
						<h3>Change Password</h3>
					</div>
				</div><br>
				<div class="row">
						<div class="col-md-12">
							<?php echo $message?'<div class="well">'.$message.'</div>':'' ?>
						</div>
					</div>
				<div class="row">
					<div class="col-md-5">
						<label>Admin Email</label>
					</div>
					<div class="col-md-7">
						<div class="well"><?php echo $_SESSION[$app_key]['email'] ?></div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>New Password</label>
					</div>
					<div class="col-md-7">
						<input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>">
						<span class="error"><?php echo $error['password']; ?></span>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Confirm Password</label>
					</div>
					<div class="col-md-7">
						<input type="password" name="password_confirmation" class="form-control" value="<?php echo $row['password_confirmation']; ?>">
						<span class="error"><?php echo $error['password_confirmation']; ?></span>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
					</div>
					<div class="col-md-7">
						<input type="submit" class="btn btn-primary">
					</div>
				</div><br>
			</form>
		</div>
	</div>
</div>
</body>
</html>