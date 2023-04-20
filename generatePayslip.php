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
    <style>
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
}
    </style>
    <header>
        <?php include("header.php")?>
    </header>

    <div class="gen-payslip">
        <div class="gen-payslip-input-container" style="margin-bottom:50px;">
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
            <div class="att-search" style="margin-bottom: 50px;">
                <!-- <input class="employeeList-search" type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome;" id="search" style="outline:none;"/> -->
            </div>
        </div>
        <div style="width: 95%; margin:auto;">
            <table id="dtDynamicVerticalScrollExample" class="table table-hover table-borderless" cellspacing="0">
                <thead style="background-color: #f4f4f4;">
                    <tr>
                    <th class="th-sm">Name</th>
                    <th class="th-sm">Position</th>
                    <th class="th-sm">Office</th>
                    <th class="th-sm">Age</th>
                    <th class="th-sm">Start date</th>
                    <th class="th-sm">Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-weight:400">
                        <td style="font-weight:400">Tiger Nixon</td>
                        <td style="font-weight:400">System Architect</td>
                        <td style="font-weight:400">Edinburgh</td>
                        <td style="font-weight:400">61</td>
                        <td style="font-weight:400">2011/04/25</td>
                        <td style="font-weight:400">$320,800</td>
                    </tr>
                    <tr>
                        <td style="font-weight:400">Garrett Winters</td>
                        <td style="font-weight:400">Accountant</td>
                        <td style="font-weight:400">Tokyo</td>
                        <td style="font-weight:400">63</td>
                        <td style="font-weight:400">2011/07/25</td>
                        <td style="font-weight:400">$170,750</td>
                    </tr>
                    <tr>
                        <td style="font-weight:400">Ashton Cox</td>
                        <td style="font-weight:400">Junior Technical Author</td>
                        <td style="font-weight:400">San Francisco</td>
                        <td style="font-weight:400">66</td>
                        <td style="font-weight:400">2009/01/12</td>
                        <td style="font-weight:400">$86,000</td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script> 
    
<script>
function sortTable(columnIndex) {
    var table, rows, switching, i, x, y, shouldSwitch, direction, switchCount = 0;
    table = document.getElementById("myTable");
    switching = true;
    direction = "asc";
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[columnIndex];
            y = rows[i + 1].getElementsByTagName("TD")[columnIndex];
            if (columnIndex === 0) {
                if (direction === "asc") {
                    if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (direction === "desc") {
                    if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else {
                if (direction === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (direction === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchCount++;
        } else {
            if (switchCount === 0 && direction === "asc") {
                direction = "desc";
                switching = true;
            }
        }
    }
}

$(document).ready(function () {
  $('#dtDynamicVerticalScrollExample').DataTable({
    "scrollY": "50vh",
    "scrollCollapse": true,
  });
  $('.dataTables_length').addClass('bs-select');
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