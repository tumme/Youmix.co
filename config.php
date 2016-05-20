<?php
  $mysql_hostname = "localhost";
  $mysql_user = "root";
  $mysql_password = ""; //SW8wvGgIjv
  $mysql_database = "youmix_v2";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
  mysql_select_db($mysql_database, $bd) or die("Could not select database");
  $db="youmix_v2";
  mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $bd);

  function refresh(){
  echo "<script type='text/javascript'>console.log('Hello World! If you need to join my project please email to me at youmix.co@gmail.com')</script>";
 }


########## app ID and app SECRET Facebook (Replace with yours) #############
$appId = '1498339237072999'; //Facebook App ID
$appSecret = '13095e538d4e565f2509388580a62810'; // Facebook App Secret
$return_url = 'http://youmix.co/';  //path to script folder
$fbPermissions = 'publish_actions,email'; // more permissions : https://developers.facebook.com/docs/authentication/permissions/


########## Config GA, Meta #############
$title = "Youmix: Create Playlist From Youtube Free !";
$ga = "UA-68434550-1";

########## Function Get Thumbnail Youtube #############################
function fetch_highest_res($videoid){
  $image_qualities = array('hqdefault','mqdefault','maxresdefault');
  foreach($image_qualities as $image_quality) 
    {
      if(@getimagesize( ('http://i.ytimg.com/vi/'. $videoid. '/'.$image_quality.'.jpg') ) ) 
      {
        $imgurl = "http://i.ytimg.com/vi/$videoid/$image_quality.jpg";
        return $imgurl;
        break; //exiting
      }
    }
  }
?>