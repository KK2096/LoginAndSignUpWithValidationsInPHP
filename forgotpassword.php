<?php
    require('config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email,$reset_token){
        //Load Composer's autoloader
        require ('PHPMailer/PHPMailer.php');
        require ('PHPMailer/SMTP.php');
        require ('PHPMailer/Exception.php');
        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'karankadam7784@gmail.com';                     //SMTP username
            $mail->Password   = 'bncseczrgqlmyeyx';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('karankadam7784@gmail.com', 'AKSU Logistic');
            $mail->addAddress($email); 
                 //Add a recipient
        
            
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password Reset Link From AKSU Logistic';
            $mail->Body    = "We got reset request from you to reset your password
                <br>
                Click the link below to reset password
                <br>
                <a href = 'http://localhost/Major Project/update_pass.php?email=$email&reset_token=$reset_token'>Reset Password</a>
                ";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }

    if (isset($_POST['forgot_btn'])) {
        $company_email = $_POST['company_email'];
        $query = "SELECT * FROM `register` WHERE `company_email` = '$company_email'";
        $result = mysqli_query($con, $query);
        $num = mysqli_num_rows($result);
        if($result){
            if($num == 1){
                $reset_token = bin2hex(random_bytes(16));
                date_default_timezone_set('Asia/kolkata');
                $date = date("Y-m-d");
                $upd_query = "UPDATE `register` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `company_email` = '$company_email'";
                if(mysqli_query($con, $upd_query) && sendMail($company_email,$reset_token)){
                    echo"
                        <script>
                            alert('Password Reset Link Sent To Entered Mail.. :)');
                            window.location.href = 'login_index.php';
                        </script>
                    ";
                }else{
                    echo"
                        <script>
                            alert('Server Down ! Try Again Later... :)');
                            window.location.href = 'forgot_index.php';
                        </script>
                    ";
                }
            }else{
                echo"
                    <script>
                        alert('Invalid Email Entered');
                        window.location.href = 'forgot_index.php';
                    </script>
                ";
            }
        }else{
            echo"
                <script>
                    alert('Something Went Wrong');
                    window.location.href = 'login_index.php';
                </script>
            ";
        }
        
    }
?>