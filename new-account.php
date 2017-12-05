<?php 
    require_once('classes/config.php');
    $chapters = new Chapters();
    $chaptersOption = $chapters->printChaptersOption('');
    $users = new Users();
    
    $ind = new Industry();
    $industryList = $ind->html_options_list();
    
    $membershipAgreement = new membership_agreement();

    if(isset($_SESSION["prospectID"]) && $_SESSION["prospectID"] != ''){
        $prospectID = $_SESSION["prospectID"];
        $pr = $users->get_admin_prospect($prospectID);
        $chaptersOption = $chapters->printChaptersOption($pr["groups"]);
        $prExist = true;

        if(isset($pr['prospectID']) && $pr['archived'] == 'no' && $pr['fsAplAgreement'] == '1'){
            header('Location: thank-you.php?waiting=approval');
            exit();
        }
    }else{
      $prExist = false;
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
    <title>Join Firestorm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->
    <link href="styles/css/styles.css?v=<?php date('U')?>" rel="stylesheet">
    <link href="styles/css/log-in.css?v=<?php date('U')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
        .fs-form-gen .alert.alert-danger{
           color:#CC0000;
           border-radius: 0px;
           border: 1px solid #CC0000;
        }
        .fs-form-gen .alert.alert-danger .close{
          opacity: 0.9;
          color:#CC0000;
        }
        .fs-form-gen .alert.alert-danger .close span{
          font-size: 1.5em;
          font-weight: bold;
        }
        .fs-form-gen .has-error .form-control{
          border: 1px solid #CC0000;
          -webkit-box-shadow: 0px 8px 10px -8px rgba(204,0,0,0.59);
          -moz-box-shadow: 0px 8px 10px -8px rgba(204,0,0,0.59);
          box-shadow: 0px 8px 10px -8px rgba(204,0,0,0.59);
        }
        #coverPic label, #compLogoPic label, #profilePic label{
            display: block;
            font-size: 2em;
        }

        #coverPic label i, #compLogoPic label i, #profilePic label i{
            font-size: 2.5em;
        }

        #coverPic input, #compLogoPic input, #profilePic input{
            display: none;
        }
        <?php 
          if($pr["profPic"] == ''){
              print('#profilePic img{display: none;}');
          }
        ?>

        <?php 
          if($pr["compLogo"] == ''){
              print('#compLogoPic img{display: none;}');
          }
        ?>

        <?php 
          if($pr["covPic"] == ''){
              print('#coverPic img{display: none;}');
          }
        ?>            

        #coverPic .help-block, #compLogoPic .help-block, #profPic .help-block{
            display: block;
        }

        .preview{
           width: 45%;
           height: auto;
           object-fit:cover;
           object-position: center;
           float: right;
        }

        @media (max-width: 990px){
          float:none;
          display:block;
          margin-left:auto;
          margin-right:auto;
        }

        .row.controls{
          margin-bottom: 25px;
        }

        .row.controls .center-block{
          float: none;
        }
        <?php 
        
        $pr["prospectFormPage"] = intval($pr["prospectFormPage"]);
        
        if(!$prExist){
          print('#fsAgreement, #fsApplication, #businessInfo, #personalInfo{
            display: none;
          }');
        }else{
          switch ($pr["prospectFormPage"]) {
            case 1:
              print('#businessInfo, #fsApplication ,#fsAgreement {
            display: none;
          }');
              break;

            case 2:
              print('#personalInfo, #fsApplication ,#fsAgreement {
            display: none;
          }');
              break;

            case 3:
              print('#personalInfo, #businessInfo ,#fsAgreement{
            display: none;
          }');
              break;

            case 4:
              print('#personalInfo,  #businessInfo, #fsApplication {
            display: none;
          }');
              break;

          }
          
        }
        ?> 
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
            <h1 class="fs-header-white text-left">New<span class="fs-strong">Account</span></h1>
        </div>
      </div>
    </div>
    <div class="container on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                <li><a href="sign-login.php" title="">Log In</a></li>
                <li class="active"><a href="new-account.php" title="">New Account</a></li>
                <li><a href="reset-password.php" title="">Reset Password</a></li>
            </ul>
          </div>
      </nav>
    </div>
    <?php 
      if(!$prExist){
    ?>
    <div class="container on-page-menu offset-menu" id="signUp" data-form="1">
      
         <form class="form-horizontal fs-form-gen col-md-8 col-md-offset-2" action="saveProspect.php" id="signUpForm" name="signUpForm" method="POST">
           <div class="form-group text-left">
            <div class="col-md-12">
              <h3 class="fs-header">Sign <span class="fs-strong">Up</span></h3>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-xs-6 col-md-6">
              <div class="form-group">
                  <div class="col-xs-12">
                     <label for="email">Email *</label>
                     <input type="email" class="form-control" id="email" name="email" placeholder="Ex: john.smith@abc.com" value="<?php print($pr["email"]); ?>">
                  </div>
              </div> 
              <div class="form-group">
               <div class="col-xs-12">
                  <label for="confEmail">Confirm Email *</label>
                  <input type="email" class="form-control" id="confEmail" name="confEmail" placeholder="Ex: john.smith@abc.com" value="<?php print($pr["email"]); ?>">
                </div>
              </div>
            </div>
          
            <div class="col-xs-6 col-md-6">

                <div class="form-group">
                  <div class="col-xs-12">
                    <label for="password">Password *</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
               </div>              
                <div class="form-group">
                  <div class="col-xs-12">
                    <label for="confPassword">Confirm Password *</label>
                    <input type="password" class="form-control" id="confPassword" name="confPassword">
                  </div>
              </div>              
            </div>
            
            <input type="hidden" name="prospectFormPage" value="1">
          </form>
          <div class="row controls">
            <div class="col-md-8 center-block">
              
              <button type="button" class="btn btn-default fs-btn-orange pull-right nextSignUp" >Next <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
          </div>
    </div>
    </div>

    <?php
    }
    ?>

    <div class="container on-page-menu offset-menu" id="personalInfo" data-form="2">
        <form class="form-horizontal fs-form-gen col-md-8 col-md-offset-2" action="saveProspectPiece.php" enctype="multipart/form-data" name="personalInfo"  method="POST">
        <div class="form-group text-left">
          <div class="col-md-12">
            <h3 class="fs-header">Personal <span class="fs-strong">Information</span></h3>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12"> 
                <label for="groups">Chapter Applying To *</label>
                <select class="form-control" id="groups" name="groups">
                   <option vlue="">- select -</option>
                   <?php 
                      print($chaptersOption);
                   ?>
                </select>
              </div>
            </div>
          </div>
          
          <?php if(!$pr["industry"]) { 
              $other = 'style="display: none;"';
          ?>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="industry">In What Industry Do You Currently Work? *</label>
                <select class="form-control" id="industry" name="industry">
                  <option value="">- select -</option>
                   <?php print($industryList);?>
                  <option value="Other">Other (please specify)</option>
                </select>
               
              </div>
            </div>
          </div>
          <div class="col-md-6" <?php print($other);?> id="industryOtherContainer">
              <div class="form-group">
                 <div class="col-xs-12">
                    <label for="industry">Industry *</label>
                    <input type="text" class="form-control" name="industryOther" id="industryOther"  value="<?php print($pr["industry"]);?>" />
                 </div>
              </div>
          </div>
          <?php }else{ 
              $other = '';
          ?>
          <div class="col-md-6" <?php print($other);?> id="industryOtherContainer">
              <div class="form-group">
                 <div class="col-xs-12">
                    <label for="industry">Industry *</label>
                    <input type="text" class="form-control" name="industryOther" id="industryOther"  value="<?php print($pr["industry"]);?>" />
                 </div>
              </div>
          </div>
          <?php } ?>

          
        </div>

        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="fName">First Name *</label>
                  <input type="text" class="form-control no-margin" id="fName" name="fName" value="<?php print($pr["fName"]);?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="lName">Last Name *</label>
                  <input type="text" class="form-control no-margin" id="lName" name="lName" value="<?php print($pr["lName"]);?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <label for="bio">Brief Bio *</label>
            <textarea class="form-control" id="bio" name="bio"><?php print($pr["bio"]);?></textarea>
          </div>
        </div>

        <!-- <div class="form-group">
          <div class="col-md-12">
            <textarea class="form-control no-margin" id="bio" name="bio">Bio *</textarea>
          </div>
        </div> -->

        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="jTitle">Job Title *</label>
                  <input type="text" class="form-control no-margin" id="jTitle" name="jTitle" value="<?php print($pr["jTitle"]);?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="">Linked In Profile *</label>
                  <input type="text" class="form-control no-margin" id="linkedInLink" name="linkedInLink" placeholder="Ex: https://www.linkedin.com/in/john-smith-aabbcc66/" value="<?php print($pr["linkedInLink"]);?>">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group text-left">
          <div class="col-md-12">
            <h3 class="fs-header">Profile <span class="fs-strong">Picture</span></h3>
          </div>
        </div>

        <div class="form-group" id="profilePic">
            <div class="col-md-12">
              <label for="profPic">
                <i class="fa fa-user-circle" aria-hidden="true"></i> Upload Profile Picture
                <p class="help-block" style="font-size: 12px;">Only File Types Accepted: JPEG, JPG, GIF, PNG</p>
              </label>
              <img src="<?php print($pr["profPic"]);?>" class="img-responsive preview" alt="Logo Preview">
                <input type="file" id="profPic" name="profPic">
                
            </div>
        </div>

        <div class="form-group text-left">
          <div class="col-md-12">
            <h3 class="fs-header">Cover <span class="fs-strong">Picture</span></h3>
          </div>
        </div>

        <div class="form-group" id="coverPic">
            <div class="col-md-12">
              <label for="covPic">
                <i class="fa fa-picture-o" aria-hidden="true"></i> Upload Cover Picture
                <p class="help-block" style="font-size: 12px;">Only File Types Accepted: JPEG, JPG, GIF, PNG</p>
              </label>
              <img src="<?php print($pr["covPic"]);?>" class="img-responsive preview" alt="Logo Preview">
              <input type="file" id="covPic" name="covPic">
            </div>
        </div>
          <input type="hidden" name="prospectFormPage" value="2">
        </form>
        <div class="row controls">
            <div class="col-md-8 center-block">
              <?php if(!$prExist){ ?>
              <button type="button" class="btn btn-default fs-btn-orange pull-left prevSignUp"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</button>
              <?php } ?>
              <button type="button" class="btn btn-default fs-btn-orange pull-right nextSignUp" >Next  <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
          </div>
    </div>

    <div class="container on-page-menu offset-menu" id="businessInfo" data-form="3">
        <form class="form-horizontal fs-form-gen col-md-8 col-md-offset-2" action="saveProspect.php" name="businessInfo" method="POST">

        <div class="form-group text-left">
          <div class="col-md-12">
            <h3 class="fs-header">Business <span class="fs-strong">Information</span></h3>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
          <label for="compName">Company Name *</label>
          <input type="text" class="form-control no-margin" id="compName" name="compName" value="<?php print($pr["compName"]);?>">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
          <label for="compName">Position in Company *</label>
          <input type="text" class="form-control no-margin" id="compPos" name="compPos" value="<?php print($pr["compPos"]);?>">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compAddOne">Address Line 1 *</label>
                <input type="text" class="form-control no-margin" id="compAddOne" name="compAddOne" value="<?php print($pr["compAddOne"]);?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compAddTwo">Address Line 2</label>
                <input type="text" class="form-control no-margin" id="compAddTwo" name="compAddTwo" value="<?php print($pr["compAddTwo"]);?>">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compCity">City *</label>
                <input type="text" class="form-control" id="compCity" name="compCity" value="<?php print($pr["compCity"]);?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="compState">State *</label>
                    <select class="form-control" id="compState" name="compState">
                    <option value="">- select -</option>
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
              </div>
              
        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compZip">Zip *</label>
                  <input class="form-control" type="text" id="compZip" name="compZip" value="<?php print($pr["compZip"]);?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compPhone">Phone Number *</label>
                  <input class="form-control" type="text" id="compPhone" name="compPhone" value="<?php print($pr["compPhone"]);?>">
              </div>
            </div>
          </div>
        </div>
        <?php
            if($_SESSION["email"]){
               $compEmail = $_SESSION["email"];
            }
        ?>
        <div class="form-group">
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compEmail">Email Address</label>
                  <input class="form-control" type="email" id="compEmail" name="compEmail" placeholder="Ex: john.smith@abc.com" value="<?php print($compEmail); ?>">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="col-xs-12">
                <label for="compWeb">Website</label>
                  <input class="form-control" type="text" id="compWeb" name="compWeb" placeholder="Ex: http://www.domainname.com" value="<?php print($pr["compWeb"]);?>">
              </div>
            </div>
          </div>
        </div>

        <div class="form-group text-left" >
          <div class="col-md-12">
            <h3 class="fs-header">Company <span class="fs-strong">Logo</span></h3>
          </div>
        </div>
        

        <div class="form-group" id="compLogoPic">
            <div class="col-md-12">
              <label for="compLogo">
                <i class="fa fa-picture-o" aria-hidden="true"></i> Upload Logo
                <p class="help-block" style="font-size: 12px;">Only File Types Accepted: JPEG, JPG, GIF, PNG</p>
              </label>
              <img src="<?php print($pr["compLogo"]);?>" class="img-responsive preview center-block" alt="Logo Preview">
              <input type="file" id="compLogo" name="compLogo">
            </div>
        </div>
          <input type="hidden" name="prospectFormPage" value="3">
        </form>
        <div class="row controls">
            <div class="col-md-8 center-block">
              <button type="button" class="btn btn-default fs-btn-orange pull-left prevSignUp"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</button>
              <button type="button" class="btn btn-default fs-btn-orange pull-right nextSignUp" >Next  <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
          </div>
    </div>

    <div class="container on-page-menu offset-menu" id="fsApplication" data-form="4">
        <form class="form-horizontal fs-form-gen col-md-8 col-md-offset-2" action="saveProspect.php" name="fsApplication" method="POST">

        <div class="form-group text-left">
          <div class="col-md-12">
            <h3 class="fs-header">Firestorm <span class="fs-strong">Application</span></h3>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">Would you classify your business primarily as business-to-business (B2B), meaning you do business primarily with other businesses, or business-to-consumer (B2C), meaning you do business primarily with direct consumers? *
             </label>

              <select class="form-control" id="fsAplBussFocus" name="fsAplBussFocus">
                 <option value="">- select -</option>
                 <option value="Business to Business">Business to Business</option>
                 <option value="Business to Consumer">Business to Consumer</option>
              </select>


          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">What BEST describes your position in your business? *</label>
              <select class="form-control" id="fsAplBussPosition" name="fsAplBussPosition">
                 <option value="">- select -</option>
                 <option value="Solopreneur / Independent Contractor">Solopreneur / Independent Contractor</option>
                 <option value="Business Owner (1+ employees)">Business Owner (1+ employees)</option>
                 <option value="Executive/CEO">Executive/CEO</option>
                 <option value="Sales">Sales</option>
                 <option value="Admin">Admin</option>
                 <option value="Operations">Operations</option>
                 <option value="Manager">Manager</option>
                 <option value="Sales Manager">Sales Manager</option>
                 <option value="Other">Other</option>
              </select>
          </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>How beneficial is networking to your business? *</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class='vertical-align'>
                  <div class='btns' style="font-size: 10px;">
                    <label>
                      <input checked='' name='fsAplNetworkingBeneficial' type='radio' value="Very Unimportant">
                        <span class='btn first'>Very Unimportant</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingBeneficial' type='radio' value="Unimportant">
                        <span class='btn'>Unimportant</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingBeneficial' type='radio' value="Neutral">
                        <span class='btn'>Neutral</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingBeneficial' type='radio' value="Important">
                        <span class='btn'>Important</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingBeneficial' type='radio' value="Very Important">
                        <span class='btn last'>Very Important</span>
                      
                   </label>
                  </div>
                </div>
            </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">How long do you feel it should take for you to receive referrals/introductions from your group? *
             </label>
              <select class="form-control" id="fsAplReferralTurnarround" name="fsAplReferralTurnarround">
                 <option value="">- select -</option>
                 <option value="1 - 2 months">1 - 2 months</option>
                 <option value="3 - 4 months">3 - 4 months</option>
                 <option value="5 - 6 months">5 - 6 months</option>
                 <option value="7 - 8 months">7 - 8 months</option>
                 <option value="9 - 10 months">9 - 10 months</option>
                 <option value="11 - 12 months">11 - 12 months</option>
                 <option value="12+ months">12+ months</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">How many people does your company employ?</label>
              <select class="form-control" id="fsAplCompEmploy" name="fsAplCompEmploy">
                  <option value="">- select -</option>
                  <option value="0 - 5">0 - 5</option>
                  <option value="6 - 10">6 - 10</option>
                  <option value="11 - 20">11 - 20</option>
                  <option value="21 - 50">21 - 50</option>
                  <option value="51 - 100">51 - 100</option>
                  <option value="101 - 500">101 - 500</option>
                  <option value="501 - 1000">501 - 1000</option>
                  <option value="1000+">1000+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">How many years have you been in your industry? *</label>
              <select class="form-control long" id="fsAplYearsInIndustry" name="fsAplYearsInIndustry">
                 <option value="">- select -</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">How many years have you been working since finishing your initial high school/college education? *</label>
              <select class="form-control long" id="fsAplYearsSinceHsGraduation" name="fsAplYearsSinceHsGraduation">
                  <option value="">- select -</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">How many years of experience do you have with networking? *</label>
              <select class="form-control long" id="fsAplYearsOfNetworking" name="fsAplYearsOfNetworking">
                 <option value="">- select -</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>How much do you use Linkedin to assist with your networking? *</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class='vertical-align'>
                  <div class='btns'>
                    <label>
                      <input checked='' name="fsAplUseLinkedIn" type="radio" value="Dont Use Linkedin at All">
                        <span class="btn first">Dont Use Linkedin at All</span>
                      
                   </label>
                    <label>
                      <input name="fsAplUseLinkedIn" type="radio" value="Use Linkedin a Little">
                        <span class="btn">Use Linkedin a Little</span>
                      
                   </label>
                    <label>
                      <input name="fsAplUseLinkedIn" type="radio" value="Neutral"/>
                        <span class="btn">Neutral</span>
                      
                   </label>
                    <label>
                      <input name="fsAplUseLinkedIn" type="radio" value="Use Linkedin a Fair Amount">
                        <span class="btn">Use Linkedin a Fair Amount</span>
                      
                   </label>
                    <label>
                      <input name="fsAplUseLinkedIn" type="radio" value="Use Linkedin All The Time">
                        <span class="btn last">Use Linkedin All The Time</span>
                      
                   </label>
                  </div>
                </div>
            </div>
        </div>


        <div class="form-group">
          <div class="col-md-12">
              <label for="">How Neutral do you attend networking/social events? *</label>
              <select class="form-control" id="fsAplNetworkingAttendance" name="fsAplNetworkingAttendance">
                 <option value="">- select -</option>
                 <option value="Disagree">Disagree</option>
                 <option value="2+ times per week">2+ times per week</option>
                 <option value="Weekly">Weekly</option>
                 <option value="2-3 times per month">2-3 times per month</option>
                 <option value="Monthly">Monthly</option>
                 <option value="Quarterly">Quarterly</option>
                 <option value="2-3 times per year">2-3 times per year</option>
                 <option value="Other">Other</option>
              </select>
          </div>
        </div>


        <div class="form-group">
            <div class="col-md-12">
                <label>I am an active participant in my networking groups; e.g. I volunteer for more responsibility or take it upon myself to greet guests and help grow the group. *</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class='vertical-align'>
                  <div class='btns'>
                    <label>
                      <input checked='' name='fsAplNetworkingParticipation' type='radio' value="Disagree">
                        <span class='btn first'>Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingParticipation' type='radio' value="Strongly Disagree">
                        <span class='btn'>Strongly Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingParticipation' type='radio' value="Neutral">
                        <span class='btn'>Neutral</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingParticipation' type='radio' value="Agree">
                        <span class='btn'>Agree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplNetworkingParticipation' type='radio' value="Strongly Agree">
                        <span class='btn last'>Strongly Agree</span>
                      
                   </label>
                  </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>I prefer for someone to wait for a good (real) opportunity to introduce me vs. an introduction for introductions sake. *</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class='vertical-align'>
                  <div class='btns'>
                    <label>
                      <input checked='' name='fsAplWaitForOpportunity' type='radio' value="Disagree">
                        <span class='btn first'>Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplWaitForOpportunity' type='radio' value="Strongly Disagree">
                        <span class='btn'>Strongly Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplWaitForOpportunity' type='radio' value="Neutral">
                        <span class='btn'>Neutral</span>
                      
                   </label>
                    <label>
                      <input name='fsAplWaitForOpportunity' type='radio' value="Agree">
                        <span class='btn'>Agree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplWaitForOpportunity' type='radio' value="Strongly Agree">
                        <span class='btn last'>Strongly Agree</span>
                      
                   </label>
                  </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>I seek out potential customers/clients in my networking more so than seeking good strategic/referral partnerships. *</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class='vertical-align'>
                  <div class='btns'>
                    <label>
                      <input checked='' name='fsAplSeekOutCustomers' type='radio' value="Disagree">
                        <span class='btn first'>Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplSeekOutCustomers' type='radio' value="Strongly Disagree">
                        <span class='btn'>Strongly Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplSeekOutCustomers' type='radio' value="Neutral">
                        <span class='btn'>Neutral</span>
                      
                   </label>
                    <label>
                      <input name='fsAplSeekOutCustomers' type='radio' value="Agree">
                        <span class='btn'>Agree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplSeekOutCustomers' type='radio' value="Strongly Agree">
                        <span class='btn last'>Strongly Agree</span>
                      
                   </label>
                  </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label>I track how much business comes from my networking efforts. *</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class='vertical-align'>
                  <div class='btns'>
                    <label>
                      <input checked='' name='fsAplTrackBusiness' type='radio' value="Disagree">
                        <span class='btn first'>Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplTrackBusiness' type='radio' value="Strongly Disagree">
                        <span class='btn'>Strongly Disagree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplTrackBusiness' type='radio' value="Neutral">
                        <span class='btn'>Neutral</span>
                      
                   </label>
                    <label>
                      <input name='fsAplTrackBusiness' type='radio' value="Agree">
                        <span class='btn'>Agree</span>
                      
                   </label>
                    <label>
                      <input name='fsAplTrackBusiness' type='radio' value="Strongly Agree">
                        <span class='btn last'>Strongly Agree</span>
                      
                   </label>
                  </div>
                </div>
            </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">On an average week, how many hours do you work? *</label>
              <select class="form-control" id="fsAplWorkHoursWeek" name="fsAplWorkHoursWeek">
                  <option value="">- select -</option>
                  <option value="0 - 10">0 - 10</option>
                  <option value="11 - 20">11 - 20</option>
                  <option value="21 - 30">21 - 30</option>
                  <option value="31 - 40">31 - 40</option>
                  <option value="41 - 45">41 - 45</option>
                  <option value="46 - 50">46 - 50</option>
                  <option value="51 - 55">51 - 55</option>
                  <option value="56 - 60">56 - 60</option>
                  <option value="61 - 65">61 - 65</option>
                  <option value="66 - 70">66 - 70</option>
                  <option value="70+">70+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">On an average work day what % of time is spent - Out in the field / at a clients? *</label>
              <select class="form-control" id="fsAplFieldVsClinets" name="fsAplFieldVsClinets">
                  <option value="">- select -</option>
                  <option value="0">0</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="25">25</option>
                  <option value="30">30</option>
                  <option value="35">35</option>
                  <option value="40">40</option>
                  <option value="40+">40+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">On an average work day what % of time is spent In office / at desk? *</label>
              <select class="form-control" id="fsAplOfficeVsDesk" name="fsAplOfficeVsDesk">
                  <option value="">- select -</option>
                  <option value="0">0</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="25">25</option>
                  <option value="30">30</option>
                  <option value="35">35</option>
                  <option value="40">40</option>
                  <option value="40+">40+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label>Please select all groups that you are currently a member of *</label>
          </div>
        </div>

        <div class="form-group">
              <ul class="checkbox-list">
                
                <li class="control-inline">
                    <input class="styled-checkbox" id="gChamberCommerce" name="gChamberCommerce" type="checkbox" value="Chamber of Commerce">
                    <label for="gChamberCommerce">Chamber of Commerce</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gChamberLeadsGroup" name="gChamberLeadsGroup" type="checkbox" value="Chamber Leads Group">
                    <label for="gChamberLeadsGroup">Chamber Leads Group</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gMyChamber" name="gMyChamber" type="checkbox" value="MyChamber">
                    <label for="gMyChamber">MyChamber</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gBNI" name="gBNI" type="checkbox" value="BNI">
                    <label for="gBNI">BNI</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gLeTip" name="gLeTip" type="checkbox" value="LeTip">
                    <label for="gLeTip">LeTip</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gVistage" name="gVistage" type="checkbox" value="Vistage">
                    <label for="gVistage">Vistage</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gTab" name="gTab" type="checkbox" value="TAB">
                    <label for="gTab">TAB</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gStrategicConnections" name="gStrategicConnections" type="checkbox" value="Strategic Connections">
                    <label for="gStrategicConnections">Strategic Connections</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gOneBusinessConnection" name="gOneBusinessConnection" type="checkbox" value="One Business Connection">
                    <label for="gOneBusinessConnection">One Business Connection</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gFourBR" name="gFourBR" type="checkbox" value="4 BR">
                    <label for="gFourBR">4 BR</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gMyFirestorm" name="gMyFirestorm" type="checkbox" value="MyFirestorm">
                    <label for="gMyFirestorm">MyFirestorm</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gEntrepreneurs" name="gEntrepreneurs" type="checkbox" value="Entrepreneurs Organization">
                    <label for="gEntrepreneurs">Entrepreneurs Organization</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gTipClub" name="gTipClub" type="checkbox" value="Tip Club">
                    <label for="gTipClub">Tip Club</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gMeetup" name="gMeetup" type="checkbox" value="A Meetup Group">
                    <label for="gMeetup">A Meetup Group</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gIndependent" name="gIndependent" type="checkbox" value="An Independent Group">
                    <label for="gIndependent">An Independent Group</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gRotary" name="gRotary" type="checkbox" value="Rotary">
                    <label for="gRotary">Rotary</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="gNone" name="gNone" type="checkbox" value="NONE">
                    <label for="gNone">NONE</label>
                </li>
              </ul>
        </div>


         <div class="form-group">
          <div class="col-md-12">
              <label for="">Which of these would you consider to be your primary (most valuable to you) group *</label>
          </div>
        </div>

        <div class="form-group">
              <ul class="checkbox-list">
                
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgChamberCommerce" name="pgChamberCommerce" type="checkbox" value="Chamber of Commerce">
                    <label for="pgChamberCommerce">Chamber of Commerce</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgChamberLeadsGroup" name="pgChamberLeadsGroup" type="checkbox" value="Chamber Leads Group">
                    <label for="pgChamberLeadsGroup">Chamber Leads Group</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgMyChamber" name="pgMyChamber" type="checkbox" value="MyChamber">
                    <label for="pgMyChamber">MyChamber</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgBNI" name="pgBNI" type="checkbox" value="BNI">
                    <label for="pgBNI">BNI</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgLeTip" name="pgLeTip" type="checkbox" value="LeTip">
                    <label for="pgLeTip">LeTip</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgVistage" name="pgVistage" type="checkbox" value="Vistage">
                    <label for="pgVistage">Vistage</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgTab" name="pgTab" type="checkbox" value="TAB">
                    <label for="pgTab">TAB</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgStrategicConnections" name="pgStrategicConnections" type="checkbox" value="Strategic Connections">
                    <label for="pgStrategicConnections">Strategic Connections</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgOneBusinessConnection" name="pgOneBusinessConnection" type="checkbox" value="One Business Connection">
                    <label for="pgOneBusinessConnection">One Business Connection</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgFourBR" name="pgFourBR" type="checkbox" value="4 BR">
                    <label for="pgFourBR">4 BR</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgMyFirestorm" name="pgMyFirestorm" type="checkbox" value="MyFirestorm">
                    <label for="pgMyFirestorm">MyFirestorm</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgEntrepreneurs" name="pgEntrepreneurs" type="checkbox" value="Entrepreneurs Organization">
                    <label for="pgEntrepreneurs">Entrepreneurs Organization</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgTipClub" name="pgTipClub" type="checkbox" value="Tip Club">
                    <label for="pgTipClub">Tip Club</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgMeetup" name="pgMeetup" type="checkbox" value="A Meetup Group">
                    <label for="pgMeetup">A Meetup Group</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgIndependent" name="pgIndependent" type="checkbox" value="An Independent Group">
                    <label for="pgIndependent">An Independent Group</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgRotary" name="pgRotary" type="checkbox" value="Rotary">
                    <label for="pgRotary">Rotary</label>
                </li>
                <li class="control-inline">
                    <input class="styled-checkbox" id="pgNone" name="pgNone" type="checkbox" value="NONE">
                    <label for="pgNone">NONE</label>
                </li>
              </ul>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">What is the highest level of education you have completed? *</label>
              <select class="form-control" id="fsAplEducationCompleted" name="fsAplEducationCompleted">
                    <option value="">- select -</option>
                    <option value="GED">GED</option>
                    <option value="High School Diploma">High School Diploma</option>
                    <option value="Some College">Some College</option>
                    <option value="Associates Degree">Associates Degree</option>
                    <option value="Bachelors Degree">Bachelors Degree</option>
                    <option value="Master Degree / MBA">Master Degree / MBA</option>
                    <option value="Doctorate / PhD">Doctorate / PhD</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">What is your age? *</label>
              <select class="form-control" id="fsAplAge" name="fsAplAge">
                  <option value="">- select -</option>
                  <option value="18 - 25">18 - 25</option>
                  <option value="26 - 30">26 - 30</option>
                  <option value="31 - 35">31 - 35</option>
                  <option value="36 - 40">36 - 40</option>
                  <option value="41 - 45">41 - 45</option>
                  <option value="46 - 50">46 - 50</option>
                  <option value="51 - 55">51 - 55</option>
                  <option value="56 - 60">56 - 60</option>
                  <option value="61 - 65">61 - 65</option>
                  <option value="65+">65+</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
              <label for="">What is your gender? *</label>
              <select class="form-control" id="fsAplGender" name="fsAplGender">
                  <option value="">- select -</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Prefer Not to Say">Prefer Not to Say</option>
              </select>
          </div>
        </div>
          <input type="hidden" name="prospectFormPage" value="4">
        </form>
        <div class="row controls">
            <div class="col-md-8 center-block">
              <button type="button" class="btn btn-default fs-btn-orange pull-left prevSignUp"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</button>
              <button type="button" class="btn btn-default fs-btn-orange pull-right nextSignUp" >Next  <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
          </div>
    </div>

    

    <div class="container on-page-menu offset-menu" id="fsAgreement" data-form="5">
          <form class="form-horizontal fs-form-gen col-md-8 col-md-offset-2" action="finalizeProspect.php" name="fsAgreement" method="POST">

          <fieldset class="form-group text-left" id="aggreement">
            <h2 class="fs-header">FIRESTORM <span class="fs-strong">MEMBERSHIP AGREEMENT</span></h2>
            <p><?php print($membershipAgreement->content); ?></p>
          </fieldset>

           <div class="form-group">
                <ul class="checkbox-list" style="padding-left:0px;">
                  <li class="control-inline">
                      <input class="styled-checkbox disabled" id="fsAplAgreement" name="fsAplAgreement" type="checkbox" value="1" disabled="disabled" />
                      <label for="fsAplAgreement">Agree with Membership Agreement</label>
                  </li>
                </ul>
           </div>
           <input type="hidden" name="prospectFormPage" value="4">
         </form>
         <div class="row controls">
            <div class="col-md-8 center-block">
              <button type="button" class="btn btn-default fs-btn-orange pull-left prevSignUp"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</button>
              <button type="button" class="btn btn-default fs-btn-orange pull-right disabled" id="createAccBtn">Create an Account</button>
            </div>
          </div>   
    </div>

    <div class="container prog-bar" id="signUpProgress">
        <div class="progress">
          <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
            20%
          </div>
        </div>
    </div>

   

    <?php require_once('php/sign-up.php') ?>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="js/new-account.js?v=<?php date("U"); ?>"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <!-- Blueimp dependencies -->
    <script type="text/javascript" src="js/vendor/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="js/jquery.fileupload.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){

          $('#industry').on('change',function(){
              if($(this).val() == 'Other'){
                $(this).parents('.col-md-6').hide();
                $('#industryOtherContainer').show();
                $('#industryOtherContainer').find('input').focus();
              }
          });

          $('.container.on-page-menu').each(function(){
            if($(this).is(':visible')){
              setProgress($(this));
            }
          });
          

          
          scrollSpeed = 800;

          $('input, select, textarea').on('focus blur change', function(){
             fieldName = $(this).attr('name');
             fieldVal = $(this).val();
             fieldText = $(this).text();

             if(fieldVal != '' || fieldText != ''){
                 $(this).parents('form').find('.alert').detach();
                 $(this).closest('.form-group').removeClass('has-error');
                 $(this).siblings('.help-block').detach();
              }
          });

          $('.long').each(function(){
              $(this).on('focus',function(){
                  $(this).attr('size', 7);
              });
              $(this).on('blur',function(){
                  $(this).attr('size', 1);
              });
              $(this).on('change',function(){
                 $(this).attr('size',1);
              });
          });
 
          $('.nextSignUp').on('click',function(){
              valid = true;

              container = $(this).parents('.container.on-page-menu');
              form = container.find('.fs-form-gen');
              fields = form.find('input, select, textarea');

              warning = $('<div class="alert alert-danger alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong>Please review highlighted fields. There is an error </strong></div>');

              fields.each(function(){
                  elemId = $(this).attr('id');
                  console.log(elemId + " " + $(this).val());
                  if($(this).val() == '' && 
                    elemId != 'profPic' && 
                    elemId != 'covPic' &&
                    elemId != 'compLogo' &&
                    elemId != 'compAddTwo' &&
                    elemId != 'compEmail' &&
                    elemId != 'compWeb' && elemId != 'industryOther'){

                    parentCont = $(this).parent();
                       $(this).closest('.form-group').addClass('has-error');
                        if(!$(this).parent().find('.help-block').length){
                          $(this).parent().append('<p class="help-block">The field can not be empty</p>');
                        }
                        if(!form.find('.alert').length){
                           form.prepend(warning);
                        }
                        valid = false;
                  }
              });
              
              if(valid){
                  if(container.attr('id') != 'signUp'){
                        setProgress(container.next());
                        container.fadeOut('fast',function(){
                        container.next().fadeIn('fast');
                        saveFormProgress(form);
                        refocusSignup($('.on-page-nav .navbar'), scrollSpeed);
                      });
                  }
              }else{
                form.find('.alert').focus();
              }
          });

          $('.prevSignUp').on('click',function(){
              container = $(this).parents('.container.on-page-menu');
              setProgress(container.prev());
              container.fadeOut('fast',function(){
                container.prev().fadeIn('fast');
                refocusSignup($('.on-page-nav .navbar'), scrollSpeed);
              });
          });

          $('#createAccBtn').on('click',function(){
              if($('#fsAplAgreement').is(':checked')){
                  saveFormProgress($('#fsAgreement'));
                  document.fsAgreement.submit();
              }
          });

          $('input[type="file"]').fileupload({
              url: 'saveProspectFile.php',
              dataType: 'xhr',
              add: function(e, data){
                data.submit();
                readURL(data.fileInput[0]);
              },
              done: function(e, data){
                console.log(data);
              }
          });

          $('select, input[type="radio"]').on('change',function(){
              saveProspectPiece($(this));
          });

          $('textarea, input').on('blur',function(e) {
              saveProspectPiece($(this));
          });

          
          $('#signUpForm input').blur(function(){
              var fieldName = $(this).attr('name');
              var fieldVal = $(this).val();
              
                  if(fieldVal != ''){
                    $(this).parent().removeClass('has-error');
                    $(this).parent().find('.error').detach();
                  }
              
                  if(fieldName == 'email'){
                    if(fieldVal == ''){
                      $(this).parent().addClass('has-error');
                      $('<p class="help-block error">Please provide an email</p>').insertAfter($($(this)));
                    }
                  }

                  if(fieldName == 'confEmail'){
                     if(fieldVal == ''){
                        $(this).parent().addClass('has-error');
                        $('<p class="help-block error">Please confirm the email</p>').insertAfter($(this));
                     }else if(fieldVal !== '' && $('#email').val() !== '' && fieldVal !== $('#email').val()){
                        $(this).parent().addClass('has-error');
                        $('<p class="help-block error">Emails do not match</p>').insertAfter($(this));
                     }
                  }

                  if(fieldName == 'password'){
                    if(fieldVal == ''){
                      $(this).parent().addClass('has-error');
                      $('<p class="help-block error">Password is required</p>').insertAfter($($(this)));
                    }else if(fieldVal !== '' && $('#confPassword').val() !== '' && fieldVal !== $('#confPassword').val()){
                      $(this).parent().addClass('has-error');
                        $('<p class="help-block error">Passwords do not match</p>').insertAfter($(this));
                    }
                  }

                  if(fieldName == 'confPassword'){
                      if(fieldVal == ''){
                          $(this).parent().addClass('has-error');
                          $('<p class="help-block error">Field can not be empty</p>').insertAfter($(this));
                      }else if(fieldVal !== '' && fieldVal !== $('#password').val()){
                          $(this).parent().addClass('has-error');
                          $('<p class="help-block error">Passwords do not match</p>').insertAfter($(this));
                      }
                  }

                  if($('#email').val() != '' && $('#email').val() == $('#confEmail').val() && $('#password').val() != '' && $('#password').val() == $('#confPassword').val()){
                    $.ajax({
                      url: 'saveNewUser.php',
                      type: 'POST',
                      data: {
                        email: $('#email').val(),
                        password: $('#password').val()
                      },
                    })
                    .done(function(data) {
                        if(data != 'Error'){
                            container = $('.container.on-page-menu');
                            setProgress($("#personalInfo"));
                            form = container.find($('#signUp'));
                            saveFormProgress(form);
                            container.fadeOut('fast',function(){
                            $("#personalInfo").fadeIn('fast');
                            refocusSignup($('.on-page-nav .navbar'), scrollSpeed);
                          });
                        }else{

                          warning = $('<div class="alert alert-danger alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong>Account with this email already exists</strong></div>');

                          $('#signUp').prepend(warning);

                        }
                    })
                    .fail(function(data) {
                        
                    })
                    
                    
                  }
          });
          
        $('#aggreement').on('scroll', function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                $('#fsAplAgreement').removeClass("disabled").removeAttr("disabled");
            }
        });
        
        $('#fsAplAgreement').change(function() {
            if($(this).is(':checked')){
                saveFormProgress($('#fsAgreement'));
                $('#createAccBtn').removeClass("disabled");
            } else {
                $('#createAccBtn').addClass("disabled");
            }
        });

    });
      
    </script>
<script type="text/javascript">    
!function(){function a(a){var b;for(var b in a)o[b]=a[b]}function b(a){document.documentElement&&(document.documentElement.className=document.documentElement.className.replace(/(?:^|\s)pleaserotate-\S*/g,""),document.documentElement.className+=" pleaserotate-"+a)}function c(a){var b;for(b=0;b<p.length;b++)a.insertRule(p[b],0);for(a.insertRule("#pleaserotate-backdrop { z-index: "+o.zIndex+"}",0),o.allowClickBypass&&a.insertRule("#pleaserotate-backdrop { cursor: pointer }",0),o.forcePortrait&&a.insertRule("#pleaserotate-backdrop { -webkit-transform-origin: 50% }",0),b=0;b<q.length;b++)CSSRule.WEBKIT_KEYFRAMES_RULE?a.insertRule("@-webkit-keyframes "+q[b],0):CSSRule.MOZ_KEYFRAMES_RULE?a.insertRule("@-moz-keyframes "+q[b],0):CSSRule.KEYFRAMES_RULE&&a.insertRule("@keyframes "+q[b],0)}function d(){var a=document.createElement("style");a.appendChild(document.createTextNode("")),document.head.insertBefore(a,document.head.firstChild),c(a.sheet)}function e(){var a=document.createElement("div"),b=document.createElement("div"),c=document.createElement("div"),d=document.createElement("small");a.setAttribute("id","pleaserotate-backdrop"),b.setAttribute("id","pleaserotate-container"),c.setAttribute("id","pleaserotate-message"),a.appendChild(b),b.appendChild(null!==o.iconNode?o.iconNode:f()),b.appendChild(c),c.appendChild(document.createTextNode(o.message)),d.appendChild(document.createTextNode(o.subMessage)),c.appendChild(d),document.body.appendChild(a)}function f(){var a=document.createElementNS("http://www.w3.org/2000/svg","svg");a.setAttributeNS("http://www.w3.org/2000/xmlns/","xmlns:xlink","http://www.w3.org/1999/xlink"),a.setAttribute("id","pleaserotate-graphic"),a.setAttribute("viewBox","0 0 250 250");var b=document.createElementNS("http://www.w3.org/2000/svg","g");b.setAttribute("id","pleaserotate-graphic-path"),o.forcePortrait&&b.setAttribute("transform","rotate(-90 125 125)");var c=document.createElementNS("http://www.w3.org/2000/svg","path");return c.setAttribute("d","M190.5,221.3c0,8.3-6.8,15-15,15H80.2c-8.3,0-15-6.8-15-15V28.7c0-8.3,6.8-15,15-15h95.3c8.3,0,15,6.8,15,15V221.3zM74.4,33.5l-0.1,139.2c0,8.3,0,17.9,0,21.5c0,3.6,0,6.9,0,7.3c0,0.5,0.2,0.8,0.4,0.8s7.2,0,15.4,0h75.6c8.3,0,15.1,0,15.2,0s0.2-6.8,0.2-15V33.5c0-2.6-1-5-2.6-6.5c-1.3-1.3-3-2.1-4.9-2.1H81.9c-2.7,0-5,1.6-6.3,4C74.9,30.2,74.4,31.8,74.4,33.5zM127.7,207c-5.4,0-9.8,5.1-9.8,11.3s4.4,11.3,9.8,11.3s9.8-5.1,9.8-11.3S133.2,207,127.7,207z"),a.appendChild(b),b.appendChild(c),a}function g(a){var b=document.getElementById("pleaserotate-backdrop");a?b&&(b.style.display="block"):b&&(b.style.display="none")}function h(){var a,c=l&&!o.forcePortrait||!l&&o.forcePortrait;c?(a=o.onShow(),b("showing")):(a=o.onHide(),b("hiding")),(void 0===a||a)&&(k.Showing=c,g(c))}function i(){return window.innerWidth<window.innerHeight}function j(){return!m&&o.onlyMobile?void(n||(n=!0,g(!1),b("hiding"),o.onHide())):void(l!==i()&&(l=i(),h()))}var k={},l=null,m=/Android|iPhone|iPad|iPod|IEMobile|Opera Mini/i.test(navigator.userAgent),n=!1,o={startOnPageLoad:!0,onHide:function(){},onShow:function(){},forcePortrait:!1,message:"Please Rotate Your Device",subMessage:"(or click to continue)",allowClickBypass:!0,onlyMobile:!0,zIndex:1e3,iconNode:null},p=["#pleaserotate-graphic { margin-left: 50px; width: 200px; animation: pleaserotateframes ease 2s; animation-iteration-count: infinite; transform-origin: 50% 50%; -webkit-animation: pleaserotateframes ease 2s; -webkit-animation-iteration-count: infinite; -webkit-transform-origin: 50% 50%; -moz-animation: pleaserotateframes ease 2s; -moz-animation-iteration-count: infinite; -moz-transform-origin: 50% 50%; -ms-animation: pleaserotateframes ease 2s; -ms-animation-iteration-count: infinite; -ms-transform-origin: 50% 50%; }","#pleaserotate-backdrop { background-color: white; top: 0; left: 0; position: fixed; width: 100%; height: 100%; }","#pleaserotate-container { width: 300px; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); }","#pleaserotate-message { margin-top: 20px; font-size: 1.3em; text-align: center; font-family: Verdana, Geneva, sans-serif; text-transform: uppercase }","#pleaserotate-message small { opacity: .5; display: block; font-size: .6em}"],q=["pleaserotateframes{ 0% { transform:  rotate(0deg) ; -moz-transform:  rotate(0deg) ;-webkit-transform:  rotate(0deg) ;-ms-transform:  rotate(0deg) ;} 49% { transform:  rotate(90deg) ;-moz-transform:  rotate(90deg) ;-webkit-transform:  rotate(90deg) ; -ms-transform:  rotate(90deg) ;  } 100% { transform:  rotate(90deg) ;-moz-transform:  rotate(90deg) ;-webkit-transform:  rotate(90deg) ; -ms-transform:  rotate(90deg) ;  } }"];k.start=function(c){return document.body?(c&&a(c),d(),e(),j(),window.addEventListener("resize",j,!1),void(o.allowClickBypass&&document.getElementById("pleaserotate-backdrop").addEventListener("click",function(){var a=o.onHide();b("hiding"),k.Showing=!1,(void 0===a||a)&&g(!1)}))):void window.addEventListener("load",k.start.bind(null,c),!1)},k.stop=function(){window.removeEventListener("resize",onWindowResize,!1)},k.onShow=function(a){o.onShow=a,n&&(n=!1,l=null,j())},k.onHide=function(a){o.onHide=a,n&&(l=null,n=!1,j())},k.Showing=!1,"function"==typeof define&&define.amd?(b("initialized"),define(["PleaseRotate"],function(){return k})):"object"==typeof exports?(b("initialized"),module.exports=k):(b("initialized"),window.PleaseRotate=k,a(window.PleaseRotateOptions),o.startOnPageLoad&&k.start())}();
    </script>
    
  </body>


</html>


