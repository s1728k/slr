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
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="box_form">
				<div class="row form_heading form-group">
					<div class="col-md-12 text-center">
						<h3>Membership Form</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Member ID</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['id']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>I am </label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['member_type']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Name</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['name']; ?></label>
					</div>
				</div>
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
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Email.</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['email']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>Location Area of my work</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['address']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 text-right">
						<label>I deal with</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['property_category']; ?> <?php echo $row['property_type']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success text-center"><?php echo $msg1; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<a class="btn btn-primary" href="<?php echo $edit_link; ?>">Re Edit Form</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function homepage(){
		window.location = "<?php echo $app_url; ?>";
	}
</script>
</body>
</html>