<!DOCTYPE html>
<html lang="">
	<head>
	 	<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>List Admin/User</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
	</head>
	<body>

		<div class="container">
			<div class="row">
				
				
				<div class="col-md-6 box-register col-md-offset-3">
					<div class="page-header">
						<h1>List Admin</h1>
					</div>
					
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Username</th>
						  <th>Email</th>
						  <th>Action</th>
						</tr>
					  </thead>
					  <tbody>
					  <?php $no=0;foreach ($admin as $a):$no++?>
						<tr>
						  <th scope="row"><?=$no;?></th>
						  <td><?=$a->username;?></td>
						  <td><?=$a->email;?></td>
						  <td><a href="<?=base_url();?>login/admin_edit/<?=$a->id;?>">Edit</a> | <a href="<?=base_url();?>login/admin_delete/<?=$a->id;?>">Hapus</a></td>
						</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
				
				<div class="col-md-6 box-register col-md-offset-3">
					<div class="page-header">
						<h1>List User</h1>
					</div>
					
					<table class="table table-striped">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Username</th>
						  <th>Email</th>
						  <th>Action</th>
						</tr>
					  </thead>
					  <tbody>
					  <?php $no1=0;foreach ($user as $u):$no1++?>
						<tr>
						  <th scope="row"><?=$no1;?></th>
						  <td><?=$u->username;?></td>
						  <td><?=$u->email;?></td>
						  <td><a href="<?=base_url();?>login/user_edit/<?=$u->id;?>">Edit</a> | <a href="<?=base_url();?>login/user_delete/<?=$u->id;?>">Hapus</a></td>
						</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</div>
				
				
			</div><!-- .row -->
		</div><!-- .container -->

		<!-- jQuery -->
		<script src="<?php echo base_url();?>public/js/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo base_url()?>public/js/bootstrap.js"></script>
	</body>
</html>