<?php 
	
	require('logged_in.php');
	$title='User';
	require('header.php');
	require('leftsidebar.php');
	include('config.php');

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>User Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <style >
        .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}
    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	  	<div class="row">
	    <div class="span12">
	      	<div class="hero-unit center">
				<?php
				// Code for fecthing user full name on the bassis of username or email.
				$username=$_SESSION['userlogin'];
				$query=$dbh->prepare("SELECT  username FROM users WHERE (username=:username");
				    $query->execute(array(':username'=> $username));
				    while($row=$query->fetch(PDO::FETCH_ASSOC)){
				    	$username=$row['username'];
				    }
				    ?>
		        <h1>Welcome <font face="Tahoma" color="orange"><?php echo $username; ?> ! </font></h1>
		        <br/>
		        <p>Lorem ipsum dolor sit amet, sit veniam senserit mediocritatem et, melius aperiam complectitur an qui. Ut numquam vocibus accumsan mel. Per ei etiam vituperatoribus, ne quot mandamus conceptam has, pri molestiae constituam quaerendum an. In molestiae torquatos eam.
		        </p>
		        <a href="logout.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Log out</a>
	        </div>
	        <br/>
    	</div>
        <br/>
    </div>

<?php

	require('footer.php');

?>