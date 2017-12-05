<?php
    require_once('classes/config.php');
    $page = $_SERVER['PHP_SELF'];
    $pageName = substr(strrchr($page, "/"), 1, -4);
    $banner = new Banners();
    $bnInfo = $banner->getBanner($pageName);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Link to Us</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="img/slider/slide-1.png" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left">Link<span class="fs-strong">To<i>Us</i></span></h1>
        </div>
      </div>
    </div>
    <div class="container link-to-us">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="thumbnail">
                <a href="#" title="">
                  <img class="img-responsive" src="img/member-black.png" alt="">
                </a>
                <div class="caption">
                  <div class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm fs-btn-orange copy-link">Copy Link <i class="fa fa-files-o" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-sm fs-btn-orange view-link">View Link <i class="fa fa-eye" aria-hidden="true"></i></button>
                    </div>
                  </div>
                  <div class="row code">
                    <div class="col-xs-12">
                       <textarea><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End of Col -->
            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="thumbnail">
                <a href="#" title="">
                  <img class="img-responsive" src="img/member-white.png" alt="">
                </a>
                <div class="caption">
                  <div class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm fs-btn-orange copy-link">Copy Link <i class="fa fa-files-o" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-sm fs-btn-orange view-link">View Link <i class="fa fa-eye" aria-hidden="true"></i></button>
                    </div>
                  </div>
                  <div class="row code">
                    <div class="col-xs-12">
                       <textarea><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End of Col -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="thumbnail">
                <a href="#" title="">
                  <img class="img-responsive" src="img/partner-black.png" alt="">
                </a>
                <div class="caption">
                  <div class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm fs-btn-orange copy-link">Copy Link <i class="fa fa-files-o" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-sm fs-btn-orange view-link">View Link <i class="fa fa-eye" aria-hidden="true"></i></button>
                    </div>
                  </div>

                  <div class="row code">
                    <div class="col-xs-12">
                       <textarea><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End of Col -->
            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="thumbnail">
                <a href="#" title="">
                  <img class="img-responsive" src="img/partner-white.png" alt="">
                </a>
                <div class="caption">
                  <div class="text-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm fs-btn-orange copy-link">Copy Link <i class="fa fa-files-o" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-sm fs-btn-orange view-link">View Link <i class="fa fa-eye" aria-hidden="true"></i></button>
                    </div>
                  </div>

                  <div class="row code">
                    <div class="col-xs-12">
                       <textarea><a href="http://myfirestorm.com/"><img title="MyFirestorm | Allows motivated business networking professionals to meet, socialize, and pass referrals" src="http://myfirestorm.com/assets/images/linklogos/member-white.png" alt="Minneapolis Minnesota Business Networking Group" width="250" height="100" ></a></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End of Col -->
          </div>
        </div>

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
    <script type="text/javascript">
      $('.link-to-us .view-link').on('click',function(){
          code = $(this).parents('.caption').find('.code').slideToggle('slow');
      });

      $('.link-to-us .copy-link').on('click', function(){
          link = $(this).parents('.caption').find('.code textarea').text();
          copyToClipboard(link);

          container = $(this).parents('.thumbnail');
          btnCont = $(this).parents('.btn-group');
          helpBlock = $('<p class="help-block">Code Was Copied to the Clipboard</p>');
          
          helpBlock.css('opacity',0);
          helpBlock.appendTo(container);

          $('.help-block').fadeTo('fast',1,function(){
            setTimeout(function(){
                container.find('.help-block').fadeOut('slow',function(){$('.help-block').detach();})
            },1500);
          });
      });

      function copyToClipboard(text) {
        var text = text; //getting the text from that particular Row
        //window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
        if (window.clipboardData && window.clipboardData.setData) {
            // IE specific code path to prevent textarea being shown while dialog is visible.
            return clipboardData.setData("Text", text); 

        } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
            var textarea = document.createElement("textarea");
            textarea.textContent = text;
            textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in MS Edge.
            document.body.appendChild(textarea);
            textarea.select();
            try {
                return document.execCommand("copy");  // Security exception may be thrown by some browsers.
            } catch (ex) {
                console.warn("Copy to clipboard failed.", ex);
                return false;
            } finally {
                document.body.removeChild(textarea);
            }
        }
      }   

    </script>
  </body>

  <style type="text/css">
    

  </style>
</html>
