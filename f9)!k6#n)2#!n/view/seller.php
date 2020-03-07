<?php include($app_key.'/include/csrf_token.php'); ?>
<?php 
if(isset($_SESSION['old'])){
	$row = $_SESSION['old'];
	unset($_SESSION['old']);
	$error = $_SESSION['error'];
	unset($_SESSION['error']);
}
$message = $_SESSION['message'];
unset($_SESSION['message']);
?>
<?php
include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$sp = json_decode($setting['sellable_properties']);
$rp = json_decode($setting['rentable_properties']);
$bhk = json_decode($setting['bhk']);
$sites = json_decode($setting['sites']);
$cp = json_decode($setting['commercial_properties']);
$pot_bhk = json_decode($setting['pot_bhk']);
$pot_sites = json_decode($setting['pot_sites']);
$pot_cp = json_decode($setting['pot_commercial_properties']);
$pu = json_decode($setting['price_units']);
$lu = json_decode($setting['land_units']);
$lpu = json_decode($setting['land_per_unit']);

if(empty($_GET['view_rand'])){
$uri = explode('/',$_SERVER['REQUEST_URI']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php $vname='Seller '.ucfirst($uri[2]).' Form'; include($app_key.'/view/layouts/styles.php'); ?>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAStT0b5XERgSTXI2Oq2goU5xUDxJBNI8U"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<?php include($app_key.'/view/layouts/form_header.php'); ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold">Register your property</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold; color:red"><?php echo $message; ?></p>
				</div>
			</div>
			<form id="seller_form" method="post" action="/update_seller">
			<input type="hidden" name="_token" value="<?php echo $rand; ?>"/>
			<?php if(empty($_GET['view_rand'])): ?>
			<input type="hidden" name="page" value="<?php echo $uri[1]; ?>"/>
			<input type="hidden" name="agent" value="<?php echo $uri[2]; ?>"/>
			<?php else: ?>
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<input type="hidden" name="lead_cat" value="seller"/>
			<input type="hidden" name="lead_type" value="<?php echo $row['lead_type']; ?>"/>
			<input type="hidden" name="view_rand" value="<?php echo $_GET['view_rand']; ?>"/>
			<?php endif; ?>
			<input type="hidden" id="latitude" name="latitude" value="<?php echo $row['latitude']; ?>"/>
			<input type="hidden" id="longitude" name="longitude" value="<?php echo $row['longitude']; ?>"/>
			<div class="row">
				<div class="col-md-12">
					<h3 style="border-bottom: 1px solid orange">Personel Details</h3>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-3 form-group">
					<label>Date</label>
					<input type="date" class="form-control" name="date" value="<?php echo $row['date']??date('Y-m-d'); ?>">
					<span class="error"><?php echo $error['date']; ?></span>
				</div>
				<div class="col-md-3 form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
					<span class="error"><?php echo $error['name']; ?></span>
				</div>
				<div class="col-md-3 form-group">
					<label>Phone Number</label>
					<input type="number" class="form-control" name="phone_no" value="<?php echo $row['phone_no']; ?>" id="phone_no">
					<span class="error"><?php echo $error['phone_no']; ?></span>
				</div>
				<div class="col-md-3">
					<label>WhatsApp Number</label>
					<input type="number" class="form-control" name="whats_app_no" value="<?php echo $row['whats_app_no']; ?>" id="whats_app_no">
					<label style="font-weight: normal;">(Same as Phone Number) <input type="checkbox" onclick="copyPhoneForWhatsappNo()"></label>
					<span class="error"><?php echo $error['whats_app_no']; ?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3 style="border-bottom: 1px solid orange">Address</h3>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12 form-group">
							<label>GPRS Location</label>
							<textarea rows="4" id="address" class="form-control" name="address"><?php echo $row['address']; ?></textarea>
							<span class="error"><?php echo $error['address']; ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>PIN Code</label>
							<input id="zip" type="number" class="form-control" name="pin" value="<?php echo $row['pin']; ?>">
							<span class="error"><?php echo $error['pin']; ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Area/Village</label>
							<input id="villege" type="text" class="form-control" name="villege" value="<?php echo $row['villege']; ?>">
							<span class="error"><?php echo $error['villege']; ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Landmark</label>
							<input type="text" class="form-control" name="landmark" value="<?php echo $row['landmark']; ?>">
							<span class="error"><?php echo $error['landmark']; ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<a class="btn btn-primary btn-block" onclick="pickLatLong()">Google Maps Link</a>
							<input type="hidden" class="form-control" name="place_link" value="<?php echo $row['place_link']; ?>">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div id="map" style="height: 390px; width: 100%;"></div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success" id="gmap"><?php echo $row['place_link']??'Use drag marker option to point exact location if required.'; ?></div>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12">
					<h3 style="border-bottom: 1px solid orange">Property Details</h3>
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-12">
					<div class="btn-group">
						<label for="capture" class="btn btn-default"><i class="fa fa-camera"></i> Capture</label>
						<label for="images" class="btn btn-default"><i class="fa fa-file-image-o" ></i> Images</label>
						<label for="files" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Files</label>
						<p>You can upload multiple images / files.</p>
					</div>
					<div>
						<!-- <input type="hidden" name="file_paths" id="file_paths"/> -->
						<input type="file" id="capture" accept="image/*" capture="environment" onchange="uploadfile('file_paths','capture')" style="display: none">
						<input type="file" id="images" accept="image/*" onchange="uploadfiles('file_paths','images')" style="display: none" multiple>
						<input type="file" id="files" accept="application/pdf" onchange="uploadfiles('file_paths','files')" style="display: none" multiple>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<progress id="progressBar" value="6" max="100" style="width:100%;display: none"></progress>
				</div>
			</div>
			<div class="row" id="files_table" >
				<div class="col-md-12 form-group table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Sr No.</th>
								<th>File Preview</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="uploaded_files">
							<?php foreach(json_decode($row['file_paths']) as $k=>$path): ?>
							<tr>
								<td><?php echo $k+1; ?></td>
								<td><a class="btn btn-default" href="<?php echo $path; ?>" target="_blank">Preview</a></td>
								<td><a onclick="removeFile('<?php echo $k; ?>')">Remove</a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php echo count(json_decode($row['file_paths'])).' files uploaded'; ?>
				</div>
			</div>
			<?php $row['sr_type']=$row['sr_type']??'sell'; ?>
			<div class="row">
				<div class="col-md-12 form-group">
					<label>Sell/Rent</label>
					<div style="display: flex">
						<label class="container">
						  <input type="radio" value="sell" name="sr_type" <?php echo $row['sr_type']=='sell'?'checked':''; ?> onclick="pcoptions('sell')">
						  <span class="checkmark">SELL</span>
						</label>
						<label class="container">
						  <input type="radio" value="rent" name="sr_type" <?php echo $row['sr_type']=='rent'?'checked':''; ?> onclick="pcoptions('rent')">
						  <span class="checkmark">RENT</span>
						</label>
					</div><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 form-group">
					<label>Property Category</label>
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
				<div class="col-md-3 form-group" id="property_type_container">
					<label>Property Type</label>
					<select class="form-control" id="property_type" name="property_type">
						<option>1 BHK</option>
						<option>2 BHK</option>
						<option>3 BHK</option>
						<option>4 BHK</option>
						<option>ANY</option>
					</select>
				</div>
				<div class="col-md-4 form-group">
					<label>Dimension</label>
					<div class="input-group" style="width: 100%">
					    <input type="text" class="form-control" style="width: 60%" name="dimension" value="<?php echo $row['dimension']; ?>">
					    <select class="form-control" style="width: 40%" name="dim_unit">
					    	<?php foreach($lu as $l): ?>
					    	<option <?php echo $row['dim_unit']==$l?'selected':''; ?>><?php echo $l; ?></option>
				    		<?php endforeach; ?>
					    </select>
					</div>
					<span class="error"><?php echo $error['dimension']; ?></span>
				</div>
				<div class="col-md-5 form-group price">
					<label>Price</label>
					<div class="input-group" style="width: 100%">
						<input type="number" class="form-control" style="width: 33.33%" name="price" value="<?php echo $row['price']; ?>" step="0.01">
						<select class="form-control" style="width: 33.33%" name="p_unit">
							<?php foreach($pu as $l): ?>
					    	<option <?php echo $row['p_unit']==$l?'selected':''; ?>><?php echo $l; ?></option>
				    		<?php endforeach; ?>
					    </select>
					    <select class="form-control" style="width: 33.33%" name="p_dim">
					    	<?php foreach($lpu as $l): ?>
					    	<option <?php echo $row['p_dim']==$l?'selected':''; ?>><?php echo $l; ?></option>
				    		<?php endforeach; ?>
					    </select>
					</div>
					<span class="error"><?php echo $error['price']; ?></span>
				</div>
				<div class="col-md-2 form-group jjag" style="display: none">
					<label>Advance</label>
					<input type="text" class="form-control" name="advance" value="<?php echo $row['advance']; ?>" step="0.01">
					<span class="error"><?php echo $error['advance']; ?></span>
				</div>
				<div class="col-md-2 form-group jjag" style="display: none">
					<label>Goodwill</label>
					<input type="text" class="form-control" name="goodwill" value="<?php echo $row['goodwill']; ?>" step="0.01">
					<span class="error"><?php echo $error['goodwill']; ?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
					<label>Comments (Optional)</label>
					<textarea rows="4" class="form-control" name="comments"><?php echo $row['comments']; ?></textarea>
					<span class="error"><?php echo $error['comments']; ?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
					<label><input type="checkbox" name="accept_terms" <?php echo $row['accept_terms']==1?'checked':''; ?> <?php if($row['accept_terms']===null){echo 'checked';} ?> > Accept Terms and Conditions</label> <a href="/terms_n_conditions" target="_blank">Read</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" class="btn btn-primary" style="margin-right: 20px" name="submit" value="Final Submit">
					<input type="submit" class="btn btn-primary" name="submit" value="Save Draft">
				</div>
			</div><br><br>
			</form>
		</div>
	</div>
</div>
<script>
function homepage(){
	window.location = '/';
}
function reset(){
	window.location = window.location.href;
}
//-------------------------------------------------------------------------------------------------	
	var wc = false;
	function copyPhoneForWhatsappNo(){
		wc = !wc;
		$('#whats_app_no').val(wc?$('#phone_no').val():"");
	}
//-------------------------------------------------------------------------------------------------
function getFormData(id){
    var unindexed_array = $("#"+id).serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
//-------------------------------------------------------------------------------------------------
	var file_paths = [];var file_names = [];
	function uploadfile(file_name,fid){
		let photo = document.getElementById(fid).files[0];  // file from input
		let req = new XMLHttpRequest();
		req.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	file_paths.push(this.responseText);
		    	display_files();
		    	$("#files_table").css('display','block');
		    	$("#progressBar").css('display','none');
		    }
		};
		let formData = new FormData();
		formData.append("id", "<?php echo $id ?>");
		formData.append("_token", "<?php echo $rand ?>");
		formData.append("file_name",file_name);
		formData.append(file_name, photo);
		file_names.push(photo.name);
		$("#progressBar").css('display','block');
		req.upload.addEventListener("progress", progressHandler, false);
		req.addEventListener("load", completeHandler, false);
		req.addEventListener("error", errorHandler, false);
		req.addEventListener("abort", abortHandler, false);
		req.open("POST", '/upload_seller_file');
		req.send(formData);
	}
//-------------------------------------------------------------------------------------------------
function progressHandler(event) {
  var percent = (event.loaded / event.total) * 100;
  $("#progressBar").val(Math.round(percent));
}

function completeHandler(event) {
	// event.target.responseText;
}

function errorHandler(event) {
}

function abortHandler(event) {
}

function display_files(){
	var li = '';
	for (var i = file_paths.length - 1; i >= 0; i--) {
		li = '<tr><td>'+(i+1)+'</td><td><a href="'+file_paths[i]+'" target="_blank">'+file_names[i]+'</a></td><td><a onclick="removeFilePath('+i+')">Remove</a></td></tr>'+li;
	};
	$("#uploaded_files").html(li);
	// console.log(file_paths);
	// console.log(JSON.stringify(file_paths))
	$("#file_paths").val(JSON.stringify(file_paths));
}

function removeFilePath(i){
	file_paths.splice(i,1);
	file_names.splice(i,1);
	display_files();
}

function removeFile(index){
	let req = new XMLHttpRequest();
	req.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	window.location = window.location.href;
	    }
	};
	let formData = new FormData();

	formData.append("id", "<?php echo $id ?>");
	formData.append("index", index);
	formData.append("_token", "<?php echo $rand ?>");
	req.open("POST", '/remove_seller_file');
	req.send(formData);
}

function uploadfiles(field_name,id){
	let no_of_files = document.getElementById(id).files.length;
	let req = new XMLHttpRequest();
	req.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	// for (var i = this.response.length - 1; i >= 0; i--) {
	    	// 	file_paths.push(this.response[i]);
	    	// };
	    	// display_files();
	    	// $("#files_table").css('display','block');

	    	$("#progressBar").css('display','none');
	    	var data = getFormData("seller_form");
	    	data['id']=this.response['id'];
	    	data['view_rand']=this.response['view_rand'];
	    	data['lead_cat']=this.response['lead_cat'];
	    	data['lead_type']=this.response['lead_type'];
	    	data['file_update']=1;
			$.post("/update_seller",data,function(data,status){
				if(status=='success'){
					window.location = data;
				}
			});
	    }
	};
	let formData = new FormData();

	formData.append("_token", "<?php echo $rand ?>");
	<?php if(empty($_GET['view_rand'])): ?>
	formData.append("page", "<?php echo $uri[1]; ?>");
	formData.append("agent", "<?php echo $uri[2]; ?>");
	<?php else: ?>
	formData.append("id", "<?php echo $id ?>");
	formData.append("lead_cat", "<?php echo $row['lead_cat']; ?>");
	formData.append("lead_type", "<?php echo $row['lead_type']; ?>");
	formData.append("view_rand", "<?php echo $_GET['view_rand']; ?>");
	<?php endif; ?>
	formData.append("field_name",field_name);
	formData.append("no_of_files",no_of_files);
	for (var i = 0; i <no_of_files; i++) {
		file_names.push(document.getElementById(id).files[i].name);
		formData.append(field_name+'_'+i, document.getElementById(id).files[i]);
	}
	$("#progressBar").css('display','block');
	req.upload.addEventListener("progress", progressHandler, false);
	req.addEventListener("load", completeHandler, false);
	req.addEventListener("error", errorHandler, false);
	req.addEventListener("abort", abortHandler, false);
	req.responseType = 'json';
	req.open("POST", '/upload_seller_files');
	req.send(formData);
}
//-------------------------------------------------------------------------------------------------
 	var sp = <?php echo json_encode($sp); ?>;
 	var rp = <?php echo json_encode($rp); ?>;

	function pcoptions(sr){
		if(sr=='rent'){
			var pc = rp;
		}else{
			var pc = sp;
		}
		var op = ''; var pcs = '<?php echo $row['property_category']; ?>';
		for (var i = pc.length - 1; i >= 0; i--) {
			if(pcs == pc[i]){
				op = '<option selected>'+pc[i]+'</option>' + op;
			}else{
				op = '<option>'+pc[i]+'</option>' + op;
			}
		};
		$("#property_category").html(op);
	}
	pcoptions('<?php echo $row['sr_type']??'sell'; ?>');
//-------------------------------------------------------------------------------------------------

var bhk = <?php echo json_encode($bhk); ?>;
var cp = <?php echo json_encode($cp); ?>;
var sites = <?php echo json_encode($sites); ?>;

var pot_bhk = <?php echo json_encode($pot_bhk); ?>;
var pot_cp = <?php echo json_encode($pot_cp); ?>;
var pot_sites = <?php echo json_encode($pot_sites); ?>;

function ptoptions(pc){
	// alert($('#property_category').val());
	var pt = []; var op = ''; var pts = '<?php echo $row['property_type']; ?>';
	$('[name="dim_unit"]').val('Sq/ft');
	$('[name="p_dim"]').val('Per Sq/ft');
	$(".jjag").css('display','none');
	$(".price").css('display','block');
	if(pot_cp.indexOf(pc)!=-1){
		pt = cp; $("#property_type_container").css('display','block');
	}else if(pot_sites.indexOf(pc)!=-1){
		pt = sites; $("#property_type_container").css('display','block');
	}else if(pot_bhk.indexOf(pc)!=-1){
		pt = bhk; $("#property_type_container").css('display','block');
	}else{
		$("#property_type_container").css('display','none');
		$('[name="dim_unit"]').val('Acres');
		$('[name="p_dim"]').val('Per Acre');
		if($("#property_category").val()=='JD OR JV Lands'){
			$(".jjag").css('display','block');
			$(".price").css('display','none');
		}
	}
	for (var i = pt.length - 1; i >= 0; i--) {
		if(pts == pt[i]){
			op = '<option selected>'+pt[i]+'</option>' + op;
		}else{
			op = '<option>'+pt[i]+'</option>' + op;
		}
	};
	$("#property_type").html(op);
}
ptoptions('<?php echo $row['property_category']??'House'; ?>');
$("#property_category").on('change',function(){
	ptoptions($("#property_category").val());
});

//-----------------------------------------------------------------------------------------------------------------------
    function addYourLocationButton(map, marker) 
	{
	    var controlDiv = document.createElement('div');

	    var firstChild = document.createElement('div');
	    firstChild.style.backgroundColor = '#fff';
	    firstChild.style.border = 'none';
	    firstChild.style.outline = 'none';
	    firstChild.style.width = '40px';
	    firstChild.style.height = '40px';
	    firstChild.style.borderRadius = '2px';
	    firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
	    firstChild.style.cursor = 'pointer';
	    firstChild.style.marginRight = '10px';
	    firstChild.style.padding = '5px';
	    firstChild.title = 'Your Location';
	    controlDiv.appendChild(firstChild);

	    var secondChild = document.createElement('div');
	    secondChild.style.margin = '5px';
	    secondChild.style.width = '18px';
	    secondChild.style.height = '18px';
	    secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
	    secondChild.style.backgroundSize = '180px 18px';
	    secondChild.style.backgroundPosition = '0px 0px';
	    secondChild.style.backgroundRepeat = 'no-repeat';
	    secondChild.id = 'you_location_img';
	    firstChild.appendChild(secondChild);

	    google.maps.event.addListener(map, 'dragend', function() {
	        $('#you_location_img').css('background-position', '0px 0px');
	    });

	    firstChild.addEventListener('click', function() {
	        var imgX = '0';
	        var animationInterval = setInterval(function(){
	            if(imgX == '-18') imgX = '0';
	            else imgX = '-18';
	            $('#you_location_img').css('background-position', imgX+'px 0px');
	        }, 500);
	        if(navigator.geolocation) {
	            navigator.geolocation.getCurrentPosition(function(position) {
	            	$("#latitude").val(position.coords.latitude);
	            	$("#longitude").val(position.coords.longitude);
	                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	                marker.setPosition(latlng);
	                map.setCenter(latlng);
	                clearInterval(animationInterval);
	                $('#you_location_img').css('background-position', '-144px 0px');
	                initializeCurrent(position.coords.latitude, position.coords.longitude);
	            });
	        }
	        else{
	            clearInterval(animationInterval);
	            $('#you_location_img').css('background-position', '0px 0px');
	        }
	    });

	    controlDiv.index = 1;
	    console.log(controlDiv);
	    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
	}

	var map;var marke;
    function initializeCurrent(latcurr, longcurr) {
    	map = new google.maps.Map(document.getElementById('map'), {
		  center: {lat: latcurr, lng: longcurr},
		  zoom: 18
		});
		marker = new google.maps.Marker({position: {lat: latcurr, lng: longcurr}, map: map, draggable:true});
		google.maps.event.addListener(marker, 'dragend', function(evt){
			var latlng = new google.maps.LatLng(evt.latLng.lat().toFixed(7), evt.latLng.lng().toFixed(7));
			marker.setPosition(latlng);
		    map.setCenter(marker.position);
			// marker.setMap(map);
			$("#latitude").val(evt.latLng.lat().toFixed(7));
        	$("#longitude").val(evt.latLng.lng().toFixed(7));
        	getCurrentAddress(latlng);
		});
		addYourLocationButton(map, marker);
	    this.currgeocoder = new google.maps.Geocoder();
	    if (latcurr != '' && longcurr != '') {
	       var myLatlng = new google.maps.LatLng(latcurr, longcurr);
	       getCurrentAddress(myLatlng);
	    }
	}

  	function getCurrentAddress(location, mode=null) {
	     this.currgeocoder.geocode({
	        'location': location
	     }, (results, status) => {
	        if (status == google.maps.GeocoderStatus.OK) {
	        	<?php if(empty($row['address'])): ?>
	            $("#address").val(results[0].formatted_address);
				<?php endif; ?>
				<?php if(empty($row['zip'])): ?>
				$("#zip").val(results[0].address_components[results[0].address_components.length-1]['long_name']);
				<?php endif; ?>
	        } else {
	            alert('Geocode was not successful for the following reason: ' + status);
	        }
	     });
	}
	
  	<?php if(empty($row['latitude']) || empty($row['longitude'])): ?>
  	if (navigator.geolocation) {
  		navigator.geolocation.getCurrentPosition((position) => {
	      	initializeCurrent(position.coords.latitude, position.coords.longitude);
	      	$("#latitude").val(position.coords.latitude);
	        $("#longitude").val(position.coords.longitude);
	    });
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  	<?php else: ?>
  	initializeCurrent(<?php echo $row['latitude']; ?>, <?php echo $row['longitude']; ?>);
  	$("#latitude").val(<?php echo $row['latitude']; ?>);
    $("#longitude").val(<?php echo $row['longitude']; ?>);
  	<?php endif; ?>

    function pickLatLong(){
    	var url = prompt("Enter the custom google maps link");
    	$.post("pick_lat_long",{"_token":"<?php echo $rand; ?>","url":url},function(data,status){
    		if(status=='success'){
    			if(data.data == 'latlong'){
    				var latlng = new google.maps.LatLng(data.latitude, data.longitude);
					marker.setPosition(latlng);
					map.setCenter(marker.position);
		        	getCurrentAddress(latlng);
			        $("#latitude").val(data.latitude);
			        $("#longitude").val(data.longitude);
			        $('[name="place_link"]').val("https://www.google.com/maps/search/?api=1&query="+data.latitude+","+data.longitude);
			        $("#gmap").html("GPRS Location has been changed based on your custom google maps link. Use drag marker option to point exact location if required.");
    			}else if(data.data == 'save'){
    				$('[name="place_link"]').val(url);
    				$("#gmap").html(url);
    			}
    		}
    	});
    }

</script>
</body>
</html>