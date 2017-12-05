<?php 
  require_once('classes/config.php');
  

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Join Firestorm | Thank You</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/486ff18bfe.css" media="all">
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      .message{
        margin-top:30px;
        margin-bottom: 45px;
      }
    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="img/slider/slide-1.png" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left">Thank <span class="fs-strong">You</span></h1>
        </div>
      </div>
    </div>

    <div class="container on-page-menu offset-menu" style="margin-top:-40px;">
         <div class="col-md-10 col-md-offset-1" id="product">
            <div class="row">
                <?php 
                    if(isset($_GET["fee"]) && $_GET["fee"] == 'paid'){
                      print('<h1 class="fs-header message text-center">Your Payment was processed. We will contact you shortly <strong>Thank You !</strong></h1>');
                    }


                    if(isset($_GET["subscription"]) && $_GET["subscription"] == 'paid' && isset($_GET["user"]) && $_GET["user"] !== ''){
                         $userID  = $_GET["user"];
                      print('<h1 class="fs-header message text-center">Your Subscription was processed. <strong>Thank You !</strong></h1><h3 class="text-center"><a href="sign-login.php" title="login">You may now login and access your profile</a></h3>');
                    }

                    if(isset($_GET["waiting"]) && $_GET["waiting"] == 'approval'){
                      print('<h1 class="fs-header message text-center"><strong>Your Initiation Fee was Processed.</strong></h1><h3 class="text-center fs-header">Please Wait. You\'ll receive and email once you are approved</h3>');
                    }
                ?>
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
    <script type="text/javascript">
    <!--
    	
    </script>
  </body>

  <style type="text/css">
    .form-group.has-error .form-control{
      border-color: #BD2031;
      box-shadow: 0 2px 3px rgba(189, 32,49, 0.4);
    }

    .disclaimer{
      border-color: #d36a1d;
      border-radius: 0px;
    }
    .disclaimer .panel-heading{
      border-bottom: 1px solid #d36a1d;
      background-color: #d36a1d;
      color:white;
    }

    #paymentForm{
      display: none;
    }

    .product{
      color: #d36a1d;
      background-color: white;
      min-height: 250px;
      margin-top: 20px;
      border:2px solid #d36a1d;

    }
    .product > [class*='col-'], .product > [class*="col-"]{
      height: 250px;
    }
    .product .product-desc .fs-header:first-child{
      margin-top:75px;
    }
    .product .fa{
      font-size: 8em;
      line-height: 250px;
    }
    .alert{
      margin-bottom: 0px;
    }

  </style>
</html>
