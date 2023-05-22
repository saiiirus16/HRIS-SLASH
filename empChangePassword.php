
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/changepass.css">
    <title>Employee Change Password</title>
</head>
<body>



        <div class="emp-changepass-logo">
            <div class="changepass-logo" >
                <img src="img/Slash Tech Solutions.png" class="logo" alt="" srcset="" >   
            </div>
            <div class="changepass-login">
                <a href="login.php"  class="changepass-login-btn" style="text-decoration: none;">Login <i class="fa-solid fa-right-to-bracket" style="margin-bottom: -3px; margin-left: 5px;"></i></a>
            </div>
        </div>
        <div class="emp-changepass-container">
            <div class="emp-changepass-content">
                <div class="changepass-title">
                    <p  class="p-title">Change the password to your preferred credential.</p>
                </div>
                <form action="Data Controller/Employee List/changepasswordController.php" method="POST" id="changepassword-form">
                    <div class="changepass-form form-group" style="margin-top: 40px;">
                        <div class="form-group">
                            <label for="username">Username:</label><br>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" style="padding: 20px">
                        </div>
                        <div class="form-group">
                            <label for="oldpw">Old Password:</label><br>
                            <input type="password" name="password" class="form-control" placeholder="Enter Old Password" style="padding: 20px">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password:</label><br>
                            <input type="password" name="newPassword" class="form-control" placeholder="New Password" style="padding: 20px">
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm New password:</label><br>
                            <input type="password" name="cpassword" class="form-control" placeholder="Confirm New Password" style="padding: 20px">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update" name="update" class="form-control changepass-update">
                        </div>
                    </div>
                </form>
            </div>
        </div>


    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

</body>
</html>