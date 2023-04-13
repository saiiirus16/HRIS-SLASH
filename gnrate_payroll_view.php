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
                                                    
                                                    //para sa pag select sa empschedule base sa empid 
                                                    $sql_empSched = mysqli_query($conn, " SELECT
                                                                                                    *  
                                                                                                FROM
                                                                                                    empschedule_tb
                                                                                                WHERE empid = $emp_ID");
                                                                                                //need pa ma fetch sa between sa dates na naselect na month sa dropdown
                                                                                                if(mysqli_num_rows($sql_empSched) > 0) {
                                                                                                    $row_empSched = mysqli_fetch_assoc($sql_empSched);
                                                                                                    //echo $row_empSched['empid'] . " " . $row_empSched['schedule_name'];
                                                                                                    $schedule_name = $row_empSched['schedule_name'];

                                                                                                        //para sa pag select sa schedule base sa schedule na fetch 
                                                                                                            $sql_sched = mysqli_query($conn, " SELECT
                                                                                                            *  
                                                                                                            FROM
                                                                                                            `schedule_tb`
                                                                                                            WHERE `schedule_name` = '$schedule_name'");
                                                                                                            //need pa ma fetch sa between sa dates na naselect na month sa dropdown
                                                                                                            if(mysqli_num_rows($sql_sched) > 0) {
                                                                                                            $row_Sched = mysqli_fetch_assoc($sql_sched);
                                                                                                            //echo $row_Sched['mon_timein'];
                                                                                                            } else {
                                                                                                            echo "No results found schedule.";
                                                                                                            } 
                                                                                                        //para sa pag select sa schedule base sa schedule na fetch (END)

                                                                                                } else {
                                                                                                    echo "No results found.";
                                                                                                }  // END ELSE SQL_EMPSCHED
                                                    //para sa pag select sa empschedule base sa empid (END)
                            
                                                        //Para sa mga range of dates per day to compute the late and undertime deduction
                                                            // -----------------------BREAK MONDAY START----------------------------//
                                                                    $MON_timeIN = $row_Sched['mon_timein'];
                                                                    $MON_timeOUT = $row_Sched['mon_timeout'];
                                                                    
                                                                    $MOn_total_work = strtotime($MON_timeOUT) - strtotime($MON_timeIN) - 7200;
                                                                    $MOn_total_work = date('H:i:s', $MOn_total_work);
                                                                    echo "  " .  $MOn_total_work;
                                                            // -----------------------BREAK MONDAY START----------------------------//

                                                            // -----------------------BREAK Tuesday START----------------------------//
                                                                    $tue_timeIN = $row_Sched['tues_timein'];
                                                                    $tue_timeout = $row_Sched['tues_timeout'];
                                                                    
                                                                    $Tue_total_work = strtotime($tue_timeout) - strtotime($tue_timeIN) - 7200;
                                                                    $Tue_total_work = date('H:i:s', $Tue_total_work);
                                                                    echo "  " .  $Tue_total_work;
                                                            // -----------------------BREAK Tuesday END----------------------------//

                                                             // -----------------------BREAK WEDNESDAY START----------------------------//
                                                                    $wed_timeIN = $row_Sched['wed_timein'];
                                                                    $wed_timeout = $row_Sched['wed_timeout'];
                                                                    
                                                                    $wed_total_work = strtotime($wed_timeout) - strtotime($wed_timeIN) - 7200;
                                                                    $wed_total_work = date('H:i:s', $wed_total_work);
                                                                    echo "  " .  $wed_total_work;
                                                            // -----------------------BREAK WEDNESDAY END----------------------------//

                                                            // -----------------------BREAK THURSDAY START----------------------------//
                                                                    $thurs_timeIN = $row_Sched['thurs_timein'];
                                                                    $thurs_timeout = $row_Sched['thurs_timeout'];

                                                                    $thurs_total_work = strtotime($thurs_timeout) - strtotime($thurs_timeIN) - 7200;
                                                                    $thurs_total_work = date('H:i:s', $thurs_total_work);
                                                                    echo " thurs " .  $thurs_total_work;
                                                            // -----------------------BREAK THURSDAY END----------------------------//


                                                            // -----------------------BREAK FRIDAY START----------------------------//
                                                                   
                                                                    $fri_timeIN = $row_Sched['fri_timein'];
                                                                    $fri_timeout = $row_Sched['fri_timeout'];
                                                                    
                                                                    $fri_total_work = strtotime($fri_timeout) - strtotime($fri_timeIN) - 7200;
                                                                    $fri_total_work = date('H:i:s', $fri_total_work);
                                                                    echo " fri " .  $fri_total_work;


                                                            // -----------------------BREAK FRIDAY END----------------------------//

                                                            
                                                            // -----------------------BREAK Saturday START----------------------------//
                                                                   
                                                                    $sat_timeIN = $row_Sched['sat_timein'];
                                                                    $sat_timeout = $row_Sched['sat_timeout'];
                                                                    
                                                                    $sat_total_work = strtotime($sat_timeout) - strtotime($sat_timeIN) - 7200;
                                                                    $sat_total_work = date('H:i:s', $sat_total_work);
                                                                    echo " sat " .  $sat_total_work;


                                                            // -----------------------BREAK Saturday END----------------------------//
                                                    
                                                            // -----------------------BREAK SUNDAY START----------------------------//
                                                                   
                                                                    $sun_timeIN = $row_Sched['sun_timein'];
                                                                    $sun_timeout = $row_Sched['sun_timeout'];
                                                                    
                                                                    $sun_total_work = strtotime($sun_timeout) - strtotime($sun_timeIN) - 7200;
                                                                    $sun_total_work = date('H:i:s', $sun_total_work);
                                                                    echo " sun " .  $sun_total_work;


                                                            // -----------------------BREAK SUNDAY END----------------------------//


                                                         


                                                             //para sa pag select sa schedule base sa schedule na fetch 
                                                                $sql_attndces = mysqli_query($conn, " SELECT
                                                                            `drate`
                                                                    FROM employee_tb
                                                                   
                                                                    WHERE empid = $emp_ID;
                                                                ");
                                                                //need pa ma fetch sa between sa dates na naselect na month sa dropdown
                                                                if(mysqli_num_rows($sql_attndces) > 0) 
                                                                {
                                                                    $row_attndcs = mysqli_fetch_assoc($sql_attndces);


                                                                        // Fetch all rows from attendances_tb
                                                                    $query = "SELECT * FROM attendances WHERE empid = $emp_ID";
                                                                    $result = $conn->query($query);

                                                                    // Check if any rows are fetched
                                                                    if ($result->num_rows > 0) 
                                                                    {
                                                                        // Loop through each row
                                                                        while($row = $result->fetch_assoc()) 
                                                                        {
                                                                            $_late = $row["late"];
                                                                            // $status = $row["status"];
                                                                            $Date = $row["date"];
                                                                            $day_of_week = date('l', strtotime($Date));

                                                                            // // Check if the person is present or absent
                                                                            // if ($status == "Present") {
                                                                            //     echo "$name is present...$day_of_week<br> ";
                                                                            // } else if ($status == "Absent") {
                                                                            //     echo "$name is absent.<br>";
                                                                            // } else {
                                                                            //     echo "Unknown status for $name.<br>";
                                                                            // }
                                                                            
                                                                            //check for what day is it (for getting value of minutes in peso)
                                                                            if($day_of_week === 'Monday'){
                                                                                
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $Mon_total_work_hours = (int)substr($MOn_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $Mon_total_work_hours;
                                                                                $MON_minute_rate = $hour_rate / 60;

                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $MONDAY_TO_DEDUCT_LATE = $totalMinutes * $MON_minute_rate;
                                                                                echo " _ MONDAY  =" . $totalMinutes;

                                                                                

                                                                                // $final_deduct_monday = $_late * $MON_minute_rate;
                                                                                // echo $day_of_week   . " " .  $final_deduct_monday;
                                                                            }else if ($day_of_week === 'Tuesday'){
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $total_work_hours = (int)substr($Tue_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                $TUES_minute_rate = $hour_rate / 60;

                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $TUESDAY_TO_DEDUCT_LATE = $totalMinutes * $TUES_minute_rate;
                                                                                echo " _ Tuesday  =" . $TUESDAY_TO_DEDUCT_LATE;


                                                                            }else if ($day_of_week === 'Wednesday'){
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $total_work_hours = (int)substr($wed_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                $WEDS_minute_rate = $hour_rate / 60;
                                                                                
                                                                                
                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $WEDS_TO_DEDUCT_LATE = $totalMinutes * $WEDS_minute_rate;
                                                                                echo "_ WEDNESDAY  =" . $WEDS_TO_DEDUCT_LATE;

                                                                            }else if ($day_of_week === 'Thursday'){
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $total_work_hours = (int)substr($thurs_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                $THURS_minute_rate = $hour_rate / 60;
                                                                                
                                                                                 
                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $THURS_TO_DEDUCT_LATE = $totalMinutes * $THURS_minute_rate;
                                                                                echo " _ THURSDAY  =" . $THURS_TO_DEDUCT_LATE;

                                                                            }else if ($day_of_week === 'Friday'){
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $total_work_hours = (int)substr($fri_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                $FRI_minute_rate = $hour_rate / 60;
                                                                              
                                                                                
                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $FRI_TO_DEDUCT_LATE = $totalMinutes * $FRI_minute_rate;
                                                                                echo "_ FRIDAY  =" . $FRI_TO_DEDUCT_LATE;
                                                                            }

                                                                            else if ($day_of_week === 'Saturday'){
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $total_work_hours = (int)substr($sat_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                $SAT_minute_rate = $hour_rate / 60;
                                                                                
                                                                                
                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $SAT_TO_DEDUCT_LATE = $totalMinutes * $SAT_minute_rate;
                                                                                echo "_ SATURDAY =" . $SAT_TO_DEDUCT_LATE;


                                                                            }else if ($day_of_week === 'Sunday'){
                                                                                $emp_dailyRate =  $row_attndcs['drate'];
                                                                                $total_work_hours = (int)substr($sun_total_work, 0, 2);
                                                                                $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                $SUN_minute_rate = $hour_rate / 60;
                                                                               
                                                                                
                                                                                $timeString = "$_late";
                                                                                $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                $SUN_TO_DEDUCT_LATE = $totalMinutes * $SAT_minute_rate;
                                                                                echo "_ SUNDAY =" . $SUN_TO_DEDUCT_LATE;
                                                                            }
                                                                            
                                                                           

                                                                        } //end while
                                                                    }
                                                                       
                                                                     else {
                                                                        echo "No rows found in attendances_tb.";
                                                                    }
                                                                    
                                                                    
                                                                } else {
                                                                    echo "No results found ";
                                                                } //END SQL ATTNDCES

                                                            // //para sa pag select sa schedule base sa schedule na fetch (END)
                                                            //  $emp_dailyRate =  $row_attndcs['drate'];
                                                            
                                                            // // Convert time duration to total number of hours
                                                            // $Mon_total_work_hours = (int)substr($MOn_total_work, 0, 2); 
                                                            
                                                            // // Perform division
                                                            // if ($Mon_total_work_hours > 0) {
                                                            //     $hour_rate =  $emp_dailyRate / $Mon_total_work_hours;
                                                            //      echo "Minute Rate: " . $hour_rate / 60;
                                                            // } else {
                                                            //     echo "Total hours worked on Tuesday is zero.";
                                                            // }

                                                            // $TOTAL_LATE_DEDUCTION = $MON_minute_rate + $TUES_minute_rate + $WEDS_minute_rate + $THURS_minute_rate + $FRI_minute_rate + $SAT_minute_rate + $SUN_minute_rate;
                                                            // echo " total_deductin: " $TOTAL_LATE_DEDUCTION;


                                                    $sql = "SELECT
                                                                SUM(employee_tb.`drate`) AS Salary_of_Month,
                                                                employee_tb.`emptranspo` + employee_tb.`empmeal` + employee_tb.`empmeal` + employee_tb.`allowance_amount` AS Total_allowance,
                                                                employee_tb.`sss_amount` + employee_tb.`tin_amount` + employee_tb.`pagibig_amount` + employee_tb.`philhealth_amount` + employee_tb.`govern_amount` AS Total_deduct,
                                                                CONCAT(
                                                                        FLOOR( 
                                                                            SUM(TIME_TO_SEC(attendances.late)) / 3600
                                                                        ),
                                                                        ':0',
                                                                        FLOOR(
                                                                            (
                                                                                SUM(TIME_TO_SEC(attendances.late)) % 3600
                                                                            ) / 60
                                                                        ),
                                                                        ''
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

                                                

                                                //need pa ma fetch sa between sa dates na naselect na month sa dropdown

                                                //read data
                                                while($row = $result->fetch_assoc()){
                                                    echo "<tr>
                                                            <td>" . $row['Salary_of_Month'] . "</td>
                                                            <td>" . $row['total_hours_minutesLATE'] . "</td>
                                                            <td>" . $row['total_hours_minutesUndertime'] . "</td>
                                                            <td>" . $row['total_hours_minutestotalHours'] . "</td>
                                                            <td>" . $MONDAY_TO_DEDUCT_LATE + $TUESDAY_TO_DEDUCT_LATE + $WEDS_TO_DEDUCT_LATE + $THURS_TO_DEDUCT_LATE + $FRI_TO_DEDUCT_LATE . "</td>
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