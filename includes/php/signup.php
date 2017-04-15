<?php 
/*
	This file handles the post method of sending data from the user to the parent
*/
	//Check if I have connection to the database
	//include("mysqli_connect.php");
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
		$lastName = $_POST['firstName'];
		$phone = $_POST['phoneNumber'];
		$email = $_POST['emailAddress'];
		$password = $_POST['password'];
		$dob = $_POST['dob'];
		$addressOne = $_POST['addressOne'];
		$addressTwo = $_POST['addressTwo'];
		$addressCity = $_POST['addressCity'];
		$state = $_POST['state'];
		$postal = $_POST['postal'];
		//$fullAddress = $addressOne + " " + $addressTwo + " " + $addressCity + " " + $state + " " + $postal;
		
		//generate the SQL call to add data to the parent table
		$sql = "INSERT INTO parent 
			(parentID, 
			firstName, 
			lastName, 
			DOB,
			phoneNumber, 
			address,
			address2,
			city,
			state,
			zip,
			email, 
			password,
			isVerified, 
			token, 
			dateCreated, 
			dateUpdated, 
			lastLogin) 
			VALUES 
			(NULL, 
			'$firstName', 
			'$lastName', 
			'$dob',
			'$phone', 
			'$addressOne', 
			'$addressTwo', 
			'$addressCity', 
			'$state', 
			'$postal',
			'$addressOne', 
			'$email', 
			'$password',
			'0', 
			'', 
			CURRENT_TIMESTAMP, 
			CURRENT_TIMESTAMP, 
			'0000-00-00 00:00:00.000000')";
			
		$r = mysqli_query($db->connection, $sql);
		if($r){
			echo "win";
		}else{
			echo "lose";
		}
	}
?>