<?php

include 'config.php';

// error_reporting(0);
session_start();

if(isset($_POST['signIn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $userType = $_POST['userType'];

    // $sql = "SELECT * FROM user_tb WHERE BINARY username = '$username' AND BINARY `password` = '$password'";
    // $result = mysqli_query($conn, $sql);
    //     if($result->num_rows > 0){
    //         $row = mysqli_fetch_assoc($result);
    //         $_SESSION['username'] = $row ['username'];
    //         $_SESSION['password'] = $row['password'];
    //         $_SESSION['userType'] = $row['userType'];
    //         $_SESSION['role'] = $row['role'];

            
    //         header("Location: Dashboard.php");
    //     }else{
    //         echo '<script type="text/javascript">';
    //         echo 'alert("Wrong Email or Password!");';
    //         echo '</script>';
    //     }

            // Query the employee table
        $employeeQuery = "SELECT * FROM employee_tb WHERE BINARY `username` = '$username' AND BINARY `password` = '$password' AND `role` = 'Employee'";
        $employeeResult = mysqli_query($conn, $employeeQuery);

        // Query the admin table
        $adminQuery = "SELECT * FROM employee_tb WHERE BINARY username = '$username' AND BINARY `password` = '$password' AND `role` = 'Admin'";
        $adminResult = mysqli_query($conn, $adminQuery);

        // Query the admin table
        $SuperadminQuery = "SELECT * FROM user_tb WHERE BINARY username = '$username' AND BINARY `password` = '$password'";
        $SuperadminResult = mysqli_query($conn, $SuperadminQuery);

        // Check if employee login is successful
        if (mysqli_num_rows($employeeResult) == 1) {
            // Start session and set user type
            $row_emp = mysqli_fetch_assoc($employeeResult);
            $_SESSION['id'] = $row_emp['id'];
            $_SESSION['username'] = $row_emp['username'];
            $_SESSION['password'] = $row_emp['password'];
            $_SESSION['empid'] = $row_emp['empid'];
             
            header("Location: EmpHRIS/Dashboard.php"); // Redirect to employee dashboard
            exit();
        }
        // Check if admin login is successful
        elseif (mysqli_num_rows($adminResult) == 1) {
            // Start session and set user type
            $row_emp = mysqli_fetch_assoc($employeeResult);
            $_SESSION['id'] = $row_emp['id'];
            $_SESSION['username'] = $row_emp['username'];
            $_SESSION['password'] = $row_emp['password'];
            $_SESSION['empid'] = $row_emp['empid'];
             
            header("Location: Dashboard.php"); // Redirect to employee dashboard
            exit();
            
        }
        else if (mysqli_num_rows($SuperadminResult) == 1){
            $row_Superadmin = mysqli_fetch_assoc($SuperadminResult);
            $_SESSION['username'] = $row_Superadmin ['username'];
            $_SESSION['password'] = $row_Superadmin['password'];
            $_SESSION['userType'] = $row_Superadmin['userType'];
            $_SESSION['role'] = $row_Superadmin['role'];
        
            header("Location: Dashboard.php"); // Redirect to admin dashboard
            exit();
        } else {
            // $errorMessage = "Invalid username or password";
            echo '<script type="text/javascript">';
                echo 'alert("Wrong Email or Password!");';
            echo '</script>';
        }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="backup/style.css">
    <title>HRIS | LOG IN</title>
</head>
<body class="login-container" style="overflow:hidden;">
    <div class="container">
        <div class="logo-img">
            <img src="img/bio5.jpg" alt="" srcset="">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#f4f4f4" fill-opacity="1" d="M0,64L48,74.7C96,85,192,107,288,101.3C384,96,480,64,576,74.7C672,85,768,139,864,133.3C960,128,1056,64,1152,64C1248,64,1344,128,1392,160L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
              </svg>
        </div>

        <div class="signin-container">
            <div class="signin-card">

                <div class="signin-logo-img">
                    <h1>HRIS</h1>
                </div>   
                
                <div class="form-container">
                    <form action="" method="POST">
                        <input class="input-text" type="text" name="username" id="" placeholder="Username" value="<?php echo @$username; ?>" required>
                        <input class="input-text" type="password" name="password" id="password" placeholder="Password" required>
                        <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                        <div class="remember-forgot">
                            <div class="chkbox-container">
                                <input class="checkbox" type="checkbox" name="" id="">
                                <p>Remember me</p>
                            </div>
        
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" name="signIn">Sign in </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
function toggle() {
  var password = document.getElementById("password");
  var eye = document.getElementById("eye");
  if (password.type === "password") {
    password.type = "text";
    eye.classList.remove("fa-eye");
    eye.classList.add("fa-eye-slash");
  } else {
    password.type = "password";
    eye.classList.remove("fa-eye-slash");
    eye.classList.add("fa-eye");
  }
}
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="main.js"></script>
</body>
</html>