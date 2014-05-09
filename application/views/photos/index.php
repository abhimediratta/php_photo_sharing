<h2>My photos</h2>
<div class="col-md-10 thumbnail_container">
<?php 
	foreach ($photos as $photo) {
?>
  	<div class="relative_thumbnail">
  		<?php echo anchor($photo['photo_url'], cl_image_tag($photo['photo_url'], array( "width" => 150, "height" => 150, "crop" => "pad" )),array('class'=>'swipebox')); ?>
  		<?php echo anchor('/photos/edit/'.$photo['id'],"Edit Caption",array('class'=>'relative_edit')); ?>
  		<?php echo anchor('/photos/delete/'.$photo['id'],"Delete",array('class'=>'relative_delete delete')); ?>
  		<span class="relative_caption"><?php echo $photo['caption'] ?></span>
  	</div>
<?php
	}
?>
</div>

<div class="col-md-4" style="margin-top:5%;">
	<span class="btn-mrgn btn-fb-login share_album">
	    <span class="icon icon-fb"></span>
	    <span class="title">Share on Facebook</span>
	</span>
	
	<?php echo anchor('/photos/new',form_button('new','Add New Photos','class="btn-mrgn btn btn-info new_photo_btn"')); ?>
</div>
<span id="shared_album_id"></span>