<?php
  require_once('classes/config.php');
  $about = new About();
  $content = $about->getAbout();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin About</title>

    
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
            <div class="row">
                <div class="col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading"><h3>Banner Image Preview</h3></div>
                    <div class="panel-body banner-img-preview">
                      <img src="<?php print($content["bannerImg"]); ?>" class="img-responsive" alt="Default Banner Image">
                      <h3 class="fs-header">Banner Text Goes Here</h3>
                    </div>
                    <div class="panel-footer text-right">
                      <button type="button" class="fs-btn-blue btn btn-sm" id="editBannerBtn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                    </div>
                  </div>

                  <div class="panel panel-default" id="editBanner">
                    <div class="panel-heading"><h3>Edit Banner Image</h3></div>
                    <div class="panel-body">
                       <form class="form-inline fs-form-gen" action="saveAbout.php" name="saveAbout" enctype="multipar/form-data" method="POST">
                             <div class="form-group">
                                 
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="bannerText" name="bannerText" placeholder="Banner Text">
                                        <span class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></span>
                                    </div>
                                 
                             </div>
                             <div class="form-group">
                               
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="bannerDesc" name="bannerDesc" placeholder="Image Description">
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

                             <div class="form-group controls">
                                  <div class="btn-group pull-right">
                                     <button type="button" class="fs-btn-green btn" id="saveBannerImgBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                  </div>
                               
                             </div>  
                         
                      </form>
                  </div>
                </div>
        
                  <div class="panel panel-default">
                        <div class="panel-heading"><h3>About Admin</h3></div>
                        <div class="panel-body">
                           <form class="form-horizontal fs-form-gen" action="saveAbout.php" name="saveAboutText" method="POST">
                               <div class="form-group">
                                   <div class="col-xs-12">
                                      <div class="input-group">
                                          <input type="text" class="form-control" id="aboutTitle" name="aboutTitle" placeholder="Main Header">
                                          <span class="input-group-addon">H</span>
                                      </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <textarea class="form-control" id="aboutPageText" name="aboutPageText" placeholder="About Page Content"></textarea>
                                    </div>
                                </div>
                                <div class="form-group controls">
                                   <div class="col-xs-12">
                                      <div class="btn-group pull-right">
                                          <button type="button" class="fs-btn-green btn saveAboutPage"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                      </div>
                                    </div>
                                </div>  
                             
                          </form>
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
    <script type="text/javascript" src="js/init-tynymce.js"></script>
    <link href="styles/css/tinymce-custom.css?v=<?php date('U')?>" rel="stylesheet">
  </body>

  <style type="text/css">
    

  </style>
</html>
