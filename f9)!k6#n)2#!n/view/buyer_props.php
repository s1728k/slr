<!DOCTYPE html>
<html>
<head>
	<?php $vname='Acknowledgement Page'; include($app_key.'/view/layouts/styles.php'); ?>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php include($app_key.'/view/layouts/form_header.php'); ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold">Address #121/2, 1st floor, BK Halli Gate Singahalli villege, Jalahobli, Bangalore Karnataka, 562149</p>
				</div>
			</div>
		</div>
	</div>
	<?php foreach($result as $k => $row): ?>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="box_form">
				<div class="row form_heading form-group">
					<div class="col-md-12 text-center">
						<h3><?php echo ucfirst($row['lead_cat']); ?> <?php echo $k+1; ?></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Buyer ID</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['id']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Property For</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['br_type']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Name</label>
					</div>
					<div class="col-xs-6">
						<label>Swastik Landsman</label>
						<!-- <label><?php echo $row['name']; ?></label> -->
					</div>
				</div>
				<?php if($link['contact_info']): ?>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Phone No.</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['phone_no']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>WhatsApp No.</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['whats_app_no']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Buyer Location</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['your_location']; ?></label>
					</div>
				</div>
				<?php if($link['location_info']): ?>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Search Location</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['address']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>PIN</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['pin']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Property Type</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['property_category']; ?> <?php echo $row['property_type']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Dimension</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['dimension']; ?> <?php echo $row['dim_unit']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Min Price</label>
					</div>
					<div class="col-xs-6">
						<!-- <label><?php if($row['min_price']>=100){
							echo $row['min_price']/100 . ' Crores';
						}else{
							echo $row['min_price'] . ' Lacks';
						} ?></label> -->
						<label><?php echo $row['min_price']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Max Price</label>
					</div>
					<div class="col-xs-6">
						<!-- <label><?php if($row['max_price']>=100){
							echo $row['max_price']/100 . ' Crores';
						}else{
							echo $row['max_price'] . ' Lacks';
						} ?></label> -->
						<label><?php echo $row['max_price']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 text-center">
						<label><u>Comments</u></label>
					</div>
					<div class="col-xs-12 text-center">
						<label style="word-break: break-all;"><?php echo nl2br($row['comments']); ?></label>
					</div>
				</div>
				<?php if($link['status_info']): ?>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Status</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['status']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<?php if($msg1): ?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success text-center"><?php echo $msg1; ?></div>
					</div>
				</div>
				<?php endif; ?>
				<?php if(!$hide_buttons): ?>
				<div class="row">
					<div class="col-md-12 text-center">
						<a class="btn btn-primary" onclick="share('<?php echo $row['lead_cat'].$row['id']; ?>')">Share on whatsapp</a>
						<a class="btn btn-primary" href="<?php echo $edit_link; ?>">Re Edit Form</a>
						<a class="btn btn-primary" onclick="copyToMembershipForm()">Become Member</a>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<script>
	function homepage(){
		window.location = "<?php echo $app_url; ?>";
	}
	function copyToMembershipForm(){
		window.open("<?php echo $app_url."/member?lead_id=".$row['id']."&lead_cat=".$row['lead_cat']; ?>",'_blank');
	}
	function share(prop){
		var whats_app_no = prompt("Enter whatsapp number - skip to select from your contacts");
		$.post('/share_customer_link',{'_token':'<?php echo $rand; ?>','whats_app_no':whats_app_no,'shared_props':prop},function(data,status){
			if(status=='success'){
				window.open('whatsapp://send?phone='+whats_app_no+'&text='+window.encodeURIComponent(data));
			}
		});
	}
</script>
</body>
</html>