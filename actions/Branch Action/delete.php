<?php
    include "../../config.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM `branch_tb` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header ("Location: ../../Branch.php?msg= Record deleted Successfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
?>