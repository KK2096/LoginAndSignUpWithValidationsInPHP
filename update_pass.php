<html>
<head>
  <meta charset="utf-8">
  <title>AKSU Logistic</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
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
                        <br>
                        <br>
                        <div class='login-root'>
                        <div class='box-root flex-flex flex-direction--column' style='min-height: 100vh;flex-grow: 1;'>
                        <div class='loginbackground box-background--white padding-top--64'>
                        <div class='loginbackground-gridContainer'>
                        <div class='box-root flex-flex' style='grid-area: top / start / 8 / end;'>
                        <div class='box-root' style='background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;'>
                        </div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 4 / 2 / auto / 5;'>
                            <div class='box-root box-divider--light-all-2 animationLeftRight tans3s' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 6 / start / auto / 2;'>
                            <div class='box-root box-background--blue800' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 7 / start / auto / 4;'>
                            <div class='box-root box-background--blue animationLeftRight' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 8 / 4 / auto / 6;'>
                            <div class='box-root box-background--gray100 animationLeftRight tans3s' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 2 / 15 / auto / end;'>
                            <div class='box-root box-background--cyan200 animationRightLeft tans4s' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 3 / 14 / auto / end;'>
                            <div class='box-root box-background--blue animationRightLeft' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 4 / 17 / auto / 20;'>
                            <div class='box-root box-background--gray100 animationRightLeft tans4s' style='flex-grow: 1;'></div>
                        </div>
                        <div class='box-root flex-flex' style='grid-area: 5 / 14 / auto / 17;'>
                            <div class='box-root box-divider--light-all-2 animationRightLeft tans3s' style='flex-grow: 1;'></div>
                        </div>
                        </div>
                    </div>
                    <div class='box-root padding-top--24 flex-flex flex-direction--column' style='flex-grow: 1; z-index: 9;'>
                        <div class='box-root padding-top--40 padding-bottom--24 flex-flex flex-justifyContent--center'>
                        <h1><a href='login_index.php'>AKSU Logistic</a></h1>
                        </div>
                        <div class='formbg-outer'>
                        <div class='formbg'>
                            <div class='formbg-inner padding-horizontal--48'>
                                <span class='padding-bottom--15'>Update Password</span>
                                <form method='post'>
                                <div class='field padding-bottom--24'>
                                <label for='password'>Password</label>
                                <input type='password' placeholder = 'New Password' name='Password' required>
                                </div>
                                <div class='field padding-bottom--24'>
                                <input type='submit' name='updatepassword' value='Update'>
                                <input type = 'hidden' name = 'company_email' value = '$emai_l'> 
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
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