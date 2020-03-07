<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html') ?>
</head>
<body>
<?php include($app_key.'/admin/view/layouts/nav.php') ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-xs-6">
			<!-- <h3>Edit Admin User</h3> -->
		</div>
		<div class="col-md-6 col-xs-6 text-right">
			<a class="btn btn-primary" href="/admin/admins">Back</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<?php echo $message?'<div class="well">'.$message.'</div>':'' ?>
					</div>
				</div>
			<form method="post" action="/admin/update_admin" class="box_form">
				<input type="hidden" name="_token" value="<?php echo $rand ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<div class="row form_heading">
					<div class="col-md-12">
						<h3>Edit Admin User</h3>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<image src="<?php echo $row['avatar']??'https://via.placeholder.com/150'; ?>" style="width: 100px;" />
					</div>
					<div class="col-md-7">
						<label class="btn btn-primary" for="avatar">Upload</label>
						<input type="file" onchange="uploadfile('avatar')" id="avatar" class="form-control" style="display: none">
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Admin Name</label>
					</div>
					<div class="col-md-7">
						<input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
						<span class="error"><?php echo $error['name']; ?></span>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Email</label>
					</div>
					<div class="col-md-7">
						<input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
						<span class="error"><?php echo $error['email']; ?></span>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Phone</label>
					</div>
					<div class="col-md-7">
						<input type="number" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
						<span class="error"><?php echo $error['phone']; ?></span>
					</div>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Role</label>
					</div>
					<div class="col-md-7">
						<select name="role" class="form-control" value="<?php echo $row['role']; ?>">
							<option <?php echo $row['role']=='Admin'?'selected':''; ?>>Admin</option>
							<option <?php echo $row['role']=='Telecaller'?'selected':''; ?>>Telecaller</option>
							<option <?php echo $row['role']=='Marketing'?'selected':''; ?>>Marketing</option>
						</select>
						<span class="error"><?php echo $error['role']; ?></span>
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
<script>
	function uploadfile(file_name){
		let photo = document.getElementById(file_name).files[0];  // file from input
		let req = new XMLHttpRequest();
		req.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      	window.location = window.location.href;
		    }
		};
		let formData = new FormData();

		formData.append("id", "<?php echo $id ?>");
		formData.append("_token", "<?php echo $rand ?>");
		formData.append("file_name",file_name);
		formData.append(file_name, photo);
		req.open("POST", '/admin/upload_admin_avatar');
		req.send(formData);
	}
</script>
</body>
</html>