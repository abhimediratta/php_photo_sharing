<fieldset class="col-md-4 sign-in-form">
	<legend>Create Album</legend>
<?php 
	
	echo validation_errors();
	echo form_open('albums/add_album',array('class' => 'form-horizontal'));

	echo input_text('text','title','Title');
	echo input_button(form_submit('create_album', 'Create',"class='btn btn-success'").anchor(site_url(), 'Cancel', "class='btn btn-info mrgn_left'"));
	
	echo form_close();
?>
</fieldset>