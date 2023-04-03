<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "hris_db");

// Select all entries with status "Pending"
$query = "SELECT * FROM emp_dtr_tb WHERE `status`='Pending'";
$result = mysqli_query($conn, $query);

// Check if there are any pending entries
if (mysqli_num_rows($result) == 0) {
  // No pending entries found
  header("Location: ../../dtr_admin.php?error=No Pending Requests");
  exit();
}

// Check if the user clicked "Approve All" or "Reject All"
if (isset($_POST['approve_all']) || isset($_POST['reject_all'])) {
  // Get the current status of the pending entries
  $query = "SELECT DISTINCT `status` FROM emp_dtr_tb WHERE `status`='Pending'";
  $result = mysqli_query($conn, $query);

  // Check if there is only one status (i.e. all entries have the same status)
  if (mysqli_num_rows($result) == 1) {
    $status = mysqli_fetch_assoc($result)['status'];

    if ($status == 'Pending') {
      // Update the status of pending entries in the database to "approved" or "rejected"
      if (isset($_POST['approve_all'])) {
        $query = "UPDATE emp_dtr_tb SET `status`='Approved' WHERE `status`='Pending'";
      } else {
        $query = "UPDATE emp_dtr_tb SET `status`='Rejected' WHERE `status`='Pending'";
      }

      $result = mysqli_query($conn, $query);
      // Check for errors
      if ($result) {
        header("Location: ../../dtr_admin.php?msg=Update Status All Request Successfully");
      } else {
        echo "Error updating status: " . mysqli_error($conn);
      }
    }

    // Close the database connection
    mysqli_close($conn);
    // Inform the reader that the database connection has been closed
    //echo "Database connection closed successfully";
  }
}
?>

