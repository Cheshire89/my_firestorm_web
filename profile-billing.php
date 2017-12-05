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
    $name = ucfirst($profInfo["fName"]).' '.ucfirst($profInfo["lName"]);
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

    <title>Referals</title>

    
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
                  <li><a href="/" title="">Profile</a></li>
                  <li><a href="profile-edit.php" title="">Edit Profile</a></li>
                  <li  class="active"><a href="profile-billing.php" title="">Billing</a></li>
                  <li><a href="profile-referals.php" title="">Referals</a></li>
                </ul>
              </div>
          </nav>
        </div>

    <div class="container table-container bb-2">
        <div class="row">
            <div class="table-responsive">
            <table class="table table-striped fs-table">
                <thead>
                  <tr>
                    <th><span class="hidden">Select</span></th>
                    <th>Payment Card</th>
                    <th>Exparation</th>
                    <th>M | Q | A</th>
                    <th>Next Payment</th>
                    <th class="text-center">Primary</th>
                    <th><span class="hidden">Edit</span></th>
                  </tr>
                </thead> 
                <tbody>
                  <tr >
                    <!--  Note for the checkbox to work the checkbox "id" and label "for"  must match  -->
                   <td class="table-checkbox">
                        <input type="checkbox" name="select-row" id="id123">
                        <label for="id123">
                        </label>
                    </td>
                    <td><span><i class="fa fa-cc-visa" aria-hidden="true"></i> ...1934</span></td>
                    <td><?php echo date('m / y'); ?></td>
                    <td>Quarterly</td>
                    <td><?php echo date('m / d / y'); ?></td>
                    <td class="primary text-center"></td>
                    <td><button type="button" class="btn fs-btn-orange btn-sm pull-right edit-payment">Edit</button></td>   
                  </tr>
                  <tr>
                    <td>
                        <input type="checkbox" name="select-row" id="id456">
                        <label for="id456">
                        </label>
                    </td>
                    <td><span><i class="fa fa-cc-mastercard" aria-hidden="true"></i> ...1934</span></td>
                    <td><?php echo date('m / y'); ?></td>
                    <td>Annually</td>
                    <td><?php echo date('m / d / y'); ?></td>
                    <td class="primary text-center"><i class="fa fa-check-circle" aria-hidden="true"></i></td>
                    <td><button type="button" class="btn fs-btn-orange btn-sm pull-right edit-payment">Edit</button></td>   
                  </tr>
                  
                </tbody> 
             </table>
             </div>
        </div>
        <div class="row">
          <div class="btn-group pull-right">
            <button type="button" class="btn fs-btn-orange btn-md" id="removeSelected">Remove Selected</button>
            <button type="button" class="btn fs-btn-orange btn-md" id="addCard">Add Card</button>
          </div>
        </div>
    </div>
    <div class="container on-page-menu offset-menu form-container" style="text-align:center;">
      
         <form class="form-horizontal fs-form-gen col-md-10 col-md-offset-1" action="" method="POST" id="paymentForm">
           <div class="form-group text-left">
              <div class="col-md-12" id="header">
                
              </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                      <div class="col-xs-12">
                           <input type="text" class="form-control" id="payName" name="payName" placeholder="Name on the card">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-xs-12">
                      <select class="form-control" id="payCardType" name="payCardType">
                        <option>Card Type</option>
                        <option>Visa</option>
                        <option>Mastercard</option>
                        <option>American Express</option>
                        <option>Discover</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="col-xs-12">
                           <input type="text" class="form-control" id="payCCNum" name="payCCNum" placeholder="Credit Card Number">
                      </div>
                  </div>
                   <div class="form-group">
                      <div class="col-sm-8">
                          <div class="row">
                              <div class="col-xs-12">
                                <label>Exparation Date</label>
                             </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-7">
                                   <select class="form-control" id="payCardMonth" name="payCardMonth">
                                      <option>Jan</option>
                                      <option>Feb</option>
                                      <option>Mar</option>
                                      <option>Apr</option>
                                      <option>May</option>
                                    </select>
                              </div>
                              <div class="col-sm-5">
                                    <select class="form-control" id="payCardYear" name="payCardYear">
                                      <option>2021</option>
                                      <option>2020</option>
                                      <option>2019</option>
                                      <option>2018</option>
                                      <option>2017</option>
                                    </select>
                              </div>
                           </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="row">
                              <div class="col-sm-12">
                                  <label>CSC</label>
                              </div>
                              <div class="col-sm-12">
                                   <input type="text" class="form-control" id="payCSC" name="payCSC">
                              </div>
                           </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                    <label for="">Recurring Payment</label>
                      <select class="form-control" id="payCardMonth" name="payCardMonth">
                        <option>Monthly</option>
                        <option>Quarterly</option>
                        <option>Annually</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                       <label for="">Set This Card As Primary ?</label>
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
                      <input type="text" class="form-control" placeholder="Address Line 1" id="payAdd1" name="payAdd1">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-xs-12">  
                      <input type="text" class="form-control" placeholder="Address Line" id="payAdd2" name="payAdd2">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-xs-6 col-sm-6 col-md-12">
                      <select class="form-control" id="payState" name="payState">
                        <option>-State-</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="text" class="form-control" placeholder="Zip" id="payZip" name="payZip">
                    </div>
                  </div>
                  <div class="btn-group pull-right">
                    <button type="button" class="btn fs-btn-orange btn-md" id="saveCard">Save</button>
                    <button type="button" class="btn fs-btn-orange btn-md" id="editCardReset">Reset</button>
                  </div>
               </div>
            </div>
          </form>
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
      
    </script>
  </body>

  <style type="text/css">
    

  </style>
</html>
