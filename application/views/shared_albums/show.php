<div class="col-md-10 thumbnail_container">
<h3>Album Photos</h3>
<?php 
	foreach ($album_photos as $photo) {
?>
  	<div class="relative_thumbnail">
  		<?php echo anchor($photo['photo_url'], cl_image_tag($photo['photo_url'], array( "width" => 150, "height" => 150, "crop" => "pad" )),array('class'=>'swipebox')); ?>
  		<span class="relative_caption"><?php echo $photo['caption'] ?></span>
  	</div>
<?php
	}
?>
</div>