<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("bootstrap/css/bootstrap.min.css");?>">
</head>
<style type="text/css">
	.val
</style>
<body><br><br>
	<div class="col-md-4 offset-4">
		<div class="card text-center">
			<div class="card-header">Enter credentials</div>
			<div class="card-body">
				<form method="post" action="<?php echo base_url("login/validate");?>">
					<input type="text" name="name" class="form-control" placeholder="Name"><br>
					<span class="text-danger"><?php echo form_error('name')?>
					<input type="text" class="form-control" name="username" placeholder="Username"><br>
					<span class="text-danger"><?php echo form_error("username")?></span>
					<input type="email" class="form-control" name="email" placeholder="Email"><br>
					<span class="text-danger"><?php echo form_error("email")?></span>
					<input type="password" class="form-control" name="password" placeholder="Password"><br>
					<span class="text-danger"><?php echo form_error("password")?></span>
					<input type="password" class="form-control" name="cpassword" placeholder="Confirm Password"><br>
					<span class="text-danger"><?php echo form_error("cpassword")?></span><br>
				<span class="alert-danger" style="padding: 10px;">Name,Username should be alphanumeric</span><br><br>
					<input type="submit" class="btn btn-primary" name="submit" value="Register">
				</form>
					<a style="margin-left: 20px;" class="btn btn-secondary" href="<? echo base_url(); ?>">Login here</a>
			</div>
		</div>
	</div>
</body>
</html>