<?php
ob_start();
    require_once('resources/facebook-php-sdk-master/src/facebook.php');
    $config = array();
    $config['appId'] = '1498339237072999';
    $config['secret'] = '13095e538d4e565f2509388580a62810';
    $config['fileUpload'] = false; // optional

    // instantiate
    $facebook = new Facebook($config);
    $pagefeed = $facebook->api("/164392594456/feed");
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
    <title>Bookmark Facebook Page From Your Like</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet"/> 
        
    <!--     Fonts and icons     -->
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />  
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display|Raleway:700,100,400|Roboto:400,700|Playfair+Display+SC:400,700' rel='stylesheet' type='text/css'>
    
    <style>
        .card{
            margin-bottom: 70px;
        }
    </style>
</head>
<body>

<div class="wrapper">       
    <div class="container">
          <div class="page-description page-description-header">            
            <div class="hipster-container">
                <h1>Facemark</h1>
            </div>
        </div>        
        <div class="masonry-container">
        <?php
        $i = 0;
        foreach($pagefeed['data'] as $post) 

         {
          if ($post['type'] == 'status' || $post['type'] == 'link' || $post['type'] == 'photo') {
             list($PageID, $PostID) = explode('_', $post['id']);
              //echo "<p>".$PostID."</p>";
          ?>
         <? if ($post['type'] == 'link' || $post['type']== 'status' || $post['type']=='offer' || $post['type']=='event' || $post['type']=='video') {?>
          <div class="card-box col-md-4 col-sm-6">
            <div class="card">                                            
                <div class="content">
                    <h6 class="category">Best stories</h6>
                    <h4 class="title"><a href="#">This is a plain Hipster Card, see for yourself</a></h4>
                    <p class="description">When selling products it's always a good idea to go with commanding fonts that are good at showing authority and security. I feel like Raleway and Roboto do just that.</p>
                </div>                                           
            </div> <!-- end card -->
          </div>  
          <? }else if ($post['type'] == 'photo'){
            $img = "https://graph.facebook.com/".$PostID."/picture";
            ?>
          <div class="card-box col-md-4 col-sm-6">
                <div class="card">                            
                    <div class="header">
                        <img src="<?=$img;?>"/>
                        <div class="filter"></div>
                        
                        <div class="actions">
                            <button class="btn btn-round btn-fill btn-neutral btn-modern">
                                Read Full Story
                            </button>
                        </div>
                    </div>
                    
                    <div class="content">
                        <h6 class="category"><?=date("jS M, Y", (strtotime($post['created_time'])));?></h6>
                        <h4 class="title">
                        <a href="#">
                        <?if (empty($post['story']) === false) {
                           echo $post['story'];
                         }
                          ?>

                        </a>

                        </h4>
                        <p class="description">  
                        <?if (empty($post['message']) === false) {
                           echo $post['message'];
                         }
                          ?>
                        </p>
                    </div>                                           
                </div> <!-- end card -->
             </div>
          <?}?>
          <?}
          }
          ?>
        </div> 
    </div> 
</div> <!-- end wrapper -->

</body>

    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/hipster-cards.js"></script>
    
    <!--  Just for demo  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>
    
    <script>
        
        $().ready(function(){
            
            var $container = $('.masonry-container');

            doc_width = $(document).width();
            
            if (doc_width >= 768){
                $container.masonry({
                    itemSelector        : '.card-box',
                    columnWidth         : '.card-box',
                    transitionDuration  : 0
                });   
            } else {
                $('.mas-container').removeClass('mas-container').addClass('row');
            }            
        });
    </script>
    <script type='text/javascript'>//<![CDATA[
    document.write("<script async src='//HOST:9000/browser-sync/browser-sync-client.1.6.2.js'><\/script>".replace(/HOST/g, location.hostname).replace(/PORT/g, location.port));
//]]></script>
    
</html>