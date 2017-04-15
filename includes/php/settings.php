<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="../js/helper.js"></script>
		<script type="text/javascript" src="../js/settings-script.js"></script>


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
	
	// If parent id is set
	if(isset($_SESSION['id']))
	{		
		// Require database class
		require_once 'db.class.php';

		// Create database object 
		$db = new Database();

		// Establish the connection
		$db->connect();
			
		// If child is set
		if(isset($_GET['view']) && $_GET['view'] == "children")
		{
			// If parent
			if($_SESSION['role'] == "parent")
			{
				// Selection query
				$q = "SELECT 
				child.firstName AS cfname, 
				child.lastName AS clname, 
				child.school AS cschool 
				FROM child 
				JOIN parent_child ON child.childID = parent_child.childID
				WHERE parent_child.parentID =". $_SESSION['id'];
				
				// Run the query
				$r = mysqli_query($db->connection, $q);
	
				// If successful
				if($r)
				{
				// If there was data returned
				if(mysqli_num_rows($r) > 0)
				{
					// Start setting's list
					echo '<ul class="children">';
				
					// While there is data to fetch
					while($row = mysqli_fetch_assoc($r))
					{
						echo '<li class="child-info">';
						echo '<h3>Child Name: ' . $row['cfname'] .' ' . $row['clname'] .  '</h3>';
						echo '<h3>Child School: ' . $row['cschool'] . '</h3>';
						//echo '<h4>Mentor Name: ' . $row['mfname'] .' ' . $row['mlname'] .  '</h4>';
						echo '</li>';
					}	
					// End list
					echo '</ul>';
					
					if($_SESSION['role'] == "parent")
					{
						echo '<div class="add-new">';
						echo '<div class="heading">Add New Child</div>';
						echo '<div>';
						echo '<i class="fa fa-plus fa-2x" aria-hidden="true"></i>';
						echo '</div>';
					}
				}
			}
			}
			// Else if mentor
			else if($_SESSION['role'] == "mentor")
			{
				// Selection query
				$q = "SELECT 
				child.firstName AS cfname, 
				child.lastName AS clname, 
				child.school AS cschool,
				parent.firstName AS pfname,
				parent.lastName AS plname
				FROM child JOIN parent
				WHERE mentorID =". $_SESSION['id'];
				
				// Run the query
				$r = mysqli_query($db->connection, $q);
	
				// If successful
				if($r)
				{
					// If there was data returned
					if(mysqli_num_rows($r) > 0)
					{
						// Start setting's list
						echo '<ul class="children">';
				
						// While there is data to fetch
						while($row = mysqli_fetch_assoc($r))
						{
							echo '<li class="child-info">';
							echo '<h3>Child Name: ' . $row['cfname'] .' ' . $row['clname'] .  '</h3>';
							echo '<h3>Child School: ' . $row['cschool'] . '</h3>';
							echo '<h4>Parent Name: ' . $row['pfname'] .' ' . $row['plname'] .  '</h4>';
						echo '</li>';
					}	
					// End list
					echo '</ul>';
					
					if($_SESSION['role'] == "parent")
					{
						echo '<div class="add-new">';
						echo '<div class="heading">Add New Child</div>';
						echo '<div>';
						echo '<i class="fa fa-plus fa-2x" aria-hidden="true"></i>';
						echo '</div>';
					}
				}
			}
			}
			
		}
		// Else if the info is set
		else if(isset($_GET['view']) && $_GET['view'] == 'info')
		{
			// If posting
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				// Selection query
				$q = "UPDATE `parent` 
					SET `firstName` = '" . $_POST['firstName'] . "', 
					`lastName` = '" . $_POST['lastName'] . "', 
					`DOB` = '" . $_POST['DOB'] . "', 
					`phoneNumber` = '" . $_POST['phoneNumber'] . "', 
					`email` = '" . $_POST['email'] . "', 
					`address` = '" . $_POST['address'] . "', 
					`address2` = '" . $_POST['address2'] . "', 
					`city` = '" . $_POST['city'] . "', 
					`state` = '" . $_POST['state'] . "', 
					`zip` = '" . $_POST['zip'] . "'
					WHERE `parentID`=" . $_SESSION['id'];
					
				// Run the query
				$r = mysqli_query($db->connection, $q);
				
				// If successful
				if($r)
				{	
					echo "Personal information updated!";
				}
			}
			// Else if not posting
			else
			{
				// Selection query
				$q = "SELECT `firstName`, `lastName`, `DOB`, `phoneNumber`, `address`, `email`, `address`, `address2`, `city`, `state`, `zip` FROM `parent` WHERE `parentID`=" . $_SESSION['id'];

				// Run the query
				$r = mysqli_query($db->connection, $q);
	
				// If successful
				if($r)
				{
					// If there was data returned
					if(mysqli_num_rows($r) > 0)
					{
						// Start setting's list
						echo '<form action="settings.php?view=info" method="POST">';
				
						// While there is data to fetch
						while($row = mysqli_fetch_assoc($r))
						{
							echo '<div class="field-holder">';
							echo '<label for="firstName">First Name</label>';
							echo '<input id="firstName" name="firstName" placeholder="ie. John" required="" type="text" value="'.$row['firstName'].'" />';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="lastName">Last Name</label>';
							echo '<input id="lastName" name="lastName" placeholder="ie. Smith" required="" type="text" value="'.$row['lastName'].'" />';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="phoneNumber">Phone Number</label>';
							echo '<input id="phoneNumber" name="phoneNumber" placeholder="ie. 123-456-7890" required="" type="text"  value="'.$row['phoneNumber'].'" />';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="emailAddress">Email Address</label>';
							echo '<input id="emailAddress" name="email" placeholder="ie. john.smith@example.com" required="" type="email"  value="'.$row['email'].'" />';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="dob">Date of Birth</label>';
							echo '<input id="dob" name="DOB" placeholder="ie. MM/DD/YYYY" required="" type="text"  value="'.$row['DOB'].'"/>';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="address">Address</label>';
							echo '<input id="address" name="address" placeholder="ie. 123 Awesome St." required="" type="text"  value="'.$row['address'].'"/>';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="address2">Address 2</label>';
							echo '<input id="address2" name="address2" placeholder="ie. APT 123." type="text"  value="'.$row['address2'].'"/>';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="city">City</label>';
							echo '<input id="city" name="city" placeholder="ie. Cool Town" required="" type="text" value="'.$row['city'].'" />';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="state">State</label>';
							echo '<input id="state" name="state"  value="'.$row['state'].'" readonly="" required="" type="text" />';
							echo '</div>';
						
							echo '<div class="field-holder">';
							echo '<label for="zip">ZIP</label>';
							echo '<input id="zip" name="zip" placeholder="ie. 12345-6789" required="" type="text"  value="'.$row['zip'].'"/>';
							echo '</div>';
						
							echo '<button id="update">Update Personal Information</button>';
						}
						echo '</form>';
					}
				}
			}
		}
		// Else if the password is set
		else if(isset($_GET['view']) && $_GET['view'] == 'pass')
		{
			echo '<form method="POST" action="settings.php?view=pass">';
			echo '<div class="field-holder">';
			echo '<label for="old">Old Password</label>';
			echo '<input id="old" name="old" required="" type="password" />';
			echo '</div>';
			
			echo '<div class="field-holder">';
			echo '<label for="new">New Password</label>';
			echo '<input id="new" name="new" required="" type="password"  />';
			echo '</div>';
			
			echo '<div class="field-holder">';
			echo '<label for="confirm">Confirm Password</label>';
			echo '<input id="confirm" name="confirm" required="" type="password"  />';
			echo '</div>';
			
			echo '<button>Update Password</button>';
			echo '</form>';
			
			// If posting
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$old = $_POST['old'];
				$new = $_POST['new'];
				$confirm = $_POST['confirm'];
				
				// If passwords do not match
				if($new != $confirm)
				{
					//Display error
					echo '<div class="error-holder">Passwords do not match!</div>';
				}
				// Else if the passwords do match
				else
				{
					// Query to get password from db
					$q = "SELECT `parentID` FROM `parent` WHERE `password`='" . $old . "'";
					// Run the query
					$r = mysqli_query($db->connection, $q);
				
					// If query successful
					if($r)
					{
						// If there was data returned
						if(mysqli_num_rows($r) > 0)
						{
							// Query to updatte password
							$q2 = "UPDATE `parent` SET `password`='" . $new . "' WHERE `parentID`=" . $_SESSION['id'];
							
							// Run the query
							$r2 = mysqli_query($db->connection, $q2);
							
							// If successful
							if($r)
							{
								echo "Password Updated!";
							}
						}
						// Else if there was no data returned
						else
						{
							// Display error
							echo '<div class="error-holder">Old password is incorrect!</div>';
						}
					}
				}
			}
		}
		else
		{
			// If the user is a parent
			if($_SESSION['role'] == "parent")
			{
				echo '<ul class="settings">';
				echo '<li id="children">Children</li>';
				echo '<li id="info">Change Info</li>';
				echo '<li id="pass">Change Password</li>';
				//echo '<li>Submit Complaint</li>';
				//echo '<li>Cancel Service</li>';
				echo '</ul>';
			}
			// Els eif the user is a mentor
			else if($_SESSION['role'] == "mentor")
			{
				echo '<ul class="settings">';
				echo '<li id="children">Children</li>';
				echo '<li id="notify">Notification Menu</li>';
				echo '<li id="pass">Change Password</li>';
				//echo '<li>Submit Complaint</li>';
				//echo '<li>Cancel Service</li>';
				echo '</ul>';
			}
		}
	}
	else
	{
		header('Location: ../../index.html');
	}
	?>
	</body>
</html>