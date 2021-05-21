<?php 

	$title="Login";
	require('header.php');
	require('leftsidebar.php');
	session_start();
	include('config.php');
	error_reporting(0);
	if(isset($_POST['login'])) {
	    // Getting username/ email and password
	    $username=$_POST['username'];
	    $password=md5($_POST['password']);
	    // Fetch data from database on the basis of username/email and password
	    $sql ="SELECT username,password FROM users WHERE (username=:username) and (password=:password)";
	    $query= $dbh -> prepare($sql);
	    $query-> bindParam(':username', $username, PDO::PARAM_STR);
	    $query-> bindParam(':password', $password, PDO::PARAM_STR);
	    $query-> execute();
	    $results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0) {
	    	$_SESSION['userlogin']=$_POST['username'];
	  		echo "<script> document.location = 'user.php'; </script>";
	    } 
	    else {
	    	echo "<script>alert('Invalid Details');</script>";
	    }
	} 
		
?>
 
<!DOCTYPE html>
<html>
<head>
	<link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
	<style>
        .errorWrap {
		    padding: 10px;
		    margin: 0 0 20px 0;
		    background: #fff;
		    border-left: 4px solid #dd3d36;
		    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		.succWrap{
    		padding: 10px;
		    margin: 0 0 20px 0;
		    background: #fff;
		    border-left: 4px solid #5cb85c;
		    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
    </style>
</head>
<body>

	<form class="form-horizontal" id="loginForm" method="post">
		<div id="legend" style="padding-left:4%">
	    	<legend class=""> <a href="register.php">Register</a> | Login</legend> 
	    </div>
		<div class="form-group">
			<label for="username" class="control-label" style="padding-right: 20px">Username</label>
			<input type="text" class="form-control" id="username" name="username"  required="" title="Please enter you username" placeholder="username" >
			<span class="help-block"></span>
		</div>
		<div class="form-group">
			<label for="password" class="control-label" style="padding-right: 20px">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="" title="Please enter your password">
			<span class="help-block"></span>
		</div>
		<button type="submit" class="btn btn-success" style="margin-left: 180px;" name="login">Login</button>
	</form>
 
<?php 

	require('footer.php');

?> 