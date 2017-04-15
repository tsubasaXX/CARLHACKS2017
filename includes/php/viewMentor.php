<?php
	// If mentor id is set and is no empty
	if(isset($_GET['mentorID']) && !empty($_GET['mentorID']))
	{
		// Require database class
		require_once 'db.class.php';
	
		// Create database object 
		$db = new Database();
	
		// Establish the connection
		$db->connect();
	
		// Selection query
		$q = "SELECT `firstName`, `lastName`, `DOB`, `mentor`.`address`, `phoneNumber`, `email`, `dateCreated`, `name` FROM `mentor` JOIN `school` WHERE `mentorID`='" . $_GET['mentorID']. "'";
	
		// Run the query
		$r = mysqli_query($db->connection, $q);
	
		// If successful
		if($r)
		{
			// If there was data returned
			if(mysqli_num_rows($r) > 0)
			{
				// While there is data to fetch
				while($row = mysqli_fetch_assoc($r))
				{
					echo '<div class="mentor-info">';
					echo '<img class="profile-pic" src="images/default.png" />';
					echo '<h2 class="mentor-name">' . $row['firstName'] . ' ' . $row['lastName'] . '</h2>';
					echo '<h4>' . $row['name'] . '</h4>';
					echo '<hr />';
					echo '<h2>Mentor Information</h2>';
					echo '<ul>';
					echo '<li>DoB: ' . $row['DOB'] . '</li>';
					echo '<li>Phone Number: ' . $row['phoneNumber'] . '</li>';
					echo '<li> Email Address: ' . $row['email'] . '</li>';
					echo '<li> Address: ' . $row['address'] . '</li>';
					echo '<li> Mentor Since ' . $row['dateCreated'] . '</li>';
					echo '</div>';
				}
			}
		}
	}
	// Else if mentor id is not set
	else
	{
		// Redirect user to list mentors
		header("Location: listMentors.php");
	}
?>