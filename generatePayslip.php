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
    <title>HRIS | Generate Payslip</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <div class="gen-payslip">
        <div class="gen-payslip-input-container">
            <div class="gen-payslip-title">
                <h1>Generate Payslip</h1>
            </div>
            <div class="payslip-input">
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
                            $options .= "<option value='".$row['empid']."'>".$row['empid']." - ".$row['fname']." ".$row['lname']."</option>";
                                }
                            ?>

                        <label for="schedule_name">Schedule Type</label>
                        <select name="schedule_name" id="" class="form-control">
                            <option value disabled selected>All Employee</option>
                            <?php echo $options; ?>
                        </select>
                </div>
                <div>
                    <label for="">Select Month/Year</label>
                    <select name="" id="" class="form-control" style="width: 190px;">
                        <option value="" disabled selected>Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>

                    <select name="year" class="form-control">
                        <option value="" disabled selected>Year</option>
                        <?php
                            $currentYear = date("Y");
                            for ($year = 2005; $year <= $currentYear; $year++) {
                                echo "<option value=\"$year\">$year</option>";
                            }
                        ?>
                    </select>

                </div>
                <div>
                    <button class="btn gen-btn" >Generate</button>
                </div>
            </div>
            <div class="payslip-info-2">
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
                        $options .= "<option value='".$row['col_deptname']."'>".$row['col_deptname']."</option>";
                            }
                ?>

                <label for="schedule_name">Department</label>
                <select name="schedule_name" id="" class="form-control">
                    <option value disabled selected>All Department</option>
                    <?php echo $options; ?>
                </select>
            </div>
            <div class="att-date" style="margin-top: 18px;">
                <h1 id="current-date">Attendance for <span>10/01/2023 - 10/15/2023</span></h1>
            </div>
            <div class="att-search">
                <input class="employeeList-search" type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome;" id="search" style="outline:none;"/>
            </div>
        </div>
        <table class="table table-hover" style="margin-top:100px;">
            <thead>
                <th style="width:180px;" >Employee ID</th>
                <th>Name</th>
                <th>Bank Name</th>
                <th>Bank Account</th>
                <th>No. of Day</th>
                <th>Action</th>
            </thead>
            <tbody id="myTable">
                <tr>
                    <td style="font-weight: 400">2</td>
                    <td style="font-weight: 400">William Bunn</td>
                    <td style="font-weight: 400">Chinese Bank</td>
                    <td style="font-weight: 400">0932422</td>
                    <td style="font-weight: 400">22</td>
                    <td style="font-weight: 400"><button style="border: none; background-color: inherit;"><a href="" style="text-decoration: none;">View</a></button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>   
    
<script type="text/javascript">
        $(document).ready(function(){
            $('#search').keyup(function(){
                search_table($(this).val());
            });

            function search_table(value){
                $('#myTable tr').each(function(){
                    var found = 'false';
                    $(this).each(function(){
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase())>= 0){
                            found = 'true';
                        }
                    });
                    if(found == 'true'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
        });

</script>    

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

</body>
</html>