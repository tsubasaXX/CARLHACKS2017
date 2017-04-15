$(document).ready(function()
{
	// Start form
	var form = '<div class="form">';
	
	// Create the inputs
	form += createInput('First Name', 'text', '', '', 'firstName', false, 'ie. John', true);
	form += createInput('Last Name', 'text', '', '', 'lastName', false, 'ie. Smith', true);
	form += createInput('Phone Number', 'text', '', '', 'phoneNumber', false, 'ie. 123-456-7890', true);
	form += createInput('Email Address', 'email', '', '', 'emailAddress', false, 'ie. john.smith@example.com', true);
	form += createInput('Password', 'password', '', '', 'password', false, '', true);
	form += createInput('Confirm Password', 'password', '', '', 'confirmPassword', false, '', true);
	form += createInput('Date of Birth', 'text', '', '', 'dob', false, 'ie. MM/DD/YYYY', true);
	form += createInput('Address One', 'text', '', '', 'addressOne', false, 'ie. 123 Awesome St.', true);
	form += createInput('Address Two', 'text', '', '', 'addressTwo', false, 'ie. APT 123.');
	form += createInput('City', 'text', '', '', 'adressCity', false, 'ie. Cool Town', true);
	form += createInput('State', 'text', 'MN', '', 'state', true, '', true);
	form += createInput('Postal', 'text', '', '', 'postal', false, 'ie. 12345-6789', true);
	
	// Create the button
	form += createButton('Sign Up!', '', 'signUp');
	
	// End form
	form += '</div>';
	
	// Append the form
	$('#content').append(form);
	
	// Clear empty attrs
	clearAttributes();
	
	// Event handler for sign up button being pressed
	$('body').delegate('#signUp', 'click', function()
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
		// Check the passwords
		if(dataArray[4] != dataArray[5])
		{
			// Push the error
			errors.push("Passwords do not match!");
		}
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
				url: "includes/php/signup.php",
		
				// Method type
				method: "POST",
		
				// Target file's type
				//dataType: type,
		
				// Data to be sent to the file
				data: 
				{
					firstName : dataArray[0],
					lastName : dataArray[1],
					phoneNumber :dataArray[2],
					emailAddress :dataArray[3],
					password :dataArray[4],
					dob :dataArray[6],
					addressOne :dataArray[7],
					addressTwo :dataArray[8],
					addressCity : dataArray[9],
					state : 'MN',
					postal : dataArray[10]
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