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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css"> 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

     <!-- Para sa datatables -->
     <link rel="stylesheet" href="vendors/feather/feather.css">
        <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- Para sa datatables END -->
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

                        <label for="schedule_name">Employee</label>
                        <select name="schedule_name" id="" class="form-control">
                            <option value disabled selected>All Employee</option>
                            <?php echo $options; ?>
                        </select>
                </div>
                <div>
                    <label for="">Select Month/Year</label>
                    <select name="" onchange="foryear()" id="id_month" class="form-control" style="width: 190px;">
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

                    <select name="year" id="id_year" onchange="getCutoff(this.value)" class="form-control">
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
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3 pay1">
                        <?php
                            include 'config.php';
                            $sql = "SELECT * FROM dept_tb";
                            $result = mysqli_query($conn, $sql);

                            $options = "";
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                                $options .= "<option value='".$row['col_deptname']."'>".$row['col_deptname']."</option>";
                            }
                        ?>
                        <label for="schedule_name">Department</label>
                        <select name="schedule_name" id="" class="form-control">
                            <option value disabled selected>All Department</option>
                            <?php echo $options; ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
    

                    <div class="input-group mb-3 pay2">
                        <label for="schedule_name">Cut off Number</label>
                        <select name="cutoffs" id="id_cutoffs" onchange="cutoff(this.value)" class="form-control">
                            <option value disabled selected>Select Cutoff</option>
                            <option value = "1">1</option>
                            <option value = "2" >2</option>
                            <option value = "3" >3</option>
                            <option value = "4" >4</option>
                        </select>
                    </div>      
                </div>

                
            </div>

            <!-- ------------------para sa message na sucessful START -------------------->
            <?php

            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }


            ?>
            <!-------------------- para sa message na sucessful ENd --------------------->


            <!----------------------para sa message na error START --------------------->
            <?php
                if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                '.$error.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }

            ?>
            <!-------------------- para sa message na error ENd --------------------->
            <div class="att-date" style="margin-top: 18px;">
                <h1 id="">Attendance for <span id="current-date">10/01/2023 - 10/15/2023</span></h1>
            </div>
            
        </div>
        <div class="row" style="width: 95%; margin:auto;">
            <div class="col-12 ">
                <div class="table-responsive" style="margin-top:70px;">
                    <form action="" method="post">
                        <input type="hidden" name="name_payslip" value="">
                        <table id="order-listing" class="table table-hover table-borderless" cellspacing="0" >
                            <thead style="background-color: #f4f4f4;">
                                <tr>
                                <th style="display: none;" class="th-sm">ID</th>
                                <th class="th-sm">Employee ID</th>
                                <th class="th-sm">Employee Name</th>
                                <th class="th-sm">Bank Name</th>
                                <th class="th-sm">Bank Account</th>
                                <th class="th-sm">No. of Day</th>
                                <th class="th-sm">Cutoff</th>
                                <th class="th-sm">Cutoff Number</th>
                                <th class="th-sm">Generated DateTime</th>
                                <th class="th-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                include 'config.php';

                                $sql = "SELECT
                                            payslip_tb.col_ID,
                                            payslip_tb.col_empid,
                                            CONCAT(
                                                    employee_tb.`fname`,
                                                    ' ',
                                                employee_tb.`lname`
                                                ) AS `full_name`,
                                                employee_tb.bank_name,
                                                employee_tb.bank_number,
                                                payslip_tb.col_numDaysWork,
                                                CONCAT(
                                                    cutoff_tb.col_month,
                                                    ' ',
                                                    cutoff_tb.col_year
                                                ) AS `month_year`,                                   
                                                cutoff_tb.col_cutOffNum,
                                                payslip_tb._datetime

                                        FROM
                                            payslip_tb
                                        Inner Join 
                                            employee_tb
                                        on 
                                            payslip_tb.col_empid = employee_tb.empid
                                        Inner Join 
                                            cutoff_tb
                                        on 
                                            payslip_tb.col_cutoffID = cutoff_tb.col_ID
                                        ORDER BY payslip_tb._datetime DESC
                                        
                                        ";
                                            
                                $result = $conn->query($sql);

                                // read data
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                            <td style='display: none;'>" . $row['col_ID'] . "</td>
                                            <td>" . $row['col_empid'] . "</td>
                                            <td>" . $row['full_name'] . "</td>   
                                            <td>" . $row['bank_name'] . "</td>       
                                            <td>" . $row['bank_number'] . "</td>
                                            <td>" . $row['col_numDaysWork'] . "</td>   
                                            <td>" . $row['month_year'] . "</td>
                                            <td>" . $row['col_cutOffNum'] . "</td> 
                                            <td>" . $row['_datetime'] . "</td> 
                                            <td>
                                                <div class='dropdown'>
                                                    <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                        View
                                                    </button>
                                                    <ul class='dropdown-menu'>
                                                        <li><a class='dropdown-item' href='Data Controller/Payslip/getPayslipdata.php?id=" . $row['col_ID'] . "'>View Payslip</a></li>
                                                        <li><a class='dropdown-item' href='#'>Download</a></li>
                                                    </ul>
                                                </div
                                        </td>                                      
                                        </tr>"; 
                                }
                            ?>

                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            
        </div>

    </div>
    
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<!-- para sa datatable -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="bootstrap js/template.js"></script>
    <script src="bootstrap js/data-table.js"></script>  <!-- < Custom js for this page  -->
<!-- para sa datatable  END-->
<script>




function cutoff(value) {
    // Make an AJAX request to the server
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Handle the response from the server
                var response = this.responseText;
                
                document.getElementById('current-date').innerHTML = response;

                    // if (response === "exist") {
                    //     //console.log("Value exists in the database");
                                                
                    // } else {
                    //     //console.log("Value does not exist in the database");
                                                
                    // }
            }
        };
            xhttp.open("GET", "Data Controller/Payslip/getCutoffdata.php?value=" + encodeURIComponent(value), true);
            xhttp.send();
    }




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