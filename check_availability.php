<?php

	require_once("config.php");
	// Code for checking username availabilty
	if(!empty($_POST["username"])) {
		$username= $_POST["username"];
		$sql ="SELECT username FROM  users WHERE username=:username";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':username', $username, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
		if($query -> rowCount() > 0) {
			echo "<span style='color:red'> Username already exists.</span>";
		} 
		else {
			echo "<span style='color:green'> Username available for Registration.</span>";
		}
	}
	// Code for checking email availabilty
	if(!empty($_POST["email"])) {
		$email= $_POST["email"];
		$sql ="SELECT email FROM  users WHERE email=:email";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':email', $email, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
		if($query -> rowCount() > 0) {
			echo "<span style='color:red'>Email already exists.</span>";
		} 
		else {
			echo "<span style='color:green'>Email available for Registration.</span>";
		}
	}

?>