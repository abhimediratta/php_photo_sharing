<fieldset class="col-md-4 sign-in-form">
	<legend>Login to start sharing!</legend>
<?php 
	echo validation_errors();
	echo form_open('sessions/login',array('class' => 'form-horizontal'));

	echo input_text('text','email','Email');
	echo input_text('password','password','Password');
	echo input_button(form_submit('login', 'Login',"class='btn btn-primary'"));
	
	
?>
<p>New User? <?php echo anchor('/users/signup', 'Sign Up')  ?></p>
</fieldset>