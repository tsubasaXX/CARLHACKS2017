<?php
	//start our session
	//SESSION_START();
	
	//include helpers class
	include("includes/php/helper.php");
	
	
	
	// Create database object 
	$db = new Database();
	
	// Establish the connection
	$db->connect();
	
	//If I have receved a post request
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$emailAddress = $_POST['emailAddress'];
		//make a token
		$token = hash('ripemd160', rand());
		
		//get the id of child you just made
		$sql = "UPDATE `parent` SET `token` = '" . $token . "' WHERE `parent`.`email` = $emailAddress;";
		//send SQL call
		$r = mysqli_query($db->connection, $sql);
		if($r){
			echo "<br>token created";
		}else{
			echo "<br>ERROR: child ID NOT FOUND";
		}
	}
	
	//URL
	$url = "http://localhost/carlhacks/Archive/inclides/php/forgotPasswordTokenPart.php?email=$emailAddress&token=$token";
	
	$content = "<p>GO TO THIS LINK TO RESET YOUR PASSWORD: $url</p>"
	
	sendMail($emailAddress, $content);
?>