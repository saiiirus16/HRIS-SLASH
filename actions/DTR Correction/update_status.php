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

                      else if($day_of_week === 'Tuesday'){
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
                      } //Close bracket ng Tuesday

                      else if($day_of_week === 'Wednesday'){
                        $late = '';
                        if($time_dtr > $col_wednesday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_wednesday_timein);
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
                      } //Close bracket ng Wednesday

                      else if($day_of_week === 'Thursday'){
                        $late = '';
                        if($time_dtr > $col_thursday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_thursday_timein);
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
                      } //Close bracket ng Thursday

                      else if($day_of_week === 'Friday'){
                        $late = '';
                        if($time_dtr > $col_friday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_friday_timein);
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
                      } //Close bracket ng Friday

                      else if($day_of_week === 'Saturday'){
                        $late = '';
                        if($time_dtr > $col_saturday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_saturday_timein);
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
                      } //Close bracket ng Saturday

                      else if($day_of_week === 'Sunday'){
                        $late = '';
                        if($time_dtr > $col_sunday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_sunday_timein);
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
                      } //Close bracket ng Saturday


                    }
                  }
            } 
            else if($type_dtr === 'OUT') {
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
                      }
                    } //Close MOnday
                }
              }

            }
          }
        }
      }
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

