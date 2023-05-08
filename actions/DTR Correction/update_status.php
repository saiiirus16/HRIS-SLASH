<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

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
          $employeeid = $row_dtr['empid'];
          $date_dtr = $row_dtr['date'];
          $time_dtr = $row_dtr['time'];
          $type_dtr = $row_dtr['type'];
          $status_dtr = $row_dtr['status'];

          $query = "UPDATE emp_dtr_tb SET `status`='Approved' WHERE `id`={$row_dtr['id']} AND `status`='Pending'";
          $query_run = mysqli_query($conn, $query);
        
          if ($query_run) {
            if ($type_dtr === 'IN') {
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

                       $day_of_week = date('l', strtotime($date_dtr));
                       
                       if($day_of_week === 'Monday'){
                           $late = '';
                           if($time_dtr > $col_monday_timein){
                               $time_in_datetime = new DateTime($time_dtr);
                               $scheduled_time = new DateTime($col_monday_timein);
                               $interval = $time_in_datetime->diff($scheduled_time);
                               $late = $interval->format('%h:%i:%s');       
                       }
                       $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                       if (mysqli_num_rows($result_attendance) == 0) {
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
                      }else{
                         $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                         $result_attendance = mysqli_query($conn, $sql);
                        
                         if (!$result_attendance) {
                           $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                           $error = true;
                           break; 
                         }
                         if (!$error) {
                          $msg = "You Approved all requests successfully.";
                        }
                        header("Location: ../../dtr_admin.php?msg=$msg");
                      }
                    } //Monday Close Bracket

                      else if($day_of_week === 'Tuesday'){
                        $late = '';
                        if($time_dtr > $col_tuesday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_tuesday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                        if (mysqli_num_rows($result_attendance) == 0) {
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
                        }else{
                           $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                           $result_attendance = mysqli_query($conn, $sql);
                          
                           if (!$result_attendance) {
                             $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                             $error = true;
                             break; 
                           }
                           if (!$error) {
                            $msg = "You Approved all requests successfully.";
                          }
                          header("Location: ../../dtr_admin.php?msg=$msg");
                        }                      
                      } //Tuesday Close Bracket

                      else if($day_of_week === 'Wednesday'){
                        $late = '';
                        if($time_dtr > $col_wednesday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_wednesday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                        if (mysqli_num_rows($result_attendance) == 0) {
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
                        }else{
                           $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                           $result_attendance = mysqli_query($conn, $sql);
                          
                           if (!$result_attendance) {
                             $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                             $error = true;
                             break; 
                           }
                           if (!$error) {
                            $msg = "You Approved all requests successfully.";
                          }
                          header("Location: ../../dtr_admin.php?msg=$msg");
                        }
                      } //Wednesday Close Bracket

                      else if($day_of_week === 'Thursday'){
                        $late = '';
                        if($time_dtr > $col_thursday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_thursday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                        if (mysqli_num_rows($result_attendance) == 0) {
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
                        }else{
                           $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                           $result_attendance = mysqli_query($conn, $sql);
                          
                           if (!$result_attendance) {
                             $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                             $error = true;
                             break; 
                           }
                           if (!$error) {
                            $msg = "You Approved all requests successfully.";
                          }
                          header("Location: ../../dtr_admin.php?msg=$msg");
                        }
                      } //Thursday Close Bracket

                      else if($day_of_week === 'Friday'){
                        $late = '';
                        if($time_dtr > $col_friday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_friday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                        if (mysqli_num_rows($result_attendance) == 0) {
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
                        }else{
                           $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                           $result_attendance = mysqli_query($conn, $sql);
                          
                           if (!$result_attendance) {
                             $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                             $error = true;
                             break; 
                           }
                           if (!$error) {
                            $msg = "You Approved all requests successfully.";
                          }
                          header("Location: ../../dtr_admin.php?msg=$msg");
                        }
                      } //Friday Close Bracket

                      else if($day_of_week === 'Saturday'){
                        $late = '';
                        if($time_dtr > $col_saturday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_saturday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                        if (mysqli_num_rows($result_attendance) == 0) {
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
                        }else{
                           $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                           $result_attendance = mysqli_query($conn, $sql);
                          
                           if (!$result_attendance) {
                             $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                             $error = true;
                             break; 
                           }
                           if (!$error) {
                            $msg = "You Approved all requests successfully.";
                          }
                          header("Location: ../../dtr_admin.php?msg=$msg");
                        }
                      } //Saturday Close Bracket

                      else if($day_of_week === 'Sunday'){
                        $late = '';
                        if($time_dtr > $col_sunday_timein){
                            $time_in_datetime = new DateTime($time_dtr);
                            $scheduled_time = new DateTime($col_sunday_timein);
                            $interval = $time_in_datetime->diff($scheduled_time);
                            $late = $interval->format('%h:%i:%s');       
                        }
                        $result_attendance = mysqli_query($conn, "SELECT * FROM attendances WHERE `empid`='$employeeid' AND `date`='$date_dtr'");

                        if (mysqli_num_rows($result_attendance) == 0) {
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
                        }else{
                           $sql = "UPDATE attendances SET `time_in` = '$time_dtr' , `late` = '$late' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
                           $result_attendance = mysqli_query($conn, $sql);
                          
                           if (!$result_attendance) {
                             $msg = "Failed to update the attendances table: " . mysqli_error($conn);
                             $error = true;
                             break; 
                           }
                           if (!$error) {
                            $msg = "You Approved all requests successfully.";
                          }
                          header("Location: ../../dtr_admin.php?msg=$msg");
                        }
                      } //Sunday Close Bracket


                    }
                  }
               }
            }  //Query run

        if ($type_dtr === 'OUT') {
          $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employeeid'");
          if (mysqli_num_rows($result_emp_sched) > 0) {
              $row_emp_sched = mysqli_fetch_assoc($result_emp_sched);
              $schedID = $row_emp_sched['schedule_name'];
      
              $result_sched_tb = mysqli_query($conn, "SELECT * FROM `schedule_tb` WHERE `schedule_name` = '$schedID'");
              if (mysqli_num_rows($result_sched_tb) > 0) {
                  $row_sched_tb = mysqli_fetch_assoc($result_sched_tb);
                  $sched_name =  $row_sched_tb['schedule_name'];
                  $col_monday_timeout =  $row_sched_tb['mon_timeout'];
                  $col_tuesday_timeout =  $row_sched_tb['tues_timeout'];
                  $col_wednesday_timeout =  $row_sched_tb['wed_timeout'];
                  $col_thursday_timeout =  $row_sched_tb['thurs_timeout'];
                  $col_friday_timeout =  $row_sched_tb['fri_timeout'];
                  $col_saturday_timeout =  $row_sched_tb['sat_timeout'];
                  $col_sunday_timeout =  $row_sched_tb['sun_timeout'];                  
      
                  $day_of_week = date('l', strtotime($date_dtr));
                  // echo $day_of_week;
      
                  switch ($day_of_week) {
                      case 'Monday':
                          $col_timeout = 'mon_timeout';
                          break;
                      case 'Tuesday':
                          $col_timeout = 'tues_timeout';
                          break;
                      case 'Wednesday':
                          $col_timeout = 'wed_timeout';
                          break;
                      case 'Thursday':
                          $col_timeout = 'thurs_timeout';
                          break;
                      case 'Friday':
                          $col_timeout = 'fri_timeout';
                          break;
                      case 'Saturday':
                          $col_timeout = 'sat_timeout';
                          break;
                      case 'Sunday':
                          $col_timeout = 'sun_timeout';
                          break;
                  }
      
                  $early_out = '';
                  $overtime = '';
                  if ($time_dtr < $row_sched_tb[$col_timeout]) {
                      $time_out_datetime = new DateTime($time_dtr);
                      $scheduled_time = new DateTime($row_sched_tb[$col_timeout]);
                      $interval = $time_out_datetime->diff($scheduled_time);
                      $early_out = $interval->format('%h:%i:%s');
                  } else if ($time_dtr > $row_sched_tb[$col_timeout]) {
                      $time_out_datetime = new DateTime($time_dtr);
                      $scheduled_time = new DateTime($row_sched_tb[$col_timeout]);
                      $interval = $time_out_datetime->diff($scheduled_time);
                      $overtime = $interval->format('%h:%i:%s');
                  }
                  
                  $result_time_in = mysqli_query($conn, "SELECT time_in FROM attendances WHERE `date` = '$date_dtr'");
                  $total_work = '';
                  if(mysqli_num_rows($result_time_in) > 0) {
                      while($row_time_in = mysqli_fetch_assoc($result_time_in)) {
                          $fetch_timein = $row_time_in['time_in'];
                          // echo $fetch_timein;
                          if(!empty($fetch_timein)) {
                            $total_work = strtotime($time_dtr) - strtotime($fetch_timein) - 7200;
                          }
                      }
                      $total_work = date('H:i:s', $total_work);
                      // echo $total_work;
                  }
                  if (mysqli_num_rows($result_attendance) == 0) {
                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_out`, `early_out`, `overtime`, `total_work`) 
                            VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$early_out', '$overtime', '$total_work')";
                    
                    if (!$result_attendance) {
                      $msg = "Failed to insert into the attendances table: " . mysqli_error($conn);
                      $error = true;
                      break; 
                    }
                    if (!$error) {
                     $msg = "You Approved all requests successfully.";
                   }
                   header("Location: ../../dtr_admin.php?msg=$msg");
                  }else{
                     $sql = "UPDATE attendances SET `time_out`='$time_dtr', `early_out`='$early_out',
                     `overtime`='$overtime', `total_work`='$total_work' WHERE `empid` = '$employeeid' AND `date` = '$date_dtr'";
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
                  }
                                        
                }
              }
            } // $type_dtr close bracket
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
