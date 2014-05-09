<fieldset class="col-md-4 sign-in-form">
	<legend>Edit Details</legend>
	<?php 
		echo validation_errors();
		echo form_open('users/update_user',array('class' => 'form-horizontal'));
		echo form_hidden('id', $user->id);
		echo edit_input_text('text','name','Name',$user->name);
		echo edit_input_text('email','email','Email',$user->email);
		echo input_text('password','password','Password',6);
		echo input_text('password','password_confirmation','Password Confirmation',6);
		echo input_button(form_submit('update', 'Update',"class='btn btn-success'").anchor('photo_sharing/photos', 'Cancel', "class='btn btn-info mrgn_left'"));
		echo form_close();
	?>
</fieldset>