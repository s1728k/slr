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
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-primary" href="<?php echo $_GET['back']; ?>">Back</a>
		</div>
	</div>
	<hr>
	<?php foreach($result as $row): ?>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="box_form">
				<div class="row form_heading form-group">
					<div class="col-md-12">
						<h3><?php echo ucfirst($row['lead_cat']); ?></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Buyer ID</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['id']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Property For</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['br_type']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Name</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['name']; ?>
					</div>
				</div>
				<?php if($link['contact_info']): ?>
				<div class="row">
					<div class="col-md-5">
						<label>Phone No.</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['phone_no']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>WhatsApp No.</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['whats_app_no']; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-md-5">
						<label>Buyer Location</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['your_location']; ?>
					</div>
				</div>
				<?php if($link['location_info']): ?>
				<div class="row">
					<div class="col-md-5">
						<label>Search Location</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['address']; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-md-5">
						<label>PIN</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['pin']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Property Type</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['property_category']; ?> <?php echo $row['property_type']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Dimension</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['dimension']; ?> <?php echo $row['dim_unit']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Min Price</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php if($row['min_price']>=100){
							echo $row['min_price']/100 . ' Crores';
						}else{
							echo $row['min_price'] . ' Lacks';
						} ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Max Price</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php if($row['max_price']>=100){
							echo $row['max_price']/100 . ' Crores';
						}else{
							echo $row['max_price'] . ' Lacks';
						} ?>
					</div>
				</div>
				<?php if($link['status_info']): ?>
				<div class="row">
					<div class="col-md-5">
						<label>Status</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['status']; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
</body>
</html>