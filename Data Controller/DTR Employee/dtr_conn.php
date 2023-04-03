

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

if(isset($_POST['add_data']))
{
    $employee_name = $_POST ['name_emp'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $type = $_POST['select_type'];
    $reason = $_POST['text_reason'];
    $upload_file = $_POST['file_upload'];

    $query = "INSERT INTO emp_dtr_tb (`emp_id`,`date`,`time`,`type`,`reason`,`upl_file`,`status`) VALUES ('$employee_name','$date','$time','$type','$reason','$upload_file','Pending')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../../dtr_emp.php?msg=New record created successfully");
    }
    else
    {
        echo "Failed: " . mysqli_error($conn);
    }

}
?>