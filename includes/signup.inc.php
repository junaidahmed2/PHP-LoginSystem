<?php

//Make sure sumbit button clicked.
if(isset($_POST['submit'])){

	include_once 'dbh.inc.php';

	$first_name = mysqli_real_escape_string($connection, $_POST['first']);
	$last_name = mysqli_real_escape_string($connection, $_POST['last']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$username = mysqli_real_escape_string($connection, $_POST['uid']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	//Check if inputs are not empty.
	if(empty($first_name) || empty($last_name) || empty($email) || empty($username)
	 || empty($password)){
		header("Location: ../signup.php?signup=empty");
		exit();
	}

	//Check if characters are valid.
	else if(!preg_match("/^[a-zA-Z]*$/", $first_name) || !preg_match("/^[a-zA-Z]*$/", $last_name)){
		header("Location: ../signup.php?signup=invalid");
		exit();
	}

	//Check if email is valid.
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		header("Location: ../signup.php?signup=email");
		exit();
	}

	//All valid.
	else{

		//Check if username already taken.
		$sql = "SELECT * FROM users WHERE user_uid= '$username'";
		$result = mysqli_query($connection, $sql);
		$result_check = mysqli_num_rows($result);

		if($result_check > 0){
			header("Location: ../signup.php?signup=userexists");
			exit();
		}

		//Hash password.
		$hashed_pasword = password_hash($password, PASSWORD_DEFAULT);

		//Insert user into databse.
		$sql = "INSERT INTO  users (user_firstname, user_lastname, user_email, user_uid, user_password) VALUES ('$first_name', '$last_name', '$email', '$username', '$hashed_pasword');";
		mysqli_query($connection, $sql);

		header("Location: ../signup.php?signup=success");
		exit();
	}
			
}
//Submit button not clicked, load sign up page.
else{
	header("Location: ../signup.php");
	exit();
}

