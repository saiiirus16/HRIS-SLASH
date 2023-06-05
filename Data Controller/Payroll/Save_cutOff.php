<?php
include '../../config.php';

if(isset($_POST['btn_save'])){
    // Retrieve the selected empId values
    $empIDs = $_POST['name_empId'];

    // Convert the array into a comma-separated string
    $empIDsString = implode(',', $empIDs);

    // Rest of your code...
    $type = $_POST['name_type'];
    $frequency = $_POST['name_frequency'];
    $month = $_POST['name_Month'];
    $year = $_POST['name_year'];
    $strDate = $_POST['name_strDate'];
    $endDate = $_POST['name_endDate'];
    $Cut_num = $_POST['name_cutoffNum'];

    // Prepare the SQL statement
    $sql = "INSERT INTO cutoff_tb (`col_type`, col_frequency, `col_month`, `col_year`, `col_startDate`, `col_endDate`, `col_cutOffNum`)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Sanitize the data
    $I_type = mysqli_real_escape_string($conn, $type);
    $I_frequency = mysqli_real_escape_string($conn, $frequency);
    $I_month = mysqli_real_escape_string($conn, $month);
    $I_year = mysqli_real_escape_string($conn, $year);
    $I_strDate = mysqli_real_escape_string($conn, $strDate);
    $I_endDate = mysqli_real_escape_string($conn, $endDate);
    $I_Cut_num = mysqli_real_escape_string($conn, $Cut_num);

    // Bind the values to the prepared statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $I_type, $I_frequency, $I_month, $I_year, $I_strDate, $I_endDate, $I_Cut_num);

    // Execute the statement and check for errors
    if (mysqli_stmt_execute($stmt)) {
        // Retrieve the last inserted ID
        $lastInsertID = mysqli_insert_id($conn);

        // Prepare the SQL statement for inserting into empcutoff_tb
        $sql = "INSERT INTO empcutoff_tb (`cutOff_ID`, `emp_ID`) VALUES (?, ?)";

        // Bind the values to the prepared statement
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $lastInsertID, $EmpID);

        // Insert each selected empId into empcutoff_tb
        foreach ($empIDs as $EmpID) {
            // Sanitize the data
            $EmpID = mysqli_real_escape_string($conn, $EmpID);

            // Execute the statement and check for errors
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error inserting data: " . mysqli_error($conn);
            }
        }

        // Close the statement and the connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        header("Location: ../../cutoff.php?msg=Successfully Added");
        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
}
?>
