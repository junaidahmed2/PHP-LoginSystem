<?php

$db_server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_database_name = "loginsystem";

//Create connection to database.
$connection = mysqli_connect($db_server_name, $db_username, $db_password, $db_database_name);

if(!$connection){
	echo "Error: could not connect to database. " . PHP_EOL;
}



