<?php 
	foreach ($albums->result() as $album) {
?>		
<div class="col-md-10 thumbnail_container">
<h3><?php echo $album->title ?><b><?php echo anchor('/albums/'.$album->id,"(Show\Edit Album)",array('class'=>'relative_more')); ?></b></h3>
<?php 
	foreach ($album->photos as $photo) {
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
<?php
	}
?>