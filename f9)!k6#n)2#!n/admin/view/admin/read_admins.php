<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html') ?>
</head>
<body>
<?php $active = 'admins'; include($app_key.'/admin/view/layouts/nav.php') ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h3>Admin Users</h3>
		</div>
		<div class="col-md-4">
			<form id="sform" method="get" action="/admin/admins">
			    <input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
			</form>
		</div>
		<div class="col-md-4 col-xs-6 text-right">
			<a class="btn btn-primary" onclick="createNewAdmin()">Add Admin</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Role</th>
						<th>Created At</th>
						<th>Updated At</th>
						<?php if($_SESSION[$app_key]['role']=='Admin'): ?>
						<th colspan="3">actions</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo $row['role']; ?></td>
						<td><?php echo $row['created_at']; ?></td>
						<td><?php echo $row['updated_at']; ?></td>
						<?php if($_SESSION[$app_key]['role']=='Admin'): ?>
						<td><a onclick="resetPassword(<?php echo $row['id']; ?>)" style="cursor:pointer;">reset password</a></td>
						<td><a href='/admin/edit_admin/<?php echo $row['id']; ?>'>edit</a></td>
						<td><a onclick="deleteAdmin(<?php echo $row['id']; ?>)" style="cursor:pointer;">delete</a></td>
						<?php endif; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<?php include($app_key.'/admin/view/layouts/admin_pagination.php') ?>
		</div>
	</div>
</div>
<script>
	function createNewAdmin(){
		$.post('/admin/create_admin_id',{'_token':'<?php echo $rand ?>'},function(data, status){
			if(status=='success'){
				window.location =  "<?php $app_url??'' ?>" + "/admin/edit_admin/"+data;
			}
		});
	}
	function deleteAdmin(id){
		$.post('/admin/delete_admin',{'_token':'<?php echo $rand ?>','id':id},function(data, status){
			if(status=='success'){
				window.location =  "<?php $app_url??'' ?>" + "/admin/admins";
			}
		});
	}
	function resetPassword(id){
		$.post('/admin/reset_password',{'_token':'<?php echo $rand ?>','id':id},function(data, status){
			if(status=='success'){
				alert('password is reset to adminuser@123');
			}
		});
	}
	$(".sc").on('change',function(){
		$("#sform").submit();
	});
</script>
</body>
</html>