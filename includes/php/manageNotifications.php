<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../js/helper.js"></script>
		<script type="text/javascript" src="../js/notifications-script.js"></script>


		<link rel="stylesheet" type="text/css" href="../css/font-awesome-4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="../css/commons.css" />
	</head>
	<body>
<?php
	// Session start
	session_start();
	
	// Check the session data
	//require 'sesisonCheck.php';
	$_SESSION['id'] = 3;
	$_SESSION['role'] = "mentor";
	
	// If mentor id is set
	if(isset($_SESSION['id']))
	{		
		// Require database class
		require_once 'db.class.php';

		// Create database object 
		$db = new Database();

		// Establish the connection
		$db->connect();
		
		// Select all notifications from the database
		$q = "SELECT * FROM `notifications` WHERE `mentorID` =" . $_SESSION['id'];
		
		// Run the query
		$r = mysqli_query($db->connection, $q);
		
		// If successful
		if($r)
		{
			// If there was data returned
			if(mysqli_num_rows($r) > 0)
			{
				echo '<div class="holder">';
				
				// Fetch the data
				while($row = mysqli_fetch_assoc($r))
				{
					echo '<div class="notification" data-notifyID="' . $row['notifyID'] . '">';
					echo '<span class="notify-name">' . $row['notifyName']  . '</span>';
					echo '<p class="notify-desc">'. $row['description'] .'</p>';
					echo '<ul class="notify-info">';
					echo '<li>Date: ' . $row['dateOf'] . '</li>';
					echo '<li>First Reminder: ' . $row['firstReminder'] . '</li>';
					echo '<li>Second Reminder: ' . $row['secondReminder'] . '</li>';
					echo '<li>Location: ' . $row['state'] . '</li>';
					echo '</ul></div>';
				}
				// End 
				echo '</div>';
			}
			// Else if there was no data returned
			else
			{
				echo '<h3>No Notifications...</h3>';
			}
			// Create button
			echo "<button id=\"create\">Create A Notification</button>";
		}
	}
	else
	{
		// Redirect user
		header("Location: ../../index.html");
	}
?>