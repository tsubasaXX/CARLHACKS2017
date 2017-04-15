$(document).ready(function()
{
	$("#login-btn").click(function()
	{
		// Start form
		var form = '<div class="form">';
	
		// Create the inputs
		form += createInput('Email Address', 'email', '', '', 'emailAddress', false, 'ie. john.smith@example.com', true);
		form += createInput('Password', 'text', '', '', 'password', false, '', true);
	
		// Create the button
		form += createButton('Log In!', '', 'logIn');
	
		// End form
		form += '</div>';
	
		// Create overlay
		var overlay = createOverlay(form);
		
		// Append the form
		$('body').append(overlay);
	
		// Clear empty attrs
		clearAttributes();
	});
	$('body').delegate('.overlay i', 'click', function()
	{
		$('.overlay-holder').remove();
	});
		// Event handler for sign up button being pressed
	$('body').delegate('.form #logIn', 'click', function()
	{
		// Initialize error array
		var errors = [];
		
		// Initialize the data array
		var dataArray = [];
		
		// Get all of the required fields
		$('input[required]').each(function()
		{
			// If blank push error message
			if(isEmpty(this.value))
			{
				// Push the errors
				errors.push(this.name + " field cannot be blank!");
			}
			else
			{
				// Push to the array
				dataArray.push(this.value);
			}
		});
		
		// If there are errors
		if(errors.length != 0)
		{
			// Show the errors
			showErrors(errors);
		}
		// Else if there are no errors
		else
		{
			// Clear errors
			clearErrors();
			
			$.ajax(
			{
				// Filepath to target
				url: "includes/php/login.php",
		
				// Method type
				method: "POST",
		
				// Target file's type
				//dataType: type,
		
				// Data to be sent to the file
				data: 
				{
					emailAddress : dataArray[0],
					password : dataArray[1],
				},
				// Success function
				success: function(returnData)
				{
					console.log(returnData);
				}
			});
		}
	});
});