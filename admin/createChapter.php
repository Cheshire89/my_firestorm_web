<?php
require_once("classes/config.php");
$checkUser = new User_Valid();

if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}
   
if(isset($_GET["chapterID"])){
    $chapterID = $_GET["chapterID"];
    $chapter = new Chapters();
    $data = $chapter->getChapter($chapterID);
    $users = $chapter->printAdminChapterMembers($chapterID);

    $gallery = new ChapterGallery($chapterID);
    $chapterGallery = $gallery->print_chapter_gallery_admin();

    $events = new Events();
    $eventsContent = $events->getChapterEvents($chapterID);
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

    <title>Firestorm Admin <?php print($chapter->action); ?> Chapter</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    <link href="../styles/css/log-in.css?v=<?php date('U')?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="js/jquery-timepicker/jquery.timepicker.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      #editImgForm{
        display: none;
      }
    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
      <div class="container" id="adminContainer">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-xs-12">

        
                  <div class="panel panel-default">
                        <div class="panel-heading"><h3><?php print($chapter->action); ?> Chapter</h3></div>
                        <div class="panel-body">
                           <form class="form-horizontal fs-form-gen" action="saveChapter.php" name="saveChapterForm" id="saveChapterForm" method="POST" enctype="multipart/form-data">
                             
                               <div class="form-group image-preview">
                                  <div class="col-xs-12">
                                     <img class="img-responsive center-block" alt="chapter image preview" src="<?php  print($chapter->placeholder); ?>" />
                                   </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-xs-12">
                                    <label>Chapter General Information</label>
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="input-group">
                                        <label for="chapterImg">Please Select An Image</label>
                                        <input type="file" class="form-control" id="chapterImg" name="chapterImg" value="<?php print($data["chapterImg"]) ?>">
                                        <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>
                               <div class="form-group">
                                 <div class="col-md-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterName" name="chapterName" placeholder="Chapter Name" value="<?php print($data['chapterName']);?>">
                                      <span class="input-group-addon"><strong>T</strong></span>
                                   </div>
                                 </div>
                               </div>
                               

                               <div class="form-group">
                                 <div class="col-xs-12">
                                   <label>Chapter Location</label>
                                 </div>
                                 <div class="col-md-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterLocName" name="chapterLocName" placeholder="Location Name" value="<?php print($data['chapterLocName']);?>">
                                      <span class="input-group-addon"><strong>T</strong></span>
                                   </div>
                                 </div>
                               </div>
                               

                               <div class="form-group">
                                 <div class="col-xs-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterAddress" name="chapterAddress" placeholder="Chapter Address" value="<?php print($data["chapterAddress"]) ?>">
                                      <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>


                               <div class="form-group">
                                 <div class="col-xs-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterAddress2" name="chapterAddress2" placeholder="Address Cont." value="<?php print($data["chapterAddress2"]) ?>">
                                      <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterCity" name="chapterCity" placeholder="Chapter City" value="<?php print($data["chapterCity"]) ?>">
                                      <span class="input-group-addon"><strong>C</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <select class="form-control" id="chapterState" name="chapterState" placeholder="Chapter State" value="<?php print($data["chapterState"]) ?>">
                                        <option value=""> State</option>
                                        <option value="AL" <?php if($data["chapterState"] == "AL"){print('selected="selected"');}?>>Alabama</option>
                                        <option value="AK" <?php if($data["chapterState"] == "AK"){print('selected="selected"');}?>>Alaska</option>
                                        <option value="AZ" <?php if($data["chapterState"] == "AZ"){print('selected="selected"');}?>>Arizona</option>
                                        <option value="AR" <?php if($data["chapterState"] == "AR"){print('selected="selected"');}?>>Arkansas</option>
                                        <option value="CA" <?php if($data["chapterState"] == "CA"){print('selected="selected"');}?>>California</option>
                                        <option value="CO" <?php if($data["chapterState"] == "CO"){print('selected="selected"');}?>>Colorado</option>
                                        <option value="CT" <?php if($data["chapterState"] == "CT"){print('selected="selected"');}?>>Connecticut</option>
                                        <option value="DE" <?php if($data["chapterState"] == "DE"){print('selected="selected"');}?>>Delaware</option>
                                        <option value="DC" <?php if($data["chapterState"] == "DC"){print('selected="selected"');}?>>District Of Columbia</option>
                                        <option value="FL" <?php if($data["chapterState"] == "FL"){print('selected="selected"');}?>>Florida</option>
                                        <option value="GA" <?php if($data["chapterState"] == "GA"){print('selected="selected"');}?>>Georgia</option>
                                        <option value="HI" <?php if($data["chapterState"] == "HI"){print('selected="selected"');}?>>Hawaii</option>
                                        <option value="ID" <?php if($data["chapterState"] == "ID"){print('selected="selected"');}?>>Idaho</option>
                                        <option value="IL" <?php if($data["chapterState"] == "IL"){print('selected="selected"');}?>>Illinois</option>
                                        <option value="IN" <?php if($data["chapterState"] == "IN"){print('selected="selected"');}?>>Indiana</option>
                                        <option value="IA" <?php if($data["chapterState"] == "IA"){print('selected="selected"');}?>>Iowa</option>
                                        <option value="KS" <?php if($data["chapterState"] == "KS"){print('selected="selected"');}?>>Kansas</option>
                                        <option value="KY" <?php if($data["chapterState"] == "KY"){print('selected="selected"');}?>>Kentucky</option>
                                        <option value="LA" <?php if($data["chapterState"] == "LA"){print('selected="selected"');}?>>Louisiana</option>
                                        <option value="ME" <?php if($data["chapterState"] == "ME"){print('selected="selected"');}?>>Maine</option>
                                        <option value="MD" <?php if($data["chapterState"] == "MD"){print('selected="selected"');}?>>Maryland</option>
                                        <option value="MA" <?php if($data["chapterState"] == "MA"){print('selected="selected"');}?>>Massachusetts</option>
                                        <option value="MI" <?php if($data["chapterState"] == "MI"){print('selected="selected"');}?>>Michigan</option>
                                        <option value="MN" <?php if($data["chapterState"] == "MN"){print('selected="selected"');}?>>Minnesota</option>
                                        <option value="MS" <?php if($data["chapterState"] == "MS"){print('selected="selected"');}?>>Mississippi</option>
                                        <option value="MO" <?php if($data["chapterState"] == "MO"){print('selected="selected"');}?>>Missouri</option>
                                        <option value="MT" <?php if($data["chapterState"] == "MT"){print('selected="selected"');}?>>Montana</option>
                                        <option value="NE" <?php if($data["chapterState"] == "NE"){print('selected="selected"');}?>>Nebraska</option>
                                        <option value="NV" <?php if($data["chapterState"] == "NV"){print('selected="selected"');}?>>Nevada</option>
                                        <option value="NH" <?php if($data["chapterState"] == "NH"){print('selected="selected"');}?>>New Hampshire</option>
                                        <option value="NJ" <?php if($data["chapterState"] == "NJ"){print('selected="selected"');}?>>New Jersey</option>
                                        <option value="NM" <?php if($data["chapterState"] == "NM"){print('selected="selected"');}?>>New Mexico</option>
                                        <option value="NY" <?php if($data["chapterState"] == "NY"){print('selected="selected"');}?>>New York</option>
                                        <option value="NC" <?php if($data["chapterState"] == "NC"){print('selected="selected"');}?>>North Carolina</option>
                                        <option value="ND" <?php if($data["chapterState"] == "ND"){print('selected="selected"');}?>>North Dakota</option>
                                        <option value="OH" <?php if($data["chapterState"] == "OH"){print('selected="selected"');}?>>Ohio</option>
                                        <option value="OK" <?php if($data["chapterState"] == "OK"){print('selected="selected"');}?>>Oklahoma</option>
                                        <option value="OR" <?php if($data["chapterState"] == "OR"){print('selected="selected"');}?>>Oregon</option>
                                        <option value="PA" <?php if($data["chapterState"] == "PA"){print('selected="selected"');}?>>Pennsylvania</option>
                                        <option value="RI" <?php if($data["chapterState"] == "RI"){print('selected="selected"');}?>>Rhode Island</option>
                                        <option value="SC" <?php if($data["chapterState"] == "SC"){print('selected="selected"');}?>>South Carolina</option>
                                        <option value="SD" <?php if($data["chapterState"] == "SD"){print('selected="selected"');}?>>South Dakota</option>
                                        <option value="TN" <?php if($data["chapterState"] == "TN"){print('selected="selected"');}?>>Tennessee</option>
                                        <option value="TX" <?php if($data["chapterState"] == "TX"){print('selected="selected"');}?>>Texas</option>
                                        <option value="UT" <?php if($data["chapterState"] == "UT"){print('selected="selected"');}?>>Utah</option>
                                        <option value="VT" <?php if($data["chapterState"] == "VT"){print('selected="selected"');}?>>Vermont</option>
                                        <option value="VA" <?php if($data["chapterState"] == "VA"){print('selected="selected"');}?>>Virginia</option>
                                        <option value="WA" <?php if($data["chapterState"] == "WA"){print('selected="selected"');}?>>Washington</option>
                                        <option value="WV" <?php if($data["chapterState"] == "WV"){print('selected="selected"');}?>>West Virginia</option>
                                        <option value="WI" <?php if($data["chapterState"] == "WI"){print('selected="selected"');}?>>Wisconsin</option>
                                        <option value="WY" <?php if($data["chapterState"] == "WY"){print('selected="selected"');}?>>Wyoming</option>
                                      </select>
                                      <span class="input-group-addon"><strong>S</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterZip" name="chapterZip" placeholder="Chapter Zip" value="<?php print($data["chapterZip"]) ?>">
                                      <span class="input-group-addon"><strong>Z</strong></span>
                                   </div>
                                 </div>
                               </div>

                              <div class="form-group">
                                <div class="col-xs-12">
                                  <label for="chapterDesc">Chapter Meeting</label>
                                </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-xs-6">
                                   <div class="input-group">
                                      <select type="text" class="form-control" id="meetingDay" name="meetingDay">
                                          <option value="">Meeting Day</option>
                                          <option value="Monday" <?php if($data["meetingDay"] == "Monday"){print('selected="selected"');}?>>Monday</option>
                                          <option value="Tuesday" <?php if($data["meetingDay"] == "Tuesday"){print('selected="selected"');}?>>Tuesday</option>
                                          <option value="Wednesday" <?php if($data["meetingDay"] == "Wednesday"){print('selected="selected"');}?>>Wednesday</option>
                                          <option value="Thursday" <?php if($data["meetingDay"] == "Thursday"){print('selected="selected"');}?>>Thursday</option>
                                          <option value="Friday" <?php if($data["meetingDay"] == "Friday"){print('selected="selected"');}?>>Friday</option>
                                          <option value="Saturday" <?php if($data["meetingDay"] == "Saturday"){print('selected="selected"');}?>>Saturday</option>
                                          <option value="Sunday" <?php if($data["meetingDay"] == "Sunday"){print('selected="selected"');}?>>Sunday</option>
                                        </select>
                                      <span class="input-group-addon"><strong><i class="fa fa-calendar" aria-hidden="true"></i></strong></span>
                                   </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-xs-6">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="meetingTime" name="meetingTime" placeholder="Meeting Time Start" value="<?php print($data["meetingTime"]) ?>">
                                      <span class="input-group-addon"><strong><i class="fa fa-clock-o" aria-hidden="true"></i></strong></span>
                                   </div>
                                 </div>
                                 <div class="col-xs-6">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="meetingTimeEnd" name="meetingTimeEnd" placeholder="Meeting Time End" value="<?php print($data["meetingTimeEnd"]) ?>">
                                      <span class="input-group-addon"><strong><i class="fa fa-clock-o" aria-hidden="true"></i></strong></span>
                                   </div>
                                 </div>
                              </div>
                                
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <label for="chapterDesc">Chapter Description</label>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <textarea class="form-control" id="chapterDesc" name="chapterDesc"><?php print($data["chapterDesc"]) ?></textarea>
                                </div>
                              </div>

                              <div class="form-group hidden">
                                  <input type="hiddnen" id="chapterID" name="chapterID" value="<?php print($data["chapterID"]); ?>">
                              </div>


                                <div class="form-group controls">
                                    <div class="col-xs-12">
                                        <input type="hidden" name="lng" id="lng" value="" />
                                        <input type="hidden" name="lat" id="lat" value="" />
                                        <div class="btn-group pull-right" role="group" aria-label="...">
                                            <a href="chapters.php" class="fs-btn-blue btn"><i class="fa fa-rotate-left" aria-hidden="true"></i> Back</a>
                                            <button type="button" class="fs-btn-green btn saveChapterBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                        </div>
                                    </div>
                                </div>  
                             
                          </form>
                      </div>
                  </div>

                <?php if($chapterID){ ?>
                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Chapters Events</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="eventsTable">
                        <thead>
                          <tr>
                            <th>Event Img</th>
                            <th>Event Title</th>
                            <th class="text-center">Event Date</th>
                            <th class="text-center">Event City</th>
                            <th class="text-center">Event State</th>
                            <th class="text-center">Event Zip</th>
                            <th class="text-right">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php print($eventsContent);?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row table-addon">
                        <div class="col-xs-12">
                            <div class="btn-group pull-right">
                              <a href="createEvent.php" class="btn btn-sm fs-btn-green add" id="addEvent"><i class="fa fa-plus" aria-hidden="true"></i> Event</a>
                              <button type="button" class="btn btn-sm fs-btn-red rm" id="rmEvent"><i class="fa fa-trash" aria-hidden="true"></i> Event</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Chapter Members</h3></div>
                  <div class="panel-body">
                    <div class="row members">
                      <?php
                       print($users);
                      ?>
                    </div>
                  </div>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Chapter Images</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive">
                      <table class="table table-striped" id="imgTable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Image Description</th>
                            <th class="text-center">Preview</th>
                            <th><!-- Controls --></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php print($chapterGallery);?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row table-addon">
                        <div class="col-xs-12">
                            <div class="btn-group pull-right">
                            <button type="button" class="btn btn-sm fs-btn-blue add" id="addImg"><i class="fa fa-plus" aria-hidden="true"></i>  Image</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>



                <div class="panel panel-default" id="editImgForm">
                  <div class="panel-heading"><h3>New Slide</h3></div>
                    <div class="panel-body">
                       <form class="form-inline fs-form-gen" name="saveGalleryImageForm" action="saveGalleryImage.php" enctype="multipart/form-data" method="POST">
                         <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="imgAlt" name="imgAlt" placeholder="Image Description">
                                <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                           </div>
                         </div>
                         <div class="form-group">
                            <div class="input-group">
                                <label for="imgFile">Choose File</label>
                                <input type="file" class="form-control" id="imgFile" name="imgFile">
                                <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                           </div>
                         </div>
                         <div class="form-group hidden">
                            <input type="hidden" name="imgID" id="imgID" value="">
                         </div>
                         <div class="form-group hidden">
                            <input type="hidden" name="chapterID" id="chapterID" value="<?php print($chapterID); ?>">
                         </div>
                         <div class="form-group controls">
                           <button type="button" class="fs-btn-green btn pull-right">Add Slide</button>
                         </div>  
                         
                      </form>
                  </div>
                </div>
              

            <div class="panel panel-default" id="setChapterLeaderForm">
                <div class="panel-heading"><h3>Chapter President</h3></div>
                <div class="panel-body">
                   <form class="form-inline fs-form-gen" action="searchFeatMem.php" name="searchFeatMem" method="POST">
                     
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="featMemName" name="featMemName" placeholder="Member Name">
                            <span class="input-group-addon">N</span>
                       </div>
                     </div>
                     <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="featMemId" name="featMemId" placeholder="Member ID">
                            <span class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></span>
                       </div>
                     </div>
                     
                     <div class="form-group controls">
                       <button type="button" class="fs-btn-blue btn pull-right" id="searchUsers"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                     </div>  
                 
                  </form>
              </div>
            </div>

            <div class="panel panel-default" id="memSearchResults">
                  <div class="panel-heading"><h3>Members</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive">
                      <table class="table table-striped" id="slidesTable">
                        <thead>
                          <tr>
                            <th>Member Picture</th>
                            <th>Member Name</th>
                            
                            <th>Company Name</th>
                            <th class="text-center">Set As Speaker | Leader</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>

                <?php } ?>



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
  
    <script type="text/javascript" src="js/jquery-timepicker/jquery.timepicker.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/createChapter.js"></script>


    <link href="styles/css/tinymce-custom.css?v=<?php date('U')?>" rel="stylesheet">
    <script type="text/javascript" src="js/init-tynymce.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){
          $('#rmEvent').on('click',function(){
              rmArr = deleteArray($('#eventsTable'));
              processDelete = $.post('deleteEvent.php', {'deleteEvents[]': rmArr}, function(textStatus){
                    deleteRow($('#eventsTable'));
              });
          });

          $('#searchUsers').on('click',function(){
              
            var userName = $('#featMemName').val();
            var userId = $('#featMemId').val();

            if(userName != '' || userId != ''){

              $.post('searchUsers.php',{"userName": userName, "userID": userId}, function(data){
                 userResult = data.trim();
                 tableBody = $('#memSearchResults').find('tbody');
                 tableBody.empty();

                   if(userResult != ''){
                      tableBody.append(userResult);
                      $('#memSearchResults').show();
                      $('#memSearchResults').slideDown('fast');

                      $('.saveChapterAdmin').click(function(){
                       
                          if($(this).find('input').is(":checked")) {

                              var id = $(this).find('input').attr("data-id");
                              
                               $.post('saveChapterAdmin.php',{"userID": id, "chapterID":'<?php print($chapterID);?>'}, function(data){
                                   console.log(data);
                                   if(data == 'Success'){
                                      var dec = 'alert-success';
                                      var text = '<strong>Success!</strong> Chapter Admin Successfully Set';

                                      box = alertBox(dec, text);
                                      box.insertBefore("#memSearchResults");
                                      $("#memSearchResults").hide();
                                    }else{
                                      var dec = 'alert-danger';
                                      var text = '<strong>Warning!</strong> Admin Exists';

                                      box = alertBox(dec, text);
                                      box.insertBefore("#memSearchResults");
                                      $("#memSearchResults").hide();
                                   }
                               });
                          }
                      });
                   }
              });
            }

          });

          $('#chapterAddress, #chapterCity, #chapterState, #chapterZip').blur(function() {
                var chapterAddress = $('#chapterAddress').val();
                var chapterCity = $('#chapterCity').val();
                var chapterState = $('#chapterState').val();
                var chapterZip = $('#chapterZip').val();
                console.log("Looking Up Address");
                if(chapterAddress != "" && chapterCity != "" && chapterState != "" && chapterZip != "") {
                    var address = chapterAddress + " " + chapterCity + ", " + chapterState + " " + chapterZip;
                    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+address+'&sensor=false', null, function (data) {
                        var p = data.results[0].geometry.location
                        $('#lat').val(p.lat);
                        $('#lng').val(p.lng);
                    });
                }
          });

      });

    function alertBox($class, $text){
       template = $('<div class="alert '+$class+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+$text+'</div>');
       return template;
    }

       
    </script>

  </body>
  <style type="text/css">
    #chapterEnd, #tickets{
      display: none;
    }
    .adminStar {
        position: absolute;
        right: 40px;
        top: 100px;
        font-size: 25px;
        color: orange;
    }
  </style>
</html>
