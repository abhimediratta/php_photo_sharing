<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url() ?>favicon.ico" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		.mrgn_left{
			margin-left: 2em;
		}
		.mrgn_bottom{
			margin: 0 0 1em 0;
		}
	</style>
</head>
<body>
	<?php 
		if (isset($user)) {
			$data['user']=$user;
			$this->load->view('view_header',$data);
		}
		else{
			$this->load->view('view_header');	
		}
		 
	?>

	<div class="container">
		<?php $this->load->view($main_content); ?>
	</div>
	<?php $this->load->view('view_footer'); ?>

</body>
</html>