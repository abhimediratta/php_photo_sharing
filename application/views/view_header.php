<header class="navbar navbar-static-top navbar-inverse" role="navigation">
	<div class="container-fluid">
	<?php 
		if (isset($user)) {
	?>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="nav navbar-nav">
      			<li><a href="/photos">My Photos</a></li>
      		</ul>
      		<a href="/signout"><button type="button" class="signout btn btn-default navbar-btn navbar-right ">Sign Out</button></a>
		
			<a href="/users/<%= current_user.id %>" class="navbar-text navbar-right" style="margin-right:15px;"><%= current_user.name %></a>
      	</div>
    <?php 
		}
	?>
	</div>

</header>