<?php 
  require_once('classes/config.php');

  $checkUser = new User_Valid();
  if(!$checkUser->isLoggedIn()){
      header('Location: /');
      exit();
  }
  
  $ind = new Industry();
  $industryList = $ind->html_options_list();
  $chapters = new Chapters();
  $chaptersList = $chapters->printChaptersOption();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Name of A Person</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php echo date('U')?>" rel="stylesheet">
    <link href="styles/css/event.css?v=<?php echo date('U')?>" rel="stylesheet">
    <link href="styles/css/profile.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>

    
    
   <div class="container info">
     <div class="row">
              <div class="col-xs-12">
                  <form class="form-horizontal fs-form-gen " action="saveUser.php" method="POST" name="profileGenInfo" id="profileGenInfo">
                      <div class="form-group">
                          <div class="col-md-10 col-md-offset-1 bg-grey">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-left">
                                          <div class="col-md-12">
                                            <h4 class="fs-header">Create <span class="fs-strong">User</span></h4>
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <div class="col-xs-12 col-md-6">
                                            <label class="h5" for="fName">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"/>
                                          </div>
                                          <div class="col-xs-12 col-md-6">
                                            <label class="h5" for="lName">Password</label>
                                            <input type="password" class="form-control" id="pass" name="pass" value=""/>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="col-xs-12 col-md-6">
                                            <label class="h5" for="fName">First Name</label>
                                            <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" />
                                          </div>
                                          <div class="col-xs-12 col-md-6">
                                            <label class="h5" for="lName">Last Name</label>
                                            <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" />
                                          </div>
                                        </div>
                                        
                                    </div>
                                </div>
                          </div>
                      </div>
                   </form>
            </div>
        </div>
    </div>
    
    <?php require_once('php/footer.php') ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Optional -->
    <!-- jQuery Ui -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="js/jquery.fileupload.js"></script>

    <script type="text/javascript">

    $(document).ready(function(){
      $('#email, #password, #fName, #lName').on('blur', function(){
          $email = $('#email').val();
          $password = $('#password').val();
          $fName = $('#fName').val();
          $lName = $('#lName').val();
          
          if($email != '' && $password != '' && $fName != '' && $lName != ''){
            document.profileGenInfo.submit();
          }
      });
      });
    </script>
  </body>

  <style type="text/css">
    .text-center{
      text-align: center !important;
    }
    label[for="profilePic"], label[for="coverPic"]{
      font-size: 1em !important;
      text-align: center;
      margin-left: 25%;
    }

  </style>
</html>
