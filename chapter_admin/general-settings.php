<?php

require_once("classes/config.php");

$checkUser = new User_Valid();
if(!$checkUser->isLoggedIn()){
     header('Location: /');
     exit();
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

    <title>Firestorm Admin General Settings</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style type="text/css">
      [data-type="password"]{
      font-size: 2em;
      color: #d36a1d;
      display: none;
    }
    </style>
  </head>
  <body>
  	
  	<?php require_once('php/header.php') ?>
    <div class="container" id="adminContainer">
      <div class="row">
         <div class="col-md-10  col-md-offset-1">
             

                <div class="panel panel-default">
                  <div class="panel-heading"><h3>Social Links</h3></div>
                    <div class="panel-body">
                      <form class="fs-form-gen" action="saveGeneral.php" name="saveGeneral" method="POST">
                      <div class="table-responsive table-group">
                      <table class="table table-striped" id="socialTable">
                        <thead>
                          <tr>
                            <th>Social Media Site</th>
                            <th>Page Link</th>
                            <th>Login</th>
                            <th>Password</th>
                            <th class="text-center">Visible</th>
                            <th class="text-center">Hidden</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="h1 text-center facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></td>
                            <td class="form-group">
                              <input type="text" class="form-control input-sm" id="fsLink" name="fsLink" value="Facebook"/>
                            </td>
                            <td class="form-group">
                              <input type="email" class="form-control input-sm" id="fsEmail" name="fsEmail"  value="info@myfirestomr.com">
                            </td>
                            <td class="form-group">
                              <input type="password" class="form-control input-sm" id="fsPass" name="fsPass" value="asdfasda"/>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="facebook" id="facebookV" class="form-control hidden" checked>
                                 <label for="facebookV"></label>
                               </div>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="facebook" id="facebookH" class="form-control hidden">
                                 <label for="facebookH"></label>
                               </div>
                            </td>
                          </tr>

                          <tr>
                            <td class="h1 text-center twitter"><i class="fa fa-twitter" aria-hidden="true"></i></td>
                            <td class="form-group">
                              <input type="text" class="form-control input-sm" id="twLink" name="twLink" value="Twitter"/>
                            </td>
                            <td class="form-group">
                              <input type="email" class="form-control input-sm" id="twEmail" name="twEmail" value="info@myfirestomr.com">
                            </td>
                            <td class="form-group">
                              <input type="password" class="form-control input-sm" id="twPas" name="twPas" value="alksdjfkjakj"/>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="twitter" id="twitterV" class="form-control hidden" checked>
                                 <label for="twitterV"></label>
                               </div>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="twitter" id="twitterH" class="form-control hidden">
                                 <label for="twitterH"></label>
                               </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="h1 text-center linkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></td>
                            <td class="form-group">
                              <input type="text" class="form-control input-sm" id="liLink" name="liLink" value="LinkedIn">
                            </td>
                            <td class="form-group">
                              <input type="email" class="form-control input-sm" id="liEmail" name="liEmail" value="info@myfirestomr.com">
                            </td>
                            <td class="form-group">
                              <input type="password" class="form-control input-sm" id="liPas" name="liPas" value="dsadf3"/>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="linkedIn" id="linkedInV" class="form-control hidden" checked>
                                 <label for="linkedInV"></label>
                               </div>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="linkedIn" id="linkedInH" class="form-control hidden">
                                 <label for="linkedInH"></label>
                               </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="h1 text-center youTube"><i class="fa fa-youtube" aria-hidden="true"></i></td>
                            <td class="form-group">
                              <input type="text" class="form-control input-sm" id="ytLink" name="ytLink" value="You Tube">
                            </td>
                            <td class="form-group">
                              <input type="email" class="form-control input-sm" id="ytEmail" name="ytEmail" value="info@myfirestomr.com">
                            </td>
                            <td class="form-group">
                              <input type="password" class="form-control input-sm" id="ytPas" name="ytPas" value="123e"/>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="youTube" id="youTubeV" class="form-control hidden" checked>
                                 <label for="youTubeV"></label>
                               </div>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="youTube" id="youTubeH" class="form-control hidden">
                                 <label for="youTubeH"></label>
                               </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="h1 text-center instagram"><i class="fa fa-instagram" aria-hidden="true"></i></td>
                            <td class="form-group">
                              <input type="text" class="form-control input-sm" id="inLink" name="inLink" value="Instagram">
                            </td>
                            <td class="form-group">
                              <input type="email" class="form-control input-sm" id="inEmail" name="inEmail" value="info@myfirestomr.com">
                            </td>
                            <td class="form-group">
                              <input type="password" class="form-control input-sm" id="inPas" name="inPas" value="SecretPassword"/>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="instagram" id="instagramV" class="form-control hidden" checked>
                                 <label for="instagramV"></label>
                               </div>
                            </td>
                            <td class="controls">
                               <div class="form-group">
                                  <!-- Set Member Id for the label.for and input.id -->
                                 <input type="radio" name="instagram" id="instagramH" class="form-control hidden">
                                 <label for="instagramH"></label>
                               </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="row table-addon">
                        <div class="col-xs-12">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-sm fs-btn-green rm" id="saveSocialLinks"><i class="fa fa-trash" aria-hidden="true"></i> Save</button>
                              </div>
                        </div>
                    </div>
                      </form>
                  </div>
                </div>
                <!-- Closing Divs -->

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
      $(document).ready(function(){
            $('#saveSocialLinks').on('click',function(){

              $('.has-error').removeClass('has-error');

              valid = true;

              var fsLink = $('#fsLink').val();
              var fsEmail = $('#fsEmail').val();
              var fsPass = $('#fsPass').val();
              var twLink = $('#twLink').val();
              var twEmail = $('#twEmail').val();
              var twPas = $('#twPas').val();
              var liLink = $('#liLink').val();
              var liEmail = $('#liEmail').val();
              var liPas = $('#liPas').val();
              var ytLink = $('#ytLink').val();
              var ytEmail = $('#ytEmail').val();
              var ytPas = $('#ytPas').val();
              var inLink = $('#inLink').val();
              var inEmail = $('#inEmail').val();
              var inPas = $('#inPas').val();

              if(fsLink == ''){
                console.log($('#fsLink').closest('.form-group').addClass('has-error'));
                $('#fsLink').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(fsEmail == ''){
                $('#fsEmail').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(fsPass == ''){
                $('#fsPass').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(twLink == ''){
                $('#twLink').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(twEmail == ''){
                $('#twEmail').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(twPas == ''){
                $('#twPas').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(liLink == ''){
                $('#liLink').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(liEmail == ''){
                $('#liEmail').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(liPas == ''){
                $('#liPas').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(ytLink == ''){
                $('#ytLink').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(ytEmail == ''){
                $('#ytEmail').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(ytPas == ''){
                $('#ytPas').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(inLink == ''){
                $('#inLink').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(inEmail == ''){
                $('#inEmail').closest('.form-group').addClass('has-error');
                valid = false;
              }
              if(inPas == ''){
                $('#inPas').closest('.form-group').addClass('has-error');
                valid = false;
              }

              if(valid){
                document.saveSocialLinks.submit();
              }
            });
            
      });
    </script>
  </body>

  <style type="text/css">

    @media (max-width: 768px){
      .fs-form-gen .table tbody tr td{
        min-width: 150px;
      }
    }

  </style>
</html>





