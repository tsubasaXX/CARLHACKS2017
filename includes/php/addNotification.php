<?php
	// If posting
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		// Start session
		session_start();
		$_SESSION['id'] = 3;
		$_SESSION['role'] = "mentor";
		
		// If session id is set and user role is mentor
		if(isset($_SESSION['id']) && $_SESSION['role'] == "mentor")
		{
			// Require database class
			require_once 'db.class.php';

			// Create database object 
			$db = new Database();

			// Establish the connection
			$db->connect();
		
			$notifyName = $_POST['name'];
			$description = $_POST['desc'];
			$dateOf = $_POST['date'];
			
			if(!isset($_POST['first']))
			{
				$first = '00-00-00';
			}
			else
			{
				$first = $_POST['first'];
			}
			if(!isset($_POST['second']))
			{
				$second = '00-00-00';
			}
			else
			{
				$second = $_POST['second'];
			}
	
			// Insertion query
			$q = "INSERT INTO `notifications`(`notifyName`, `description`, `dateOf`, `firstReminder`, `secondReminder`, `state`, `mentorID`) VALUES ('$notifyName', '$description', $dateOf, $first, $second, 'Minnesota',  ".$_SESSION['id'].")";
			
			// Run the query
			$r = mysqli_query($db->connection, $q);
			echo "Query: ". $q . "<br />";
			// If successful
			if($r)
			{
				echo "Query Ran";
			}
			else
			{
				echo "Failed";
			}
		}
		else
		{
			// Redirect
			header("Location: index.php");
		}
	}
	else
	{
		// Redirect
		header("Location: index.php");
	}
?>