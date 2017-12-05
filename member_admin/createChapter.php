<?php 

   require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

   
if(isset($_GET["chapterID"]) && $_GET["chapterID"] != ''){
   $chapter = new Chapters();
   $chapterID = $_GET["chapterID"];
    
    $chapterData = $chapter->getChapter($chapterID);
    
    if(!isset($chapterData['chapterName']) || trim($chapterData['chapterName']) == ''){
      $chapterData['chapterName'] = 'Chapter';
    }

    $users = $chapter->printAdminChapterMembers($chapterID);

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
                        <div class="panel-heading"><h3><?php print($chapter->action.' '.$chapterData['chapterName']);?> Chapter</h3></div>
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
                                        <input type="file" class="form-control" id="chapterImg" name="chapterImg" value="<?php print($chapterData["chapterImg"]) ?>">
                                        <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>
                               <div class="form-group">
                                 <div class="col-md-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterName" name="chapterName" placeholder="Chapter Name" value="<?php print($chapterData['chapterName']);?>">
                                      <span class="input-group-addon"><strong>T</strong></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                 <div class="col-xs-12">
                                   <label>Chapter Location</label>
                                 </div>
                                 <div class="col-xs-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterAddress" name="chapterAddress" placeholder="Chapter Address" value="<?php print($chapterData["chapterAddress"]) ?>">
                                      <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                                 
                               </div>

                               <div class="form-group">
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterCity" name="chapterCity" placeholder="Chapter City" value="<?php print($chapterData["chapterCity"]) ?>">
                                      <span class="input-group-addon"><strong>C</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <select class="form-control" id="chapterState" name="chapterState" placeholder="Chapter State" value="<?php print($chapterData["chapterState"]) ?>">
                                        <option value=""> State</option>
                                        <option value="AL" <?php if($chapterData["chapterState"] == "AL"){print('selected="selected"');}?>>Alabama</option>
                                        <option value="AK" <?php if($chapterData["chapterState"] == "AK"){print('selected="selected"');}?>>Alaska</option>
                                        <option value="AZ" <?php if($chapterData["chapterState"] == "AZ"){print('selected="selected"');}?>>Arizona</option>
                                        <option value="AR" <?php if($chapterData["chapterState"] == "AR"){print('selected="selected"');}?>>Arkansas</option>
                                        <option value="CA" <?php if($chapterData["chapterState"] == "CA"){print('selected="selected"');}?>>California</option>
                                        <option value="CO" <?php if($chapterData["chapterState"] == "CO"){print('selected="selected"');}?>>Colorado</option>
                                        <option value="CT" <?php if($chapterData["chapterState"] == "CT"){print('selected="selected"');}?>>Connecticut</option>
                                        <option value="DE" <?php if($chapterData["chapterState"] == "DE"){print('selected="selected"');}?>>Delaware</option>
                                        <option value="DC" <?php if($chapterData["chapterState"] == "DC"){print('selected="selected"');}?>>District Of Columbia</option>
                                        <option value="FL" <?php if($chapterData["chapterState"] == "FL"){print('selected="selected"');}?>>Florida</option>
                                        <option value="GA" <?php if($chapterData["chapterState"] == "GA"){print('selected="selected"');}?>>Georgia</option>
                                        <option value="HI" <?php if($chapterData["chapterState"] == "HI"){print('selected="selected"');}?>>Hawaii</option>
                                        <option value="ID" <?php if($chapterData["chapterState"] == "ID"){print('selected="selected"');}?>>Idaho</option>
                                        <option value="IL" <?php if($chapterData["chapterState"] == "IL"){print('selected="selected"');}?>>Illinois</option>
                                        <option value="IN" <?php if($chapterData["chapterState"] == "IN"){print('selected="selected"');}?>>Indiana</option>
                                        <option value="IA" <?php if($chapterData["chapterState"] == "IA"){print('selected="selected"');}?>>Iowa</option>
                                        <option value="KS" <?php if($chapterData["chapterState"] == "KS"){print('selected="selected"');}?>>Kansas</option>
                                        <option value="KY" <?php if($chapterData["chapterState"] == "KY"){print('selected="selected"');}?>>Kentucky</option>
                                        <option value="LA" <?php if($chapterData["chapterState"] == "LA"){print('selected="selected"');}?>>Louisiana</option>
                                        <option value="ME" <?php if($chapterData["chapterState"] == "ME"){print('selected="selected"');}?>>Maine</option>
                                        <option value="MD" <?php if($chapterData["chapterState"] == "MD"){print('selected="selected"');}?>>Maryland</option>
                                        <option value="MA" <?php if($chapterData["chapterState"] == "MA"){print('selected="selected"');}?>>Massachusetts</option>
                                        <option value="MI" <?php if($chapterData["chapterState"] == "MI"){print('selected="selected"');}?>>Michigan</option>
                                        <option value="MN" <?php if($chapterData["chapterState"] == "MN"){print('selected="selected"');}?>>Minnesota</option>
                                        <option value="MS" <?php if($chapterData["chapterState"] == "MS"){print('selected="selected"');}?>>Mississippi</option>
                                        <option value="MO" <?php if($chapterData["chapterState"] == "MO"){print('selected="selected"');}?>>Missouri</option>
                                        <option value="MT" <?php if($chapterData["chapterState"] == "MT"){print('selected="selected"');}?>>Montana</option>
                                        <option value="NE" <?php if($chapterData["chapterState"] == "NE"){print('selected="selected"');}?>>Nebraska</option>
                                        <option value="NV" <?php if($chapterData["chapterState"] == "NV"){print('selected="selected"');}?>>Nevada</option>
                                        <option value="NH" <?php if($chapterData["chapterState"] == "NH"){print('selected="selected"');}?>>New Hampshire</option>
                                        <option value="NJ" <?php if($chapterData["chapterState"] == "NJ"){print('selected="selected"');}?>>New Jersey</option>
                                        <option value="NM" <?php if($chapterData["chapterState"] == "NM"){print('selected="selected"');}?>>New Mexico</option>
                                        <option value="NY" <?php if($chapterData["chapterState"] == "NY"){print('selected="selected"');}?>>New York</option>
                                        <option value="NC" <?php if($chapterData["chapterState"] == "NC"){print('selected="selected"');}?>>North Carolina</option>
                                        <option value="ND" <?php if($chapterData["chapterState"] == "ND"){print('selected="selected"');}?>>North Dakota</option>
                                        <option value="OH" <?php if($chapterData["chapterState"] == "OH"){print('selected="selected"');}?>>Ohio</option>
                                        <option value="OK" <?php if($chapterData["chapterState"] == "OK"){print('selected="selected"');}?>>Oklahoma</option>
                                        <option value="OR" <?php if($chapterData["chapterState"] == "OR"){print('selected="selected"');}?>>Oregon</option>
                                        <option value="PA" <?php if($chapterData["chapterState"] == "PA"){print('selected="selected"');}?>>Pennsylvania</option>
                                        <option value="RI" <?php if($chapterData["chapterState"] == "RI"){print('selected="selected"');}?>>Rhode Island</option>
                                        <option value="SC" <?php if($chapterData["chapterState"] == "SC"){print('selected="selected"');}?>>South Carolina</option>
                                        <option value="SD" <?php if($chapterData["chapterState"] == "SD"){print('selected="selected"');}?>>South Dakota</option>
                                        <option value="TN" <?php if($chapterData["chapterState"] == "TN"){print('selected="selected"');}?>>Tennessee</option>
                                        <option value="TX" <?php if($chapterData["chapterState"] == "TX"){print('selected="selected"');}?>>Texas</option>
                                        <option value="UT" <?php if($chapterData["chapterState"] == "UT"){print('selected="selected"');}?>>Utah</option>
                                        <option value="VT" <?php if($chapterData["chapterState"] == "VT"){print('selected="selected"');}?>>Vermont</option>
                                        <option value="VA" <?php if($chapterData["chapterState"] == "VA"){print('selected="selected"');}?>>Virginia</option>
                                        <option value="WA" <?php if($chapterData["chapterState"] == "WA"){print('selected="selected"');}?>>Washington</option>
                                        <option value="WV" <?php if($chapterData["chapterState"] == "WV"){print('selected="selected"');}?>>West Virginia</option>
                                        <option value="WI" <?php if($chapterData["chapterState"] == "WI"){print('selected="selected"');}?>>Wisconsin</option>
                                        <option value="WY" <?php if($chapterData["chapterState"] == "WY"){print('selected="selected"');}?>>Wyoming</option>
                                      </select>
                                      <span class="input-group-addon"><strong>S</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="chapterZip" name="chapterZip" placeholder="Chapter Zip" value="<?php print($chapterData["chapterZip"]) ?>">
                                      <span class="input-group-addon"><strong>Z</strong></span>
                                   </div>
                                 </div>
                               </div>


                              <div class="form-group">
                                <div class="col-xs-12">
                                  <label for="chapterDesc"><?php print($chapterData['chapterName']);?> Description</label>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <textarea class="form-control" id="chapterDesc" name="chapterDesc">
                                    <?php print($chapterData["chapterDesc"]) ?>
                                  </textarea>
                                </div>
                              </div>

                              <div class="form-group hidden">
                                  <input type="hiddnen" id="chapterID" name="chapterID" value="<?php print($chapterData["chapterID"]); ?>">
                              </div>


                                <div class="form-group controls">
                                  <div class="col-xs-12">
                                    <div class="btn-group pull-right" role="group" aria-label="...">
                                    <a href="chapters.php" class="fs-btn-blue btn"><i class="fa fa-rotate-left" aria-hidden="true"></i> Back</a>
                                   <button type="button" class="fs-btn-green btn saveChapterBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                   </div>
                                   </div>
                                </div>  
                             
                          </form>
                      </div>
                  </div>

                <div class="panel panel-default">
                  <div class="panel-heading"><h3><?php print($chapterData['chapterName']);?> | Events</h3></div>
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
                  <div class="panel-heading"><h3><?php print($chapterData['chapterName']);?> | Members</h3></div>
                  <div class="panel-body">
                    <div class="row members">
                      <?php
                       print($users);
                      ?>
                    </div>
                  </div>
                </div>

                  <div class="panel panel-default">
                  <div class="panel-heading"><h3><?php print($chapterData['chapterName']);?> | Images</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive">
                      <table class="table table-striped" id="slidesTable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Image Description</th>
                            <th>File Path</th>
                            <th class="text-center">Preview</th>
                            <th><!-- Controls --></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>0</td>
                            <td>Conference Room</td>
                            <td>img/conference.jpg</td>
                            <td class="text-center"><img class="img-responsive center-block" src="img/event-placeholder.jpg" alt=""></td>
                            <td class="controls">
                              <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm fs-btn-green edit" data-id="0"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                <button type="button" class="btn btn-sm fs-btn-red delete" data-id="0"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>1</td>
                            <td>Conference Room</td>
                            <td>img/conference.jpg</td>
                            <td><img class="img-responsive center-block" src="img/event-placeholder.jpg" alt=""></td>
                            <td class="controls">
                              <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm fs-btn-green edit" data-id="1"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                <button type="button" class="btn btn-sm fs-btn-red delete" data-id="1"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                              </div>
                            </td>
                          </tr>
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



                <div class="panel panel-default" id="editSlideForm">
                  <div class="panel-heading"><h3>New Slide</h3></div>
                    <div class="panel-body">
                       <form class="form-inline fs-form-gen" action="saveSlide.php" name="saveSlide" enctype="multipar/form-data" method="POST">
                        
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
                           <button type="button" class="fs-btn-green btn pull-right">Add Slide</button>
                         </div>  
                         
                      </form>
                  </div>
                </div>
              

            <div class="panel panel-default" id="setChapterLeaderForm">
                <div class="panel-heading"><h3><?php print($chapterData['chapterName']);?> | President</h3></div>
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
                            <th class="text-center">Member ID</th>
                            <th>Company Name</th>
                            <th class="text-center">Set As Speaker | Leader</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                        <!-- <tfoot>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <button type="button" class="btn btn-md fs-btn-green pull-right add saveChapterAdmin"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                            </td>
                          </tr>
                        </tfoot> -->

                      </table>
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
    <script type="text/javascript" src="js/createChapter.js"></script>
    <script type="text/javascript" src="js/init-tynymce.js"></script>
    <link href="styles/css/tinymce-custom.css?v=<?php date('U')?>" rel="stylesheet">
    <script type="text/javascript">
       $(document).ready(function(){
          $('#rmEvent').on('click',function(){
              rmArr = deleteArray($('#eventsTable'));
              processDelete = $.post('deleteEvent.php', {'deleteEvents[]': rmArr}, function(textStatus){
                    deleteRow($('#eventsTable'));
              });
          });

          $('#searchUsers').on('click',function(){
              
              var userEmail = $('#featMemName').val();
              var userId = $('#featMemId').val();

            $.post('searchUsers.php',{"userEmail": userEmail, "userID": userId}, function(data){
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
                               if(data != 'Bad'){
                                  alertTempl = $('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> Chapter Admin Successfully Set</div>');

                                    alertTempl.insertBefore("#memSearchResults");
                                 
                               }else{

                                    alertTempl = $('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Chapter Admin Not Set</div>');
                                    alertTempl.insertBefore("#memSearchResults");
                               }
                           });
                      }
                  });
               }
            });
          });


      });

       
    </script>
  </body>
  <style type="text/css">
    #chapterEnd, #tickets{
      display: none;
    }
  </style>
</html>
