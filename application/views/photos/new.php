<fieldset class="col-md-10">
	<legend>Sign up </legend>
<?php 
	
	echo validation_errors();
	echo form_open_multipart('photos/upload',array('class'=>'dropzone','id' => 'image_upload'));
?>
	<div class="fallback">
    	<input type="file" name="file" multiple/>
  	</div>
</form>
<?php
	echo form_close();
?>
</fieldset>