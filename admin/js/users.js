$(document).ready(function(){
	$('#rmMember, #rmProspect').on('click',function(){
		table = $(this).parents('.editable-table');
		row = table.find('tbody tr');
		row.each(function(){
			check = $(this).find('td').last();
			input = check.find('input[type="checkbox"]');
			if(input.is(':checked')){
				$(this).detach();
			}
		});
	});

	$('#approveProspects').on('click',function(){
		var approveArr = [];
		var checks = $('#manageUsers tbody tr td.controls input');
			
			checks.each(function(){
				if($(this).is(':checked')){
					approveArr.push($(this).attr('id'));
					$(this).parents('tr').detach();
				}
			});
		
			$.post('approveProspects.php', 
			{prospects: approveArr}, 
			function(data, textStatus, xhr) {
				
			});
	
	});

	$('#rmProspect').on('click',function(){
		var removeArr = [];
		var checks = $('#manageUsers tbody tr td.controls input');
			
		checks.each(function(){
			if($(this).is(':checked')){
				removeArr.push($(this).attr('id'));
				$(this).parents('tr').detach();
			}
		});
	
		$.post('archiveProspects.php', 
		{prospects: removeArr}, 
		function(data, textStatus, xhr) {
			
		});
	});
    
    $('#rmMember').click(function() {
        //prospects
        var deleteID = $("input[name='prospects']:checked"). val();
        document.location.href = 'deleteUser.php?id='+deleteID;
    });

});