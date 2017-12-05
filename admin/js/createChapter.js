$(document).ready(function(){
      $('#meetingTime').timepicker();
      $('#meetingTimeEnd').timepicker();
      $('#paidEventNo').on('change', function(){
           $('#tickets').slideDown('fast');
      });
      $('#paidEventYes').on('change',function(){
           $('#tickets').slideUp('fast');
      });
      $('#oneDayYes').on('change',function(){
          $('#chapterEnd').slideUp('fast');
      });  
      $('#oneDayNo').on('change',function(){
          $('#chapterEnd').slideDown('fast');
      });

      $('#chapterImg').on('change',function(){
          loadImgToDom(this, $('.image-preview').find('img'));
        //Maybe adjust image offset;    
      });



      //Add Images

       // Cache Slide Table
      $table = $('#imgTable');
      controls = $table.find('.controls');
      editBtn = controls.find('.edit');
          console.log('editBtn');
          console.log(editBtn);
      addBtn = $('#addImg');
          console.log('addBtn');
          console.log(addBtn);
      deleteBtn = controls.find('.delete');

      // Cache Slide Form
      $slideForm = $('#editImgForm');
        $formHeader = $slideForm.find('.panel-heading').children().first();
          $slideText = $slideForm.find('#slideText');
          $slideDesc = $slideForm.find('#imgAlt');
          $slideImg = $slideForm.find('#imgFile');
          $slideImgLabel = $slideImg.siblings('label');
          $slideId = $slideForm.find('#imgID');
      
      $formSubmitBtn = $slideForm.find('.controls > .btn');


      $formSubmitBtn.on('click',function(){
            $('.has-error').removeClass('has-error');

            valid = true;
            
            var slideText = $slideText.val();
            var slideDesc = $slideDesc.val();
            var slideImg = $slideImg.val();
            var imgID = $('#imgID').val()
            var chapterID = $('#chapterID').val()



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
              document.saveGalleryImageForm.submit();
              $slideForm.slideUp('fast');
            }else{
              $slideForm.focus()
            } 
      });


      editBtn.on('click',function(){
         console.log('edit');
          row = $(this).parents('tr');
            col = row.find('td');

            //Cache Row Info
            slideId = col.eq(0).text();
            slideDesc = col.eq(1).text();
            slideImg = col.eq(2).text();

            //Set Slide Form
            $slideId.val(slideId);
            $slideDesc.val(slideDesc);
            $slideImgLabel.text(slideImg);

            //Set Header
            $formHeader.text('Edit Image '+ slideId);

            //Set Btn Text
            $formSubmitBtn.text('');
            $formSubmitBtn.text(' Save Changes');
            $formSubmitBtn.prepend($('<i class="fa fa-floppy-o" aria-hidden="true"></i>'));

            $slideForm.slideDown('fast');
      });

      addBtn.on('click',function(){
          console.log('add');
            //Set Slide Form
            $slideId.val('');
            $slideText.val('');
            $slideDesc.val('');
            $slideImgLabel.text('Choose An Image');

            //Set Header
            $formHeader.text('Add Image');

            //Set Btn Text
            $formSubmitBtn.text('');
            $formSubmitBtn.text(' Add Image');
            $formSubmitBtn.prepend($('<i class="fa fa-plus" aria-hidden="true"></i>'));

            $slideForm.slideDown('fast');
      });

      deleteBtn.on('click',function(){
        var row = $(this).parents('tr');
        var imgID = row.find('td').first().text();
        
        $.ajax({
          url: 'deleteChapterGalleryImg.php',
          type: 'POST',
          dataType: 'xhr',
          data: {
            imgId: imgID},
        })
        .done(function(data) {
        });
        
          row.detach();
        
      });

      $slideImg.on('change',function(){
        $slideImgLabel.text($(this).val());
      });

      //Speaker Leader

      searchMemBtn = $('#searchUsers').find('.controls .btn');
      saveFeatMem = $('.saveFeatMem');

      searchMemBtn.on('click',function(){
          setTimeout(function(){
              $('#memSearchResults').slideDown('fast');
          },500);
      });

      saveFeatMem.on('click',function(){
          $(this).parents('.panel').slideUp('fast');
      });
      
$('.saveChapterBtn').on('click', function(){
    console.log('hi');

    valid = true;

    chapterImg = $('#chapterImg').val();
    chapterName = $('#chapterName').val();
    chapterAddress = $('#chapterAddress').val();
    chapterCity = $('#chapterCity').val();
    chapterZip = $('#chapterZip').val();
    meetingDay = $('#meetingDay').val();
    meetingTime = $('#meetingTime').val();
    meetingTimeEnd = $('#meetingTimeEnd').val();

    // if(chapterImg == ""){
    //   $('#chapterImg').closest('.form-group').addClass('has-error');;
    //   valid=false;
    // }
    if(meetingDay == ""){
      $('#meetingDay').closest('.form-group').addClass('has-error');
      valid=false;
    }
    if(meetingTime == ""){
      $('#meetingTime').closest('.form-group').addClass('has-error');
      valid=false;
    }
    if(meetingTimeEnd == ""){
      $('#meetingTimeEnd').closest('.form-group').addClass('has-error');
      valid=false;
    }

    if(chapterName == ""){
      $('#chapterName').closest('.form-group').addClass('has-error');
      valid=false;
    }
    if(chapterAddress == ""){
      $('#chapterAddress').closest('.form-group').addClass('has-error');
      valid=false;
    }
    if(chapterCity == ""){
      $('#chapterCity').closest('.form-group').addClass('has-error');
      valid=false;
    }
    if(chapterZip == ""){
      $('#chapterZip').closest('.form-group').addClass('has-error');
      valid=false;
    }

    if(valid){
      document.saveChapterForm.submit();
    }else{
      $('#saveChapterForm').focus();
      $('#saveChapterForm').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out all fields highlighted in Red.</div>');
    }
});

    });