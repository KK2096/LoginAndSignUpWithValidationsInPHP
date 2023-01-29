<?php require('register.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./css/signstyle.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script>
        function onChange() {
            const password = document.querySelector('input[name=comp_password]');
            const confirm = document.querySelector('input[name=comp_confirm_pass]');
            if (confirm.value === password.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('Passwords do not match');
            }
        }
    </script>
    <title>AKSU Regisration Form </title> 
</head>
<body>


    <div class="container">
        <header>Registration</header>
        
        <form id="form" name="form" method="post" action="register.php">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Company Name</label>
                            <input name="company_name" id="inputCompName" type="text" placeholder="Enter company name" required>
                        </div>

                        <div class="input-field">
                            <label>Company Email</label>
                            <input name="company_email" id="inputCompEmail" type="email" placeholder="Enter company email" pattern="[a-zA-Z0-9][a-zA-z0-9_.]*@[a-zA-z]+([.][a-zA-z]+)+" required>
                        </div>

                        <div class="input-field">
                            <label>Contact Number</label>
                            <input name="company_cont_no" id="inputCompContNo" type="tel" id="phone" name="phone" placeholder="123-45-678" pattern="(0|91)?[7-9][0-9]{9}" required>
                        </div>
                    </div>
                </div>

                <br>
                <div class="details address">
                    <span class="title">Address Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Address</label>
                            <input name="company_add" id="inputCompAdd" type="text" placeholder="Company Address" required>
                        </div>

                        <div class="input-field">
                            <label>State</label>
                            <input name="company_state" id="inputCompState" type="text" placeholder="Enter your state" required>
                        </div>

                        <div class="input-field">
                            <label>District</label>
                            <input name="company_dist" id="inputCompDist" type="text" placeholder="Enter your district" required>
                        </div>
                </div>

                <br>
                <div class="details password">
                    <span class="title">Password Details</span>

                    <div class="fields">
                        <div class="input-field2">
                            <label>Password</label>
                            <input id="inputCompPass" name="comp_password" type="password" onChange="onChange()" placeholder="Create a password" required/>
                        </div>
                        <div class="input-field2">
                            <label>Confirm Password</label>
                            
                            <input name="comp_confirm_pass"  id="inputCompConfPass" type="password" onChange="onChange()" placeholder="Confirm password" required/>
                            
                        </div>
                    
                        <div class="butCent">
                            <button class="sumbit" name="register_btn">
                                <span class="btnText">Submit</span>
                            </button>
                        </div>
                        <div class="txtDown">
                            <span class="text">Already a member?
                                <a href="login_index.php" class="text login-link">Login Now</a>
                            </span>
                        </div>

                </div>
            </div>
        </form>
    </div>
</body>
</html>