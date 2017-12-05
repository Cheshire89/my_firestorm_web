$(document).ready(function(){
      $('#eventDateStart').datepicker({
          minDate: 1
        });
        $('#eventDateEnd').datepicker({
          minDate: 2
        });
        $('#eventTimeStart').timepicker();
        $('#eventTimeEnd').timepicker();

        
      if($('#paidEventYes').is(':checked')){
          $('#tickets').show();
      }
      
      if($('#oneDayNo').is(':checked')){
        $('#eventEnd').show();
      }

      $('#paidEventNo').on('change', function(){
           $('#tickets').slideUp('fast');
      });
      $('#paidEventYes').on('change',function(){
           $('#tickets').slideDown('fast');
      });
      
      
      $('#oneDayYes').on('change',function(){
          $('#eventEnd').slideUp('fast');
      });  
      $('#oneDayNo').on('change',function(){
          $('#eventEnd').slideDown('fast');
      });

    $('#eventImg').on('change',function(){
        loadImgToDom(this, $('.image-preview').find('img'));
    });

   $('#sponsorImg').on('change',function(){
      $(this).siblings('label').text($(this).val());
   });

    $('#addSponsor').on('click',function(){
        valid = true;

        sponsorImg =$('#sponsorImg').val();
        sponsorName =$('#sponsorName').val();
        sponsorLink =$('#sponsorLink').val();

        if(sponsorImg == ''){
          $('#sponsorImg').closest('.form-group').addClass('has-error');
          valid = false;
        }
        if(sponsorName == ''){
          $('#sponsorName').closest('.form-group').addClass('has-error');
          valid = false;
        }
        if(sponsorLink == ''){
          $('#sponsorLink').closest('.form-group').addClass('has-error');
          valid = false;
        }


        if(valid){
            slidesTable = $('#slidesTable');
            row = slidesTable.find('tbody tr').first().clone();
                cols = row.children('td');
                
                    img = cols.eq(0).find('img');

                    sponsorImg = document.getElementById('sponsorImg');
                        if (sponsorImg.files && sponsorImg.files[0]) {
                              var reader = new FileReader();

                              reader.onload = function (e){
                                img.attr('src', e.target.result);
                              }
                              reader.readAsDataURL(sponsorImg.files[0]);
                        }

                    name = cols.eq(1).text(sponsorName);
                    link = cols.eq(2).text(sponsorLink);
                    

                    select = cols.eq(3);
                        selectLabel = select.find('label');
                            selectLabel.attr('for', "sponsor" + cols.length);

                        selectInput = select.find('input');
                            selectInput.attr('id', "sponsor" + cols.length);
    

            body = slidesTable.find('tbody');
            body.append(row);
        }        
    });

    $('#rmSponsor').on('click',function(){
        table = $('#slidesTable');
        rows = table.find('tbody tr');
            rows.each(function(){
                last = $(this).find('td').last();
                if(last.find("input").is(':checked')){
                      last.parents('tr').detach();
                }
            });
    });

    $('.saveEventBtn').on('click',function(){
      valid = true;
      
      eventImg = $('#eventImg').val();
      eventTitle = $('#eventTitle').val();
      eventBy = $('#eventBy').val();
      eventCategory = $('#eventCategory').val();
      eventDateStart = $('#eventDateStart').val();
      eventTimeStart = $('#eventTimeStart').val();
      eventAddress = $('#eventAddress').val();
      eventCity = $('#eventCity').val();
      eventState = $('#eventState').val();
      eventZip = $('#eventZip').val();
      eventTags = $('#eventTags').val();

      // if(eventImg == ""){
      //   $('#eventImg').closest('.form-group').addClass('has-error');;
      //   valid=false;
      // }
      
      if(eventTitle == ""){
        $('#eventTitle').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventBy == ""){
        $('#eventBy').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventCategory == ""){
        $('#eventCategory').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventDateStart == ""){
        $('#eventDateStart').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventTimeStart == ""){
        $('#eventTimeStart').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventAddress == ""){
        $('#eventAddress').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventCity == ""){
        $('#eventCity').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventState == ""){
        $('#eventState').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      if(eventZip == ""){
        $('#eventZip').closest('.form-group').addClass('has-error');;
        valid=false;
      }
      
      if(eventTags == ""){
        $('#eventTags').closest('.form-group').addClass('has-error');;
        valid=false;
      }

      if(valid){
        document.saveEventForm.submit();
      }else{
        $('#saveEventForm').focus();
      }
    });


    });


