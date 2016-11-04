<!DOCTYPE html>
<html lang="">
	<head>
	 	<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
	</head>
	<body>

	<div class="container">
		<div class="row">
		
				<div class="panel">
					<?php if (validation_errors()) : ?>
					<div class="alert alert-danger" role="alert">
						<?= validation_errors() ?>
					</div>
					<?php endif; ?>
					<?php if (isset($error)) : ?>
					<div class="alert alert-danger" role="alert">
						<?= $error ?>
					</div>
				<?php endif; ?>
			
				<div class="col-md-6 box-login col-md-offset-3">
					<div class="page-header">
						<h1 class="bold">Log In</h1>
					</div>
					<form method="post" action="<?=base_url();?>login/validate">
						 <div class="form-group">
							<label for="Username">Username/Email</label>
							<input type="text" class="form-control" id="Username" placeholder="Username" name="username">
						 </div>
						 <div class="form-group">
							<label for="Password">Password</label>
							<input type="password" class="form-control" id="Password" placeholder="Password" name="password">
						 </div>
						 
						 <div class="form-group">
							<input type="reset" value="Cancel" class="btn btn-danger">
							<input type="submit" value="Login" class="btn btn-primary">
						 </div>
					</form>
					<p><a href="<?=base_url();?>login/register">Register</a> | <a href="<?=base_url();?>login/list_user">List</a></p>
				</div>
					
			</div>
		</div>
	</div>

		<!-- jQuery -->
		<script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo base_url()?>public/js/bootstrap.js"></script>
	</body>
</html>