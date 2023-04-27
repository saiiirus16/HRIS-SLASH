<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hris_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['add_overtime']))
{
    $employee_id = $_POST ['name_emp'];
    $date_pick = $_POST ['date_choose'];
    $work_schedule = $_POST ['schedule'];
    $time_entry = $_POST ['time_start'];
    $time_out = $_POST ['time_end'];
    $out = $_POST ['time_from'];
    $ot_set = $_POST ['time_to'];
    $total_time = $_POST ['total_overtime'];
    $reason = $_POST ['file_reason'];


    if(isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
        $contents = file_get_contents($_FILES['file_upload']['tmp_name']);
        $escaped_contents = mysqli_real_escape_string($conn, $contents);
    } else {
        $escaped_contents = "";
    }


    $query = "INSERT INTO overtime_tb (`empid`,`date`,`work_schedule`,`time_in`,`time_out`,`out_time`,`ot_hours`,`total_ot`,`reason`,`file_attachment`,`status`)
              VALUES ('$employee_id', '$date_pick', '$work_schedule', '$time_entry', '$time_out', '$out', '$ot_set', '$total_time', '$reason', '$escaped_contents', 'Pending')";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        header("Location: ../../overtime_req.php?msg=Successfully Added");
    }
    else
    {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>