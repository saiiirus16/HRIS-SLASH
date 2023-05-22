<?php
    
    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "hris_db";

    $conn = mysqli_connect($server, $user, $pass, $database);

    $id = $_GET['id'];
    $sql = "DELETE FROM `schedule_tb` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header ("Location: ../../Schedules.php?msg= Record deleted Successfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
?>