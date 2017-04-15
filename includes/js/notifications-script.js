$(document).ready(function()
{	
	$('body').delegate('#create', 'click', function()
	{
		var code = '<div class="holder">';
		code += '<i class="fa fa-window-close-o" aria-hidden="true"></i>';
		code += createInput("Notification Name", "text", "", "", "notify-name", false, "ie. Event A", true);
		code += createTextarea("Description", "", "", "notify-desc", false, "ie. Event A is for...", true);
		code += createInput("State", "text", "Minnesota", "", "notify-name", true, '', true);
		code += createDatepicker("Date", "text", "notify-date", true);
		code += createDatepicker("First Reminder", "text", "notify-first", false);
		code += createDatepicker("Second Reminder", "text", "notify-second", false);
		code += '<hr />';
		code += createButton("Create", "", "notify-create");
		code += '</div>';
		
		var overlay = createOverlay(code);
		
		// Append the code
		$('body').append(overlay);
		
		
		// Set datepickers
		//	$('#notify-date').datepicker();
		//$('#notify-first').datepicker();
		//$('#notify-second').datepicker();
	});
	$('body').delegate('.holder i', 'click', function()
	{
		$(".overlay-holder").remove();
	});
});