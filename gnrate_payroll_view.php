<!DOCTYPE html>
<!-- PLEASE READ**: THIS IS FOR DEVELOPER THAT TRYING TO DEBUG.  -->
<!-- IF YOU SEE A "@" IN THE VARIABLE, THEN TRY TO DELETE IT AND DEBUG TO ACHIEVE YOUR OBJECTIVE. I PUT IT IN THE VARIABLE SINCE MY OBJECTIVE IS CORRECT AND WELL FUNCTION BUT IT ALWAYAS SAY UNDEFINED. -->
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
    <link rel="stylesheet" href="css/gnratepayrollVIEW.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <!-- para sa font ng net pay -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
    </style>


    

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
                                            <th>Tin</th>
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
                                                            if($row_Sched['mon_timein'] == NULL || $row_Sched['mon_timein'] == ''){
                                                                       
                                                                $MON_timeIN = '00:00:00';
                                                                $MON_timeOUT = '01:00:00';
                                                                
                                                                $MOn_total_work = strtotime($MON_timeOUT) - strtotime($MON_timeIN) - 7200;
                                                                $MOn_total_work = date('H:i:s', $MOn_total_work);
                                                                //echo " MON_NULL " .  $MOn_total_work;
                                                            }else{
                                                                    $MON_timeIN = $row_Sched['mon_timein'];
                                                                    $MON_timeOUT = $row_Sched['mon_timeout'];
                                                                    
                                                                    $MOn_total_work = strtotime($MON_timeOUT) - strtotime($MON_timeIN) - 7200;
                                                                    $MOn_total_work = date('H:i:s', $MOn_total_work);
                                                                    //echo " MON " .  $MOn_total_work;
                                                            }
                                                            // -----------------------BREAK MONDAY START----------------------------//

                                                            // -----------------------BREAK Tuesday START----------------------------//
                                                            
                                                           

                                                                if($row_Sched['tues_timein'] == NULL || $row_Sched['tues_timein'] == ''){
                                                                       
                                                                    $tue_timeIN = '00:00:00';
                                                                    $tue_timeout = '01:00:00';
                                                                    
                                                                    $Tue_total_work = strtotime($tue_timeout) - strtotime($tue_timeIN) - 7200;
                                                                    $Tue_total_work = date('H:i:s', $Tue_total_work);
                                                                    //echo " TUE_NULL " .  $Tue_total_work;
                                                                }else{
                                                                        $tue_timeIN = $row_Sched['tues_timein'];
                                                                        $tue_timeout = $row_Sched['tues_timeout'];
                                                                        
                                                                        $Tue_total_work = strtotime($tue_timeout) - strtotime($tue_timeIN) - 7200;
                                                                        $Tue_total_work = date('H:i:s', $Tue_total_work);
                                                                        //echo " tue " .  $Tue_total_work;
                                                                }
                                                            // -----------------------BREAK Tuesday END----------------------------//

                                                             // -----------------------BREAK WEDNESDAY START----------------------------//
                                                             
                                                                    if($row_Sched['wed_timein'] == NULL || $row_Sched['wed_timein'] == ''){
                                                                            
                                                                        $wed_timeIN = '00:00:00';
                                                                        $wed_timeout = '01:00:00';
                                                                        
                                                                        $wed_total_work = strtotime($wed_timeout) - strtotime($wed_timeIN) - 7200;
                                                                        $wed_total_work = date('H:i:s', $wed_total_work);
                                                                        //echo " WED_NULL " .  $wed_total_work;
                                                                    }else{

                                                                        $wed_timeIN = $row_Sched['wed_timein'];
                                                                        $wed_timeout = $row_Sched['wed_timeout'];
                                                                        
                                                                        $wed_total_work = strtotime($wed_timeout) - strtotime($wed_timeIN) - 7200;
                                                                        $wed_total_work = date('H:i:s', $wed_total_work);
                                                                        //echo " WED_ " .  $wed_total_work;
                                                                    }

                                                                    
                                                            // -----------------------BREAK WEDNESDAY END----------------------------//

                                                            // -----------------------BREAK THURSDAY START----------------------------//
                                                                if($row_Sched['thurs_timein'] == NULL || $row_Sched['thurs_timein'] == ''){
                                                                        
                                                                    $thurs_timeIN = '00:00:00';
                                                                    $thurs_timeout = '01:00:00';
                                                                    
                                                                    $thurs_total_work = strtotime($thurs_timeout) - strtotime($thurs_timeIN) - 7200;
                                                                    $thurs_total_work = date('H:i:s', $thurs_total_work);
                                                                    //echo " Thurs_NULL " .  $thurs_total_work;
                                                                }else{


                                                                        $thurs_timeIN = $row_Sched['thurs_timein'];
                                                                        $thurs_timeout = $row_Sched['thurs_timeout'];

                                                                        $thurs_total_work = strtotime($thurs_timeout) - strtotime($thurs_timeIN) - 7200;
                                                                        $thurs_total_work = date('H:i:s', $thurs_total_work);
                                                                        //echo " THURS " .  $thurs_total_work;
                                                                }
                                                            // -----------------------BREAK THURSDAY END----------------------------//


                                                            // -----------------------BREAK FRIDAY START----------------------------//
                                                        
                                                            if($row_Sched['fri_timein'] == NULL || $row_Sched['fri_timein'] == ''){
                                                                       
                                                                $fri_timeIN = '00:00:00';
                                                                $fri_timeout = '01:00:00';
                                                                
                                                                $fri_total_work = strtotime($fri_timeout) - strtotime($fri_timeIN) - 7200;
                                                                $fri_total_work = date('H:i:s', $fri_total_work);
                                                                //echo " fri_NULL " .  $fri_total_work;
                                                            }else{
                                                                    $fri_timeIN = $row_Sched['fri_timein'];
                                                                    $fri_timeout = $row_Sched['fri_timeout'];
                                                                    
                                                                    $fri_total_work = strtotime($fri_timeout) - strtotime($fri_timeIN) - 7200;
                                                                    $fri_total_work = date('H:i:s', $fri_total_work);
                                                                    //echo " fri " .  $fri_total_work;
                                                            }


                                                            // -----------------------BREAK FRIDAY END----------------------------//

                                                            
                                                            // -----------------------BREAK Saturday START----------------------------//
                                                            if($row_Sched['sat_timein'] == NULL || $row_Sched['sat_timein'] == ''){
                                                                       
                                                                $sat_timeIN = '00:00:00';
                                                                $sat_timeout = '01:00:00';
                                                                
                                                                $sat_total_work = strtotime($sat_timeout) - strtotime($sat_timeIN) - 7200;
                                                                $sat_total_work = date('H:i:s', $sat_total_work);
                                                                //echo " SAT_NULL " .  $sat_total_work;
                                                            }else{
                                                                   
                                                                    $sat_timeIN = $row_Sched['sat_timein'];
                                                                    $sat_timeout = $row_Sched['sat_timeout'];
                                                                    
                                                                    $sat_total_work = strtotime($sat_timeout) - strtotime($sat_timeIN) - 7200;
                                                                    $sat_total_work = date('H:i:s', $sat_total_work);
                                                                    //echo " SAT " .  $sat_total_work;
                                                            }

                                                            // -----------------------BREAK Saturday END----------------------------//
                                                    
                                                            // -----------------------BREAK SUNDAY START----------------------------//
                                                            if($row_Sched['sun_timein'] == NULL || $row_Sched['sun_timein'] == ''){
                                                                       
                                                                $sun_timeIN = '00:00:00';
                                                                $sun_timeout = '01:00:00';
                                                                
                                                                $sun_total_work = strtotime($sun_timeout) - strtotime($sun_timeIN) - 7200;
                                                                $sun_total_work = date('H:i:s', $sun_total_work);
                                                                //echo " SUN_NULL " .  $sun_total_work;
                                                            }else{
                                                                    $sun_timeIN = $row_Sched['sun_timein'];
                                                                    $sun_timeout = $row_Sched['sun_timeout'];

                                                                    
                                                                    $sun_total_work = strtotime($sun_timeout) - strtotime($sun_timeIN) - 7200;
                                                                    $sun_total_work = date('H:i:s', $sun_total_work);
                                                                    //echo " SUN " .  $sun_total_work;
                                                            }

                                                            // -----------------------BREAK SUNDAY END----------------------------//


                                                         


                                                             //para sa pag select sa schedule base sa schedule na fetch 
                                                                $sql_attndces = mysqli_query($conn, " SELECT
                                                                            `drate`, `otrate`, `status`,
                                                                            CONCAT(
                                                                                    employee_tb.`fname`,
                                                                                    ' ',
                                                                                    employee_tb.`lname`
                                                                                ) AS `full_name`,
                                                                                empsss,
                                                                                emptin,
                                                                                emppagibig,
                                                                                empphilhealth
                                                                    FROM employee_tb
                                                                   
                                                                    WHERE empid = $emp_ID;
                                                                ");
                                                                //need pa ma fetch sa between sa dates na naselect na month sa dropdown
                                                                if(mysqli_num_rows($sql_attndces) > 0) 
                                                                {
                                                                    $row_emp = mysqli_fetch_assoc($sql_attndces);
                                                                       // Fetch all rows from attendances_tb
                                                                    $query = "SELECT * FROM attendances WHERE empid = $emp_ID";
                                                                    $result = $conn->query($query);

                                                                    // Check if any rows are fetched
                                                                    if ($result->num_rows > 0) 
                                                                    {
                                                                       
                                                                        $datesArray = array(); // Array to store the dates
                                                                       
                                                                        // Loop through each row
                                                                        while($row = $result->fetch_assoc()) 
                                                                        {
                                                                            $_late = $row["late"];
                                                                            $UT = $row["early_out"];
                                                                            $OT = $row["overtime"];
                                                                            // $status = $row["status"];
                                                                            $Date = $row["date"];             
                                                                            //$day_of_week = date('l', strtotime($Date));
                                                                            //echo '<br>' .  $Date . ' ' . $day_of_week . ' ' .  $_late;

                                                                            $datesArray[] = array('late' => $_late, 'date' => $Date, 'underTime' => $UT, 'OT' => $OT); // Append the fetched date and late and Undertime and Overtime value to the array
                                                                            //echo '<br>' . $_late;
                                                                        } //end while
                                                                       
                                                                        foreach ($datesArray as $date_att) 
                                                                            {
                                                                                
                                                                            $day_of_week = date('l', strtotime($date_att['date']));
                                                                            //echo '<br>' . $date_att['date'] . ' ' . $day_of_week . ' ' . $date_att['late'] .' ' . $date_att['underTime'] . ' ' . $date_att['OT'];
                                                                            //echo '<br>' . $_late;
                                                                           
                                                                            
                                                                           if($day_of_week === 'Monday'){
                                                                            
                                                                            if($MOn_total_work === '00:00:00'){
                                                                                $MONDAY_TO_DEDUCT_LATE = 0;
                                                                                $MONDAY_TO_DEDUCT_UT = 0;
                                                                                $MONDAY_ToADD_OT = 0;
                                                                            }else{
                                                                                
    
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $Mon_total_work_hours = (int)substr($MOn_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $Mon_total_work_hours;
                                                                                    $MON_minute_rate = $hour_rate / 60; 

                                                                                    
                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$MONDAY_ToADD_OT += $emp_OtRate *  $totalHour_OT;
                                                                                    @$MONDAY_TO_DEDUCT_LATE += $totalMinutes * $MON_minute_rate;
                                                                                    @$MONDAY_TO_DEDUCT_UT += $totalHour * $hour_rate;
                                                                                }
                                                                                
                                                                            } else if($day_of_week === 'Tuesday'){
                                                                                if($Tue_total_work === '00:00:00'){
                                                                                    $Tue_TO_DEDUCT_LATE = 0;
                                                                                    $Tue_TO_DEDUCT_UT = 0;
                                                                                    $Tue_ToADD_OT = 0;
                                                                                }else{
                                                                                
                                                                                    
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $total_work_hours = (int)substr($Tue_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                    $minute_rate = $hour_rate / 60; 

                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$Tue_ToADD_OT += $emp_OtRate *  $totalHour_OT;
                                                                                    @$Tue_TO_DEDUCT_LATE += $totalMinutes * $minute_rate;
                                                                                    @$Tue_TO_DEDUCT_UT += $totalHour * $hour_rate;
                                                                                }
                                                                            } else if($day_of_week === 'Wednesday'){
                                                                                if($wed_total_work === '00:00:00'){
                                                                                    $WED_TO_DEDUCT_LATE = 0;
                                                                                    $WED_TO_DEDUCT_UT =  0;
                                                                                    $WED_ToADD_OT = 0;
                                                                                }else{
                                                                                    
                                                                                    
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $total_work_hours = (int)substr($wed_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                    $minute_rate = $hour_rate / 60; 

                                                                                    
                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$WED_ToADD_OT += $emp_OtRate *  $totalHour_OT; 
                                                                                    @$WED_TO_DEDUCT_LATE += $totalMinutes * $minute_rate;
                                                                                    @$WED_TO_DEDUCT_UT += $totalHour * $hour_rate;
                                                                                }
                                                                            } else if($day_of_week === 'Thursday'){
                                                                                if($thurs_total_work === '00:00:00'){
                                                                                    $Thurs_TO_DEDUCT_LATE = 0;
                                                                                    $Thurs_TO_DEDUCT_UT = 0;
                                                                                    $Thurs_ToADD_OT = 0;
                                                                                }else{
                                                                                
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $total_work_hours = (int)substr($thurs_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                    $minute_rate = $hour_rate / 60; 

                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$Thurs_ToADD_OT += $emp_OtRate *  $totalHour_OT;
                                                                                    @$Thurs_TO_DEDUCT_LATE += $totalMinutes * $minute_rate;
                                                                                    @$Thurs_TO_DEDUCT_UT += $totalHour * $hour_rate;
                                                                                }
                                                                            } else if($day_of_week === 'Friday'){
                                                                                if($fri_total_work === '00:00:00'){
                                                                                    $Fri_TO_DEDUCT_LATE = 0;
                                                                                    $Fri_TO_DEDUCT_UT = 0;
                                                                                    $Fri_ToADD_OT = 0;
                                                                                }else{
                                                                                
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $total_work_hours = (int)substr($fri_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                    $minute_rate = $hour_rate / 60; 

                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$Fri_ToADD_OT += $emp_OtRate *  $totalHour_OT;
                                                                                    @$Fri_TO_DEDUCT_LATE += $totalMinutes * $minute_rate;
                                                                                    @$Fri_TO_DEDUCT_UT += $totalHour * $hour_rate; 
                                                                                }
                                                                            } else if($day_of_week === 'Saturday'){
                                                                                if($sat_total_work === '00:00:00'){
                                                                                    $SAT_TO_DEDUCT_LATE = 0;
                                                                                    $SAT_TO_DEDUCT_UT = 0;
                                                                                    $SAT_ToADD_OT = 0;
                                                                                }else{
                                                                                
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $total_work_hours = (int)substr($sat_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                    $minute_rate = $hour_rate / 60; 

                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$SAT_ToADD_OT += $emp_OtRate *  $totalHour_OT;
                                                                                    @$SAT_TO_DEDUCT_LATE += $totalMinutes * $minute_rate;
                                                                                    @$SAT_TO_DEDUCT_UT += $totalHour * $hour_rate; 
                                                                                }
                                                                            } else if($day_of_week === 'Sunday'){
                                                                                if($sun_total_work === '00:00:00'){
                                                                                    $Sun_TO_DEDUCT_LATE = 0;
                                                                                    $Sun_TO_DEDUCT_UT = 0; 
                                                                                    $Sun_ToADD_OT = 0;
                                                                                }else{
                                                                                
                                                                                    $emp_dailyRate =  $row_emp['drate'];
                                                                                    $emp_OtRate = $row_emp['otrate'];

                                                                                    $total_work_hours = (int)substr($sun_total_work, 0, 2);
                                                                                    $hour_rate =  $emp_dailyRate / $total_work_hours;
                                                                                    $minute_rate = $hour_rate / 60; 

                                                                                    $timeString =$date_att['late'];
                                                                                    $timeString_UT = $date_att['underTime'];
                                                                                    $timeString_OT = $date_att['OT'];

                                                                                    $time = DateTime::createFromFormat('H:i:s', $timeString);// Convert time string to DateTime object
                                                                                    $time_UT = DateTime::createFromFormat('H:i:s', $timeString_UT);// Convert time string to DateTime object
                                                                                    $time_OT = DateTime::createFromFormat('H:i:s', $timeString_OT);// Convert time string to DateTime object
                                                                                    $minutes = $time->format('i');// Extract minutes from DateTime object
                                                                                    $hour= $time_UT->format('H');// Extract Hour from DateTime object
                                                                                    $hour_OT = $time_OT->format('H');// Extract Hour from DateTime object
                                                                                    $totalMinutes = intval($minutes);// Convert minutes to integer
                                                                                    $totalHour = intval($hour);
                                                                                    $totalHour_OT = intval($hour_OT);
                                                                                    @$Sun_ToADD_OT += $emp_OtRate *  $totalHour_OT;
                                                                                    @$Sun_TO_DEDUCT_LATE += $totalMinutes * $minute_rate;
                                                                                    @$Sun_TO_DEDUCT_UT += $totalHour * $hour_rate; 
                                                                                }
                                                                            }
                                                                        
                                                                        }//end for each
                                                                    }
                                                                       
                                                                     else {
                                                                        echo "No rows found in attendances_tb.";
                                                                    }
                                                                    
                                                                    
                                                                } else {
                                                                    echo "No results found ";
                                                                } //END SQL ATTNDCES

                                                                
                                                               

                                                                 //Computation of total deduction of LATE AND UNDERTIME
                                                                 $value_UT_LATE = (@$MONDAY_TO_DEDUCT_LATE + @$Tue_TO_DEDUCT_LATE + @$WED_TO_DEDUCT_LATE +  @$Thurs_TO_DEDUCT_LATE + @$Fri_TO_DEDUCT_LATE + @$SAT_TO_DEDUCT_LATE + @$Sun_TO_DEDUCT_LATE) +  (@$MONDAY_TO_DEDUCT_UT +  @$Tue_TO_DEDUCT_UT + @$WED_TO_DEDUCT_UT  + @$Thurs_TO_DEDUCT_UT +  @$Fri_TO_DEDUCT_UT +  @$SAT_TO_DEDUCT_UT +  @$Sun_TO_DEDUCT_UT);

                                                                $UT_LATE_DEDUCT_TOTAL = number_format($value_UT_LATE, 2); //convert into two decimal only
                                                                 //Computation of total deduction of LATE AND UNDERTIME (END)

                                                                     //Computation of total add Overtime
                                                                 $TOTAL_ADD_OT = @$MONDAY_ToADD_OT + @$Tue_ToADD_OT + @$WED_ToADD_OT + @$Thurs_ToADD_OT + @$Fri_ToADD_OT + @$SAT_ToADD_OT + @$Sun_ToADD_OT;
                                                                     //Computation of total add Overtime (END)
                                                           


                                                    $sql = "SELECT
                                                                SUM(employee_tb.`drate`) AS Salary_of_Month,
                                                                employee_tb.`sss_amount`,
                                                                employee_tb.`tin_amount`,
                                                                employee_tb.`pagibig_amount`,
                                                                employee_tb.`philhealth_amount`,
                                                                employee_tb.`emptranspo` + employee_tb.`empmeal` + employee_tb.`empmeal` AS Total_allowanceStandard,
                                                                employee_tb.`sss_amount` + employee_tb.`tin_amount` + employee_tb.`pagibig_amount` + employee_tb.`philhealth_amount` AS Total_deduct_governStANDARD,
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

                                                // echo " <br>_ MONDAY  =" . $MONDAY_TO_DEDUCT_LATE;
                                                // echo " <br>_ Tuesday  =" . $Tue_TO_DEDUCT_LATE;
                                                // echo "<br>_ WEDNESDAY  =" . $WED_TO_DEDUCT_LATE;
                                                // echo " <br>_ Thursday  =" . $Thurs_TO_DEDUCT_LATE;
                                                // echo "<br>_ Friday  =" . $Fri_TO_DEDUCT_LATE;
                                                // echo "<br>_ Saturday  =" . $SAT_TO_DEDUCT_LATE;
                                                // echo "<br>_ SUNDAY  =" . $Sun_TO_DEDUCT_LATE . '<br>';
                                                // echo 'Undertime:<br>';
                                                // echo " <br>_ MONDAY  =" . $MONDAY_TO_DEDUCT_UT;
                                                // echo " <br>_ Tuesday  =" . $Tue_TO_DEDUCT_UT;
                                                // echo " <br>_ Wednesday  =" . $WED_TO_DEDUCT_UT;
                                                // echo " <br>_ Thursday  =" . $Thurs_TO_DEDUCT_UT;
                                                // echo " <br>_ Friday  =" . $Fri_TO_DEDUCT_UT;
                                                // echo " <br>_ Saturday  =" . $SAT_TO_DEDUCT_UT;
                                                // echo " <br>_ Sunday  =" . $Sun_TO_DEDUCT_UT;
                                                //need pa ma fetch sa between sa dates na naselect na month sa dropdown

                                                //read data
                                                while($row = $result->fetch_assoc()){
                                                    echo "<tr>
                                                            <td>" . $row['Salary_of_Month'] . "</td>
                                                            <td>" . $row['total_hours_minutesLATE'] . "</td>
                                                            <td>" . $row['total_hours_minutesUndertime'] . "</td>
                                                            <td>" . $row['total_hours_minutestotalHours'] . "</td>
                                                            <td>" .  $row['Salary_of_Month'] - $UT_LATE_DEDUCT_TOTAL. "</td>
                                                            <td>".  $TOTAL_ADD_OT . "</td>
                                                            <td>". $row['sss_amount'] ." </td>
                                                            <td>". $row['philhealth_amount'] ."</td>
                                                            <td>". $row['pagibig_amount'] ."</td>
                                                            <td>". $row['tin_amount'] ."</td>
                                                            <td> " . (($row['Salary_of_Month'] - $UT_LATE_DEDUCT_TOTAL) +  $TOTAL_ADD_OT) - $row['Total_deduct_governStANDARD']  . " </td>
                                                        </tr>"; 
                                                }

                                                } //END IF ISSET

                                                // <td>". ($row['Salary_of_Month'] -   (($MONDAY_TO_DEDUCT_LATE + $Tue_TO_DEDUCT_LATE + $WED_TO_DEDUCT_LATE +  $Thurs_TO_DEDUCT_LATE + $Fri_TO_DEDUCT_LATE + $SAT_TO_DEDUCT_LATE + $Sun_TO_DEDUCT_LATE) +  ($MONDAY_TO_DEDUCT_UT +  $Tue_TO_DEDUCT_UT + $WED_TO_DEDUCT_UT  + $Thurs_TO_DEDUCT_UT +  $Fri_TO_DEDUCT_UT +  $SAT_TO_DEDUCT_UT +  $Sun_TO_DEDUCT_UT))) - ($row['sss_amount'] + $row['philhealth_amount'] + $row['pagibig_amount'] + $row['tin_amount']) + ( $MONDAY_ToADD_OT + $Tue_ToADD_OT + $WED_ToADD_OT + $Thurs_ToADD_OT + $Fri_ToADD_OT + $SAT_ToADD_OT + $Sun_ToADD_OT) ."</td>

                                                          
                                            ?>  
                                              
                                    </tbody>
                                </table>
                                                <!-- </form> -->
                            </div> <!--table-responsive END-->
                        </div> <!--tabpane-1 END-->
                                        <!-------------------------------------- break ALLOWANCE START -------------------------------------------->
                        <div class="tab-pane" id= "Allowance">
                            <div class="table-responsive" style = "overflow-y: scroll;  max-height: 500px;">
                                            <form action="gnrate_payroll_view.php" method="post">
                                            <input id="employeeID" name="Name_employeeID" type="text" style= "display:none;">         
                                                <table id="order-listing" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Transportation Allowance</th>
                                                            <th>Meal Allowance</th> 
                                                            <th>Internet Allowance</th>
                                                            <th>Other Allowances</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php 
                                            include 'config.php';
                                            //select data db


                                            $sql = "SELECT
                                                        employee_tb.empid,
                                                        employee_tb.emptranspo,
                                                        employee_tb.empmeal,
                                                        employee_tb.empinternet,
                                                        SUM(allowancededuct_tb.allowance_amount) AS total_sum
                                                    FROM
                                                        employee_tb
                                                    INNER JOIN allowancededuct_tb ON employee_tb.empid = allowancededuct_tb.id_emp
                                                    WHERE employee_tb.empid = $emp_ID
                                                ";
                                        $result = $conn->query($sql);
                                    
                                            //read data
                                            while($row = $result->fetch_assoc()){
                                                echo "<tr>
                                                        <td>" . $row['emptranspo'] . "</td>
                                                        <td>" . $row['empmeal'] . "</td>
                                                        <td>" . $row['empinternet'] . "</td>
                                                        <td>" . $row['total_sum'] . "</td>
                                                
                                                     </tr>"; 
                                            }
                                            ?>  
                                
                                        </tbody>
                                    </table>
                                </form>
                            </div> <!--table-responsive END-->
                         </div> <!--tabpane-2 END-->
                                        <!--------------- break ------------->
                        <div class="tab-pane" id= "Loan">
                        
                            <div class="table-responsive table-bordered" style = "overflow-y: scroll;  max-height: 500px;">
                                            <form action="gnrate_payroll_view.php" method="post">
                                            <input id="employeeID" name="Name_employeeID" type="text" style= "display:none;">         
                                                <table id="order-listing" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th>Amount</th> 
                                                            <th>Total</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php 
                                            include 'config.php';
                                            //select data db


                                            $sql = "SELECT
                                                        *
                                                    FROM
                                                        employee_tb
                                                    INNER JOIN allowancededuct_tb ON employee_tb.empid = allowancededuct_tb.id_emp
                                                    WHERE employee_tb.empid = $emp_ID
                                                    Group By employee_tb.empid
                                                ";
                                        $result = $conn->query($sql);
                                    
                                            //read data
                                            while($row = $result->fetch_assoc()){
                                                echo "<tr>
                                                        <td>0</td>
                                                        <td>0</td>   
                                                        <td>
                                                            
                                                        </td>                                           
                                                     </tr>"; 
                                            }
                                            ?>  
                                
                                        </tbody>
                                    </table>
                                </form>
                            </div> <!--table-responsive END-->
                            
                        </div> <!--tabpane-3 END-->
                                        <!--------------- break ------------->
                </div> <!--tab content END-->
              
                <div class="text-right mr-5 mt-3">
                    <button type="button" class="btn btn-outline-secondary">Cancel</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Print</button>
                </div>
                <?php            //para sa pag select sa attendances at employee para sa modal ng payslip
                                            $sql_attendanaaa = mysqli_query($conn, " SELECT
                                                                SUM(employee_tb.`drate`) AS Salary_of_Month,
                                                                employee_tb.`sss_amount`,
                                                                employee_tb.`tin_amount`,
                                                                employee_tb.`pagibig_amount`,
                                                                employee_tb.`philhealth_amount`,
                                                                employee_tb.`emptranspo` + employee_tb.`empmeal` + employee_tb.`empmeal`  AS Total_allowanceStandard,
                                                                employee_tb.`sss_amount` + employee_tb.`tin_amount` + employee_tb.`pagibig_amount` + employee_tb.`philhealth_amount` AS Total_deduct_governStANDARD,
                                                               
                                                                CONCAT(
                                                                        FLOOR(
                                                                            SUM(TIME_TO_SEC(attendances.total_work)) / 3600
                                                                        ),
                                                                        'H:',
                                                                        FLOOR(
                                                                            (
                                                                                SUM(TIME_TO_SEC(attendances.total_work)) % 3600
                                                                            ) / 60
                                                                        ),
                                                                        'M'
                                                                    ) AS total_hoursWORK,
                                                                     
                                                                CONCAT(
                                                                        FLOOR(
                                                                            SUM(TIME_TO_SEC(attendances.overtime)) / 3600
                                                                        ),
                                                                        ' Hour/s'
                                                                    ) AS total_hoursOT
                                                            FROM
                                                                employee_tb
                                                            INNER JOIN attendances ON employee_tb.empid = attendances.empid
                                                            WHERE attendances.status = 'Present' AND employee_tb.empid = $emp_ID");
                                            
                                            if(mysqli_num_rows($sql_attendanaaa) > 0) {
                                            $row_atteeee= mysqli_fetch_assoc($sql_attendanaaa);
                                            } else {
                                            echo "No results found schedule."; 
                                        } 
                                    ////para sa pag select sa attendances at employee para sa modal ng payslip (END)

                                    $result_governDeduct = mysqli_query($conn, " SELECT
                                         SUM(govern_amount) AS total_sum_othe_deduct 
                                        FROM 
                                        `governdeduct_tb`
                                        WHERE `id_emp`=  '$emp_ID'");
                                        $row_governDeduct = mysqli_fetch_assoc($result_governDeduct);


                                        $result_allowance = mysqli_query($conn, " SELECT
                                         SUM(allowance_amount) AS total_sum_addAllowance
                                        FROM 
                                        `allowancededuct_tb` 
                                        WHERE `id_emp`=  '$emp_ID'");
                                        $row_addAllowance = mysqli_fetch_assoc($result_allowance);
                                                                                                        ?>

                <!-- Modal -->
                <div class="modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">PAYSLIP</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="height: 640px;">

                           
                                <div class="header_view">
                                    <img src="icons/logo_hris.png" width="70px" alt="">
                                    <p class="lbl_cnfdntial">CONFIDENTIAL SLIP</p>
                                </div>

                                <div class="div1_mdl">
                                    <p class="comp_name">Slash Tech Solutions Inc.</p>
                                    <p class="lbl_payPeriod">Pay Period :</p>
                                    <p class="dt_mdl_from">07/01/22</p>
                                    <p class="lbl_to">TO</p>
                                    <p class="dt_mdl_TO">08/01/22</p>

                                    <p class="lbl_stats">Employee Status :</p>
                                    <p class="p_statss"><?php echo $row_emp['status']; ?></p>
                                </div>

                                <div class="div1_mdl">
                                    <p class="emp_no">EMPLOYEE NO.   :</p>
                                    <p class="p_empid"> <?php echo $emp_ID ?></p>
                                    <p class="p_payout">Payout        :</p>
                                    <p class="dt_pyout"><?php
                                                            date_default_timezone_set('Asia/Manila');
                                                            $current_date = date('Y / m / d');
                                                            echo $current_date;
                                                        ?>
                                    </p>
                                </div>

                                <div class="div1_mdl">
                                    <p class="emp_name">EMPLOYEE NAME  :</p>
                                    <p class="p_emp_name"><?php echo $row_emp['full_name']; ?></p>
                                </div>

                                <div class="headbody">
                                <div class="headbdy_pnl1">
                                    <p class="lbl_sss">SSS # : </p>
                                    <p class="p_sss"><?php echo $row_emp['empsss']; ?></p>
                                    <p class="lbl_tin">Tin : </p>
                                    <p class="p_tin"><?php echo $row_emp['emptin']; ?></p>
                                </div>

                                <div class="headbdy_pnl2">
                                    <p class="lbl_phl">PHILHEALTH # :</p>
                                    <P class="p_phl"><?php echo $row_emp['empphilhealth']; ?></P>
                                </div>

                                <div class="headbdy_pnl3">
                                    <p class="lbl_pgibg">PAG-IBIG # :</p>
                                    <P class="p_pgibg"><?php echo $row_emp['emppagibig']; ?></P>
                                </div>

                                </div>

                                <div class="headbody2">
                                <div class="headbdy_pnl1">
                                    <p class="lbl_earnings">Earnings</p>
                                    <p class="lbl_Hours">Hours</p>
                                    <p class="lbl_Amount">Amount</p>
                                </div>

                                <div class="headbdy_pnl2">
                                    <p class="lbl_deduct">Deduction</p>
                                    <p class="lbl_Amount2">Amount</p>
                                </div>

                                <div class="headbdy_pnl3">
                                    <p class="lbl_Balance">NET PAY</p>
                                </div>

                                </div>

                                <div class="headbody3">
                                <div class="headbdy_pnl11">
                                    <div class="div_mdlcontnt_left">
                                        <p class="lbl_bsc_pay">Basic Pay</p>
                                        <p class="p_Thrs"><?php echo $row_atteeee['total_hoursWORK']; ?></p>
                                        <p class="p_Tamount"><?php echo $row_atteeee['Salary_of_Month']; ?></p>
                                        

                                    </div>

                                    <div class="div_mdlcontnt_left1">
                                        <p class="lbl_bsc_pay">Overtime Pay</p>
                                        <p class="p_Thrs"><?php echo $row_atteeee['total_hoursOT']; ?></p>
                                        <p class="p_Tamount"><?php echo $TOTAL_ADD_OT; ?></p>
                                        

                                    </div>

                                    <div class="div_mdlcontnt_left2">
                                        <p class="lbl_bsc_pay">Allowance</p>
                                        <p class="p_Thrs"></p>
                                        <p class="p_Tamount"><?php echo $row_atteeee['Total_allowanceStandard'] + $row_addAllowance['total_sum_addAllowance']; ?></p>
                                        

                                    </div>
                                   
                                </div>

                                <div class="headbdy_pnl22">
                                    <div class="div_mdlcontnt_mid">
                                    <div class="div_mdlcontnt_mid_left">
                                        <p class="lbl_sss_se">SSS SE CONTRI</p>
                                        <p class="lbl_philhlt_c">PHILHEALTH CONTRI</p>
                                        <p class="lbl_sss_se">TIN CONTRI</p>
                                        <p class="lbl_philhlt_c">PAGIBIG CONTRI</p>
                                        <p class="lbl_hdmf">OTHER CONTRI</p>
                                        <p class="lbl_hdmf">Late & Undertime</p>
                                        

                                        <p class="lbl_advnc_p">ADVANCE PAYMENT</p>
                                        <p class="lbl_sssL">SSS LOAN</p>
                                        <p class="phlhlt_L">PHILHEALTH LOAN</p>
                                        <p class="hdmf_L">HDMF LOAN</p>
                                    </div>
                                    <div class="div_mdlcontnt_mid_right">
                                        <p class="lbl_sss_se"><?php echo $row_atteeee['sss_amount']; ?></p>
                                        <p class="lbl_philhlt_c"><?php echo $row_atteeee['philhealth_amount']; ?></p>
                                        <p class="lbl_sss_se"><?php echo $row_atteeee['tin_amount']; ?></p>
                                        <p class="lbl_philhlt_c"><?php echo $row_atteeee['pagibig_amount']; ?></p>
                                        <p class="lbl_philhlt_c"><?php echo $row_governDeduct['total_sum_othe_deduct']; ?></p>
                                        <p class="lbl_philhlt_c"><?php echo $UT_LATE_DEDUCT_TOTAL ?></p>

                                        <p class="lbl_advnc_p">00.00</p>
                                        <p class="lbl_sssL">----</p>
                                        <p class="phlhlt_L">----</p>
                                        <p class="hdmf_L">----</p>
                                    </div>
                                        
                                    
                                    </div>
                                    
                                </div>

                                <div class="headbdy_pnl33">
                                    <div class="div_mdlcontnt_right">
                                    <p class="p_balance"><?php echo ($row_atteeee['Salary_of_Month'] + ( $row_atteeee['Total_allowanceStandard'] + $row_addAllowance['total_sum_addAllowance']) + $TOTAL_ADD_OT)
                                        - ( $row_atteeee['sss_amount'] + $row_atteeee['philhealth_amount'] +  $row_atteeee['tin_amount'] +  $row_atteeee['pagibig_amount'] +  $row_governDeduct['total_sum_othe_deduct'] +  $UT_LATE_DEDUCT_TOTAL );
                                    ?></p>
                                    
                                    </div>
                                </div>
                                </div>

                                <div class="headbody2">
                                <div class="headbdy_pnl1">
                                    <p class="lbl_earnings">Total Earnings :</p>
                                    <p class="lbl_Hours"><?php echo $row_atteeee['Salary_of_Month'] + ( $row_atteeee['Total_allowanceStandard'] + $row_addAllowance['total_sum_addAllowance']) + $TOTAL_ADD_OT; ?></p>
                                </div>

                                <div class="headbdy_pnl2">
                                    <p class="lbl_deduct">Total Deduction : </p>
                                    <p class="lbl_Amount2"><?php echo  $row_atteeee['sss_amount'] + $row_atteeee['philhealth_amount'] +  $row_atteeee['tin_amount'] +  $row_atteeee['pagibig_amount'] +  $row_governDeduct['total_sum_othe_deduct'] +  $UT_LATE_DEDUCT_TOTAL ;?></p>
                                </div>

                                <div class="headbdy_pnl3">
                                    <!-- <p class="lbl_deduct">Net Total : </p> -->
                                    <p class="lbl_Balance"><?php //echo ($row_atteeee['Salary_of_Month'] + ( $row_atteeee['Total_allowanceStandard'] + $row_addAllowance['total_sum_addAllowance']) + $TOTAL_ADD_OT)
                                       // - ( $row_atteeee['sss_amount'] + $row_atteeee['philhealth_amount'] +  $row_atteeee['tin_amount'] +  $row_atteeee['pagibig_amount'] +  $row_governDeduct['total_sum_othe_deduct'] +  $UT_LATE_DEDUCT_TOTAL );
                                    ?></p>
                                </div>

                                </div>

                            </div>
                             <!-- <div class="input-group mb-3">
                                <h5 style="margin-left: 30px ; margin-top : 10px; ">NET SALARY: </h5>
                                <span class="input-group-text" style=" margin-top : 5px;">23123</span>
                            </div> -->
                           
                           


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="download-pdf">Download PDF</button>

                            </div>
                        </div>
                    </div>

                    <!-- <script>$('#save-as-pdf').click(function() {
                            var modalContent = $('.modal-body').html();
                            $.ajax({
                            url: 'generate-pdf.php',
                            method: 'POST',
                            data: { content: modalContent },
                            success: function(response) {
                                window.location.href = response;
                            }
                            });
                        });
                    </script> -->
                </div><!--  End Modal -->

        </div> <!--  End card-body -->
    </div> <!--  End card -->
</div><!--  End Container -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="path/to/mpdf/autoload.php"></script>
<script>
    $(document).ready(function() {
        $('#download-pdf').click(function() {
            html2canvas(document.querySelector('#staticBackdrop')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var pdf = new jsPDF();
                pdf.addImage(imgData, 'PNG', 0, 0, 210, 297);
                pdf.save('payslip.pdf');
            });
          
        });
    });
</script>



    

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
<!-- <script>
        // Add an event listener to the "download-pdf" button
                document.getElementById("download-pdf").addEventListener("click", function() {
                // Create a new jsPDF instance
                var doc = new jsPDF();

                // Get the HTML content of the modal
                var modalContent = document.getElementById("staticBackdrop").innerHTML;

                // Set the content of the PDF
                doc.fromHTML(modalContent, 15, 15, {
                    "width": 170
                });

                // Download the PDF
                doc.save("modal.pdf");
                });
    </script> -->
    
</body>
<!-- <script src="js/gnratePyroll.js"></script> -->
    
</html>