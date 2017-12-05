$(document).ready(function(){
    /*
	$('.editable-row').each(function(index){
          cols = $(this).find('td');
            link = cols.eq(3);
            img = cols.eq(0).children('img');
            title = cols.eq(2);

          src = link.text();
          videoId = src.slice(src.indexOf('embed/') + "embed/".length, src.length);

          key = 'AIzaSyBL2a7BMD7NYRE2v1ukqBjw6yuB1pLwfhg';
          dataUrl = 'https://www.googleapis.com/youtube/v3/videos?id='+ videoId +'&key='+ key +'&part=snippet';
          
          $.ajax(dataUrl, {async:false}, function(){
          }).done(function(data){     
                
                snippet = data['items'][0].snippet;
                pullThumb = snippet.thumbnails.medium['url'];
                pullTitle = snippet['title']; 
         
                img.attr('src', pullThumb);
                img.attr('alt', pullTitle);
                title.text(pullTitle);  
                
          });
    });
    */
	
	$('#searchVideoBtn').on('click',function(){
        setTimeout(function(){
          $('#videoResults').slideDown('fast');
        },1000)
    });

    // Edit Video
    $('#videoResults').on('click','img',function(){
        row = $(this).parents('tr');
        cols = row.find('td');
          
        // Set Form

        editForm = $('#videoForm');
        btn = editForm.find('#saveVideoBtn');
        heading = editForm.find('.panel-heading h3');
        heading.text('Edit Video');


        titleField = editForm.find('#videoTitle');
        linkField = editForm.find('#videoLink');
        categoryField = editForm.find('#videoCategory');
        idField = editForm.find('#videoId');

        // Get Data

        vidthumb = cols.eq(0).children('img').attr('src');
        vidId = parseInt(cols.eq(1).text());
        vidTitle = cols.eq(2).text();
        vidLink = cols.eq(3).text();
        vidCategory = cols.eq(4).text();

        titleField.val(vidTitle);
        linkField.val(vidLink);
        categoryField.val(vidCategory);
        idField.val(vidId);

        btn.text('Save');
        btn.prepend('<i class="fa fa-floppy-o" aria-hidden="true"></i> ');

        $('#videoForm').slideDown('fast');
    });

    // Add Video
    $('#addVideo').on('click',function(){
        editForm = $('#videoForm');
        btn = editForm.find('#saveVideoBtn');
        heading = editForm.find('.panel-heading h3');
        heading.text('Add Video');


        titleField = editForm.find('#videoTitle');
        linkField = editForm.find('#videoLink');
        categoryField = editForm.find('#videoCategory');
        idField = editForm.find('#videoId');

        titleField.val('');
        linkField.val('');
        categoryField.val('');
        categoryField.attr('placeholder','Select Category');
        idField.val('');

        btn.text('Save');
        btn.prepend('<i class="fa fa-plus" aria-hidden="true"></i> ');

        $('#videoForm').slideDown('fast');
    });

    $('#saveVideoBtn').on('click',function(){
        $('#videoForm').slideUp('fast');
    });

    $('#rmVideo').on('click' , function(){
        deleteRow($('#videosTable'));
    });
});