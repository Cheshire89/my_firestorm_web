<?php 
    require_once("classes/config.php");

    $checkUser = new User_Valid();
    if(!$checkUser->isLoggedIn()){
        header('Location: /');
        exit();
    }
  

    if(isset($_GET["prospectID"]) && $_GET["prospectID"] != ''){
        $navigation = false;
        $status = 'prospect';

        $user = new Users();
        $userInfo = $user->get_admin_prospect($_GET["prospectID"]);
        $userID = $_GET["prospectID"];
        $userName = $userInfo["fName"].' '.$userInfo["lName"];
    }else if(isset($_GET["user"]) && $_GET["user"] != ''){
        $navigation = true;
        $status = 'user';

        $user = new Users();
        $userID = $_GET["user"];
        $userData = $user->get_user_info($userID);
        if($userData["applicationID"] != 0){
          $application = true;
          $userInfo = $user->get_admin_prospect($userData["applicationID"]);
              $userName = $userInfo["fName"].' '.$userInfo["lName"];
              $userInfo["profPic"] = './'.$userData["profPic"];
        }else{
          $application = fale;
              $userInfo = $userData;
              $userInfo["profPic"] = './'.$userData["profPic"];
        }
    }

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Aleksandr Antonov">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title><?php print(ucfirst($status).' '.$userName);?> </title>

    
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
          <img src="../<?php print($userInfo["covPic"]);?>" class="img-reponsive">
        </div>
    </div>


    <div class="container event-header profile-header edit">
      <div class="row">
           <div class="col-sm-3 event-details">
              <div class="wrapper featured-member profile-img">
                  <img id="profilePic" class="img-responsive img-circle center-block" src=".<?php print($userInfo["profPic"]);?>" alt="<?php print($userName);?>">
              </div>
           </div>
           <div class="col-sm-9 profile-details bg-grey bl-2">
              <div class="row">
                 <div class="col-xs-12 col-sm-6">
                   <h1 class="fs-header h2 bb-d-1" style="margin-top:7px;"><?php print(ucfirst($userInfo["fName"]));?> <span class="fs-strong"><?php print(ucfirst($userInfo["lName"]));?></span></h1>
                   <h5 class="fs-header">Job Title <span class="fs-header-black"><?php print($userInfo["jTitle"]);?></span></h5>
                   <h5 class="fs-header bb-d-1">Industy <span class="fs-header-black"><?php print($userInfo["industry"]);?></span></h5>
                   <h5 class="fs-header bb-d-1">Age Group <span class="fs-header-black"><?php print($userInfo["fsAplAge"]);?></span></h5>
                   <h5 class="fs-header"><i class="fa fa-linkedin-square" aria-hidden="true"></i> LinkedIn <span class="fs-header-black"><a href="<?php print($userInfo["linkedInLink"]);?>" target="_blank" title="Name + Linked in Profile"><?php print($userInfo["linkedInLink"]);?></a></h5>
                 </div>
              </div>

              
            </div>
       </div>
    </div>
    <?php if($navigation){ ?>
    <div class="container profile on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                <li class="active"><a href="profile.php?user=<?php print($userID); ?>" title="">Profile</a></li>
                <li><a href="profile-edit.php?user=<?php print($userID); ?>" title="">Edit Profile</a></li>
                <li><a href="profile-billing.php?user=<?php print($userID); ?>" title="">Billing</a></li>
                <li><a href="profile-referals.php?user=<?php print($userID); ?>" title="">Referals</a></li>
                <li><a href="prospectInfo.php?user=<?php print($userID);?>">Application</a></li>
            </ul>
          </div>
      </nav>
    </div>
    <?php } ?>
    <div class="container info">
    <?php if($userData["bio"] != NULL){ ?>
          <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1" style="padding-bottom:25px;">
                <h4 class="fs-header text-left"><span class="fs-strong">Bio</span></h4>
                <div class="text-left">
                    <?php print($userInfo["bio"]); ?>
                   </div>
                </div>
            </div>
    <?php } ?>
    <?php if(!$navigation){ ?>
            <div class="row">
              <div class="col-md-10 col-md-offset-1 position-details">  
                <div class="btn-group pull-right prospect-manage">
                    <a href="users-prospects.php" class="btn btn-sm fs-btn-blue"><i class="fa fa-rotate-left" aria-hidden="true"></i> Back</a>
                    <button type="button" class="btn btn-sm fs-btn-green prospectApprove"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button>
                    <button type="button" class="btn btn-sm fs-btn-red prospectDeny"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
                  </div>
              </div>
            </div>
     <?php } ?>

            <div class="row">
              <div class="col-md-10 col-md-offset-1 position-details">  

                      
                      <h2 class="fs-header bb-d-1" >Business <strong>Info</strong></h2>

                      <h5 class="fs-header">Company <span class="fs-header-black"><?php print($userInfo["compName"]);?></span></h5>
                      <h5 class="fs-header">Address <span class="fs-header-black"><?php print($userInfo["compAddOne"].' '.$userInfo["compAddTwo"]);?></h5>
                      <h5 class="fs-header">City | State | Zip <span class="fs-header-black">
                      <?php print(ucfirst($userInfo["compCity"]).', '.$userInfo["compState"].' '.$userInfo["compZip"]);?>
                      </h5>
                      <h5 class="fs-header"><i class="fa fa-phone-square" aria-hidden="true"></i> Phone <span class="fs-header-black"><a href="tel:3031234567" title="Business Name + Phone Number"><?php print($userInfo["compPhone"]);?></a></h5>
                      <h5 class="fs-header"><i class="fa fa-envelope-square" aria-hidden="true"></i> Email <span class="fs-header-black"><a href="mailto:<?php print($userInfo["compEmail"]);?>" title="<?php print($userInfo["compName"].' Email');?>"><?php print($userInfo["compEmail"]);?></a></h5>
                      <h5 class="fs-header"><i class="fa fa-globe" aria-hidden="true"></i> Website <span class="fs-header-black"><a href="http://lasyte.com" target="_blank" title="<?php print($userInfo["compName"]);?> Website"><?php print($userInfo["compWeb"]);?></a></h5>
              </div>
            </div>
            <div class="row firestorm-aplication" style="padding-top:20px;"">
              <div class="col-md-10 col-md-offset-1">
                  <h2 class="fs-header">Firestorm <strong>Application</strong></h2>
              </div>
            </div>
            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                  <h5 class="fs-header"><strong>Would you classify your business primarily as business-to-business (B2B), meaning you do business primarily with other businesses, or business-to-consumer (B2C), meaning you do business primarily with direct consumers?</strong></h5>
                  <p class="fs-header-black strong"><?php print($userInfo["fsAplBussFocus"]); ?></p>
              </div>
            </div>
            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                  <div class="row">
                     <div class="col-md-4">
                        <h5 class="fs-header"><strong>What BEST describes your position in your business?</strong></h5>
                        <p class="fs-header-black strong"><?php print($userInfo["fsAplBussPosition"]); ?></p>
                     </div>
                     <div class="col-md-4">
                        <h5 class="fs-header"><strong>How beneficial is networking to your business? </strong></h5>
                        <p class="fs-header-black strong"><?php print($userInfo["fsAplNetworkingBeneficial"]); ?></p>
                     </div>
                     <div class="col-md-4">
                        <h5 class="fs-header"><strong>How long do you feel it should take for you to receive referrals/introductions from your group?</strong></h5>
                        <p class="fs-header-black strong"><?php print($userInfo["fsAplReferralTurnarround"]); ?></p>
                     </div>
                  </div>
              </div>
            </div>

            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                  <div class="row">
                     <div class="col-md-4">
                        <h5 class="fs-header"><strong>How many people does your company employ?</strong></h5>
                        <p class="fs-header-black strong"><?php print($userInfo["fsAplCompEmploy"]); ?></p>
                     </div>
                     <div class="col-md-4">
                        <h5 class="fs-header"><strong>How many years have you been in your industry?</strong></h5>
                        <p class="fs-header-black strong"><?php print($userInfo["fsAplYearsInIndustry"]); ?></p>
                     </div>
                     <div class="col-md-4">
                        <h5 class="fs-header"><strong>How many years have you been working since finishing your initial high school/college education?</strong></h5>
                        <p class="fs-header-black strong"><?php print($userInfo["fsAplYearsSinceHsGraduation"]); ?></p>
                     </div>
                  </div>
              </div>
            </div>

            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                <div class="row">
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>How much do you use Linkedin to assist with your networking?</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplUseLinkedIn"]); ?></p>
                   </div>
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>How often do you attend networking/social events?</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplNetworkingAttendance"]); ?></p>
                   </div>
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>I am an active participant in my networking groups; e.g. I volunteer for more responsibility or take it upon myself to greet guests and help grow the group.</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplNetworkingParticipation"]); ?></p>
                   </div>
                </div>
              </div>
            </div>


            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                <div class="row">
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>I prefer for someone to wait for a good (real) opportunity to introduce me vs. an introduction for introductions sake.</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplWaitForOpportunity"]); ?></p>
                   </div>
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>I seek out potential customers/clients in my networking more so than seeking good strategic/referral partnerships.</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplSeekOutCustomers"]); ?></p>
                   </div>
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>I track how much business comes from my networking efforts.</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplTrackBusiness"]); ?></p>
                   </div>
                </div>
              </div>
            </div>

            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                <div class="row">
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>On an average week, how many hours do you work?</strong></h5>
                     <p class="fs-header-black strong"><?php print($userInfo["fsAplWorkHoursWeek"]); ?></p>
                   </div>
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>On an average work day what % of time is spent - Out in the field / at a clients? .</strong></h5>
                     <p class="fs-header-black strong">&#37;<?php print($userInfo["fsAplFieldVsClinets"]); ?></p>
                   </div>
                   <div class="col-md-4">
                     <h5 class="fs-header"><strong>On an average work day what % of time is spent In office / at desk?.</strong></h5>
                     <p class="fs-header-black strong">&#37;<?php print($userInfo["fsAplOfficeVsDesk"]); ?></p>
                   </div>
                </div>
              </div>
            </div>
            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                     <h5 class="fs-header"><strong>Please select all groups that you are currently a member of</strong></h5>
                     <ul class="list-group">
                        <?php print($user->print_member_groups($userInfo));?>
                     </ul>
              </div>
            </div>
             <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                     <h5 class="fs-header"><strong>Which of these would you consider to be your primary (most valuable to you) group</strong></h5>
                     <ul class="list-group">
                       <?php print($user->print_important_groups($userInfo));?>
                     </ul>
              </div>
            </div>
            <div class="row firestorm-aplication">
              <div class="col-md-10 col-md-offset-1">
                <div class="row">
                   <div class="col-md-12">
                     <h5 class="fs-header"><strong>I track how much business comes from my networking efforts.</strong></h5>
                     <p class="fs-header-black strong">Yes</p>
                   </div>
                </div>
              </div>
            </div>
          <?php if(!$navigation){ ?>
          <div class="row" style="padding-top:25px;"">
              <div class="col-xs-12">
                <div class="btn-group pull-right prospect-manage">
                  <a href="users-prospects.php" class="btn btn-sm fs-btn-blue"><i class="fa fa-rotate-left" aria-hidden="true"></i> Back</a>
                  <button type="button" class="btn btn-sm fs-btn-green prospectApprove"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Approve</button>
                  <button type="button" class="btn btn-sm fs-btn-red prospectDeny"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
                </div>
              </div>
          </div>
          <?php } ?>

          <div class="form-group hidden">
             <input type="hidden" name="prospectID" id="prospectID" value="<?php print($userID);?>">
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

      $('.prospectApprove').on('click',function(){
          id = $('#prospectID').val();
          
          $.post('approveProspect.php', 
            {prospectID: id}, 
            function(data, textStatus, xhr) {
                
            });
      });

      $('.prospectDeny').on('click',function(){
          id = $('#prospectID').val();
          
          $.post('deleteProspect.php', 
            {prospectID: id}, 
            function(data, textStatus, xhr) {
                window.location = "users-prospects.php";
            });
      });

    </script>
  </body>

  <style type="text/css">
  .contact-info{
    display: none;
  }

  .list-group .list-group-item{
      background-color: transparent;
      border:0px none;
      vertical-align: middle;
  }
  .list-group .list-group-item:before{
      font-family: 'FontAwesome';
      content: '\f111';
      font-size: 0.8em;
      margin-right: 5px;
      color: #d36a1d;
      display: inline-block;
  }
  </style>
</html>
