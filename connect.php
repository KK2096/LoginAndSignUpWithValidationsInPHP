<?php
	$server = "localhost";
	$user_name = "root";
	$password = "";
	$database = "tms";

	$conn = new mysqli($server, $user_name, $password, $database);
	if($conn -> connect_error){
		die("Connection failed ". $conn->connect_error);
	}
?>