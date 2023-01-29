<!DOCTYPE html>
<html lang = "eng">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AKSU Logistic</title>
        <!-- <link rel="stylesheet" type="text/css" href="./css/logstyle.css"> -->
        <style>

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                text-decoration: none;
                font-family: poppins;
                
            }
            form{
                position : absolute;
                top : 50%;
                left : 50%;
                transform : translate(-50%, -50%);
                background-color: #f0f0f0;
                width: 350px;
                border-radius: 5px;
                padding: 20px 25px 30px 25px;
                
            }
            form h3{
                margin-bottom: 15px;
                color: #30475e;
            }

            form input{
                width: 100%;
                margin-bottom: 20px;
                background-color: transparent;
                border: none;
                border-bottom: 2px solid #30475e;
                border-radius: 0;
                padding: 5px 0;
                font-weight: 550;
                font-size: 14px;
                outline: none;
            }

            form button{
                font-weight: 550;
                font-style: 15px;
                color: white; 
                background-color: #30475e;
                padding: 4px 10px;
                border: none;
                outline: none;
                
            }
        </style>
    </head>
    <body>
        <?php
            require('config.php');
            if(isset($_GET['email']) && isset($_GET['reset_token'])){
                date_default_timezone_set('Asia/kolkata');
                $date = date("Y-m-d");
                $emai_l = $_GET['email'];
                $res_tok = $_GET['reset_token'];
                $query = "SELECT * FROM `register` WHERE `company_email` = '$emai_l' AND `resettoken` = '$res_tok' AND `resettokenexpire` = '$date'";
                $result = mysqli_query($con, $query);
                $num = mysqli_num_rows($result);
        
                if($result){
                    if($num == 1){
                        echo "
                        <form method = 'POST'>
                            <h3> Create New Password </h3>
                            <input type = 'password' placeholder = 'New Password' name = 'Password'>
                            <button type = 'submit' name = 'updatepassword'>Update Password</button> 
                            <input type = 'hidden' name = 'company_email' value = '$emai_l'> 
                        </form>
                        ";
                    }else{
                        echo"
                            <script>
                                alert('Invalid or Expired Link');
                                window.location.href = 'login_index.php';
                            </script>
                        ";
                    }
                }else{
                    echo"
                        <script>
                            alert('Password Reset Link Sent To Entered Mail.. :)');
                            window.location.href = 'forgot_index.php';
                        </script>
                    ";
                }
            }
        ?>

        <?php 
            if(isset($_POST['updatepassword'])){
                $pass_has = password_hash($_POST['Password'], PASSWORD_BCRYPT);
                $update_quer = "UPDATE `register` SET `password_comp` = '$pass_has',`resettoken`= NULL,`resettokenexpire`= NULL WHERE `company_email`='$_POST[company_email]'";
                if(mysqli_query($con, $update_quer)){
                    echo"
                        <script>
                            alert('Password Updated Successfully.. :)');
                            window.location.href = 'login_index.php';
                        </script>
                    ";
                }else{
                    echo"
                        <script>
                            alert('Cant run now ! Please Try Again Later.. :)');
                            window.location.href = 'forgot_index.php';
                        </script>
                    ";
                }
            }
        ?>
    </body>
</html>
