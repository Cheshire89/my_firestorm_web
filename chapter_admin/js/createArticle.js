$(document).ready(function(){
      $('#paidEventNo').on('change', function(){
           $('#tickets').slideDown('fast');
      });
      $('#paidEventYes').on('change',function(){
           $('#tickets').slideUp('fast');
      });
      $('#oneDayYes').on('change',function(){
          $('#articleEnd').slideUp('fast');
      });  
      $('#oneDayNo').on('change',function(){
          $('#articleEnd').slideDown('fast');
      });

      $('#articleImg').on('change',function(){
          loadImgToDom(this, $('.image-preview').find('img'));
        //Maybe adjust image offset;    
      });

$('.saveArticleBtn').on('click',function(){
    console.log('clicked');
    valid=true;

    articleImg = $('#articleImg').val();
    articleTitle = $('#articleTitle').val();
    articleBy = $('#articleBy').val();
    // articleCont = $('#articleCont').text();
    articleTags = $('#articleTags').val();

    // if(articleImg == ""){
    //   $('#articleImg').closest('.form-group').addClass('has-error');
    //   valid=false;
    // }

    if(articleTitle == ""){
      $('#articleTitle').closest('.form-group').addClass('has-error');
      valid=false;
    }
    if(articleBy == ""){
      $('#articleBy').closest('.form-group').addClass('has-error');
      valid=false;
    }
    // if(articleCont == ""){
    //   $('#articleCont').closest('.form-group').addClass('has-error');
    //   valid=false;
    // }
    if(articleTags == ""){
      $('#articleTags').closest('.form-group').addClass('has-error');
      valid=false;
    }

    console.log(valid);

    if(valid){
      document.saveArticleForm.submit();
    }else{
      $('#saveArticleForm').focus();
    }

});


    });

