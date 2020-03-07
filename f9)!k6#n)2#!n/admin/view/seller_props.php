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
	<div class="row form-group">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="box_form">
				<?php 
				$pic = [];
				foreach(json_decode($row['file_paths'],true) as $k => $file_path){
					if(strpos(strtolower($file_path),'.pdf')===false){
						$pic[]=$file_path;
					}
				}
				?>
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				  	<?php foreach($pic as $k => $p): ?>
				    <li data-target="#myCarousel" data-slide-to="<?php echo $k; ?>" class="<?php echo $k==0?'active':''; ?>"></li>
					<?php endforeach; ?>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				  	<?php foreach($pic as $k => $p): ?>
				    <div class="item <?php echo $k==0?'active':''; ?>">
				      <img src="<?php echo $p; ?>" alt="Image" style="width: 100%">
				    </div>
				    <?php endforeach; ?>
				  </div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#myCarousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Seller ID</label>
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
						<?php echo $row['sr_type']; ?>
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
				<?php if($link['location_info']): ?>
				<div class="row">
					<div class="col-md-5">
						<label>Google Maps Link</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php if(empty($row['place_link'])): ?>
						<a href="https://www.google.com/maps/search/?api=1&query=<?php echo $row['latitude'].','.$row['longitude'] ?>" target="_blank">Visit Google Maps</a>
						<?php else: ?>
						<a href="<?php echo $row['place_link']; ?>" target="_blank">Visit Google Maps</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Property Address</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['address']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Landmark</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['landmark']; ?>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-md-5">
						<label>Area/Villege</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['villege']; ?>
					</div>
				</div>
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
				<?php if($row['property_category'] == 'JD OR JV Lands'): ?>
				<div class="row">
					<div class="col-md-5">
						<label>Advance</label>
					</div>
					<div class="col-md-6 well well-sm">
						<label><?php echo $row['advance']; ?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>GoodWill</label>
					</div>
					<div class="col-md-6 well well-sm">
						<label><?php echo $row['goodwill']; ?></label>
					</div>
				</div>
				<?php else: ?>
				<div class="row">
					<div class="col-md-5">
						<label>Price</label>
					</div>
					<div class="col-md-6 well well-sm">
						<label><?php echo $row['price']; ?> <?php echo $row['p_unit']; ?> <?php echo $row['p_dim']; ?></label>
					</div>
				</div>
				<?php endif; ?>
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