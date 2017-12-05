<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm | Transaction Summary</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/486ff18bfe.css" media="all">
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="img/slider/slide-1.png" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left">Transaction <span class="fs-strong">Summary</span></h1>

        </div>
      </div>
    </div>

    <div class="container on-page-menu offset-menu" style="margin-top:-40px;">
         <div class="col-md-10 col-md-offset-1" style="margin-top: 30px;">
           <div class="row">
             <div class="col-md-7">
              <div class="row">
                <div class="col-sm-6 col-md-12">
                   <h3 class="fs-header">Billing <span class="fs-strong">Address</span></h3>
                   <p class="fs-header-black">123 Lorem Ipsum Street</p>
                   <p class="fs-header-black">Unit 102</p>
                   <p class="fs-header-black">Denver, CO 80202</p>
                </div>
                <div class="col-sm-6 col-md-12">
                 <h3 class="fs-header">Billing <span class="fs-strong">Method</span></h3>
                 <p class="fs-header">Credit Card Type:<span class="fs-header-black"><i class="fa fa-cc-visa" aria-hidden="true"></i> Visa</span></p>
                 <p class="fs-header">Credit Card Number: <span class="fs-header-black">****-****-****-1234</span></p>
                 <p class="fs-header">Card Card Exparation: <span class="fs-header-black">10/2021</span></p>
                 <p class="fs-header-black"></p>
                 <p class="fs-header">Recurring Method: <span class="fs-header-black">Quoterly</span></p>
                 </div>
               </div>
               
             </div>
             <div class="col-md-5">
               <ul class="list-group summary">
                 <li class="list-group-item">
                 <h3 class="fs-header">Order <strong>Summary</strong></h3></li>
                 <li class="list-group-item">
                   <p class="h4 fs-header-black">Firestorm -Quoterly- Subscription</p>
                 </li>
                 <li class="list-group-item">
                   <p class="fs-header-black">Total: $180.00</p>
                 </li>
                 <li class="list-group-item text-right">
                   <button type="button" class="btn fs-btn-orange btn-md" id="checkoutBtn">Place Order</button>
                 </li>
               </ul>
             </div>
           </div>
         </div>
         

    </div>
    

    <?php require_once('php/footer.php') ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/script.js"></script>
    <style type="text/css">
      p.fs-header, span.fs-header-black, p.fs-header-black{
        font-weight: 400;
      }
      .on-page-menu{
        padding-bottom: 35px;
      }

      .summary{
        /*box-shadow: 0px 0px 4.75px 0.25px rgba(34, 34, 34, 0.75);*/
        border-left: 2px dotted #d36a1d;
        height: 100%;
      }
      .summary .list-group-item{
         background-color: #efefef;
         border:0px;
      }

      @media (max-width: 991px){
        .summary{
          border-top: 2px dotted #d36a1d;
          border-left: 0px;
        }
      }
    </style>
  </body>
</html>
