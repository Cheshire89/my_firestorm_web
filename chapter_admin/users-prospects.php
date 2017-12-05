<?php

    require_once("classes/config.php");

    $checkUser = new User_Valid();
    if(!$checkUser->isLoggedIn()){
        header('Location: /');
        exit();
    }
    
    $prospects = new Users();
    $chapters = new Chapters();
    $chaptersData = $chapters->getListChapters();
    $adminProspects = $prospects->get_admin_prospects($chaptersData);
    
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin Members | Prospects</title>

    
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
              <div class="row on-page-nav admin-nav" id="adminSubNav">
                <div class="col-xs-12">
                <nav class="navbar">
                    <div class="navbar-collapse">
                      <ul class="nav nav-justified">
                          <li><a href="users-authenticated.php" title="">Authenticated</a></li>
                          <li class="active"><a href="users-prospects.php" title="">Prospects</a></li>
                      </ul>
                    </div>
                </nav>
                </div>
              </div>
              <div class="row" style="margin-top:20px;">
               <div class="col-xs-12">
                  

                  <div class="panel panel-default">
                    <div class="panel-heading"><h3>Members Admin (Prospects)</h3></div>
                    <div class="panel-body">
                       <form class="form-horizontal fs-form-gen" action="searchMembers.php" name="searchMembers" method="POST">
                        
                         <div class="form-group">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="memName" name="memName" placeholder="Member Name">
                                    <span class="input-group-addon">N</span>
                               </div>
                              
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="memID" name="memID" placeholder="Member ID" />
                                    <span class="input-group-addon">ID</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                  <div class="input-group">
                                        <input type="text" class="form-control" id="memInd" name="memInd" placeholder="Member Industry" />
                                        <span class="input-group-addon">ND</span>
                                    </div>
                            </div>
                         </div>
                         
                         <div class="row controls">
                         <div class="btn-group pull-right">
                           <div class="col-xs-12"><button type="button" class="fs-btn-blue btn-sm btn" id="searchMembersBtn"><i class="fa fa-search" aria-hidden="true"></i> Prospects</button></div>
                           <!-- <a href="educationCreate.php" class="fs-btn-green btn-sm btn saveAboutPage"><i class="fa fa-floppy-o" aria-hidden="true"></i></a> -->
                         </div>
                         </div>  
                         
                      </form>
                  </div>
                </div>


                  <div class="panel panel-default">
                  <div class="panel-heading"><h3>Manage Prospects</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                        <table class="table table-striped table table-striped editable-table" id="manageUsers">
                          <thead>
                            <tr>
                              <th>Prospect Picture</th>
                              <th>Prospect Name</th>
                              <th class="text-center">Prospect ID</th>
                              <th>Prospect Industry</th>
                              <th class="text-right">Select</th>
                              <!-- <th class="text-center">Set As Featured Prospect</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              print($adminProspects);
                            ?>
                            
                          </tbody>
                        </table>
                    </div>
                    <div class="row table-addon">
                      <div class="col-xs-12">
                        <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm fs-btn-green add addProspect" id="addProspect"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button> 
                                <button type="button" class="btn btn-sm fs-btn-red rm rmProspect" id="rmProspect"><i class="fa fa-trash" aria-hidden="true"></i> Prospect</button>
                              </div>
                      </div>
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
    <script type="text/javascript" src="js/users.js"></script>
  </body>

  <style type="text/css">
    

  </style>
</html>
