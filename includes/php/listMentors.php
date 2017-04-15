<?php
	// If check is set
	if(isset($_GET['check']))
	{
		// Require database class
		require_once 'db.class.php';
	
		// Create database object 
		$db = new Database();
	
		// Establish the connection
		$db->connect();
	
		// Selection query
		$q = "SELECT `mentorID`, `firstName`, `lastName`, `name` FROM `mentor` JOIN `school`";
	
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
					echo '<div class="info-holder">';
					echo '<img class="profile-pic" src="images/default.png" />';
					echo '<h2 class="mentor-name"><a href="includes/php/viewMentor.php?mentorID=' . $row['mentorID'] . '">' . $row['firstName'] . ' ' . $row['lastName'] . '</a></h2>';
					echo '<h4>' . $row['name'] . '</h4>';
					echo '</div>';
				}
			}
		}
	}
	// Else if check is not check
	else
	{
		//Redirect to homepage
		header("Location: ../../index.html");
	}
?>