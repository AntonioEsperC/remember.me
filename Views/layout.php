<DOCTYPE html>
<html>
  	<head></head>
  	<body>
		<header>
			<?php
			if (isset($_SESSION['facebook_access_token'])){ ?>
				<a href='/rememberMe/public'>Home</a>
		  		<a href='?controller=friends&action=index'>Show Friends</a>	
		  		<a href='?controller=groups&action=index'>My Groups</a>
				<a href='?controller=sessions&action=logout'>Logout</a>
			<?php } 
			else {
				
			} ?>
		</header>

		<?php require_once('../config/routes.php'); ?>

		<footer>
				
		</footer>
  	<body>
<html>