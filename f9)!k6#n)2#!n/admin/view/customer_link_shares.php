<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
</head>
<body>
<?php $active = 'customer_link_shares'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3>Customer Link Shares</h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home">Home</a></li>
				<li class="active">Customer Link Shares</li>        
			</ol>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-4 form-group">
			<form id="sform" method="get" action="/admin/customer_link_shares">
				<input type="hidden" name='p1' value="<?php echo $_GET['p1']; ?>" ?>
				<input type="hidden" name='p2' value="<?php echo $_GET['p2']; ?>" ?>
				<input type="hidden" name='pr' value="<?php echo $_GET['pr']; ?>" ?>
				<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
			</form>
		</div>
		<div class="col-md-4">
			
		</div>
		<div class="col-md-4 text-right">
			<!-- <button class="btn btn-primary" onclick="shareOnWhatsApp()">Share On WhatsApp</button> -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Id</th>
						<th>WhatsApp No.</th>
						<th>Shared Properties</th>
						<th>Shared To</th>
						<th colspan="3">actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($result as $row): ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['whats_app_no']; ?></td>
						<td><?php echo $row['shared_props']; ?></td>
						<td><?php echo $row['shared_to_cat']; ?><?php echo $row['shared_to_id']; ?></td>
						<td><a href='/admin/lead_view/<?php echo $row['shared_to_cat']; ?>/<?php echo $row['shared_to_id']; ?>?back=<?php echo str_replace('&','%26',$_SERVER['REQUEST_URI']); ?>'>View Customer</a></td>
						<td><a href='/admin/sp/<?php echo $row['urlcode']; ?>?back=<?php echo str_replace('&','%26',$_SERVER['REQUEST_URI']); ?>'>View Props</a></td>
						<td><a onclick="deleteLinkShare(<?php echo $row['id']; ?>)" style="cursor:pointer;">Delete</a></td>
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
	function deleteLinkShare(id){
		if(window.confirm("Are you sure you want to delete the LinkShare?")){
			$.post("admin/delete_linkshare",{"_token":"<?php echo $rand; ?>","id":id},function(data,status){
				if(status=='success'){
					window.location = window.location.href;
				}
			});
		}
	}
</script>
</body>
</html>