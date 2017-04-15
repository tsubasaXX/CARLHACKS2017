<?php 
	SESSION_START();
	$_SESSION['id'] = 4;
	
	// Require the database class
	require_once 'db.class.php';
	
	// Include the helper file
	include 'helper.php';
	
	// Create database object 
	$db = new Database();
	
	// Establish the connection
	$db->connect();
	
	echo '<form action="addChild.php" method="POST">';
	
	echo '<div class="field-holder">';
	echo '<label for="firstName">First Name *</label>';
	echo '<input id="firstName" name="firstName" placeholder="ie. John" required="" type="text" />';
	echo '</div>';

	echo '<div class="field-holder">';
	echo '<label for="lastName">Last Name *</label>';
	echo '<input id="lastName" name="lastName" placeholder="ie. Smith" required="" type="text" />';
	echo '</div>';

	echo '<div class="field-holder">';
	echo '<label for="emailAddress">Email Address</label>';
	echo '<input id="emailAddress" name="email" placeholder="ie. john.smith@example.com" type="email" />';
	echo '</div>';

	echo '<div class="field-holder">';
	echo '<label for="dob">Date of Birth *</label>';
	echo '<input id="dob" name="DOB" placeholder="ie. MM/DD/YYYY" required="" type="text"  />';
	echo '</div>';
	
	echo '<div class="field-holder">';
	echo '<label for="school">School *</label>';
	echo '<input id="school" name="school" placeholder="ie. Carlton College" required="" type="text"  />';
	echo '</div>';
	
	echo '<button>Add Child</button>';
	echo '</form>';
	
	//If I have receved a post request
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//collect user data
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$DOB = $_POST['DOB'];
		$email = $_POST['email'];
		$school = $_POST['school'];
		
		//generate the SQL call to add data to the mentor table
		
		//add child SQL
		$sql = "INSERT INTO `child` 
		(`childID`, `firstName`, `lastName`, `email`, `school`, `dateCreated`, `dateUpdated`) 
		VALUES 
		(NULL, '$firstName', '$lastName', '$email', '$school', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";

		//send SQL call
		$r = mysqli_query($db->connection, $sql);
		if($r){
			echo "<br>Child added";
		}else{
			echo "<br>ERROR: child not added";
		}
		
		//get the id of child you just made
		$sql2 = "SELECT childID FROM child WHERE firstName = '$firstName' AND lastName = '$lastName' AND email = '$email' AND school = '$school';";
		
		//send SQL call
		$r2 = mysqli_query($db->connection, $sql2);
	
		if($r2){
			while($row = mysqli_fetch_assoc($r2))
			{
				$childID = $row["childID"];
			}
		}
		//add to patent_child table
		$sql3 = "INSERT INTO `parent_child` (`parentID`, `childID`) VALUES (" . $_SESSION["id"] . ", " . "$childID);";
		
		$r3 = mysqli_query($db->connection, $sql3);
		if($r3)
		{
			echo "<h2>Successfully add child!</h2>";
		}
	}

?>