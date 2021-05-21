<?php 

	session_start();
	if (!isset($_SESSION['userlogin'])) {
		$_SESSION['msg']="Πρέπει να κάνεις login!";
		header("Location: login.php");
		exit();
	}

?>