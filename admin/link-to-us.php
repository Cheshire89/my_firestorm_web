<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
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

    <title>Firestorm Admin Create Event</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    <link href="../styles/css/log-in.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
    .panel.panel-default{
        border-top:0px none;
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        padding-top:15px;
    }
  </style>
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
                              <li class="active"><a href="link-to-us.php" title="">Link to Us</a></li>
                              <li><a href="membership-agreement.php" title="">Membership Agreement</a></li>
                              <li><a href="privacy-policy.php" title="">Privacy Policy</a></li>
                              <li><a href="terms-of-use.php" title="">Terms of Use</a></li>
                          </ul>
                        </div>
                    </nav>
                </div>
              </div>

            <div class="row">
                <div class="col-xs-12">

                 <div class="panel panel-default">
                  
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="linksTable">
                        <thead>
                          <tr>
                            <th class="text-center">Link Img</th>
                            <th>Link Name</th>
                            <th>Link</th>
                            <th class="text-right">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><img class="img-responsive center-block" src="img/member-black.png" alt="Member Black Banner"></td>
                            <td class="title">Member Black Banner</td>
                            <td><textarea class="code"><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea></td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="linkToUs1" value="" name="links">
                                <label for="linkToUs1">
                                </label>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><img class="img-responsive center-block" src="img/member-white.png" alt="Member White Banner"></td>
                            <td class="title">Member White Banner</td>
                            <td><textarea class="code"><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea></td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="linkToUs2" value="" name="links">
                                <label for="linkToUs2">
                                </label>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><img class="img-responsive center-block" src="img/partner-black.png" alt="Partner Black Banner"></td>
                            <td class="title">Partner Black Banner</td>
                            <td><textarea class="code"><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea></td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="linkToUs3" value="" name="links">
                                <label for="linkToUs3">
                                </label>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><img class="img-responsive center-block" src="img/partner-white.png" alt="Partner White Banner"></td>
                            <td class="title">Partner White Banner</td>
                            <td><textarea class="code"><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea></td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="linkToUs3" value="" name="links">
                                <label for="linkToUs3">
                                </label>
                              </div>
                            </td>
                          </tr>

                        </tbody>

                      </table>
                    </div>
                    <form class="form-horizontal fs-form-gen" name="" action="" id="sponsorForm" style="margin-top:15px; padding-top:15px;">
                          <div class="col-xs-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="linkImg">Select Banner Image</label>
                                    <input type="file" class="form-control" id="linkImg" name="linkImg">
                                    <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                      <input class="form-control" type="text" id="linkName" name="linkName" placeholder="Banner Name"/>
                                      <span class="input-group-addon">N</span>
                                  </div>
                            </div>
                            <div class="form-group">
                                
                                      <textarea class="form-control" type="text" id="link" name="link" placeholder="Banner Link"/></textarea>
                                      
                                 
                            </div>
                          </div>
                    </form>
                    <div class="row table-addon">
                      <div class="col-xs-12">
                        <div class="btn-group pull-right">
                                <button class="btn btn-sm fs-btn-green add" id="addLink"><i class="fa fa-plus" aria-hidden="true"></i> Link</button>
                                <button type="button" class="btn btn-sm fs-btn-red rm" id="rmLink"><i class="fa fa-trash" aria-hidden="true"></i> Link</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- Closing Divs -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/link-to-us.js"></script>
    
  </body>
  <style type="text/css">
    


  </style>
</html>
