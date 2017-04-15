<?php 
	// Define DATABASE credentials
	DEFINE('HOST', 'localhost');
	DEFINE('DATABASE', 'carlhacks');
	DEFINE('USER', 'root');
	DEFINE('PASSWORD', '');


	// Start class database
	class Database
	{
		// Function to establish a database connection
		public function connect()
		{
			// Connect to the database
			$this->connection =  mysqli_connect(HOST, USER, PASSWORD, DATABASE);
			
			// Set the charset
			mysqli_set_charset($this->connection, 'utf8');

			// If there is an error
			if (mysqli_connect_error()) 
			{
				// Stop conneciton and display error
				die("Database connection failed: " . mysqli_connect_error());
			}
		}
	}
?>