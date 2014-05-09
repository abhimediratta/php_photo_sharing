<h2>Details:</h2>
<p>
	<b>Name: </b><?php echo $user->name; ?>
</p>
<p>
	<b>Email: </b><?php echo $user->email; ?>
</p>

<?php echo anchor('/users/edit/'.$user->id,"Edit Details");   ?>