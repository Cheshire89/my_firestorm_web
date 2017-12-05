<?php
    require_once('classes/config.php');
    $events = new Events();
    if(isset($_GET['type']) && $_GET['type'] == "other") {
        $content = $events->getOtherEvents();
    } else {
        $content = $events->getEvents();
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

    <title>Firestorm Events Near You!</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
    .hero-img{
        padding-left: 0px;
        padding-right:0px;
        max-height: none!important;
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

    .hero-img a.active .slide img, .hero-img a:hover .slide img{
      opacity:1;
    }

    .hero-img a.active .slider-navigation, .hero-img a:hover .slider-navigation{
      background-color: rgba(255,255,255, 0.8);
    }

    .hero-img a.active .slider-navigation h1, .hero-img a:hover .slider-navigation h1{
      color:#d36a1d;
    }

    .hero-img .slider-navigation{
        top:35%;
    }

    .location, .event-title{
        height: 28px;
        max-height: 38px;
        line-height: 19px;
        font-size:15px;
        text-overflow: ellipsis;
        overflow:hidden;
        margin-top:3px;
        margin-bottom: 3px;
    }

    .location{
        font-size: 13px;
    }
    .event-title{
        height: 45px;
        max-height: 45px;
    }
    .event-title .fs-header-black{
        font-size: 16px;
        margin-bottom: 4px;
        text-overflow: ellipsis;
    }
    .result-boxes .thumbnail .list-inline .list-group-item{
        padding-top:5px;
        padding-bottom:5px;
    }

    @media (max-width: 768px){
        .hero-img .slide{
            height: 350px;
        }
    }

    @media (max-width: 450px){
        .event{
            width: 100%;
        }
        .hero-img .slide{
            height: 250px;
        }
    }


  </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
     <div class="container-fluid hero-img no-gutter" style="margin-top:-15px;">
       <div class="col-xs-6">
            <a href="events.php?type=firestorm" class="active">
            <div class="row slide">
               <img class=" center-block" src="img/Invest.jpg">
            </div>
            <div class="row no-gutter slider-navigation header-text">
                  <h1 class="fs-header-white text-center"><i>Firestorm</i><span class="fs-strong">Events</span></h1>
            </div>
            </a>
       </div>
       <div class="col-xs-6">
            <a href="events.php?type=other">
            <div class="row slide">
               <img class=" center-block" src="img/program.jpg">
            </div>
            <div class="row no-gutter slider-navigation header-text">
                  <h1 class="fs-header-white text-center"><i>Other</i><span class="fs-strong">Events</span></h1>
              
            </div>
            </a>
       </div>
    </div>

    
    <div class="container on-page-menu" style="text-align:center;">
    <div class="center-block">
       <form class="form-inline fs-form-gen" action="searchEvents.php" name="search" method="POST">
         <div class="form-group">
          <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Search Events">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="eventCity" name="eventCity" placeholder="Ex: Denver">
        </div>
        <div class="form-group">
          <input type="date" class="form-control" id="eventDate" name="eventDate" placeholder="Ex 10/06/2015">
        </div> 
        <div class="form-group">
            <button type="button" class="btn btn-default fs-btn-orange" id="searchEventsBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
       </form>
    </div>
    </div>

    <div class="container">
        <div class="row">
            <h2 class="fs-header h3 text-center">General Header <span class="fs-strong">Bold Text Option</span></h2>
        </div>
    </div>

    <div class="container result-boxes">
        <div class="row">
            <?php print($content);?>
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
            $('#searchEventsBtn').on('click',function(){
                var title = $('#eventTitle').val();
                var city = $('#eventCity').val();
                var date = $('#eventDate').val();

                $.ajax({
                    url: 'searchEvents.php',
                    type: 'POST',
                    data: {
                        eventTitle: title,
                        eventCity: city,
                        eventDate: date
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
