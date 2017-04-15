$(document).ready(function()
{
	// Load mentor data
	$.ajax(
	{
		// Filepath to target
		url: "includes/php/listMentors.php",
		
		data:
		{
			check : 'true'
		},
		// Success function
		success: function(returnData)
		{
			$('#content').append(returnData);
		}
	});
});