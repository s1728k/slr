<?php include($app_key.'/include/csrf_token.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
</head>
<body style="background: url(assets/w.jpeg) no-repeat center center fixed; background-size: cover;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12" style="height:calc(100vh - 350px)">
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-8"></div>
			<div class="col-md-4">
				<form method="post" action="/admin/admin_login" class="box_form">
					<input type="hidden" name="_token" value="<?php echo $rand; ?>">
					<div class="row form_heading">
						<div class="col-md-12">
							<h3>Login</h3>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-4">
							<label>Email</label>
						</div>
						<div class="col-md-8">
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $old['email'];?>">
							<span class="error"><?php echo $error['email']; ?></span>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-4">
							<label>Password</label>
						</div>
						<div class="col-md-8">
							<input type="password" class="form-control" name="password" value="<?php echo $old['password'];?>">
							<span class="error"><?php echo $error['password']; ?></span>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-4">
						</div>
						<div class="col-md-8">
							<input type="submit" class="btn btn-primary">
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<?php echo $error['message']; ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>