(function(){

      // Cache Slide Table
      $table = $('#slidesTable');
      controls = $table.find('.controls');
      editBtn = controls.find('.edit');
      addBtn = $('#addImg');
      deleteBtn = controls.find('.delete');

      // Cache Slide Form
      $slideForm = $('#editSlideForm');
        $formHeader = $slideForm.find('.panel-heading').children().first();
          $slideText = $slideForm.find('#slideText');
          $slideDesc = $slideForm.find('#slideDesc');
          $slideImg = $slideForm.find('#slideImg');
          $slideImgLabel = $slideImg.siblings('label');
          $slideId = $slideForm.find('#slideId');
          $formSubmitBtn = $slideForm.find('.controls > .btn');


      $formSubmitBtn.on('click',function(){
            $('.has-error').removeClass('has-error');

            valid = true;
            
            var slideText = $slideText.val();
            var slideDesc = $slideDesc.val();
            var slideImg = $slideImg.val();

            if(slideText == ""){
              $slideText.closest('.form-group').addClass('has-error');
              valid = false;
            }
            if(slideDesc == ""){
              $slideDesc.closest('.form-group').addClass('has-error');
              valid = false;
            }
            if(slideImg == ""){
              $slideImg.closest('.form-group').addClass('has-error');
              valid = false;
            }

            if(valid){
              document.saveSlide.submit();
              $slideForm.slideUp('fast');
            }else{
              $slideForm.focus()
            } 
      });

      editBtn.on('click',function(){
          row = $(this).parents('tr');
            col = row.find('td');

            //Cache Row Info
            slideId = col.eq(0).text();
            slideText = col.eq(1).text();
            slideDesc = col.eq(2).text();
            slideImg = col.eq(3).text();

            //Set Slide Form
            $slideId.val(slideId);
            $slideText.val(slideText);
            $slideDesc.val(slideDesc);
            $slideImgLabel.text(slideImg);
            // $slideImg.val(slideImg);
            
           

            //Set Header
            $formHeader.text('Edit Slide '+ slideId);

            //Set Btn Text
            $formSubmitBtn.text('');
            $formSubmitBtn.text(' Save Changes');
            $formSubmitBtn.prepend($('<i class="fa fa-floppy-o" aria-hidden="true"></i>'));

            $slideForm.slideDown('fast');
      });

      addBtn.on('click',function(){
            //Set Slide Form
            $slideId.val('');
            $slideText.val('');
            $slideDesc.val('');
            $slideImgLabel.text('Choose An Image');

            //Set Header
            $formHeader.text('Add New Slide');

            //Set Btn Text
            $formSubmitBtn.text('');
            $formSubmitBtn.text(' Add Slide');
            $formSubmitBtn.prepend($('<i class="fa fa-plus" aria-hidden="true"></i>'));

            $slideForm.slideDown('fast');
      });

      deleteBtn.on('click',function(){
        slideId = parseInt($(this).parents('tr').find('td').eq(0).text());
        $row = $(this).parents('tr');
        $.post('deleteSlide.php', {slideID: slideId}, function(data){
        
          if(data === 'true'){
            $row.detach();
            $row = '';
          }else{
            console.log('Something went wrong with slide delete');
            $row.parents('.panel').prepend('Error Delete Slide');
            $row = '';          }
        });
      });

      $slideImg.on('change',function(){
        $slideImgLabel.text($(this).val());
      });


      /********************* Featured Member ************************/

      searchMemBtn = $('#setFeatMemberForm').find('.controls .btn');
      saveFeatMem = $('.saveFeatMem');

      searchMemBtn.on('click',function(){
          setTimeout(function(){
              $('#memSearchResults').slideDown('fast');
          },500);
      });

      saveFeatMem.on('click',function(){
          $(this).parents('.panel').slideUp('fast');
      });

      /********************* Featured Video ************************/

      saveFeatVidBtn = $('.saveFeaturedVideoBtn');

      saveFeatVidBtn.on('click',function(){
          $('.has-error').removeClass('has-error');

            valid = true;
            
            var featVidLink = $('#featVidLink').val();
            var scheduleFeatVideo = $("input[name='scheduleFeatVideo']:checked"). val();

            if(featVidLink == ""){
              $('#featVidLink').closest('.form-group').addClass('has-error');
              valid = false;
            }
            
            if(scheduleFeatVideo == "yes") {
                var featVideoStart = $('#featVideoStart').val();
                var featVideoEnd = $('#featVideoEnd').val();
                
                if(featVideoStart == ""){
                  $('#featVideoStart').closest('.form-group').addClass('has-error');
                  valid = false;
                }
                
                if(featVideoEnd == ""){
                  $('#featVideoEnd').closest('.form-group').addClass('has-error');
                  valid = false;
                }
            }
            

            if(valid){
              document.saveFeaturedVideo.submit();
              //$('#setFeatVideo').slideUp('fast');
            }else{
              $('#setFeatVideo').focus();
            } 
      });

      $('#repeatingVidYes').on('change', function(){
           $('#scheduleFeatVideo').slideDown('fast');
      });
      $('#repeatingVidNo').on('change',function(){
           $('#scheduleFeatVideo').slideUp('fast');
      });


      
    })();


