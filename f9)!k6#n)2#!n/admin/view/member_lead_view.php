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
						<h3>Member</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Date</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['date']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Name</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['name']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Phone</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['phone_no']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>WhatsApp No.</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['whats_app_no']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Email</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['email']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Location of work</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['address']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Member Type</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['member_type']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Category of work</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['property_category']; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<label>Member Comments</label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $row['comments']; ?>
					</div>
				</div>
				<h6 style="border-bottom: 1px solid grey">Admin</h6>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Status</label>
					</div>
					<div class="col-md-6">
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
					<div class="col-md-6">
						<input type="datetime-local" class="form-control" name="status_date" value="<?php echo date('Y-m-d\TH:i'); ?>" />
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-5">
						<label>Comment</label>
					</div>
					<div class="col-md-6">
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
						<label><?php echo $ca['auth']; ?> - <?php echo $ca['date']; ?></label>
					</div>
					<div class="col-md-6 well well-sm">
						<?php echo $ca['comment']; ?>
					</div>
				</div>
				<?php endforeach; ?>
			</form>
		</div>
	</div>
</div>
</body>
</html>