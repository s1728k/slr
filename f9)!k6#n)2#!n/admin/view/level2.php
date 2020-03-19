<?php include($app_key.'/include/csrf_token.php'); ?>
<?php 
include($app_key.'/model/Seller.php');
include($app_key.'/model/Buyer.php');
include($app_key.'/admin/model/Setting.php');
$setting = Setting::find(1);
$sp = json_decode($setting['sellable_properties']);
$bhk = json_decode($setting['bhk']);
$sites = json_decode($setting['sites']);
$cp = json_decode($setting['commercial_properties']);
$pot_bhk = json_decode($setting['pot_bhk']);
$pot_sites = json_decode($setting['pot_sites']);
$pot_cp = json_decode($setting['pot_commercial_properties']);

foreach ($sp as $v) {
	if(in_array($v, $pot_bhk)){
		$dict[$v] = 'bhk';
	}elseif(in_array($v, $pot_sites)){
		$dict[$v] = 'sites';
	}elseif(in_array($v, $pot_cp)){
		$dict[$v] = 'cp';
	}
}

$pr = ${$dict[$_GET['p2']]};

if(strpos($_GET['p1'],'Seller')===0){
	$sb = 'seller';
}else{
	$sb = 'buyer';
}
if(strpos($_GET['p1'],'Agent')>0){
	$ad = 'agent';
}else{
	$ad = 'direct';
}
if(strpos($_GET['p1'],'Rent')>0){
	$sr = 'rent';
}else{
	if($sb=='seller'){
		$sr = 'sell';
	}else{
		$sr = 'buy';
	}
}
foreach ($pr as $p) {
	if($sb=='seller'){
		$level2[$p] = Seller::where(null,null,null,'count',[
			'id' => $_GET['cid'],
			'social_media' => $_GET['social_media'],
			'sr_type'=>$sr,
			'lead_type'=>$ad,
			'property_category'=>$_GET['p2'],
			'property_type'=>$p,
		]);
	}else{
		$level2[$p] = Buyer::where(null,null,null,'count',[
			'id' => $_GET['cid'],
			'social_media' => $_GET['social_media'],
			'br_type'=>$sr,
			'lead_type'=>$ad,
			'property_category'=>$_GET['p2'],
			'property_type'=>$p,
		]);
	}
}
$sc = "sterm=".$_GET['sterm']."&cid=".$_GET['cid']."&social_media=".$_GET['social_media'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
	<style>
		.c_container{
			height: 100px;
			width: 100%;
			border-radius: 10px;
			position: relative;
			padding: 15px;
			background-color: lightblue;
		}
		.c_container > span{
			display: inline-block;font-weight: bold;font-size: 25px;transform: scale(1, 2);
		}
		.btn-cc{
			position: absolute;
			bottom: 0px;
			left:0px;
			border-bottom-left-radius: 10px;
			border-bottom-right-radius: 10px;
			background: #007bff;
			color:white;
			width: 100%;
			text-align: center;
			cursor: pointer;
		}
	</style>
</head>
<body>
<?php $active = 'dashboard'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3><?php echo $_GET['p2']; ?></h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home?<?php echo $sc; ?>">Home</a></li>
				<li><a href="/admin/home?<?php echo $sc; ?>">Dashboard</a></li>
				<li><a href="/admin/level1?p1=<?php echo $_GET['p1']; ?>&<?php echo $sc; ?>"><?php echo $_GET['p1']; ?></a></li>
				<li class="active"><?php echo $_GET['p2']; ?></li>
			</ol>
		</div>
	</div><hr>
	<div class="row">
		<form id="sform" method="get" action="/admin/level2">
		<div class="col-md-3 form-group">
			<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
		</div>
		</form>
	</div>
	<div class="row">
		<?php foreach($pr as $p): ?>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $level2[$p]; ?></span><br>
				<?php echo $p; ?>
				<a class="btn-cc" href="/admin/filtered_leads?p1=<?php echo $_GET['p1']; ?>&p2=<?php echo $_GET['p2']; ?>&p3=<?php echo urlencode($p); ?>&<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<script>
	$(".sc").on('change',function(){
		$("#sform").submit();
	});
</script>
</body>
</html>