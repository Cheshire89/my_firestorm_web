<?php 

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$events = new Chapters();
$content = $events->getAdminChapters();

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
                    <div class="panel-heading"><h3>Chapters Admin</h3></div>
                    <div class="panel-body">
                       <form class="form-horizontal fs-form-gen" action="saveAboutPage.php" name="saveAboutPage" method="POST">
                       
                         <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="chapterName" name="chapterName" placeholder="Chapter Name">
                                    <span class="input-group-addon">H</span>
                               </div>
                              
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-4">
                              <div class="input-group">
                                    <input type="text" class="form-control" id="chapterCity" name="chapterCity" placeholder="Chapter Zip" />
                                    <span class="input-group-addon">C</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                    <select class="form-control" id="chapterState" name="chapterState">
                                        <option>Chapter State</option>
                                        <option>Colorado</option>
                                        <option>Arizona</option>
                                    </select>
                                    <span class="input-group-addon">S</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                    <input type="text" class="form-control" id="chapterZip" name="chapterZip" placeholder="Chapter Zip" />
                                    <span class="input-group-addon">Z</span>
                                </div>
                            </div>
                         </div>
                         
                         <div class="row controls">
                            <div class="col-xs-12">
                               <div class="btn-group btn-g pull-right">
                                 <button type="button" class="fs-btn-blue btn-sm btn saveAboutPage"><i class="fa fa-search" aria-hidden="true"></i> Chapters</button>
                               </div>
                             </div>
                         </div>  
                         
                      </form>
                  </div>
                </div>


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
                            <a href="createChapter.php" class="btn btn-sm fs-btn-green add" id="addChapter"><i class="fa fa-plus" aria-hidden="true"></i> Chapter</a>
                            <button type="button" class="btn btn-sm fs-btn-red rm" id="rmChapter"><i class="fa fa-trash" aria-hidden="true"></i> Chapter</button>
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
    <script type="text/javascript" src="js/chapters.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          $('#rmChapter').on('click',function(){
              rmArr = deleteArray($('#chaptersTable'));
              processDelete = $.post('deleteChapter.php', {'deleteChapters[]': rmArr}, function(textStatus){
                  deleteRow($('#chaptersTable'));
              });
          });
      });
      
    </script>
  </body>

  <style type="text/css">
    

  </style>
</html>
