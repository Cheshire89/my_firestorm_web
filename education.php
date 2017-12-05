<?php
require_once("classes/config.php");
$getEducation = new Education();
$all = $getEducation->getAll();
$banners = new Banners();
$banner = $banners->getBanner('education');
if(substr($banner["bnImgPath"], 0, 2) == "..") {
    $banner["bnImgPath"] = substr($banner["bnImgPath"], 1);
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

    <title>Educational Blogs</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      .event-link .fs-header-black{
        height: 38px;
        max-height: 38px;
        line-height: 19px;
        font-size:15px;
        text-overflow: ellipsis;
        overflow:hidden;
        margin-top:3px;
        margin-bottom: 3px;
      }
      @media (max-width: 450px){
        .article{
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="<?php print($banner["bnImgPath"]);?>" alt="<?php print($banner["bnImgDesc"]);?>" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
     <!--  col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 -->
        <div class="container">
            <h1 class="fs-header-white text-left"><?php print($banner["bnText"]);?></h1>
        </div>
      </div>
    </div>

    <div class="container on-page-menu" style="text-align:center;">
        <div class="center-block">
           <form class="form-inline fs-form-gen" method="POST">
             <div class="form-group">
              <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Search ">
            </div>
            <div class="form-group">
              <input type="date" class="form-control" id="articleDate" name="articleDate" placeholder="Article Date">
            </div>
            <button type="button" class="btn btn-default fs-btn-orange" id="searchEducationBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
           </form>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h2 class="fs-header h3 text-center">Latest <span class="fs-strong">Education</span></h2>
        </div>
    </div>

    <div class="container result-boxes">
        <div class="row">
            <?php print($all); ?>
        </div>
    </div>
         
   <?php require_once('php/sign-up.php') ?>
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
    <script type="text/javascript">
      $(document).ready(function(){
            $('#searchEducationBtn').on('click',function(){
                var title = $('#articleTitle').val();
                var date = $('#articleDate').val();

                $.ajax({
                    url: 'searchEducation.php',
                    type: 'POST',
                    data: {
                        articleTitle: title,
                        articleDate: date
                    },
                })
                .done(function($data) {
                    $('.result-boxes > .row').empty();
                    $('.result-boxes > .row').prepend($data);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
                
            });
        });
    </script>
  </body>
</html>
