<?php
$conn = mysqli_connect("localhost", "root", "", "hris_db");

$query = "SELECT * FROM emp_dtr_tb WHERE `status`='Pending'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
  header("Location: ../../dtr_admin.php?error=No Pending Requests");
  exit();
}

// Check if the user clicked Approve All or Reject All Button
if (isset($_POST['approve_all']) || isset($_POST['reject_all'])) {
  $query = "SELECT DISTINCT `status` FROM emp_dtr_tb WHERE `status`='Pending'";
  $result_pending = mysqli_query($conn, $query);

  if (mysqli_num_rows($result_pending) == 1) {
    $status = mysqli_fetch_assoc($result_pending)['status'];

    if ($status == 'Pending') {
      if (isset($_POST['approve_all'])) {
        $query = "UPDATE emp_dtr_tb SET `status`='Approved' WHERE `status`='Pending'";
        mysqli_query($conn, $query);

        $msg = '';
        $error = false;
        $result = mysqli_query($conn, "SELECT * FROM emp_dtr_tb WHERE `status`='Approved'");

          while ($row_dtr = mysqli_fetch_assoc($result)) {
          $employeeid = $row_dtr['emp_id'];
          $date_dtr = $row_dtr['date'];
          $time_dtr = $row_dtr['time'];
          $type_dtr = $row_dtr['type'];
          $status_dtr = $row_dtr['status'];

          // Update the status of the request
          $query = "UPDATE emp_dtr_tb SET `status`='Approved' WHERE `id`={$row_dtr['id']} AND `status`='Pending'";
          $query_run = mysqli_query($conn, $query);
        
          if ($query_run) {
            // Insert into the attendances table
            if ($type_dtr === 'IN') {
            // Calculate late if time_in is later than 9am
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
                        $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                        $result_attendance = mysqli_query($conn, $sql);
                      
                        if (!$result_attendance) {
                          $msg = "Failed to insert into the attendances table: " . mysqli_error($conn);
                          $error = true;
                          break; 
                        }
                        if (!$error) {
                          $msg = "You Approved all requests successfully.";
                        }
                        header("Location: ../../dtr_admin.php?msg=$msg");
                      } //Close bracket ng Monday

                      if($day_of_week === 'Tuesday'){
                        $late = '';
                        if($time_dtr > $col_tuesday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_tuesday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                        $result_attendance = mysqli_query($conn, $sql);
                      
                        if (!$result_attendance) {
                          $msg = "Failed to insert into the attendances table: " . mysqli_error($conn);
                          $error = true;
                          break; 
                        }
                        if (!$error) {
                          $msg = "You Approved all requests successfully.";
                        }
                        header("Location: ../../dtr_admin.php?msg=$msg");
                      } //Close bracket ng Monday

                }
              }
            }
          } //Query run
       

            
             if($type_dtr === 'OUT'){
              $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employeeid'");
              if(mysqli_num_rows($result_emp_sched) > 0) {
              $row_emp_sched = mysqli_fetch_assoc($result_emp_sched);
              $schedID = $row_emp_sched['schedule_name'];

             $result_sched_tb = mysqli_query($conn, "SELECT * FROM `schedule_tb` WHERE `schedule_name` = '$schedID'");
                     if(mysqli_num_rows($result_sched_tb) > 0) {
                         $row_sched_tb = mysqli_fetch_assoc($result_sched_tb);
                         $sched_name =  $row_sched_tb['schedule_name'];
                         $col_tuesday_timeout =  $row_sched_tb['tues_timeout'];

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
                                header("Location: ../../dtr_admin.php?msg=You Approved All Request Successfully");
                            } else {
                                echo "Failed: " . mysqli_error($conn);
                            }
                        }
                      } 
                } //Close bracket Monday

                    if($day_of_week === 'Tuesday'){
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
                                header("Location: ../../dtr_admin.php?msg=You Approved All Request Successfully");
                            } else {
                                echo "Failed: " . mysqli_error($conn);
                            }
                        }
                      } 
                } //Close bracket Tuesday

            } 
          } 
        } 
    }//While loop close bracket
  }//Approve button
  
  else {
        $query = "UPDATE emp_dtr_tb SET `status`='Rejected' WHERE `status`='Pending'";
        $result = mysqli_query($conn, $query);

        if ($result) {
          header("Location: ../../dtr_admin.php?msg=Rejected the All Request Successfully");
        } else {
          echo "Error updating status: " . mysqli_error($conn);
        }
      }
    } else {
      header("Location: ../../dtr_admin.php?error=There are requests with different statuses.");
    }
    mysqli_close($conn);
  }
}

?>

