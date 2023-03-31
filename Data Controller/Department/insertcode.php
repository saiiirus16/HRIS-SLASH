
<?php
     include '../../config.php';
// Connect to the MySQL database

// Prepare the SQL statement
$sql = "INSERT INTO dept_tb (`col_deptname`)
        VALUES (?)";

// Sanitize the data

$emp = mysqli_real_escape_string($conn, $_POST['name_dept'] . ' ' . 'Department');

// Bind the values to the prepared statement
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's',$emp);

// Execute the statement and check for errors
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../Department.php?msg=Successfully Added");
   
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

// Close the statement and the connection
mysqli_stmt_close($stmt);
mysqli_close($conn);




?>