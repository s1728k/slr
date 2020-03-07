<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
</head>
<body>
<?php $active = 'client_meetings'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3>Client Meetings <span style="font-size: 12px"><?php echo "(".$total_records.")"; ?></span></h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home">Home</a></li>
				<li class="active">Client Meetings</li>        
			</ol>
		</div>
	</div>
	<div class="row">
		<form id="sform" method="get" action="/admin/client_meetings">
		<div class="col-md-4">
			<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
		</div>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Lead Cat</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Whatsup</th>
						<th>Address</th>
						<th>Followup Date</th>
						<th colspan="3">actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['lead_cat']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['phone_no']; ?></td>
						<td><?php echo $row['whats_app_no']; ?></td>
						<td><?php echo $row['address']; ?>, PIN: <?php echo $row['pin']; ?></td>
						<td><?php echo $row['status_date']; ?></td>
						<td><a href='/admin/lead_view/<?php echo $row['lead_cat']; ?>/<?php echo $row['id']; ?>?back=<?php echo str_replace('&','%26',$_SERVER['REQUEST_URI']); ?>'>View</a></td>
						<td><a onclick="moveToCompletedClients('<?php echo $row['lead_cat']; ?>',<?php echo $row['id']; ?>)" style="cursor:pointer;">Move To Completed Clients</a></td>
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
	$(".sc").on('change',function(){
		$("#sform").submit();
	});
	function moveToCompletedClients(cat,id){
		$.post('/admin/move_to_completed_clients',{'_token':'<?php echo $rand; ?>','cat':cat,'id':id},function(data,status){
			if(status=='success'){
				window.location = window.location.href;
			}
		});
	}
</script>
</body>
</html>