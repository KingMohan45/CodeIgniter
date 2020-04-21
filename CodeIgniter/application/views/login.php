<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("bootstrap/css/bootstrap.min.css");?>">
</head>
<body><br><br>
	<div class="col-md-4 offset-4">
		<div class="card text-center">
			<div class="card-header">Enter credentials</div>
			<div class="card-body">
				<form class="" method="post" action="<?php echo base_url("login/isUser");?>">
					<input type="text" class="form-control" name="username" placeholder="Unsername"><br>
					<span class="text-danger"><?php echo form_error("username")?></span>
					<input type="password" class="form-control" name="password" placeholder="Password"><br>
					<sapn class="text-danger"><?php echo form_error("password");
													echo "<p>".$_SESSION['error']."</p>";
													$_SESSION['error']='';?>
					</sapn><br>
					<input type="submit" class="btn btn-primary al-center" name="submit" value="Submit">
				<a style="margin-left: 20px;" class="btn btn-secondary" href="<?php echo base_url("login/register");?>">Register</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>