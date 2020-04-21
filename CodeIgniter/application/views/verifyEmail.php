<!DOCTYPE html>
<html>
<head>
	<title>Verify Email</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("bootstrap/css/bootstrap.min.css");?>">
</head>
<body><br><br>
	<div class="col-md-4 offset-4">
		<div class="card text-center">
			<div class="card-header">Enter OTP</div>
			<div class="card-body">
				<form class="" method="post" action="<?php echo base_url("login/verifyOtp");?>">
					<input type="text" class="form-control" name="otp" placeholder="OTP"><br>
					<span class="text-danger"><?php echo form_error("otp")?></span>
					<input type="submit" class="btn btn-primary al-center" name="submit" value="Submit">
				<a style="margin-left: 20px;" class="btn btn-secondary" href="<?php echo base_url("login/sendEmail");?>">Resend OTP</a>
				</form><br>
				<a class="btn btn-danger" href="<?php echo base_url("home/logout");?>">Logout</a>
			</div>
		</div>
	</div>
</body>
</html>