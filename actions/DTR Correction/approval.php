<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);
/************************* For Approve Button ***************************/
// if(isset($_POST['approve_btn']))
// {

//     $tableid = $_POST['input'];

//     $result_dtr = mysqli_query($conn, " SELECT * FROM emp_dtr_tb WHERE id = '$tableid'");
//         if(mysqli_num_rows($result_dtr) > 0) {
//             $row_dtr = mysqli_fetch_assoc($result_dtr);
//     }
//             $employeeid = $row_dtr['emp_id'];
//             $date_dtr = $row_dtr['date'];
//             $time_dtr = $row_dtr['time'];
//             $type_dtr = $row_dtr['type'];
//             $status_dtr = $row_dtr['status'];

//         if($status_dtr === 'Approved'){
//             header("Location: ../../dtr_admin.php?error=You cannot APPROVED a request that is already APPROVED");
//         }
//         else if($status_dtr === 'Rejected'){
//             header("Location: ../../dtr_admin.php?error=You cannot APPROVED a request that is already REJECTED");
//         }else{
//             if($type_dtr === 'IN'){
//                 $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
//                 $query_run = mysqli_query($conn, $query);
            
//                 if($query_run)
//                 {


//                 $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`) VALUES ('Present', ' $employeeid', ' $date_dtr', '$time_dtr')";
//                 $result = mysqli_query($conn, $sql);
//                 header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");

                    
//                 }
//                 else
//                 {
//                     echo "Failed: " . mysqli_error($conn);
//                 }
//             }else  if($type_dtr === 'OUT'){
//                 $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
//                 $query_run = mysqli_query($conn, $query);
            
//                 if($query_run)
//                 {
//                     $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_out`) VALUES ('Present', ' $employeeid', ' $date_dtr', '$time_dtr')";
//                     $result = mysqli_query($conn, $sql);
//                     header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
//                 }
//                 else
//                 {
//                     echo "Failed: " . mysqli_error($conn);
//                 }
//             }
//         }  
// }

if(isset($_POST['approve_btn']))
{

    $tableid = $_POST['input'];

    $result_dtr = mysqli_query($conn, "SELECT * FROM emp_dtr_tb WHERE id = '$tableid'");
    if(mysqli_num_rows($result_dtr) > 0) {
        $row_dtr = mysqli_fetch_assoc($result_dtr);
    }
    $employeeid = $row_dtr['emp_id'];
    $date_dtr = $row_dtr['date'];
    $time_dtr = $row_dtr['time'];
    $type_dtr = $row_dtr['type'];
    $status_dtr = $row_dtr['status'];

    if($status_dtr === 'Approved'){
        header("Location: ../../dtr_admin.php?error=You cannot APPROVE a request that is already APPROVED");
    }
    else if($status_dtr === 'Rejected'){
        header("Location: ../../dtr_admin.php?error=You cannot APPROVE a request that is already REJECTED");
    } else {
        if($type_dtr === 'IN'){
            // Calculate late if time_in is later than 9am
            $late = '';
            if($time_dtr > '09:00:00'){
                $time_in_datetime = new DateTime($time_dtr);
                $scheduled_time = new DateTime('09:00:00');
                $interval = $time_in_datetime->diff($scheduled_time);
                $late = $interval->format('%h:%i:%s');
            }

            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
            $query_run = mysqli_query($conn, $query);
            
            if($query_run) {
                $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`, `late`) 
                        VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$late')";
                $result = mysqli_query($conn, $sql);
                
                if($result){
                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            } else {
                echo "Failed: " . mysqli_error($conn);
            }
        

        } else if ($type_dtr === 'OUT') {
            // Calculate undertime if time_out is earlier than 6pm
            // Calculate overtime if time_out is later than 6pm
            $scheduled_time = new DateTime('18:00:00');
            $time_out_datetime = new DateTime($time_dtr);
            if ($time_out_datetime < $scheduled_time) {
                $interval = $time_out_datetime->diff($scheduled_time);
                $early_out = $interval->format('%h:%i:%s');
            } else {
                $interval = $scheduled_time->diff($time_out_datetime);
                $overtime = $interval->format('%h:%i:%s');
            }
            if ($time_out_datetime < $scheduled_time) {
                $interval = $time_out_datetime->diff($scheduled_time);
                $undertime = $interval->format('%h:%i:%s');
            } else {
                $interval = $scheduled_time->diff($time_out_datetime);
                $overtime = $interval->format('%h:%i:%s');
            }
        
            $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
            $query_run = mysqli_query($conn, $query);
        
            if ($query_run) {
                $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_out`, `early_out`, `overtime`)
                        VALUES ('Present', '$employeeid', '$date_dtr', '$time_dtr', '$early_out', '$overtime')";
                $result = mysqli_query($conn, $sql);
        
                if ($result) {
                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            } else {
                echo "Failed: " . mysqli_error($conn);
            }
        }
    }
}
/************************* End of Approve Button ***************************/


/************************* For Reject Button ***************************/
if(isset($_POST['reject_btn']))
{

    $tableid = $_POST['input'];

    $result_dtr = mysqli_query($conn, " SELECT * FROM emp_dtr_tb WHERE id = '$tableid'");
    if(mysqli_num_rows($result_dtr) > 0) {
        $row_dtr = mysqli_fetch_assoc($result_dtr);
}
    $status_dtr = $row_dtr['status'];
    
    if($status_dtr === 'Approved'){
        header("Location: ../../dtr_admin.php?error=You cannot REJECT a request that is already APPROVED");
    }
    else if($status_dtr === 'Rejected'){
        header("Location: ../../dtr_admin.php?error=You cannot REJECT a request that is already REJECTED");
    }else{
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
   
}
/************************* End of Reject Button ***************************/
?>