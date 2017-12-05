<!DOCTYPE html>
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
            <h1 class="fs-header-white text-left">Admin<span class="fs-strong">Login</span></h1>
        </div>
      </div>
    </div>

    <div class="container on-page-menu offset-menu" style="text-align:center; margin-top: -50px;">
      <div class="center-block">
         <form class="form-inline fs-form-gen" action="doLogin.php" name="adminLoginForm" id="adminLoginForm" method="POST">
           <div class="form-group">
            <input type="text" class="form-control" id="login" name="login" placeholder="Log In">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <button type="button" class="btn btn-default fs-btn-orange" id="logInBtn">Log In</button>
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
      $(document).ready(function(){
        $('#logInBtn').on('click',function(){
          valid = true;

            adminLogin = $('#login').val();
            adminPassword = $('#password').val();

            if(adminLogin ==""){
              $("#login").closest('.form-group').addClass('has-error').append('<p class="help-block error">This field can not be empty</p>');
              valid = false;
            }
            if(adminPassword ==""){
              $("#password").closest('.form-group').addClass('has-error').append('<p class="help-block error">This field can not be empty</p>');
              valid = false;
            }

            if(valid){
              document.adminLoginForm.submit();
            }else{
              $('#adminLoginForm').focus();
            }
        });
      });
    </script>
  </body>

  <style type="text/css">
    .form-group{
      position: relative;
    }


    .form-group .help-block{
    position: absolute;
   /* right: 5px;*/
    left:0px;
    bottom: -90%;
    font-size: 0.8em;
    text-align: left;
    }    
    .form-group .help-block a{
    color:tomato;
    }
    .form-group .help-block a:hover{
    color:red;
    text-decoration: none;
    }
      #login, #password{
      width: 35ch;
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
