<?php 
  require_once('classes/config.php');

  $checkUser = new User_Valid();
  if(!$checkUser->isLoggedIn()){
      header('Location: /');
      exit();
  }

  if(isset($_GET["user"]) && $_GET["user"]!=''){
    $userID = $_GET["user"];
    $user = new Users();
    $profInfo = $user->get_user_info($userID);
    $name = ucfirst($profInfo["fName"]).' '.ucfirst($profInfo["lName"]);
    $paymentInfo = new Payment($userID);
    $customerID = $paymentInfo->get_customer_id();
    $cards = $paymentInfo->payment_profiles_table_html();
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

    <title>Billing</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php echo date('U')?>" rel="stylesheet">
    <link href="styles/css/event.css?v=<?php echo date('U')?>" rel="stylesheet">
    <link href="styles/css/profile.css?v=<?php echo date('U')?>" rel="stylesheet">
    <style type="text/css">
        .modal-dialog{
            margin-top: 10%;
        }
    </style>
   
    
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
                  <li><a href="profile.php?user=<?php print($userID); ?>" title="">Profile</a></li>
                  <li><a href="profile-edit.php?user=<?php print($userID); ?>" title="">Edit Profile</a></li>
                  <li class="active"><a href="profile-billing.php?user=<?php print($userID); ?>" title="">Billing</a></li>
                  <li><a href="profile-referals.php?user=<?php print($userID); ?>" title="">Referals</a></li>
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
                    <th><span class="hidden">Select</span></th>
                    <th>Payment Card</th>
                    <th class="text-center">Card Type</th>
                    <th>M | Q | A</th>
                    <th class="text-center">Set as Primary</th>
                    <th class="text-center">Primary</th>
                    <th><span class="hidden">Edit</span></th>
                  </tr>
                </thead> 
                <tbody>
                  <?php print($cards);?>
                </tbody> 
             </table>
             </div>
             
        </div>
            <div class="row">
                <div class="col-xs-12">
                    <p class="help-block pull-right text-right">&ast;&ast;Subscription is based on annual term.</p>
                </div>
             </div>
        <div class="row">
          <div class="col-md-6">
             <a href="payment-history.php?userID=<?php print($userID);?>" style="margin-bottom:8px;"><h4 class="fs-header">Payment <strong>History</strong> <i class="fa fa-eye" aria-hidden="true"></i></h4></a>
          </div>
          <div class="col-md-6">
            <div class="btn-group pull-right">
              <button type="button" class="btn fs-btn-orange btn-md" id="removeSelected">Remove Selected</button>
              <button type="button" class="btn fs-btn-orange btn-md" id="assignSubscription">Assign Subscription</button>
              <button type="button" class="btn fs-btn-orange btn-md" id="addCard">Add Card</button>
            </div>
          </div>
        </div>
    </div>
  
<div class="container on-page-menu offset-menu" style="margin-top:-40px;">
  <div class="row">
      <form class="form-horizontal fs-form-gen col-md-10 col-md-offset-1" action="../payment/create_customer_payment_profile.php" method="POST" id="paymentForm" name="paymentForm">
          <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                  <div class="col-xs-12">
                    <h3 class="fs-header">Card <span class="fs-strong">Information</span></h3>
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                         <label for="payName">Name on the card</label>
                         <input type="text" class="form-control" id="payName" name="payName" placeholder="Ex: John Smith">
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label for="payCardType">Subscription Type</label>
                    <select class="form-control" id="subscripInterval" name="subscripInterval">
                      <option value=""> </option>
                      <option value="month">Monthly</option>
                      <option value="quater">Quaterly</option>
                      <option value="annual">Annually</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                         <label for="payCCNum">Credit Card Number</label>
                         <input type="text" class="form-control" id="payCCNum" name="payCCNum" placeholder="Ex: XXXX-XXXX-XXXX-1234">
                    </div>
                </div>
                  <div class="row">
                      <div class="col-sm-8">
                          <div class="form-group">
                              <div class="col-xs-12">
                                <label>Credit Card Exparation</label>
                             </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-7">
                                <div class="form-group">
                                   <div class="col-xs-12">
                                   <select class="form-control" id="payCardMonth" name="payCardMonth">
                                      <option value="">- Month -</option>
                                      <option value="01">January</option>
                                      <option value="02">February</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">June</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                    </select>
                                    </div>
                              </div>
                              </div>
                                    <?php 
                                      $maxYear = date('Y') + 20;
                                      $minYear = date('Y');
                                    ?>
                              <div class="col-sm-5">
                                 <div class="form-group">
                                   <div class="col-xs-12">
                                    <select class="form-control" id="payCardYear" name="payCardYear">
                                      <?php
                                        for($i=$maxYear; $i>=$minYear; $i--){
                                          if($i == intval(date('Y'))){
                                            print('<option selected=selected value="'.$i.'">'.$i.'</option>');  
                                          }else{
                                            print('<option value="'.$i.'">'.$i.'</option>');
                                          }
                                        }
                                      ?>
                                    </select>
                                  </div>
                                 </div>
                              </div>
                           </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                              <div class="col-xs-12">
                                  <label>CSC | CVV</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-xs-12">
                                   <input type="text" class="form-control" id="payCSC" name="payCSC">
                              </div>
                           </div>
                      </div>
                  </div>
                <div class="form-group">
                  <div class="col-sm-6">
                     <label for="">Set This Card As Primary for Future Payments?</label>
                  </div>
                  <div class="col-sm-6 radio-btns">
                      <input type="radio" name="radioPrimary" id="yesPrimary">
                      <label class="radio-inline" for="yesPrimary">Yes</label>
                      <input type="radio" name="radioPrimary" id="noPrimary" checked>
                      <label class="radio-inline" for="noPrimary">No</label>
                  </div>
                </div>
             </div>
             <div class="col-md-6">
                <div class="form-group">
                  <div class="col-xs-12">
                  <h3 class="fs-header">Billing <span class="fs-strong">Information</span></h3>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <label for="payAdd1">Billing Address</label>  
                    <input type="text" class="form-control" id="payAdd1" name="payAdd1">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12"> 
                    <label for="payAdd2">Billing Address Continued</label> 
                    <input type="text" class="form-control" id="payAdd2" name="payAdd2">
                  </div>
                </div>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-4">
                      <div class="form-group">
                        <div class="col-xs-12">
                        <label for="payState">State</label> 
                        <select class="form-control" id="payState" name="payState">
                          <option value=""> </option>
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
                      </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-4">
                       <div class="form-group">
                        <div class="col-xs-12">
                        <label for="payCity">City</label> 
                        <input type="text" class="form-control" id="payCity" name="payCity">
                          </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-4">
                        <div class="form-group">
                          <div class="col-xs-12">
                        <label for="payZip">Zip</label> 
                        <input type="text" class="form-control" id="payZip" name="payZip">
                          </div>
                        </div>
                    </div>
                  </div>
                <div class="btn-group pull-right">
                  <button type="button" class="btn fs-btn-orange btn-md" id="checkoutBtn">Process Payment <i class="fa fa-check" aria-hidden="true"></i></button>
                </div>
             </div>
          </div>
            <input type="hidden" name="payEmail" value="<?php print($info["email"]);?>">
            <input type="hidden" name="customerID" id="customerID" value="<?php print($customerID) ?>"/>
            <input type="hidden" name="userID" id="userID" value="<?php print($userID) ?>"/>
            <input type="hidden" name="subscriptionID" id="subscriptionID" value="<?php print($subscriptionID) ;?>" />
      </form>
  </div>
</div>

    <div class="fs-modal modal fade" id="deleteWarning" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title fs-header"><strong>Deleting Primary Payment</strong></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="fs-header">Notice !</h3>
                    <p id="cancelText">&quot;Upon cancelling you will be charged remaining balance of <span id="totalDue"></span>&quot;</p>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="btn-group">
                <button type="button" class="btn fs-btn-orange btn-danger" id="deleteCard" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Delete</button>
                <button type="button" class="btn fs-btn-orange btn-success" id="close" data-dismiss="modal"><i class="fa fa-check" aria-hidden="true"></i> Close</button>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    
    <!--<button type="button" class="fs-btn-orange btn-sm  delete-payment" data-target="#deleteWarning" data-toggle="modal" data-id="2">Btn</button>-->

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
      $('.delete-payment').on('click', function(){
        payID = $(this).attr('data-id');
        $('#deleteCard').attr('data-id', payID);
        $.post('calcRemainingBalance.php',{
            payId: payID,
            userID: <?php print($userID); ?>
            },function(data){
            if(data != 'None'){
                $('#totalDue').text('$'+data);
            }else{
                $('#cancelText').text('Are you sure your would like to cancel your subscription ?');
            }
        });
        
      });
    
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
      
      $('#deleteCard').click(function() {
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
