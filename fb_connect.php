<?php
session_start(); 
include("inc/facebook.php"); 
//
$facebook = new Facebook(array(
  'appId'  => '1498339237072999', 
  'secret' => '13095e538d4e565f2509388580a62810',  
  'fileUpload' => true, 
  'cookie' => true, 
));

function pre($varUse){
	echo "<pre>";
	print_r($varUse);
	echo "</pre>";
}
// Get User ID
$fb_user = $facebook->getUser();
if($fb_user){
  try{
    // Proceed knowing you have a logged in user who's authenticated.
    $fb_userData=$facebook->api('/me');
  }catch(FacebookApiException $e) {
    error_log($e);
    $user=null;
  }
}
if(isset($_GET['logout'])){ 
	$facebook->destroySession(null); 
	header("Location:".$_SERVER['PHP_SELF']); 
}
// Login or logout url will be needed depending on current user state.
if($fb_user){
  $logoutUrl = $facebook->getLogoutUrl(array(
  	"next"=>"http://www.youmix.co/logout.php?logout"
  ));
} else{
  $loginUrl = $facebook->getLoginUrl(array(
  "redirect_uri"=>"http://www.youmix.co/save_signup.php",
	"display"=>"popup",
	"scope"=>"publish_actions,email" 
  ));
}
?>