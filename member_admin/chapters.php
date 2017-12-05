<?php 
require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
}

$events = new Chapters();
$content = $events->getAdminChapters();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin Events</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
      <div class="container" id="adminContainer">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
           <div class="row" id="adminSubNav">
               <div class="col-xs-12">
               
                  <div class="panel panel-default">
                  <div class="panel-heading"><h3>Manage Chapters</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="chaptersTable">
                        <thead>
                          <tr>
                            <th class="text-center">Chapter Image</th>
                            <th>Chapter Name</th>
                            <th class="text-center">Chapter City</th>
                            <th class="text-center">Chapter State</th>
                            <th class="text-center">Chapter Zip</th>
                            <th class="text-center">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php print($content); ?>
                        </tbody>

                      </table>
                    </div>
                  </div>
                </div>


                </div>
           </div>
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
    <script type="text/javascript" src="js/chapters.js"></script>
  </body>

</html>