<?php

require_once("classes/config.php");

$videos = new videos();
$allVideos = $videos->getAllVideos();
$testimonials = $videos->getTestimonials();
$banners = new Banners();
$banner = $banners->getBanner('videos');

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Videos</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      .thumbnail .caption {
          padding: 9px;
          max-height: 50px;
          height: 50px;
          overflow: hidden;
          text-overflow: ellipsis;
      }
      @media (max-width: 450px){
        .video-container{
          width: 100%;
        }
      }
    </style>
    
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="<?php print($banner["bnImgPath"]);?>" alt="<?php print($banner["bnImgDesc"]);?>" style="width:100%; ">
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
           <form class="form-inline fs-form-gen searchVidoes">
             <div class="form-group">
              <input type="text" class="form-control" id="searchChaptersTitle" name="searchChaptersTitle" placeholder="Video Title" />
            </div>
            <div class="form-group">
              <select class="form-control" id="videoCategory" name="videoCategory">
                  <option> Select Category </option>
                  <option value="Education"> Education </option>
                  <option value="Events"> Events </option>
                  <option value="Testimonial"> Testimonials </option>
                  <option value="Firestorm Fridays"> Firestorm Fridays </option>
                  <option value="Other"> Other </option>
              </select>
            </div>
            <button type="button" class="btn btn-default fs-btn-orange searchVideosBtn"><i class="fa fa-search" aria-hidden="true"></i></button>
           </form>
        </div>
    </div>

    <div class="container videos">
      <div class="row">
        <div class="col-md-3 br-d-2">
          <div class="row">
            <div class="col-xs-12"><h2 class="fs-header">Testimonials</h2></div>
            <?php print($testimonials); ?>
          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-xs-12"><h2 class="fs-header">Videos</h2></div>
            <?php print($allVideos); ?>
          </div>
        </div>

      </div>
    </div>


    

  <div class="modal fade video-modal" tabindex="-1" role="dialog" id="video">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
          <h4 class="modal-title fs-header">Modal title</h4>
        </div>
        <div class="modal-body">
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
    <script type="text/javascript">
      $(document).ready(function(){
            loadIframes();
            // Additional Data (,contentDetails,statistics,status)
      $('.videos .fa-play-circle').each(function(){
          $(this).attr('data-target', '#video');
      });

      $('.videos .fa-play-circle').on('click',function(){
          videoCont = $(this).parents('.video-container').find('.embed-responsive');
          title = $(this).parents('.thumbnail').find('.caption .fs-header').text();
            
            video = videoCont.find('iframe');
            video.attr('src', video.attr('src') + '?rel=0&autoplay=1');
          
            modal = $('#video');
            modalBody = modal.find('.modal-body');
            modalHeader = modal.find('.modal-header .modal-title');
            modalHeader.text(title);

              if(!modalBody.children('.embed-responsive').length){
                  modalBody.append(videoCont.show());
              }else{
                  modalBody.children('.embed-responsive').detach();
                  modalBody.append(videoCont.show());
              }
      });

      $('#closeModal').on('click',function(){
          modalBody = $(this).parents('.modal-content').find('.modal-body');
          modalBody.find('.embed-responsive').detach();
      });
        
        $('.searchVideosBtn').click(function() {
           var videoTitle = $('#searchChaptersTitle').val();
           var videoCategory = $('#videoCategory').val();
           
           if(videoTitle != "" || videoCategory != "") {
                $.post("searchVideos.php", {'videoTitle': videoTitle, 'videoCategory': videoCategory}, function(result) {
        			if(result != "Error") {
        			   $('.videos').find(".row").empty();
                       $('.videos').find(".row").html(result);
                       loadIframes();
        			} else {
        			   //console.log(result);
        			}
        		});
            } else {

        		$('#searchChaptersTitle').closest(".form-group").addClass("has-error");
        		$('#videoCategory').closest(".form-group").addClass("has-error");
                
                $('.searchVidoes').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out at least 1 field.</div>');
            }
       });


    });
    
    function loadIframes() {
        $('iframe').each(function(index){
              src = $(this).attr('src');
              videoId = src.slice(src.indexOf('embed/') + "embed/".length, src.length);
              key = 'AIzaSyBL2a7BMD7NYRE2v1ukqBjw6yuB1pLwfhg';
              dataUrl = 'https://www.googleapis.com/youtube/v3/videos?id='+ videoId +'&key='+ key +'&part=snippet';
              
              obj = this;
              //console.log(this);

              $.ajax(dataUrl, {async:false}, function(){
              }).done(function(data){     
                    
                    console.log(data);
                    snippet = data['items'][0].snippet;
                    pullThumb = snippet.thumbnails.medium['url'];
                    pullTitle = snippet['title']; 

                    img = $(obj).parents(".video-container").find('.thumbnail img');
                    console.log(img);
                    title = $(obj).parents('.video-container').find('.thumbnail .caption .fs-header');                    
                    img.attr('src', pullThumb);
                    img.attr('alt', pullTitle);

                    title.text(pullTitle);  
              });
        });
    }
      // https://i.ytimg.com/vi/gvipGFcbBTQ/maxresdefault.jpg
    </script>
  </body>

  <style type="text/css">
  .embed-responsive{
    display: none;
  }
  .modal .modal-dialog{
    margin:5% auto;
  }

  </style>
</html>
