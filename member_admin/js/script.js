//Table Row Link
$(document).ready(function($) {
      $('.navbar-toggle').click(function(){
      $('#nav-icon').toggleClass('open');
});

    formError = $('.form-group').find('input');
    formError.on('focus', formError, function(){
        $(this).parents('.form-group').removeClass('has-error');
        helpBlock = $(this).parents('.form-group').find('.error');
        helpBlock.detach();     
    });

    labelError = $('.form-group').find('input[type="file"]');
    labelError.on('change',function(){
        $(this).parents('.form-group').removeClass('has-error');
        helpBlock = $(this).parents('.form-group').find('.help-block.error');
        helpBlock.detach();
    });

  
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });


    // Edit Banner
    $('#editBannerBtn').on('click',function(){
        $('#editBanner').slideDown('fast');
    });

    $('#saveBannerImgBtn').on('click',function(){
        $('.has-error').removeClass('has-error');

            valid = true;
            
            var bannerText = $('#bannerText').val();
            var bennerDes = $('#bennerDes').val();
            var bannerImg = $('#bannerImg').val();

            if(bannerText == "" && !errorExists($('#bannerText'))){
                 formGroup = $('#bannerText').closest('.form-group');
                 formGroup.addClass('has-error').append('<p class="help-block error">This field can not be empty</p>');
                 valid = false;
            }
            if(bennerDes == "" && !errorExists($('#bennerDes'))){
                 formGroup = $('#bennerDes').closest('.form-group');
                 formGroup.addClass('has-error').append('<p class="help-block error">This field can not be empty</p>');
                  valid = false;
            }
            if(bannerImg == "" && !errorExists($('#bannerImg'))){
                 formGroup = $('#bannerImg').closest('.form-group');
                 formGroup.addClass('has-error').append('<p class="help-block error">Please click here and select new image</p>');
                 valid = false;
            }

            if(valid){
              document.saveBanner.submit();
              $('#editBanner').slideUp('fast');
            }else{
              $('editBanner').focus();
            } 
    });

    $('#bannerText').on('change',function(){
        previewCont = $('.banner-img-preview');
        bannerText = previewCont.find('.fs-header');
        bannerText.text($(this).val());
    });
    
    $('#bannerImg').on('change',function(){
        $(this).siblings('label').text($(this).val());
        loadImgToDom(this, $('.banner-img-preview').find('img'));
        //Maybe adjust image offset;    
    });

    $('th').click(function(){
    var table = $(this).parents('table').eq(0)
    var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
    this.asc = !this.asc
    if (!this.asc){rows = rows.reverse()}
    for (var i = 0; i < rows.length; i++){table.append(rows[i])}
    })
    function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
        }
    }
    function getCellValue(row, index){ return $(row).children('td').eq(index).html() }

});

//Select Drop Downs
(function(){
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
})();

function loadImgToDom(input, target) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          var img = target;
          img.attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

function deleteArray(table){
  rmArr = [];
  rows = table.find('tbody tr');
  rows.each(function(){
      select = $(this).find('td').last();
      select = select.find('input[type="checkbox"]');
      if(select.is(':checked')){
        rmArr.push(parseInt(select.val()));
      }
  });
  return rmArr;
}


function deleteRow(table){
  rows = table.find('tbody tr');
  rows.each(function(){
      select = $(this).find('td').last();
      select = select.find('input[type="checkbox"]');
      if(select.is(':checked')){
        $(this).detach();
      }
  });
}

function errorExists(elem){
  fg =  elem.parents('.form-group');
  if(fg.find('.error').length == 0){
    return false;
  }else{
    return true;
  }
}
