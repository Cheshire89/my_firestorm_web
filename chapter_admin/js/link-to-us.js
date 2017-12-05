$(document).ready(function(){

   $('#linkImg').on('change',function(){
      $(this).siblings('label').text($(this).val());
   });

    $('#addLink').on('click',function(){
        valid = true;

        linkImg =$('#linkImg').val();
        linkName =$('#linkName').val();
        link =$('#link').val();

        if(linkImg == ''){
          $('#linkImg').closest('.form-group').addClass('has-error');
          valid = false;
        }
        if(linkName == ''){
          $('#linkName').closest('.form-group').addClass('has-error');
          valid = false;
        }
        if(link == ''){
          $('#link').closest('.form-group').addClass('has-error');
          valid = false;
        }


        if(valid){
            linksTable = $('#linksTable');
            row = linksTable.find('tbody tr').first().clone();
                cols = row.children('td');
                
                    img = cols.eq(0).find('img');

                    linkImg = document.getElementById('linkImg');
                        if (linkImg.files && linkImg.files[0]) {
                              var reader = new FileReader();

                              reader.onload = function (e){
                                img.attr('src', e.target.result);
                              }
                              reader.readAsDataURL(linkImg.files[0]);
                        }

                    name = cols.eq(1).text(linkName);
                    link = cols.eq(2).find('.code').text(link);
                    

                    select = cols.eq(3);
                        selectLabel = select.find('label');
                            selectLabel.attr('for', "sponsor" + cols.length);

                        selectInput = select.find('input');
                            selectInput.attr('id', "sponsor" + cols.length);
    

            body = linksTable.find('tbody');
            body.append(row);
        }        
    });

        $('#rmLink').on('click',function(){
            table = $('#linksTable');
            rows = table.find('tbody tr');
                rows.each(function(){
                    last = $(this).find('td').last();
                    if(last.find("input").is(':checked')){
                          last.parents('tr').detach();
                    }
                });
        });
    });
