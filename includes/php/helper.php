<?php
	// Send PHP email function
	function sendMail($token)
	{		
		// Add the date to the $content variable
		$content = "Thank you for registering on Project Friendship! \n";

		// Add the name to the $content variable
		$content .= "Please click on the link below to verify your account! \n";

		// Add the name to the $content variable
		$content .= "http: URL \n";
		// Generate token
		//	add to database base don email
		// send to user based on email
	
		// Require the PHPMailer class file
		require_once 'PHPMailer/class.phpmailer.php';

		// Initalize the PHPMailer object
		$mailer = new PHPMailer(true);
	
		// Try and send the email
		try
		{
			// Add the from email to the object
			$mailer->From = 'order@sandrakyang.com';
			$mailer->FromName = 'Recent Order';
		
			// Add the subject to the object
			$mailer->Subject = 'Your Order on www.sandrakyang.com';

			// Add the body to the object
			$mailer->Body = $content;
	
			// Add the to address to the object
			$mailer->AddAddress($email);

			// Add Sandy's BCC address's to the object
			$mailer->AddBCC('sky41694@gmail.com');
	
			// Add BSWebDesigns BCC address's to the object
			$mailer->AddBCC('support@bswebdesigns.net');
	
			// If there is a file to attach
			if($attachment == "true")
			{
				// File path of the image
				$path = $dir . "/IMG_" . date('m-d-Y') . "." . $extension;
		
				// Add attachment image
				$mailer->AddAttachment($path);
		
			}
			// If the email was not sent
			if(!$mailer->Send())
			{
				// Show the PHPMailer error
				//echo "Mailer Error: " . $mailer->ErrorInfo;
				echo 'mail-fail';
			}
			// Else if the message was sent.
			else
			{
				echo "mail-success";
			}
		}
		// Catch the error
		catch (phpmailerException $e) 
		{
			// Show the error message
			echo $e->getMessage();
		}
	}
	//REQUIRE VALUE
	function value_required($name) 
	{
		global $_ERRORS;
		if (empty($_POST[$name])) 
		{
			$_ERRORS[$name] = "is missing";
		}
	}

	//CAPS FIRST LETTER
	function humanize($name) 
	{
		$array = explode('_', $name);
		$array[0] = ucfirst($array[0]);
		return implode(' ', $array);
	}

	//TEXT FIELD
	function isaiah_thing($name, $description, $price){
		//echo "INSIDE";
		echo "<div class=\"inline_field\">\n";
		echo "<label for=\"$name\"><h2>" . humanize($name) . "</h2></label>\n";
		echo "<label for=\"$description\">" . humanize($description) . "</label>\n";
		echo "<br />QTY: <input type=\"text\" name=\"$name\" value=\"$value\">\n</div>\n";
		echo "<label id=\"price\">Price " . $price . "</label>";
		//echo '</div>';
	}
	function text_header($name) 
	{
		echo "<div class=\"inline_field\">\n";
		echo "<label for=\"$name\"><h2>" . humanize($name) . "</h2></label>\n";
		///if (isset($_POST[$name])) 
		//	$value = $_POST[$name];
		//else
			//$value = '';
		echo '</div>';
	}
	function description_field($name) 
	{
		echo "<div class=\"inline_field\">\n";
		echo "<label for=\"$name\">" . humanize($name) . "</label>\n";
		//if (isset($_POST[$name])) 
		//	$value = $_POST[$name];
		//else
			//$value = '';
		//echo "<br />QTY: <input type=\"text\" name=\"$name\" value=\"$value\">\n</div>\n";
		//echo "</div>";
	}
	function text_field($name) 
	{
		echo "<div class=\"inline_field\">\n";
		echo "<label for=\"$name\">" . humanize($name) . "</label>\n";
		//if (isset($_POST[$name])) 
		//	$value = $_POST[$name];
		//else
			$value = '';
		echo "<br /><input type=\"text\" name=\"$name\" value=\"$value\">\n</div>\n";
	}
	function text_field2($name) 
	{
		echo "<div class=\"inline_field\">\n";
		if (isset($_POST[$name])) 
			$value = $_POST[$name];
		else
			$value = '';
		echo "<input type=\"text\" name=\"$name\" value=\"$value\">\n</div>\n";
	}
	function text_field3($name) 
	{
		echo "<div class=\"inline_field\">\n";
		echo "<label for=\"$name\">" . humanize($name) . "</label>\n";
		if (isset($_POST[$name])){
			$value = $_POST[$name];
			}
		else{
			$value = '';
			}
		echo "<br /><input type=\"text\" name=\"$name\" value=\"$value\">\n</div>\n";
	}
	function text_field_default($name, $value2) {
		echo "<div class=\"inline_field\">\n";
		echo "<label for=\"$name\">" . humanize($name) . "</label>\n";
		if (isset($_POST[$name])) 
			$value = $_POST[$name];
		else
			$value = $value2;
		echo "<input type=\"text\" name=\"$name\" value=\"$value\">\n</div>\n";
	}

	//TEXT AREA
	function text_area($name, $message) 
	{
		echo "<div class=\"full_field\">\n";
		echo "<label for=\"$name\">" . humanize($message). "</label><br>";
		if (isset($_POST[$name])) 
			$value = $_POST[$name];
		else
			$value = '';
		echo "<textarea name=\"$name\">$value</textarea>\n</div>\n";
	}
	function text_area_default($name, $message, $value2) {
		echo "<div class=\"full_field\">\n";
		echo "<label for=\"$name\">$message</label><br>";
		if (isset($_POST[$name])) 
			$value = $_POST[$name];
		else
			$value = $value2;
		echo "<textarea name=\"$name\">$value</textarea>\n</div>\n";
	}

	//RADIO BUTTONS
	function radio_group($name, $buttons) {
		echo "<div class=\"inline_field\">\n";
		foreach ($buttons as $button) {
			echo "<label class=\"radio\"><input type=\"radio\" name=\"$name\" value=\"$button\"";
			if (isset($_POST[$name]) AND $_POST[$name] == $button) 
				echo " checked";
			echo ">" . humanize($button) . "</label>";
		}
		echo "</div>\n";
	}

	//DROP DOWN
	function dropDown($varname, $varoptions = array()){
		#$months = array (01 => 'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		echo "<div class=\"inline_field\">\n";
		//echo '<label for="',$varname,'">',$varname,'    </label>';
		echo '<select name="',$varname,'">';
		foreach ($varoptions as $key => $value) {
			echo "<option value=\"$key\">$value</option>\n";
		}
		echo '</select></div>';
	}

	//SUBMIT BUTTON
	function submit($text = 'Submit') {
		echo "<div class=\"inline_field\">\n";
		echo "<input type=\"submit\" value=\"$text\">\n</div>\n";
	}
?>