<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);
/************************* For Approve Button ***************************/
if(isset($_POST['approve_btn']))
{

    $tableid = $_POST['input'];

    $result_dtr = mysqli_query($conn, "SELECT * FROM emp_dtr_tb WHERE id = '$tableid'");
    if(mysqli_num_rows($result_dtr) > 0) {
        $row_dtr = mysqli_fetch_assoc($result_dtr);
    }
    $employeeid = $row_dtr['emp_id'];
    $date_dtr = $row_dtr['date'];
    $time_dtr = $row_dtr['time'];
    $type_dtr = $row_dtr['type'];
    $status_dtr = $row_dtr['status'];

    if($status_dtr === 'Approved'){
        header("Location: ../../dtr_admin.php?error=You cannot APPROVE a request that is already APPROVED");
    }
    else if($status_dtr === 'Rejected'){
        header("Location: ../../dtr_admin.php?error=You cannot APPROVE a request that is already REJECTED");
    } else {
        if($type_dtr === 'IN'){
                        $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employeeid'");
                         if(mysqli_num_rows($result_emp_sched) > 0) {
                         $row_emp_sched = mysqli_fetch_assoc($result_emp_sched);
                         $schedID = $row_emp_sched['schedule_name'];
                    

                        $result_sched_tb = mysqli_query($conn, "SELECT * FROM `schedule_tb` WHERE `schedule_name` = '$schedID'");
                                if(mysqli_num_rows($result_sched_tb) > 0) {
                                    $row_sched_tb = mysqli_fetch_assoc($result_sched_tb);
                                    $sched_name =  $row_sched_tb['schedule_name'];
                                    $col_monday_timein =  $row_sched_tb['mon_timein'];
                                    $col_tuesday_timein =  $row_sched_tb['tues_timein'];
                                    $col_wednesday_timein =  $row_sched_tb['wed_timein'];
                                    $col_thursday_timein =  $row_sched_tb['thurs_timein'];
                                    $col_friday_timein =  $row_sched_tb['fri_timein'];
                                    $col_saturday_timein =  $row_sched_tb['sat_timein'];
                                    $col_sunday_timein =  $row_sched_tb['sun_timein'];

                                    $day_of_week = date('l', strtotime($date_dtr)); // get the day of the week using the "l" format specifier  
                                    // echo $day_of_week;
                                    
                                    if($day_of_week === 'Monday'){
                                        $late = '';
                                        if($time_dtr > $col_monday_timein){
                                            $time_in_datetime = new DateTime($time_dtr);
                                            $scheduled_time = new DateTime($col_monday_timein);
                                            $interval = $time_in_datetime->diff($scheduled_time);
                                            $late = $interval->format('%h:%i:%s');
                                            

                                    }
                                        $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                        $query_run = mysqli_query($conn, $query);

                                        if($query_run) {
                                            $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                    VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            if($result){
                                                header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                            } else {
                                                echo "Failed: " . mysqli_error($conn);
                                            }
                                        } else {
                                            echo "Failed: " . mysqli_error($conn);
                                        }
                                    } //Close Bracket day of week with Monday

                                        else if($day_of_week === 'Tuesday'){
                                            $late = '';
                                            if($time_dtr > $col_tuesday_timein){
                                                $time_in_datetime = new DateTime($time_dtr);
                                                $scheduled_time = new DateTime($col_tuesday_timein);
                                                $interval = $time_in_datetime->diff($scheduled_time);
                                                $late = $interval->format('%h:%i:%s');
                                                

                                        }
                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                            $query_run = mysqli_query($conn, $query);

                                            if($query_run) {
                                                $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                        VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                                $result = mysqli_query($conn, $sql);
                                                
                                                if($result){
                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                } else {
                                                    echo "Failed: " . mysqli_error($conn);
                                                }
                                            } else {
                                                echo "Failed: " . mysqli_error($conn);
                                            }
                                        } //Close Bracket day of week with Tuesday

                                            else if($day_of_week === 'Wednesday'){
                                                $late = '';
                                                if($time_dtr > $col_wednesday_timein){
                                                    $time_in_datetime = new DateTime($time_dtr);
                                                    $scheduled_time = new DateTime($col_wednesday_timein);
                                                    $interval = $time_in_datetime->diff($scheduled_time);
                                                    $late = $interval->format('%h:%i:%s');
                                                    

                                            }
                                                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                $query_run = mysqli_query($conn, $query);

                                                if($query_run) {
                                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                            VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                                    $result = mysqli_query($conn, $sql);
                                                    
                                                    if($result){
                                                        header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                    } else {
                                                        echo "Failed: " . mysqli_error($conn);
                                                    }
                                                } else {
                                                    echo "Failed: " . mysqli_error($conn);
                                                }
                                            } //Close Bracket day of week with Wednesday

                                            else if($day_of_week === 'Thursday'){
                                                $late = '';
                                                if($time_dtr > $col_thursday_timein){
                                                    $time_in_datetime = new DateTime($time_dtr);
                                                    $scheduled_time = new DateTime($col_thursday_timein);
                                                    $interval = $time_in_datetime->diff($scheduled_time);
                                                    $late = $interval->format('%h:%i:%s');
                                                    

                                            }
                                                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                $query_run = mysqli_query($conn, $query);

                                                if($query_run) {
                                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                            VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                                    $result = mysqli_query($conn, $sql);
                                                    
                                                    if($result){
                                                        header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                    } else {
                                                        echo "Failed: " . mysqli_error($conn);
                                                    }
                                                } else {
                                                    echo "Failed: " . mysqli_error($conn);
                                                }
                                            } //Close Bracket day of week with Thursday

                                            else if($day_of_week === 'Friday'){
                                                $late = '';
                                                if($time_dtr > $col_friday_timein){
                                                    $time_in_datetime = new DateTime($time_dtr);
                                                    $scheduled_time = new DateTime($col_friday_timein);
                                                    $interval = $time_in_datetime->diff($scheduled_time);
                                                    $late = $interval->format('%h:%i:%s');
                                                    

                                            }
                                                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                $query_run = mysqli_query($conn, $query);

                                                if($query_run) {
                                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                            VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                                    $result = mysqli_query($conn, $sql);
                                                    
                                                    if($result){
                                                        header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                    } else {
                                                        echo "Failed: " . mysqli_error($conn);
                                                    }
                                                } else {
                                                    echo "Failed: " . mysqli_error($conn);
                                                }
                                            } //Close Bracket day of week with Friday

                                            else if($day_of_week === 'Saturday'){
                                                $late = '';
                                                if($time_dtr > $col_saturday_timein){
                                                    $time_in_datetime = new DateTime($time_dtr);
                                                    $scheduled_time = new DateTime($col_saturday_timein);
                                                    $interval = $time_in_datetime->diff($scheduled_time);
                                                    $late = $interval->format('%h:%i:%s');
                                                    

                                            }
                                                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                $query_run = mysqli_query($conn, $query);

                                                if($query_run) {
                                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                            VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                                    $result = mysqli_query($conn, $sql);
                                                    
                                                    if($result){
                                                        header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                    } else {
                                                        echo "Failed: " . mysqli_error($conn);
                                                    }
                                                } else {
                                                    echo "Failed: " . mysqli_error($conn);
                                                }
                                            } //Close Bracket day of week with Saturday

                                            else if($day_of_week === 'Sunday'){
                                                $late = '';
                                                if($time_dtr > $col_sunday_timein){
                                                    $time_in_datetime = new DateTime($time_dtr);
                                                    $scheduled_time = new DateTime($col_sunday_timein);
                                                    $interval = $time_in_datetime->diff($scheduled_time);
                                                    $late = $interval->format('%h:%i:%s');
                                                    

                                            }
                                                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                $query_run = mysqli_query($conn, $query);

                                                if($query_run) {
                                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                                            VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                                                    $result = mysqli_query($conn, $sql);
                                                    
                                                    if($result){
                                                        header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                    } else {
                                                        echo "Failed: " . mysqli_error($conn);
                                                    }
                                                } else {
                                                    echo "Failed: " . mysqli_error($conn);
                                                }
                                            } //Close bracket sa Sunday
                                         } //Close bracket sa result_sched_tb
                                     }
                                 }
                                            else if ($type_dtr === 'OUT') {
                                                $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employeeid'");
                                                if(mysqli_num_rows($result_emp_sched) > 0) {
                                                $row_emp_sched = mysqli_fetch_assoc($result_emp_sched);
                                                $schedID = $row_emp_sched['schedule_name'];
                                           
                                                    
                                               $result_sched_tb = mysqli_query($conn, "SELECT * FROM `schedule_tb` WHERE `schedule_name` = '$schedID'");
                                                       if(mysqli_num_rows($result_sched_tb) > 0) {
                                                           $row_sched_tb = mysqli_fetch_assoc($result_sched_tb);
                                                           $sched_name =  $row_sched_tb['schedule_name'];
                                                           $col_monday_timeout =  $row_sched_tb['mon_timeout'];
                                                           $col_tuesday_timeout =  $row_sched_tb['tues_timeout'];
                                                           $col_wednesday_timeout =  $row_sched_tb['wed_timeout'];
                                                           $col_thursday_timeout =  $row_sched_tb['thurs_timeout'];
                                                           $col_friday_timeout =  $row_sched_tb['fri_timeout'];
                                                           $col_saturday_timeout =  $row_sched_tb['sat_timeout'];
                                                           $col_sunday_timeout =  $row_sched_tb['sun_timeout'];


                                                $day_of_week = date('l', strtotime($date_dtr)); // get the day of the week using the "l" format specifier


                                                if($day_of_week === 'Monday'){
                                                    $early_out = '';
                                                    $overtime = '';
                                                    if($time_dtr < $col_monday_timeout){
                                                        $time_out_datetime = new DateTime($time_dtr);
                                                        $scheduled_time = new DateTime($col_monday_timeout);
                                                        $interval = $time_out_datetime->diff($scheduled_time);
                                                        $early_out = $interval->format('%h:%i:%s');   
                                                }else if($time_dtr > $col_monday_timeout){
                                                        $time_out_datetime = new DateTime($time_dtr);
                                                        $scheduled_time = new DateTime($col_monday_timeout);
                                                        $interval = $time_out_datetime->diff($scheduled_time);
                                                        $overtime = $interval->format('%h:%i:%s');


                                                }
                                                        $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                        if(mysqli_num_rows($result) > 0) {
                                                        $row = mysqli_fetch_assoc($result);
                                                        $fetch_timein = $row['time_in'];
                                                        }
                                                        $total_work = '';

                                                        $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                        $total_work = date('H:i:s', $total_work);

                                                        $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                        $query_run = mysqli_query($conn, $query);

                                                        if($query_run) {
                                                            $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                            $result = mysqli_query($conn, $sql);
                                                            if(mysqli_num_rows($result) > 0) {
                                                                $row = mysqli_fetch_assoc($result);
                                                                $attend_id = $row['id'];

                                                                $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                            if($update_attendance_result){
                                                                header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                            } else {
                                                                echo "Failed: " . mysqli_error($conn);
                                                            }
                                                        }
                                                    } 
                                              } //day of week with Monday Close bracket

                                                    else if($day_of_week === 'Tuesday'){
                                                        $early_out = '';
                                                        $overtime = '';
                                                        if($time_dtr < $col_tuesday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_tuesday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $early_out = $interval->format('%h:%i:%s');   
                                                    }else if($time_dtr > $col_tuesday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_tuesday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $overtime = $interval->format('%h:%i:%s');

                                                    }
                                                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                            if(mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $fetch_timein = $row['time_in'];
                                                            }
                                                            $total_work = '';

                                                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                            $total_work = date('H:i:s', $total_work);

                                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                            $query_run = mysqli_query($conn, $query);

                                                            if($query_run) {
                                                                $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                                $result = mysqli_query($conn, $sql);
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $attend_id = $row['id'];

                                                                    $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                    `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                    $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                                if($update_attendance_result){
                                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                                } else {
                                                                    echo "Failed: " . mysqli_error($conn);
                                                                }
                                                            }
                                                        } 
                                                    } //day of week with Tuesday Close bracket

                                                    else if($day_of_week === 'Wednesday'){
                                                        $early_out = '';
                                                        $overtime = '';
                                                        if($time_dtr < $col_wednesday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_wednesday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $early_out = $interval->format('%h:%i:%s');   
                                                    }else if($time_dtr > $col_wednesday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_wednesday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $overtime = $interval->format('%h:%i:%s');


                                                    }
                                                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                            if(mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $fetch_timein = $row['time_in'];
                                                            }
                                                            $total_work = '';

                                                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                            $total_work = date('H:i:s', $total_work);

                                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                            $query_run = mysqli_query($conn, $query);

                                                            if($query_run) {
                                                                $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                                $result = mysqli_query($conn, $sql);
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $attend_id = $row['id'];

                                                                    $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                    `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                    $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                                if($update_attendance_result){
                                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                                } else {
                                                                    echo "Failed: " . mysqli_error($conn);
                                                                }
                                                            }
                                                        } 
                                                    } //day of week with Wednesday Close bracket

                                                    else if($day_of_week === 'Thursday'){
                                                        $early_out = '';
                                                        $overtime = '';
                                                        if($time_dtr < $col_thursday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_thursday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $early_out = $interval->format('%h:%i:%s');   
                                                    }else if($time_dtr > $col_thursday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_thursday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $overtime = $interval->format('%h:%i:%s');


                                                    }
                                                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                            if(mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $fetch_timein = $row['time_in'];
                                                            }
                                                            $total_work = '';

                                                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                            $total_work = date('H:i:s', $total_work);

                                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                            $query_run = mysqli_query($conn, $query);

                                                            if($query_run) {
                                                                $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                                $result = mysqli_query($conn, $sql);
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $attend_id = $row['id'];

                                                                    $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                    `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                    $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                                if($update_attendance_result){
                                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                                } else {
                                                                    echo "Failed: " . mysqli_error($conn);
                                                                }
                                                            }
                                                        } 
                                                    } //day of week with Thursday Close bracket

                                                    else if($day_of_week === 'Friday'){
                                                        $early_out = '';
                                                        $overtime = '';
                                                        if($time_dtr < $col_friday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_friday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $early_out = $interval->format('%h:%i:%s');   
                                                    }else if($time_dtr > $col_friday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_friday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $overtime = $interval->format('%h:%i:%s');


                                                    }
                                                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                            if(mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $fetch_timein = $row['time_in'];
                                                            }
                                                            $total_work = '';

                                                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                            $total_work = date('H:i:s', $total_work);

                                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                            $query_run = mysqli_query($conn, $query);

                                                            if($query_run) {
                                                                $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                                $result = mysqli_query($conn, $sql);
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $attend_id = $row['id'];

                                                                    $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                    `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                    $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                                if($update_attendance_result){
                                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                                } else {
                                                                    echo "Failed: " . mysqli_error($conn);
                                                                }
                                                            }
                                                        } 
                                                    } //day of week with Friday Close bracket

                                                    else if($day_of_week === 'Saturday'){
                                                        $early_out = '';
                                                        $overtime = '';
                                                        if($time_dtr < $col_saturday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_saturday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $early_out = $interval->format('%h:%i:%s');   
                                                    }else if($time_dtr > $col_saturday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_saturday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $overtime = $interval->format('%h:%i:%s');


                                                    }
                                                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                            if(mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $fetch_timein = $row['time_in'];
                                                            }
                                                            $total_work = '';

                                                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                            $total_work = date('H:i:s', $total_work);

                                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                            $query_run = mysqli_query($conn, $query);

                                                            if($query_run) {
                                                                $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                                $result = mysqli_query($conn, $sql);
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $attend_id = $row['id'];

                                                                    $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                    `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                    $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                                if($update_attendance_result){
                                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                                } else {
                                                                    echo "Failed: " . mysqli_error($conn);
                                                                }
                                                            }
                                                        } 
                                                    } //day of week with Saturday Close bracket
                                                    
                                                    else if($day_of_week === 'Sunday'){
                                                        $early_out = '';
                                                        $overtime = '';
                                                        if($time_dtr < $col_sunday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_sunday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $early_out = $interval->format('%h:%i:%s');   
                                                    }else if($time_dtr > $col_sunday_timeout){
                                                            $time_out_datetime = new DateTime($time_dtr);
                                                            $scheduled_time = new DateTime($col_sunday_timeout);
                                                            $interval = $time_out_datetime->diff($scheduled_time);
                                                            $overtime = $interval->format('%h:%i:%s');


                                                    }
                                                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                                                            if(mysqli_num_rows($result) > 0) {
                                                            $row = mysqli_fetch_assoc($result);
                                                            $fetch_timein = $row['time_in'];
                                                            }
                                                            $total_work = '';

                                                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                                                            $total_work = date('H:i:s', $total_work);

                                                            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                                                            $query_run = mysqli_query($conn, $query);

                                                            if($query_run) {
                                                                $sql = "SELECT id FROM `attendances` WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                                                                $result = mysqli_query($conn, $sql);
                                                                if(mysqli_num_rows($result) > 0) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    $attend_id = $row['id'];

                                                                    $update_attendance_query = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                                                                    `overtime`='$overtime', `total_work`='$total_work' WHERE `id`='$attend_id'";
                                                                    $update_attendance_result = mysqli_query($conn, $update_attendance_query);
                                                                if($update_attendance_result){
                                                                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                                                                } else {
                                                                    echo "Failed: " . mysqli_error($conn);
                                                                }
                                                            }
                                                        } 
                                                    } //day of week with Sunday Close bracket



                                            } // Close bracket sa result_sched_tb
                                         }                            
                                      } //type_dtr close bracket

            }
         } //Close bracket sa approve_btn
/************************* End of Approve Button ***************************/


/************************* For Reject Button ***************************/
if(isset($_POST['reject_btn']))
{

    $tableid = $_POST['input'];

    $result_dtr = mysqli_query($conn, " SELECT * FROM emp_dtr_tb WHERE id = '$tableid'");
    if(mysqli_num_rows($result_dtr) > 0) {
        $row_dtr = mysqli_fetch_assoc($result_dtr);
}
    $status_dtr = $row_dtr['status'];
    
    if($status_dtr === 'Approved'){
        header("Location: ../../dtr_admin.php?error=You cannot REJECT a request that is already APPROVED");
    }
    else if($status_dtr === 'Rejected'){
        header("Location: ../../dtr_admin.php?error=You cannot REJECT a request that is already REJECTED");
    }else{
        $query = "UPDATE emp_dtr_tb SET `status` ='Rejected' WHERE `id`='$empid'";
        $query_run = mysqli_query($conn, $query);
    
        if($query_run)
        {
            header("Location: ../../dtr_admin.php?msg=You Rejected this Request");
        }
        else
        {
            echo "Failed: " . mysqli_error($conn);
        }
    
    }
   
}
/************************* End of Reject Button ***************************/
?>