<?php
    include "../../config.php";
    $id = $_GET['col_ID'];
    $sql = "DELETE FROM `dept_tb` WHERE col_ID = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header ("Location: ../../Department.php?msg= Record deleted Successfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
?>