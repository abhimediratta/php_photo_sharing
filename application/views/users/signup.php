<fieldset class="col-md-4 sign-in-form">
	<legend>Sign up </legend>
<?php 
	
	echo validation_errors();
	echo form_open('users/add_user',array('class' => 'form-horizontal'));

	echo input_text('text','name','Name');
	echo input_text('email','email','Email');
	echo input_text('password','password','Password',6);
	echo input_text('password','password_confirmation','Password Confirmation',6);
	echo input_button(form_submit('signup', 'Sign up!',"class='btn btn-success'").anchor(site_url(), 'Cancel', "class='btn btn-info mrgn_left'"));
	
	echo form_close();
?>
</fieldset>