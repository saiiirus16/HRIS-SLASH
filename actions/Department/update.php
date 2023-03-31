<?php

    include '../../config.php';

    if(isset($_POST['updatedata'])){

        $id = $_POST['name_id'];
        $new_deptname = $_POST['name_Editdept'];


        $sql ="UPDATE `dept_tb` SET `col_deptname`='$new_deptname' WHERE `col_ID` = $id";
        $query_run = mysqli_query($conn, $sql);

        if($query_run){
            header("Location: ../../Department.php?msg=Updated Successfully");
            //echo $diff_Vcrdt;
        }
        else{
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>