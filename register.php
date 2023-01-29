<?php
    require('config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($email,$v_code){
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
            $mail->Subject = 'Email Verification From AKSU Logistic';
            $mail->Body    = "<b>Thanks for Registeration :) </b>
                Click the link below to verify the email address
                <br>
                <a href = 'http://localhost/Major Project/verify.php?email=$email&v_code=$v_code'>Verify</a>
                ";
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }


    $company_name = $company_email = $company_cont_no = $company_add = "";
    $company_state = $company_dist = $comp_password = "";

    if (isset($_POST['register_btn'])) {
        $company_name = $_POST['company_name'];
        $company_email = $_POST['company_email'];
        $company_cont_no = $_POST['company_cont_no'];
        $company_add = $_POST['company_add'];
        $company_state = $_POST['company_state'];
        $company_dist = $_POST['company_dist'];
        $comp_password = $_POST['comp_password'];
        

        $sql_u = "SELECT * FROM register WHERE company_name= '$company_name'" ;
        $sql_e = "SELECT * FROM register WHERE company_email ='$company_email'";
        $sql_c = "SELECT * FROM register WHERE contact_no ='$company_cont_no'";
        $res_u = mysqli_query($con, $sql_u);
        $res_e = mysqli_query($con, $sql_e);
        $res_c = mysqli_query($con, $sql_c);

        if (mysqli_num_rows($res_u) > 0) {
            echo"
                <script>
                    alert('$company_name - Company Name Already Present');
                    window.location.href = 'index.php';
                </script>
            ";
          }else if(mysqli_num_rows($res_e) > 0){
            echo "
                <script>
                    alert('$company_email - Company Email Already Present');
                    window.location.href = 'index.php';
                </script>
            ";
          }else if(mysqli_num_rows($res_c) > 0){
            echo "
                <script>
                    alert('$company_cont_no - Company Number Already Present');
                    window.location.href = 'index.php';
                </script>
            ";
          }else{
            $comp_password = password_hash($comp_password, PASSWORD_BCRYPT);
            $v_code = bin2hex(random_bytes(16));
            $ins_query = " INSERT INTO `register`(`company_name`, `company_email`, `contact_no`, `address_comp`, `state_comp`, `district_comp`, `password_comp`,`verification_code`, `is_verified`) VALUES ('$company_name','$company_email','$company_cont_no','$company_add','$company_state','$company_dist','$comp_password','$v_code','0   ')";
            $results = mysqli_query($con, $ins_query);
            $results_m = sendMail($company_email, $v_code);
            if($results && $results_m){
                echo "
                <script>
                    alert('$company_name - Registeration Successfull.. :)');
                    window.location.href = 'login_index.php';
                </script>
            ";
            }else{
                echo "
                <script>
                    alert('$company_name - Server Down..Try Again');
                    window.location.href = 'index.php';
                </script>
            ";
            }
          }
        
    }
?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- // $con = mysqli_connect("localhost", "root", "", "tms");
    // if (mysqli_connect_errno()) {
    //   printf("Connect failed: %s\n", mysqli_connect_error());
    //   exit();
    // }
    
    // $query = "SELECT * FROM `register` WHERE 'company_name' = '$_POST[company_name]' OR 'company_email' = '$_POST[company_email]'";
    // echo "<pre>Debug: $query</pre>\m";
    // $result = mysqli_query($con, $query);
    // if ( false===$result ) {
    //   printf("error: %s\n", mysqli_error($con));
    // }
    // else {
    //   echo 'done.';
    // }

    // if(isset($_POST['register_btn'])){
    //     $user_exist_query = "SELECT * FROM `register` WHERE 'company_name' = '$_POST[company_name]' OR 'company_email' = '$_POST[company_email]'";
    //     $result = mysqli_query($con, $user_exist_query);
    //     $kk = mysqli_num_rows($result);
    //     echo "$kk";
    //     // echo "$result";
    //     if($result){
    //         if(mysqli_num_rows($result) > 0){#it will be executed if company name and mail already register
    //             $result_fetch = mysqli_fetch_assoc($result);
    //             if($result_fetch['company_name'] == $_POST['company_name']){
    //                 //Execute when compnay name match
    //                 echo "
    //                     <script>
    //                         alert('$result_fetch[company_name] - Company Name Already Present');
    //                         window.location.href = 'signup.html';
    //                     </script>

    //                 ";
    //             }else{
    //                 //Execute when company_mail match
    //                 echo "
    //                     <script>
    //                         alert('$result_fetch[company_email] - Company Mail Already Present');
    //                         window.location.href = 'signup.html';
    //                     </script>
    //                 ";
    //             }
    //         }else{
    //             // $ins_query = "INSERT INTO `register`(`company_name`, `company_email`, `contact_no`, `address_comp`, `state_comp`, `district_comp`, `password_comp`) VALUES ('$_POST[company_name]', '$_POST[company_email]', '$_POST[company_cont_no]', '$_POST[company_add]', '$_POST[company_state]', '$_POST[company_dist]', '$_POST[comp_password]')'";
    //             // $ins_query = "INSERT INTO 'register' ('company_name', 'company_email', 'contact_no', 'address_comp', 'state_comp', 'district_comp', 'password_comp') VALUES ('$_POST[company_name]', '$_POST[company_email]', '$_POST[company_cont_no]', '$_POST[company_add]', '$_POST[company_state]', '$_POST[company_dist]', '$_POST[comp_password]')";
                
    //             // $ins_query = "INSERT INTO `register`(`sr_no`, `company_name`, `company_email`, `contact_no`, `address_comp`, `state_comp`, `district_comp`, `password_comp`, `created_at`) VALUES (0,'$_POST[company_name]', '$_POST[company_email]', '$_POST[company_cont_no]', '$_POST[company_add]', '$_POST[company_state]', '$_POST[company_dist]', '$_POST[comp_password]','2022-10-19')";
    //             // if(mysqli_query($con, $ins_query)){
    //             //     //If query run succ
    //             //     echo "
    //             //         <script>
    //             //             alert('Record Inserted Successfully');
    //             //             window.location.href = 'login.html';
    //             //         </script>
    //             //     ";
    //             // }else{
    //             //     //If data cant be inserted
    //             //     echo "
    //             //         <script>
    //             //             alert('Something went wrong.... Data Cant be inserted');
    //             //             window.location.href = 'signup.html';
    //             //         </script>
    //             //     ";
    //             // }

    //             echo "Chutiya banaya tumko";
    //         }
    //     }else{
    //         echo "
    //             <script>
    //                 alert('Something went wrong..'); 
    //                 window.location.href = 'signup.html';
    //             </script>
    //         ";
    //     }
    // }
        // $user_exist_query = "SELECT * FROM 'register' WHERE 'company_name' = '$_POST[company_name]' OR 'company_email' = '$_POST[company_email]'";
        // $result = mysqli_query($con, $user_exist_query);
        // // echo "$result";
        // if($result){
        //     echo "hii";
        // }else{
        //     echo "bye";
        // }
        // if($result){
            // if(mysqli_num_rows($result) > 0){#it will be executed if company name and mail already register
            //     $result_fetch = mysqli_fetch_assoc($result);
            //     if($result_fetch['company_name'] == $_POST['company_name']){
            //         //Execute when compnay name match
            //         echo "
            //             <script>
            //                 alert('$result_fetch[company_name] - Company Name Already Present');
            //                 window.location.href = 'signup.html';
            //             </script>
            //         ";
            //     }else{
            //         //Execute when company_mail match
            //         echo "
            //             <script>
            //                 alert('$result_fetch[company_email] - Company Mail Already Present');
            //                 window.location.href = 'signup.html';
            //             </script>
            //         ";
            //     }
            // }else{ #if uncommon username and mail id is there
            //     $ins_query = "INSERT INTO 'register' ('company_name', 'company_email', 'contact_no', 'address_comp', 'state_comp', 'district_comp', 'password_comp') VALUES ('$_POST[company_name]', '$_POST[company_email]', '$_POST[company_cont_no]', '$_POST[company_add]', '$_POST[company_state]', '$_POST[company_dist]', '$_POST[comp_password])'";
            //     if(mysqli_query($conn, $ins_query)){
            //         //If query run succ
            //         echo "
            //             <script>
            //                 alert('Record Inserted Successfully');
            //                 window.location.href = 'login.html';
            //             </script>
            //         ";
            //     }else{
            //         //If data cant be inserted
            //         echo "
            //             <script>
            //                 alert('Something went wrong.... Data Cant be inserted');
            //                 window.location.href = 'signup.html';
            //             </script>
            //         ";
            //     }
            // }        
        // }
        // else{
            
        //     echo "
        //         <script>
        //             alert('Something went wrong..'); 
        //             window.location.href = 'signup.html';
        //         </script>
        //     ";
        // }

    // }

    // *-
    // if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //     $user_exist_query = "SELECT * FROM 'register' WHERE 'company_name' = '$_POST[company_name]' OR 'company_email' = '$_POST[company_email]'";
    //     $result = mysqli_query($conn, $user_exist_query);

    //     if($result){
    //         if(mysqli_num_rows($result) > 0){
    //             $result_fetch = mysqli_fetch_assoc($result);
    //             if($result_fetch['company_name'] == $_POST['company_name']){
    //                 //Execute when compnay name match
    //                 echo "
    //                     <script>
    //                         alert('$result_fetch[company_name] - Company Name Already Present');
    //                         window.location.href = 'signup.html';
    //                     </script>
    //                 ";
    //             }else{
    //                 //Execute when company_mail match
    //                 echo "
    //                     <script>
    //                         alert('$result_fetch[company_email] - Company Mail Already Present');
    //                         window.location.href = 'signup.html';
    //                     </script>
    //                 ";
    //             }
    //         }
    //         else{ #if uncommon username and mail id is there
    //             $ins_query = "INSERT INTO 'register' ('company_name', 'company_email', 'contact_no', 'address_comp', 'state_comp', 'district_comp', 'password_comp') VALUES ('$_POST[company_name]', '$_POST[company_email]', '$_POST[company_cont_no]', '$_POST[company_add]', '$_POST[company_state]', '$_POST[company_dist]', '$_POST[comp_password])'";
    //             if(mysqli_query($conn, $ins_query)){
    //                 //If query run succ
    //                 echo "
    //                     <script>
    //                         alert('Record Inserted Successfully');
    //                         window.location.href = 'login.html';
    //                     </script>
    //                 ";
    //             }else{
    //                 //If data cant be inserted
    //                 echo "
    //                     <script>
    //                         alert('Something went wrong Data Cant be inserted');
    //                         window.location.href = 'signup.html';
    //                     </script>
    //                 ";
    //             }
    //         }
    //     }else{
    //         echo "
    //             <script>
    //                 alert('Something went wrong');
    //                 window.location.href = 'signup.html';
    //             </script>
    //         ";
    //     }
    // }
 -->

<!-- ?> -->