<?php
require_once("classes/config.php");
if(isset($_SESSION['userLevel']) && $_SESSION['userLevel'] != "") {
    switch ($_SESSION['userLevel']) {

		case 'admin':
				$redirectPage = './admin';
			break;
		
    case 'chapter_admin':
				$redirectPage = './chapter_admin';
			break;
		
    case 'member':
				$redirectPage = './member_admin';
			break;
		
    case 'incompleteMember':
				$redirectPage = './new-account.php';
			break;
		
    case 'guest':
				$redirectPage = './new-account.php';

    case 'unpaid_member':
        $redirectPage = './membership-dues.php';
			break;
  } 
    header("Location: $redirectPage");
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

    <title>Join Firestorm</title>

    
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
            <h1 class="fs-header-white text-left">Log<span class="fs-strong">In</span></h1>
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
      <div class="center-block">
         <form class="form-inline fs-form-gen" name="loginForm" action="doLogin.php" method="POST">
           <div class="form-group">
            <input type="text" class="form-control" id="login" name="login" placeholder="Log In">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-default fs-btn-orange loginBtn">Log In</button>
          </div>
         </form>
            <p class="forgot-pass help-block pull-right"><a href="reset-password.php" class="text-right">Forgot Your Password ?</a></p>
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
    	   $('.loginBtn').click(function() {
    	       valid = true;

                login = $('#login').val();
                password = $('#password').val();
    
                if(login ==""){
                  $("#login").closest('.form-group').addClass('has-error').append('<p class="help-block error">This field can not be empty</p>');
                  valid = false;
                }
                if(password ==""){
                  $("#password").closest('.form-group').addClass('has-error').append('<p class="help-block error">This field can not be empty</p>');
                  valid = false;
                }
    
                if(valid){
                  document.loginForm.submit();
                }else{
                  $('#loginForm').focus();
                }
            });
            
            $('#login, #password').on("keypress", function(e) {
    			if(e.which == 13) {
    				$('.loginBtn').click();
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
