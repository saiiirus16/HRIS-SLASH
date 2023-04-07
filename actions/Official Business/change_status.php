<?php
$conn = mysqli_connect("localhost", "root", "", "hris_db");

$query = "SELECT * FROM emp_official_tb WHERE `status`='Pending'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
  header("Location: ../../official_business.php?error=No Pending Requests");
  exit();
}

// Check if the user clicked Approve All or Reject All Button
if (isset($_POST['approve_all']) || isset($_POST['reject_all'])) {
  $query = "SELECT DISTINCT `status` FROM emp_official_tb WHERE `status`='Pending'";
  $result_pending = mysqli_query($conn, $query);

  if (mysqli_num_rows($result_pending) == 1) {
    $status = mysqli_fetch_assoc($result_pending)['status'];

    if ($status == 'Pending') {
        if (isset($_POST['approve_all'])) {
            $query = "UPDATE emp_official_tb SET `status`='Approved' WHERE `status`='Pending' AND `start_time` IS NOT NULL";
            mysqli_query($conn, $query);
        
            $msg = '';
            $error = false;
            $result = mysqli_query($conn, "SELECT * FROM emp_official_tb WHERE `status`='Approved'");
        
            while ($row_official = mysqli_fetch_assoc($result)) {
                $employeeid = $row_official['employee_id'];
                $date_official = $row_official['str_date'];
                $starttime_official = $row_official['start_time'];
                $endtime_official = $row_official['end_time'];
        
                // Calculate the amount of late
                $scheduled_time = new DateTime('09:00:00');
                $starttime_official_datetime = new DateTime($starttime_official);
                $interval = $scheduled_time->diff($starttime_official_datetime);
                $late = $interval->format('%H:%I:%S');
        
                // Calculate the total work hours
                $total_work_hours = strtotime($endtime_official) - strtotime($starttime_official) - 7200;
                $total_work = date('H:i:s', $total_work_hours);
        
                // Calculate overtime
                $scheduled_time_out = new DateTime('18:00:00');
                $endtime_official_datetime = new DateTime($endtime_official);
                if ($endtime_official_datetime > $scheduled_time_out) {
                    $interval = $endtime_official_datetime->diff($scheduled_time_out);
                    $overtime = $interval->format('%H:%I:%S');
                } else {
                    $overtime = '00:00:00';
                }
        
                // Calculate early out
                $scheduled_time_out = new DateTime('17:59:00');
                if ($endtime_official_datetime < $scheduled_time_out) {
                    $interval = $scheduled_time_out->diff($endtime_official_datetime);
                    $early_out = $interval->format('%H:%I:%S');
                } else {
                    $early_out = '00:00:00';
                }
        
                // Insert into the attendances table
                $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `time_out`, `late`, `early_out`, `overtime`, `total_work`) VALUES ('Present', '$employeeid', '$date_official', '$starttime_official', '$endtime_official', '$late', '$early_out', '$overtime', '$total_work')";
                $result_attendance = mysqli_query($conn, $sql);
        
                if (!$result_attendance) {
                    $msg = "Failed to insert into the attendances table: " . mysqli_error($conn);
                    $error = true;
                    break; 
                }
            }
            if (!$error) {
                $msg = "You approved all requests successfully.";
            }
            header("Location: ../../official_business.php?msg=$msg");
        } else {
        $query = "UPDATE emp_dtr_tb SET `status`='Rejected' WHERE `status`='Pending'";
        $result = mysqli_query($conn, $query);

        if ($result) {
          header("Location: ../../official_business.php?msg=Rejected the All Request Successfully");
        } else {
          echo "Error updating status: " . mysqli_error($conn);
        }
      }
    } else {
      header("Location: ../../official_business.php?error=There are requests with different statuses.");
    }
    mysqli_close($conn);
  }
}

?>

