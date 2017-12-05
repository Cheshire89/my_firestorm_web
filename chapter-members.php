<?php 
  require_once('classes/config.php');
  if(isset($_GET["chapterID"]) && $_GET["chapterID"] != ''){
      $chapters = new Chapters();
      $chapterID = $_GET["chapterID"];
      $chapter = $chapters->getChapter($_GET["chapterID"]);
      $members = $chapters->print_members($chapterID);
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

     <title><?php print($chapter["chapterName"]);?> | Members</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
        .featured-member img{
            width: 170px;
            height: 170px;
        }
        .hero-img{
            height: 350px;
            overflow: hidden;
        }
        .adminStar {
            position: absolute;
            right: 40px;
            top: 175px;
            font-size: 25px;
            color: orange;
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
                <li><a href="chapter-photos.php?chapterID=<?php print($chapterID);?>" title="">Photos</a></li>
                <li  class="active"><a href="chapter-members.php?chapterID=<?php print($chapterID);?>" title="">Members</a></li>
            </ul>
          </div>
      </nav>
    </div>

     <div class="container on-page-menu offset-menu info">
        <div class="row">
             <?php print($members);?>
              
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
  </body>

  <style type="text/css">
    

  </style>
</html>
