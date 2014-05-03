<fieldset class="col-md-4 sign-in-form">
	<legend>Sign up </legend>
<?php 
	echo form_open('',array('class' => 'form-horizontal'));

	echo input_text('text','username','Username');
	echo input_text('text','email','Email');
	echo input_text('password','password','Password');
	echo input_text('password','password_confirmation','Password Confirmation');
	echo input_button(form_submit('signup', 'Sign up!',"class='btn btn-success'").anchor(site_url(), 'Cancel', "class='btn btn-info mrgn_left'"));
	
	
?>
</fieldset>