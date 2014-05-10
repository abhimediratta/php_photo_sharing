<header class="navbar navbar-static-top navbar-inverse" role="navigation">
	<div class="container-fluid">
	<?php 
		if (isset($user)) {
	?>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="nav navbar-nav">
      			<li>
      				<a href="/photo_sharing/albums">Albums</a>
      			</li>
      			<li><a href="/photo_sharing/albums/new">New Album</a></li>
      		</ul>
      		
		
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
          			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->name ?><b class="caret"></b></a>
          			<ul class="dropdown-menu">
          				<li><a href="/photo_sharing/users/<?php echo $user->id ?>" style="">Profile</a></li>		
          				<li><a href="/photo_sharing/signout" class="signout">Sign Out</a></li>
          			</ul>
				
				</li>
			</ul>
      	</div>
    <?php 
		}
	?>
	</div>

</header>