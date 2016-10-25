<?php
	session_start();
	if (isset($_SESSION['facebook_access_token'])){
		require_once('connection.php');

		if (isset($_GET['controller']) && isset($_GET['action'])) {
		    $controller = $_GET['controller'];
		    $action     = $_GET['action'];
	  	} else {
		    $controller = 'pages';
		    $action     = 'home';
	  	}

	  	require_once('../Views/layout.php');
	}else{
		header('Location: login.php');
	}
?>