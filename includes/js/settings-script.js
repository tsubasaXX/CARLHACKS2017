$(document).ready(function()
{
	// Check session data
	sessionCheck();
	
	// Function for when a list item is clicked
	$('body').delegate('.settings li', 'click', function()
	{
		if(this.id != "")
		{
			window.location = "settings.php?view=" + this.id;
		}
	});
	// Function for when the add new child button is pressed
	$('.add-new').click(function()
	{
		window.location = 'addChild.php';
	});
});