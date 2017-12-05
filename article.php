<?php

require_once("classes/config.php");

if(isset($_GET['id']) && $_GET['id'] != "") {
    
    $id = $_GET['id'];
    
    $edu = new Education();
    $article = $edu->getArticle($id);
    
} else {
    header("Location: education.php");
    exit();
}

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Event Title</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/486ff18bfe.css" media="all">
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U'); ?>" rel="stylesheet">
    <link href="styles/css/event.css?v=<?php echo date('U'); ?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      p{
            font-size: 14px !important;
            font-weight: 400;
            font-family: Helvetica !important;
      }

      p strong{
           color:#d36a1d !important;
           font-family: 'Open Sans', sans-serif !important;
           font-weight: 400 !important;
           font-size: 24px;
      }

      .link{
          margin-top:3px !important;
          margin-bottom: 4px !important;
      }

      .link a{
        color:#d36a1d !important; 
      }

      .link a:hover{
        text-decoration: underline !important;
      }

      .link a:before{
         font-family: 'FontAwesome';
         content:'\f14c';
         color:#d36a1d !important;
         margin-right: 5px;
      }

      ol li{
         font-size: 14px !important;
         font-family: 'Open Sans', sans-serif !important;
         margin:5px 40px !important;
         font-weight: 700;
      }

       ol li:before{
        color:#d36a1d !important;
       }

    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid cover-img visible-md visible-lg">
        <div class="row img-holder">
          <img src="<?php print(substr($article['articleImg'], 1)); ?>" class="img-reponsive">
        </div>
    </div>
    <div class="container event-header">
      <div class="row no-gutter slider-navigation">
           <div class="col-md-9 event-pic">
              <img class="cover img-responisive" src="<?php print(substr($article['articleImg'], 1)); ?>" alt="Event Title">
           </div>
           <div class="col-md-3 event-details">
              <div class="wrapper">
                <p class="date"><?php print(date('m/d/Y', $article['articleDate'])); ?></p>
                <p>by <a href="chapter-overview.php" title="chapter name"></a></p>
              </div>
           </div>
       </div>
    </div>
    <div class="container event-actions">
      <div class="row">
        <div class="col-xs-12 text-left bg-white">
           <h1 class="fs-header h2"><span class="fs-strong"><?php print($article['articleTitle']); ?></span></h1>
        </div>
      </div>
    </div>
    <div class="container info">
      <div class="row">
        <div class="col-md-9">
          <div class="row bg-grey">
              <div class="col-md-10 col-md-offset-1">
                    <div class="text-left">
                        <?php print($article['articleCont']); ?>
                    </div>
                </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-10 col-md-offset-1">
                <h4 class="fs-header text-left"><span class="fs-strong">Tags</span></h4>
                <ul class="list-inline tags">
                  <?php print($article['allTags']); ?>
                </ul>
            </div>
          
            <div class="col-xs-6 col-md-10 col-md-offset-1">
              <h4 class="fs-header text-left"><span class="fs-strong">Share</span></h4>

              <div class="btn-group chapter">
                  <a class="btn btn-default fs-ico-btn" target="_window" href="https://www.facebook.com/sharer/sharer.php?u=<?php print((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                          <a class="btn btn-default fs-ico-btn" target="_window" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php print((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&title=<?php print($chapter["chapterName"]);?>&summary=&source=" title="Linked In"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                          <a class="btn btn-default fs-ico-btn" target="_window" href="https://twitter.com/home?status=Check%20Us%20Out!%20<?php print((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" title="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                  <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Email"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    
    <?php require_once('php/footer.php') ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Optional -->
    <!-- jQuery Ui -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

    <script src="js/script.js"></script>
    <script src="js/map.js"></script>
    <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCF-N67li13yxETx0fnF8f-JAztGoeWF0c&callback=initMap"></script>
    <script>
      $('.event-header').ready(function(){
          var eventPic = $('.event-pic');
          var img = eventPic.find('img');

              var offset = (eventPic.height() - img.height()) / 2;
              img.css('margin-top', offset);

              
      });
      $(document).ready(function(){
        $('p').each(function(){
          var links = $(this).has('a');
          if(links.length && !links.hasClass('date')){
             $(this).addClass('link');
          }
        });
      });

      
    </script>
  </body>
</html>
