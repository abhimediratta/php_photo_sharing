<fieldset class="col-md-10">
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