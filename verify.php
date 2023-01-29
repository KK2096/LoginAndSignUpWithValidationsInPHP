<?php
    require('config.php');
    if(isset($_GET['email']) && isset($_GET['v_code'])){
        $sel_query = "SELECT * FROM `register` WHERE `company_email` = '$_GET[email]' AND `verification_code` = '$_GET[v_code]'";
        $result = mysqli_query($con, $sel_query);
        $num = mysqli_num_rows($result);
        $num = mysqli_num_rows($result);
        
        if($result){
            if($num == 1){
                $result_fetch = $result->fetch_assoc();
                if($result_fetch["is_verified"] == 0){
                    $update = "UPDATE `register` SET `is_verified` = 1 WHERE `company_email` = '$result_fetch[company_email]'";
                    if(mysqli_query($con,$update)){
                        echo"
                            <script>
                                alert('$result_fetch[company_name]- Email Verification Successfull');
                                window.location.href = 'login_index.php';
                            </script>
                        ";
                    }else{
                        echo"
                            <script>
                                alert('$result_fetch[company_name]- Email Verification Is Needed');
                                window.location.href = 'index.php';
                            </script>
                        ";
                    }
                }else{  
                    echo"
                        <script>
                            alert('$result_fetch[company_name]- Company Name Already Present');
                            window.location.href = 'login_index.php';
                        </script>
                    ";
                }
            }
        }else{
            echo"
                <script>
                    alert('Something Went Wrong In Verification');
                    window.location.href = 'index.php';
                </script>
            ";
        }
    }
?>