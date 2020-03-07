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
$mt = json_decode($setting['member_types']);
$mw = json_decode($setting['member_works']);

if(empty($_GET['view_rand'])){
$uri = explode('/',$_SERVER['REQUEST_URI']);
}

if(!empty($_GET['lead_id']) && !empty($_GET['lead_cat'])){
	if($_GET['lead_cat']=='seller'){
		include($app_key.'/model/Seller.php');
		$row1 = Seller::find($_GET['lead_id']);
	}elseif($_GET['lead_cat']=='buyer'){
		include($app_key.'/model/Buyer.php');
		$row1 = Buyer::find($_GET['lead_id']);
	}
	if(function_exists('date_default_timezone_set')) {
	    date_default_timezone_set("Asia/Kolkata");
	}
	$row = [
		'date'=>date('Y-m-d'),
		'name'=>$row1['name'],
		'phone_no'=>$row1['phone_no'],
		'whats_app_no'=>$row1['whats_app_no'],
		'member_type'=>'Agent',
		'property_category'=>'Rent',
		'address'=>$row1['address'],
		'comments'=>$row1['comments'],
	];
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php $vname='Member Form'; include($app_key.'/view/layouts/styles.php'); ?>
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
					<p style="font-weight: bold">Register with us</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p style="font-weight: bold; color:red"><?php echo $message; ?></p>
				</div>
			</div>
			<form method="post" action="/update_member">
			<input type="hidden" name="_token" value="<?php echo $rand; ?>"/>
			<?php if(!empty($_GET['view_rand'])): ?>
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<input type="hidden" name="view_rand" value="<?php echo $row['view_rand']; ?>"/>
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
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Email </label>
							<input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" id="email">
							<span class="error"><?php echo $error['email']; ?></span>
						</div>
					</div>
					<?php $row['member_type']=$row['member_type']??'Agent'; ?>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>I am </label>
							<select class="form-control" name="member_type">
								<?php foreach($mt as $l): ?>
						    	<option <?php echo $row['member_type']==$l?'selected':''; ?>><?php echo $l; ?></option>
					    		<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>I deal with</label>
							<select class="form-control" name="property_category">
								<?php foreach($mw as $l): ?>
						    	<option <?php echo $row['property_category']==$l?'selected':''; ?>><?php echo $l; ?></option>
					    		<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6 form-group">
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Location Area of my work</label>
							<textarea rows="3" class="form-control" name="address"><?php echo $row['address']; ?></textarea>
							<span class="error"><?php echo $error['address']; ?></span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Comments (Optional)</label>
							<textarea rows="3" class="form-control" name="comments"><?php echo $row['comments']; ?></textarea>
							<span class="error"><?php echo $error['comments']; ?></span>
						</div>
					</div>
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
</script>
</body>
</html>