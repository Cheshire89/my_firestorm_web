<?php

    require_once("classes/config.php");
    
    $users = new Users();
    $all = $users->print_members();
    $banners = new Banners();
    $banner = $banners->getBanner('users-authenticated');

    $ind = new Industry();
    $industryList = $ind->html_options_list();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Members</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      @media (max-width: 450px){
        .featured-member{
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="<?php if(substr($banner["bnImgPath"], 0, 2) == "..") { print(substr($banner["bnImgPath"], 1)); } else { print($banner["bnImgPath"]); } ?>" alt="<?php print($banner["bnImgDesc"]);?>" style="width:100%; ">
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
           <form class="form-inline fs-form-gen" name="searchMembersForm" method="POST">
            <div class="form-group">
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
            </div>
            <div class="form-group">
                <select class="form-control" id="industry" name="industry">
                  <option value=""> Select </option>
                   <?php print($industryList); ?>
                </select>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default fs-btn-orange" id="searchMembersBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
           </form>
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
        $('#searchMembersBtn').on('click',function(){
            var fName = $('#firstName').val();
            var lName = $('#lastName').val();
            var ind = $('#industry').val();

            $.ajax({
                url: 'searchMembers.php',
                type: 'POST',

                data: {
                    firstName: fName,
                    lastName: lName,
                    industry: ind
                },
            })
            .done(function(data) {
                $('.result-boxes > .row').empty();
                $('.result-boxes > .row').prepend(data);
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

  <style type="text/css">
    .featured-member .img-circle{
      width: 170px;
      height: 170px;
    }
  </style>
</html>
