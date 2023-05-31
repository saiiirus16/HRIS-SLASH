<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "hris_db";

$conn = mysqli_connect($server, $user, $pass, $database);

$id = $_GET['id'];

// Prepare the delete statement
$sql = "DELETE FROM `schedule_tb` WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute the delete statement
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../scheduleForm.php?msg=Record deleted Successfully");
    exit();
} else {
    echo "Failed: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
