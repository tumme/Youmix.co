<? session_start(); if(isset($_GET["logout"]) && $_GET["logout"]==1){  session_destroy();  header('Location: '.$return_url.'');}include("config.php");include("functionSQL.php");connect();if(!function_exists("curl_init")) die("cURL extension is not installed");// $url = 'http://youmix.co/api.php/playlists';$UserID = $_GET['id'];$url = 'http://youmix.co/api.php/user/playlists/'.$UserID;$ch=curl_init($url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);$r=curl_exec($ch);curl_close($ch);$arr = json_decode($r,true);$strSQL = "SELECT * FROM users WHERE user_id = '".$UserID."'";$objQuery = mysql_query($strSQL) or die(mysql_error());$objResult = mysql_fetch_array($objQuery);$Name = $objResult['name'];?><!doctype html><!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]--><!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]--><head>    <meta charset="utf-8">    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->    <meta http-equiv="X-UA-Compatible" content="IE=edge" />    <title>Youmix: Create Playlist From Youtube Free !</title>    <meta property="og:title"content="Youmix: Create Playlist From Youtube Free!" />    <meta property="og:site_name" content="Youmix: Create Playlist From Youtube Free! "/>    <meta property="og:url"=content="http://Youmix.co" />    <meta property="og:image"content="http://youmix.co/img/cover.jpg" />    <meta property="fb:app_id" content="1498339237072999" />    <meta name="viewport" content="width=device-width, initial-scale=1">    <link rel="apple-touch-icon" href="apple-touch-icon.png">    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />    <link rel="stylesheet" href="css/normalize.min.css">    <link rel="stylesheet" href="css/bootstrap.min.css">    <link rel="stylesheet" href="css/jquery.fancybox.css">    <link rel="stylesheet" href="css/flexslider.css">    <link rel="stylesheet" href="css/styles.css">    <link rel="stylesheet" href="css/queries.css">    <link rel="stylesheet" href="css/etline-font.css">    <link rel="stylesheet" href="bower_components/animate.css/animate.min.css">    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>    <style type="text/css">    header{      background:transparent;    }      </style></head><body id="top" class="bg-white">    <!--[if lt IE 8]>    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>    <![endif]-->    <section class="hero">      <div class="overlay-hero"></div>        <?php include("navigation.php");?>        <div class="hero-content text-center" style="padding-top: 3%;">          <h1><?=$Name;?>'s Playlist</h1>        </div>    </section>    <section class="blog text-center">      <div class="container-fluid" style="margin-top: -80px;">          <div class="row">             <div class="col-md-4">                  <article class="blog-post">                      <figure>                          <a href="create_from_videos.php" class="single_image">                            <div class="blog-img-wrap" style="background-color:#f0f0f0;box-shadow: none;">                              <i class="fa fa-plus" style="top:40%;right: 50%;color: #999"></i>                              <p style="position:absolute;top:55%;width:100%;text-align:center;right: 0%;font-weight: 600;color: #999">Create Playlist</p>                            </div>                          </a>                          <figcaption>                          <h2><a href="#" class="blog-category" data-toggle="tooltip" data-placement="top" data-original-title="See more in category"></a></h2>                          <p><a href="view_playlist.php?v=<?=$PlayListID;?>" class="blog-post-title" style="color:#999"><?=$PlayListName;?></a></p>                          </figcaption>                      </figure>                  </article>              </div>             <?php                $i=0;                foreach($arr['PlayList'] as $val){                $PlayListID = $val['ID'];                $Thumbnail = $val['Cover'];                $PlayListName = $val['PlayListName'];                 $i++;                // $Name = $val['name'];                // $UserID = $val['UserID'];                // echo $PlayListNames = implode("",$PlayListName);              ?>              <div class="col-md-4">                  <article class="blog-post">                      <figure>                          <a href="view_playlist.php?v=<?=$PlayListID;?>" class="single_image">                              <div class="blog-img-wrap" style="background-image:url(<?=fetch_highest_res($Thumbnail);?>)">                                  <div class="overlay">                                      <svg version="1.1" class="vdo-play-btn" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 100 100" style="top:50%;left:50%;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);position:absolute;"><path class="stroke-solid" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7 C97.3,23.7,75.7,2.3,49.9,2.5"></path><path class="stroke-hover" fill="none" stroke="white" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7 C97.3,23.7,75.7,2.3,49.9,2.5" data-reactid=".2.0.0.0.0.$=1$pageCID=02c18813--PageClass=02PageDisplayViewPortHeight--Completed=02true.1.1.1.$formationKeyc18813_3slot_formationSlot2.$c18814.0.0:1.4.0.1"></path><path class="icon" fill="white" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path></svg>                                  </div>                              </div>                          </a>                          <figcaption>                          <h2><a href="#" class="blog-category" data-toggle="tooltip" data-placement="top" data-original-title="See more in category"></a></h2>                          <p><a href="view_playlist.php?v=<?=$PlayListID;?>" class="blog-post-title" style="color:#999"><?=$PlayListName;?></a></p>                          </figcaption>                      </figure>                  </article>              </div>              <? } ?>              <? if($i==0){?>              <div class="success-message__content">                <a href="create_from_videos.php" class="btn btn-submit btn-primary btn-large" style="margin-top:24px;">Create Playlist</a>              </div>              <? }?>              <!-- <a href="#" class="btn btn-ghost btn-accent btn-small">More Playlist</a> -->          </div>      </div>    </section>    <?php include("footer.php");?>    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>    <script src="bower_components/retina.js/dist/retina.js"></script>    <script src="js/jquery.fancybox.pack.js"></script>    <script src="js/vendor/bootstrap.min.js"></script>    <script src="js/scripts.js"></script>    <script src="js/jquery.flexslider-min.js"></script>    <script src="bower_components/classie/classie.js"></script>    <script src="bower_components/jquery-waypoints/lib/jquery.waypoints.min.js"></script>    <script type="text/javascript" src="js/jquery.adaptive-backgrounds.js"></script>    <script type="text/javascript">          </script>    <script>    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');    ga('create', 'UA-68434550-1', 'auto');    ga('send', 'pageview');  </script>    <script type='text/javascript' id="__bs_script__">//<![CDATA[    // document.write("<script async src='//HOST:9001/browser-sync/browser-sync-client.1.9.2.js'><\/script>".replace(/HOST/g, location.hostname).replace(/PORT/g, location.port));//]]></script></body></html>