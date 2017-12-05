<?php
 require_once('classes/config.php');
  $userSet = false;
    if(isset($_SESSION["email"]) && $_SESSION["email"] != ''){
       $userSet = true;
       $email = $_SESSION["email"];
    }
    if(isset($_GET["eventID"]) && $_GET["eventID"] != ''){
      $eventID = $_GET["eventID"];

      $events = new Events();
      $event = $events->getEvent($eventID);
      
      $chapters = new Chapters();
      $chapter = $chapters->getChapter($event["eventBy"]);
    
      if(!isset($chapter["chapterName"]) &&  $chapter["chapterName"] == ''){
          $chapter["chapterName"] = "Firestorm";
      }
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

    <title><?php print($event["eventTitle"]);?> | Checkout</title>

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
            <h1 class="fs-header-white text-left">Event<span class="fs-strong">Checkout</span></h1>
        </div>
      </div>
    </div>
    <div class="container on-page-menu offset-menu" style="margin-top:-50px;">
      <div class="center-block">
           <div class="table-responsive" style="margin-top: 25px; margin-bottom:35px;">
              <table class="table table-striped fs-table" style="margin-bottom:0px;">
                <thead>
                   <tr>
                     <th>Event Date</th>
                     <th>Event Title</th>
                     <th>Event By</th>
                     <th>Event Location</th>
                     <th>Event Price</th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                      <td><?php print($event["eventDateStart"]); ?></td>
                      <td class="title"><?php print($event["eventTitle"]);?></td>
                      <td><?php print($chapter["chapterName"]);?></td>
                      <td><?php print($event["addressFull"]);?></td>
                      <td><?php print($event["eventPrice"]);?></td>
                    </tr>
                </tbody>
              </table>
           </div>
      </div>
    </div>

    <?php
      if($userSet){
    ?>
    <div class="container table-container bb-2">
        <div class="row">
            <div class="table-responsive">
            <table class="table table-striped fs-table" id="paymentMethods">
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
                  <?php print($cards);?>
                </tbody> 
             </table>
             </div>
        </div>
        <div class="row">
          <div class="btn-group pull-right">
            <button type="button" class="btn fs-btn-orange btn-md" id="removeSelected">Use Selected</button>
            <button type="button" class="btn fs-btn-orange btn-md" id="addCard">Use Other</button>
          </div>
        </div>
    </div>
    <?php
      }
    ?>
  
   <div class="container on-page-menu offset-menu" id="paymentFormContainer">
    <div class="row">
    <form class="form-horizontal fs-form-gen col-md-10 col-md-offset-1" action="payment/charge_event_credit_card.php" method="POST" id="paymentForm" name="paymentForm">
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
                           <label for="payCCNum">Credit Card Number</label>
                           <input type="text" class="form-control" id="payCCNum" name="payCCNum" placeholder="Ex: XXXX-XXXX-XXXX-1234">
                      </div>
                  </div>
                   <div class="form-group">
                      <div class="col-sm-8">
                          <div class="row">
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
                          <div class="row">
                              <div class="col-xs-12">
                                  <label for="payCSC" >CSC | CVV</label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-xs-12">
                                   <input type="text" class="form-control" id="payCSC" name="payCSC">
                              </div>
                           </div>
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
                      <label for="payEmail">Email</label>  
                      <input type="text" class="form-control" id="payEmail" name="payEmail" value="<?php print($email);?>">
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
                  
               </div>
               <div class="form-group">
                 <div class="col-xs-12">
                 <div class="btn-group pull-right">
                    <button type="button" class="btn fs-btn-orange btn-md" id="checkoutBtn">Process Payment <i class="fa fa-check" aria-hidden="true"></i></button>
                  </div>
                  </div>
               </div>
            </div>

            <input type="hidden" name="eventDate" id="eventDate" value="<?php print($event["eventDateStart"]); ?>"/>
            <input type="hidden" name="eventTitle" id="eventTitle" value="<?php print($event["eventTitle"]);?>"/>
            <input type="hidden" name="eventBy" id="eventBy" value="<?php print($event["eventBy"]);?>"/>
            <input type="hidden" name="eventAddress" id="eventAddress" value="<?php print($event["addressFull"]);?>"/>
            <input type="hidden" name="eventPrice" id="eventPrice" value="<?php print($event["eventPrice"]);?>"/>
            <input type="hidden" name="eventID" id="eventID" value="<?php print($eventID);?>"/>
    </form>
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
$(document).ready(function() {
  
    $('#checkoutBtn').on('click',function(){

      valid=true;

      payName = $('#payName').val();
      payCardType = $('#payCardType').val();
      payCCNum = $('#payCCNum').val();
      payCardMonth = $('#payCardMonth').val();
      payCardYear = $('#payCardYear').val();
      payCSC = $('#payCSC').val();
      payAdd1 = $('#payAdd1').val();
      payState = $('#payState').val();
      payCity = $('#payCity').val();
      payZip = $('#payZip').val();
      payEmail = $('#payEmail').val();


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
      if(payAdd1 == ''){
        $('#payAdd1').closest('.form-group').addClass('has-error');
        valid=false;
      }
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

      if(payEmail == ''){
        $('#payEmail').closest('.form-group').addClass('has-error');
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
});

    </script>
   
  </body>
</html>
