<?php 
	$nameErr= $emailErr = $passError = "";

	$servername = "localhost";
	$username = "username";
	$password = "password";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 


	$fullname = $_POST("fullname");
	$username = $_POST("username");
	$email = $_POST("email");
	$password= $_POST("password");
	$confirmpassword = $_POST("confirmpassword");
	$fulladdress = $_POST("fulladdress");
	$postcode = $_POST("postcode");
	$phone = $_POST("phone");
	
	//SQL execute
	$sqlquery= "SELECT * FROM user WHERE email="+$email;
	$result1 = $conn->query($sqlquery);

	$sqlquery= "SELECT * FROM user WHERE username="+$username;
	$result2 = $conn->query($sqlquery);
	//Checking
	if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
	  $nameErr = "Only letters and white space allowed"; 
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  $emailErr = "Invalid email format"; 
	}else if($result1->num_rows > 0){
	  $emailErr = "Invalid email format"; 
	}
	if($password != $confirmpassword ){
		$passError = "Password did'nt match";
	}
	$conn->close();
	if(($nameErr= $emailErr)&&($emailErr= $passError)&&($emailErr="") ){
		header("Location: ../view/login.html");
		die();
	}
	if($result2->num_rows > 0){
	  $usernameErr = "Username was been used"; 
	}

 ?>