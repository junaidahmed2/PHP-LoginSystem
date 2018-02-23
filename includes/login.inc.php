<?php

//Start session.
session_start();

if(isset($_POST['submit'])){

	include_once 'dbh.inc.php';

	$username = mysqli_real_escape_string($connection, $_POST['uid']);
	$password = mysqli_real_escape_string($connection, $_POST['password']);

	//Check if inputs are empty.
	if(empty($username) || empty($password)){
		header("Location: ../index.php?login=empty");
		exit();
	}

	//Check if username exits.
	$sql = "SELECT * FROM users WHERE user_uid= '$username'";
	$result = mysqli_query($connection, $sql);
	$result_check = mysqli_num_rows($result);

	if($result_check == 0){
		header("Location: ../index.php?login=error");
		exit();
	}

	//Get results as array and check if passwords match.
	if($row = mysqli_fetch_assoc($result)){
		//Dehash password.
		$hashed_password_check = password_verify($password, $row['user_password']);

		//Check password.
		if($hashed_password_check == false){
			header("Location: ../index.php?login=error");
			exit();
		}

		//Log in user.
		elseif($hashed_password_check == true){

			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_first'] = $row['user_firstname'];
			$_SESSION['user_last'] = $row['user_lastname'];
			$_SESSION['user_email'] = $row['user_email'];
			$_SESSION['user_uid'] = $row['user_uid'];

			header("Location: ../index.php?login=success");
			exit();
		}

		else{
			echo "wtf";
		}
	}
}

else{
	header("Location: ../index.php");
			exit();
}
 


