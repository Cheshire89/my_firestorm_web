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
    $chapters = new Chapters();
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

    <title>Name of A Person</title>

    
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
        <div class="row img-holder" id="coverImg">
          <img src=".<?php print($profInfo["covPic"]);?>" class="img-reponsive">
        </div>
    </div>

        <div class="container event-header profile-header edit">
            <div class="row">
                <div class="col-xs-12">
                  <form class="form-horizontal fs-form-gen " action="" method="POST" id="profilePictures">
                      <div class="form-group">
                         <div class="col-xs-12 col-md-6 event-details">
                            <div class="wrapper featured-member profile-img edit">
                                <img class="img-responsive img-circle center-block" src=".<?php print($profInfo["profPic"]);?>" alt="" style="height:130px; width:130px;">
                                <div class="form-group text-center">
                                    <label for="profPic" class="btn fs-btn-orange"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile Picture</label>
                                    <input type="file" id="profPic" name="profPic">
                                </div>
                            </div>
                         </div>
                         <div class="col-xs-12 col-md-6 event-details">
                            <div class="wrapper featured-member cover-img edit">
                                <img class="img-responsive center-block" src=".<?php print($profInfo["covPic"]);?>" alt="">
                                <div class="form-group text-center">
                                    <label for="covPic" class="btn fs-btn-orange"><i class="fa fa-picture-o" aria-hidden="true"></i> Cover Image</label>
                                    <input type="file" id="covPic" name="covPic">
                                </div>
                            </div>
                         </div>
                
                      </div>

                  </form>
                </div>

             </div>
        </div>
    
    <div class="container profile on-page-nav">
      <nav class="navbar">
          <div class="navbar-collapse">
            <ul class="nav nav-justified">
                  <li><a href="/" title="">Profile</a></li>
                  <li class="active"><a href="profile-edit.php" title="">Edit Profile</a></li>
                  <li><a href="profile-billing.php" title="">Billing</a></li>
                  <li><a href="profile-referals.php" title="">Referals</a></li>
            </ul>
          </div>
      </nav>
    </div>
    
   <div class="container info">
     <div class="row">
              <div class="col-xs-12">
                  <form class="form-horizontal fs-form-gen " action="" method="POST" id="profileGenInfo">
                      <div class="form-group">
                          <div class="col-md-10 col-md-offset-1 bg-grey">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-left">
                                          <div class="col-md-12">
                                            <h4 class="fs-header">General <span class="fs-strong">Information</span></h4>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="col-xs-12 col-md-6">
                                            <label class="h5" for="fName">First Name</label>
                                            <input type="text" class="form-control" id="fName" name="fName" placeholder="First Name" value="<?php print($profInfo["fName"]);?>">
                                          </div>
                                          <div class="col-xs-12 col-md-6">
                                            <label class="h5" for="lName">Last Name</label>
                                            <input type="text" class="form-control" id="lName" name="lName" placeholder="Last Name" value="<?php print($profInfo["lName"]);?>">
                                          </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                      </div>
                   </form>

                <form class="form-horizontal fs-form-gen " action="" method="POST" id="profileBio">
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-1">
                          <label for="bio">Biography</label>
                          <textarea id="bio" name="bio" class="form-control"><?php print($profInfo["bio"]);?></textarea>
                      </div>
                      
                    </div>
                </form>
             
                    <form class="form-horizontal fs-form-gen" action="" method="POST" id="businessInfo">
                    
                      <div class="form-group text-left">
                        <div class="col-xs-12 col-md-10 col-md-offset-1">
                          <h4 class="fs-header">Business <span class="fs-strong">Information</span></h4>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-xs-12 col-md-4 col-md-offset-1">
                          <label class="h5" for="companyName">Company Name</label>
                          <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name" value="<?php print($profInfo["companyName"]);?>">
                        </div>
                        <div class="col-xs-12 col-md-3">
                          <label class="h5" for="companyPosition">Position in the Company</label>
                          <input type="text" class="form-control" id="companyPosition" name="companyPosition" placeholder="Position" value="<?php print($profInfo["companyPosition"]);?>">
                        </div>
                        <div class="col-xs-12 col-md-3">
                          <label class="h5" for="companyIndustry">Company Industry</label>
                          <input type="text" class="form-control" id="companyIndustry" name="companyIndustry" placeholder="Industry" value="<?php print($profInfo["companyIndustry"]);?>">
                        </div>

                      </div>
                      <div class="form-group">
                        <div class="col-xs-12 col-md-5 col-md-offset-1">
                          <label class="h5" for="companyAddress">Company Address 1</label>
                          <input type="text" class="form-control" id="companyAddress" name="companyAddress" placeholder="Ex: 123 Washington Street" value="<?php print($profInfo["companyAddress"]);?>">
                        </div>
                        <div class="col-xs-12 col-md-5">
                          <label class="h5" for="companyAddressCont">Company Address 2</label>
                          <input type="text" class="form-control" id="companyAddressCont" name="companyAddressCont" placeholder="Ex: Unit 102C" value="<?php print($profInfo["companyAddressCont"]);?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-xs-12 col-md-3 col-md-offset-1">
                          <label class="h5" for="companyCity">Company City</label>
                          <input type="text" class="form-control" id="companyCity" name="companyCity" placeholder="Ex: Beverly Hills" value="<?php print(ucfirst($profInfo["companyCity"]));?>">
                        </div>
                        <div class="col-xs-12 col-md-4">
                          <label class="h5" for="companyState">Company State</label>
                          <select class="form-control" id="companyState" name="companyState" placeholder="Chapter State" value="<?php print($profInfo["companyState"]) ?>">
                            <option value=""> State</option>
                            <option value="AL" <?php if($profInfo["companyState"] == "AL"){print('selected="selected"');}?>>Alabama</option>
                            <option value="AK" <?php if($profInfo["companyState"] == "AK"){print('selected="selected"');}?>>Alaska</option>
                            <option value="AZ" <?php if($profInfo["companyState"] == "AZ"){print('selected="selected"');}?>>Arizona</option>
                            <option value="AR" <?php if($profInfo["companyState"] == "AR"){print('selected="selected"');}?>>Arkansas</option>
                            <option value="CA" <?php if($profInfo["companyState"] == "CA"){print('selected="selected"');}?>>California</option>
                            <option value="CO" <?php if($profInfo["companyState"] == "CO"){print('selected="selected"');}?>>Colorado</option>
                            <option value="CT" <?php if($profInfo["companyState"] == "CT"){print('selected="selected"');}?>>Connecticut</option>
                            <option value="DE" <?php if($profInfo["companyState"] == "DE"){print('selected="selected"');}?>>Delaware</option>
                            <option value="DC" <?php if($profInfo["companyState"] == "DC"){print('selected="selected"');}?>>District Of Columbia</option>
                            <option value="FL" <?php if($profInfo["companyState"] == "FL"){print('selected="selected"');}?>>Florida</option>
                            <option value="GA" <?php if($profInfo["companyState"] == "GA"){print('selected="selected"');}?>>Georgia</option>
                            <option value="HI" <?php if($profInfo["companyState"] == "HI"){print('selected="selected"');}?>>Hawaii</option>
                            <option value="ID" <?php if($profInfo["companyState"] == "ID"){print('selected="selected"');}?>>Idaho</option>
                            <option value="IL" <?php if($profInfo["companyState"] == "IL"){print('selected="selected"');}?>>Illinois</option>
                            <option value="IN" <?php if($profInfo["companyState"] == "IN"){print('selected="selected"');}?>>Indiana</option>
                            <option value="IA" <?php if($profInfo["companyState"] == "IA"){print('selected="selected"');}?>>Iowa</option>
                            <option value="KS" <?php if($profInfo["companyState"] == "KS"){print('selected="selected"');}?>>Kansas</option>
                            <option value="KY" <?php if($profInfo["companyState"] == "KY"){print('selected="selected"');}?>>Kentucky</option>
                            <option value="LA" <?php if($profInfo["companyState"] == "LA"){print('selected="selected"');}?>>Louisiana</option>
                            <option value="ME" <?php if($profInfo["companyState"] == "ME"){print('selected="selected"');}?>>Maine</option>
                            <option value="MD" <?php if($profInfo["companyState"] == "MD"){print('selected="selected"');}?>>Maryland</option>
                            <option value="MA" <?php if($profInfo["companyState"] == "MA"){print('selected="selected"');}?>>Massachusetts</option>
                            <option value="MI" <?php if($profInfo["companyState"] == "MI"){print('selected="selected"');}?>>Michigan</option>
                            <option value="MN" <?php if($profInfo["companyState"] == "MN"){print('selected="selected"');}?>>Minnesota</option>
                            <option value="MS" <?php if($profInfo["companyState"] == "MS"){print('selected="selected"');}?>>Mississippi</option>
                            <option value="MO" <?php if($profInfo["companyState"] == "MO"){print('selected="selected"');}?>>Missouri</option>
                            <option value="MT" <?php if($profInfo["companyState"] == "MT"){print('selected="selected"');}?>>Montana</option>
                            <option value="NE" <?php if($profInfo["companyState"] == "NE"){print('selected="selected"');}?>>Nebraska</option>
                            <option value="NV" <?php if($profInfo["companyState"] == "NV"){print('selected="selected"');}?>>Nevada</option>
                            <option value="NH" <?php if($profInfo["companyState"] == "NH"){print('selected="selected"');}?>>New Hampshire</option>
                            <option value="NJ" <?php if($profInfo["companyState"] == "NJ"){print('selected="selected"');}?>>New Jersey</option>
                            <option value="NM" <?php if($profInfo["companyState"] == "NM"){print('selected="selected"');}?>>New Mexico</option>
                            <option value="NY" <?php if($profInfo["companyState"] == "NY"){print('selected="selected"');}?>>New York</option>
                            <option value="NC" <?php if($profInfo["companyState"] == "NC"){print('selected="selected"');}?>>North Carolina</option>
                            <option value="ND" <?php if($profInfo["companyState"] == "ND"){print('selected="selected"');}?>>North Dakota</option>
                            <option value="OH" <?php if($profInfo["companyState"] == "OH"){print('selected="selected"');}?>>Ohio</option>
                            <option value="OK" <?php if($profInfo["companyState"] == "OK"){print('selected="selected"');}?>>Oklahoma</option>
                            <option value="OR" <?php if($profInfo["companyState"] == "OR"){print('selected="selected"');}?>>Oregon</option>
                            <option value="PA" <?php if($profInfo["companyState"] == "PA"){print('selected="selected"');}?>>Pennsylvania</option>
                            <option value="RI" <?php if($profInfo["companyState"] == "RI"){print('selected="selected"');}?>>Rhode Island</option>
                            <option value="SC" <?php if($profInfo["companyState"] == "SC"){print('selected="selected"');}?>>South Carolina</option>
                            <option value="SD" <?php if($profInfo["companyState"] == "SD"){print('selected="selected"');}?>>South Dakota</option>
                            <option value="TN" <?php if($profInfo["companyState"] == "TN"){print('selected="selected"');}?>>Tennessee</option>
                            <option value="TX" <?php if($profInfo["companyState"] == "TX"){print('selected="selected"');}?>>Texas</option>
                            <option value="UT" <?php if($profInfo["companyState"] == "UT"){print('selected="selected"');}?>>Utah</option>
                            <option value="VT" <?php if($profInfo["companyState"] == "VT"){print('selected="selected"');}?>>Vermont</option>
                            <option value="VA" <?php if($profInfo["companyState"] == "VA"){print('selected="selected"');}?>>Virginia</option>
                            <option value="WA" <?php if($profInfo["companyState"] == "WA"){print('selected="selected"');}?>>Washington</option>
                            <option value="WV" <?php if($profInfo["companyState"] == "WV"){print('selected="selected"');}?>>West Virginia</option>
                            <option value="WI" <?php if($profInfo["companyState"] == "WI"){print('selected="selected"');}?>>Wisconsin</option>
                            <option value="WY" <?php if($profInfo["companyState"] == "WY"){print('selected="selected"');}?>>Wyoming</option>
                          </select>
                        </div>
                        <div class="col-xs-12 col-md-3">
                          <label class="h5" for="companyZip">Company Zip</label>
                          <input type="text" class="form-control" id="companyZip" name="companyZip" placeholder="Ex: 90210" value="<?php print(ucfirst($profInfo["companyZip"]));?>">
                        </div>
                      </div>
                  </form>
              </div>
            </div>
        </div>


    <div class="container info">
      <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="row bg-grey">
              <div class="col-md-10">
                  <h4 class="fs-header text-left">Chapters <span class="fs-strong">Enrolled</span></h4>
                   <ul class="list-inline groups">
                        <?php $chapters->printUserChapters($userID); ?>
                    </ul>
              </div>
            </div>
        </div>
        <div class="col-md-6 side-info">
          <div class="row bg-grey">
              <div class="col-sm-12 col-md-10 text-left sub-info edit">
                <h4 class="fs-header text-left"><span class="fs-strong">Expertise and Experience</span></h4>
                <ul class="list-unstyled groups edit" id="expertise">
      
                  <?php 
                    print($user->print_admin_edit_user_expertise_list($profInfo["expertise"]));
                  ?>
                  
                </ul>
                <div class="btn-group chapter">
                    <button type="button" class="btn btn-default fs-btn-orange btn-sm pull-right" id="addExpertise">Add Expertise</button>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="row" id="editExpertise">
        <div class="col-md-10 col-md-offset-1">
            <form class="form-horizontal fs-form-gen " id="editExpertiseForm" name="editExpertiseForm" method="POST">
                <div class="form-group hidden action">
                  <input type="hidden" value="add">
                </div>
                <div class="form-group hidden expId">
                  <input type="hidden" value="">
                </div>
                <div class="form-group text-left">
                  <div id="header">
                    
                  </div>
                </div>
                <div class="form-group">
                   <input type="text" class="form-control" id="item" name="item">
                </div>
            </form>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 side-info">
          <div class="row bg-grey">
              <div class="col-sm-12 col-md-10 col-md-offset-1 text-left sub-info">
                <h4 class="fs-header text-left"><span class="fs-strong">Contact Info</span></h4>
                <form class="form-horizontal fs-form-gen" method="POST" name="profileContactInfo" id="profileContactInfo">
                
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label for="linkedIn">LinkedIn Profile</label>
                            <input type="text" class="form-control" id="linkedIn" name="linkedIn" placeholder="LinkedIn Profile" value="<?php print($profInfo["linkedIn"]);?>">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label for="companyPhone">Company Phone</label>
                            <input type="text" class="form-control" id="companyPhone" name="companyPhone" placeholder="Company Phone Number" value="<?php print($profInfo["companyPhone"]);?>">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <label for="companyWeb">Company Website</label>
                            <input type="text" class="form-control" id="companyWeb" name="companyWeb" placeholder="Company Website" value="<?php print($profInfo["companyWeb"]);?>">
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="js/jquery.fileupload.js"></script>

    <script type="text/javascript">
          $(document).ready(function(){
              var userID = '<?php print($userID) ?>';

          $('#addChapterBtn').on('click',function(){
              $('#addChapter').slideDown();
          });



          $('textarea, select, input').on('blur change',function(e) {
                var fieldname = $(this).attr("name");
                var fieldval = $(this).val();

                sendObj = {'fieldName': fieldname, 'fieldVal': fieldval, 'type': 'text'};
                
                if($(this).attr('type') != 'file' && fieldname != 'item'){

                    $.post("saveUserInfo.php", sendObj, function(result) {
                    });
                    if(fieldname == 'chapters'){
                      sendObj = {
                          'userID': <?php print($userID);?>,
                          'chapterID': parseInt(fieldval)
                      }
                      $.post("assignChapter.php", sendObj, function(result){
                        $('#addChapter').slideUp();
                      });
                    }
                }
          });

          $('input[type="file"]').fileupload({
              url: 'saveUserFile.php?userID='+userID,
              dataType: 'xhr',
              add: function(e, data){
                console.log(data.fileInput[0]);
                data.submit();
                readURL(data.fileInput[0]);
              },
              done: function(e, data){
                // console.log(data);
              }
          });

      $('.event-header').ready(function(){
          var eventPic = $('.event-pic');
          var img = eventPic.find('img');
              var offset = (eventPic.height() - img.height()) / 2;
              img.css('margin-top', offset);
      });


      $('.groups.edit').ready(function(){
          var cont = $('.groups.edit');
              item = cont.find('li:after');
      });

      $('#addExpertise').on('click',function(){
          prepareFormCont($(this));
      });

      $('#item').on('blur',function(){

          expertiseCon = $('#expertise');

            items = expertiseCon.find('.input-group');
            itemsLen = items.length - 1;
            
            newItemVal = $(this).val();

          action = $(this).parent().siblings('.action').find('input[type="hidden"]').val();
          dataId = $(this).parent().siblings('.expId').find('input[type="hidden"]').val();
          
          if(action == 'add' && dataId == ""){
              
              templ = '<li class="input-group" data-id="'+(items.length+1)+'"><span>'+newItemVal+'</span>'+
                        '<div class="input-group-addon">'+
                          '<button type="button" class="btn btn-xs edit"><i class="fa fa-pencil" aria-hidden="true"></i></button>'+
                          '<button type="button" class="btn btn-xs delete"><i class="fa fa-times" aria-hidden="true"></i></button>'+
                        '</div></li>';

              expertiseCon.append(templ);
              $list = buildExperienceList();
              list += '/'+newItemVal;
              appendListeners();

          }else{
              editableItem = expertiseCon.find('.input-group[data-id="'+dataId+'"]');
              editableItem.find('span').text(newItemVal);
              $list = buildExperienceList();
          }

              sendExperience($list);
          });

          appendListeners();
      });

      function sendExperience($list){
          var fieldname = 'expertise';
          var fieldval = list;

          sendObj = {'fieldName': fieldname, 'fieldVal': fieldval, 'type': 'text'};      
          if($(this).attr('type') != 'file'){
              $.post("saveUserInfo.php", sendObj, function(result) {
                  $('#editExpertise').slideUp();
              });
          }
      }

      function appendListeners(){
        expertise = $('#expertise li');
        expertise.each(function(){
          editItem = $(this).find('.fa-pencil');
          deleteItem = $(this).find('.fa-times');

          editItem.on('click', function(){
              prepareFormCont($(this));
          });

          deleteItem.on('click',function(){
              $(this).parents('li').detach();
              list = buildExperienceList();
              sendExperience(list);
          });
        });
      }

      function buildExperienceList(){
              list = '';
              expertiseCon = $('#expertise');
              items = expertiseCon.find('.input-group');
              itemsLen = items.length - 1;
              items.each(function(i){
                listSpan = $(this).find('span');
                if(i < itemsLen){
                  list += listSpan.text() + '/';
                }else{
                  list += listSpan.text();
                }
              });
              return list;
      }


      function prepareFormCont(obj){
          cont = $('#editExpertise');
          header = cont.find('#header');
            
          header.find('.fs-header').detach();
          input = cont.find('.form-control');

         
          

          actionVal = cont.find('.action input[type="hidden"]');

              if(obj.attr('id')==="addExpertise"){
                expIdVal = cont.find('.expId input[type="hidden"]').val("");

                input.val('New Item');
                headerHtml = $('<h3 class="fs-header">Add <span class="fs-strong">Expertise</span></h3>');
                actionVal.val('add');
              }
              else{
                
                dataId = obj.parents('li').attr('data-id');
                expIdVal = cont.find('.expId input[type="hidden"]').val(dataId);

                input.val(obj.parents('li').find('span').text());

                headerHtml = $('<h3 class="fs-header">Edit <span class="fs-strong">Expertise</span></h3>');
                actionVal.val('edit');
              }

              if(header.find('.fs-header').length == 0){
                  header.append(headerHtml);  
              }

          cont.slideDown();
      }

      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    elem = $(input).attr('id');
                    
                    var img = $('#'+elem).parent().siblings('img');
                    img.attr('src', e.target.result);
                    img.fadeIn();
                    if(elem == 'covPic'){
                      $('#coverImg').find('img').attr('src', e.target.result);
                    }
                    
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        
    </script>
  </body>

  <style type="text/css">
    .text-center{
      text-align: center !important;
    }
    label[for="profilePic"], label[for="coverPic"]{
      font-size: 1em !important;
      text-align: center;
      margin-left: 25%;
    }

  </style>
</html>
