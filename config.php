<?php 

	define('DB_HOST','localhost:3308'); // Host name
	define('DB_USER','root'); // db user name
	define('DB_PASS',''); // db user password name
	define('DB_NAME','project'); // db name
	// Establish database connection.
	try {
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
	}
	catch (PDOException $e) {
		exit("Error: " . $e->getMessage());
	}

?>