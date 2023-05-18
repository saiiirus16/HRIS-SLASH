
<?php
  
   session_start();
   if(!isset($_SESSION['username'])){
       header("Location: login.php"); 
   } else {
       // Check if the user's role is not "admin"
       if($_SESSION['role'] != 'admin'){
           // If the user's role is not "admin", log them out and redirect to the logout page
           session_unset();
           session_destroy();
           header("Location: logout.php");
           exit();
       }
   }

    if(isset($_GET['empidError'])){
        $empidError = "Employee aD does exist.";
        echo "<script> alert('$empidError')</script>";
    }

    if(isset($_GET['passError'])){
        $passError = "Password does not match!";
        echo "<script> alert('$passError')</script>";
    }

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
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List Form</title>
</head>
<body>
<!-- 
<div class="empListForm-container">
                <form action="" method="POST">
                    <div class="employeeList-modal" id="Modal">
                        <div class="employeeList-info-container">
                            <div class="emp-title" style="display:flex; flex-direction:space-row; align-items: center; justify-content:space-between; width: 1440px;">
                                <h1>Personal Information</h1>
                                <span class="fa-solid fa-pen-to-square" style="color: #000000; cursor: pointer; margin-right: 20px; font-size: 20px;"></span>  
                            </div>
                            <div class="emp-info-first-container">
                                
                            </div>
                        </div>         
                    </div>
                </form>
            </div> -->
    <!-- <script>
        $(document).ready(function(){
            $("form").submit(function(event){
                event.preventDefault();
                var fname = $("#form-fname").val();
                var lname = $("#form-lname").val();
                var empid = $("#form-empid").val();
                var contact = $("#form-contact").val();
                var email = $("#form-email").val();
                var submit = $("#form-submit").val();

                $(".erorr-message").load("Data Controller/Employee List/empListFormController.php", {
                    fname: fname,
                    lname: lname,
                    empid: empid,
                    contact: contact,
                    email: email,
                    submit: submit 
                });
                
            });
        }); -->
    
        
    <header>
        <?php include("header.php")?>
    </header>

        <div class="empListForm-container">
        <form action="Data Controller/Employee List/empListFormController.php" method="POST">
            <div class="employeeList-modal" id="Modal">
                    <div class="employeeList-modal-content">
                        <div class="employeeList-info-container">
                            <div class="emp-title">
                                <h1>Personal Information</h1>
                            </div>
                            <div class="emp-info-first-input">
                                <div class="emp-info-fname">
                                        <label for="fname">First Name</label><br>
                                        <input id="form-fname" type="text" name="fname" placeholder="First Name" id="fname" onkeyup='saveValue(this);' required >
                                        
                                </div>
                                <div class="emp-info-lname">
                                        <label for="lname">Last Name</label><br>
                                        <input type="text" name="lname" id="form-lname" placeholder="Last Name" id="lname" onkeyup='saveValue(this);' required >
                                        
                                </div>
                                <div class="emp-info-empID">
                                <label for="empid">Employee ID</label><br>
                                    <input type="text" name="empid" id="form-empid" placeholder="Employee ID" required maxlength="6">  
                                    <span id="empid-error" style="color: red;"></span>
                                </div>
                            </div>
                            <div class="emp-info-second-input">
                                <div class="emp-info-address">
                                        <label for="address">Complete Address</label><br>
                                        <input type="text" name="address" id="" placeholder="Complete Address" required>

                                </div>
                                <div class="emp-info-contact">
                                        <label for="contact">Contact Number</label><br>
                                        <input type="text" name="contact" id="form-contact" placeholder="Contact Number" pattern="[0-9]{11,11}" title="Max length is 11 numbers only" required maxlength="11">
                                        
                                </div>
                            </div>
                            <div class="emp-info-third-input">
                                <div class="emp-info-cstatus">
                                        <label for="cstatus">Civil Status</label><br>
                                        <select name="cstatus" id="" placeholdber="Select Status" required>
                                            <option value="" selected="selected" class="selectTag" style="color: gray;" >Select Status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Other">Other</option>
                                        </select>
                                </div>
                                <div class="emp-info-gender">
                                        <label for="gender">Gender</label><br>
                                        <select name="gender" id="" placeholdber="Select Gender" required>
                                            <option value="" selected="selected" class="selectTag" style="color: gray;">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                </div>
                                <div class="emp-info-dob">
                                        <label for="empdob" required>Date of Birth</label><br>
                                        <input type="date" name="empdob" id="empdob" placeholder="Select Date of Birth" >         
                                </div>
                            </div>
                        </div> 
                          
                        <div class="employeeList-govern-container">
                            <div class="emp-title">
                                <h1>Government Information</h1>
                            </div>
                            <div class="emp-govern-first-input">
                                <div class="emp-govern-sss">
                                    <label for="empsss">SSS #</label><br>
                                    <input type="text" name="empsss" id="" placeholder="Input SSS#">
                                </div>
                                <div class="emp-govern-TIN">
                                    <label for="emptin">TIN</label><br>
                                    <input type="text" name="emptin" id="" placeholder="Input TIN">
                                </div>
                            </div>
                            <div class="emp-govern-second-input">
                                <div class="emp-govern-pagibig">
                                    <label for="emppagibig">Pagibig #</label><br>
                                    <input type="text" name="emppagibig" id="" placeholder="Input Pagibig #">
                                </div>
                                <div class="emp-govern-TIN">
                                    <label for="empphilhealth">Philhealth #</label><br>
                                    <input type="text" name="empphilhealth" id="" placeholder="Input Philhealth #">
                                </div>
                            </div>
                        </div>

                        <div class="employeeList-empDetail-container">
                            <div class="emp-title">
                                <h1>Employement Detail</h1>
                            </div>
                            <div class="emp-empDetail-first-input">
                            <div class="emp-empDetail-dept">
                                      <?php
                                        $server = "localhost";
                                        $user = "root";
                                        $pass ="";
                                        $database = "hris_db";

                                        $conn = mysqli_connect($server, $user, $pass, $database);
                                        $sql = "SELECT * FROM branch_tb";
                                        $result = mysqli_query($conn, $sql);

                                        $options = "";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $options .= "<option value='". $row['id'] . "'>" .$row['branch_name'].  "</option>"; //I-integer yung data column ng department name sa employee_tb
                                        }
                                        ?>

                                    <label for="empbranch">Select Branch</label><br>
                                        <select name="empbranch" id="" required>
                                        <option value disabled selected>Select Branch</option>
                                          <?php echo $options; ?>
                                        </select>
                                </div>

                                <div class="emp-empDetail-dept">
                                      <?php
                                        $server = "localhost";
                                        $user = "root";
                                        $pass ="";
                                        $database = "hris_db";

                                        $conn = mysqli_connect($server, $user, $pass, $database);
                                        $sql = "SELECT * FROM dept_tb";
                                        $result = mysqli_query($conn, $sql);

                                        $options = "";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $options .= "<option value='". $row['col_ID'] . "'>" .$row['col_deptname'].  "</option>"; //I-integer yung data column ng department name sa employee_tb
                                        }
                                        ?>

                                    <label for="depatment" >Select Department</label><br>
                                        <select name="col_deptname" id="" required>
                                        <option value disabled selected>Select Department</option>
                                          <?php echo $options; ?>
                                        </select>
                                </div>
                                <div class="emp-empDetail-jposition">
                                    <?php
                                                    include 'config.php';

                                                     $sql = "SELECT * FROM positionn_tb";
                                                     $results = mysqli_query($conn, $sql);
             
                                                     $options = "";
                                                     while ($rows = mysqli_fetch_assoc($results)) {
                                                         $options .= "<option value='".$rows['id']."'>" .$rows['position'].  "</option>";
                                                     }
                                                     ?>
             
                                                 <label for="empposition">Select Positon</label><br>
                                                     <select name="empposition" id="" value="<?php echo $row['position'];?>" >
                                                     <option value disabled selected>Select Position</option> 
                                                       <?php echo $options; ?>
                                                     </select>
                                </div>
                            </div>
                            <div class="emp-empDetail-second-input">
                                <script>
                                    function calculateDailyRate() {
                                        const basicSalary = document.getElementById('empbsalary').value;
                                        const dailyRateInput = document.getElementById('drate');
                                        if (basicSalary.trim() === '') {
                                            dailyRateInput.setAttribute('placeholder', 'Daily Rate');
                                            dailyRateInput.value = '';
                                        } else {
                                            const dailyRate = parseFloat(basicSalary) / 22;
                                            dailyRateInput.removeAttribute('placeholder');
                                            dailyRateInput.value = dailyRate.toFixed(2);
                                        }
                                    }
                                </script>
                                <div class="emp-empDetail-bsalary">
                                    <label for="empbsalary">Basic Salary</label><br>
                                    <input type="text" id="empbsalary" name="empbsalary" oninput="calculateDailyRate()" required placeholder="Basic Salary"/>
                                </div>
                                <div class="emp-empDetail-drate">
                                    <label for="drate">Daily Rate</label><br>
                                    <input type="text" name="drate" id="drate" placeholder="Daily Rate" required readonly class="form-control" style="height: 50px;">
                                </div>
                                <div class="emp-empDetail-approver">
                                <div>
                                    <?php
                                        $server = "localhost";
                                        $user = "root";
                                        $pass ="";
                                        $database = "hris_db";

                                        $conn = mysqli_connect($server, $user, $pass, $database);
                                        $sql = "SELECT * FROM employee_tb";
                                        $result = mysqli_query($conn, $sql);

                                        $options = "";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            
                                            $options .= "<option value='".$row['fname']. " ". " " ." ".$row['lname']."'>".$row['fname']. " ". " " ." ".$row['lname']." </option>";
                                        }
                                        ?>

                                        
                                        <label for="approver">Immediate Superior/Approver</label><br>
                                        <select name="approver" id="">
                                        <option value disabled selected>Select Approver</option>
                                        <option value="admin">admin</option>
                                            <?php echo $options; ?>
                                        </select>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="emp-empDetail-third-input">
                                <div class="emp-empDetail-dateHired">
                                        <label for="empdate_hired">Date Hired</label><br>
                                        <input type="date" name="empdate_hired" id="" placeholder="Date Hired" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="employeeList-allowance-container">
                            <div class="emp-title">
                                <h1>Employee Allowance</h1>
                            </div>

                            <div class="emp-allowance-first-input">
                                <div class="emp-allowance-transpo">
                                    <label for="emptranspo">Transportation</label><br>
                                    <input type="number" name="emptranspo" placeholder="0.00">   
                                </div>
                                <div class="emp-allowance-meal">
                                    <label for="empmeal">Meal Allowance</label><br>
                                    <input type="number" name="empmeal" placeholder="0.00">  
                                </div>
                                <div class="emp-allowance-internet">
                                    <label for="empinternet">Internet Allowance</label><br>
                                    <input type="number" name="empinternet" placeholder="0.00">  
                                </div>
                            </div>
                        </div>

                        
                        <div class="employeeList-schedule-input">
                            <div class="emp-title">
                                <h1>Schedule</h1>
                            </div>

                            <div class="emp-schedule-first-input">
                                <div class="emp-schedule-accessID">
                                <?php
                                        $server = "localhost";
                                        $user = "root";
                                        $pass ="";
                                        $database = "hris_db";

                                        $conn = mysqli_connect($server, $user, $pass, $database);
                                        $sql = "SELECT * FROM schedule_tb";
                                        $result = mysqli_query($conn, $sql);

                                        $options = "";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $options .= "<option value='".$row['schedule_name']."'>".$row['schedule_name']."</option>"; //I-integer yung data column ng department name sa employee_tb
                                        }
                                        ?>

                                    <label for="schedule_name">Select Schedule Type</label><br>
                                        <select name="schedule_name" id="" >
                                        <option value disabled selected>Select Schedule Type</option>
                                          <?php echo $options; ?>
                                        </select>                            
                                </div>
                                <div class="emp-schedule-startDate">
                                    <label for="sched_from">Start Date</label><br>
                                    <input type="date" name="sched_from" placeholder="Start Date">  
                                </div>
                                <div class="emp-schedule-endDate">
                                    <label for="sched_to">End Date</label><br>
                                    <input type="date" name="sched_to" placeholder="End Date">  
                                </div>
                            </div>
                        </div>

                        <div class="employeeList-empAccess-container">
                            <div class="emp-title">
                                <h1>Employee Access</h1>
                            </div>
                            <div class="emp-Access-first-input">
                                <div class="emp-Access-access_id">
                                        <label for="empaccess_id">Access ID</label><br>
                                        <input type="text" name="empaccess_id" id="" placeholder="Access ID" required>
                                </div>
                                <div class="emp-empAccess-username">
                                    <label for="username">Username</label><br>
                                    <input type="text" name="username" id="" placeholder="Username" required>
                                </div>
                                <div class="emp-empAccess-role">
                                    <label for="role">Role</label><br>
                                    <select name="role" id="" placeholder="Select Schedule Type" required>
                                            <option value="" selected="selected" class="selectTag" style="color: gray;" >Select Role</option>
                                            <option value="Employee">Employee</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Supervisor">Supervisor</option>
                                            
                                    </select>  
                                </div>
                            </div>
                            <div class="emp-Access-second-input">
                                <div class="emp-Access-email">
                                        <label for="email">Email</label><br>
                                        <input pattern="[A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}" type="email" name="email" id="form-email" placeholder="Email Address" title="Must be a valid email."  required>
                                        
                                </div>
                                <div class="emp-Access-password">
                                        <label for="password">Password</label><br>
                                        <input type="password" pattern="[a-zA-Z0-9]{5,}" title="Must be at least 5 characters." onchange="Pass()" name="password" id="pass" placeholder="Password" required>
                                        
                                </div>
                                <div class="emp-Access-cpassword">
                                    <label for="cpassword">Confirm Password</label><br>
                                        <input type="password" pattern="[a-zA-Z0-9]{5,}" title="Must be at least 5 characters." disabled onchange="matchPass()" name="cpassword" id="cpass" placeholder="Confirm Password" required>
                                        
                                </div>
                            </div>
                            <p  id="id_pValidate"style="margin-top: 5px; margin-right: 340px; color: red; display: none; text-align: right;">* Passwords don't match!</p>
                        </div>

                    <div class="empList-save-btn">
                        <div>
                            <span class="closeModal" id="closeModal">Cancel</span>
                            <span class="modalSave"> <input class="submit" id="btn_save" type="submit" value="Save"></span>
                        </div>
                    </div>
                </div>
            </div>
    </form>
        </div>


<script>
 // Calculate the date 18 years ago
var today = new Date();
var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());


var minDate = new Date(today.getFullYear() - 70, today.getMonth(), today.getDate());

// Format the maxDate and minDate as YYYY-MM-DD
var maxDateFormatted = maxDate.toISOString().split("T")[0];
var minDateFormatted = minDate.toISOString().split("T")[0];

// Set the max and min attributes of the input element
document.getElementById("empdob").setAttribute("max", maxDateFormatted);
document.getElementById("empdob").setAttribute("min", minDateFormatted);

const dateHiredInput = document.querySelector('[name="empdate_hired"]');
  const startDateInput = document.querySelector('[name="sched_from"]');
  const endDateInput = document.querySelector('[name="sched_to"]');

  dateHiredInput.addEventListener('change', () => {
    const selectedDate = dateHiredInput.value;
    startDateInput.min = selectedDate;
    endDateInput.min = selectedDate;
    startDateInput.disabled = false;
    endDateInput.disabled = false;
  });

function Pass(){
    let pass = document.getElementById('pass').value;
    let cpass = document.getElementById('cpass').value;
   
    if(pass === ""){
        document.getElementById('cpass').disabled = true;
    }
    else{
        document.getElementById('cpass').disabled = false;

        
    if(cpass != pass){
        
        document.getElementById('id_pValidate').style.display = "";
        document.getElementById('btn_save').style.cursor = "no-drop";
        document.getElementById('btn_save').disabled = true;
    }
    else{
        document.getElementById('id_pValidate').style.display = "none";
        document.getElementById('btn_save').style.cursor = "pointer";
        document.getElementById('btn_save').disabled = false;
    }
    }
}
function matchPass(){
    let pass = document.getElementById('pass').value;
    let cpass = document.getElementById('cpass').value;

    if(pass != cpass){
        
        document.getElementById('id_pValidate').style.display = "";
        document.getElementById('btn_save').style.cursor = "no-drop";
        document.getElementById('btn_save').disabled = true;
    }
    else{
        document.getElementById('id_pValidate').style.display = "none";
        document.getElementById('btn_save').style.cursor = "pointer";
        document.getElementById('btn_save').disabled = false;
    }
}

</script>




    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>