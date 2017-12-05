$(document).ready(function(){
	$('#industry option').each(function(){
            if($(this).val() == '<?php print($pr["industry"]); ?>'){
               $(this).attr('selected', 'selected');
            }
          });
          $('#groups option').each(function(){
            if($(this).val() == '<?php print($pr["groups"]); ?>'){
               $(this).attr('selected', 'selected');
            }
          });
          $('#compState option').each(function(){
            if($(this).val() == '<?php print($pr["compState"]); ?>'){
               $(this).attr('selected', 'selected');
            }
          });
          $('#fsAplBussFocus option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplBussFocus"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplBussPosition option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplBussPosition"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplReferralTurnarround option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplReferralTurnarround"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplCompEmploy option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplCompEmploy"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplYearsInIndustry option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplYearsInIndustry"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplYearsSinceHsGraduation option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplYearsSinceHsGraduation"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplYearsOfNetworking option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplYearsOfNetworking"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplNetworkingAttendance option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplNetworkingAttendance"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplWorkHoursWeek option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplWorkHoursWeek"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplFieldVsClinets option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplFieldVsClinets"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplOfficeVsDesk option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplOfficeVsDesk"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplEducationCompleted option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplEducationCompleted"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplAge option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplAge"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });
          $('#fsAplGender option').each(function(){
              if($(this).val() == '<?php print($pr["fsAplGender"]);?>'){
                $(this).attr('selected', 'selected');
              }
          });

          $('input[name="fsAplNetworkingBeneficial"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplNetworkingBeneficial"]);?>'){
              $(this).attr('checked',true);
            }
          });
          $('input[name="fsAplUseLinkedIn"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplUseLinkedIn"]);?>'){
              $(this).attr('checked',true);
            }
          });
          $('input[name="fsAplNetworkingParticipation"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplNetworkingParticipation"]);?>'){
              $(this).attr('checked',true);
            }
          });
          $('input[name="fsAplWaitForOpportunity"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplWaitForOpportunity"]);?>'){
              $(this).attr('checked',true);
            }
          });
          $('input[name="fsAplSeekOutCustomers"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplSeekOutCustomers"]);?>'){
              $(this).attr('checked',true);
            }
          });
          $('input[name="fsAplTrackBusiness"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplTrackBusiness"]);?>'){
              $(this).attr('checked',true);
            }
          });
          $('input[name="fsAplTrackNetworking"]').each(function(){
            if($(this).val() == '<?php print($pr["fsAplTrackNetworking"]);?>'){
              $(this).attr('checked',true);
            }
          });

if($('input[name="gChamberCommerce"]').val() == '<?php print($pr["gChamberCommerce"]);?>'){
  $('input[name="gChamberCommerce"]').attr('checked',true);}
if($('input[name="gChamberLeadsGroup"]').val() == '<?php print($pr["gChamberLeadsGroup"]);?>'){
  $('input[name="gChamberLeadsGroup"]').attr('checked',true);}
if($('input[name="gMyChamber"]').val() == '<?php print($pr["gMyChamber"]);?>'){
  $('input[name="gMyChamber"]').attr('checked',true);}
if($('input[name="gBNI"]').val() == '<?php print($pr["gBNI"]);?>'){
  $('input[name="gBNI"]').attr('checked',true);}
if($('input[name="gLeTip"]').val() == '<?php print($pr["gLeTip"]);?>'){
  $('input[name="gLeTip"]').attr('checked',true);}
if($('input[name="gVistage"]').val() == '<?php print($pr["gVistage"]);?>'){
  $('input[name="gVistage"]').attr('checked',true);}
if($('input[name="gTab"]').val() == '<?php print($pr["gTab"]);?>'){
  $('input[name="gTab"]').attr('checked',true);}
if($('input[name="gStrategicConnections"]').val() == '<?php print($pr["gStrategicConnections"]);?>'){
  $('input[name="gStrategicConnections"]').attr('checked',true);}
if($('input[name="gOneBusinessConnection"]').val() == '<?php print($pr["gOneBusinessConnection"]);?>'){
  $('input[name="gOneBusinessConnection"]').attr('checked',true);}
if($('input[name="gFourBR"]').val() == '<?php print($pr["gFourBR"]);?>'){
  $('input[name="gFourBR"]').attr('checked',true);}
if($('input[name="gMyFirestorm"]').val() == '<?php print($pr["gMyFirestorm"]);?>'){
  $('input[name="gMyFirestorm"]').attr('checked',true);}
if($('input[name="gEntrepreneurs"]').val() == '<?php print($pr["gEntrepreneurs"]);?>'){
  $('input[name="gEntrepreneurs"]').attr('checked',true);}
if($('input[name="gTipClub"]').val() == '<?php print($pr["gTipClub"]);?>'){
  $('input[name="gTipClub"]').attr('checked',true);}
if($('input[name="gMeetup"]').val() == '<?php print($pr["gMeetup"]);?>'){
  $('input[name="gMeetup"]').attr('checked',true);}
if($('input[name="gIndependent"]').val() == '<?php print($pr["gIndependent"]);?>'){
  $('input[name="gIndependent"]').attr('checked',true);}
if($('input[name="gRotary"]').val() == '<?php print($pr["gRotary"]);?>'){
  $('input[name="gRotary"]').attr('checked',true);}
if($('input[name="gNone"]').val() == '<?php print($pr["gNone"]);?>'){
  $('input[name="gNone"]').attr('checked',true);}
if($('input[name="pgChamberCommerce"]').val() == '<?php print($pr["pgChamberCommerce"]);?>'){
  $('input[name="pgChamberCommerce"]').attr('checked',true);}
if($('input[name="pgChamberLeadsGroup"]').val() == '<?php print($pr["pgChamberLeadsGroup"]);?>'){
  $('input[name="pgChamberLeadsGroup"]').attr('checked',true);}
if($('input[name="pgMyChamber"]').val() == '<?php print($pr["pgMyChamber"]);?>'){
  $('input[name="pgMyChamber"]').attr('checked',true);}
if($('input[name="pgBNI"]').val() == '<?php print($pr["pgBNI"]);?>'){
  $('input[name="pgBNI"]').attr('checked',true);}
if($('input[name="pgLeTip"]').val() == '<?php print($pr["pgLeTip"]);?>'){
  $('input[name="pgLeTip"]').attr('checked',true);}
if($('input[name="pgVistage"]').val() == '<?php print($pr["pgVistage"]);?>'){
  $('input[name="pgVistage"]').attr('checked',true);}
if($('input[name="pgTab"]').val() == '<?php print($pr["pgTab"]);?>'){
  $('input[name="pgTab"]').attr('checked',true);}
if($('input[name="pgStrategicConnections"]').val() == '<?php print($pr["pgStrategicConnections"]);?>'){
  $('input[name="pgStrategicConnections"]').attr('checked',true);}
if($('input[name="pgOneBusinessConnection"]').val() == '<?php print($pr["pgOneBusinessConnection"]);?>'){
  $('input[name="pgOneBusinessConnection"]').attr('checked',true);}
if($('input[name="pgFourBR"]').val() == '<?php print($pr["pgFourBR"]);?>'){
  $('input[name="pgFourBR"]').attr('checked',true);}
if($('input[name="pgMyFirestorm"]').val() == '<?php print($pr["pgMyFirestorm"]);?>'){
  $('input[name="pgFourBR"]').attr('checked',true);}
if($('input[name="pgEntrepreneurs"]').val() == '<?php print($pr["pgEntrepreneurs"]);?>'){
  $('input[name="pgEntrepreneurs"]').attr('checked',true);}
if($('input[name="pgTipClub"]').val() == '<?php print($pr["pgTipClub"]);?>'){
  $('input[name="pgTipClub"]').attr('checked',true);}
if($('input[name="pgMeetup"]').val() == '<?php print($pr["pgMeetup"]);?>'){
  $('input[name="pgMeetup"]').attr('checked',true);}
if($('input[name="pgIndependent"]').val() == '<?php print($pr["pgIndependent"]);?>'){
  $('input[name="pgIndependent"]').attr('checked',true);}
if($('input[name="pgRotary"]').val() == '<?php print($pr["pgRotary"]);?>'){
  $('input[name="pgRotary"]').attr('checked',true);}
if($('input[name="pgNone"]').val() == '<?php print($pr["pgNone"]);?>'){
  $('input[name="pgNone"]').attr('checked',true);}
if($('input[name="fsAplAgreement"]').val() == '<?php print($pr["fsAplAgreement"]);?>'){
  $('input[name="fsAplAgreement"]').attr('checked',true);}
});

function saveProspectPiece(obj){
            if(obj.attr("name") != "email" && obj.attr("name") != "confemail" && obj.attr("name") != "password" && obj.attr("name") != "confpassword") {
                if(obj.attr('name') == 'industryOther'){
                  var fieldname = 'industry';
                  var fieldval = obj.val();
                }else{
                  var fieldname = obj.attr("name");
                  var fieldval = obj.val();
                }
                var sendObj = {'fieldName': fieldname, 'fieldVal': fieldval, 'type': 'text'};
               if(obj.attr('type') != 'file'){
                  $.ajax({
                     url: "saveProspectPiece.php", 
                     type: "POST",
                     data: sendObj
                  }).done(function(data){
                    console.log("reply");
                    if(data != "Error") {
                        console.log(data);
                    } else {
                        $('#'+fieldname).attr("src", "img/error_img.jpg");
                    }
                  }).fail(function(xhr, status, error) {
                    console.log("we failed");
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                  });
                
               }
            }
          }

          function saveFormProgress(obj){
            if(obj.attr("name") != "email" && obj.attr("name") != "confemail" && obj.attr("name") != "password" && obj.attr("name") != "confpassword") {
                var fieldname = 'prospectFormPage';
                var fieldval = obj.find('input[name="prospectFormPage"]').val();
                var sendObj = {'fieldName': fieldname, 'fieldVal': fieldval, 'type': 'text'};
                   if(obj.attr('type') != 'file'){
                    
                      $.ajax({
                         url: "saveProspectPiece.php", 
                         type: "POST",
                         data: sendObj
                      }).done(function(data){
                        console.log('Done '+data);
                      }).fail(function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            console.log(err.Message);
                      });
                    
                   }
            }
          }
          
          function confMatch(valOne, valTwo) {
              var one = valOne.val();
              var two = valTwo.val();
              if(one != two) {
                 return false;
              }else{
                 return true;
              }
          }
 
          function refocusSignup(target, speed){
            $('html, body').animate({
                scrollTop: target.offset().top-20
             }, speed);
          }
          
          function setProgress(container){
              containers = $('.container.on-page-menu');
              numOfContainers = $('.container.on-page-menu').length;
              step = 100 / numOfContainers;

              currentStep = (containers.index(container)+1) * step;
 
              progressCont = $('#signUpProgress');
                  bar = progressCont.find('.progress-bar');
 
                      bar.text(currentStep +'%');
                       bar.attr('aria-valuenow', currentStep);
                      bar.css('width', currentStep + '%'); 
          }
 
          function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      elem = $(input).attr('id');
                      var img = $('#'+elem).siblings('img');
                      //console.log("hi: "+e.target.result);
                      //var exImg = img.split(".");
                      //if(exImg[exImg.length-1] == "txt") {
                        //console.log("hi");
                      //}
                      if(e.target.result != "data:") {
                          img.attr('src', e.target.result);
                          img.fadeIn();
                      } else {
                         img.attr('src', 'img/error_img.jpg');
                          img.fadeIn();
                      }                      
                  
                      
                  }
                  reader.readAsDataURL(input.files[0]);
              }
          }