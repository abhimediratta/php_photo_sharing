<fieldset class="col-md-10 clear">
	<legend>Add Photos</legend>
<?php 
	
	echo validation_errors();
	echo form_open_multipart('albums/upload',array('class'=>'dropzone','id' => 'image_upload'));
	echo form_hidden('album_id', $album_id);
?>
	<div class="fallback">
    	<input type="file" name="file" multiple/>
  	</div>
</form>
<?php
	echo form_close();
?>
</fieldset>



<div class="col-md-10 thumbnail_container display_album">
<h3>Album Photos</h3>
<?php 
	foreach ($album_photos as $photo) {
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
	
</div>
			
<span id="shared_album_id"><?php echo $shared_album_id ?></span>