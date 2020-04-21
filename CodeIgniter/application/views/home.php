<?php
	if(!$_SESSION['name']){
		redirect(base_url());
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("bootstrap/css/bootstrap.min.css");?>">
</head>
<body><br><br>
	<div class="col-md-4 offset-4">
		<div class="card text-center">
			<div class="card-header">User Details</div>
			<div class="card-body">
				<?php
					$data=(array)$data[0];
					$head=array_keys($data);
					$n=count($data);
					for($i=0;$i<$n;$i++)
				    	echo "<p>".$head[$i]."::".$data[$head[$i]]."</p>";
				?>
				<form method="post" action="<?php echo base_url('home/logout');?>">
					<input type="submit" name="submit" value="Logout" class="btn btn-danger">
				</form>
			</div>
		</div>
	</div>
</body>
</html>