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
</head>
<body>

<div class="wrapper">       
    <div class="container">
          <div class="page-description page-description-header">            
            <div class="hipster-container">
                <h1 style="color:#212121;">Facemark</h1>
            </div>
        </div>        
        <div class="masonry-container wall"></div> 
    </div> 
</div> <!-- end wrapper -->

</body>


<script src="js/jquery-1.10.2.js" type="text/javascript"></script>

<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/hipster-cards.js"></script>
<!--  Just for demo  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.1/masonry.pkgd.min.js"></script>
<script src="js/jquery.tmpl.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript">
  function splitStr(string,seperator){
    return string.split(seperator)[1];
}
</script>
<script id="headingTpl" type="text/x-jquery-tmpl">
</script>

<script id="feedTpl" type="text/x-jquery-tmpl">

{{if type == "photo" }}

<div class="card-box col-md-4 col-sm-6">
    <div class="card">                            
        <div class="header" style="background:url(https://graph.facebook.com/${splitStr(id,'_')}/picture);background-size:cover;background-position:center">
            <div class="filter"></div>
            <div class="actions">
                <a href="${link}" target="_blank" class="btn btn-round btn-fill btn-neutral btn-modern">
                    Read More
                </a>
            </div>
        </div>
        
        <div class="content">
            <h6 class="category">${from.name} - ${created_time}</h6>
            <h4 class="title"><a href="#">${caption}</a></h4>
            <p class="description">{{html message}}</p>
        </div>                                           
    </div>
 </div>
{{/if}}
{{if type == "link" }}
<div class="card-box col-md-4 col-sm-6">
    <div class="card">                            
        <div class="header" style="background:url(${picture});background-size:cover;background-position:center">
            <div class="filter"></div>
            <div class="actions">
                <a href="${link}" target="_blank" class="btn btn-round btn-fill btn-neutral btn-modern">
                    Read More
                </a>
            </div>
        </div>
        
        <div class="content">
            <h6 class="category">${from.name} - ${created_time}</h6>
            <h4 class="title"><a href="#">${caption}</a></h4>
            <p class="description">{{html message}}</p>
        </div>                                           
    </div>
 </div>
{{/if}}
</script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.masonry-container').facebookWall({
    id:'livingetc',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });  
  $('.masonry-container').facebookWall({
    id:'magazinemagaseen',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
  $('.masonry-container').facebookWall({
    id:'designmilk',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
  $('.masonry-container').facebookWall({
    id:'PodiumTH',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
  $('.masonry-container').facebookWall({
    id:'IRoamAlone',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
  $('.masonry-container').facebookWall({
    id:'PakaPrich',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
   $('.masonry-container').facebookWall({
    id:'abduzeedos',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
  $('.masonry-container').facebookWall({
    id:'nextcover.co',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });
  $('.masonry-container').facebookWall({
    id:'smashmag',
    access_token:'1498339237072999|13095e538d4e565f2509388580a62810'
  });

});
</script>

<script type='text/javascript'>//<![CDATA[
document.write("<script async src='//HOST:9000/browser-sync/browser-sync-client.1.6.2.js'><\/script>".replace(/HOST/g, location.hostname).replace(/PORT/g, location.port));
//]]></script>
    
</html>