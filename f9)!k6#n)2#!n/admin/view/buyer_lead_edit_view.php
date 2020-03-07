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
		</div>
		<div class="col-md-6 text-right">
			<a class="btn btn-primary" href="<?php echo $_GET['back']; ?>">Back</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="row">
					<div class="col-md-12">
						<?php echo $message?'<div class="well">'.$message.'</div>':'' ?>
					</div>
				</div>
			<form method="post" action="/admin/update_lead" class="box_form">
				<input type="hidden" name="_token" value="<?php echo $rand ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="lead_cat" value="<?php echo $table ?>">
				<div class="row form_heading">
					<div class="col-md-12">
						<h3><?php echo ucfirst($row['lead_cat']); ?> <?php echo ucfirst($row['lead_type']); ?></h3>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Personal Information</h6>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Date</label>
					</div>
					<div class="col-md-7">
						<input type="date" class="form-control" name="date" value="<?php echo $row['date']??date('Y-m-d'); ?>">
						<span class="error"><?php echo $error['date']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Name</label>
					</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
						<span class="error"><?php echo $error['name']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Phone</label>
					</div>
					<div class="col-md-7">
						<input type="number" class="form-control" id="phone_no" name="phone_no" value="<?php echo $row['phone_no']; ?>">
						<span class="error"><?php echo $error['phone_no']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>WhatsApp No.</label>
					</div>
					<div class="col-md-7">
						<input type="number" class="form-control" id="whats_app_no" name="whats_app_no" value="<?php echo $row['whats_app_no']; ?>">
						<span class="error"><?php echo $error['whats_app_no']; ?></span>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Address</h6>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Buyer Location</label>
					</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="your_location" value="<?php echo $row['your_location']; ?>">
						<span class="error"><?php echo $error['your_location']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Searching Location</label>
					</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>">
						<span class="error"><?php echo $error['address']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>PIN</label>
					</div>
					<div class="col-md-7">
						<input type="number" class="form-control" name="pin" value="<?php echo $row['pin']; ?>">
						<span class="error"><?php echo $error['pin']; ?></span>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Property Requirements</h6>
				<?php $row['br_type']=$row['br_type']??'buy'; ?>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Property For</label>
					</div>
					<div class="col-md-7">
						<div style="display: flex">
							<label class="container">
							  <input type="radio" value="buy" name="br_type" <?php echo $row['br_type']=='buy'?'checked':''; ?>>
							  <span class="checkmark">Buy</span>
							</label>
							<label class="container">
							  <input type="radio" value="rent" name="br_type" <?php echo $row['br_type']=='rent'?'checked':''; ?>>
							  <span class="checkmark">RENT</span>
							</label>
						</div><br>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Category</label>
					</div>
					<div class="col-md-7">
						<select class="form-control" id="property_category" name="property_category">
							<option <?php echo $row['property_category']=='House'?'selected':''; ?>>House</option>
							<option <?php echo $row['property_category']=='Flats'?'selected':''; ?>>Flats</option>
							<option <?php echo $row['property_category']=='Independent House'?'selected':''; ?>>Independent House</option>
							<option <?php echo $row['property_category']=='Farm House'?'selected':''; ?>>Farm House</option>
							<option <?php echo $row['property_category']=='Villas'?'selected':''; ?>>Villas</option>
							<option <?php echo $row['property_category']=='Commercial Space'?'selected':''; ?>>Commercial Space</option>
							<option <?php echo $row['property_category']=='Sites'?'selected':''; ?>>Sites</option>
							<option <?php echo $row['property_category']=='Agriculture lands'?'selected':''; ?>>Agriculture lands</option>
							<option <?php echo $row['property_category']=='Commercial lands'?'selected':''; ?>>Commercial lands</option>
							<option <?php echo $row['property_category']=='Conversation lands'?'selected':''; ?>>Conversation lands</option>
							<option <?php echo $row['property_category']=='Yellow zone lands'?'selected':''; ?>>Yellow zone lands</option>
							<option <?php echo $row['property_category']=='Industrial zone lands'?'selected':''; ?>>Industrial zone lands</option>
							<option <?php echo $row['property_category']=='JD & JV Lands'?'selected':''; ?>>JD & JV Lands</option>
						</select>
					</div>
				</div>
				<div class="row form-group" id="property_type_container">
					<div class="col-md-5">
						<label>Type</label>
					</div>
					<div class="col-md-7">
						<select class="form-control" id="property_type" name="property_type">
							<option>1 BHK</option>
							<option>2 BHK</option>
							<option>3 BHK</option>
							<option>4 BHK</option>
							<option>ANY</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Dimension</label>
					</div>
					<div class="col-md-7">
						<div class="input-group" style="width: 100%">
						    <input type="text" class="form-control" style="width: 60%" name="dimension" value="<?php echo $row['dimension']; ?>">
						    <select class="form-control" style="width: 40%" name="dim_unit">
						    	<option <?php echo $row['dim_unit']=='Sq/ft'?'selected':''; ?>>Sq/ft</option>
						    	<option <?php echo $row['dim_unit']=='Acres'?'selected':''; ?>>Acres</option>
						    	<option <?php echo $row['dim_unit']=='Guntas'?'selected':''; ?>>Guntas</option>
						    </select>
						    <span class="error"><?php echo $error['dimension']; ?></span>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Min Price</label>
					</div>
					<div class="col-md-7">
						<label>Price (min): <span id="minp">
							<?php 
							if(!$row['min_price']){
								echo '50 Lacks';
							}elseif($row['min_price']>=100){
								echo $row['min_price']/100 . ' Crores';
							}else{
								echo $row['min_price'] . ' Lacks';
							}
							?>
						</span></label>
						<input type="range" min="5" max="600" value="<?php echo $row['min_price']??50; ?>" class="slider" name="min_price" oninput="showMinVal(this.value)" onchange="showMinVal(this.value)">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Max Price</label>
					</div>
					<div class="col-md-7">
						<label>Price (max) <span id="maxp">
							<?php 
							if(!$row['max_price']){
								echo '90 Lacks';
							}elseif($row['max_price']>=100){
								echo $row['max_price']/100 . ' Crores';
							}else{
								echo $row['max_price'] . ' Lacks';
							}
							?>
						</span></label>
						<input type="range" min="5" max="600" value="<?php echo $row['max_price']??90; ?>" class="slider" name="max_price" oninput="showMaxVal(this.value)" onchange="showMaxVal(this.value)">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Seller Comments</label>
					</div>
					<div class="col-md-7">
						<textarea rows="4" class="form-control" name="comments"><?php echo $row['comments']; ?></textarea>
						<span class="error"><?php echo $error['comments']; ?></span>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Admin</h6>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Status</label>
					</div>
					<div class="col-md-7">
						<select class="form-control" name="status">
							<option <?php echo $row['status']=='None'?'selected':''; ?>>None</option>
							<option <?php echo $row['status']=='Follow Up'?'selected':''; ?>>Follow Up</option>
							<option <?php echo $row['status']=='Client Meeting'?'selected':''; ?>>Client Meeting</option>
							<option <?php echo $row['status']=='Completed Client'?'selected':''; ?>>Completed Client</option>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Followup Time</label>
					</div>
					<div class="col-md-7">
						<input type="datetime-local" class="form-control" name="status_date" value="<?php echo date('Y-m-d\TH:i',strtotime($row['status_date'])); ?>" />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Comment</label>
					</div>
					<div class="col-md-7">
						<textarea rows="4" class="form-control" name="comments1"><?php echo $row['comments1']; ?></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
					</div>
					<div class="col-md-7">
						<input type="submit" class="btn btn-primary">
					</div>
				</div><br>
				<?php 
				$cad = json_decode($row['comments_array'],true)??[];
				?>
				<?php foreach($cad as $ca): ?>
				<div class="row form-group">
					<div class="col-md-5">
						<label><?php echo $ca['auth']; ?> - <?php echo $ca['date']; ?></label>
					</div>
					<div class="col-md-7">
						<?php echo $ca['comment']; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</form>
		</div>
	</div>
</div>
<script>
	function showMinVal(val){
		if(val>=100){
			$("#minp").html(val/100+' Crores')
		}else{
			$("#minp").html(val+' Lacks')
		}
	}

	function showMaxVal(val){
		if(val>=100){
			$("#maxp").html(val/100+' Crores')
		}else{
			$("#maxp").html(val+' Lacks')
		}
	}

	$("#property_category").on('change',function(){
		if($("#property_category").val() == 'Commercial Space'){
			$("#property_type_container").css('display','block');
			$("#property_type").html('<option <?php echo $row['property_type']=='Commercial Office Space'?'selected':''; ?>>Commercial Office Space</option><option <?php echo $row['property_type']=='Other Commercial'?'selected':''; ?>>Other Commercial</option><option <?php echo $row['property_type']=='Shop/ Showroom'?'selected':''; ?>>Shop/ Showroom</option>');
		}else if($("#property_category").val() == 'Sites'){
			$("#property_type_container").css('display','block');
			$("#property_type").html('<option <?php echo $row['property_type']=='Any'?'selected':''; ?>>Any</option><option <?php echo $row['property_type']=='A katha'?'selected':''; ?>>A katha</option><option<?php echo $row['property_type']=='B katha'?'selected':''; ?>>B katha</option><option <?php echo $row['property_type']=='E katha'?'selected':''; ?>>E katha</option><option <?php echo $row['property_type']=='Revenue site'?'selected':''; ?>>Revenue site</option><option <?php echo $row['property_type']=='Dc Approval sites'?'selected':''; ?>>Dc Approval sites</option><option <?php echo $row['property_type']=='BMRD Approval sites'?'selected':''; ?>>BMRD Approval sites</option><option <?php echo $row['property_type']=='BDA Approval sites'?'selected':''; ?>>BDA Approval sites</option><option <?php echo $row['property_type']=='BIAPPA Approval sites'?'selected':''; ?>>BIAPPA Approval sites</option><option <?php echo $row['property_type']=='BBMP Approval sites'?'selected':''; ?>>BBMP Approval sites</option><option <?php echo $row['property_type']=='DTCP Approval sites'?'selected':''; ?>>DTCP Approval sites</option>');
		}else if(['House','Flats','Independent House','Farm House','Villas'].indexOf($("#property_category").val())!=-1){
			$("#property_type_container").css('display','block');
			$("#property_type").html('<option <?php echo $row['property_type']=='1 BHK'?'selected':''; ?>>1 BHK</option><option <?php echo $row['property_type']=='2 BHK'?'selected':''; ?>>2 BHK</option><option <?php echo $row['property_type']=='3 BHK'?'selected':''; ?>>3 BHK</option><option <?php echo $row['property_type']=='4 BHK'?'selected':''; ?>>4 BHK</option><option <?php echo $row['property_type']=='ANY'?'selected':''; ?>>ANY</option>');
		}else{
			$("#property_type_container").css('display','none');
		}
	});
</script>
</body>
</html>