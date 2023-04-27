
<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
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
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <div class="empList-container">
        <div class="empList-title">
            <h1>Schedules</h1>
            <button><a href="scheduleForm.php"> Schedule List</a></button>
        </div>
        <div class="empList-create-search">
            <!-- <a href="#" class="empList-btn">Create New</a>         -->
                <div>
                    <?php
                       include('config.php');
                       
                        $sql = "SELECT department_name FROM employee_tb";
                        $result = mysqli_query($conn, $sql);

                        $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option >" .$row['department_name'].  "</option>";
                        }
                        ?>

                                
                        <label for="depatment">Select Department</label><br>
                        <select name="department" id="">
                        <option value disabled selected>Select Department</option>
                            <?php echo $options; ?>
                        </select>      
                </div>
                <div>
                    <?php
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";

                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT empid, fname, lname FROM employee_tb";
                        $result = mysqli_query($conn, $sql);

                        $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option value=' ". $row['empid'] . "'>". $row['empid'] . " ". " - ". " " .$row['fname']. " ".$row['lname']. "</option>";
                        }
                        ?>

                        <label for="emp">Select Employee</label><br>
                        <select name="empname" id="">
                            <option value disabled selected>Select Employee</option>
                            <?php echo $options; ?>
                        </select>
                </div>
                <button class="emplistBtn">Go</button>
        </div>
        <table id="empList-table" class="table table-hover">
                <thead>
                    <th>Employee</th>
                    <th>Time Entry</th>
                    <th>Time Out</th>
                    <th>Rest Day(s)</th>
                    <th>Work Setup</th>
                    <th>From(Date)</th>
                    <th>To(Date)</th>
                    <th>Action</th>
                </thead>
                <tbody>

                <?php
                        $conn = mysqli_connect("localhost", "root", "" , "hris_db");
                        $stmt = "SELECT * FROM employee_tb
                                 AS emp
                                 INNER JOIN empschedule_tb
                                 AS esched
                                 ON(esched.empid = emp.empid)";
                        $result = $conn->query($stmt);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "
                                <tr class='lh-1'>
                                <td style='font-weight: 400;'>".$row["username"]. "</td>
                                <td style='font-weight: 400;'>9:00 AM</td>
                                <td style='font-weight: 400;'>6:00 PM</td>
                                <td style='font-weight: 400;'>".$row["department_name"]. "</td>
                                <td style='font-weight: 400;'>".$row["schedule_name"]. "</td>
                                <td style='font-weight: 400;'>".$row["sched_from"]. "</td>
                                <td style='font-weight: 400;'>".$row["sched_to"]. "</td>
                                 <td><button id='sched-update' class='sched-update' style='border:none; background-color:inherit; color:cornflowerblue; outline:none;'><a href='actions/Schedules/updateEmpSchedule.php?empid=$row[empid]'> Update </a></button></td>
        
                            </tr>";
                            }
                        }
                    ?>
                </tbody>
        </table>
    </div>

    <!-- <form action="">
    <div class="schedules-modal-update" id="schedules-modal-update">
        <div class="sched-container">
            <div class="sched-content">
                <div class="schedmodal-title">
                <h1>Update Schedule</h1>
                <div></div>
                </div>
                <div class="schedmodal-emp">
                    
                        <?php  
                        $conn =mysqli_connect("localhost", "root", "" , "hris_db");
                        $stmt = "SELECT * FROM employee_tb
                                AS emp
                                INNER JOIN empschedule_tb
                                AS esched
                                ON(emp.empid = esched.empid)  LIMIT 1";
                                $result = $conn->query($stmt);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<h1>".$row["fname"].""." ". "" .$row["lname"]."</h1>";
                                    }
                                }
                        ?>
                
                </div>
                <div class="schedule-type-update">
                <?php
                    $server = "localhost";
                    $user = "root";
                    $pass ="";
                    $database = "hris_db";

                    $conn = mysqli_connect($server, $user, $pass, $database);
                    $sql = "SELECT schedule_name FROM schedule_tb";
                    $result = mysqli_query($conn, $sql);

                    $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option value=' ". $row['schedule_name'] . "'>" .$row['schedule_name']."</option>";
                        }
                        ?>

                    <label for="schedule_name">Schedule Type</label><br>
                    <select name="schedule_name" id="">
                        <option value disabled selected>Select Schedule Type</option>
                        <?php echo $options; ?>
                    </select>
                </div>
                <div class="sched-update-date">
                <label for="sched_from">From</label>
                <input type="date" name="" id="">

                <label for="sched_from">To</label>
                <input type="date" name="" id="">
                <div>
                
                <div class="sched-update-btn">
                <button value="Cancel" id="sched-update-close" class="sched-update-close">Close</button>
                <button value="" type="submit">Submit</button>
                </div>
                
            </div>
        </div>
    </div>
    </form> -->
    

<?php require 'script.php'; ?>    

<script>
// sched form modal

let Modal = document.getElementById('schedules-modal-update');

//get open modal
let modalBtn = document.getElementById('sched-update');

//get close button modal
let closeModal = document.getElementsByClassName('sched-update-close')[0];

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