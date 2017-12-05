<?php 
require_once("classes/config.php");
$events = new Events();
$chapters = new Chapters();
$chaptersData = $chapters->getAdminChaptersData();
$content = $events->getAdminEvents($chaptersData);
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
                    <div class="panel-heading"><h3>Search Events</h3></div>
                    <div class="panel-body">
                       <form class="form-horizontal fs-form-gen" action="searchEventsForm.php" name="searchEventsForm" method="POST">
                         
                         <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Event Title">
                                    <span class="input-group-addon">H</span>
                               </div>
                              
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="eventDate" name="eventDate" />
                                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                              
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-4">
                              <div class="input-group">
                                    <input type="text" class="form-control" id="eventCity" name="eventCity" placeholder="Event City" />
                                    <span class="input-group-addon">C</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                    <select class="form-control" id="eventState" name="eventState">
                                        <option>Event Zip</option>
                                        <option>Colorado</option>
                                        <option>Arizona</option>
                                    </select>
                                    <span class="input-group-addon">S</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                    <input type="text" class="form-control" id="eventZip" name="eventZip" placeholder="Event Zip" />
                                    <span class="input-group-addon">Z</span>
                                </div>
                            </div>
                         </div>
                         
                         <div class="row controls">
                            <div class="col-xs-12">
                               <div class="btn-group pull-right">
                                 <button type="button" class="fs-btn-blue btn-sm btn" id="searchEventsBtn"><i class="fa fa-search" aria-hidden="true"></i> Events</button>
                               </div>
                            </div>
                         </div>  
                         
                      </form>
                  </div>
                </div>


                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Manage All Events</h3></div>
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
                          <?php print($content);?>
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
          $('#rmEvent').on('click',function(){
              rmArr = deleteArray($('#eventsTable'));
              console.log(rmArr);
              processDelete = $.post('deleteEvent.php', {'deleteEvents[]': rmArr}, function(textStatus){
                    deleteRow($('#eventsTable'));
              });
          });
      });
    </script>
  </body>
</html>
