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
              $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`) VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr')";
              $result_attendance = mysqli_query($conn, $sql);
        
              if (!$result_attendance) {
                $msg = "Failed to insert into the attendances table: " . mysqli_error($conn);
                $error = true;
                break; 
              }
            } else if($type_dtr === 'OUT') {
              $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_out`) VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr')";
              $result_attendance = mysqli_query($conn, $sql);
        
              if (!$result_attendance) {
                $msg = "Failed to insert into the attendances table: " . mysqli_error($conn);
                $error = true;
                break; 
              }
            }
          }
        }
        if (!$error) {
          $msg = "You Approved all requests successfully.";
        }
        header("Location: ../../dtr_admin.php?msg=$msg");
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

