<?php  

   $empid = $_POST['empid'];
   $conn = new mysqli('localhost', 'root', '', 'hris_db');
   if($conn->connect_error){
    die('Connection Failed: '.$conn->connect_error);
   }else{
    $stmt = $conn->prepare("SELECT empid FROM employee_tb WHERE empid = ?");
    $stmt->bind_param("s", $empid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // empid already exists, display an error message
        echo "<script> alert('EMPLOYEE ID IS EXIST') </script>";
        exit;
        } else{
    
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
   $empschedule_type = $_POST['empschedule_type'];
   $empstart_date = $_POST['empstart_date'];
   $empend_date = $_POST['empend_date'];
   $empaccess_id = $_POST['empaccess_id'];
   $username = $_POST['username'];
   $role = $_POST['role'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];

   if($password != $cpassword){
     echo "Password is not match";
   }else{
   
        $stmt = $conn->prepare("INSERT INTO employee_tb (fname, lname, empid, address, contact, cstatus, gender, empdob, empsss, emptin, emppagibig, empphilhealth, empbranch, department_name, empposition, empbsalary, drate, approver, empdate_hired, emptranspo, empmeal, empinternet, empschedule_type, empstart_date, empend_date, empaccess_id, username, role, email, password, cpassword)
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssssssssssssssssssssss", $fname,  $lname, $empid, $address, $contact, $cstatus, $gender, $empdob, $empsss, $emptin, $emppagibig, $empphilhealth, $empbranch, $col_deptname, $empposition, $empbsalary, $drate, $approver, $empdate_hired, $emptranspo, $empmeal, $empinternet, $empschedule_type, $empstart_date, $empend_date, $empaccess_id, $username, $role, $email, $password, $cpassword);
        $stmt->execute();
        header("Location: ../../EmployeeList.php");
        $stmt->close();
        $conn->close();

    }
   }
   }


    // if(!$conn){
    //  echo '<script type="text/javascript">';
    //  echo 'alert("Connection Failed.");';
    //  echo '</script>';
    //  die;
    // } ekse
    

    // if(isset($_POST['submit'])){
    //     $fname = $_POST['fname'];
    //     $lname = $_POST['lname'];
    //     $empid = $_POST['empid'];
    //     $address = $_POST['address'];
    //     $contact = $_POST['contact'];
    //     $cstatus = $_POST['cstatus'];
    //     $gender = $_POST['gender'];
    //     $empdob = $_POST['empdob'];
    //     $empsss = $_POST['empsss'];
    //     $emptin = $_POST['emptin'];
    //     $emppagibig = $_POST['emppagibig'];
    //     $empphilhealth = $_POST['empphilhealth'];
    //     $empbranch = $_POST['empbranch'];
    //     $empdepartment = $_POST['empdepartment'];
    //     $empposition = $_POST['empposition'];
    //     $empbsalary = $_POST['empbsalary'];
    //     $approver = $_POST['approver'];
    //     $empdate_hired = $_POST['empdate_hired'];
    //     $emptransportation = $_POST['emptransportation'];
    //     $empmeal = $_POST['empmeal'];
    //     $empinternet = $_POST['empinternet'];
    //     $empschedule_type = $_POST['empschedule_type'];
    //     $empend_date = $_POST['empend_date'];
    //     $empaccess_id = $_POST['empaccess_id'];
    //     $username = $_POST['username'];
    //     $role = $_POST['role'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    //     $cpassword = $_POST['cpassword'];


    //     $stmt = $conn->prepare("INSERT INTO employee_tb (fname, lname, empid, address, contact, cstatus, gender, empdob, empsss, emptin, emppagibig, empphilhealth, empbranch, empdepartment, empposition, empbsalary, approver, empdate_hired, emptransportation, empmeal, empinternet, empschedule_type, empend_date, empaccess_id, username, role, email, password, cpassword)

    //             VALUES('$fname','$lname', '$empid', '$address', '$contact', '$cstatus', '$gender', '$empdob', '$empsss', '$emptin', '$emppagibig', '$empphilhealth', '$empbranch', '$empdepartment', '$empposition', '$empbsalary', '$approver', '$empdate_hired','$emptransportation ', '$empmeal', '$empinternet', '$empschedule_type', '$empend_date','$empaccess_id','$username','$role','$email','$password','$cpassword' )";
    //     $result = mysqli_query($conn, $sql));
    //     if($result){
    //         echo "<script> alert Data has been saved </script>";
    //     }else{
    //         die(mysqli_error($conn));
    //     }

    // }