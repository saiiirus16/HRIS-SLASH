
<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    }
    
    // $empid = $_POST['empid'];

    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "hris_db";
    
    $conn = mysqli_connect($server, $user, $pass, $database);
    
    if(isset($_FILES['emp_img'])) {
        $file_name = $_FILES['emp_img']['name'];
        $file_tmp = $_FILES['emp_img']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . "." . $file_ext;
        move_uploaded_file($file_tmp, "uploads/" . $new_file_name);
        echo '<img src="uploads/'.$new_file_name.'" alt="My Image">';
        $_POST['emp_img_url'] = $new_file_name; // add this line to set emp_img_url in $_POST
    }
    
    if(count($_POST) > 0){
        mysqli_query($conn, "UPDATE employee_tb SET fname='".$_POST['fname']."',lname='".$_POST['lname']."',contact='".$_POST['contact']."',cstatus='".$_POST['cstatus']."',gender='".$_POST['gender']."',empdob='".$_POST['empdob']."',empsss='".$_POST['empsss']."',emptin='".$_POST['emptin']."',emppagibig='".$_POST['emppagibig']."',empphilhealth='".$_POST['empphilhealth']."',empbranch='".$_POST['empbranch']."',department_name='".$_POST['department_name']."',empbsalary='".$_POST['empbsalary']."', otrate='".$_POST['otrate']."', empdate_hired='".$_POST['empdate_hired']."',emptranspo='".$_POST['emptranspo']."',empmeal='".$_POST['empmeal']."',empinternet='".$_POST['empinternet']."',schedule_name='".$_POST['schedule_name']."',role='".$_POST['role']."',email='".$_POST['email']."', sss_amount='".$_POST['sss_amount']."', tin_amount='".$_POST['tin_amount']."', pagibig_amount='".$_POST['pagibig_amount']."', philhealth_amount='".$_POST['philhealth_amount']."', bank_name='".$_POST['bank_name']."', bank_number='".$_POST['bank_number']."', emp_img_url='".$_POST['emp_img_url']."'
        WHERE id ='".$_POST['id']."'");
        header ("Location: EmployeeList.php");
    }
    $result = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id ='". $_GET['id']. "'");
    $row = mysqli_fetch_assoc($result);
    
    
?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List Form</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

        <?php 
        
        // $stmt = "SELECT * FROM employee_tb WHERE empid=$empid";
        // $result = mysqli_query($conn, $stmt);
        // $row = mysqli_fetch_assoc($result);

        ?>
            <form action="" method="POST" enctype="multipart/form-data" id="form">
                <div class="empListForm-container">            
                    <div class="employeeList-modal" id="Modal">
                        <div class="employeeList-info-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Personal Information</h1>
                                <span class="fa-solid fa-pen-to-square" style="color: #000000; cursor: pointer; margin-right: 20px; font-size: 20px;"></span>  
                            </div>
                            <div class="emp-list-main">
                                <div class="emp-info-first-container">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                
                                    <div class="emp-fname">
                                        <label for="fname">First Name</label><br>
                                        <input type="text" name="fname" id="" placeholder="First Name" value="<?php echo $row['fname']; ?>">
                                    </div>
                                    <div class="emp-lname">
                                        <label for="lname">Last Name</label><br>
                                        <input type="text" name="lname" id="" placeholder="Last Name" value="<?php echo $row['lname']; ?>">
                                    </div>
                                    <div class="emp-gender">
                                        <label for="gender">Gender</label><br>
                                        <select name="gender" id="" placeholdber="Select Gender" value="<?php echo $row['gender'];?>">
                                        <!-- <option value="" selected="selected" class="selectTag" style="color: gray;">Select Gender</option> -->
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="emp-dob">
                                        <label for="empdob">Date of Birth</label><br>
                                        <input type="date" name="empdob" id="empdob" placeholder="Select Date of Birth" value="<?php echo $row['empdob'] ?>" >
                                    </div>
                                    <div class="emp-contact">
                                        <label for="contact">Contact Number</label><br>
                                            <input type="text" name="contact" id="" placeholder="Contact Number" value="<?php echo $row['contact'] ?>">
                                    </div>
                                    <div class="emp-cstatus">
                                        <label for="cstatus">Martial Status</label><br>
                                            <select name="cstatus" id="" placeholdber="Select Status" value="<?php echo $row['cstatus'];?>" >
                                            <!-- <option selected="selected" class="selectTag" style="color: gray;">Select Status</option> -->
                                                <option value="Single" >Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Other">Other</option>
                                            </select>
                                    </div>
                                    <div class="emp-email">
                                        <label for="email">Email</label><br>
                                        <input type="email" name="email" id="" placeholder="Email Address" value="<?php echo $row['email'] ?>">
                                    </div>
                                    <div class="emp-datehired">
                                        <label for="empdate_hired">Date of Joining</label><br>
                                            <input type="date" name="empdate_hired" id="" placeholder="Date Hired" value="<?php echo $row['empdate_hired'] ?>">
                                    </div>
                                </div>
                                <div class="emp-list-info-second-container">
                                    <div class="emp-head">
                                        <img src="uploads/<?php echo $row['emp_img_url'];?>" alt="" srcset="" accept=".jpg, .jpeg, .png" title="<?php echo $row['emp_img_url']; ?>">
                                    </div>
                                    <div class="emp-info">
                                        <h1><?php echo $row['fname']; ?> <?php echo $row['lname'];?></h1>
                                        <p><?php echo $row['empposition']?></p>
                                        <div class="emp-stats">
                                            <h4>Status: </h4>
                                            <h4 style="color:blue; margin-left:5px;">Active</h4>
                                        </div>
                                    </div>
                                    <div class="custom-file" style="width:300px; margin-top:10px;">
                                        <input type="file" class="custom-file-input" id="customFile" name="emp_img" >
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>

                                    <script>
                                        // Add the following code if you want the name of the file appear on select
                                        $(".custom-file-input").on("change", function() {
                                        var fileName = $(this).val().split("\\").pop();
                                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                        });
                                    </script>
                                </div>

                            </div>
                        </div> 

                        <div class="employeeList-government-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Government Information</h1>
                                <span id="modal-update" id="modal-update" class="fa-light fa-plus" style="color: #000000; cursor: pointer; margin-right: 20px; font-size: 20px border:none; background-color:inherit; outline:none; font-size: 20px;"> </span>
                            </div> 
                            <div class="emp-govern-first-container">
                                <div class="gov-sss" style="display:flex">
                                    <div>
                                    <label for="empsss">SSS #</label><br>
                                        <input type="text" name="empsss" id="" placeholder="Input SSS#" value="<?php echo $row['empsss'] ?>"><br> 
                                    </div>
                                    <div>
                                    <label for="sssamount">Amount</label><br>
                                        <input type="text" name="sss_amount" id="" placeholder="Input Deduction" value="<?php if(isset($row['sss_amount'])&& !empty($row['sss_amount'])) { echo $row['sss_amount']; } else { echo 'Input Deduction'; }?>" style="color:gray; font-size: 15px;">
                                    </div>
                                </div>

                                <div class="gov-tin" style="display:flex">
                                    <div>
                                        <label for="emptin">TIN #</label><br>
                                            <input type="text" name="emptin" id="" placeholder="Input TIN" value="<?php echo $row['emptin'] ?>">
                                    </div>
                                    <div>
                                    <label for="tinamount">Amount</label><br>
                                        <input type="text" name="tin_amount" id="" placeholder="Input Deduction" value="<?php if(isset($row['tin_amount'])&& !empty($row['tin_amount'])) { echo $row['tin_amount']; } else { echo 'Input Deduction'; }?>" style="color:gray; font-size: 15px;">
                                    </div>
                                </div>

                                <div class="gov-pagibig" style="display:flex">
                                    <div>
                                        <label for="emppagibig">Pagibig #</label><br>
                                            <input type="text" name="emppagibig" id="" placeholder="Input Pagibig #" value="<?php echo $row['emppagibig'] ?>" >
                                    </div>
                                    <div>
                                    <label for="pagibigamount">Amount</label><br>
                                        <input type="text" name="pagibig_amount" id="" placeholder="Input Deduction" value="<?php if(isset($row['pagibig_amount'])&& !empty($row['pagibig_amount'])) { echo $row['pagibig_amount']; } else { echo 'Input Deduction'; }?>" style="color:gray; font-size: 15px;">
                                    </div>
                                </div>

                                <div class="gov-philhealth" style="display:flex">
                                    <div>
                                        <label for="empphilhealth">Philhealth #</label><br>
                                            <input type="text" name="empphilhealth" id="" placeholder="Input Philhealth #" value="<?php echo $row['empphilhealth'] ?>">
                                    </div>
                                    <div>
                                    <label for="philhealth_amount">Amount</label><br>
                                        <input type="text" name="philhealth_amount" id="" placeholder="Input Deduction" value="<?php if(isset($row['philhealth_amount'])&& !empty($row['philhealth_amount'])) { echo $row['philhealth_amount']; } else { echo 'Input Deduction'; }?>" style="color:gray; font-size: 15px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="emp-allowance-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Allowances</h1>
                                <span id="allowance-update" id="allowance-update" class="fa-light fa-plus" style="color: #000000; cursor: pointer; margin-right: 20px; font-size: 20px border:none; background-color:inherit; outline:none; font-size: 20px;"> </span>

                            </div>
                            <div class="emp-allowance-first-container">
                                <div class="allowance-transpo">
                                    <label for="emptranspo">Transportation</label><br>
                                        <input type="text" name="emptranspo" placeholder="0.00" value="<?php echo $row['emptranspo']; ?>">
                                </div>
                                <div class="allowance-meal">
                                    <label for="empmeal">Meal Allowance</label><br>
                                        <input type="text" name="empmeal" placeholder="0.00" value="<?php echo $row['empmeal'] ?>"> 
                                </div>
                                <div class="allowance-internet">
                                    <label for="empinternet">Internet Allowance</label><br>
                                        <input type="text" name="empinternet" placeholder="0.00" value="<?php echo $row['empinternet'] ?>">  
                                </div>
                            </div>
                        </div>

                        <div class="emp-empInfo-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Employee Information</h1>
                            </div>
                            <div class="emp-empInfo-first-container">
                                <div class="empInfo-empid">
                                    <label for="empid">Employee ID</label><br>
                                        <input type="text" name="empid" id="" placeholder="Employee ID" value="<?php echo $row['empid'] ?>" >
                                </div>
                                <div class="empInfo-position">
                                    <label for="empposition">Job Position</label><br>
                                    <select name="empposition" id="" placeholder="Select Job Position" value="<?php echo $row['empposition'];?>">
                                        <!-- <option value="" selected="selected" class="selectTag" style="color: gray;">Select Department</option> -->
                                        <option value="Admin Staff">Admin Staff</option>
                                        <option value="Software Developer">Software dev</option>
                                        <option value="IT Sales Associate">IT Sales Associate</option>
                                    </select>
                                </div>
                                <div class="empInfo-role">
                                    <label for="role">Role</label><br>
                                        <select name="role" id="" placeholder="Select Schedule Type" value="<?php echo $row['role'] ?>">
                                            <!-- <option value="" selected="selected" class="selectTag" style="color: gray;">Select Role</option> -->
                                            <option value="Employee">Employee</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Superadmin">Superadmin</option>  
                                        </select> 
                                </div>
                                <div class="empInfo-branch">
                                    <label for="empbranch">Branch</label><br>
                                        <input type="text" name="empbranch" id="" placeholder="Select Branch" value="<?php echo $row['empbranch'] ?>" >
                                </div>
                                <div class="empInfo-department">
                                    <?php
                                        include 'config.php';

                                        $sql = "SELECT col_deptname FROM dept_tb";
                                        $results = mysqli_query($conn, $sql);
             
                                            $options = "";
                                            while ($rows = mysqli_fetch_assoc($results)) {
                                            $options .= "<option value='".$rows['col_deptname']."'>" .$rows['col_deptname'].  "</option>";
                                            }
                                    ?>
             
                                    <label for="depatment">Department</label><br>
                                    <select name="department_name" id="" value="<?php echo $row['col_deptname'];?>">
                                    <!-- <option value disabled selected>Select Department</option> -->
                                        <?php echo $options; ?>
                                    </select>
                                </div>
                                <div class="empInfo-classification">
                                     <label for="classification">Classification</label><br>
                                        <select name="classification" id="" placeholder="Select Schedule Type" value="<?php echo $row['classification'] ?>">
                                            <!-- <option value="" selected="selected" class="selectTag" style="color: gray;">Select Role</option> -->
                                            <option value="Provisionary">Provisionary</option>
                                            <option value="Regular">Regular</option> 
                                        </select>
                                </div>
                                <div class="empInfo-salary">
                                    <label for="empbsalary">Basic Salary</label><br>
                                        <input type="text" name="empbsalary" id="" placeholder="Basic Salary" value="<?php if(isset($row['empbsalary'])){ echo $row['empbsalary'];} else{ echo 'No Data.'; } ?>">
                                </div>
                                <div class="empInfo-otrate">
                                    <label for="otrate">OT Rate</label><br>
                                        <input type="text" name="otrate" id="" placeholder="OT Rate" value="<?php if(isset($row['otrate'])&& !empty($row['otrate'])) { echo $row['otrate']; } else { echo 'n/a'; }?>">
                                </div>
                               
                            </div>
                        </div>
                        <div class="emp-worksched-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Work Schedule</h1>
                            </div>
                            <div class="emp-worksched-first-container">
                                <div class="worksched-restday">
                                    <label for="restday">Rest Day</label><br>
                                        <input type="text" name="restday" id="" placeholder="Rest Day" value="<?php if(isset($row['restday'])&& !empty($row['restday'])) { echo $row['restday']; } else { echo 'n/a'; }?>">
                                </div>
                                <div class="worksched-scedule">
                                    <label for="schedule_name">Schedule Setup</label><br>
                                    <?php
                                    include 'config.php';

                                    $conn =mysqli_connect("localhost", "root", "" , "hris_db");
                                    $stmt = "SELECT * FROM empschedule_tb
                                            AS esched
                                            INNER JOIN employee_tb
                                            AS emp
                                            ON(emp.empid = esched.empid)";
                                   
                                    $results = mysqli_query($conn,$stmt);
                                        $options = "";
                                        while($rows = mysqli_fetch_assoc($results)){
                                            $options .="<option value='".$rows['schedule_name']."'>".$rows['schedule_name']."</option>";
                                        }
                                        ?>
                                        <select name="schedule_name" id="" value="<?php echo $row['schedule_name']; ?>">
                                            <?php echo $options; ?>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="emp-payroll-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Payroll Detail</h1>
                            </div>
                            <div class="emp-payroll-first-container">
                                <div class="payroll-bank-name">
                                    <label for="bank_name">Bank Name</label><br>
                                    <input type="text" name="bank_name" id="" value="<?php if(isset($row['bank_name'])&& !empty($row['bank_name'])) { echo $row['bank_name']; } else { echo 'n/a'; }?>">
                                </div>
                                <div class="payroll-bank_no">
                                    <label for="bank_number">Bank Account Number</label><br>
                                    <input type="text" name="bank_number" id=""  value="<?php if(isset($row['bank_number'])&& !empty($row['bank_number'])) { echo $row['bank_number']; } else { echo 'n/a'; }?>">
                                </div>
                            </div>
                        </div>
                        <div class="export">

                        </div>
                            <div class="empList-save-btn">
                                <div>
                                    <span class="closeModal" id="closeModal"><a href="EmployeeList.php">Cancel<a></span>
                                    <span class="modalSave"> <input class="submit" type="submit" name="update" value="Update"></span>
                                </div>
                         </div>
                    </div>
                </div>
            </form>


                    <?php 
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";
     
                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT empid FROM employee_tb";

                        $results = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id ='". $_GET['id']. "'");
                        $rows = mysqli_fetch_assoc($results);
     
                                
                    ?>

                <form action="Data Controller/Employee List/otherGovernController.php" method="POST">
                    <div class="emp-modal" id="emp-modal">
                        <div class="emp-modal-container" id="">
                        <script>
                            $(document).ready(function(){

                                var html = '<tr><td><input type="text" name="other_govern[]" id=""  class="emp-desc form-control" placeholder="Description"style="margin-top: 10px;"></td><td><input type="text" name="govern_amount[]" id=""  class="emp-amount form-control" placeholder="Amount" style="margin-top: 10px;"></td><td><input type="button" value="Remove" name="id_emp" id="empRemove" class="btn" style="margin-top: 10px;"></td><td> <input type="hidden" name="id_emp[]" value="<?php echo $rows['id']?>" id="" style="width:30px"></td></tr>';

                                var max = 5;
                                var x = 1;
                                $("#empAdd").click(function(){
                                    if(x <= max ){
                                        $("#table-field").append(html);
                                        x++;
                                    }
                                });

                                $("#table-field").on('click','#empRemove',function(){
                                    $(this).closest('tr').remove();
                                    x--;
                                });

                            });
                        </script>
                        <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                            <div class="emp-modal-title">
                                <h1>Add new deduction</h1>
                                
                            </div>

                            <div class="emp-modal-input">
                                
                                <table class="" id="table-field" style=" width: 300px; margin-left: 100px;" >
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="other_govern[]" id=""  class="emp-desc form-control" placeholder="Description"></td>
                                        <td><input type="number" name="govern_amount[]" id=""  class="emp-amount form-control" placeholder="Amount"></td>
                                        <td><input type="button" value="Add" name="id_emp[]" id="empAdd" class="btn btn-success" style="width: 73px;" ></td>
                                        <td>
                                        <input type="hidden" name="id_emp[]" value="<?php echo $rows['id']?>" id="" style="width:30px">

                                        </td>
                                    </tr>
                                </table>

                                <div class="other-govern-title" style="margin-top: 30px">
                                    <h1 style="font-size: 23px; margin-left: 20px; margin-bottom:-20px;">New Deductions</h1>
                                
                                
                                <table style=" width: 300px; margin-left: 100px; margin-top: 30px;">
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Actions</th>         
                                    </tr>
                                <?php
                                   $conn = mysqli_connect("localhost", "root", "", "hris_db");
                                   $sql = "SELECT * FROM governdeduct_tb
                                            AS govern
                                            INNER JOIN employee_tb
                                            AS emp
                                            ON(emp.id = govern.id_emp)
                                            WHERE emp.id = '".$_GET['id']."'";
                                   $result = mysqli_query($conn, $sql);
                                   $totalAmount = 0;
                                   if (mysqli_num_rows($result) > 0) {
                                       while ($row = mysqli_fetch_assoc($result)) {
                                           $totalAmount += $row['govern_amount'];
                                           echo "<tr>";
                                           echo "<td><input type='text' readonly class='emp-desc form-control' style='margin-top:10px;' name='other_govern[]' value='" . $row['other_govern'] . "'></td>";
                                           echo "<td><input type='text'  style='margin-top:10px;'  class='emp-amount form-control' readonly name='govern_amount[]' value='" . $row['govern_amount'] . "'></td>";
                                           echo "<td><button type='button' name='delete_data' class='btn btn-danger'><a href='actions/Employee List/govern_delete.php?other_govern=".$row['other_govern']."&id=".$row['id']."' style='color:white;'>Delete</a></button></td>";
                                           echo "<input type='hidden'readonly name='empid[]' value='" . $row['empid'] . "'>";
                                           echo "</tr>";
                                       }
                                    }
                                   echo "<tr>";
                                   echo "<td>Total Amount:</td>";
                                   echo "<td><input type='text' readonly style='margin-top:10px;'  class='emp-amount form-control' name='total_amount' value='" . $totalAmount . "'></td>";
                                   echo "</tr>";
                                   mysqli_close($conn);
                                ?>
                                <input type='hidden' name="id" value="<?php echo $rows['id'];?>">
                                
                                </table>
                                </div>
                            </div>
                            <div class="emp-modal-button">
                            <span value="Cancel" id="emp-modal-close" class="emp-modal-close" style="margin-bottom:12px;">Close</span>
                            <input type="submit" value="Submit" name="submit" id="submit" style="border: none; font-size: 23px; margin-top: -1px; margin-right: 10px; color: blue;" >
                            </div>
                        </div>
                    </div>
                    </form> 
                    

                    <!-- Allowance modal-->

                    <?php 
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";
     
                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT empid FROM employee_tb";

                        $resultss = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id ='". $_GET['id']. "'");
                        $rowss = mysqli_fetch_assoc($resultss);
     
                                
                    ?>

                   
                <form action="Data Controller/Employee List/otherAllowanceController.php" method="POST">
                <?php 
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";
     
                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT empid FROM employee_tb";

                        $results = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id ='". $_GET['id']. "'");
                        $rows = mysqli_fetch_assoc($results);
     
                                
                    ?>
                
                    <div class="allowance-modal" id="allowance-modal">
                        <div class="allowance-modal-container">
                            <script>
                                $(document).ready(function(){
                                    var html = '<tr><td><input type="text" name="other_allowance[]" id=""  class="allowance-desc form-control" placeholder="Description"style="margin-top: 10px;"></td><td><input type="text" name="allowance_amount[]" id=""  class="allowance-amount form-control" placeholder="Amount" style="margin-top: 10px;"></td><td><input type="button" value="Remove" name="id_emp" id="allowanceRemove" class="btn" style="margin-top: 10px;"></td><td> <input type="hidden" name="id_emp[]" value="<?php echo $rows['id']?>" id="" style="width:30px"></td></tr>';

                                var max = 5;
                                var x = 1;
                                $("#allowanceAdd").click(function(){
                                    if(x <= max ){
                                        $("#table-fields").append(html);
                                        x++;
                                    }
                                });

                                $("#table-fields").on('click','#allowanceRemove',function(){
                                    $(this).closest('tr').remove();
                                    x--;
                                });

                            });
                            </script>
                            <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                            <div class="allowance-modal-title">
                                <h1>Add new deduction</h1>
                            </div>
                            <div class="allowance-modal-input">  
                                <table class="" id="table-fields" style=" width: 300px; margin-left: 100px;" >
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Actions</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="other_allowance[]" id=""  class="allowance-desc form-control" placeholder="Description"></td>
                                        <td><input type="number" name="allowance_amount[]" id=""  class="allowance-amount form-control" placeholder="Amount"></td>
                                        <td><input type="button" value="Add" name="id_emp[]" id="allowanceAdd" class="btn btn-success" style="width: 73px;" ></td>
                                        <td>
                                        <input type="hidden" name="id_emp[]" value="<?php echo $rows['id']?>" id="" style="width:30px">
                                        </td>
                                    </tr>
                                </table>

                                <div class="other-allowance-title" style="margin-top: 30px">
                                    <h1 style="font-size: 23px; margin-left: 20px; margin-bottom:-20px;">New Deductions</h1>
                                
                                
                                <table style="width: 300px; margin-left: 100px; margin-top: 30px;">
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Actions</th>         
                                    </tr>
                                <?php
                                     $conn = mysqli_connect("localhost", "root", "", "hris_db");
                                     $sql = "SELECT * FROM allowancededuct_tb
                                              AS allow
                                              INNER JOIN employee_tb
                                              AS emp
                                              ON(emp.id = allow.id_emp)
                                              WHERE emp.id = '".$_GET['id']."'";
                                     $resultd = mysqli_query($conn, $sql);
                                     $totalAmountd = 0;
                                     if (mysqli_num_rows($resultd) > 0) {
                                         while ($rowd = mysqli_fetch_assoc($resultd)) {
                                             $totalAmountd += $rowd['allowance_amount'];
                                             echo "<tr>";
                                             echo "<td><input type='text' readonly class='form-control allowance-desc' style='margin-top:10px;' name='other_allowance[]' value='" . $rowd['other_allowance'] . "'></td>";
                                             echo "<td><input type='text'  style='margin-top:10px;'  class='form-control allowance-amount' readonly name='allowance_amount[]' value='" . $rowd['allowance_amount'] . "' ></td>";
                                             echo "<td><button type='button' name='delete_data' class='btn btn-danger'><a href='actions/Employee List/allowance_delete.php?other_allowance=".$rowd['other_allowance']."&id=".$rowd['id']."' style='color:white;'>Delete</a></button></td>";
                                             echo "<input type='hidden'readonly name='empid[]' value='" . $rowd['empid'] . "'>";
                                             echo "</tr>";
                                         }
                                      }
                                     echo "<tr>";
                                     echo "<td>Total Amount:</td>";
                                     echo "<td><input type='text' disabled style='margin-top:10px;'  class='form-control allowance-amount' name='total_amount' value='" . $totalAmountd . "'></td>";
                                     echo "</tr>";
                                     mysqli_close($conn);
                                  ?>
                                  <input type='hidden' name="id" value="<?php echo $rowss['id'];?>">
                                
                                </table>
                                </div>
                            </div>
                            <div class="allowance-modal-button">
                                <span value="Cancel" id="allowance-modal-close" class="allowance-modal-close" style="margin-bottom:12px;">Close</span>
                                <input type="submit" value="Submit" name="submit" id="submit" style="border: none; font-size: 23px; margin-top: -1px; margin-right: 10px; color: blue;">
                            </div>
                            </form>
                        </div>
                    </div>
                
                    
                 
                
            
            
 
<!-- <script type="text/javascript">
      document.getElementById("customFile").onchange = function(){
          document.getElementById("form").submit();
      };
</script> -->

<script>
    // sched form modal

let allowanceModal = document.getElementById('allowance-modal');

//get open modal
let allowanceBtn = document.getElementById('allowance-update');

//get close button modal
let allowanceClose = document.getElementsByClassName('allowance-modal-close')[0];

//event listener
allowanceBtn.addEventListener('click', openAllowance);
allowanceClose.addEventListener('click', exitAllowance);
window.addEventListener('click', clickOutsides);

//functions
function openAllowance(){
    allowanceModal.style.display ='block';
}

function exitAllowance(){
    allowanceModal.style.display ='none';
}

function clickOutsides(e){
    if(e.target == allowanceModal){
        allowanceModal.style.display ='none';    
    }
}
</script>
    
    
<script>
 // Calculate the date 18 years ago
var today = new Date();
var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

// Format the maxDate as YYYY-MM-DD
var maxDateFormatted = maxDate.toISOString().split("T")[0];

// Set the max attribute of the input element
document.getElementById("empdob").setAttribute("max", maxDateFormatted);


// sched form modal

let Modal = document.getElementById('emp-modal');

//get open modal
let modalBtn = document.getElementById('modal-update');

//get close button modal
let closeModal = document.getElementsByClassName('emp-modal-close')[0];

//event listener
modalBtn.addEventListener('click', openModal);
closeModal.addEventListener('click', exitModal);
window.addEventListener('click', clickOutside);

//functions
function openModal(){
    Modal.style.display ='block';
}

function exitModal(){
    Modal.style.display ='none';
}

function clickOutside(e){
    if(e.target == Modal){
        Modal.style.display ='none';    
    }
}

</script>

                     

    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>