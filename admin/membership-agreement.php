<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
    header('Location: /');
    exit();
}

$membershipAgreement = new membership_agreement();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin Docs | Membership Agreement</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
    .panel.panel-default{
        border-top:0px none;
        border-top-right-radius: 0px;
        border-top-left-radius: 0px;
        padding-top:15px;
    }
  </style>
  </head>
  <body>
  	
  	<?php require_once('php/header.php') ?>
    <div class="container" id="adminContainer">
      <div class="row">

         <div class="col-md-10  col-md-offset-1">
              <div class="row on-page-nav admin-nav" id="adminSubNav">
                <div class="col-xs-12">
                  <nav class="navbar">
                      <div class="navbar-collapse">
                        <ul class="nav nav-justified">
                            <li><a href="link-to-us.php" title="">Link to Us</a></li>
                            <li class="active"><a href="membership-agreement.php" title="">Membership Agreement</a></li>
                            <li><a href="privacy-policy.php" title="">Privacy Policy</a></li>
                            <li><a href="terms-of-use.php" title="">Terms of Use</a></li>
                        </ul>
                      </div>
                  </nav>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <div class="panel panel-default">
                        <!-- <div class="panel-heading"><h3>Membership Admin</h3></div> -->
                        <div class="panel-body">
                           <form class="form-horizontal fs-form-gen saveMembershipAgreement" action="saveMembershipAgreement.php" name="saveMembershipAgreement" method="POST">
                             <div class="col-xs-12">
                               <div class="form-group">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="membershipAgreementHeader" name="membershipAgreementHeader" placeholder="Main Header" value="<?php print($membershipAgreement->header); ?>">
                                      <span class="input-group-addon">H</span>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="membershipAgreementText" name="membershipAgreementText" placeholder="Membership Agreement Content"><?php print($membershipAgreement->content); ?></textarea>
                                </div>
                                <div class="form-group controls">
                                   <div class="col-xs-12"><button type="button" class="fs-btn-green btn pull-right" id="saveMembershipAgreementBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button></div>
                                </div>  
                             </div>
                          </form>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <link href="styles/css/tinymce-custom.css?v=<?php date('U')?>" rel="stylesheet">
    <script src="js/script.js"></script>
     <script type="text/javascript" src="js/init-tynymce.js"></script>
     <script type="text/javascript">
    <!--
    	$(document).ready(function() {
    	   $('#saveMembershipAgreementBtn').click(function() {
    	       var membershipAgreementHeader = $('#membershipAgreementHeader').val();
               var membershipAgreementText = $('#membershipAgreementText').val();
               
               if(membershipAgreementHeader != "" && membershipAgreementText != "") {
                  document.saveMembershipAgreement.submit();
               } else {
                  $('#membershipAgreementHeader').closest(".form-group").addClass("has-error");
        		  $('#membershipAgreementText').closest(".form-group").addClass("has-error");
                  $('.saveMembershipAgreement').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out both fields.</div>');
               }
    	   });
    	});
    -->
    </script>
  </body>
</html>
