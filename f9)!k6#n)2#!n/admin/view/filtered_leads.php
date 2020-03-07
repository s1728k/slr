<?php 
include('env.php'); 
$sc = "sterm=".$_GET['sterm']."&cid=".$_GET['cid']."&social_media=".$_GET['social_media'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
</head>
<body>
<?php $active = 'dashboard'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3><?php echo $_GET['p3']; ?> <span style="font-size: 12px"><?php echo "(".$total_records.")"; ?></span></h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home?<?php echo $sc; ?>">Home</a></li>
				<li><a href="/admin/home?<?php echo $sc; ?>">Dashboard</a></li>
				<li><a href="/admin/level1?p1=<?php echo $_GET['p1']; ?>&<?php echo $sc; ?>"><?php echo $_GET['p1']; ?></a></li>
				<?php if($_GET['p2']): ?>
				<li><a href="/admin/level2?p1=<?php echo $_GET['p1']; ?>&p2=<?php echo $_GET['p2']; ?>&<?php echo $sc; ?>"><?php echo $_GET['p2']; ?></a></li>
				<?php endif; ?>
				<li class="active"><?php echo $_GET['p3']; ?></li>
			</ol>
		</div>
	</div><hr>
	<div class="row">
		<div class="col-md-4 form-group">
			<form id="sform" method="get" action="/admin/filtered_leads">
				<input type="hidden" name='p1' value="<?php echo $_GET['p1']; ?>" ?>
				<input type="hidden" name='p2' value="<?php echo $_GET['p2']; ?>" ?>
				<input type="hidden" name='p3' value="<?php echo $_GET['p3']; ?>" ?>
				<input type="hidden" name='cid' value="<?php echo $_GET['cid']; ?>" ?>
				<input type="hidden" name='social_media' value="<?php echo $_GET['social_media']; ?>" ?>
				<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
			</form>
		</div>
		<div class="col-md-4">
			
		</div>
		<div class="col-md-4 form-group text-right">
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
						<th>Date</th>
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
						<td><input type="checkbox" class="sws" id="<?php echo $row['lead_cat'];echo $row['id']; ?>"></td>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['date']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['phone_no']; ?></td>
						<td><?php echo $row['whats_app_no']; ?></td>
						<td><?php echo $row['address']; ?>, PIN: <?php echo $row['pin']; ?></td>
						<td><a onclick="showWselink('<?php echo $row['whats_app_no']; ?>','<?php echo $row['lead_cat']; ?>',<?php echo $row['id']; ?>,'<?php echo $row['view_rand']; ?>')" style="cursor:pointer;" ><i class="fa fa-external-link"></i></a></td>
						<td><a href='/admin/lead_view/<?php echo $row['lead_cat']??'member'; ?>/<?php echo $row['id']; ?>?back=<?php echo str_replace('&','%26',$_SERVER['REQUEST_URI']); ?>'><i class="fa fa-eye"></i></a></td>
						<td><a onclick="deleteLead('<?php echo $row['lead_cat']; ?>',<?php echo $row['id']; ?>)" style="cursor:pointer;"><i class="fa fa-trash"></i></a></td>
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
	var sbm; var id; var vr;
	function showWselink(wn,sbm,id,vr){
		this.sbm = sbm;
		this.id = id;
		this.vr = vr;
		$("#whats_app_no2").val(wn);
		$("#wselink").modal();
	}
	function sendLinkOnWhatsApp(){
		var whats_app_no = $("#whats_app_no2").val();
		var whatsappmessage = '<?php echo $app_url; ?>/edit_'+sbm+'/'+id+'?view_rand='+vr;
		window.open('whatsapp://send?phone='+whats_app_no+'&text='+whatsappmessage);
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
					<input type="text" class="form-control" id="whats_app_no" />
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

<div id="wselink" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content" style="border-radius: 0px;">
    	<div method="post" action="/admin/share_customer_link" class="box_form">
			<input type="hidden" name="_token" value="<?php echo $rand ?>">
			<div class="row form_heading">
				<div class="col-md-12">
					<h3>Share Edit Link</h3>
				</div>
			</div><br>
			<div class="row form-group">
				<div class="col-md-12">
					<label>WhatsApp Number</label>
					<input type="number" class="form-control" id="whats_app_no2" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" data-dismiss="modal" class="btn btn-primary" onclick="sendLinkOnWhatsApp()">
				</div>
			</div>
		</div>
    </div>

  </div>
</div>
</body>
</html>