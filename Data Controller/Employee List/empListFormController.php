<?php  

    // $empidError = urlencode("Employee ID does exist. ");

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
        header("Location: ../../empListForm.php?empidError");
        die;
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
   $empaccess_id = $_POST['empaccess_id'];
   $username = $_POST['username'];
   $role = $_POST['role'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $cpassword = $_POST['cpassword'];

   $empschedule_type = $_POST['schedule_name'];
   $empstart_date = $_POST['sched_from'];
   $empend_date = $_POST['sched_to'];

//    $errorEmpty = false;
//    $errorEmail = false;

//     if(empty($fname) || empty($lname) || empty($empid) || empty($contact) || empty($email)){
//         echo "<span class='form-error'> Fill the fields! </span>";
//         $errorEmpty = true;
//         } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//             echo "<span class='form-error'> Write a valid email </span>";
//             $errorEmail = true;
//         } else{
//             echo "<span class='form-success'> Filled Succesfully </span>"; 
//         }
//     } else {
//         echo "There was an error!";
//     }
   if($password != $cpassword){  
    header("Location: ../../empListForm.php?passError");
    die;
   }else{
   
        $stmt = $conn->prepare("INSERT INTO employee_tb (`fname`, `lname`, `empid`, `address`, `contact`, `cstatus`, `gender`, `empdob`, `empsss`, `emptin`, `emppagibig`, `empphilhealth`, `empbranch`, `department_name`, `empposition`, `empbsalary`, `drate`, `approver`, `empdate_hired`, `emptranspo`, `empmeal`, `empinternet`, `empaccess_id`, `username`, `role`, `email`, `password`, `cpassword`)
                                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssssssssssssssssssss", $fname,  $lname, $empid, $address, $contact, $cstatus, $gender, $empdob, $empsss, $emptin, $emppagibig, $empphilhealth, $empbranch, $col_deptname, $empposition, $empbsalary, $drate, $approver, $empdate_hired, $emptranspo, $empmeal, $empinternet, $empaccess_id, $username, $role, $email, $password, $cpassword);
        $stmt->execute();
        $stmt->close();

        $stmt1 = $conn->prepare("INSERT INTO empschedule_tb (`empid`, `schedule_name`, `sched_from`, `sched_to`)
                                VALUES (?,?,?,?)");
        $stmt1->bind_param("ssss", $empid, $empschedule_type, $empstart_date, $empend_date);
        $stmt1->execute();
        $stmt1->close();
        header("Location: ../../EmployeeList.php");
        $conn->close();
    }
   }
}

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

