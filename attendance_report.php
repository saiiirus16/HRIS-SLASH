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

include_once 'config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/attendance_report.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Employee     Attendance Report</title>
</head>
<body>
<header>
    <?php
        include 'header.php';
    ?>
</header>

<style>
    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 287px;
        margin-left:-16px;
        line-height:30px;
       
    }

    .sidebars ul li .hoverable{
        height:55px;
    }

    .sidebars ul{
        height:100%;
    }

    .sidebars .first-ul{
        line-height:60px;
        height:100px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }

    .card-body{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }
</style>


<!------------------------------------------------- Header ------------------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-4">
          <div class="card mt-3" style="width: 1550px; height:800px box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);">
            <div class="card-body">
                <div class="pnl_home">
                    <a href="dashboard.php">Home</a>
                    <p class="header_slash">\</p>
                    <p class="header_prgph_DTR">EmployeeAttendanceReport</p>
                </div>
<!------------------------------------------------- End Of Header -------------------------------------------> 

<!----------------------------------------select button and text input--------------------------------------->
<div class="container-select">
            <div class="input-container">
              <p class="demm-text">Department</p>
              <?php
                        include 'config.php';

                        // Fetch all values of empid and date from the database
                        $sql = "SELECT `col_deptname` FROM dept_tb";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select-btn form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                        echo "<option value='Select All Department' default>Select Department</option>"; // Add a default option
                        while ($row = mysqli_fetch_array($result)) {
                        $department = $row['col_deptname'];
                        echo "<option value='$department'>$department</option>"; // Set the value to emp_id|date
                        }
                        echo "</select>";
                      ?>
                </div>
                
                <div class="input-container">
                <p class="demm-text">Employee</p>
                    <?php
                            include 'config.php';

                            // Fetch all values of empid and date from the database
                            $sql = "SELECT `empid` FROM employee_tb";
                            $result = mysqli_query($conn, $sql);

                            // Generate the dropdown list
                            echo "<select class='select-btn form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                            echo "<option value='Select All Employee' default>Select Employee</option>"; // Add a default option
                            while ($row = mysqli_fetch_array($result)) {
                            $employee_id = $row['employee_id'];
                            echo "<option value='$employee_id'>$employee_id</option>"; // Set the value to emp_id|date
                            }
                            echo "</select>";
                        ?>
                </div>

                <div class="input-container">
                <p class="demm-text">Month From</p>
                <input class="select-btn" type="date" name="" id="datestart" required>
                </div>
                <div class="input-container">
                <div class="notif">
                <p class="demm-text">Month To</p>
                <p id="validate" class="validation">End date must beyond the start date</p>
                </div>
                <input class="select-btn" type="date" id="enddate" onchange="datefunct()" required>
                </div>
                <button id="arrowBtn"> &rarr; Apply Filter</button>
            </div>
<!----------------------------------------select button and text input--------------------------------------->




<!-------------------------------------------------TABLE START------------------------------------------->

                <div class="row">
                    <div class="col-12 mt-5 ">
                        <div class="table-responsive" style="overflow: hidden;">
                            <table id="order-listing" class="table" style="width: 105%;">
                                <thead>
                                        <tr>  
                                            <th style="display: none;">ID</th>                                        
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Overtime hours</th>
                                            <th>Absences</th>
                                            <th>Late</th>
                                            <th>Undertime</th>
                                            <th>Total Work Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                            include 'config.php';
                                            
                                            // Set the time zone to Manila, Philippines
                                            date_default_timezone_set('Asia/Manila');

                                            // Get the current month and year
                                            $currentMonth = date('m');
                                            $currentYear = date('Y');

                                            // Add JavaScript code to dynamically update the table
                                            echo '<script>';
                                            echo 'var currentDate = new Date();';
                                            echo 'var currentMonth = currentDate.getMonth() + 1;';
                                            echo 'var currentYear = currentDate.getFullYear();';
                                            echo 'if (' . $currentMonth . ' !== currentMonth || ' . $currentYear . ' !== currentYear) {';
                                            echo 'window.location.reload();'; // Reload the page if the month has changed
                                            echo '}';
                                            echo '</script>';

                                            $query = "SELECT attendances.id,
                                                employee_tb.empid,
                                                CONCAT(employee_tb.`fname`, ' ', employee_tb.`lname`) AS `full_name`,
                                                attendances.date, attendances.time_in,
                                                attendances.time_out,        
                                                SUM(CASE WHEN attendances.status = 'Absent' THEN 1 ELSE 0 END) AS absent_count,
                                                SEC_TO_TIME(SUM(TIME_TO_SEC(attendances.overtime)))AS total_overtime,
                                                SEC_TO_TIME(SUM(TIME_TO_SEC(attendances.late))) AS total_late,
                                                SEC_TO_TIME(SUM(TIME_TO_SEC(attendances.early_out))) AS total_early_out,
                                                SEC_TO_TIME(SUM(TIME_TO_SEC(attendances.total_work))) AS total_work 
                                                FROM attendances
                                                INNER JOIN employee_tb ON employee_tb.empid = attendances.empid
                                                WHERE MONTH(attendances.date) = $currentMonth
                                                AND YEAR(attendances.date) = $currentYear
                                                GROUP BY employee_tb.empid;";
                                            $result = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td style="display: none;"><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['empid'] ?></td>
                                                    <td><?php echo $row['full_name'] ?></td>
                                                    <td><?php echo $row['total_overtime'] ?></td>
                                                    <td><?php echo $row['absent_count'] ?></td>
                                                    <td><?php echo $row['total_late'] ?></td>
                                                    <td><?php echo $row['total_early_out'] ?></td>
                                                    <td><?php echo $row['total_work'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                </tbody>
                            </table>
                         </div>
                      </div>
                  </div>
                    <div class="export-section">
                        <div class="export-sec">
                            <p class="export">Export Options:</p>
                            <button class="excel" onclick="exportExcel()">Excel</button>
                            <p class="lbl_exprt_contnt">|</p>
                            <button class="pdf" onclick="exportPDF()">PDF</button>
                        </div>
                    </div>

            </div>
         </div>
     </div>
 </div><!---Main Panel Close Tag--->
<!-------------------------------------------------TABLE END------------------------------------------->


        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="bootstrap js/template.js"></script>
        <!-- Custom js for this page-->
        <script src="bootstrap js/data-table.js"></script>
        <!-- End custom js for this page-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>