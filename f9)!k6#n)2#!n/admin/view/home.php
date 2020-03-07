<?php include($app_key.'/include/csrf_token.php'); ?>
<?php 
include('env.php');
include($app_key.'/model/Seller.php');
include($app_key.'/model/Buyer.php');
include($app_key.'/model/Member.php');
include($app_key.'/admin/model/Setting.php');

$seller_direct_owner = Seller::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'sr_type'=>'sell',
	'lead_type'=>'direct',
]);
$seller_agent_owner = Seller::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'sr_type'=>'sell',
	'lead_type'=>'agent',
]);
$buyer_direct_owner = Buyer::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'br_type'=>'buy',
	'lead_type'=>'direct',
]);
$buyer_agent_owner = Buyer::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'br_type'=>'buy',
	'lead_type'=>'agent',
]);
$seller_direct_rent = Seller::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'sr_type'=>'rent',
	'lead_type'=>'direct',
]);
$seller_agent_rent = Seller::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'sr_type'=>'rent',
	'lead_type'=>'agent',
]);
$buyer_direct_rent = Buyer::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'br_type'=>'rent',
	'lead_type'=>'direct',
]);
$buyer_agent_rent = Buyer::where(null,null,null,'count',[
	'id' => $_GET['cid'],
	'social_media' => $_GET['social_media'],
	'br_type'=>'rent',
	'lead_type'=>'agent',
]);

$setting = Setting::find(1);
$member_types = json_decode($setting['member_types']);
foreach ($member_types as $type) {
	$member[$type] = Member::where(null,null,null,'count',[
		'id' => $_GET['cid'],
		'social_media' => $_GET['social_media'],
		'member_type' => $type,
	]);
}


$social_media = json_decode($setting['social_media']);
$sc = "&sterm=".$_GET['sterm']."&cid=".$_GET['cid']."&social_media=".$_GET['social_media'];
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
			<h3>Dashboard</h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="/admin/home?<?php echo $sc; ?>">Home</a></li>
				<li class="active">Dashboard</li>        
			</ol>
		</div>
	</div><hr>
	<div class="row">
		<form id="sform" method="get" action="/admin/home">
		<div class="col-md-3 form-group">
			<input type="text" class="form-control sc" placeholder="Search" name="sterm" value="<?php echo $_GET['sterm']; ?>">
		</div>
		<div class="col-md-2 form-group">
			<input type="number" class="form-control sc" placeholder="Customer ID" name="cid" value="<?php echo $_GET['cid']; ?>">
		</div>
		<div class="col-md-2 form-group">
			<select class="form-control sc" name="social_media">
				<option value="" <?php echo $_GET['social_media']==''?'selected':''; ?>>All</option>
				<?php foreach($social_media as $sm): ?>
				<option <?php echo $_GET['social_media']==$sm?'selected':''; ?>><?php echo $sm; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		</form>
		<div class="col-md-5 form-group text-right">
			<button class="btn btn-primary" onclick="showLeadSelectDialog()">Add New Lead</button>
			<button class="btn btn-primary" onclick="newMembershipForm()">Add New Member</button>
			<button class="btn btn-primary" onclick="showWsdialog()">Forms Link Share</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $seller_direct_owner; ?></span><br>
				Seller(Owner)
				<a class="btn-cc" href="/admin/level1?p1=Seller(Owner)<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $seller_agent_owner; ?></span><br>
				Seller Agent
				<a class="btn-cc" href="/admin/level1?p1=Seller Agent<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $buyer_direct_owner; ?></span><br>
				Buyer
				<a class="btn-cc" href="/admin/level1?p1=Buyer<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $buyer_agent_owner; ?></span><br>
				Buyer Agent
				<a class="btn-cc" href="/admin/level1?p1=Buyer Agent<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $seller_direct_rent; ?></span><br>
				Seller Rent
				<a class="btn-cc" href="/admin/level1?p1=Seller Rent<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $seller_agent_rent; ?></span><br>
				Seller Agent Rent
				<a class="btn-cc" href="/admin/level1?p1=Seller Agent Rent<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $buyer_direct_rent; ?></span><br>
				Buyer Rent
				<a class="btn-cc" href="/admin/level1?p1=Buyer Rent<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $buyer_agent_rent; ?></span><br>
				Buyer Agent Rent
				<a class="btn-cc" href="/admin/level1?p1=Buyer Agent Rent<?php echo $sc; ?>">View Details</a>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<?php foreach($member_types as $type): ?>
		<div class="col-md-3 form-group">
			<div class="c_container">
				<span><?php echo $member[$type]; ?></span><br>
				<?php echo $type; ?>
				<a class="btn-cc" href="/admin/level1?p1=<?php echo $type; ?><?php echo $sc; ?>">View Details</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<script>
	$(".sc").on('change',function(){
		$("#sform").submit();
	});
	function showWsdialog(){
		$("#contact_info").prop('checked',false);
		$("#location_info").prop('checked',false);
		$("#status_info").prop('checked',false);
		$("#wsdialog").modal();
	}
	function shareOnWhatsApp(){
		var sws = [];
		$( ".sws" ).each(function() {
			if($(this).prop('checked')){
				sws.push($(this).attr("id"));
			}
		});

		var whats_app_no = $('[name="whats_app_no"]').val();
		var path = $('[name="form_name"]:checked').val();
		var whatsappmessage = '<?php echo $app_url; ?>'+path;
		window.open('whatsapp://send?phone='+whats_app_no+'&text='+whatsappmessage);
	}
	function newMembershipForm(){
		window.open("<?php echo $app_url; ?>/member", '_blank');
	}
	function showLeadSelectDialog(){
		$("#lsdialog").modal();
	}
	function createLeadId(){
		var lead_name = $('[name="lead_name"]:checked').val();
		var social_media = $('[name="social_media2"]').val();
		var page = lead_name.split('_');
		$.post('/create_form_id',{"_token":"<?php echo $rand; ?>",'page':page[0],'agent':page[1],'social_media':social_media},function(data,status){
			if(status=='success'){
				window.open("<?php echo $app_url; ?>/edit_"+page[0]+"/"+data, '_blank');
			}
		});
	}
</script>


<div id="wsdialog" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content" style="border-radius: 0px;">
    	<div method="post" action="/admin/share_customer_link" class="box_form">
			<input type="hidden" name="_token" value="<?php echo $rand ?>">
			<input type="hidden" name="shared_props" id="shared_props">
			<div class="row form_heading">
				<div class="col-md-12">
					<h3>Forms Link Share</h3>
				</div>
			</div><br>
			<div class="row form-group">
				<div class="col-md-12">
					<label>WhatsApp Number</label>
					<input type="number" class="form-control" name="whats_app_no" />
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<label style="font-weight: normal"><input type="radio" name="form_name" value="/"> Lead Form</label><br>
					<label style="font-weight: normal"><input type="radio" name="form_name" value="/member"> Membership Form</label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" data-dismiss="modal" class="btn btn-primary" onclick="shareOnWhatsApp()">
				</div>
			</div>
		</div>
    </div>

  </div>
</div>

<div id="lsdialog" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content" style="border-radius: 0px;">
    	<div class="box_form">
			<div class="row form_heading">
				<div class="col-md-12">
					<h3>Select Form</h3>
				</div>
			</div><br>
			<div class="row form-group">
				<div class="col-md-12">
					<label>Social Media Referrance</label>
					<select class="form-control" name="social_media2">
						<?php foreach($social_media as $sm): ?>
						<option><?php echo $sm; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-12">
					<label>Select The Form</label><br>
					<label style="font-weight: normal"><input type="radio" checked name="lead_name" value="seller_direct"> Seller</label><br>
					<label style="font-weight: normal"><input type="radio" name="lead_name" value="seller_agent"> Seller Agent</label><br>
					<label style="font-weight: normal"><input type="radio" name="lead_name" value="buyer_direct"> Buyer</label><br>
					<label style="font-weight: normal"><input type="radio" name="lead_name" value="buyer_agent"> Buyer Agent</label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="submit" data-dismiss="modal" class="btn btn-primary" onclick="createLeadId()">
				</div>
			</div>
		</div>
    </div>

  </div>
</div>
</body>
</html>
