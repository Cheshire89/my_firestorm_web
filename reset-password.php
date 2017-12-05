<?php

require_once("classes/config.php");

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Join Firestorm</title>

    
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
    
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="img/slider/slide-1.png" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left">Reset<span class="fs-strong">Password</span></h1>
        </div>
      </div>
    </div>

    <div class="container on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                <li><a href="sign-login.php" title="">Log In</a></li>
                <li><a href="new-account.php" title="">New Account</a></li>
                <li class="active"><a href="reset-password.php" title="">Reset Password</a></li>
            </ul>
          </div>
      </nav>
    </div>
    
    <div class="container on-page-menu offset-menu" style="text-align:center;">
      <div class="center-block">
        <?php if($_GET['success'] == "true") { ?>
            <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> Your password Reset request has been sent.</div>
        <?php } ?>
        <?php if($_GET['success'] == "false") { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> There was an error attempting to send your password reset request, please try again. If this problem persists, please contact support.</div>
        <?php } ?>
         <form class="form-inline fs-form-gen resetPassword" name="resetPassword" action="doResetPassword.php" method="POST">
           <div class="form-group">
            <input type="email" class="form-control" id="email" name="email" placeholder="ENTER EMAIL">
          </div>
          
          <button type="button" class="btn btn-default fs-btn-orange resetPasswordBtn">Reset Password</button>
         </form>
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
    #email{
       width:50ch;

    }
    @media (max-width: 767px){
      #email{
        width: 80%;
        display: block;
        margin-right: auto;
        margin-left: auto;
      }
    }

  </style>
  <script type="text/javascript">
    <!--
    	$(document).ready(function() {
    	   $('.resetPasswordBtn').click(function() {
    	       valid = true;

                var email = $('#email').val();
    
                if(email ==""){
                  $("#email").closest('.form-group').addClass('has-error');
                  valid = false;
                }
    
                if(valid){
                  document.resetPassword.submit();
                }else{
                  $('.resetPassword').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out all fields highlighted in Red.</div>');
                }
            });
        });
    -->
    </script>
</html>