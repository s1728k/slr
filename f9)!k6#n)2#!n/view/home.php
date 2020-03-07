<?php include($app_key.'/include/csrf_token.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<?php $vname='Forms Home'; include($app_key.'/view/layouts/styles.php'); ?>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<img src="assets/logo.jpg" class="pull-right"  id="logo_desktop_home">
		</div>
	</div>
</div>
<div class="container-fluid hidden-xs">
	<div class="row">
		<div class="col-md-12">
        	<img src="assets/banner_1.jpg" style="width: 100%">
        </div>
    </div>
</div>
<div class="container-fluid hidden-md  hidden-lg  hidden-sm">
	<div class="row">
        <img id="banner" src="assets/mob_banners.png" style="width: 100%;  height: 45vh">
    </div>
</div>
<br class="hidden-xs">
<div class="container-fluid" id="thumbnails">
	<div class="row">
		<div class="col-md-3 col-xs-6 padding0" style="cursor: pointer;" onclick="gotoPage('seller','direct')">
			<div class="btn_image1" style="padding: 2px;width: 100%;">
				<img src="assets/s.png" style="width: 100%">
				<p class="caption">Seller</p>
			</div>
		</div>
		<div class="col-md-3 col-xs-6 padding0" style="cursor: pointer;" onclick="gotoPage('buyer','direct')">
			<div class="btn_image1" style="padding: 2px;width: 100%">
				<img src="assets/b.png" style="width: 100%">
				<p class="caption">Buyer</p>
			</div>
		</div>
		<div class="col-md-3 col-xs-6 padding0" style="cursor: pointer;" onclick="gotoPage('seller','agent')">
			<div class="btn_image1" style="padding: 2px;width: 100%">
				<img src="assets/sa.png" style="width: 100%">
				<p class="caption">Seller Agent</p>
			</div>
		</div>
		<div class="col-md-3 col-xs-6 padding0" style="cursor: pointer;" onclick="gotoPage('buyer','agent')">
			<div class="btn_image1" style="padding: 2px;width: 100%">
				<img src="assets/ba.png" style="width: 100%">
				<p class="caption">Buyer Agent</p>
			</div>
		</div>
	</div>
</div>
<script>
	function gotoPage(page,agent){
		window.location = "<?php echo $app_url; ?>"+page+"/"+agent;
	}
</script>
</body>
</html>