<?php 
  require_once('classes/config.php');
  if(isset($_GET["chapterID"]) && $_GET["chapterID"] != ''){
      $chapters = new Chapters();
      $chapterID = $_GET["chapterID"];
      $chapter = $chapters->getChapter($_GET["chapterID"]);
      
      $chapterAdmins = $chapters->getChapterAdmins($_GET["chapterID"]);
      
      $location = $chapter["chapterAddress"].' '.$chapter["chapterCity"].' '.$chapter["chapterState"];

      $events = new Events();
      $chapterEvents = $events->getChapterEvents($chapterID);

    

      $users = new Users();
      $president = $users->get_user_info($chapter["chapterAdminID"]);
          $prName = $president["fName"].' '.$president["lName"];
          $prImg = $president["profPic"];
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

    <title><?php print($chapter["chapterName"]);?></title>

    
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
                <li class="active"><a href="chapter.php?chapterID=<?php print($chapterID);?>" title="">Overview</a></li>
                <li><a href="chapter-photos.php?chapterID=<?php print($chapterID);?>" title="">Photos</a></li>
                <li><a href="chapter-members.php?chapterID=<?php print($chapterID);?>" title="">Members</a></li>
            </ul>
          </div>
      </nav>
    </div>

    <div class="container on-page-menu offset-menu info" style="text-align:center;">
      <div class="row">
        <div class="col-md-9">
          <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h4 class="fs-header text-left"><span class="fs-strong">Chapter Overview</span></h4>
                <div class="text-left">
                    <?php print($chapter["chapterDesc"]);?>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
              <h4 class="fs-header text-left" style="margin-top:10px;"><span class="fs-strong">Upcoming Events</span></h4>
              
                <table class="table table-striped table-responsive fs-table">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php print($chapterEvents); ?>
                    </tbody>
                </table>
              
            </div>
          </div>

        </div>
        <div class="col-md-3 side-info">
          <div class="row ">
            
              <div class="col-md-10 col-sm-6 text-left sub-info">
              <h4 class="fs-header text-left"><span class="fs-strong">Meeting Time</span></h4>
                <p><?php print($chapter['meetingDay']); ?>'s - <?php print($chapter['meetingTime']); ?> - <?php print($chapter['meetingTimeEnd']); ?> </p>
                <!-- <p>Fri, Mar 28, 2017 7:00 AM - Tue, Apr 5 2017 4:00 PM MST</p> -->
              </div>
            
          
            
              <div class="col-md-10 col-sm-6 text-left sub-info">
              <h4 class="fs-header text-left"><span class="fs-strong">Meeting Location</span></h4>
                <p><?php print($location);?></p>
              </div>
            
          </div>
        </div>
      </div>
      <div class="row">
    
        <div class="col-xs-12 col-sm-6 col-md-7 col-md-offset-1">
            <div class="row">
                <div class="col-xs-12">
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
        <div class="col-xs-12 col-sm-6 col-md-3 col-md-offset-1 share">
            <div class="row">
                <div class="col-md-9 col-md-offset-2">
                    <?php print($chapterAdmins); ?>
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
  </body>

  <style type="text/css">
    

  </style>
</html>
