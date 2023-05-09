<?php  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';

require '../../phpmailer/src/PHPMailer.php';

require '../../phpmailer/src/SMTP.php';

// Define an array to hold any validation errors
$errors = array();

// Check if the required fields are not empty
if (empty($_POST['fname'])) {
    $errors[] = 'First name is required';
}
if (empty($_POST['lname'])) {
    $errors[] = 'Last name is required';
}
if (empty($_POST['empid'])) {
    $errors[] = 'Employee ID is required'; 
}
// Add more checks for other required fields

// Check if the email is valid
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address';
}

// Check if the passwords match
if ($_POST['password'] != $_POST['cpassword']) {
    $errors[] = 'Passwords do not match';
}

// If there are any errors, display them and exit
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>alert('$error');</script>";
    }
    echo "<script>window.location.href = '../../empListForm.php';</script>";
    exit;
}
// If there are no errors, insert the data into the database
$conn = new mysqli('localhost', 'root', '', 'hris_db');

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$empid = $_POST['empid'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$cstatus = $_POST['cstatus'];
$gender = $_POST['gender'];
$empdob = $_POST['empdob'];
$empsss = $_POST['empsss'];
$emptin = $_POST['emptin'];
$emppagibig = $_POST['emppagibig'];
$empphilhealth = $_POST['empphilhealth'];
$empbranch = filter_input(INPUT_POST, "empbranch", FILTER_SANITIZE_STRING);
$col_deptname = filter_input(INPUT_POST, "col_deptname", FILTER_SANITIZE_STRING);
$empposition = filter_input(INPUT_POST, "empposition", FILTER_SANITIZE_STRING);
$empbsalary = $_POST['empbsalary'];
$drate = $_POST['drate'];
$approver = $_POST['approver'];
$empdate_hired = $_POST['empdate_hired'];
$emptranspo = $_POST['emptranspo'];
$empmeal = $_POST['empmeal'];
$empinternet = $_POST['empinternet'];
$empaccess_id = $_POST['empaccess_id'];
$username = $_POST['username'];
$role = $_POST['role'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

$empschedule_type = $_POST['schedule_name'];
$empstart_date = $_POST['sched_from'];
$empend_date = $_POST['sched_to'];

$conn = mysqli_connect("localhost", "root", "", "hris_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM employee_tb WHERE empid = ? OR empsss = ? OR emptin = ? OR emppagibig = ? OR empphilhealth = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("sssss", $empid, $empsss, $emptin, $emppagibig, $empphilhealth);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();

if ($count > 0) {
  // Display an error message and stop the script from continuing
  echo "<script>alert('Employee ID, SSN, TIN, Pag-IBIG, or PhilHealth already exists in the database.');</script>";
  echo "<script>window.location.href = '../../empListForm.php';</script>";

  exit;
}

$stmt->close();

$stmt = $conn->prepare("INSERT INTO employee_tb (`fname`, `lname`, `empid`, `address`, `contact`, `cstatus`, `gender`, `empdob`, `empsss`, `emptin`, `emppagibig`, `empphilhealth`, `empbranch`, `department_name`, `empposition`, `empbsalary`, `drate`, `approver`, `empdate_hired`, `emptranspo`, `empmeal`, `empinternet`, `empaccess_id`, `username`, `role`, `email`, `password`, `cpassword`)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("ssssssssssssssssssssssssssss", $fname, $lname, $empid, $address, $contact, $cstatus, $gender, $empdob, $empsss, $emptin, $emppagibig, $empphilhealth, $empbranch, $col_deptname, $empposition, $empbsalary, $drate, $approver, $empdate_hired, $emptranspo, $empmeal, $empinternet, $empaccess_id, $username, $role, $email, $password, $cpassword);

$stmt->execute();

if ($stmt->errno) {
    echo "<script>alert('Error: " . $stmt->error . "');</script>";
    echo "<script>window.location.href = '../../empListForm.php';</script>";
    exit;
}

$stmt->close();

$stmt1 = $conn->prepare("INSERT INTO empschedule_tb (`empid`, `schedule_name`, `sched_from`, `sched_to`)
                        VALUES (?,?,?,?)");
if (!$stmt1) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt1->bind_param("ssss", $empid, $empschedule_type, $empstart_date, $empend_date);

$stmt1->execute();

if ($stmt1->errno) {
    // Display an error message and stop the script from continuing
    echo '<script>alert("Error: Unable to insert data in empschedule_tb. Please try again.")</script>';
    echo "<script>window.location.href = '../../empListForm.php';</script>";
    exit;
  } else {
    // Both queries were successful, redirect to EmployeeList.php
    echo '<script>alert("Employee successfully added.")</script>';
    echo "<script>window.location.href = '../../empListForm.php';</script>";
    

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hris.payroll.mailer@gmail.com'; //gmail name
    $mail->Password = 'ndehozbugmfnhmes'; // app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('hris.payroll.mailer@gmail.com'); //gmail name

    $mail->addAddress($email);

    $mail->isHTML(true);

    $imgData = file_get_contents('../../panget.png');
    $imgData64 = base64_encode($imgData);
    $imgSrc = 'data:image/png;base64,' . $imgData64;
    $mail->Body .= '<img src="' . $imgSrc . '">';
   
    
    $mail->Body .= '<h1>Hello, ' . $fname . ' ' . $lname . '</h1>';
    $mail->Body .= '<h2>Your account has been successfully created. Enter your given credential to access the website.</h2>';
    $mail->Body .= '<h3>Your account details:</h3>';
    $mail->Body .= '<p>Username: ' . $username . '</p>';
    $mail->Body .= '<p>Password: ' . $password . '</p>';
    

    $mail->send();
  }

 
  $stmt1->close();
  $conn->close();
   
   ?>

   <!-- <script>
    $("#form-fname, #form-lname, #form-empid, #form-contact, #form-email").removeClass("input-error");

    var errorEmpty = "
    
    if(errorEmpty == true){
        $("#form-fname, #form-lname, #form-empid, #form-contact").addClass("input-error");
    }
    if(errorEmail == true){
        $("#form-email").addClass("input-error");        
    }
    if(errorEmpty == false && errorEmail == false){
        $("#form-fname, #form-lname, #form-empid, #form-contact").val("")
    }
   </script>
 -->

