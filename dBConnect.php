<?php 
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'tms');

	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable To Connect');
?>