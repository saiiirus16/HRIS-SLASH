<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payroll Summary</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Para sa datatables -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
        <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- Para sa datatables END -->

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/gnrate_payroll.css">
</head>
<body>

<header>
    <?php 
        include 'header.php';
    ?>
</header>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="head_text">Please select date of range to generate: </h2>

                <div class="row">
                    <div class="col-6">
                        <div class="mb-1">
                            <label for="id_strdate" class="form-label">Date Range :</label>
                            <form class="form-floating">
                                <input type="date" class="form-control" id="id_inpt_strdate" style=' height: 50px; width: 400px;cursor: pointer;' >
                                <label for="id_inpt_strdate">Start Date :</label>
                            </form>
                        </div> <!-- mb-1 end-->
                    </div> <!-- col-6 end-->
                    <div class="col-6">
                        <div class="mb-1">
                            <label for="id_strdate" class="form-label"></label>
                            <form class="form-floating">
                                <input type="date" class="form-control" id="id_inpt_strdate" style=' height: 50px; width: 400px;cursor: pointer;' >
                                <label for="id_inpt_strdate">End Date :</label>
                            </form>
                        </div> <!-- mb-1 end-->
                    </div> <!-- col-6 end-->
                </div> <!-- ROW end-->


                        <!--------------------------------------- Break ----------------------------------------->

                     
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" data-bs-toggle="tab" href="#Payslip">Payslip Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Allowance">Allowance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Loan">Loan Details</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id= "Payslip">
                        <div class="table-responsive">
                            <!-- <form action="departmentEmployee.php" method="post">          -->
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Salary Rate</th>
                                            <th>Total Late</th>
                                            <th>Total Undertime</th> 
                                            <th>Basic Hours</th>
                                            <th>Basic Pay</th>
                                            <th>Basic OT Pay</th> 
                                            <th>SSS</th> 
                                            <th>Philhealth</th>
                                            <th>Pagibig</th>
                                            <th>Net Pay</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php 
                                                include 'config.php';

                                                if(isset($_POST['name_btnView'])){
                                                    $emp_ID = $_POST['Name_employeeID'];

                                                    $sql = "SELECT
                                                                SUM(employee_tb.`drate`) AS Salary_of_Month,
                                                                employee_tb.`emptranspo` + employee_tb.`empmeal` + employee_tb.`empmeal` + employee_tb.`allowance_amount` AS Total_allowance,
                                                                employee_tb.`sss_amount` + employee_tb.`tin_amount` + employee_tb.`pagibig_amount` + employee_tb.`philhealth_amount` + employee_tb.`govern_amount` AS Total_deduct,
                                                                CONCAT(
                                                                        FLOOR(
                                                                            SUM(TIME_TO_SEC(attendances.late)) / 3600
                                                                        ),
                                                                        ' hour/s ',
                                                                        FLOOR(
                                                                            (
                                                                                SUM(TIME_TO_SEC(attendances.late)) % 3600
                                                                            ) / 60
                                                                        ),
                                                                        ' minute/s'
                                                                    ) AS total_hours_minutesLATE,
                                                                CONCAT(
                                                                        FLOOR(
                                                                            SUM(TIME_TO_SEC(attendances.early_out)) / 3600
                                                                        ),
                                                                        ' hour/s ',
                                                                        FLOOR(
                                                                            (
                                                                                SUM(TIME_TO_SEC(attendances.early_out)) % 3600
                                                                            ) / 60
                                                                        ),
                                                                        ' minute/s'
                                                                    ) AS total_hours_minutesUndertime,
                                                                CONCAT(
                                                                        FLOOR(
                                                                            SUM(TIME_TO_SEC(attendances.total_work)) / 3600
                                                                        ),
                                                                        ' hour/s ',
                                                                        FLOOR(
                                                                            (
                                                                                SUM(TIME_TO_SEC(attendances.total_work)) % 3600
                                                                            ) / 60
                                                                        ),
                                                                        ' minute/s'
                                                                    ) AS total_hours_minutestotalHours
                                                            FROM
                                                                employee_tb
                                                            INNER JOIN attendances ON employee_tb.empid = attendances.empid
                                                            WHERE attendances.status = 'Present' AND employee_tb.empid = $emp_ID
                                                                    ";
                                                $result = $conn->query($sql);

                                                //read data
                                                while($row = $result->fetch_assoc()){
                                                    echo "<tr>
                                                            <td>" . $row['Salary_of_Month'] . "</td>
                                                            <td>" . $row['total_hours_minutesLATE'] . "</td>
                                                            <td>" . $row['total_hours_minutesUndertime'] . "</td>
                                                            <td>" . $row['total_hours_minutestotalHours'] . "</td>
                                                            <td>" . $row['Total_deduct'] . "</td>
                                                            <td>
                                                                ds
                                                            </td>
                                                        </tr>"; 
                                                }

                                                } //END IF ISSET

                                                          
                                            ?>  
                                              
                                    </tbody>
                                </table>
                                                <!-- </form> -->
                            </div> <!--table-responsive END-->
                        </div> <!--tabpane-1 END-->
                                        <!--------------- break ------------->
                        <div class="tab-pane" id= "Allowance">
                            Allowance
                         </div> <!--tabpane-2 END-->
                                        <!--------------- break ------------->
                        <div class="tab-pane" id= "Loan">
                            Loan
                        </div> <!--tabpane-3 END-->
                                        <!--------------- break ------------->
                </div> <!--tab content END-->

        </div> <!--  End card-body -->
    </div> <!--  End card -->
</div><!--  End Container -->





    

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
</body>
</html>