<?php 
  require_once('classes/config.php');

  $checkUser = new User_Valid();
  if(!$checkUser->isLoggedIn()){
      header('Location: /');
      exit();
  }

  if(isset($_GET["userID"]) && $_GET["userID"]!=''){
    $userID = $_GET["userID"];
    $user = new Users();
    $profInfo = $user->get_user_info($userID);
    $name = ucfirst($profInfo["fName"]).' '.ucfirst($profInfo["lName"]);
    $paymentInfo = new Payment($userID);
    $customerID = $paymentInfo->get_customer_id();
    $payments = $paymentInfo->payment_history_table();
    $subscriptionID = $paymentInfo->getSubscriptionID($userID);
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

    <title>Payment History</title>
    
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
          <img src="../<?php print($profInfo["covPic"]);?>" class="img-reponsive">
        </div>
    </div>


    <div class="container event-header profile-header edit">
      <div class="row">
           <div class="col-sm-3 event-details">
              <div class="wrapper featured-member profile-img">
                  <img id="profilePic" class="img-responsive img-circle center-block" src="../<?php print($profInfo["profPic"]);?>" alt="<?php print($name);?> Profile Picture">
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
                  <li class="active"><a href="profile.php?user=<?php print($userID);?>" title="">Profile</a></li>
                  <li><a href="profile-edit.php?user=<?php print($userID);?>" title="">Edit Profile</a></li>
                  <li><a href="profile-billing.php?user=<?php print($userID);?>" title="">Billing</a></li>
                  <li><a href="profile-referals.php?user=<?php print($userID);?>" title="">Referals</a></li>
                  <li><a href="prospectInfo.php?user=<?php print($userID);?>">Application</a></li>
                </ul>
              </div>
          </nav>
        </div>

    <div class="container table-container bb-2">
        <div class="row">
            <div class="table-responsive">
            <table class="table table-striped fs-table" id="paymentMethods">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Paymnet Type</th>
                    <th>Payment Frequency</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>Last Four</th>
                    <th>Primary Payment</th>
                    <th>Set As Primary Payment</th>
                  </tr>
                </thead> 
                <tbody>
                    
                  <?php print($payments);?>
                </tbody> 
             </table>
             </div>
        </div>
        <div class="row">
          <div class="col-md-6">
             <a href="profile-billing.php?user=<?php print($userID);?>" style="margin-bottom:8px;"><h4 class="fs-header">Return to <strong>Billing</strong> <i class="fa fa-repeat fa-flip-horizontal" aria-hidden="true"></i></h4></a>
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
    
    <script>
      $('#assignSubscription').on('click',function(){
          var table = $('#paymentMethods');
              rows = table.find('tbody tr');
              rows.each(function(){
                 checkCont = $(this).find('td:first-child');
                 if(checkCont.find('input[type="checkbox"]').is(':checked')){
                    console.log($(this).find('input[type="checkbox"]'));
                 }
              });
      });

      $('.event-header').ready(function(){
          var eventPic = $('.event-pic');
          var img = eventPic.find('img');

              var offset = (eventPic.height() - img.height()) / 2;
              img.css('margin-top', offset);

              
      });
      
      $('.delete-payment').click(function() {
          var paymentID = $(this).attr("data-id");
          var customerID = $('#customerID').val();
          var row = this;
          //window.location.href = '../payment/deletePayment.php';
          $.post('../payment/delete_customer_payment_profile.php', {'profileID': customerID, 'paymentID': paymentID}, function(data) {
              if(data == "success") {
                $(row).closest("tr").remove();
              } else {
                console.log("error removing payment method: ".data)
              }
          });
      });
      
      $('.updateSubscriptionPayment').click(function() {
          var paymentID = $(this).attr("data-id");
          var customerID = $('#customerID').val();
          var subscriptionID = $('#subscriptionID').val();
          var row = this;
          //window.location.href = '../payment/deletePayment.php';
          $.post('../payment/update-subscription.php', {'subscriptionID': subscriptionID, 'profileID': customerID, 'paymentID': paymentID}, function(data) {
              if(data == "success") {
                console.log("success");
              } else {
                console.log("error removing payment method: ".data)
              }
          });
      });

      $('.edit-payment').on('click',function(){
            var paymentForm = $('#paymentForm');
            header = paymentForm.find('#header');
                    headerHtml = $('<h3 class="fs-header">Edit <span class="fs-strong">Payment</span></h3>');

            $('#saveCard').text('Save');

            if(!header.find('.fs-header').length){
              header.append(headerHtml);
            }else{
              header.find('.fs-header').detach();
              header.append(headerHtml);
            }

            
              $('.form-container').slideDown();
            
      });

      $('#addCard').on('click',function(){
            var paymentForm = $('#paymentForm');
              header = paymentForm.find('#header');
                  headerHtml = $('<h3 class="fs-header">Add <span class="fs-strong">Card</span></h3>');

              $('#saveCard').text('Add Card');


              if(!header.find('.fs-header').length){
                header.append(headerHtml);
              }else{
                header.find('.fs-header').detach();
                header.append(headerHtml);
            }

            $('.form-container').slideDown();
      });


        $('#saveCard').on('click',function(){
            $('.form-container').slideUp();
        });

            $('#checkoutBtn').on('click',function(){

      valid=true;

      payName = $('#payName').val();
      payCardType = $('#payCardType').val();
      payCCNum = $('#payCCNum').val();
      payCardMonth = $('#payCardMonth').val();
      payCardYear = $('#payCardYear').val();
      payCSC = $('#payCSC').val();
      // yesPrimary = $('#yesPrimary').val();
      // noPrimary = $('#noPrimary').val();
      payAdd1 = $('#payAdd1').val();
      //payAdd2 = $('#payAdd2').val();
      payState = $('#payState').val();
      payCity = $('#payCity').val();
      payZip = $('#payZip').val();


      if(payName == ''){
        $('#payName').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payCardType == ''){
        $('#payCardType').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payCCNum == ''){
        $('#payCCNum').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payCardMonth == ''){
        $('#payCardMonth').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payCardYear == ''){
        $('#payCardYear').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payCSC == ''){
        $('#payCSC').closest('.form-group').addClass('has-error');
        valid=false;
      }
      // if(yesPrimary == ''){
      //   $('#yesPrimary').closest('.form-group').addClass('has-error');
      //   valid=false;
      // }
      // if(noPrimary == ''){
      //   $('#noPrimary').closest('.form-group').addClass('has-error');
      //   valid=false;
      // }
      if(payAdd1 == ''){
        $('#payAdd1').closest('.form-group').addClass('has-error');
        valid=false;
      }
      // if(payAdd2 == ''){
      //   $('#payAdd2').closest('.form-group').addClass('has-error');
      //   valid=false;
      // }
      if(payState == ''){
        $('#payState').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payCity == ''){
        $('#payCity').closest('.form-group').addClass('has-error');
        valid=false;
      }
      if(payZip == ''){
        $('#payZip').closest('.form-group').addClass('has-error');
        valid=false;
      }

      if(valid){
         document.paymentForm.submit();
      }else{
         $('<div class="row alert alert-dismissible" style="margin-top:20px;"><div class="col-md-10 col-md-offset-1"><div class="alert alert-danger alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong>Some of the fields are empty!</strong></div></div></div>').insertBefore('#paymentForm');
         $('#paymentForm').focus();
      }
});
      
    </script>
  </body>

  <style type="text/css">
    

  </style>
</html>
