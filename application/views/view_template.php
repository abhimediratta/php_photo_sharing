<!DOCTYPE html>
<html lang="en">
<head>
	<!-- <meta charset="utf-8"> -->
	<title><?php echo $title ?></title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url() ?>favicon.ico" />

	
	<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/css/dropzone.css"> -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/css/basic.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/application.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/swipebox.min.css">
	


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/3.8.4/dropzone.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>js/application.js"></script>

	<style type="text/css">
		.mrgn_left{
			margin-left: 2em;
		}
		.mrgn_bottom{
			margin: 0 0 1em 0;
		}
	</style>
</head>
<?php 
			if (isset($photos)) {
				$data['photos']=$photos;
				
			}
			if (isset($photo)) {
				$data['photo']=$photo;
			}

			if (isset($user)) {
				$data['user']=$user;
			}

			if (isset($album_id)) {
				$data['album_id']=$album_id;
			}
			if (isset($album_photos)) {
				$data['album_photos']=$album_photos;
			}
			if (isset($albums)) {
				$data['albums']=$albums;
			}
			$data['']='';
?>


<body>
	<?php 
		$this->load->view('view_header',$data);
	?>

	<div class="container">
		<?php 
			if ($this->session->flashdata('danger')) {
				echo '<div class="bg-danger">'.$this->session->flashdata('danger').'</div>';
			}
			else if($this->session->flashdata('success')){
				echo '<div class="bg-success">'.$this->session->flashdata('success').'</div>';;
			}
				
		?>
		<?php 
			$this->load->view($main_content,$data);
		?>

	</div>
	<?php $this->load->view('view_footer'); ?>
<script type="text/javascript" src="<?php echo asset_url();?>js/jquery.swipebox.min.js"></script>
</body>
</html>