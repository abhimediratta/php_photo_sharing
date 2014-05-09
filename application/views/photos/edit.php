<fieldset class="col-md-4 sign-in-form">
	<legend>Edit Details</legend>
	<?php echo anchor($photo['photo_url'], cl_image_tag($photo['photo_url'], array( "width" => 150, "height" => 150, "crop" => "pad" )),array('class'=>'swipebox')); 
		echo form_open('photos/update_photo',array('class' => 'form-horizontal'));
		echo form_hidden('id', $photo['id']);
		echo edit_input_text('text','caption','Add caption',$photo['caption']);
		echo input_button(form_submit('update', 'Update',"class='btn btn-success'").anchor('photo_sharing/photos', 'Cancel', "class='btn btn-info mrgn_left'"));
		echo form_close();
	?>
</fieldset>