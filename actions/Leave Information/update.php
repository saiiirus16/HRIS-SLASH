<?php

    include '../../config.php';

    if(isset($_POST['updatedata'])){
        $id = $_POST['name_id'];
        //set credits
        $set_Vcrdt = $_POST['name_set_Vcrdt'];
        $set_Scrdt = $_POST['name_set_Scrdt'];
        $set_Bcrdt = $_POST['name_set_Bcrdt'];

        //for update inputs
        $Vcrdt = $_POST['name_updt_Vcrdt'];
        $Scrdt = $_POST['name_updt_Scrdt'];
        $Bcrdt = $_POST['name_updt_Bcrdt'];

        $diff_Vcrdt = abs((float)$set_Vcrdt - (float)$Vcrdt );
        $diff_Scrdt = abs((float)$set_Scrdt - (float)$Scrdt );
        $diff_Bcrdt = abs((float)$set_Bcrdt - (float)$Bcrdt );

        $sql ="UPDATE leaveinfo_tb SET col_vctionCrdt= $diff_Vcrdt, col_sickCrdt=$diff_Scrdt, col_brvmntCrdt= $diff_Bcrdt WHERE col_ID = '$id' ";
        $query_run = mysqli_query($conn, $sql);

        if($query_run){
            header("Location: ../../LeaveInfo.php?msg=Updated Successfully");
            //echo $diff_Vcrdt;
        }
        else{
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>