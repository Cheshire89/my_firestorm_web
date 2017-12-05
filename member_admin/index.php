<?php 
  require_once('classes/config.php');

  $checkUser = new User_Valid();
  if(!$checkUser->isLoggedIn()){
      header('Location: /');
      exit();
  }
  
  if(isset($_SESSION["userID"]) && $_SESSION["userID"]!=''){
    $userID = $_SESSION["userID"];
    $user = new Users();
    $profInfo = $user->get_user_info($userID);
    $chapters = new Chapters();
    $chaptersEnrolled = $chapters->printUserChapters($userID, null);

    $name = ucfirst($profInfo["fName"]).' '.ucfirst($profInfo["lName"]);
    
    $events = new Events();
    $content = $events->getEvents($userID);
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

    <title>Firestorm | <?php print($name); ?></title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php echo date('U')?>" rel="stylesheet">
    <link href="styles/css/event.css?v=<?php echo date('U')?>" rel="stylesheet">
    <link href="styles/css/profile.css?v=<?php echo date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>

    <div class="container-fluid cover-img visible-md visible-lg">
        <div class="row img-holder">
          <img src=".<?php print($profInfo["covPic"]);?>" class="img-reponsive">
        </div>
    </div>


    <div class="container event-header profile-header edit">
      <div class="row">
           <div class="col-sm-3 event-details">
              <div class="wrapper featured-member profile-img">
                  <img id="profilePic" class="img-responsive img-circle center-block" src=".<?php print($profInfo["profPic"]);?>" alt="<?php print($name);?> Profile Picture">
              </div>
           </div>
           <div class="col-sm-9 profile-details bg-grey bl-2">
              <div class="row">
                 <div class="col-xs-12">
                   <h1 class="fs-header h2"><?php print($profInfo["fName"]); ?> <span class="fs-strong"><?php print($profInfo["lName"]); ?></span></h1>
                   <p class="fs-header"><strong><?php print($profInfo["companyName"]);?></strong>, <?php print($profInfo["companyPosition"]);?></p>
                   <p class="fs-header-black">Member Since:<span class="f-header"> <?php print( date('Y', $profInfo["dateApproved"])); ?></span></p>
                 </div>
                
              </div>
            </div>
       </div>
    </div>
    <div class="container profile on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                  <li class="active"><a href="/" title="">Profile</a></li>
                  <li><a href="profile-edit.php" title="">Edit Profile</a></li>
                  <li><a href="profile-billing.php" title="">Billing</a></li>
                  <li><a href="profile-referals.php" title="">Referals</a></li>
            </ul>
          </div>
      </nav>
    </div>


    <div class="container info">
      <div class="row">

       <div class="col-md-10 col-md-offset-1">
            <div class="row">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-xs-12">
                    <h4 class="fs-header text-left">About <span class="fs-strong">Me</span></h4>
                    <p class="fs-header-black"><?php print(nl2br($profInfo["bio"]));?></p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-12 company-details">
                      <h4 class="fs-header text-left">Company <span class="fs-strong">Details</span></h4>
                      <p class="fs-header-black" id="compName"><?php print($profInfo["companyName"]);?></p>
                      <p class="fs-header-black"><?php print($profInfo["companyIndustry"]);?></p>
                      <p class="fs-header-black"><?php print($profInfo["companyAddress"]);?> <?php if(isset($profInfo["companyAddressCont"]) && $profInfo["companyAddressCont"] != ''){print($profInfo["companyAddressCont"]);}?></p>
                      <p class="fs-header-black"><?php print($profInfo["companyCity"].' '.$profInfo["companyState"].', '.$profInfo["companyZip"]);?></p>
                      <p class="fs-header-black"><a href="tel:<?php print($profInfo["companyPhone"]);?>"><?php print($profInfo["companyPhone"]);?></a></p>
                      <p class="fs-header-black"><a target="_blank" href="<?php print($profInfo["companyWeb"]);?>" title="<?php print($profInfo["companyName"]);?> Website"><?php print($profInfo["companyWeb"]);?></a></p>
                    </div>
                  

                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <h4 class="fs-header text-left">Expertise <strong><i>&amp;</i></strong> <strong>Experience</strong></h4>
                        <ul class="list-unstyled expertise-list">
                          <?php 
                            print($user->print_admin_user_expertise_list($profInfo["expertise"]));
                          ?>
                        </ul>
                    </div>
                </div>

                 


                </div>
              </div>
         
             <h4 class="fs-header text-left">Chapters <span class="fs-strong">Enrolled</span></h4>
             <ul class="list-inline groups">
                 <?php print($chaptersEnrolled); ?>
              </ul>
          
      </div>
      </div>

      
      <div class="row">
        <div class="col-xs-6 col-md-10 col-md-offset-1">
              
                <a class="btn btn-default fs-btn-orange btn-md" href="link-to-page" title="Facebook">Refer</a>
             
        </div>
      </div>


    </div>

    <div class="container  bg-grey">
        <div class="row">
            <h2 class="fs-header h3 text-center">Upcoming <span class="fs-strong">Events</span></h2>
        </div>
    </div>

    <div class="container result-boxes bg-grey">
        <div class="row ">
            <?php print($content); ?>
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
    
    <script>
      $('.event-header').ready(function(){
          var eventPic = $('.event-pic');
          var img = eventPic.find('img');

              var offset = (eventPic.height() - img.height()) / 2;
              img.css('margin-top', offset);
      });
      
      $('.contact-btns .btn').on('click',function(){
          target = $($(this).attr('data-target'));
          if($('.contact-info').is(':visible')){
              $('.contact-info').slideUp('slow');
              target.slideToggle();
          }else{
              target.slideToggle();
          }
      });
            
      
    </script>
  </body>

  <style type="text/css">
  .contact-info{
    display: none;
  }

  </style>
</html>
