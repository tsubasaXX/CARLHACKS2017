<?php 
	require_once 'db.class.php';	
	
	// Create database object 
	$db = new Database();
	
	// Establish the connection
	$db->connect();
	
	//If I have receved a post request
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//collect user data
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$DOB = $_POST['DOB'];
		$addressOne = $_POST['addressOne'];
		$addressTwo = $_POST['addressTwo'];
		$addressCity = $_POST['addressCity'];
		$state = $_POST['state'];
		$postal = $_POST['postal'];
		$phoneNumber = $_POST['phoneNumber'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$schoolID = $_POST['schoolID'];
		
		//generate the SQL call to add data to the mentor table
		$sql = "INSERT INTO `mentor` 
		(`mentorID`, `firstName`, `lastName`, `DOB`, `address`, `address2`, `city`, `state`, `zip`, `phoneNumber`, `email`, `password`, `schoolID`, `dateCreated`, `dateUpdated`, `lastLogin`) 
		VALUES 
		(NULL, '$firstName', '$lastName', '$DOB', '$addressOne', '$addressTwo', '$addressCity', '$state', '$postal', '$phoneNumber', '$email', '$password', '$schoolID', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0000-00-00 00:00:00.000000');";
		
		$r = mysqli_query($db->connection, $sql);
		if($r){
			echo "Mentor added";
		}else{
			echo "ERROR: mentor not added";
		}
	}
?>