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
$spz = json_decode($setting['sell_prices']);
$rpz = json_decode($setting['rent_prices']);
$lu = json_decode($setting['land_units']);

if(empty($_GET['view_rand'])){
$uri = explode('/',$_SERVER['REQUEST_URI']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php $vname='Buyer '.ucfirst($uri[2]).' Form'; include($app_key.'/view/layouts/styles.php'); ?>
	<script src="https://apis.google.com/js/api.js" type="text/javascript"></script>
	<style>
		.autocomplete {
		  /*the container must be positioned relative:*/
		  position: relative;
		  display: inline-block;
		}
		.autocomplete-items {
		  position: absolute;
		  border: 1px solid #d4d4d4;
		  border-bottom: none;
		  border-top: none;
		  z-index: 99;
		  /*position the autocomplete items to be the same width as the container:*/
		  top: 100%;
		  left: 0;
		  right: 0;
		}
		.autocomplete-items div {
		  padding: 10px;
		  cursor: pointer;
		  background-color: #fff;
		  border-bottom: 1px solid #d4d4d4;
		}
		.autocomplete-items div:hover {
		  /*when hovering an item:*/
		  background-color: #e9e9e9;
		}
		.autocomplete-active {
		  /*when navigating through the items using the arrow keys:*/
		  background-color: DodgerBlue !important;
		  color: #ffffff;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<?php include($app_key.'/view/layouts/form_header.php'); ?>
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold">Find your property</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold; color:red"><?php echo $message; ?></p>
				</div>
			</div>
			<form method="post" action="/update_buyer">
			<input type="hidden" name="_token" value="<?php echo $rand; ?>"/>
			<?php if(empty($_GET['view_rand'])): ?>
			<input type="hidden" name="page" value="<?php echo $uri[1]; ?>"/>
			<input type="hidden" name="agent" value="<?php echo $uri[2]; ?>"/>
			<?php else: ?>
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<input type="hidden" name="lead_cat" value="buyer"/>
			<input type="hidden" name="lead_type" value="<?php echo $row['lead_type']; ?>"/>
			<input type="hidden" name="view_rand" value="<?php echo $_GET['view_rand']; ?>"/>
			<?php endif; ?>
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
				<div class="col-md-5 form-group">
					<label>Your Location</label>
					<input type="text" class="form-control" name="your_location" value="<?php echo $row['your_location']; ?>">
					<span class="error"><?php echo $error['your_location']; ?></span>
				</div>
				<div class="col-md-5 form-group">
					<label>Your are looking in this area</label>
					<div class="autocomplete" style="width:100%;">
					<input type="text" class="form-control" list="places" autocomplete=off id="address" name="address" value="<?php echo $row['address']; ?>">
					</div>
					<datalist id="places"></datalist>
					<span class="error"><?php echo $error['address']; ?></span>
					<div id="results"></div>
				</div>
				<div class="col-md-2 form-group">
					<label>PIN Code</label>
					<input type="number" class="form-control" id="pin" name="pin" value="<?php echo $row['pin']; ?>">
					<span class="error"><?php echo $error['pin']; ?></span>
				</div>
			</div>
			<?php $row['br_type']=$row['br_type']??'buy'; ?>
			<div class="row">
				<div class="col-md-3 form-group">
					<label>Sell/Rent</label>
					<div style="display: flex">
						<label class="container">
						  <input type="radio" value="buy" name="br_type" <?php echo $row['br_type']=='buy'?'checked':''; ?> >
						  <span class="checkmark">Buy</span>
						</label>
						<label class="container">
						  <input type="radio" value="rent" name="br_type" <?php echo $row['br_type']=='rent'?'checked':''; ?> >
						  <span class="checkmark">RENT</span>
						</label>
					</div><br>
				</div>
				<div class="col-md-3 form-group">
					<label>Property Category</label>
					<select class="form-control" id="property_category" name="property_category">
					</select>
				</div>
				<div class="col-md-3 form-group" id="property_type_container">
					<label>Property Type</label>
					<select class="form-control" id="property_type" name="property_type">
					</select>
				</div>
				<div class="col-md-3 form-group">
					<label>Dimension</label>
					<div class="input-group" style="width: 100%">
					    <input type="text" class="form-control" style="width: 60%" name="dimension" value="<?php echo $row['dimension']; ?>">
					    <select class="form-control" style="width: 40%" name="dim_unit">
					    	<?php foreach($lu as $l): ?>
					    	<option <?php echo $row['dim_unit']==$l?'selected':''; ?>><?php echo $l; ?></option>
				    		<?php endforeach; ?>
					    </select>
					    <span class="error"><?php echo $error['dimension']; ?></span>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-6 form-group">
					<label>Price (min): <span id="minp">
						<?php 
						if($row['br_type']=='buy'){
							if(!$row['min_price']){
								echo '50 Lakhs';
							}elseif($row['min_price']>=100){
								echo $row['min_price']/100 . ' Crores';
							}else{
								echo $row['min_price'] . ' Lakhs';
							}
						}else{
							if(!$row['min_price']){
								echo '50 Thousand';
							}elseif($row['min_price']>=100){
								echo $row['min_price']/100 . ' Lakhs';
							}else{
								echo $row['min_price'] . ' Thousand';
							}
						}
						?>
					</span></label>
					<input type="range" min="5" max="600" value="<?php echo $row['min_price']??50; ?>" class="slider" name="min_price" id="min_price">
				</div>
				<div class="col-md-6 form-group">
					<label>Price (max) <span id="maxp">
						<?php 
						if($row['br_type']=='buy'){
							if(!$row['max_price']){
								echo '90 Lakhs';
							}elseif($row['max_price']>=100){
								echo $row['max_price']/100 . ' Crores';
							}else{
								echo $row['max_price'] . ' Lakhs';
							}
						}else{
							if(!$row['max_price']){
								echo '90 Thousand';
							}elseif($row['max_price']>=100){
								echo $row['max_price']/100 . ' Lakhs';
							}else{
								echo $row['max_price'] . ' Thousand';
							}
						}
						?>
					</span></label>
					<input type="range" min="5" max="600" value="<?php echo $row['max_price']??90; ?>" class="slider" name="max_price" id="max_price">
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Price (min)</label>
							<select id="min_price" name="min_price" class="form-control"></select>
						</div>
						<div class="col-md-6 form-group">
							<label>Price (max)</label>
							<select id="max_price" name="max_price" class="form-control"></select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p>maximum amount shouble be greater than minimum amount</p>
						</div>
					</div>
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
			</div><br>
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
//-------------------------------------------------------------------------------------------------
	var wc = false;
	function copyPhoneForWhatsappNo(){
		wc = !wc;
		$('#whats_app_no').val(wc?$('#phone_no').val():"");
	}
//------------------------------------------------------------------------------------------------
	function reset(){
		window.location = window.location.href;
	}
//----------------------------------------------------------------------------------------------
	$('input[type=radio][name="br_type"]').on('change',function () {
		if($('input[name="br_type"]:checked').val()=='buy'){
			$('#min_price').attr('max','600');
			$('#max_price').attr('max','600');
			pcoptions('buy');
			priceMinMax('buy');
		}else{
			$('#min_price').attr('max','1000');
			$('#max_price').attr('max','1000');
			pcoptions('rent');
			priceMinMax('rent');
		}
	    showMinVal($('#min_price').val());
	    showMaxVal($('#max_price').val());
	});
//-----------------------------------------------------------------------------------------------
	function showMinVal(val){
		if($('input[name="br_type"]:checked').val()=='buy'){
			if(val>=100){
				$("#minp").html(val/100+' Crores')
			}else{
				$("#minp").html(val+' Lakhs')
			}
		}else{
			if(val>=100){
				$("#minp").html(val/100+' Lakhs')
			}else{
				$("#minp").html(val+' Thousand')
			}
		}
	}

	$('#min_price').on('input',function(){
		showMinVal($(this).val());
	});
	$('#min_price').on('change',function(){
		showMinVal($(this).val());
	});
//-----------------------------------------------------------------------------------------------
	function showMaxVal(val){
		if($('input[name="br_type"]:checked').val()=='buy'){
			if(val>=100){
				$("#maxp").html(val/100+' Crores')
			}else{
				$("#maxp").html(val+' Lakhs')
			}
		}else{
			if(val>=100){
				$("#maxp").html(val/100+' Lakhs')
			}else{
				$("#maxp").html(val+' Thousand')
			}
		}
	}

	$('#max_price').on('input',function(){
		showMaxVal($(this).val());
	});
	$('#max_price').on('change',function(){
		showMaxVal($(this).val());
	});
//------------------------------------------------------------------------------------------------
function selectControl(id,selected,skips,options){
	var op = '';
	for (var i = options.length - 1; i >= 0; i--) {
		if(skips.indexOf(options[i])!=-1){
			continue;
		}
		if(selected == options[i]){
			op = '<option selected>'+options[i]+'</option>' + op;
		}else{
			op = '<option>'+options[i]+'</option>' + op;
		}
	};
	$("#"+id).html(op);
}
//-------------------------------------------------------------------------------------------------
function priceMinMax(br){
	var options = [];
	if(br=='buy'){
		options = <?php echo json_encode($spz); ?>;
		selectControl('min_price','<?php echo $row['min_price']; ?>',[],options)
		selectControl('max_price','<?php echo $row['max_price']; ?>',[],options)
	}else{
		options = <?php echo json_encode($rpz); ?>;
		selectControl('min_price','<?php echo $row['min_price']; ?>',[],options)
		selectControl('max_price','<?php echo $row['max_price']; ?>',[],options)
	}
}
priceMinMax('<?php echo $row['br_type']??'buy'; ?>')
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
	var pt = []; var op = ''; var pts = '<?php echo $row['property_type']; ?>';
	$('[name="dim_unit"]').val('Sq/ft');
	$('[name="p_dim"]').val('Per Sq/ft');
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

//-------------------------------------------------------------------------------------------------
$('[name="address"]').on('keyup',function(){
	$.post("places_auto",{"_token":"<?php echo $rand; ?>","input":$(this).val()},function(data,status){
		if(status=='success'){
			console.log(data);
			var places_html = "";
			for (var i = data.length - 1; i >= 0; i--) {
				places_html = "<option>" + data[i] + "</option>" + places_html;
			};
			$("#places").html(places_html);
		}
	});
});
$('[name="address"]').on('change',function(){
	$.post("place_to_pin",{"_token":"<?php echo $rand; ?>","place":$(this).val()},function(data,status){
		if(status=='success'){
			console.log(data);
			$("#pin").val(data);
		}
	});
});
</script>
</body>
</html>