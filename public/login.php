<?php
	session_start();
	require_once('connection.php');
	require_once __DIR__ . '/src/Facebook/autoload.php';

	$fb = new Facebook\Facebook([
	  'app_id' => '1111660298913926',
	  'app_secret' => 'e1fca73e6e8d42e67db979c2694a0acb',
	  'default_graph_version' => 'v2.7',
	  ]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email', 'user_friends']; // optional
		
	try {
		if (isset($_SESSION['facebook_access_token'])) {
			$accessToken = $_SESSION['facebook_access_token'];
		} else {
	  		$accessToken = $helper->getAccessToken();
		}
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	 	// When Graph returns an error
	 	echo 'Graph returned an error: ' . $e->getMessage();
	  	exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	 	// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  	exit;
	}

	if (isset($accessToken)) {
		if (isset($_SESSION['facebook_access_token'])) {
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		} else {
			// getting short-lived access token
			$_SESSION['facebook_access_token'] = (string) $accessToken;
			$oAuth2Client = $fb->getOAuth2Client();
			$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
			$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		}

		if (isset($_GET['code'])) {
			header('Location: ./');
		}

		try {
			$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
			$profile = $profile_request->getGraphNode()->asArray();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			session_destroy();
			// redirecting user back to app login page
			header("Location: ./");
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		
		$db = Db::getInstance();
		$id = intval($profile['id']);
        $req = $db->prepare('SELECT * FROM users WHERE id = :id');
        $req->execute(array('id' => $profile['id']));
        $user = $req->fetch();

        if(!$user){
        	$req = $db->prepare('INSERT INTO users (id, first_name, last_name, email, phone, profile_img, synchronized) 
        		VALUES (:id, :first_name, :last_name, :email, :phone, :profile_img, :synchronized)');
        	$req->execute(array('id' => $profile['id'], 'first_name' => $profile['first_name'], 'last_name' => $profile['last_name']
        		, 'email' => NULL, 'phone' => NULL, 'profile_img' => NULL, 'synchronized' => 1));

			try {
				$requestFriends = $fb->get('/me/taggable_friends?fields=name&limit=100');
				$friends = $requestFriends->getGraphEdge();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			// if have more friends than 100 as we defined the limit above on line no. 68

			if ($fb->next($friends)) {
				$allFriends = array();
				$friendsArray = $friends->asArray();
				$allFriends = array_merge($friendsArray, $allFriends);
				$friend_id = 0;

				while ($friends = $fb->next($friends)) {
					$friendsArray = $friends->asArray();
					$allFriends = array_merge($friendsArray, $allFriends);
				}
				foreach ($allFriends as $key) {
					$names = explode(' ', $key['name']);
					$req = $db->prepare('INSERT INTO friends (id, first_name, last_name, email, phone, profile_img) 
        								      VALUES (:id, :first_name, :last_name, :email, :phone, :profile_img)');
        			$req->execute(array('id' => $friend_id, 'first_name' => $names[0], 'last_name' => $names[1]
        								, 'email' => NULL, 'phone' => NULL, 'profile_img' => NULL));
        			$friend_id += 1;
				}
				//echo count($allFriends);
			}
        }        
		header('Location: index.php');

	  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
	  	
	} else {
		// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
		$loginUrl = $helper->getLoginUrl('http://localhost/rememberMe/public/login.php', $permissions);?>
		<!DOCTYPE HTML>
		<html>
			<head>
				<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>				
				<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
				<title>Login | remember.me </title>
			</head>
			<body style="background-color: #ADD8E6;">
				<div style="padding: 30px; border: 3px solid #3B5998; border-radius: 8px; background-color: #cce1e8; margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0; height:375px; width: 350px; text-align: center;">
					<br>
					<h1>remember.me</h1>
					<br><br>
					<a href=" <?php echo $loginUrl ?> " class="btn btn-block btn-social btn-facebook" style="color: #fff; background-color: #3B5998; padding: 10px; bottom: 0; border-radius: 0px !important;">
						<span class="fa fa-facebook"></span> Login with Facebook!
					</a>
					<br><br>
					<h4>Managing your personal relationships has never been so easy!</h4>
				</div>
			</body>
		</html>
	<?php }
?>

