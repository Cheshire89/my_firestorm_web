<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$videos = new videos();
$allVideos = $videos->getAllVideos();

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

    <title>Firestorm Admin Videos</title>

    
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
                <div class="panel-heading"><h3>Manage Videos ( Search )</h3></div>
                <div class="panel-body">
                   <form class="form-inline fs-form-gen searchVideo" name="searchVideo" method="POST">
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="s_videoTitle" name="s_videoTitle" placeholder="Video Title">
                            <span class="input-group-addon">N</span>
                       </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                            <select class="form-control" id="s_videoCategory" name="s_videoCategory">
                              <option value=""> Select </option>
                              <option value="Education"> Education </option>
                              <option value="Event"> Event </option>
                              <option value="Other"> Other </option>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                       </div>
                     </div>
                     
                     <div class="form-group controls">
                      <div class="btn-group pull-right">
                       <button type="button" class="btn fs-btn-blue" id="searchVideoBtn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                       <button type="button" class="btn fs-btn-green add" id="addVideo"><i class="fa fa-plus" aria-hidden="true"></i> Video</button>
                       </div>
                     </div>  
                     
                  </form>
              </div>
            </div>
               

             <div class="panel panel-default" id="videoResults" style="display: block;">
                  <div class="panel-heading"><h3>Video Admin</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="videosTable">
                        <thead> 
                          <tr>
                            <th>Video Title</th>
                            <th>Video Link</th>
                            <th>Video Category</th>
                            <th class="text-center">Upload Date</th>
                            <th class="text-right">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php print($allVideos); ?>
                        </tbody>

                      </table>
                    </div>
                    <div class="row table-addon">
                      <div class="col-xs-12">
                              <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm fs-btn-red rm" id="rmVideo"><i class="fa fa-trash" aria-hidden="true"></i> Video</button>
                              </div>
                      </div>
                    </div>
                </div>
              </div>
              

             <div class="panel panel-default" id="videoForm">
                <div class="panel-heading"><h3>Edit Video</h3></div>
                <div class="panel-body">
                   <form class="form-inline fs-form-gen saveVideoForm" action="saveVideoForm.php" name="saveVideoForm" method="POST">
                   
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="videoTitle" name="videoTitle" placeholder="Video Title">
                            <span class="input-group-addon">N</span>
                       </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Video Link">
                            <span class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></span>
                       </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                            <select class="form-control" id="videoCategory" name="videoCategory">
                              <option value=""> Select </option>
                              <option value="Education">Education</option>
                              <option value="Event">Event</option>
                              <option value="Testimonial">Testimonial</option>
                              <option value="Other">Other</option>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                       </div>
                     </div>
                     <div class="form-group hidden">
                       <input type="hidden" id="videoId" name="videoId" value="" />
                     </div>
                     
                     <div class="form-group controls">
                       <button type="button" class="fs-btn-green btn pull-right" id="savemyVideoBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                     </div>  
                     
                  </form>
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
    <script type="text/javascript" src="js/videos.js"></script>
    <script type="text/javascript">
    <!--
    	$(document).ready(function() {
    	   $('input, select, textarea').focus(function() {
            	$(this).closest('.form-group').removeClass("has-error");
            });
           
    	   $('#savemyVideoBtn').click(function() {
    	       $('.has-error').closest(".form-group").removeClass("has-error");
               
    	       var videoTitle = $('#videoTitle').val();
               var videoLink = $('#videoLink').val();
               var videoCategory = $('#videoCategory').val();
               var valid = true;
               
                if(videoTitle == "") {
            		valid = false;
            		$('#videoTitle').closest(".form-group").addClass("has-error");
            	}
                
                if(videoLink == "") {
            		valid = false;
            		$('#videoLink').closest(".form-group").addClass("has-error");
            	}
                
                if(videoCategory == "") {
            		valid = false;
            		$('#videoCategory').closest(".form-group").addClass("has-error");
            	}
    
                if(valid){
                    document.saveVideoForm.submit();
                } else {
                    $('.saveVideoForm').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out all fields highlighted in Red.</div>');
                }
                    
    	   });
           
           $('#searchVideoBtn').click(function() {
               var videoTitle = $('#s_videoTitle').val();
               var videoCategory = $('#s_videoCategory').val();
               
               if(videoTitle != "" || videoCategory != "") {
                    $.post("searchVideos.php", {'videoTitle': videoTitle, 'videoCategory': videoCategory}, function(result) {
            			if(result != "Error") {
            			   $('#videosTable').find("tbody").empty();
                           $('#videosTable').find("tbody").append(result);
            			} else {
            			   //console.log(result);
            			}
            		});
                } else {

            		$('#s_videoTitle').closest(".form-group").addClass("has-error");
            		$('#s_videoCategory').closest(".form-group").addClass("has-error");
                    
                    $('.searchVideo').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out at least 1 field.</div>');
                }
           });
           
           $('#rmVideo').click(function() {
               var id = $("input[name='videos']:checked"). val();
               if(id != "") {
                  document.location.href = 'deleteVideo.php?id='+id;
               }
           });
           
    	});
     
    -->
    </script>
  </body>
</html>
