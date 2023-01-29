<?php
    session_start();
    require('config.php');
    $company_email = $comp_password = "";
    if (isset($_POST['login_btn'])) {   
        
        $company_email = $_POST['company_email'];  
        $comp_password = $_POST['comp_password'];  
        
        // //to prevent from mysqli injection  
        $company_email = stripcslashes($company_email);  
        $comp_password = stripcslashes($comp_password);  
        $company_email = mysqli_real_escape_string($con, $company_email);  
        $comp_password = mysqli_real_escape_string($con, $comp_password); 
        
        $sele_query = "Select * from register where company_email = '$company_email'";
        $result = mysqli_query($con, $sele_query);
        $num = mysqli_num_rows($result);
        
        if($result){
            if($num == 1){
                $row = $result->fetch_assoc();
                if($row["is_verified"] == 1){
                    if (password_verify($comp_password, $row["password_comp"])) {
                        $comp_n = $row["company_name"];
                        echo "
                            <script>
                                alert('$comp_n - Welcome To AKSU Logistic');
                            </script>
                        ";
    
                        $_SESSION['logged_in'] = true;
                        $_SESSION['company_name'] = $row["company_name"];
                        header("location: dashboard.php");
    
                    } else {
                        echo"
                            <script>
                                alert('Wrong Password');
                                window.location.href = 'login_index.php';
                            </script>
                        ";
                    }
                }else{
                    echo"
                        <script>
                            alert('Email is not verified');
                            window.location.href = 'login_index.php';
                        </script>
                    ";
                }
            }else{
                echo"
                    <script>
                        alert('Company Email Is Not Register');
                        window.location.href = 'login_index.php';
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