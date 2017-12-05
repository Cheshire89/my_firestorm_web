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
});