<?php 
	$con = mysqli_connect('localhost', 'root', '', 'tms');
	if(mysqli_connect_error()){
	    echo "
         	Cannot connect to DB    
	    ";
	exit();
   }
   
   $name = $_POST['t1'];
   $phoneNo = $_POST['t2'];
   
   
	$qry="INSERT INTO `location`(`name`, `mobile`, `lat`, `log`) VALUES ('$name','$phoneNo', '$lat', '$long')";
	mysqli_query($con,$qry);
	echo "Succ";
      
?>