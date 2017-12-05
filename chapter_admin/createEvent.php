<?php 
   require_once("classes/config.php");

    $checkUser = new User_Valid();
    if(!$checkUser->isLoggedIn()){
        header('Location: /');
        exit();
    }
   
   $event = new Events();
   $chapters = new Chapters();
   
   if(isset($_GET["eventID"])){
     $data = $event->getEvent($_GET["eventID"]);
   }else {
     $data = '';
  }
     
  $chaptersList = $chapters->printChaptersOption($data["eventBy"]);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin <?php print($event->action);?> Event</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="js/jquery-timepicker/jquery.timepicker.css">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    <link href="../styles/css/log-in.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
    #eventEnd, #tickets{
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
                        <div class="panel-heading"><h3><?php print($event->action); ?> Event</h3></div>
                        
                        <div class="panel-body">
                        
                           <form class="form-horizontal fs-form-gen" action="saveEvent.php" name="saveEventForm" id="saveEventForm" method="POST" enctype="multipart/form-data">
                               <div class="form-group image-preview">
                                   <div class="col-xs-12">
                                      <img class="img-responsive center-block" alt="event image preview" src="<?php print($event->placeholder); ?>" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                  <div class="col-xs-12">
                                    <label>Event General Information</label>
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="input-group">
                                        <label for="eventImg">Choose Event Image</label>
                                        <input type="file" class="form-control" id="eventImg" name="eventImg" value="<?php print($data["eventImg"]) ?>">
                                        <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                 <div class="col-md-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Event Title" value="<?php print($data["eventTitle"]); ?>">
                                      <span class="input-group-addon"><strong>T</strong></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                  <div class="col-md-6">
                                   <div class="input-group">
                                      <select type="text" class="form-control" id="eventBy" name="eventBy">
                                        <option value="">Event By</option>
                                        <?php print($chaptersList);?>
                                      </select>
                                      <span class="input-group-addon"><strong>G</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-6">
                                   <div class="input-group">
                                      <select type="text" class="form-control" id="eventCategory" name="eventCategory">
                                        <option value="Other Event" <?php if($data["eventCategory"] == "Other Event"){print('selected="selected"');}?>>Other Event</option>
                                      </select>
                                      <span class="input-group-addon"><strong>C</strong></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                 <div class="col-md-12">
                                   <label>Event Start</label>
                                 </div>
                              </div>

                               <div class="form-group">
                                 <div class="col-md-6">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventDateStart" name="eventDateStart" placeholder="Event Date" value="<?php print(gmdate("m/d/y", $data["eventDateStart"])); ?>">
                                      <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                                 <div class="col-md-6">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventTimeStart" name="eventTimeStart" placeholder="Event Time" value="<?php print(gmdate("h:i a", $data["eventTimeStart"])); ?>">
                                      <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>
                              
                               <div class="form-group" id="eventEnd">
                                 <div class="col-md-12">
                                   <label>Event End</label>
                                 </div>
                                 <div class="col-md-6">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventDateEnd" name="eventDateEnd" placeholder="Event Date" value="<?php print(gmdate("m/d/y", $data["eventDateEnd"])); ?>">
                                      <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                                 <div class="col-md-6">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventTimeEnd" name="eventTimeEnd" placeholder="Event Time" value="<?php print(gmdate("h:i a", $data["eventTimeEnd"])); ?>">
                                      <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                    <div class="col-xs-12">
                                    <label>Is It One Day Event ?</label>

                                    </div>
                               </div>

                               <div class="form-group">
                                  <div class="col-md-12">
                                      <div class='vertical-align short'>
                                        <div class='btns'>
                                          <label>
                                            <input name='oneDayEvent' id="oneDayYes" value="1" type='radio'<?php print($event->oneDayTrue); ?>>
                                              <span class='btn first'>Yes</span>
                                          </label>
                                          <label>
                                            <input name='oneDayEvent' id="oneDayNo" value="0" type='radio'<?php print($event->oneDayFalse); ?>>
                                              <span class='btn'>No</span>
                                          </label>
                                        </div>
                                      </div>
                                  </div>
                                </div>

                               <div class="form-group">
                                 <div class="col-xs-12">
                                   <label>Event Location</label>
                                 </div>
                                 <div class="col-xs-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventAddress" name="eventAddress" placeholder="Event Address" value="<?php print($data["eventAddress"]); ?>">
                                      <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventCity" name="eventCity" placeholder="Event City" value="<?php print($data["eventCity"]);?>">
                                      <span class="input-group-addon"><strong>C</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <select class="form-control" id="eventState" name="eventState" placeholder="Event State">
                                        <option value=""> State</option>
                                        <option value="AL" <?php if($data["eventState"] == "AL"){print('selected="selected"');}?>>Alabama</option>
                                        <option value="AK" <?php if($data["eventState"] == "AK"){print('selected="selected"');}?>>Alaska</option>
                                        <option value="AZ" <?php if($data["eventState"] == "AZ"){print('selected="selected"');}?>>Arizona</option>
                                        <option value="AR" <?php if($data["eventState"] == "AR"){print('selected="selected"');}?>>Arkansas</option>
                                        <option value="CA" <?php if($data["eventState"] == "CA"){print('selected="selected"');}?>>California</option>
                                        <option value="CO" <?php if($data["eventState"] == "CO"){print('selected="selected"');}?>>Colorado</option>
                                        <option value="CT" <?php if($data["eventState"] == "CT"){print('selected="selected"');}?>>Connecticut</option>
                                        <option value="DE" <?php if($data["eventState"] == "DE"){print('selected="selected"');}?>>Delaware</option>
                                        <option value="DC" <?php if($data["eventState"] == "DC"){print('selected="selected"');}?>>District Of Columbia</option>
                                        <option value="FL" <?php if($data["eventState"] == "FL"){print('selected="selected"');}?>>Florida</option>
                                        <option value="GA" <?php if($data["eventState"] == "GA"){print('selected="selected"');}?>>Georgia</option>
                                        <option value="HI" <?php if($data["eventState"] == "HI"){print('selected="selected"');}?>>Hawaii</option>
                                        <option value="ID" <?php if($data["eventState"] == "ID"){print('selected="selected"');}?>>Idaho</option>
                                        <option value="IL" <?php if($data["eventState"] == "IL"){print('selected="selected"');}?>>Illinois</option>
                                        <option value="IN" <?php if($data["eventState"] == "IN"){print('selected="selected"');}?>>Indiana</option>
                                        <option value="IA" <?php if($data["eventState"] == "IA"){print('selected="selected"');}?>>Iowa</option>
                                        <option value="KS" <?php if($data["eventState"] == "KS"){print('selected="selected"');}?>>Kansas</option>
                                        <option value="KY" <?php if($data["eventState"] == "KY"){print('selected="selected"');}?>>Kentucky</option>
                                        <option value="LA" <?php if($data["eventState"] == "LA"){print('selected="selected"');}?>>Louisiana</option>
                                        <option value="ME" <?php if($data["eventState"] == "ME"){print('selected="selected"');}?>>Maine</option>
                                        <option value="MD" <?php if($data["eventState"] == "MD"){print('selected="selected"');}?>>Maryland</option>
                                        <option value="MA" <?php if($data["eventState"] == "MA"){print('selected="selected"');}?>>Massachusetts</option>
                                        <option value="MI" <?php if($data["eventState"] == "MI"){print('selected="selected"');}?>>Michigan</option>
                                        <option value="MN" <?php if($data["eventState"] == "MN"){print('selected="selected"');}?>>Minnesota</option>
                                        <option value="MS" <?php if($data["eventState"] == "MS"){print('selected="selected"');}?>>Mississippi</option>
                                        <option value="MO" <?php if($data["eventState"] == "MO"){print('selected="selected"');}?>>Missouri</option>
                                        <option value="MT" <?php if($data["eventState"] == "MT"){print('selected="selected"');}?>>Montana</option>
                                        <option value="NE" <?php if($data["eventState"] == "NE"){print('selected="selected"');}?>>Nebraska</option>
                                        <option value="NV" <?php if($data["eventState"] == "NV"){print('selected="selected"');}?>>Nevada</option>
                                        <option value="NH" <?php if($data["eventState"] == "NH"){print('selected="selected"');}?>>New Hampshire</option>
                                        <option value="NJ" <?php if($data["eventState"] == "NJ"){print('selected="selected"');}?>>New Jersey</option>
                                        <option value="NM" <?php if($data["eventState"] == "NM"){print('selected="selected"');}?>>New Mexico</option>
                                        <option value="NY" <?php if($data["eventState"] == "NY"){print('selected="selected"');}?>>New York</option>
                                        <option value="NC" <?php if($data["eventState"] == "NC"){print('selected="selected"');}?>>North Carolina</option>
                                        <option value="ND" <?php if($data["eventState"] == "ND"){print('selected="selected"');}?>>North Dakota</option>
                                        <option value="OH" <?php if($data["eventState"] == "OH"){print('selected="selected"');}?>>Ohio</option>
                                        <option value="OK" <?php if($data["eventState"] == "OK"){print('selected="selected"');}?>>Oklahoma</option>
                                        <option value="OR" <?php if($data["eventState"] == "OR"){print('selected="selected"');}?>>Oregon</option>
                                        <option value="PA" <?php if($data["eventState"] == "PA"){print('selected="selected"');}?>>Pennsylvania</option>
                                        <option value="RI" <?php if($data["eventState"] == "RI"){print('selected="selected"');}?>>Rhode Island</option>
                                        <option value="SC" <?php if($data["eventState"] == "SC"){print('selected="selected"');}?>>South Carolina</option>
                                        <option value="SD" <?php if($data["eventState"] == "SD"){print('selected="selected"');}?>>South Dakota</option>
                                        <option value="TN" <?php if($data["eventState"] == "TN"){print('selected="selected"');}?>>Tennessee</option>
                                        <option value="TX" <?php if($data["eventState"] == "TX"){print('selected="selected"');}?>>Texas</option>
                                        <option value="UT" <?php if($data["eventState"] == "UT"){print('selected="selected"');}?>>Utah</option>
                                        <option value="VT" <?php if($data["eventState"] == "VT"){print('selected="selected"');}?>>Vermont</option>
                                        <option value="VA" <?php if($data["eventState"] == "VA"){print('selected="selected"');}?>>Virginia</option>
                                        <option value="WA" <?php if($data["eventState"] == "WA"){print('selected="selected"');}?>>Washington</option>
                                        <option value="WV" <?php if($data["eventState"] == "WV"){print('selected="selected"');}?>>West Virginia</option>
                                        <option value="WI" <?php if($data["eventState"] == "WI"){print('selected="selected"');}?>>Wisconsin</option>
                                        <option value="WY" <?php if($data["eventState"] == "WY"){print('selected="selected"');}?>>Wyoming</option>
                                      </select>


                                      <span class="input-group-addon"><strong>S</strong></span>
                                   </div>
                                 </div>
                                 <div class="col-md-4">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="eventZip" name="eventZip" placeholder="Event Zip" value="<?php print($data["eventZip"]);?>">
                                      <span class="input-group-addon"><strong>Z</strong></span>
                                   </div>
                                 </div>
                               </div>
                               
                             

                              <div class="form-group" id="tickets">
                                  <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="eventTicketsLink" name="eventTicketsLink" placeholder="Link Where to purchase tickets" value="<?php print($data["eventTicketsLink"]);?>">
                                        <span class="input-group-addon"><i class="fa fa-link" aria-hidden="true"></i></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="eventPrice" name="eventPrice" placeholder="Event Price" value="<?php print($data["eventPrice"]);?>">
                                        <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                    </div>
                                  </div>
                              </div>



                              <div class="form-group">
                                <div class="col-xs-12">
                                      <label for="eventDesc">Event Description</label>
                                </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-xs-12">
                                    <textarea class="form-control" id="eventDesc" name="eventDesc"><?php print($data["eventDesc"]);?></textarea>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-xs-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="eventTags" name="eventTags" placeholder="Event Tags" value="<?php print($data["eventTags"]);?>">
                                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                                    </div>
                                    <p class="help-block">Tags must be separated ba a comma</p>
                                    </div>
                              </div>
                              <div class="form-group hidden">
                                  <input type="hiddne" id="eventID" name="eventID" value="<?php print($data["eventID"]) ?>">
                              </div>

                             


                                <div class="form-group controls">
                                  <div class="col-xs-12">
                                      <div class="btn-group pull-right">
                                          <a href="events.php" class="fs-btn-blue btn"><i class="fa fa-rotate-left" aria-hidden="true"></i> Back</a>
                                         <button type="button" class="fs-btn-green btn saveEventBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                     </div>
                                   </div>
                                </div>  
                          </form>
                      </div>
                  </div>

                 <div class="panel panel-default">
                  <div class="panel-heading"><h3>Sponsors</h3></div>
                    <div class="panel-body">
                      <div class="table-responsive table-group">
                      <table class="table table-striped editable-table" id="slidesTable">
                        <thead>
                          <tr>
                            <th class="text-center">Sponsor Img</th>
                            <th>Sponsort Name</th>
                            <th>Sponsor Link</th>
                            <th class="text-right">Select</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><img class="img-responsive center-block" src="img/microsoft.png" alt="microsoft"></td>
                            <td class="title">Microsoft</td>
                            <td>http://microsoft.com</td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="sponsor1" value="" name="sponsors">
                                <label for="sponsor1">
                                </label>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><img class="img-responsive center-block" src="img/apple.png" alt="apple"></td>
                            <td class="title">Apple</td>
                            <td>http://apple.com</td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="sponsor2" value="" name="sponsors">
                                <label for="sponsor2">
                                </label>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><img class="img-responsive center-block" src="img/pepsi.png" alt="pepsi"></td>
                            <td class="title">Pepsi</td>
                            <td>http://pepsi.com</td>
                            
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="sponsor3" value="" name="sponsors">
                                <label for="sponsor3">
                                </label>
                              </div>
                            </td>
                          </tr>

                        </tbody>

                      </table>
                    </div>
                    <form class="form-inline fs-form-gen" name="" action="" id="sponsorForm" style="margin-top:15px; padding-top:15px;">

                          <div class="form-group">
                              <div class="input-group">
                                  <label for="sponsorImg">Select Sponsor Image</label>
                                  <input type="file" class="form-control" id="sponsorImg" name="sponsorImg">
                                  <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                             </div>
                          </div>
                          <div class="form-group">
                              <div class="input-group">
                                    <input class="form-control" type="text" id="sponsorName" name="" placeholder="Sponsor Name"/>
                                    <span class="input-group-addon">N</span>
                                </div>
                          </div>
                          <div class="form-group">
                              <div class="input-group">
                                    <input class="form-control" type="text" id="sponsorLink" name="" placeholder="Sponsor Link"/>
                                    <span class="input-group-addon"><i class="fa fa-external-link" aria-hidden="true"></i></span>
                                </div>
                          </div>
                    </form>
                    <div class="row table-addon">
                      <div class="col-xs-12">
                        <div class="btn-group pull-right">
                                <button class="btn btn-sm fs-btn-green add" id="addSponsor"><i class="fa fa-plus" aria-hidden="true"></i> Sponsor</button>
                                <button type="button" class="btn btn-sm fs-btn-red rm" id="rmSponsor"><i class="fa fa-trash" aria-hidden="true"></i> Sponsor</button>
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
    <script type="text/javascript" src="js/createEvent.js"></script>
    <script type="text/javascript" src="js/init-tynymce.js"></script>
    <link href="styles/css/tinymce-custom.css?v=<?php date('U')?>" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-timepicker/jquery.timepicker.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        
    });
    </script>
  </body>
  
</html>
