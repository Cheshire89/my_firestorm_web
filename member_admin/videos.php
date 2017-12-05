<!DOCTYPE html>
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
                      <img src="img/slider/slide-1.png" class="img-responsive" alt="Default Banner Image">
                      <h3 class="fs-header">Banner Text Goes Here</h3>
                    </div>
                    <div class="panel-footer text-right">
                      <button type="button" class="fs-btn-blue btn btn-sm" id="editBannerBtn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                    </div>
                  </div>

                  <div class="panel panel-default" id="editBanner">
                    <div class="panel-heading"><h3>Edit Banner Image</h3></div>
                    <div class="panel-body">
                       <form class="form-inline fs-form-gen" action="saveBanner.php" name="saveBanner" enctype="multipar/form-data" method="POST">
                         
                         <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="bannerText" name="bannerText" placeholder="Banner Text">
                                <span class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></span>
                           </div>
                         </div>
                         <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="bennerDes" name="bennerDes" placeholder="Image Description">
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
                         <div class="form-group hidden">
                            <input type="hidden" name="slideId" id="slideId" value="">
                         </div>
                         <div class="form-group controls">
                           <button type="button" class="fs-btn-green btn pull-right" id="saveBannerImgBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                         </div>  
                         
                      </form>
                  </div>
                </div>

            <div class="panel panel-default">
                <div class="panel-heading"><h3>Manage Videos ( Search )</h3></div>
                <div class="panel-body">
                   <form class="form-inline fs-form-gen" action="searchVideo.php" name="searchVideo" method="POST">
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="videoTitle" name="videoTitle" placeholder="Video Title">
                            <span class="input-group-addon">N</span>
                       </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                            <select class="form-control" id="videoCategory" name="videoCategory">
                              <option>Video Category</option>
                              <option>Education</option>
                              <option>Event</option>
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
               

             <div class="panel panel-default" id="videoResults">
                  <div class="panel-heading"><h3>Video Admin</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="videosTable">
                        <thead> 
                          <tr>
                            <th class="text-center">Video Thumb</th>
                            <th class="text-center">Video Id</th>
                            <th>Video Title</th>
                            <th>Video Link</th>
                            <th>Video Category</th>
                            <th class="text-center">Upload Date</th>
                            <th class="text-right">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="editable-row">
                            <td><img class="img-responsive center-block" alt="img-title" src="img/event-placeholder.jpg"/> </td>
                            <td class="id">0</td>
                            <td class="title">Video Title 1</td>
                            <td>https://www.youtube.com/embed/rfX7OIO7CHc</td>
                            <td>Education</td>
                            <td class="date"><?php print(date('m/d/y')); ?></td>
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="videoId1" value="" name="videos">
                                <label for="videoId1">
                                </label>
                              </div>
                            </td>
                          </tr>
                          <tr class="editable-row">
                            <td><img class="img-responsive center-block" alt="img-title" src="img/event-placeholder.jpg"/> </td>
                            <td class="id">1</td>
                            <td class="title">Usually The Titles for the Videos May Get Pretty Long</td>
                            <td>https://www.youtube.com/embed/Xblchgs8RkY</td>
                            <td>Education</td>
                            <td class="date"><?php print(date('m/d/y')); ?></td>
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="videoId2" value="" name="videos">
                                <label for="videoId2">
                                </label>
                              </div>
                            </td>
                          </tr>
                          <tr class="editable-row">
                            <td><img class="img-responsive center-block" alt="img-title" src="img/event-placeholder.jpg"/> </td>
                            <td class="id">2</td>
                            <td class="title">Video Title 2</td>
                            <td>https://www.youtube.com/embed/rfX7OIO7CHc</td>
                            <td>Event</td>
                            <td class="date"><?php print(date('m/d/y')); ?></td>
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="videoId3" value="" name="videos">
                                <label for="videoId3">
                                </label>
                              </div>
                            </td>
                          </tr>
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
                   <form class="form-inline fs-form-gen" action="saveVideoForm.php" name="saveVideoForm" method="POST">
                   
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
                              <option>Video Category</option>
                              <option>Education</option>
                              <option>Event</option>
                            </select>
                            <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                       </div>
                     </div>
                     <div class="form-group hidden">
                       <input type="hidden" id="videoId" name="videoId" value="">
                     </div>
                     
                     <div class="form-group controls">
                       <button type="button" class="fs-btn-green btn pull-right" id="saveVideoBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
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
  </body>
</html>
