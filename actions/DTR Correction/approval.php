<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);
/************************* For Approve Button ***************************/
if(isset($_POST['approve_btn']))
{

    $empid = $_POST['input'];
   
    

    $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$empid'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
    }
    else
    {
        echo "Failed: " . mysqli_error($conn);
    }

}
/************************* End of Approve Button ***************************/

/************************* For Reject Button ***************************/
if(isset($_POST['reject_btn']))
{

    $empid = $_POST['input'];
   
    

    $query = "UPDATE emp_dtr_tb SET `status` ='Rejected' WHERE `id`='$empid'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../../dtr_admin.php?msg=You Rejected this Request");
    }
    else
    {
        echo "Failed: " . mysqli_error($conn);
    }

}
/************************* End of Reject Button ***************************/
?>