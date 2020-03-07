	<?php 
	include($app_key.'/admin/model/Admin.php');
	$admins = Admin::where(null,null,'settings','sort:ORDER BY name',[]);
	if(!empty($_GET['selected_admin'])){
		$sa = Admin::find($_GET['selected_admin']);
	}else{
		$_GET['selected_admin'] = $_SESSION[$app_key]['id'];
		$sa = $_SESSION[$app_key];
	}
	$ps = [];
	$perm = [
	'p1'=>'View Dashboard',
	'p2'=>'View Follow Ups',
	'p3'=>'View Completed Client',
	'p4'=>'View IVR Details',
	'p5'=>'View Call Dialer',
	'p6'=>'View Customer Link Share',
	'p7'=>'View Mail Box',
	'p8'=>'View Reports',
	'p9'=>'View Favourites',
	'p10'=>'View Client Meeting',
	'p11'=>'View Admins',
	'p12'=>'View Settings',
	// 'p13'=>'Add New Lead',
	// 'p14'=>'Add New Member',
	// 'p15'=>'Forms Link Share',
	// 'p16'=>'Share On WhatsApp',
	// 'p17'=>'View Lead',
	// 'p18'=>'View Member',
	'p19'=>'Delete Lead',
	'p20'=>'Move To None Status',
	'p21'=>'Move To Client Meeting',
	'p22'=>'Move To Completed Clients',
	'p23'=>'Delete Customer Link Share',
	'p24'=>'Edit Lead',
	// 'p25'=>'Edit Member',
	'p26'=>'Update Lead Status & Comments',
	'p27'=>'Export Report To CSV',
	// 'p28'=>'p28',
	];
	foreach ($perm as $key => $value) {
		if($sa[$key]){
			$ps[]=$value;
		}
	}

	include($app_key.'/admin/model/Setting.php');
	$setting = Setting::find(1);
	$sm = json_decode($setting['social_media']);
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
	$pu = json_decode($setting['price_units']);
	$lu = json_decode($setting['land_units']);
	$lpu = json_decode($setting['land_per_unit']);
	$mt = json_decode($setting['member_types']);
	$mw = json_decode($setting['member_works']);
	$msg = json_decode($setting['messages'],true);
	if(!empty($_GET['selected_message'])){
		$smsg = $msg[$_GET['selected_message']];
	}else{
		foreach($msg as $key => $value) {
			$smsg = $value;break;
		}
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
		<style>
			.badge{
				padding: 10px; color: #333;background: white; border:1px solid #337ab7;font-weight: normal;
			}
			.badge > a{
				cursor:pointer;color:red;text-decoration:none;font-size:10px;font-weight:normal;margin-left:10px;
			}
		</style>
	</head>
	<body>
	<?php $active = 'settings'; include($app_key.'/admin/view/layouts/nav.php'); ?>
	<div id="main" class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h3>Settings</h3>
			</div>
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="/admin/home">Home</a></li>
					<li class="active">Settings</li>        
				</ol>
			</div>
		</div><hr>
		<div class="row">
			<div class="col-md-3 form-group">
				<label>Select Admin</label>
				<select id="id" class="form-control" onchange="getP()">
					<?php foreach($admins as $admin): ?>
					<option value="<?php echo $admin['id']; ?>" <?php echo $_GET['selected_admin']==$admin['id']?'selected':''; ?>><?php echo $admin['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-6 form-group">
				<label>Select Permission</label>
				<div class="input-group">
					<select id="pn" class="form-control" style="width: 200px">
						<?php foreach($perm as $key => $value): ?>
						<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php endforeach; ?>
					</select>
					<a class="btn btn-default" onclick="setP(1)">Add</a>
					<!-- <a class="btn btn-default" onclick="setP('del')">Remove</a> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Permissions</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($ps as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="setP(0,'<?php echo array_search($s,$perm); ?>')">X</a></div>
				<?php endforeach; ?>
			</div>
		</div><hr>
		<div class="row">
			<div class="col-md-12">
				<h5>Social Media</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($sm as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','social_media')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('social_media')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Sellable Properties</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($sp as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','sellable_properties')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('sellable_properties')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Rentable Properties</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($rp as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','rentable_properties')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('rentable_properties')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>BHK</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($bhk as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','bhk')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('bhk')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Properties of type BHK</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($pot_bhk as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','pot_bhk')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('pot_bhk')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Sites</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($sites as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','sites')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('sites')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Properties of type Sites</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($pot_sites as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','pot_sites')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('pot_sites')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Commercial Properties</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($cp as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','commercial_properties')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('commercial_properties')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Properties of type Commercial Properties</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($pot_cp as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','pot_commercial_properties')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('pot_commercial_properties')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Sell Prices</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($spz as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','sell_prices')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('sell_prices')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Rent Prices</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($rpz as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','rent_prices')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('rent_prices')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Price Units</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($pu as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','price_units')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('price_units')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Land Units</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($lu as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','land_units')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('land_units')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Land Per Unit</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($lpu as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','land_per_unit')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('land_per_unit')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Member Types</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($mt as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','member_types')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('member_types')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Member Works</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 form-group" >
				<?php foreach($mw as $s): ?>
				<div class="badge"><?php echo $s; ?> <a onclick="delS('<?php echo $s; ?>','member_works')">X</a></div>
				<?php endforeach; ?>
				<div class="badge" onclick="addNewS('member_works')" style="cursor: pointer;">Add Item</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h5>Messages</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 form-group">
				<select id="message" class="form-control" onchange="getM()">
					<?php foreach ($msg as $key => $value): ?>
					<option <?php echo $_GET['selected_message']==$key?'selected':''; ?>><?php echo $key; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-1 form-group">
				<a class="btn btn-primary" onclick="addNewM()">Save</a>
			</div>
			<div class="col-md-1 form-group">
				<a class="btn btn-primary" onclick="delM()">Delete</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5 form-group">
				<textarea rows="12" class="form-control" id="message_body"><?php echo $smsg; ?></textarea>
			</div>
		</div>
	</div>
	<script>
		function getM(){
			localStorage.setItem("scrollp", -document.querySelector("body").getBoundingClientRect().top);
			window.location = "<?php echo $app_url; ?>/admin/settings?selected_message="+$('#message').val();
		}
		function getP(){
			localStorage.setItem("scrollp", -document.querySelector("body").getBoundingClientRect().top);
			window.location = "<?php echo $app_url; ?>/admin/settings?selected_admin="+$('#id').val();
		}
		function setP(opr,name = null){
			$.post("/admin/set_permission",{"_token":"<?php echo $rand; ?>","id":"<?php echo $_GET['selected_admin']; ?>","name":name||$("#pn").val(),"opr":opr},function(data,status){
				if(status=='success'){
					localStorage.setItem("scrollp", -document.querySelector("body").getBoundingClientRect().top);
					window.location = window.location.href;
				}
			});
		}
		function addNewS(setting){
			name = prompt('Enter the social media name.');
			name = name.replace(/[^a-zA-Z0-9-_, ]/g, "");
			if(name){
				$.post("/admin/add_setting",{"_token":"<?php echo $rand; ?>","name":name,"setting":setting},function(data,status){
					if(status=='success'){
						localStorage.setItem("scrollp", -document.querySelector("body").getBoundingClientRect().top);
						window.location = window.location.href;
					}
				});
			}
		}
		function delS(name, setting){
			$.post("/admin/delete_setting",{"_token":"<?php echo $rand; ?>","name":name,"setting":setting},function(data,status){
				if(status=='success'){
					localStorage.setItem("scrollp", -document.querySelector("body").getBoundingClientRect().top);
					window.location = '<?php echo $app_url; ?>/admin/settings';
				}
			});
		}
		function addNewM(){
			name = prompt('Give name for message.');
			name = name.replace(/[^a-zA-Z0-9-_ ]/g, "");
			if(name){
				$.post("/admin/add_setting",{"_token":"<?php echo $rand; ?>","name":name,"message":$("#message_body").val(),"setting":"messages"},function(data,status){
					if(status=='success'){
						localStorage.setItem("scrollp", -document.querySelector("body").getBoundingClientRect().top);
						window.location = window.location.href;
					}
				});
			}
		}
		function delM(){
			delS($("#message").val(), 'messages');
		}
		document.documentElement.scrollTop=localStorage.getItem("scrollp");
	</script>
	</body>
	</html>