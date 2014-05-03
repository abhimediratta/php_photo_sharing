<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
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
	</style>
</head>
<body>
	<?php $this->load->view('view_header'); ?>

	<div class="container">
		<?php $this->load->view($main_content); ?>
	</div>
	<?php $this->load->view('view_footer'); ?>

</body>
</html>