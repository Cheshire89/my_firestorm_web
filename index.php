<?php
require_once("classes/config.php");
$slides = new Slides();
$getFeatured = new featured_member();
$featuredVideo = new featured_video();
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Welcome To Firestorm</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php print(date('U'));?>" rel="stylesheet">
    <link href="styles/css/slider.css?v=<?php print(date('U'));?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      body{
        overflow-x: hidden;
      }
      .featured-member img{
         height: 270px;
         width: 270px;
      }
      .modal-dialog{
        margin-top:5%;
      }
    </style>
  </head>
  <body>
  	
  	<?php require_once('php/header.php') ?>
    <div class="container-fluid slider" style="margin-top:-15px;">
      <?php print($slides->getSlides()); ?>
    </div>
    <div class="container-fluid slider-nav-cont">
      <div class="row no-gutter slider-navigation">
        <div class="col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
            
            <span class="arrows">
              <span id="left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
              <span id="right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
            </span>
          
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="row featured">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-6">
                      <h2 class="fs-header">Why <span class="fs-strong">Firestorm?</span></h2>
                      <div class="embed-responsive embed-responsive-16by9">
                        <img class="img-responsive" src="" data-url="<?php print($featuredVideo->video); ?>" data-target="#video" data-toggle="modal" />
                      </div>
                    </div>
                  <div class="col-md-6 text-center featured-member">
                    <?php print($getFeatured->member); ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade video-modal" tabindex="-1" role="dialog" id="video">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
          <h4 class="modal-title fs-header">What is <strong>Firestorm</strong></h4>
        </div>
        <div class="modal-body">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="<?php print($featuredVideo->video); ?>"></iframe>
            </div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
         
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
    <script src="js/refer.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          videoImg = $('.embed-responsive img');
          videoUrl = videoImg.attr('data-url');
          
          videoId = videoUrl.slice(videoUrl.indexOf('embed/') + "embed/".length, videoUrl.length);
          key = 'AIzaSyBL2a7BMD7NYRE2v1ukqBjw6yuB1pLwfhg';
          dataUrl = 'https://i.ytimg.com/vi/'+videoId+'/maxresdefault.jpg';
          
          videoImg.attr('src', dataUrl);
          
          
          $('.embed-responsive-item').on('click',function(e){
                e.preventDefault();
    
          });
          slider = $('.slider');
          navigation = $('.slider-nav-cont');
          next = navigation.find('#right');
          prev = navigation.find('#left');

              slides = slider.find('.slide');
              active = slider.find('.active');

                  w = active.outerWidth();
          moving = false;


          prev.click(function() {
                console.log("Attempt Left");
                if(!moving) {
                    moving = true;
                    var slide = $(".slider").find(".slide").first();
                    var clone = slide.clone();
                    var moveWidth = $('.slide').css("width");
                    $('.slider').append(clone);
                    slide.animate({'margin-left': '-='+moveWidth}, 500).fadeOut(100, function() {
                        slide.detach();
                        moving = false;
                    });
                }
            });
            
            next.click(function() {
                console.log("Attempt Right");
                if(!moving) {
                    moving = true;
                    var slide = $(".slider").find(".slide").last();
                    var clone = slide.clone();
                    var moveWidth = $('.slide').css("width");
                    $('.slider').prepend(clone);
                    var slidenew = $(".slider").find(".slide").first();
                    slidenew.css("margin-left", "-"+moveWidth);
                    slidenew.animate({'margin-left': '0px'}, 500, function() {
                        slide.detach();
                        moving = false;
                    });
                }
            });

            setInterval(function(){
              if(!moving) {
                    moving = true;
                    var slide = $(".slider").find(".slide").last();
                    var clone = slide.clone();
                    var moveWidth = $('.slide').css("width");
                    $('.slider').prepend(clone);
                    var slidenew = $(".slider").find(".slide").first();
                    slidenew.css("margin-left", "-"+moveWidth);
                    slidenew.animate({'margin-left': '0px'}, 500, function() {
                        slide.detach();
                        moving = false;
                    });
                }
            },5000);

      });
    </script>

  </body>

  <style type="text/css">


  </style>
</html>
