<?php 
    session_start();
?>  

<html?>
    <head>
        <title> AKSU Logistic </title>
    </head>

    <body>
        <?php 
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] = true){
              echo " <h1 style = 'text-align : center; margin-top : 200px'> Welcome To AKSU Logistic - $_SESSION[company_name] </h1>";
            }
        ?>
        <br>
        <br>
        <a href = 'logout.php'>Logout</a> 
    </body>
</html>