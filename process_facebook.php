<?php 
session_start(); 
include_once("config.php"); //Include configuration file.
require_once('inc/facebook.php' ); //include fb sdk

/* Detect HTTP_X_REQUESTED_WITH header sent by all recent browsers that support AJAX requests. */
if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{		

	//initialize facebook sdk
	$facebook = new Facebook(array(
		'appId' => $appId,
		'secret' => $appSecret,
	));
	
	$fbuser = $facebook->getUser();
	
	if ($fbuser) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$me = $facebook->api('/me'); //user
			$uid = $facebook->getUser();
		}
		catch (FacebookApiException $e) 
		{
			//echo error_log($e);
			$fbuser = null;
		}
	}
	
	// redirect user to facebook login page if empty data or fresh login requires
	if (!$fbuser){
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$return_url, false));
		header('Location: '.$loginUrl);
	}
	
	//user details
	$fullname = $me['name'];
	$email = $me['email'];

	/* connect to mysql using mysqli */
	
	$mysqli = new mysqli($hostname, $db_username, $db_password,$db_name);
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	
	//Check user id in our database	
	$UserCount = $mysqli->query("SELECT COUNT(id) as usercount FROM users WHERE fbid=$uid")->fetch_object()->usercount; 
	
	if($UserCount)
	{	
		//User exist, Show welcome back message
		echo '<strong>Welcome back '.$me['name'].'!</strong>';
		echo "<meta http-equiv='refresh' content='1;url=index.php'>";
		//print user facebook data
		// echo '<pre>';
		// print_r($me);
		// echo '</pre>';

		//User is now connected, log him in
		login_user(true,$me['name']);
		$_SESSION['logged_in']=$loggedin;
		$_SESSION['UID']=$uid;
		$_SESSION['user_name']=$user_name;
	}
	else
	{
		// echo '<div class="form-input-group"><i class="fa fa-user"></i></i><input type="text" name="Name" class="form-control form-white" placeholder="Name" value="'.$me['name'].'" required></div>';
		// echo '<div class="form-input-group"><i class="fa fa-envelope"></i><input type="email" name="Email" class="form-control form-white" placeholder="Your Email" required></div>';
		// echo '<div class="form-input-group"><i class="fa fa-lock"></i><input type="password" name="Password" class="form-control form-white" placeholder="Your Password" required></div>';
		// echo '<input type="hidden" name="uid" value="'.$uid.'">';
		// echo '<input type="hidden" name="_METHOD" value="POST"/>';
		// echo '<button type="submit" class="btn-fill sign-up-btn">Sign up for free</button>';
		// Insert user into Database.
		echo '<strong>Welcome '.$fullname.'!</strong><br>';
		echo '<a href="create.php" class="btn btn-large btn-accent" style="margin-top:20px;">Create Playlist</a>';

		$mysqli->query("INSERT INTO users (fbid, fullname, email) VALUES ($uid, '$fullname','$email')");
		
	}
	
	$mysqli->close();
}

function login_user($loggedin,$user_name)
{
	/*
	function stores some session variables to imitate user login. 
	We will use these session variables to keep user logged in, until s/he clicks log-out link.
	*/
	$_SESSION['logged_in']=$loggedin;
	$_SESSION['UID']=$uid;
	$_SESSION['user_name']=$user_name;
}
?>