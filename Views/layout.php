<DOCTYPE html>
<html>
  	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>				
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
		<title>remember.me </title>
		<style type="text/css">
			body{
				background-color: #ADD8E6;
			}

			.top-header{
				background-color: #3B5998;
				height: 60px;
				line-height: 60px;
			}
			.top-header a{
				color: #fff;
				padding: 0 35px;
			}
			.top-header a:hover{
				text-decoration: none;
				color: #a2a2a2;
			}
			.container{
				text-align: center;
			}

			.add_group{
				font-size: 24px;
				background-color: #3B5998;
				padding: 8px 15px;
				border-radius: 6px;
				color: #fff;
				margin: 0px 10px;
			}
			.add_group:hover{
				text-decoration: none;
				color: #b2b2b2;
			}
			.group p{
				display: inline;
				font-size: 18px;
			}
			.group a:hover{
				text-decoration: none;
			}
		</style>
	</head>
  	<body>
		<div class="top-header">
			<a href='/rememberMe/public'>About</a>
		  	<a href='?controller=friends&action=index'>Friends</a>	
		  	<a href='?controller=groups&action=index'>Groups</a>
			<a href='?controller=sessions&action=logout'>Logout</a>
		</div>

		<div class="container">
			<?php require_once('../config/routes.php'); ?>
		</div>

		<footer>
				
		</footer>
  	<body>
<html>

