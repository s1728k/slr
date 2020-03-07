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
						<input type="number" class="form-control" name="phone_no" value="<?php echo $row['phone_no']; ?>" id="phone_no">
						<span class="error"><?php echo $error['phone_no']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>WhatsApp No.</label>
					</div>
					<div class="col-md-7">
						<input type="number" class="form-control" name="whats_app_no" value="<?php echo $row['whats_app_no']; ?>" id="whats_app_no">
						<span class="error"><?php echo $error['whats_app_no']; ?></span>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Address</h6>
				<div class="row form-group">
					<div class="col-md-5">
						<label>GPRS Location</label>
					</div>
					<div class="col-md-7">
						<textarea rows="4" id="address" class="form-control" name="address"><?php echo $row['address']; ?></textarea>
						<span class="error"><?php echo $error['address']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Area/Villege</label>
					</div>
					<div class="col-md-7">
						<input id="villege" type="text" class="form-control" name="villege" value="<?php echo $row['villege']; ?>">
						<span class="error"><?php echo $error['villege']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>PIN</label>
					</div>
					<div class="col-md-7">
						<input id="zip" type="number" class="form-control" name="pin" value="<?php echo $row['pin']; ?>">
						<span class="error"><?php echo $error['pin']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Landmark</label>
					</div>
					<div class="col-md-7">
						<input type="text" class="form-control" name="landmark" value="<?php echo $row['landmark']; ?>">
						<span class="error"><?php echo $error['landmark']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Latitude</label>
					</div>
					<div class="col-md-7">
						<input type="number" step="0.000001" class="form-control" name="latitude" value="<?php echo $row['latitude']; ?>">
						<span class="error"><?php echo $error['latitude']; ?></span>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Longitude</label>
					</div>
					<div class="col-md-7">
						<input type="number" step="0.000001" class="form-control" name="longitude" value="<?php echo $row['longitude']; ?>">
						<span class="error"><?php echo $error['longitude']; ?></span>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Property Details</h6>
				<div class="row form-group">
					<div class="col-md-3">
						<?php if($row['file_path1']): ?>
						  <a type="button" class="btn btn-default" href="<?php echo $row['file_path1']; ?>" target="_blank"><i class="fa fa-search"></i> File1 Preview</a>
						<?php endif; ?>
					</div>
					<div class="col-md-3">
						<?php if($row['file_path2']): ?>
						  <a type="button" class="btn btn-default" href="<?php echo $row['file_path2']; ?>" target="_blank"><i class="fa fa-search"></i> File2 Preview</a>
						<?php endif; ?>
					</div>
					<div class="col-md-3">
						<?php if($row['file_path3']): ?>
						  <a type="button" class="btn btn-default" href="<?php echo $row['file_path3']; ?>" target="_blank"><i class="fa fa-search"></i> File3 Preview</a>
						<?php endif; ?>
					</div>
					<div class="col-md-3">
						<?php if($row['file_path4']): ?>
						  <a type="button" class="btn btn-default" href="<?php echo $row['file_path4']; ?>" target="_blank"><i class="fa fa-search"></i> File4 Preview</a>
						<?php endif; ?>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Property For</label>
					</div>
					<div class="col-md-7">
						<div style="display: flex">
							<label class="container">
							  <input type="radio" value="sell" name="sr_type" <?php echo $row['sr_type']=='sell'?'checked':''; ?>>
							  <span class="checkmark">SELL</span>
							</label>
							<label class="container">
							  <input type="radio" value="rent" name="sr_type" <?php echo $row['sr_type']=='rent'?'checked':''; ?>>
							  <span class="checkmark">RENT</span>
							</label>
						</div>
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
						    	<option <?php echo $row['dim_unit']=="Sq/ft"?'selected':''; ?>>Sq/ft</option><option <?php echo $row['dim_unit']=="Acres"?'selected':''; ?>>Acres</option><option <?php echo $row['dim_unit']=="Guntas"?'selected':''; ?>>Guntas</option>
						    </select>
						    <span class="error"><?php echo $error['dimension']; ?></span>
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Price</label>
					</div>
					<div class="col-md-7">
						<div class="input-group" style="width: 100%">
							<input type="number" class="form-control" style="width: 33.33%" name="price" value="<?php echo $row['price']; ?>">
							<select class="form-control" style="width: 33.33%" name="p_unit">
						    	<option <?php echo $row['p_unit']=="Thousands"?'selected':''; ?>>Thousands</option>
						    	<option <?php echo $row['p_unit']=="Lacs"?'selected':''; ?>>Lacs</option>
						    	<option <?php echo $row['p_unit']=="Crores"?'selected':''; ?>>Crores</option>
						    </select>
						    <select class="form-control" style="width: 33.33%" name="p_dim">
						    	<option <?php echo $row['p_dim']=="Per Sq/ft"?'selected':''; ?>>Per Sq/ft</option>
						    	<option <?php echo $row['p_dim']=="Per Acre"?'selected':''; ?>>Per Acre</option>
						    	<option <?php echo $row['p_dim']=="Per Gunta"?'selected':''; ?>>Per Gunta</option>
						    </select>
						</div>
						<span class="error"><?php echo $error['price']; ?></span>
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
				<div class="row">
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
						<label><?php echo $ca['auth']; ?> Comment - <?php echo $ca['date']; ?></label>
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