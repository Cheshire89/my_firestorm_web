<?php 

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$events = new Education();
$content = $events->getAdminArticles();

    $page = $_SERVER['PHP_SELF'];
    $pageName = substr(strrchr($page, "/"), 1, -4);
    $banner = new Banners();
    $bnInfo = $banner->get_admin_banner($pageName);

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin Education</title>

    
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
                    <div class="panel-heading"><h3>Banner Image Preview</h3></div>
                    <div class="panel-body banner-img-preview">
                      <img src="<?php print($bnInfo["bnImgPath"]); ?>" class="img-responsive" alt="Default Banner Image">
                      <h3 class="fs-header"><?php print($bnInfo["bnText"]); ?></h3>
                    </div>
                    <div class="panel-footer text-right">
                      <button type="button" class="fs-btn-blue btn btn-sm" id="editBannerBtn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                    </div>
                  </div>

                  <div class="panel panel-default" id="editBanner">
                    <div class="panel-heading"><h3>Edit Banner Image</h3></div>
                    <div class="panel-body">
                       <form class="form-inline fs-form-gen" action="saveBanner.php" name="saveBanner" enctype="multipart/form-data" method="POST">
                        
                         <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="bannerText" name="bannerText" placeholder="Banner Text">
                                <span class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></span>
                           </div>
                         </div>
                         <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="bannerDes" name="bannerDes" placeholder="Image Description">
                                <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                           </div>
                         </div>
                         <div class="form-group">
                            <div class="input-group">
                                <label for="bannerImg">Choose Image</label>
                                <input type="file" class="form-control" id="bannerImg" name="bannerImg">
                                <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                           </div>
                         </div>
                         <input type="hidden" name="pageName" value="<?php print($pageName);?>">
                         <input type="hidden" name="bannerID" value="<?php print($bnInfo["bannerID"]); ?>">
                         <div class="form-group controls">
                           <button type="button" class="fs-btn-green btn" id="saveBannerImgBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                         </div>  
                         
                      </form>
                  </div>
                </div>

                  <div class="panel panel-default">
                    <div class="panel-heading"><h3>Education Admin</h3></div>
                    <div class="panel-body">
                       <form class="form-horizontal fs-form-gen" action="searchEduction.php" name="searchEduction" method="POST">
                         
                         <div class="form-group">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="featVidTitle" name="featVidTitle" placeholder="Article Title">
                                    <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                               </div>
                              
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="aboutPageText" name="aboutPageText" placeholder="Article Author" />
                                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                  <div class="input-group">
                                        <input type="date" class="form-control" id="aboutPageText" name="aboutPageText" placeholder="Article Date" />
                                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </div>
                            </div>
                         </div>
                         
                         <div class="form-group controls">
                         <div class="btn-group pull-right">
                           <div class="col-xs-12"><button type="button" class="fs-btn-blue btn-sm btn" id="searchArticles"><i class="fa fa-search" aria-hidden="true"></i> Articles</button></div>
                         </div>
                         </div>  
                         
                      </form>
                  </div>
                </div>


                  <div class="panel panel-default">
                  <div class="panel-heading"><h3>Manage Education</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="educationTable">
                        <thead>
                          <tr>
                            <th class="text-center">Article Thumb</th>
                            <th>Article Title</th>
                            <th>Article Author</th>
                            <th>Article Date</th>
                            <th>Article Tags</th>
                            <th class="text-right">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                              print($content);
                           ?>
                        </tbody>

                      </table>
                    </div>
                    <div class="row table-addon">
                      <div class="col-xs-12">
                        <div class="btn-group pull-right">
                                <a href="createArticle.php" class="btn btn-sm fs-btn-green add" id="addArticle"><i class="fa fa-plus" aria-hidden="true"></i> Article</a>
                                <button type="button" class="btn btn-sm fs-btn-red rm" id="rmArticle"><i class="fa fa-trash" aria-hidden="true"></i> Article</button>
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
    <script type="text/javascript">
       $(document).ready(function(){
          $('#rmArticle').on('click',function(){
              rmArr = deleteArray($('#educationTable'));
              processDelete = $.post('deleteArticle.php', {'deleteArticles[]': rmArr}, function(textStatus){
                    deleteRow($('#educationTable'));
              });
          });
      });
    </script>
  </body>
</html>
