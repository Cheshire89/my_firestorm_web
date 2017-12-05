<?php 
  require_once('classes/config.php');
  if(isset($_GET["eventID"]) && $_GET["eventID"] != ''){
    $events = new Events();
    $eventID = $_GET["eventID"];
    $event = $events->getEvent($eventID);
    $signedUp = $events->getSignedUp($eventID);

    $chapters = new Chapters();
    if($event["eventBy"] != "0") {
        $chapter = $chapters->getChapter($event["eventBy"]);
        
        $eventLocation = $chapter['chapterLocName'];
        $eventAddress = $chapter['chapterAddress'];
        $eventAddressCont = $chapter['chapterAddress2'];
        $eventCity = $chapter['chapterCity'];
        $eventState = $chapter['chapterState'];
        $eventZip = $chapter['chapterZip'];
    } else {
        $eventLocation = $event['eventLocation'];
        $eventAddress = $event['eventAddress'];
        $eventAddressCont = $event['eventAddressCont'];
        $eventCity = $event['eventCity'];
        $eventState = $event['eventState'];
        $eventZip = $event['eventZip'];
    }
    

    $sponsors = new Sponsors($eventID);
    $sponsorsHtml = $sponsors->print_sponsors();

    
      if(!isset($chapter["chapterName"]) &&  $chapter["chapterName"] == ''){
          $chapter["chapterName"] = "Firestorm";
      }
  }
  $checkUser = new User_Valid();
  if($checkUser->isLoggedIn()){
     $isUser = true;
     $signedUp = $events->is_signedup_for_event($_SESSION["userID"], $eventID);
  }else{
    $isUser = false;
  }

  $eventTimeParLine = date("m/d/Y", $event["eventDateStart"]).' '.$event["eventTimeStart"].' to '.$event["eventTimeEnd"];
?><!DOCTYPE html>
  

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title><?php print($event["eventTitle"]);?></title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/486ff18bfe.css" media="all">
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U'); ?>" rel="stylesheet">
    <link href="styles/css/event.css?v=<?php echo date('U'); ?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php 
      require_once('php/header.php');
      $explode = explode(".",$event["eventImg"]);
      $ext = $explode[sizeof($explode)-1];
      $blur = str_replace('.'.$ext, '_blur.'.$ext, $event["eventImg"]);
     ?>

    <div class="container-fluid cover-img visible-md visible-lg">
        <div class="row img-holder">
          <img src="<?php print($blur);?>" alt="<?php print($event["eventTitle"]);?>" class="img-reponsive">
        </div>
    </div>
    


    <div class="container event-header">
      <div class="row no-gutter slider-navigation">
           <div class="col-md-9 event-pic">
              <img class="cover img-responisive" src="<?php print($event["eventImg"]);?>" alt="<?php print($event["eventTitle"]);?>">
           </div>
           <div class="col-md-3 event-details">
              <div class="wrapper">
                <p class="date"><?php print($eventTimeParLine);?></p>
                <h4 class="fs-header"><span class="fs-strong"><?php print($event["eventTitle"]);?></span></h4>
                <p>by
                <?php
                  if($chapter["chapterName"] !== 'Firestorm'){
                    print('<a href="chapter.php?chapterID='.$chapter["chapterID"].'" title="chapter name">'.$chapter["chapterName"].'</a>');
                  }else{
                    print($chapter["chapterName"]);
                  }
                ?>

                </p>
                <?php 
                   if($event["eventPrice"]>0){
                     print('<p class="price">$'.number_format($event["eventPrice"], "2", '.', '').'</p>');
                   }
                ?>
              </div>
           </div>
       </div>
    </div>
    <div class="container event-actions">
      <div class="row">
        <div class="col-xs-6 col-md-9 text-left bg-white">
          <div class="btn-group">
              <!-- <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Share"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a> -->
              <a class="btn btn-default fs-ico-btn jQueryBookmark" href="#" title="Book Mark"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
          </div>
        </div>
        <?php
        if($signedUp){
            print('<div class="col-xs-6 col-md-3 text-center bg-white ticket">
           <a href="leave_event.php?eventID='.$eventID.'" title="Leave Event" class="btn fs-ticket-btn btn-md">Leave Event</a>
           </div>');
        }else{
          if($event["paidEvent"] && !$isUser){
              if($event['payThrough'] == "thirdparty") {
                print('<div class="col-xs-6 col-md-3 text-center bg-white ticket">
               <a href="'.$event['eventTicketsLink'].'" target="_blank" title="Purchase Tickets" class="btn fs-ticket-btn btn-md">Tickets</a>
            </div>');
              } else {
                print('<div class="col-xs-6 col-md-3 text-center bg-white ticket">
               <a href="event-checkout.php?eventID='.$eventID.'" title="Purchase Tickets" class="btn fs-ticket-btn btn-md">Tickets</a>
            </div>');
              }
              
          } else if($event["paidEvent"]){
              print('<div class="col-xs-6 col-md-3 text-center bg-white ticket">
           <a href="register_to_event.php?eventID='.$eventID.'" title="Register For Event" class="btn fs-ticket-btn btn-md">RSVP</a>
        </div>');
          } else{
            print('<div class="col-xs-6 col-md-3 text-center bg-white ticket">
           <button type="button" data-target="#regEventNonUserForm" data-toggle="modal" class="btn fs-ticket-btn btn-md">RSVP</a>
        </div>');
          }
        }

        ?>
        

      </div>
    </div>
    <div class="container info">
      <div class="row">
        <div class="col-md-9">
          <div class="row bg-grey">
              <div class="col-md-10 col-md-offset-1">
                <h4 class="fs-header text-left"><span class="fs-strong">Chapter Overview</span></h4>
                <div class="text-left">
                    <?php print($event["eventDesc"]);?>
                </div>
                </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-md-10 col-md-offset-1">
                <h4 class="fs-header text-left"><span class="fs-strong">Tags</span></h4>
                <ul class="list-inline tags">
                  <?php
                      print($event["eventTags"]);
                  ?>
                </ul>
            </div>
          
            <div class="col-xs-6 col-md-10 col-md-offset-1">
              <h4 class="fs-header text-left"><span class="fs-strong">Share</span></h4>

              <div class="btn-group chapter">
                  <a class="btn btn-default fs-ico-btn" target="_window" href="https://www.facebook.com/sharer/sharer.php?u=<?php print((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" title="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                          <a class="btn btn-default fs-ico-btn" target="_window" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php print((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&title=<?php print($chapter["chapterName"]);?>&summary=&source=" title="Linked In"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                          <a class="btn btn-default fs-ico-btn" target="_window" href="https://twitter.com/home?status=Check%20Us%20Out!%20<?php print((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" title="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                  <a class="btn btn-default fs-ico-btn" href="" title="Email" data-toggle="modal" data-target="#sendEmail"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 side-info">
          <div class="row bg-grey">
                
              <?php if($chapter["chapterName"] !== 'Firestorm') {?>
                  <div class="col-md-10 col-sm-6 text-left sub-info">
                    <h4 class="fs-header text-left"><span class="fs-strong">Next Chapter Meeting</span></h4>
                      <p><?php print($chapter["meetingDay"].' at '.$chapter["meetingTime"]);?></p>
                  </div>
                  <div class="col-md-10 col-sm-6 text-left sub-info">
                    <h4 class="fs-header text-left"><span class="fs-strong">Chapter Location</span></h4>
                    <p><?php print($eventLocation.'<br />'.$eventAddress.' '.$eventAddressCont.'<br />'.$eventCity.', '.$eventState.'<br />'.$eventZip);?></p>
                  </div>
                  <?php if($sponsorsHtml != '') { ?>
                  <div class="col-md-10 col-sm-6 text-left sub-info">
                    <h4 class="fs-header text-left"><span class="fs-strong">Sponsors</span></h4>

                    <div class="btn-group chapter sponsors">
                        <?php print($sponsorsHtml);?>
                    </div>       
                  </div>
                  <?php } 
               
              } else { 
                  $evLocation = $eventLocation.'<br />'.$eventAddress.' '.$eventAddressCont.'<br />'.$eventCity.', '.$eventState.'<br />'.$eventZip;
                ?>
                  <div class="col-md-10 col-sm-6 text-left sub-info">
                    <h4 class="fs-header text-left"><span class="fs-strong">Event Location</span></h4>
                    <p><?php print($evLocation);?></p>
                  </div>
                  <?php if($sponsorsHtml != '') { ?>
                  <div class="col-md-10 col-sm-6 text-left sub-info">
                    <h4 class="fs-header text-left"><span class="fs-strong">Sponsors</span></h4>

                    <div class="btn-group chapter sponsors">
                        <?php print($sponsorsHtml);?>
                    </div>       
                  </div>
                
                <?php } 
                
                } ?>

          </div>
        </div>
      </div>
    </div>

    <div class="container map">
      <div class="row">
        <div id="map">
          
        </div>
      </div>
    </div>

    <!-- <div class="container members bg-grey">
      <div class="row">
          <div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
                  <a href="profile.php" title="User Name">
                      <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="">
                  </a>
                  <h4 class="fs-header">Adam <span class="fs-strong">Smith</span></h4>
                  <p class="fs-header-black h5">Inciting Marketing</p>
              </div>
              <div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
                  <a href="profile.php" title="User Name">
                      <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="">
                  </a>
                  <h4 class="fs-header">Adam <span class="fs-strong">Smith</span></h4>
                  <p class="fs-header-black h5">Inciting Marketing</p>
              </div>
              <div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
                  <a href="profile.php" title="User Name">
                      <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="">
                  </a>
                  <h4 class="fs-header">Adam <span class="fs-strong">Smith</span></h4>
                  <p class="fs-header-black h5">Inciting Marketing</p>
              </div>
              <div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
                  <a href="profile.php" title="User Name">
                      <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="">
                  </a>
                  <h4 class="fs-header">Adam <span class="fs-strong">Smith</span></h4>
                  <p class="fs-header-black h5">Inciting Marketing</p>
              </div>
              <div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
                  <a href="profile.php" title="User Name">
                      <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="">
                  </a>
                  <h4 class="fs-header">Adam <span class="fs-strong">Smith</span></h4>
                  <p class="fs-header-black h5">Inciting Marketing</p>
              </div>
              <div class="col-xs-6 col-sm-4 col-md-3  text-center featured-member">
                  <a href="profile.php" title="User Name">
                      <img class="img-responsive img-circle center-block" src="img/mem1.jpg" alt="">
                  </a>
                  <h4 class="fs-header">Adam <span class="fs-strong">Smith</span></h4>
                  <p class="fs-header-black h5">Inciting Marketing</p>
              </div>
      </div>
    </div> -->

   

    
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF-N67li13yxETx0fnF8f-JAztGoeWF0c&callback=initMap"></script>
    <script>
      $('.event-header').ready(function(){
          var eventPic = $('.event-pic');
          var img = eventPic.find('img');

              var offset = (eventPic.height() - img.height()) / 2;
              img.css('margin-top', offset);
      });
      
      function initMap(){
        var coordinates = [<?php print($event['lat']); ?>, <?php print($event['lng']); ?>];
    	var latLng = new google.maps.LatLng(coordinates[0], coordinates[1]);
    	var mapOptions = {
        zoom: 13, // initialize zoom level - the max value is 21
        streetViewControl: false, // hide the yellow Street View pegman
        scaleControl: true, // allow users to zoom the Google Map
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: latLng,
        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#000000"},{"weight":"1.05"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"weight":"1.02"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#ff0000"},{"saturation":"-100"},{"lightness":"27"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"saturation":"-100"},{"lightness":"68"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"weight":"0.01"},{"saturation":"100"},{"lightness":"-21"},{"color":"#fccc9e"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"57"},{"gamma":"2.51"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"saturation":"-100"},{"lightness":"-32"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#f7f6f5"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#facaa3"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#f96e09"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffb363"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"},{"saturation":"-100"},{"lightness":"33"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffbe71"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#ffdbb6"},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"},{"saturation":"-100"},{"lightness":"40"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#fbe9d4"},{"saturation":"-8"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#ffe7d5"},{"weight":"0.84"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#ebeae9"},{"visibility":"on"}]}],
        scrollwheel:  false
    	};
    	
        var mapDiv = document.getElementById('map');
    	var map = new google.maps.Map(mapDiv,mapOptions);
    
    	marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        icon: 'img/map-marker.png'
        });
    }

      $(document).ready(function() {
          $("a.jQueryBookmark").click(function(e){
            if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
              window.sidebar.addPanel(document.title, window.location.href, '');
            } else if (window.external && ('AddFavorite' in window.external)) { // IE Favorite
              window.external.AddFavorite(location.href, document.title);
            } else if (window.opera && window.print) { // Opera Hotlist
              this.title = document.title;
              return true;
            } else { // webkit - safari/chrome
              alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
            }
          });
      });
    </script>



    <div class="fs-modal modal fade" id="sendEmail" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title fs-header"><strong>Send Email</strong></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <form class="form-horizontal fs-form-gen no-gutters" method="POST" name="shareEmail" id="shareEmail">
                 <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="evMsgFrom">From *</label>
                            <input type="text" class="form-control" name="evMsgFrom" id="evMsgFrom"/>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="evMsgTo">To *</label>
                            <input type="text" class="form-control" name="evMsgTo" id="evMsgTo"/>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="col-xs-12">
                            <?php 
                              $loc = $evLocation;
                            ?>
                            <label for="evMsgBody">Message *</label>
                            <textarea class="form-control" name="evMsgBody" id="evMsgBody"><?php 
                              print($event["eventTitle"]);?>

<?php print($eventTimeParLine); ?>

<?php print($eventLocation); ?>

<?php print($eventAddress.' '.$eventAddressCont); ?>

<?php print($eventCity.', '.$eventState.' '.$eventZip); ?></textarea>
                      </div>
                    </div>
                  </div>
                  <?php 
                  ?>
                  <input type="hidden" name="evMsgSubject" id="evMsgSubject" value="<?php print($event["eventTitle"]); ?>" />
                  <input type="hidden" name="evMsgTime" id="evMsgTime" value="<?php print($eventTimeParLine); ?>"/>
                  <input type="hidden" name="evMsgLoc" id="evMsgLoc" value="<?php print($eventLocation.' '.$eventAddress.' '.$eventAddressCont.' '.$eventCity.', '.$eventState.' '.$eventZip);?>"/>
                  <input type="hidden" name="evID" id="evID" value="<?php print($eventID);?>"/>
              </form>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn fs-btn-orange" id="sendEventMsg" data-dismiss="modal"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="fs-modal modal fade" id="regEventNonUserForm" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title fs-header"><strong>Register To Event</strong></h4>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <form class="form-horizontal fs-form-gen no-gutters" method="POST" name="regToEventForm" id="regToEventForm">
                 <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="regName">Full Name *</label>
                            <input type="text" class="form-control" name="regName" id="regName"/>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="regEmail">Email *</label>
                            <input type="email" class="form-control" name="regEmail" id="regEmail"/>
                        </div>
                    </div>
                  </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="regComp">Company Name </label>
                            <input type="text" class="form-control" name="regComp" id="regComp"/>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label for="regPhone">Phone *</label>
                            <input type="text" class="form-control" name="regPhone" id="regPhone"/>
                        </div>
                    </div>
                 </div>
              </form>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn fs-btn-orange" id="regToEvent" data-dismiss="modal"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript">
      $(document).ready(function(){
          
          $('#regToEvent').on('click', function(){
              console.log('click');
            
              valid=true;

              regName = $("#regName").val();
              regEmail = $("#regEmail").val();
              regComp = $("#regComp").val();
              regPhone = $("#regPhone").val();
              evId = $("#evID").val();

              console.log(regName);
console.log(regEmail);
console.log(regComp);
console.log(regPhone);
console.log(evId);


              if(regName == ''){
                $('#regName').closest('form-group').addClass('has-error');
                valid = false;
              }
              if(regEmail == ''){
                $('#regEmail').closest('form-group').addClass('has-error');
                valid = false;
              }
              if(regPhone == ''){
                $('#regPhone').closest('form-group').addClass('has-error');
                valid = false;
              }



              

              if(valid){
                  console.log('sent');
                  $.post('register_to_event_non_user.php', 
                    {name: regName,
                    email: regEmail,
                    company: regComp,
                    phone: regPhone,
                    evID: evId
                  }, 
                  function(data, textStatus, xhr) {
                    /*optional stuff to do after success */
                  });
              }else{
                alert('hi');
              }

          });
          $('#sendEventMsg').on('click', function() {
              valid = true;
              evMsgFrom = $("#evMsgFrom").val();
              evMsgTo = $("#evMsgTo").val();
              evMsgBody = $("#evMsgBody").val();
              evMsgSubject = $('#evMsgSubject').val();
              evMsgTime = $('#evMsgTime').val();
              evMsgLoc = $('#evMsgLoc').val();
              evId = $('#evID').val();

              if(evMsgFrom == ''){
                $('#evMsgFrom').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(evMsgTo == ''){
                $('#evMsgTo').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(evMsgBody == ''){
                $('#evMsgBody').closest('.form-group').addClass('has-error');
                valid = false;
              }

              if(valid){
                  $.post('sendEventMsg.php', 
                    {from: evMsgFrom,
                     to: evMsgTo,
                     msg: evMsgBody,
                     subj: evMsgSubject,
                     time: evMsgTime,
                     loc: evMsgLoc,
                     evID: evId
                    }, 
                  function(data) {
                     console.log(data);
                  });
              }
          });

      });
    </script>
  </body>
</html>