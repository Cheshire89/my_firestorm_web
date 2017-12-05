<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$slides = new Slides();
$slidesCont = $slides->getAdminSlides();
$featuredVideos = new featured_videos();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin Home</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    <link href="../styles/css/log-in.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
  	
  	<?php require_once('php/header.php') ?>
    <div class="container" id="adminContainer">
      <div class="row">

         <div class="col-md-10  col-md-offset-1">
          <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Home Page Slides</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped" id="slidesTable">
                        <thead>
                          <tr>
                            <th>Slide Text</th>
                            <th>Image Description</th>
                            <!-- <th>File Path</th> -->
                            <th class="text-center">Preview</th>
                            <th><!-- Controls --></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php print($slidesCont); ?> 
                        </tbody>
                        
                      </table>
                    </div>
                      <div class="row table-addon">
                          <div class="col-xs-12">
                              <div class="btn-group pull-right">
                                  <button type="button" class="btn btn-md fs-btn-blue add" id="addImg"><i class="fa fa-plus" aria-hidden="true"></i> Slide</button>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>

                <div class="panel panel-default" id="editSlideForm">
                  <div class="panel-heading"><h3>New Slide</h3></div>
                  <div class="panel-body">
                     <form class="form-inline fs-form-gen" action="saveSlide.php" name="saveSlide" enctype="multipart/form-data" method="POST">
                       <div class="col-xs-12">
                       <div class="form-group">
                          <div class="input-group">
                              <input type="text" class="form-control" id="slideText" name="slideText" placeholder="Slide Text">
                              <span class="input-group-addon"><i class="fa fa-header" aria-hidden="true"></i></span>
                         </div>
                       </div>
                       <div class="form-group">
                          <div class="input-group">
                              <input type="text" class="form-control" id="slideDesc" name="slideDesc" placeholder="Image Description">
                              <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                         </div>
                       </div>
                       <div class="form-group">
                          <div class="input-group">
                              <label for="slideImg">Choose File</label>
                              <input type="file" class="form-control" id="slideImg" name="slideImg">
                              <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                         </div>
                       </div>
                       <div class="form-group hidden">
                          <input type="hidden" name="slideId" id="slideId" value="">
                       </div>
                       <div class="form-group controls">
                         <button type="button" class="fs-btn-green btn">Add Slide</button>
                       </div>  
                       </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default" id="setFeatMemberForm">
                <div class="panel-heading"><h3>Featured Member</h3></div>
                <div class="panel-body">
                   <form class="form-inline fs-form-gen searchFeatMem" name="searchFeatMem">
                     
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="featMemName" name="featMemName" placeholder="Member Name">
                            <span class="input-group-addon">N</span>
                       </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="featMemEmail" name="featMemEmail" placeholder="Member ID">
                            <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                       </div>
                     </div>
                     
                     <div class="form-group controls">
                       <button type="button" class="fs-btn-blue btn setFeatMemSearchBtn"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                     </div>  
                     
                  </form>
              </div>
            </div>

            <div class="panel panel-default" id="memSearchResults">
                  <div class="panel-heading"><h3>Members</h3></div>
                    <div class="panel-body">
                        <form name="setFeatMemForm" class="setFeatMemForm">
                      <div class="table-responsive">
                          <table class="table table-striped" id="featuredMemberTable">
                            <thead>
                              <tr>
                                <th>Member Picture</th>
                                <th>Member Name</th>
                                <th>Member Industry</th>
                                <th class="text-center">Set As Featured Member</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                            <tfoot>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <button type="button" class="btn btn-md fs-btn-green pull-right add saveFeatMemBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                </td>
                              </tr>
                            </tfoot>
                          </table>
                      </form>
                    </div>
                  </div>
                </div>


            <div class="panel panel-default" id="setFeatVideo">
                <div class="panel-heading"><h3>Schedule Featured Video</h3></div>
                <div class="panel-body">
                   <div class="table-responsive table-group" style="margin-bottom:15px;">
                    <table class="table table-striped">
                       <thead>
                         <tr>
                           <th>Link </th>
                           <th>Scheduled</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th></th>
                         </tr>
                       </thead>
                       <tbody>
                         <?php print($featuredVideos->videos); ?>
                       </tbody>
                    </table>
                  </div>
                  <!-- action="saveFeaturedVideo.php" -->
                  <form class="form-horizontal fs-form-gen"  name="saveFeaturedVideo" method="POST" action="saveFeaturedVideo.php">
                   
                     <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                          <div class="input-group">
                              <input type="text" class="form-control" id="featVidLink" name="featVidLink" placeholder="Video Link">
                              <span class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></span>
                         </div>
                       </div>
                     </div>
                     
                     <div class="form-group">
                          <div class="col-md-8 col-md-offset-2">
                             <label>Schedule Featured Video?</label>
                          </div>
                     </div>
                     <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <div class='vertical-align short'>
                              <div class='btns'>
                                <label>
                                  <input name='scheduleFeatVideo' id="repeatingVidYes" value="yes" type='radio'>
                                    <span class='btn first'>Yes</span>
                                  
                                </label>
                                <label>
                                  <input name='scheduleFeatVideo' id="repeatingVidNo" value="no" type='radio' checked>
                                    <span class='btn'>No</span>
                                </label>
                              </div>
                            </div>
                        </div>
                     </div>
                      <div id="scheduleFeatVideo">
                          <div class="form-group">
                      
                             <div class="col-md-6">
                               <label for="featVideoStart">Start</label>
                               <div class="input-group">
                                  <input type="date" class="form-control" id="featVideoStart" name="featVideoStart" placeholder="Event Date">
                                  <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                               </div>
                             </div>
                             
                             <div class="col-md-6">
                               <label for="featVideoEnd">End</label>
                               <div class="input-group">
                                  <input type="date" class="form-control" id="featVideoEnd" name="featVideoEnd" placeholder="Event Date">
                                  <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                               </div>
                             </div>
                           </div>
                      </div>
                      <div class="form-group controls">
                        <div class="col-md-8 col-md-offset-2">
                       <button type="button" class="fs-btn-green btn saveFeaturedVideoBtn pull-right"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                       </div>
                     </div> 
                  </form>
              </div>
            </div>

              
              <!--  End Wrapping Divs -->
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
    <script type="text/javascript" src="js/home.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.logoutBtn').click(function() {
        	       console.log("hi");
        	       window.location.href = 'logout.php';
        	   });
               
               $('input, select, textarea').focus(function() {
                    $(this).closest('.form-group').removeClass("has-error");
               });
               
               $('.setFeatMemSearchBtn').click(function() {
                    var featMemName = $('#featMemName').val();
                    var featMemEmail = $('#featMemEmail').val();
                    
                    if(featMemName != "" || featMemEmail != "") {
                        $.post("./searchFeatMem.php", {'featMemName': featMemName, 'featMemEmail': featMemEmail}, function(data) {
                            if(data != "error") {
                                
                                $('#featuredMemberTable').find("tbody").empty();
                                $('#featuredMemberTable').find("tbody").html(data);
                                
                            } else {
                                $('#featMemName').closest(".form-group").addClass("has-error");
                                $('#featMemEmail').closest(".form-group").addClass("has-error");
                            	
                                $('.searchFeatMem').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> At least one field is required.</div>');
                            }
                        });
                    } else {
                    	$('#featMemName').closest(".form-group").addClass("has-error");
                        $('#featMemEmail').closest(".form-group").addClass("has-error");
                    	
                        $('.searchFeatMem').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> At least one field is required.</div>');
                    }
               });
               
               $('.saveFeatMemBtn').click(function(e) {
                    
                    var featMem = $("input[name='setFeatMem']:checked"). val();
                    console.log("Feat: "+featMem);
                    if(featMem != "") {
                        $.post("./setFeatMem.php", {'featMem': featMem}, function(data) {
                            if(data != "error") {
                                $('#memSearchResults').hide();
                            }
                        });
                    } else {
                        $('.saveFeatMemForm').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please selected the Featured Memeber first.</div>');
                    }
               });
               
               $('.deleteFeatVideo').click(function() {
                    var id = $(this).attr("data-id");
                    document.location.href = 'deleteFeatVideo.php?id='+id;
               });
        });  
        
    </script>
  </body>
</html>
