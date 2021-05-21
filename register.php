<?php 

	$title="Register";
	require('header.php');
	require('leftsidebar.php');
	//Database Configuration File
	include('config.php');
	error_reporting(0);
	if(isset($_POST['signup'])) {
		//Getting Post Values
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		// Query for validation of username and email
		$ret="SELECT * FROM users where (username=:uname || email=:uemail)";
		$queryt = $dbh -> prepare($ret);
		$queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
		$queryt->bindParam(':uname',$username,PDO::PARAM_STR);
		$queryt -> execute();
		$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
		if($queryt -> rowCount() == 0) {
			// Query for Insertion
			$sql="INSERT INTO users(username,email,password) VALUES(:uname,:uemail,:upassword)";
			$query = $dbh->prepare($sql);
			// Binding Post Values
			$query->bindParam(':uname',$username,PDO::PARAM_STR);
			$query->bindParam(':uemail',$email,PDO::PARAM_STR);
			$query->bindParam(':upassword',$password,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId) {
				$msg="You have signup Successfully";
			}
			else {
				$error="Something went wrong.Please try again";
			}
		}
		else {
			$error="Username or Email-id already exist. Please try again";
		}
	}
	/* RECAPTCHA PART
	if(isset($_POST['submit'])) {
		$username = $_POST['username'];
		$secretKey = "6LeZlN8aAAAAAGUtCwbISdrFVxbw5xTlNv7Ea6Bp";
		$responseKey = $_POST['g-recaptcha-response'];
		$userIP = $_SERVER['REMOTE_ADDR'];

		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
		$response = file_get_contents($url);
		$response = json_decode($response);
		if ($response->success)
			echo "Registration success.";
		else
			echo "Registration failed";
	}
	*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
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
	
	<!--Javascript for check username availability-->
	<script>
		function checkUsernameAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_availability.php",
		data:'username='+$("#username").val(),
		type: "POST",
		success:function(data){
		$("#username-availability-status").html(data);
		$("#loaderIcon").hide();
		},
		error:function (){
		}
		});
		}
	</script>
	<!--Javascript for check email availability-->
	<script>
		function checkEmailAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
		url: "check_availability.php",
		data:'email='+$("#email").val(),
		type: "POST",
		success:function(data){
		$("#email-availability-status").html(data);
		$("#loaderIcon").hide();
		},
		error:function (){
		 event.preventDefault();
		}
		});
		}
	</script>

</head>  
<body>

	<form class="form-horizontal" action='' method="post">
		<fieldset>
		    <div id="legend" style="padding-left:4%">
		    	<legend class="">Register | <a href="login.php">Login</a></legend>
		    </div>
			<!--Error Message-->
			<?php if($error){ ?><div class="errorWrap">
			    <strong>Error </strong> : <?php echo htmlentities($error);?></div>
	        <?php } ?>
			<!--Success Message-->
			<?php if($msg){ ?><div class="succWrap">
	            <strong>Well Done </strong> : <?php echo htmlentities($msg);?></div>
	        <?php } ?>
		    <div class="control-group">
			    <!-- Username -->
			    <label class="control-label"  for="username">Username</label>
			    <div class="controls">
			        <input type="text" id="username" name="username" onBlur="checkUsernameAvailability()"  pattern="^[a-zA-Z][a-zA-Z0-9-_.]{5,12}$" title="User must be alphanumeric without spaces 6 to 12 chars" class="input-xlarge" required>
			        <span id="username-availability-status" style="font-size:12px;"></span>
			        <p class="help-block">Username can contain any letters or numbers, without spaces 6 to 12 chars </p>
		    	</div>
		    </div>
		    <div class="control-group">
		      <!-- E-mail -->
		    <label class="control-label" for="email">E-mail</label>
			    <div class="controls">
				    <input type="email" id="email" name="email" placeholder="" onBlur="checkEmailAvailability()" class="input-xlarge" required>
				    <span id="email-availability-status" style="font-size:12px;"></span>
				    <p class="help-block">Please provide your E-mail</p>
		    	</div>
		    </div>
		    <div class="control-group">
		    	<!-- Password-->
		    	<label class="control-label" for="password">Password</label>
		    	<div class="controls">
	        		<input type="password" id="password" name="password" pattern="(?=^.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*[\\W_\\d]).*$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least one number and one uppercase and lowercase letter, and at least 8 or more characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"  required class="input-xlarge">
		        	<p class="help-block">Password should be at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
		    	</div>
		    </div>
		    <div class="control-group">
		    	<!-- Confirm Password -->
		    	<label class="control-label"  for="password_confirm">Password (Confirm)</label>
		    	<div class="controls">
		        <input type="password" id="password_confirm" name="password_confirm" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '')""  class="input-xlarge">
		        <p class="help-block">Please confirm password</p>
		    	</div>
		    </div>
		    <div class="control-group">
		    	<!-- Button -->
		    	<div class="controls">
		        	<button class="btn btn-success" type="submit" name="signup">Signup </button>
		        	<div class="g-recaptcha" data-sitekey="6LeZlN8aAAAAAF265vLRz24QQj-F6cPjGNArge1R"></div>
		    	</div>
		    </div>
	  	</fieldset>
	</form>

<?php 

	require('footer.php');

?>   