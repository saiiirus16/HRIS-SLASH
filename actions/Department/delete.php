<?php
    include "../../config.php";
    $id = $_GET['col_ID'];
    $count = $_GET['dsgntn_count'];

    if ($count > 0){
        header ("Location: ../../Department.php?error= You cannot delete a department that has employee designated");
    }
    else{
        $sql = "DELETE FROM `dept_tb` WHERE col_ID = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header ("Location: ../../Department.php?msg= Record deleted Successfully");
        }
        else {
            echo "Failed: " . mysqli_error($conn);
        }
    }  


    
?>