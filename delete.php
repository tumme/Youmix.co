<?php
include("config.php");
// if($_POST)
//   if($_POST['_METHOD'] == 'POST'){
//   $strSQL = "SELECT * FROM users WHERE fbid = '".$_POST['UserID']."'";
//   $objQuery = mysql_query($strSQL) or die(mysql_error());
//   $objResult = mysql_fetch_array($objQuery);
//   $UserID = $objResult['id'];
  
//   $PlayListName = $_POST['PlaylistName'];
//   $UserID = $UserID;
//   $DateCreate = $_POST['DateCreate'];
//   $View = $_POST['View'];
//   $YoutubeID =$_POST['YoutubeID'];
//   $YoutubeTitle =$_POST['YoutubeTitle'];
//   $postData = array(
//     'PlayListName'=> $PlayListName,
//     'UserID'=> $UserID,
//     'DateCreate'=> $DateCreate,
//     'View'=> $View,
//     'YoutubeID' => $YoutubeID,
//     'YoutubeTitle' => $YoutubeTitle
//     );
//   $ch = curl_init();
//   curl_setopt_array($ch, array(
//     CURLOPT_URL => 'http://yourmix.me/api.php/playlist',
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_POST => true,
//     CURLOPT_POSTFIELDS => http_build_query($postData),
//     CURLOPT_FOLLOWLOCATION => false
// ));
//  @$output = curl_exec($ch);
// }
if($_GET['method']=="delete"){    
    $sqlt = "DELETE FROM $db.Playlist WHERE ID ='".$_GET['v']."'" ;
    $queryt = mysql_query($sqlt) or die(mysql_error());
    $sqlt2 = "DELETE FROM $db.YoutubePlaylist WHERE PlaylistID ='".$_GET['v']."'" ;
    $queryt2 = mysql_query($sqlt2) or die(mysql_error());
  
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" class="no-js" lang="" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en-gb" lang="en-gb"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Youmix: Create Playlist From Youtube Free !</title>
    <meta property="og:title"content="Youmix: Create Playlist From Youtube Free!" />
    <meta property="og:site_name" content="Youmix: Create Playlist From Youtube Free! "/>
    <meta property="og:url"=content="http://Youmix.co" />
    <meta property="og:image"content="http://youmix.co/images/Cover.jpg" />
    <meta property="fb:app_id" content="1498339237072999" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/queries.css">
    <link rel="stylesheet" href="css/etline-font.css">
    <link rel="stylesheet" href="bower_components/animate.css/animate.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body id="top" class="bg-white">
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <section class="">
        <section class="navigation">
            <header>
                <div class="header-content">
                    <div class="logo"><a href="index.php"><img src="img/logo_color.png" alt="Youmix.co"></a></div>
                    <div class="header-nav">
                       <nav>
                            <ul class="primary-nav">
                                <li><a href="index.php">Welcome</a></li>
                                <li><a href="playlist.php">Playlist</a></li>
                                <li><a href="create.php">Create Playlist</a></li>
                            </ul>
                            
                            <ul class="member-actions">
                            <?if(empty($_SESSION)){?>
                                <li><a href="#" class="login" data-toggle="modal" data-target="#signin">Log in</a></li>
                                <li><a href="#" class="btn-white btn-small" data-toggle="modal" data-target="#signin">Sign up</a></li>
                                <? }else{?>
                                  <li><a href="logout.php?logout=1" class="btn-white btn-small" >Logout</a></li>
                                <?}?>
                            </ul>
                        </nav>
                    </div>
                    <div class="navicon">
                        <a class="nav-toggle" href="#"><span></span></a>
                    </div>
                </div>
            </header>
        </section>
    </section>

    <section class="sign-up section-padding text-center" style="margin-top:186px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="success-message">
                      <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
                          <circle cx="38" cy="38" r="36"/>
                          <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
                      </svg>
                      <h1 class="success-message__title">Completed ! </h1>
                      <div class="success-message__content">
                          <a href="playlist.php" class="btn btn-submit btn-accent btn-large" style="margin-top:24px;">Back to Playlist</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-12">
                        <h5>Follow Youmix</h5>
                        <ul class="footer-share">
                            <li><a href="https://www.facebook.com/Youmix-173913789614015/timeline/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- footer top -->
        <div class="footer-bottom">
            <div class="container">
                <div class="col-md-12">
                    <p>Copyright © 2015 Youmix.co. All Rights Reserved<br>Made with <i class="fa fa-heart pulse"></i> by <a href="#">Youmix Team</a></p>
                </div>
            </div>
        </div>
    </footer><!-- footer -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="bower_components/retina.js/dist/retina.js"></script>
    <script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="bower_components/classie/classie.js"></script>
    <script src="bower_components/jquery-waypoints/lib/jquery.waypoints.min.js"></script>
    <script>
      function PathLoader(el) {
          this.el = el;
          this.strokeLength = el.getTotalLength();
          this.el.style.strokeDasharray = this.el.style.strokeDashoffset = this.strokeLength;
      }
      PathLoader.prototype._draw = function (val) {
          this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
      };
      PathLoader.prototype.setProgress = function (val, cb) {
          this._draw(val);
          if (cb && typeof cb === 'function')
              cb();
      };
      PathLoader.prototype.setProgressFn = function (fn) {
          if (typeof fn === 'function')
              fn(this);
      };
      var body = document.body, svg = document.querySelector('svg path');
      if (svg !== null) {
          svg = new PathLoader(svg);
          setTimeout(function () {
              document.body.classList.add('active');
              svg.setProgress(1);
          }, 200);
      }
      // document.addEventListener('click', function () {
      //     if (document.body.classList.contains('active')) {
      //         document.body.classList.remove('active');
      //         svg.setProgress(0);
      //         return;
      //     }
      //     document.body.classList.add('active');
      //     svg.setProgress(1);
      // });
    </script> 
     <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-68434550-1', 'auto');
      ga('send', 'pageview');

  </script>
 
</body>
</html>