<?PHP
	require_once 'db.class.php';
	
	$email = htmlspecialchars($_GET["email"]);
	$db = new Database();
	
	// Establish the connection
	$db->connect();
	
	//If I have receved a post request
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$newPassword = $_POST['newPassword'];
		//echo "newPassword = $newPassword";
		//$again = $_POST['again'];
		$sql = "UPDATE `parent` SET `password` = '$newPassword', `token` = '' WHERE `parent`.`email` = '$email';";
		echo "sql = $sql";
		//send SQL call
		$r = mysqli_query($db->connection, $sql);
		if($r){
			//echo "r = $r";
			echo "<br>PASSWORD UPDATED";
		}else{
			echo "<br>ERROR: PASSWORD NOT UPDATED";
		}
	}else{
		$token = htmlspecialchars($_GET["token"]);
		if(isset($token) && isset($email)){
			//get the id of child you just made
			$sql = "SELECT parentID FROM parent WHERE email = '$email' AND token = '$token';";
			
			//send SQL call
			$r = mysqli_query($db->connection, $sql);
			if($r){
				if(mysqli_num_rows($r) > 0){
					include("helper.php");
					echo "<form action='forgotPasswordTokenPart.php?email=$email&token=$token' method='post'>";
						text_field("newPassword");
						//text_field("again");
						submit("submit");
					echo "</form>";
				}else{
					echo "<p>This page has been accessed in error. re3<\p>";
				}
			}else{
				echo "<p>This page has been accessed in error. 314<\p>";
			}
		}else{
			echo "<p>This page has been accessed in error. 64f<\p>";
		}
	}
?>