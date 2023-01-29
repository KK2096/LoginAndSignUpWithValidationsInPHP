<?php
	if(isset($_GET['name']) && isset($_GET['phoneNo'])){
		require_once "connect.php";
		$name = $_GET['name'];
		$phoneNo = $_GET['phoneNo'];
		$qry="INSERT INTO `log` (`name`, `phoneNo`) VALUES ('$name','$phoneNo')";
   		if(!$conn->query($qry)){
   			echo "Fail";
   		}else{
   			echo "Succ";
   		} 
	}
	<html>
	<head></head>
	<body>
		<form>

		</form>
	</body>
	</html>
?>