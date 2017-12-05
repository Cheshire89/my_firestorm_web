<?php

require_once("classes/config.php");

if(isset($_GET['passcode']) && $_GET['passcode'] != "" && isset($_GET['email']) && $_GET['email'] != "") {
    
    $passcode = $_GET['passcode'];
    $email = $_GET['email'];
    
} else {
    header("Location: ./");
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

    <title>Join Firestorm | Set New Password</title>

    
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
            <h1 class="fs-header-white text-left">Reset<span class="fs-strong">Password</span></h1>
        </div>
      </div>
    </div>
    <div class="container on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                <li class="active"><a href="sign-login.php" title="">Log In</a></li>
                <li><a href="new-account.php" title="">New Account</a></li>
                <li><a href="reset-password.php" title="">Reset Password</a></li>
            </ul>
          </div>
      </nav>
    </div>

    <div class="container on-page-menu offset-menu" style="text-align:center;">
      <div class="center-block row">
        <?php if($_GET['success'] == "true") { ?>
            <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> Your password has been Reset.</div>
        <?php ?>
        <?php if($_GET['success'] == "false") { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> There was an error attempting to reset your password, please click the link from your email to try again.</div>
        <?php } ?>
        <?php if($_GET['success'] == "false") { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oh no!</strong> This password reset request has expired.</div>
        <?php } ?>
         <form class="form-horizontal fs-form-gen col-md-6 col-md-offset-3 resetForm" name="resetPassword" action="doNewPassword.php" method="POST">
            <input type="hidden" name="resetID" id="resetID" value="<?php print($resetID); ?>" />
            <input type="hidden" name="email" id="email" value="<?php print($email); ?>" />
           <div class="form-group">
            <label>New Password</label>
            <input type="text" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="confPassword" name="confPassword">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default fs-btn-orange saveNewPasswordBtn">Save New Password</button>
          </div>
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
    <script type="text/javascript">
    <!--
    	$(document).ready(function() {
    	   $('.saveNewPasswordBtn').click(function() {
    	       valid = true;

            var confPassword = $('#confPassword').val();
            var password = $('#password').val();
            var resetID = $('#resetID').val();
            var email = $('#email').val();
            
            if(confPassword != password) {
                valid = false;
            }

            if(confPassword ==""){
              $("#confPassword").closest('.form-group').addClass('has-error');
              valid = false;
            }
            if(password ==""){
              $("#password").closest('.form-group').addClass('has-error');
              valid = false;
            }

            if(valid){
              document.loginForm.submit();
            }else{
              $('.resetForm').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out all fields highlighted in Red.</div>');
            }
        });
    	});
    -->
    </script>
  </body>

  <style type="text/css">
    .forgot-pass a{
        color:tomato;

    }
    .forgot-pass a:hover{
    color:red;
    text-decoration: none;
    }

    @media (max-width: 767px){
      #login, #password{
        width: 80%;
        display: block;
        margin-right: auto;
        margin-left: auto;
      }
    }

  </style>
</html>
