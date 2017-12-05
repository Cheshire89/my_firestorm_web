$('.navbar-toggle').click(function(){
	$('#nav-icon').toggleClass('open');
});

$(document).ready(function() {
    $('#signUp').click(function() {
       var email = $('#signupEmail').val();
       if(email != "") {
           document.newsSignup.submit();
       } 
    });
    
    $('input, select, textarea').focus(function() {
    	$(this).closest('.form-group').removeClass("has-error");
    });
    
    $('#sendReferal').click(function() {
        
        $('.has-error').closet(".form-group").removeClass("has-error");
        
        var refer_page = $('#refer_page').val();
        var refer_name = $('#refer_name').val();
        var refer_email = $('#refer_email').val();
        var refer_phone = $('#refer_phone').val();
        var their_name = $('#their_name').val();
        var their_email = $('#their_email').val();
        var their_phone = $('#their_phone').val();
        var refMessage = $('#refMessage').val();
        var valid = true;

        if(refer_page != "") {
    		valid = false;
    		$('#refer_page').closest(".form-group").addClass("has-error");
    	}
        
        if(refer_name != "") {
    		valid = false;
    		$('#refer_name').closest(".form-group").addClass("has-error");
    	}
        
        if(refer_email != "") {
    		valid = false;
    		$('#refer_email').closest(".form-group").addClass("has-error");
    	}
        
        if(refer_phone != "") {
    		valid = false;
    		$('#refer_phone').closest(".form-group").addClass("has-error");
    	}
        
        if(their_name != "") {
    		valid = false;
    		$('#their_name').closest(".form-group").addClass("has-error");
    	}
        
        if(their_email != "") {
    		valid = false;
    		$('#their_email').closest(".form-group").addClass("has-error");
    	}
        
        if(their_phone != "") {
    		valid = false;
    		$('#their_phone').closest(".form-group").addClass("has-error");
    	}
        
        if(refMessage != "") {
    		valid = false;
    		$('#refMessage').closest(".form-group").addClass("has-error");
    	}

    	if(valid){
    		$.post("sendReferral.php", {field: field}, function(result) {
    			if(reply != "Error") {
    			     //do success, close popup in footer and show success message.
    			} else {
    			    $('.referForm').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oh no!</strong> Something has gone wrong, if you continue to experience this issue, please contact support.</div>');
    			}
    		});
    	} else {
    		$('.referForm').prepend('<div class="alert alert-warning alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong> Please fill out all fields highlighted in Red.</div>');
    	}
        
    });

    $('th').click(function(){
        var table = $(this).parents('table').eq(0)
        if($(this).text() == "Day") {
            var rows = table.find('tr:gt(0)').toArray().sort(day_comparer($(this).index()))
        } else {
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
        }
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
    function day_comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index);
            var compareA = getDayValue(valA), compareB = getDayValue(valB);
            return $.isNumeric(compareA) && $.isNumeric(compareB) ? compareA - compareB : compareA.localeCompare(compareB)
        }
    }
    function getDayValue(day) {
        switch(day) {
            case "Sunday":
                return 0;
                break;
            case "Monday":
                return 1;
                break;
            case "Tuesday":
                return 2;
                break;
            case "Wednesday":
                return 3;
                break;
            case "Thursday":
                return 4;
                break;
            case "Friday":
                return 5;
                break;
            case "Saturday":
                return 6;
                break;
        }
    }
    function getCellValue(row, index) { 
        return $(row).children('td').eq(index).text();
    }
});


// (function(){
// 	positionSignUpBtn();
// })();

// $(window).resize(function(event) {
// 	positionSignUpBtn();
// });
    
// function positionSignUpBtn(){
// 	holders = $('.sign-up .holder');
// 	firstHolder = holders.first();
// 				  contHeight = firstHolder.height();
// 	lastHolder = holders.last();
// 				  lastHolder.height(contHeight);

// 	holders.each(function(){
// 	  holderWidth = $(this).outerWidth();
// 	  btn = $(this).find('.btn');
// 	  btnWidth = btn.outerWidth();
// 		  offset = (holderWidth - btnWidth) /2 ;
// 		  btn.css('left',offset+'px');
// 	});
// }