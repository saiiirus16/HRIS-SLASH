<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hris_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['add_wfh']))
{
    $employee_id = $_POST['name_emp'];
    $wfh_date = $_POST['wfh_date'];
    $schedType = $_POST['choose_scheduletype'];
    $start_time = $_POST['time_from'];
    $end_time = $_POST['time_to'];
    $description = $_POST['request_description'];

    if(isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
        $contents = file_get_contents($_FILES['file_upload']['tmp_name']);
        $escaped_contents = mysqli_real_escape_string($conn, $contents);
    } else {
        $escaped_contents = "";
    }

    $query = "INSERT INTO wfh_tb (`empid`, `date`, `schedule_type`, `start_time`, `end_time`, `reason`, `file_attachment`, `status`)
            VALUES ('$employee_id', '$wfh_date', '$schedType', '$start_time', '$end_time', '$description', '$escaped_contents', 'Pending')";
    $query_run = mysqli_query($conn, $query);
    
    if($query_run)
    {
        header("Location: ../../wfh_request.php?msg=Successfully Added");
    }
    else
    {
        echo "Failed: ". mysqli_error($conn);
    }



}


?>