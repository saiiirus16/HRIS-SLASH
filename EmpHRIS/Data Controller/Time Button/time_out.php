<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

    if (isset($_POST['time_out'])) {
        date_default_timezone_set('Asia/Manila');

        $employee_id = $_SESSION['empid'];
        $timeOut = date('H:i:s');
        $dateOut = date('Y-m-d');



                $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employee_id'");
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


                        $day_of_week = date('l', strtotime($dateOut)); // get the day of the week using the "l" format specifier


                        // Check if the user has already timed out for the day
                        $existingTimeoutResult = mysqli_query($conn, "SELECT time_out FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                        $existingTimeoutRow = mysqli_fetch_assoc($existingTimeoutResult);
                        if (!empty($existingTimeoutRow['time_out']) && $existingTimeoutRow['time_out'] !== '00:00:00') {
                            // Display an error message if the user has already timed out
                            echo "You already timed out for this day!";
                            exit();
                        }


                        if ($day_of_week === 'Monday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_monday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_monday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_monday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_monday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Monday

                        else if ($day_of_week === 'Tuesday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_tuesday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_tuesday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_tuesday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_tuesday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Tuesday

                        else if ($day_of_week === 'Wednesday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_wednesday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_wednesday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_wednesday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_wednesday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Wednesday

                        else if ($day_of_week === 'Thursday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_thursday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_thursday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_thursday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_thursday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Thursday

                        else if ($day_of_week === 'Friday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_friday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_friday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_friday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_friday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Friday

                        else if ($day_of_week === 'Saturday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_saturday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_saturday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_saturday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_saturday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Saturday

                        else if ($day_of_week === 'Sunday') {
                            $early_out = '';
                            $overtime = '';
                            if ($timeOut < $col_sunday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_sunday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $early_out = $interval->format('%h:%i:%s');
                            } else if ($timeOut > $col_sunday_timeout) {
                                $time_out_datetime = new DateTime($timeOut);
                                $scheduled_time = new DateTime($col_sunday_timeout);
                                $interval = $time_out_datetime->diff($scheduled_time);
                                $overtime = $interval->format('%h:%i:%s');
                            }
                            $result = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$dateOut' AND `empid` = '$employee_id'");
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $fetch_timein = $row['time_in'];
                            }
                            $total_work = '';
                    
                            $total_work = strtotime($timeOut) - strtotime($fetch_timein) - 7200;
                            $total_work = date('H:i:s', $total_work);
                    
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                            $query_run = mysqli_query($conn, $query);
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    $sql = "UPDATE attendances SET `time_out`='$timeOut', `early_out`='$early_out',
                                            `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employee_id' AND `date` = '$dateOut'";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                } else {
                                    header("Location: ../../Dashboard.php?error=You need to Time In first for this day!");
                                }
                            }
                        } //Sunday

            }
        }
    }
    
?>