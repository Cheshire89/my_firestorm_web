<?php 
  require_once('classes/config.php');
  $user = new Users();
  $info = $user->get_admin_prospect($_SESSION["prospectID"]);

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
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
    <div class="container-fluid hero-img" style="margin-top:-15px;">
      <div class="row slide">
         <img class="img-responsive center-block" src="img/slider/slide-1.png" style="width:100%; ">
      </div>
      <div class="row no-gutter slider-navigation header-text">
        <div class="container">
            <h1 class="fs-header-white text-left">Process <span class="fs-strong">Application</span></h1>
        </div>
      </div>
    </div>

    <div class="container on-page-menu offset-menu" style="margin-top:-40px;">
         <div class="col-md-10 col-md-offset-1" id="product">
            <div class="row">

               <?php
                  if(isset($_GET["fee"]) && $_GET["fee"] == 'failed'){
                      print('<h1 class="fs-header">Payment could not be processed</h1>');
                  }
               ?>
             
                 <div class="thumbnail product">
                    <div class="col-xs-10 text-center product-desc">
                       <h1 class="fs-header">Membership <span class="fs-strong">Application Fee</span></h1>
                       <h3 class="fs-header"><span class="fs-strong">$100</span></h3>
                    </div>
                    <div class="col-xs-2 text-center">
                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </div>
                 </div>
              
            </div>
         </div>
         
         <form class="form-horizontal fs-form-gen col-md-10 col-md-offset-1" action="payment/create-customer-profile.php" method="POST" id="paymentForm" name="paymentForm">
            <input type="hidden" name="payEmail" value="<?php print($info["email"]);?>">
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
                        <option value=""> Select </option>
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
                  <!--
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
                  -->
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
          </form>
          <div class="row">
              <div class="col-md-10 col-md-offset-1">
              <div class="panel panel-danger disclaimer">
                 <div class="panel-heading"><h4>You're Almost There! <i class="fa fa-exclamation-circle pull-right" aria-hidden="true"></i></h4></div>
                 <div class="panel-body">
                   <p>Thank you for answering all those questions! The last step is to pay your application fee. Once this is completed the chapter will receive your application and will be able to begin the process.</p>
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

    <script src="js/script.js"></script>
    <script type="text/javascript">
    <!--
    	$(document).ready(function() {

    $('input, select').on('change, focus, blur', function(){
      if($(this).val() != '' || $(this).text() != ''){
        $(this).closest('.form-group').removeClass('has-error');
        $(this).closest('.form-group').find('.help-bloc.error').detach();
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
      }else if(payCCNum.length > 16){
        $('#payCCNum').closest('.form-group').addClass('has-error');
        $('#payCCNum').closest('.form-group').prepend($('<p class="help-block error">Credit card number shuld be 16 characters long</p>'));
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

      $('#product').on('click',function(){
         $('#product, .disclaimer').fadeOut('fast',function(){
            $('#paymentForm').fadeIn('fast');
         });
      });

});
    </script>
  </body>

  <style type="text/css">
    .form-group.has-error .form-control{
      border-color: #BD2031;
      box-shadow: 0 2px 3px rgba(189, 32,49, 0.4);
    }

    .disclaimer{
      border-color: #d36a1d;
      border-radius: 0px;
    }
    .disclaimer .panel-heading{
      border-bottom: 1px solid #d36a1d;
      background-color: #d36a1d;
      color:white;
    }

    #paymentForm{
      display: none;
    }

    .product{
      color: #d36a1d;
      background-color: white;
      min-height: 250px;
      margin-top: 20px;
      border:2px solid #d36a1d;

    }
    .product > [class*='col-'], .product > [class*="col-"]{
      height: 250px;
    }
    .product .product-desc .fs-header:first-child{
      margin-top:75px;
    }
    .product .fa{
      font-size: 8em;
      line-height: 250px;
    }
    .alert{
      margin-bottom: 0px;
    }

  </style>
</html>
