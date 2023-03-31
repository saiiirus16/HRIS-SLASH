<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "hris_db");

// Check for errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the desired status from the POST parameters
$status = $_POST['status'];

// Update the status of all entries in the database
$query = "UPDATE emp_dtr_tb SET `status`='$status'";
$result = mysqli_query($conn, $query);

// Check for errors
if ($result) {
    header("Location: ../../dtr_admin.php?msg=Update Status All Request Successfully");
} else {
    echo "Error updating status: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>