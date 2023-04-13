<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);
/************************* For Approve Button ***************************/
if(isset($_POST['btn_approve']))
{

    $column_id = $_POST['id_check'];

    $result_official = mysqli_query($conn, "SELECT * FROM emp_official_tb WHERE id = '$column_id'");
    if(mysqli_num_rows($result_official) > 0) {
        $row_official = mysqli_fetch_assoc($result_official);
    }
    $employeeid = $row_official['employee_id'];
    $date_official = $row_official['str_date'];
    $starttime_official = $row_official['start_time'];
    $endtime_official = $row_official['end_time'];
    $status_official = $row_official['status'];

    if($status_official === 'Approved'){
        header("Location: ../../official_business.php?error=You cannot APPROVE a request that is already APPROVED");
    }
    else if($status_official === 'Rejected'){
        header("Location: ../../official_business.php?error=You cannot APPROVE a request that is already REJECTED");
    } else {
        // Calculate the amount of late
        $scheduled_time = new DateTime('09:00:00');
        $starttime_official_datetime = new DateTime($starttime_official);
        $interval = $scheduled_time->diff($starttime_official_datetime);
        $late = $interval->format('%H:%I:%S');

        // Calculate the total work hours
        $total_work_hours = strtotime($endtime_official) - strtotime($starttime_official) - 7200;
        $total_work = date('H:i:s', $total_work_hours);

        // Calculate overtime
        $scheduled_time_out = new DateTime('18:00:00');
        $endtime_official_datetime = new DateTime($endtime_official);
        if ($endtime_official_datetime > $scheduled_time_out) {
            $interval = $endtime_official_datetime->diff($scheduled_time_out);
            $overtime = $interval->format('%H:%I:%S');
        } else {
            $overtime = '00:00:00';
        }

        // Calculate early out
        $scheduled_time_out = new DateTime('17:59:00');
            if ($endtime_official_datetime < $scheduled_time_out) {
                $interval = $scheduled_time_out->diff($endtime_official_datetime);
                $early_out = $interval->format('%H:%I:%S');
            } else {
                $early_out = '00:00:00';
            }

            $query = "UPDATE emp_official_tb SET `status` ='Approved' WHERE `id`='$column_id'";
            $query_run = mysqli_query($conn, $query);
            
            if($query_run) {
                $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `time_out`, `late`, `early_out`, `overtime`, `total_work`) VALUES ('Present', '$employeeid', '$date_official', '$starttime_official', '$endtime_official', '$late', '$early_out', '$overtime', '$total_work')";
                $result = mysqli_query($conn, $sql);
                
                if($result){
                    header("Location: ../../official_business.php?msg=You Approved this Request Successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            } else {
                echo "Failed: " . mysqli_error($conn);
         }
       }
    }

/************************* End of Approve Button ***************************/


/************************* For Reject Button ***************************/
if(isset($_POST['btn_reject']))
{

    $column_id = $_POST['id_check'];

    $result_official = mysqli_query($conn, " SELECT * FROM emp_official_tb WHERE id = '$column_id'");
    if(mysqli_num_rows($result_official) > 0) {
        $row_official = mysqli_fetch_assoc($result_official);
}
    $status_official = $row_official['status'];
    
    if($status_official === 'Approved'){
        header("Location: ../../official_business.php?error=You cannot REJECT a request that is already APPROVED");
    }
    else if($status_official === 'Rejected'){
        header("Location: ../../official_business.php?error=You cannot REJECT a request that is already REJECTED");
    }else{
        $query = "UPDATE emp_official_tb SET `status` ='Rejected' WHERE `id`='$column_id'";
        $query_run = mysqli_query($conn, $query);
    
        if($query_run)
        {
            header("Location: ../../official_business.php?msg=You Rejected this Request");
        }
        else
        {
            echo "Failed: " . mysqli_error($conn);
        }
    
    }
   
}
/************************* End of Reject Button ***************************/
?>