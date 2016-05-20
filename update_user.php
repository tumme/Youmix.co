<?php
session_start();
 include("config.php");
 include("functionSQL.php");
 if($_POST)
  if($_POST['_METHOD'] == 'POST'){
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Password = md5($_POST['password']);
    $UID = $_POST['uid'];
    $_SESSION['UID']=$UID;
    $_SESSION['name']=$Name;
    $postData = array(
    'email'=> $Email,
    'Password'=> $Password
    );
    update("$db.users",$postData,"fbid='".$UID."'");
  }
?>
