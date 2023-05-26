<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

    if (isset($_POST['time_in'])) {
        date_default_timezone_set('Asia/Manila');

        $employee_id = $_SESSION['empid'];
        $timeIn = date('H:i:s');
        $dateIn = date('Y-m-d');
    
                         $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employee_id'");
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

                          $day_of_week = date('l', strtotime($dateIn)); 

                          if ($day_of_week === 'Monday') {
                            if ($timeIn > $col_monday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_monday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                    VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Monday

                        else if ($day_of_week === 'Tuesday') {
                            if ($timeIn > $col_tuesday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_tuesday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                    VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Tuesday

                        else if ($day_of_week === 'Wednesday') {
                            if ($timeIn > $col_wednesday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_wednesday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                    VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Wednesday 

                        else if ($day_of_week === 'Thursday') {
                            if ($timeIn > $col_thursday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_thursday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                            VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Thursday

                        else if ($day_of_week === 'Friday') {
                            if ($timeIn > $col_friday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_friday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                    VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Friday

                        else if ($day_of_week === 'Saturday') {
                            if ($timeIn > $col_saturday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_saturday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                    VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Saturday

                        else if ($day_of_week === 'Sunday') {
                            if ($timeIn > $col_sunday_timein) {
                                $time_in_datetime = new DateTime($timeIn);
                                $scheduled_time = new DateTime($col_sunday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $late = $interval->format('%h:%i:%s');
                            }
                        
                            $query = "SELECT * FROM attendances WHERE `empid` = '$employee_id' AND `date` = '$dateIn'";
                            $query_run = mysqli_query($conn, $query);
                        
                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    header("Location: ../../Dashboard.php?error=You have already Time In for this day!");
                                } else {
                                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                                    VALUES ('Present', '$employee_id', '$dateIn', '$timeIn', '$late')";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        header("Location: ../../Dashboard.php");
                                        exit();
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                 }
                            }
                        } //Sunday

           }                            
         }

    }

?>