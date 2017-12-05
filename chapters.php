<?php 
    require_once('classes/config.php');
    $chapters = new Chapters();
    $chaptersList = $chapters->print_chapters_site_front();
    $events = new Events();
    $nextEvents = $events->get_next_meetings(3);
    $banners = new Banners();
    $banner = $banners->getBanner('chapters');
    
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Visit One of Our Chapters</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="<?php print(substr($banner["bnImgPath"], 1));?>" alt="<?php print($banner["bnImgDesc"]);?>" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
     <!--  col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 -->
        <div class="container">
            <h1 class="fs-header-white text-left"><?php print($banner["bnText"]);?></h1>
        </div>
      </div>
    </div>
    
    <div class="container on-page-menu" style="text-align:center;">
    <div class="center-block">
       <form class="form-inline fs-form-gen" action="" method="POST">
         <div class="form-group">
          <input type="text" class="form-control" id="chapterName" name="chapterName" placeholder="Search Chapters">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="chapterCity" name="chapterCity" placeholder="City">
        </div>
        <div class="form-group">
          <select class="form-control" id="chapterState" name="chapterState">
                    <option value="">State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
            </select>
        </div>
        <button type="button" class="btn btn-default fs-btn-orange" id="searchChaptersBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
       </form>
    </div>
    </div>

    <div class="container text-block">
      <div class="row">
        <div class="col-xs-12">
            <h3 class="fs-header text-center">Chapters for you in <span class="fs-strong">Colorado</span></h3>
              <p>Come see for yourself what we're all about! Guests can visit twice for free before deciding if they would like to apply for membership.<br />
                <br />
                Chapters are organized with strategic connections in mind. A small group with deep connections that will be mutually beneficial to each other. We cap all of our groups at 24 members. Additionally we only allow one person per profession so there is no competition for business. It is collaborative. When selecting a chapter to visit, look for something close to your home or work as well as a chapter that has an opening for what you do.</p>
        </div>
      </div>
    </div>

    <div class="container map">
      <div class="row">
        <div id="map">
          
        </div>
      </div>
    </div>

    <div class="container table-container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped fs-table" >
                    <thead>
                      <tr>
                        <th id="group">Group</th>
                        <th id="city">City</th>
                        <th id="state">State</th>
                        <th id="day">Day</th>
                        <th id="time">Time</th>
                      </tr>
                    </thead> 
                    <tbody id="chaptersList">
                       <?php print($chaptersList);?> 
                    </tbody> 
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h2 class="fs-header h3 text-center">Upcoming <span class="fs-strong">Chapter Meetings</span></h2>
        </div>
    </div>

    <div class="container result-boxes">
        <div class="row">
           <?php print($nextEvents);?>
        </div>
    </div>


         
    <?php require_once('php/sign-up.php') ?>
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
    <script src="js/map.js"></script>
    <script type="text/javascript">
    <!--
      var map;
      var $markers = [];

      function initMap() {
        var locations = <?php print($chapters->getChaptersLngLat()); ?>;
        var mapOptions = {
                center: new google.maps.LatLng(39.7642548,-104.9951939),
                zoom: 9, // initialize zoom level - the max value is 21
                streetViewControl: false, // hide the yellow Street View pegman
                scaleControl: true, // allow users to zoom the Google Map
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#000000"},{"weight":"1.05"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"weight":"1.02"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#ff0000"},{"saturation":"-100"},{"lightness":"27"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"saturation":"-100"},{"lightness":"68"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"weight":"0.01"},{"saturation":"100"},{"lightness":"-21"},{"color":"#fccc9e"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"57"},{"gamma":"2.51"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"saturation":"-100"},{"lightness":"-32"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#f7f6f5"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#facaa3"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#f96e09"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffb363"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"},{"saturation":"-100"},{"lightness":"33"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffbe71"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#ffdbb6"},{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"},{"saturation":"-100"},{"lightness":"40"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#fbe9d4"},{"saturation":"-8"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#ffe7d5"},{"weight":"0.84"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#ebeae9"},{"visibility":"on"}]}],
                scrollwheel:  false
            };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        // This event listener will call addMarker() when the map is clicked.
        

        // Adds a marker at the center of the map.
        addMarker(locations);
      }

      // Adds a marker to the map and push to the array.
      function addMarker(locations) {
        markerIcon = 'img/map-marker.png';
        for (i = 0; i < locations.length; i++) { 
          console.log("lat: "+locations[i][1]); 
          var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: markerIcon
                });
              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
              }));
              console.log("adding marker"+locations[i][1]+" "+locations[i][2]);
              $markers.push(marker);
        }
          
      }

      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < $markers.length; i++) {
          $markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Shows any markers currently in the array.
      function showMarkers() {
        setMapOnAll(map);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        $markers = [];
      }

    $(document).ready(function(){
        $('#searchChaptersBtn').on('click',function(){
            var title = $('#chapterName').val();
            var city = $('#chapterCity').val();
            var state = $('#chapterState').val();

            $.ajax({
                url: 'searchChapters.php',
                type: 'POST',

                data: {
                    chapterName: title,
                    chapterCity: city,
                    chapterState: state
                },
            })
            .done(function(data) {
                var decode = $.parseJSON(data);
                $('#chaptersList').empty();
                $('#chaptersList').prepend(decode.resultsHtml);
                //console.log(decode.mapLocs)
                console.log('decode');
                console.log(decode);
                deleteMarkers();
                addMarker(decode.mapLocs);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            }); 
        });
    });



    -->
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF-N67li13yxETx0fnF8f-JAztGoeWF0c&callback=initMap"></script>
  </body>
</html>