<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['t1'];
   		$phoneNo = $_POST['t2'];
   		require_once('dBConnect.php');
   		$qry="INSERT INTO `location`(`name`, `mobile`, `lat`, `log`) VALUES ('$name','$phoneNo', Null, Null)";
   		if(mysqli_query($con,$qry)){
   			echo "Succ";
   		}else{
   			echo "Could not register";
   		}
	
	}else{
		echo "error";
	}
?>

request.setRetryPolicy(new DefaultRetryPolicy(
                10000, DefaultRetryPolicy.DEFAULT_MAX_RETRIES, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT
        ));