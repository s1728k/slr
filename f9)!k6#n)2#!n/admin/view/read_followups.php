<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
</head>
<body>
<?php $active = 'followups'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3>Follow Ups <span style="font-size: 12px"><?php echo "(".$total_records.")"; ?></span></h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home">Home</a></li>
				<li class="active">Follow Ups</li>        
			</ol>
		</div> 
	</div>
	<div class="row">
		<form id="sform" method="get" action="/admin/followups">
		<div class="col-md-4">
			<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
		</div>
		</form>
		<div class="col-md-8 text-right">
			<button class="btn btn-primary" onclick="showWsdialog()">Share On WhatsApp</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th></th>
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
						<td><input type="checkbox" class="sws" id="<?php echo $row['lead_cat'];echo $row['id']; ?>"></td>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['lead_cat']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['phone_no']; ?></td>
						<td><?php echo $row['whats_app_no']; ?></td>
						<td><?php echo $row['address']; ?>, PIN: <?php echo $row['pin']; ?></td>
						<td><?php echo $row['status_date']; ?></td>
						<td><a href='/admin/lead_view/<?php echo $row['lead_cat']; ?>/<?php echo $row['id']; ?>?back=<?php echo str_replace('&','%26',$_SERVER['REQUEST_URI']); ?>'>View</a></td>
						<td><a onclick="moveToClientMeeting('<?php echo $row['lead_cat']; ?>',<?php echo $row['id']; ?>)" style="cursor:pointer;">Move To Client Meeting</a></td>
						<td><a onclick="addToFavorite('<?php echo $row['lead_cat']; ?>',<?php echo $row['id']; ?>)" style="cursor:pointer;">Favorite</a></td>
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
	function moveToClientMeeting(cat,id){
		$.post('/admin/move_to_client_meeting',{'_token':'<?php echo $rand; ?>','cat':cat,'id':id},function(data,status){
			if(status=='success'){
				window.location = window.location.href;
			}
		});
	}
	function addToFavorite(cat,id){
		$.post('/admin/add_to_favorites',{'_token':'<?php echo $rand; ?>','cat':cat,'id':id},function(data,status){
			if(status=='success'){
				window.location = window.location.href;
			}
		});
	}
	function showWsdialog(){
		$("#contact_info").prop('checked',false);
		$("#location_info").prop('checked',false);
		$("#status_info").prop('checked',false);
		$("#wsdialog").modal();
	}
	function shareOnWhatsApp(){
		var sws = [];
		$( ".sws" ).each(function() {
			if($(this).prop('checked')){
				sws.push($(this).attr("id"));
			}
		});

		var whats_app_no = $("#whats_app_no").val();
		var message = $("#m1").val();
		var contact_info = $("#contact_info").prop('checked')?1:0;
		var location_info = $("#location_info").prop('checked')?1:0;
		var status_info = $("#status_info").prop('checked')?1:0;

		$.post('/admin/share_customer_link',{'_token':'<?php echo $rand; ?>','whats_app_no':whats_app_no,'message':message,'contact_info':contact_info,'location_info':location_info,'status_info':status_info,'shared_props':sws.join(',')},function(data,status){
			if(status=='success'){
				window.open('whatsapp://send?phone='+whats_app_no+'&text='+window.encodeURIComponent(data));
			}
		});
	}
</script>

<div id="wsdialog" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content" style="border-radius: 0px;">
    	<div method="post" action="/admin/share_customer_link" class="box_form">
			<input type="hidden" name="_token" value="<?php echo $rand ?>">
			<input type="hidden" name="shared_props" id="shared_props">
			<div class="row form_heading">
				<div class="col-md-12">
					<h3>WhatsApp Share</h3>
				</div>
			</div><br>
			<div class="row form-group">
				<div class="col-md-12">
					<label>WhatsApp Number</label>
					<input type="number" class="form-control" id="whats_app_no" />
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<label>Message</label>
					<select class="form-control" id="m1">
						<?php foreach($msg as $m => $ms): ?>
						<option><?php echo $m; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<label style="font-weight: normal"><input type="checkbox" id="contact_info"> Include Contact Information</label><br>
					<label style="font-weight: normal"><input type="checkbox" id="location_info"> Include Location Information</label><br>
					<label style="font-weight: normal"><input type="checkbox" id="status_info"> Include Status Information</label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" data-dismiss="modal" class="btn btn-primary" onclick="shareOnWhatsApp()">
				</div>
			</div>
		</div>
    </div>

  </div>
</div>
</body>
</html>