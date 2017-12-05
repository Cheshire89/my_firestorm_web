<?php 
  require_once('classes/config.php');
  if(isset($_GET["chapterID"]) && $_GET["chapterID"] != ''){
      $chapters = new Chapters();
      $chapterID = $_GET["chapterID"];
      $chapter = $chapters->getChapter($_GET["chapterID"]);

      $gallery = new ChapterGallery($chapterID);
      $chapterGallery = $gallery->print_chapter_gallery();
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

     <title><?php print($chapter["chapterName"]);?> | Gallery</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      .hero-img{
          height: 350px;
    overflow: hidden;
}
    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="<?php print($chapter["chapterImg"]);?>" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left"><?php print($chapter["chapterName"]);?></h1>
        </div>
      </div>
    </div>

    <div class="container on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                <li><a href="chapter.php?chapterID=<?php print($chapterID);?>" title="">Overview</a></li>
                <li  class="active"><a href="chapter-photos.php?chapterID=<?php print($chapterID);?>" title="">Photos</a></li>
                <li><a href="chapter-members.php?chapterID=<?php print($chapterID);?>" title="">Members</a></li>
            </ul>
          </div>
      </nav>
    </div>
    <div class="container on-page-menu offset-menu info">
        <div class="row grid">
            <?php print($chapterGallery);?>
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
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script>
    $(document).ready(function(){
      $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        
      });
    });

    $('.grid img').on('click',function(){
        var overlay = $('.overlay');
            imgCont = overlay.find('#img-container');
            img = $(this);
        overlay.css('display','table').fadeIn(function(){
          imgCont.append(img);
          overlay.find('.navigation').fadeIn();
        });

    });
    </script>
    <div class="overlay">
        <div class="row navigation row">
                <div class="col-xs-1">
                  <i class="fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <div class="col-xs-10" id="img-container">
                  <!-- <img src="img/Networking.jpg" class="img-responsive" alt="img-title"> -->
                </div>
                <div class="col-xs-1">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
  </body>

  <style type="text/css">
    .overlay{
      display: none;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: rgba(0, 0, 0, 0.8);
      z-index: 1060;
    }

    .overlay .img-holder{
      
    }

    .overlay .navigation{
      display: none;
      position: absolute;
      margin-top: 5%;
    }

    .overlay .navigation i{
      color:white;
      cursor:pointer;
      font-size:8em;
      margin-top: 200%;
    }

    .overlay .navigation .fa-angle-left{
        float:left;
        padding-left: 15px;
    }

    .overlay .navigation .fa-angle-right{
        float:right;
        padding-right: 15px;
    }
  </style>
</html>
