<?php
	//start our session
	//SESSION_START();
	
	//include helpers class
	require_once 'db.class.php';
	include 'helper.php';
	
	echo "hello";
	
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
		$sql = "UPDATE `parent` SET `token` = '" . $token . "' WHERE `parent`.`email` = '$emailAddress'";
		echo "SQL: " . $sql . "<br />";
		//send SQL call
		$r = mysqli_query($db->connection, $sql);
		if($r){
			echo "<br>token created";
		}else{
			echo "<br>ERROR: child ID NOT FOUND";
		}
	}
	
	
	//URL
	$url = "http://localhost/carlhacks/Archive/includes/php/forgotPasswordTokenPart.php?email=$emailAddress&token=$token";
	
	$content = "<p>GO TO THIS LINK TO RESET YOUR PASSWORD: $url</p>";
	
	echo $content;
	
	//sendMail($emailAddress, $content);
?>