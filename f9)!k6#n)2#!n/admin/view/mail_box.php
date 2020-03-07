<?php include($app_key.'/include/csrf_token.php'); ?>
<?php
include('env.php');
$mbox = imap_open($email_host,$email_username,$email_password) or die('Cannot connect to Gmail: ' . imap_last_error());
// $MC = imap_check($mbox);
$folders = imap_listmailbox($mbox, $email_host, "*");

$farr = ['Inbox'=>0,'Sent'=>2,'Drafts'=>4,'Junk'=>3,'Trash'=>1,'Archieved'=>0,];
$_GET['mbox'] = $_GET['mbox']??'Inbox';
$inbox = imap_open($folders[$farr[$_GET['mbox']]],$email_username,$email_password);
// $trash = imap_open($folders[1],$email_username,$email_password);
// $sent = imap_open($folders[2],$email_username,$email_password);
// $junk = imap_open($folders[3],$email_username,$email_password);
// $drafts = imap_open($folders[4],$email_username,$email_password);

$emails = imap_search($inbox,'ALL');

// if($emails) {
	
// 	$output = '';
// 	/*newest emails */
// 	rsort($emails);
	
// 	/* for every email... */
// 	foreach($emails as $email_number) {
		
// 		/* get information specific to this email */
// 		$overview = imap_fetch_overview($inbox,$email_number,0);
// 		$message = imap_fetchbody($inbox,$email_number,2);
		
// 		/* output the email header information */
// 		$seen= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
// 		$subject= '<span class="subject">'.$overview[0]->subject.'</span> ';
// 		$from= '<span class="from">'.$overview[0]->from.'</span>';
// 		$date= '<span class="date">on '.$overview[0]->date.'</span>';
// 		$output.= '</div>';
		
// 		/* output the email body */
// 		$output.= '<div class="body">'.$message.'</div>';
// 	}
	

// } 

/* close the connection */
// imap_close($inbox);

$pageno = $_GET['pageno']??1;
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil(count($emails) / $no_of_records_per_page);
// $result = imap_fetch_overview($inbox,($offset+1).":".min($MC->Nmsgs,($offset+$no_of_records_per_page)),0);
$result = imap_fetch_overview($inbox,implode(',',array_slice($emails, $offset, $no_of_records_per_page)),0);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include($app_key.'/admin/view/layouts/styles.html'); ?>
	<style>
		.box_btn{
			padding: 20px;
		}
	</style>
</head>
<body>
<?php $active = 'mail_box'; include($app_key.'/admin/view/layouts/nav.php'); ?>
<div id="main" class="container-fluid">
	<form method="get" action="/admin/mail_box">
	<input type="hidden" id="pageno" name="pageno" value="<?php echo $_GET['pageno']; ?>"/>
	<div class="row form-group">
		<div class="col-md-12">
			<button class="btn btn-primary box_btn" style="margin-right: 30px">
				<i class="fa fa-inbox"></i> Compose
			</button>
			<button class="btn btn-default box_btn" name="mbox" value="Inbox" onclick="setp('Inbox')">
				<i class="fa fa-inbox"></i> Inbox
			</button>
			<button class="btn btn-default box_btn" name="mbox" value="Sent" onclick="setp('Sent')">
				<i class="fa fa-envelope-o"></i> Sent
			</button>
			<button class="btn btn-default box_btn" name="mbox" value="Drafts" onclick="setp('Drafts')">
				<i class="fa fa-file-text-o"></i> Drafts
			</button>
			<button class="btn btn-default box_btn" name="mbox" value="Junk" onclick="setp('Junk')">
				<i class="fa fa-filter"></i> Junk
			</button>
			<button class="btn btn-default box_btn" name="mbox" value="Trash" onclick="setp('Trash')">
				<i class="fa fa-trash-o"></i> Trash
			</button>
			<button class="btn btn-default box_btn" name="mbox" value="Archieved" onclick="setp('Archieved')">
				<i class="fa fa-star"></i> Archieved
			</button>
		</div>
	</div>
	</form>
<!-- 	<div class="row">
		<div class="col-md-6">
			<h3>Inbox</h3>
		</div>
		<div class="col-md-6">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Inbox</li>        
			</ol>
		</div>
	</div><hr> -->
	<div class="box_form">
		<div class="row form_heading form-group">
			<div class="col-md-12">
				<h3><?php echo $_GET['mbox']; ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-default"><input type="checkbox" /></button>
				<button class="btn btn-default"><i class="fa fa-trash-o"></i></button>
				<button class="btn btn-default"><i class="fa fa-reply"></i></button>
				<button class="btn btn-default"><i class="fa fa-share"></i></button>
				<button class="btn btn-default"><i class="fa fa-refresh"></i></button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<?php foreach($result as $email): ?>
					<tr>
						<td><input type="checkbox" /></td>
						<td><?php echo $email->from ?></td>
						<td><?php echo $email->subject ?></td>
						<td><?php echo $email->date ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<div class="col-md-12">
				<?php include($app_key.'/admin/view/layouts/admin_pagination.php') ?>
			</div>
		</div>
	</div>
</div>
<script>
	var ct = "<?php echo $_GET['mbox']; ?>";
	function setp(val){
		if(val!=ct){
			$('input[name ="pageno"]').val(1);
		}
	}
</script>
</body>
</html>