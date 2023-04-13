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
            $msg = '';
            $error = false;
            $result = mysqli_query($conn, "SELECT * FROM emp_dtr_tb WHERE `status`='Pending'");

            $query = "UPDATE emp_dtr_tb SET `status`='Approved' WHERE `status`='Pending'";
            mysqli_query($conn, $query);

            while ($row_dtr = mysqli_fetch_assoc($result)){  
            $employeeid = $row_dtr['emp_id'];
            $date_dtr = $row_dtr['date'];
            $time_dtr = $row_dtr['time'];
            $type_dtr = $row_dtr['type'];
            $status_dtr = $row_dtr['status'];
            
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
                        
                            $query = "SELECT * FROM emp_dtr_tb WHERE `status` = 'Approved'";
                            $query_run = mysqli_query($conn, $query);
                        
                            $attendance_rows = array(); // create an array to hold attendance rows
                        
                            if($query_run) {
                                while ($employee_row = mysqli_fetch_assoc($query_run)) {
                                    $employee_id = $employee_row['emp_id'];
                                    $attendance_rows[] = "('$employee_id', '$date_dtr', '$time_dtr', '$late', 'Present')"; // add attendance row to the array
                                }
                        
                                if(!empty($attendance_rows)){
                                    $sql = "INSERT INTO attendances (`empid`, `date`, `time_in`, `late`, `status`) 
                                            VALUES " . implode(',', $attendance_rows); // join attendance rows into a single INSERT statement
                        
                                    $result = mysqli_query($conn, $sql);
                        
                                    if($result){
                                        header("Location: ../../dtr_admin.php?msg=You Approved All Request Successfully");
                                    } else {
                                        echo "Failed: " . mysqli_error($conn);
                                    }
                                }
                            } else {
                                echo "Failed: " . mysqli_error($conn);
                            }
                        }

          } //Close Bracket ng type_dtr 'IN'
        } //Close Bracket ng While approach
      }
    }

      } else {
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

