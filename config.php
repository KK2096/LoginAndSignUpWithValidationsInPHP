<?php    
    $con = mysqli_connect('localhost', 'root', '', 'tms');
    if(mysqli_connect_error()){
        echo "
            <script>
                alert('Cannot connect to DB');
            </script>
        ";
    exit();
   }
   
?>