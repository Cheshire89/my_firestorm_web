<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Events Near You!</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
   
     <div class="container-fluid hero-img no-gutter" style="margin-top:-15px;">
       <div class="col-xs-12 col-sm-6">
            <a href="events.php">
            <div class="row slide">
               <img class=" center-block" src="img/Invest.jpg">
            </div>
            <div class="row no-gutter slider-navigation header-text">
                  <h1 class="fs-header-white text-center"><i>Firestorm</i><span class="fs-strong">Events</span></h1>
            </div>
            </a>
       </div>
       <div class="col-xs-12 col-sm-6">
            <a href="events.php">
            <div class="row slide">
               <img class=" center-block" src="img/program.jpg">
            </div>
            <div class="row no-gutter slider-navigation header-text">
                  <h1 class="fs-header-white text-center"><i>Other</i><span class="fs-strong">Events</span></h1>
              
            </div>
            </a>
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
  </body>

  <style type="text/css">
    .hero-img{
        padding-left: 0px;
        padding-right:0px;
        margin-bottom: -25px;
    }
     .hero-img >div{
    }

    .hero-img .slide{
        height: 600px;
    }


    .hero-img a .slide img{
      object-fit: cover;
      object-position: center;
      width: 100%;
      height: 100%;
      opacity: 0.7;

        -webkit-transition: all 0.4s ease-in-out;
        -moz-transition: all 0.4s ease-in-out;
        -o-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }

    .hero-img a:hover .slide img{
      opacity:1;
    }

    .hero-img a:hover .slider-navigation{
      background-color: rgba(255,255,255, 0.8);
    }
    .hero-img a:hover .slider-navigation h1{
      color:#d36a1d;
    }

    .hero-img .slider-navigation{
        top:35%;
    }


  </style>
</html>
