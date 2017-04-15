// Function to do an AJAX request
/*function doAJAX(url, data, method)
{
	// Convert to JSON string
	var dataArray = JSON.stringify(data);
	console.log(dataArray);
	// Start AJAX request
	$.ajax(
	{
		// Filepath to target
		url: url,
		
		// Method type
		method: method,
		
		// Target file's type
		//dataType: type,
		
		// Data to be sent to the file
		data: dataArray,
		
		// Success function
		success: function(returnData)
		{
			console.log(returnData);
			return returnData;
		}
	});
}*/
// Function to check session data
function sessionCheck()
{
	$.ajax(
	{
		// Filepath to target
		url: "includes/php/sessionCheck.php",

		// Method type
		method: "POST",
		
		success : function(data)
		{
			// If not logged in
			if(data != "true")
			{
				// Redirect user
				window.location = "login.html";
			}
		}
	});
}
// Function to create an overlay ~ input parameter is existing HTML code
function createOverlay(input)
{
	// Create the parent holder
	var code = '<div class="overlay-holder">';
	
	// Create the actual overlay
	code += '<div class="overlay">';
	code += '<i class="fa fa-window-close-o" aria-hidden="true"></i>';
	// Add the code
	code += input;
	
	// End the holder and overlay
	code += '</div></div>';
	
	// Append the code to the body
	$('body').append(code);
}
// Function to create a button
function createButton(value, className, idName)
{
	// Start button ~ check and add class and id, if any
	var button = '<button id="' + checkSetDefault(idName, "") + '" class="' + checkSetDefault(className, "") + '">';
	
	// Add the value
	button += value;
	
	// End the button
	button += '</button>';
	
	// Return the code
	return button;
}
// Function to create input field
function createInput(name, type, value, className, idName, isReadonly, placeholder, isRequired)
{
	// Start Fiel holder
	var code = '<div class="field-holder">';
	
	// Start label
	code += '<label for="' + idName + '">';
	code += name;
	code += '</label>';
	
	// Start input
	code += '<input ';
	
	// Add input type
	code +=' type="' + type + '"';
	
	// Add id if any
	code += ' id="' + checkSetDefault(idName, "") + '"';
	
	// Add class if any
	code += ' class="' + checkSetDefault(className, "") + '"';
	
	// Add name
	code += ' name="' + name + '"';
	
	// Add value
	code += ' value="' + value + '"';
	
	// Add value
	code += ' placeholder="' + placeholder + '"';
	
	// Check if is readonly
	if(isReadonly)
	{
		// Add attribute
		code += ' readonly';
	}
	// Check if is required
	if(isRequired)
	{
		// Add attribute
		code += ' required';
	}
	// End input
	code += ' />';
	code += '</div>';
	// Return code
	return code;
}
// Function to check value and if undefined set default value
function checkSetDefault(input, defaultValue)
{
	// If undefined
	if(input === undefined)
	{
		// Set default value
		input = defaultValue;
	}
	// Return value
	return input;
}
// Function to check is value is empty
function isEmpty(value)
{
	if(value == "" || !value)
	{
		return true;
	}
	else
	{
		return false;
	}
}
// Function to clear empty attributes ~ for cleaner code
function clearAttributes()
{
	// Attributes array
	var attr = ['id', 'class', 'value', 'placeholder'];
	
	// Iterate through the attributes
	for(var i = 0; i < attr.length; i++)
	{
		// Iterate through each id
		$('[' + attr[i] + ']').each(function()
		{
			// If the id is null or undefined
			if($(this).attr(attr[i] ) == "")
			{
				// Remove the attribute
				$(this).removeAttr(attr[i] );
			}
		});
	}
}
// Function to show errors
function showErrors(array)
{
	// Start list
	var list = '<ul class="errors">';
	
	// Iterate through the array
	for(var i = 0; i < array.length; i++)
	{
		// Add the error
		list += '<li>' + array[i] + '</li>';
	}
	// End list
	list += '</ul>';
	
	// Clear existing errors
	clearErrors();
	
	// Append the list
	$('body').append(list);
}
// Function to clear any errors
function clearErrors()
{
	// Clear existing list ~ if any
	$('.errors').remove();	
}