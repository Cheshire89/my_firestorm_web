<?php
require_once('classes/config.php');
  
  $userCl = new Users();
  if(isset($_SESSION['userID']) && $_SESSION['userID'] != ''){
      $userID = $_SESSION["userID"];
      $profInfo = $userCl->get_user_info($userID);

      if(isset($_GET["subscription"]) && $_GET["subscription"] = 'success'){
        header('Location: /member_admin');
        exit();
      }
      
      $name = ucfirst($profInfo["fName"]).' '.ucfirst($profInfo["lName"]);
      $paymentInfo = new Payment($userID);
      $customerID = $paymentInfo->get_customer_id();
            
          if($customerID != 0){
              $cards = $paymentInfo->payment_profiles_table_html();
              $subscriptionID = $paymentInfo->getSubscriptionID($userID);
          }
  }else if(isset($_GET['userID']) && $_GET['userID'] != ''){
      header('Location: sign-login.php?membership=subscription');
      exit();  
  }else{
      header('Location: new-account.php');
      exit();
  }
      $customerID = $profInfo["customerID"];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Join Firestorm | Payment</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/486ff18bfe.css" media="all">
    <!-- Custom styles -->

    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
   
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      #useSelected{
         display: none;
      }
    </style>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="img/slider/slide-1.png" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left">Membership <span class="fs-strong">Dues</span></h1>

        </div>
      </div>
    </div>

    <div class="container on-page-menu offset-menu" style="margin-top:-40px;">
         <div class="col-md-10 col-md-offset-1 text-center" style="margin-top: 30px;">
           <h3 class="fs-header">Select <span class="fs-strong">Subscription</span></h3>
         </div>
         <div class="col-md-10 col-md-offset-1 text-center" id="products">
            <div class="row">
                
                <div class="col-md-4 selected" data-id="month">
                  <div class="thumbnail text-center">
                    <div class="caption">
                      <h1 class="fs-header">Monthly</h1>
                      <p class="h3 fs-header-black price">$65</p>
                      <p class="fs-header-black price">&nbsp;</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-4" data-id="quater">
                  <div class="thumbnail text-center">
                    <div class="caption">
                      <h1 class="fs-header">Quaterly</h1>
                      <p class="h3 fs-header-black price">$180</p>
                      <p class="fs-header-black price"><span class="save">(Save $60 annually)</span></p>
                    </div>
                  </div>
                </div>

                 <div class="col-md-4" data-id="annual">
                  <div class="thumbnail text-center">
                    <div class="caption">
                      <h1 class="fs-header">Annually</h1>
                      <p class="h3 fs-header-black price">$650</p>
                      <p class="fs-header-black price"><span class="save">(Save $130 annually)</span></p>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <p class="memo">Subscription is based on annual term. *</p>
            </div>
         </div>

        <?php if($cards != ''){
        print('<div class="col-md-10 col-md-offset-1" id="cardsOnFile">
            <div class="table-responsive">
            <table class="table table-striped fs-table">
                <thead>
                  <tr>
                    <th><span class="hidden">Select</span></th>
                    <th>Payment Card</th>
                    <th>Card Type</th>
                    <th>M | Q | A</th>
                    <th>Next Payment</th>
                    <th class="text-center">Primary</th>
                    <th><span class="hidden">Edit</span></th>
                  </tr>
                </thead> 
                <tbody>
                   '.$cards.'
                </tbody> 
             </table>
             </div>
        </div>');
        }?>

        <form class="hidden" action="payment/create-subscription-from-customer-profile.php" name="chargePaymentProfile" id="chargePaymentProfile" method="POST">
          <input type="hidden" name="payProf" id="payProf" value="">
          <input type="hidden" name="payRepeat" id="payRepeat" value="month">
          <input type="hidden" name="custProf" id="custProf" value="<?php print($customerID);?>">
        </form>

        <div class="col-md-10 col-md-offset-1" style="margin-bottom:40px;">
          <div class="btn-group pull-right">
            <?php if($customerID != 0){?>
            <button type="button" class="btn fs-btn-orange btn-md" id="useSelected">Checkout</button>
            <?php } ?>
            <button type="button" class="btn fs-btn-orange btn-md" id="addCard">Add Card</button>
          </div>
        </div>
    
         
         <form class="form-horizontal fs-form-gen col-md-10 col-md-offset-1" action="payment/create-subscription.php" method="POST" id="paymentForm" name="paymentForm">
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
                      <label for="payCardType">Card Type</label>
                      <select class="form-control" id="payCardType" name="payCardType">
                        <option value=""> </option>
                        <option value="visa">Visa</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="amex">American Express</option>
                        <option value="discover">Discover</option>
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
                                      <option value="1">January</option>
                                      <option value="2">February</option>
                                      <option value="3">March</option>
                                      <option value="4">April</option>
                                      <option value="5">May</option>
                                      <option value="6">June</option>
                                      <option value="7">July</option>
                                      <option value="8">August</option>
                                      <option value="9">September</option>
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
                  <!-- <div class="form-group">
                    <div class="col-sm-6">
                       <label for="">Set This Card As Primary for Future Payments?</label>
                    </div>
                    <div class="col-sm-6 radio-btns">
                        <input type="radio" name="setDefault" id="yesPrimary" value="yes">
                        <label class="radio-inline" for="yesPrimary">Yes</label>
                        <input type="radio" name="setDefault" id="noPrimary" value="no" checked>
                        <label class="radio-inline" for="noPrimary">No</label>
                    </div>
                  </div> -->
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
                        <label for="payZip">City</label> 
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
                    <button type="button" class="btn fs-btn-orange btn-md" id="checkoutBtn">Save Card <i class="fa fa-check" aria-hidden="true"></i></button>
                  </div>
               </div>
            </div>
            <input type="hidden" name="subscripInterval" id="subscripInterval" value="month"/>
          </form>
    </div>
    

    <?php require_once('php/footer.php') ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Optional -->
    <!-- jQuery Ui -->

    <script src="js/script.js"></script>
    <script type="text/javascript">
    <!--
$(document).ready(function() {
    $('.delete-payment').on('click',function(){
        numRows = $('#cardsOnFile tbody tr').length;
        warning = $('<div class="alert alert-danger alert-dismissible" role="alert">'+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
          '<strong>Card can not be deleted unless there is other card on file</strong></div>');
        if(numRows <= 1){
          $('#cardsOnFile').prepend(warning);
        }else{
          $(this).parents('tr').detach();
        }
    });

    $('#cardsOnFile td.table-checkbox input').on('change',function(){
        $('#useSelected').fadeIn();
    });

    $("#useSelected").on('click',function(){
       $('#cardsOnFile td.table-checkbox input').each(function(){
           if($(this).is(':checked')){
              $paymentMethod = $(this).attr('id');
              $('#payProf').val($paymentMethod);

              document.chargePaymentProfile.submit();
           }
       });
    });

    $('#addCard').on('click',function(){
    var speed = 1000;
      $('#paymentForm').fadeIn(function(){
            $('html, body').animate({
                      scrollTop: $('#paymentForm').offset().top
                   }, speed);
            });
      });

    $('input, select').on('change, focus, blur', function(){
      if($(this).val() != '' || $(this).text() != ''){
        $(this).closest('.form-group').removeClass('has-error');
      }
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

      $('body').on('click','.close',function(){
        $('.row.alert').detach();
      });

      $("#products > .row >[class*='col-'], #products > .row >[class*='col-']").on('click',function(){
        
        $("#products > .row >[class*='col-'], #products > .row >[class*='col-']").each(function(){
          $(this).removeClass('selected');
        });

         $(this).addClass('selected');
         $('#subscripInterval').val($(this).attr('data-id'));
         $('#payRepeat').val($(this).attr('data-id'));
      });

});
    </script>
  </body>

  <style type="text/css">
    .form-group.has-error .form-control{
      border-color: #BD2031;
      box-shadow: 0 2px 3px rgba(189, 32,49, 0.4);
    }
    
    #paymentForm{
      display: none;
    }

.primary i{

    font-size:1.5em;
    color:green;
}

    #products > .row >[class*='col-']:not(.selected):hover
    , #products > .row >[class*='col-']:not(.selected):hover{
      padding-top:20px;
      padding-bottom: 20px;
      background-color: #bc4a37;
      border:0px;
      border-color: transparent;
      height: 100%;
    }

    #products > .row >[class*='col-']:not(.selected):hover .thumbnail
    , #products > .row >[class*='col-']:not(.selected):hover .thumbnail{
      background-color: #bc4a37;
      border-color: transparent;
    }

    #products > .row >[class*='col-']:not(.selected):hover .thumbnail .fs-header
    , #products > .row >[class*='col-']:not(.selected):hover .thumbnail .fs-header{
      font-weight: 700;
      color:white;
    }

    #products > .row >[class*='col-']:not(.selected):hover .thumbnail .fs-header-black
    , #products > .row >[class*='col-']:not(.selected):hover .thumbnail .fs-header-black{
      color:white;
    }

    #products > .row >[class*='col-']:not(.selected)
    , #products > .row >[class*='col-']:not(.selected){
      height: 100%;
      padding-top:20px;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }

    #products > .row >[class*='col-'] .thumbnail, #products > .row >[class*='col-'] .thumbnail{
      border: 1px solid #d36a1d;
      border-radius: 0px;
    }

    #products{
      margin-top: 25px;
      margin-bottom: 25px;
      min-height: 200px;
    }

    #products .thumbnail{
      margin-bottom: 0px;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }

    #products .selected{
      padding-top:20px;
      padding-bottom: 20px;
    }

    #products .selected .thumbnail{
      border:0px;
    }

    #products .selected, #products .selected .thumbnail{
      background-color: #d36a1d;
      border:0px;
      border-color: transparent;
      height: 100%;
    }

    #products .selected .thumbnail .fs-header{
      font-weight: 700;
      color:white;
    }

    #products .selected .thumbnail .fs-header-black{
      color:white;
    }

    .alert{
      margin-bottom: 0px;
    }

    .memo{
      font-size: 10px;
      color:#CC0000;
    }
    .alert{
      margin-bottom: 15px;
    }
  </style>
</html>
