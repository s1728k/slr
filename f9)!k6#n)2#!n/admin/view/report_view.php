<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
</head>
<body>
<?php $active = 'report'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3>Report <span style="font-size: 12px"><?php echo "(".$total_records.")"; ?></span></h3> 
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home">Home</a></li>
				<li class="active">Report</li>        
			</ol>
		</div>
	</div>
	<div class="row">
		<form id="sform" method="get" action="/admin/report">
		<div class="col-md-3 form-group">
			<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
		</div>
		<div class="col-md-2 form-group">
			<input type="number" class="form-control sc" placeholder="Customer Id" name="lid" value="<?php echo $_GET['lid']; ?>">
		</div>
		<div class="col-md-2 form-group">
			<select class="form-control sc" name="lead_cat" value="<?php echo $_GET['lead_cat']; ?>">
				<option value="seller" <?php echo $_GET['lead_cat']=='seller'?'selected':''; ?>>Seller</option>
				<option value="buyer" <?php echo $_GET['lead_cat']=='buyer'?'selected':''; ?>>Buyer</option>
				<option value="member" <?php echo $_GET['lead_cat']=='member'?'selected':''; ?>>Member</option>
			</select>
		</div>
		<div class="col-md-2 form-group">
			<select class="form-control sc" name="social_media">
				<option value="" <?php echo $_GET['social_media']==''?'selected':''; ?>>All</option>
				<?php foreach($social_media as $sm): ?>
				<option <?php echo $_GET['social_media']==$sm?'selected':''; ?>><?php echo $sm; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		</form>
		<div class="col-md-3  form-group text-right">
			<div class="btn-group">
				<a class="btn btn-primary" onclick="downloadCSV('<?php echo $_GET['lead_cat']; ?>')">Download in CSV</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<?php if($_GET['lead_cat']=='member'): ?>
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Date</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Whatsup</th>
						<th>Email</th>
						<th>Social Media</th>
						<th>Address</th>
						<th colspan="3">actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['date']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['phone_no']; ?></td>
						<td><?php echo $row['whats_app_no']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['social_media']; ?></td>
						<td><?php echo $row['address']; ?>, PIN: <?php echo $row['pin']; ?></td>
						<td><a href='/edit_member/<?php echo $row['id']; ?>?view_rand=<?php echo $row['view_rand']; ?>' target="_blank">Edit</a></td>
						<td><a onclick="deleteLead('member',<?php echo $row['id']; ?>)" style="cursor:pointer;">Delete</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php else: ?>
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Date</th>
						<th>Type</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Whatsup</th>
						<th>Address</th>
						<th colspan="3">actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['date']; ?></td>
						<td><?php echo $row['lead_type']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['phone_no']; ?></td>
						<td><?php echo $row['whats_app_no']; ?></td>
						<td><?php echo $row['address']; ?>, PIN: <?php echo $row['pin']; ?></td>
						<td><a href='/edit_<?php echo $row['lead_cat']; ?>/<?php echo $row['id']; ?>?view_rand=<?php echo $row['view_rand']; ?>' target="_blank">Edit</a></td>
						<td><a onclick="deleteLead('<?php echo $row['lead_cat']; ?>',<?php echo $row['id']; ?>)" style="cursor:pointer;">Delete</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php endif; ?>
		</div>
		<div class="col-md-12">
			<?php include($app_key.'/admin/view/layouts/admin_pagination.php') ?>
		</div>
	</div>
</div>
<script>
	$(".sc").on('change',function(){
		$("#sform").submit();
	});
	function downloadCSV(table){
		var path = window.location.href;
		var url = '/admin/export_to_csv?lead_cat='+table;
		path = path.split('?');
		if(path.length == 2){
			url = url + "?" + path[1];
		}
		window.location = url;
	}
	function deleteLead(table,id){
		if(window.confirm("Are you sure you want to delete the lead?")){
			$.post("admin/delete_lead",{'_token':'<?php echo $rand; ?>','table':table,'id':id},function(data,status){
				if(status=='success'){
					window.location = window.location.href;
				}
			});
		}
	}
</script>
</body>
</html>