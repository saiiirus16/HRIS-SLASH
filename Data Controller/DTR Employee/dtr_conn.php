

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

    if ($type == 'OUT') {
        $check_in_query = "SELECT COUNT(*) AS num_rows FROM emp_dtr_tb WHERE emp_id = '$employee_name' AND type = 'IN' AND date = '$date'";
        $check_in_result = mysqli_query($conn, $check_in_query);
        $check_in_row = mysqli_fetch_assoc($check_in_result);
        $num_rows = $check_in_row['num_rows'];
        if ($num_rows == 0) {
            header("Location: ../../dtr_emp.php?error=Cannot file TIME-OUT without entering TIME-IN first");
            exit();
        }
    }
    
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