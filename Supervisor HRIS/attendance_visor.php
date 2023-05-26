<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/attendance_visor.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Attendance</title>
</head>
<body>
<header>
     <?php
         include 'header.php';
     ?>
</header>

<style>
   
    .sidebars{
      height:110vh;
    
    }

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
        margin-top: 150px;
    }

    .sidebars .first-ul{
        line-height:60px;
        height:100px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }

    .table{
         width: 99.6%;
    }

    .content-wrapper{
         width: 85%
    }
</style>




<div class="main-panel mt-5" style="margin-left: 15%;">
    <div class="content-wrapper">
        <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1560px; height:700px; border-radius:20px;">
            <div class="card-body">

                    <div class="row">
                       <div class="col-6">
                          <h2>Attendance</h2>
                      </div>
                     </div> <!--ROW END-->

                            <div class="drop_down_contain">
                                <div class="child_container">
                                    <div class="select-employee">
                                        <label for="">Employee</label>
                                        <select id="select1">
                                            <?php
                                            include 'config.php';

                                            $sql = "SELECT `empid` FROM `employee_tb`";
                                            $result = mysqli_query($conn, $sql);
                                            echo "<option value=''>Select Employee</option>";
                                            while ($row = mysqli_fetch_array($result)) {
                                                $emp_id = $row['empid'];
                                                echo "<option value='$emp_id'>$emp_id</option>"; // Set the value to emp_id|date
                                                }
                                                echo "</select>";
                                            ?>   
                                        </select>
                                    </div>
                                    <div class="select-status">
                                        <label for="select1">Status</label>
                                        <select id="select2">
                                        <option class="select-color" value="" default>All Status</option>
                                        <option class="select-color" value="1">Option 1</option>
                                        <option class="select-color" value="2">Option 2</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="second_child_container">
                                    <div class="date-group">
                                        <label for="start-date">Date Range</label>
                                        <input class="date_size" type="date" id="start_date">
                                    </div>
                                    <div class="date-group">
                                        <label for="end-date"></label>
                                        <input class="date_size2" type="date" id="end_date">
                                    </div>
                                </div>
                                <button id="go_btn" class="btn_go">Go</button>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                            <thead>
                                                <tr>
                                                    <th style="display:none;">ID</th>
                                                    <th>Status</th>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Date</th>
                                                    <th>Time in</th>
                                                    <th>Time out</th>
                                                    <th>Late</th>
                                                    <th>Undertime</th>
                                                    <th>Overtime</th>
                                                    <th>Total Work</th>
                                                    <th>Total Rest</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            include '../config.php';
                                            $aprrover_ID = $_SESSION['empid'];
                                            date_default_timezone_set('Asia/Manila');
                                            $query = "SELECT attendances.id,
                                                            attendances.status,
                                                            employee_tb.empid,
                                                            CONCAT(employee_tb.fname, ' ', employee_tb.lname) AS full_name,
                                                            attendances.date,
                                                            attendances.time_in,
                                                            attendances.time_out,
                                                            attendances.late,
                                                            attendances.early_out,
                                                            attendances.overtime,
                                                            attendances.total_work,
                                                            attendances.total_rest
                                                    FROM attendances
                                                    INNER JOIN employee_tb ON attendances.empid = employee_tb.empid
                                                    WHERE employee_tb.`approver`= (SELECT empid FROM employee_tb WHERE empid = $aprrover_ID)
                                                    AND DATE(attendances.date) = CURDATE();"; // Modify the query to filter by the current date
                                            $result = mysqli_query($conn, $query);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td style="display:none;"><?php echo $row['id']?></td>
                                                    <td><?php echo $row['status']?></td>
                                                    <td><?php echo $row['empid']?></td>
                                                    <td><?php echo $row['full_name']?></td>
                                                    <td><?php echo date('Y-m-d (l)', strtotime($row['date'])) ?></td>
                                                    <td><?php echo $row['time_in']?></td>
                                                    <td><?php echo $row['time_out']?></td>
                                                    <td><?php echo $row['late']?></td>
                                                    <td><?php echo $row['early_out']?></td>
                                                    <td><?php echo $row['overtime']?></td>
                                                    <td><?php echo $row['total_work']?></td>
                                                    <td><?php echo $row['total_rest']?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                     </div>
                                 </div>
                             </div>
                                            
            </div>
        </div>
    </div>
</div>                





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<!-- Custom js for this page-->
<script src="bootstrap js/data-table.js"></script>
<!-- End custom js for this page-->


</body>
</html>