<!DOCTYPE html>
<html>
<head>
	<?php $vname='Acknowledgement Page'; include($app_key.'/view/layouts/styles.php'); ?>
</head>
<body>
<div class="container-fluid">
	<div class="row form-group">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php include($app_key.'/view/layouts/form_header.php'); ?>
			<div class="row form-group">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold">Address #121/2, 1st floor, BK Halli Gate Singahalli villege, Jalahobli, Bangalore Karnataka, 562149</p>
				</div>
			</div>
		</div>
	</div>
	<?php foreach($result as $k => $row): ?>
	<div class="row form-group">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="box_form">
				<div class="row form_heading form-group">
					<div class="col-md-12 text-center">
						<h3><?php echo ucfirst($row['lead_cat']); ?> <?php echo $k+1; ?></h3>
					</div>
				</div>
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
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Seller ID</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['id']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Property For</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['sr_type']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Name</label>
					</div>
					<div class="col-xs-6">
						<label>Swastik Landsman</label>
						<!-- <label><?php echo $row['name']; ?></label> -->
					</div>
				</div>
				<?php if($link['contact_info']): ?>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Phone No.</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['phone_no']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>WhatsApp No.</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['whats_app_no']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<?php if($link['location_info']): ?>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Google Maps Link</label>
					</div>
					<div class="col-xs-6">
						<a href="<?php echo $row['place_link']; ?>" target="_blank">Visit Google Maps</a>
					</div>
				</div>
				<!-- <div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>GPRS Location</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['address']; ?></label>
					</div>
				</div> -->
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Landmark</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['landmark']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Area/Villege</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['villege']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>PIN</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['pin']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Property Type</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['property_category']; ?> <?php echo $row['property_type']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Dimension</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['dimension']; ?> <?php echo $row['dim_unit']; ?></label>
					</div>
				</div>
				<?php if($row['property_category'] == 'JD OR JV Lands'): ?>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Advance</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['advance']; ?></label>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>GoodWill</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['goodwill']; ?></label>
					</div>
				</div>
				<?php else: ?>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Price</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['price']; ?> <?php echo $row['p_unit']; ?> <?php echo $row['p_dim']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<div class="row form-group">
					<div class="col-xs-12 text-center">
						<label><u>Comments</u></label>
					</div>
					<div class="col-xs-12 text-center">
						<label style="word-break: break-all;"><?php echo nl2br($row['comments']); ?></label>
					</div>
				</div>
				<?php if($link['status_info']): ?>
				<div class="row form-group">
					<div class="col-xs-6 text-right">
						<label>Status</label>
					</div>
					<div class="col-xs-6">
						<label><?php echo $row['status']; ?></label>
					</div>
				</div>
				<?php endif; ?>
				<?php if($msg1): ?>
				<div class="row form-group">
					<div class="col-md-12">
						<div class="alert alert-success text-center"><?php echo $msg1; ?></div>
					</div>
				</div>
				<?php endif; ?>
				<?php if(!$hide_buttons): ?>
				<div class="row form-group">
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