<?php
	// Start session data
	session_start();
	
	// If session id is not set
	if(!isset($_SESSION['id']))
	{
		// Return false
		echo "false";
	}
	// Else if is set
	else
	{
		// Return true
		echo 'true';
	}
?>