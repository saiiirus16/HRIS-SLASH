<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);
/************************* For Approve Button ***************************/
if(isset($_POST['approve_btn']))
{

    $tableid = $_POST['input'];

    $result_dtr = mysqli_query($conn, " SELECT * FROM emp_dtr_tb WHERE id = '$tableid'");
        if(mysqli_num_rows($result_dtr) > 0) {
            $row_dtr = mysqli_fetch_assoc($result_dtr);
    }
            $employeeid = $row_dtr['emp_id'];
            $date_dtr = $row_dtr['date'];
            $time_dtr = $row_dtr['time'];
            $type_dtr = $row_dtr['type'];
            $status_dtr = $row_dtr['status'];

        if($status_dtr === 'Approved'){
            header("Location: ../../dtr_admin.php?error=You cannot APPROVED a request that is already APPROVED");
        }
        else if($status_dtr === 'Rejected'){
            header("Location: ../../dtr_admin.php?error=You cannot APPROVED a request that is already REJECTED");
        }else{
            if($type_dtr === 'IN'){
                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run)
                {
                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_in`) VALUES ('Present', ' $employeeid', ' $date_dtr', '$time_dtr')";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                }
                else
                {
                    echo "Failed: " . mysqli_error($conn);
                }
            }else  if($type_dtr === 'OUT'){
                $query = "UPDATE emp_dtr_tb SET `status` ='Approved' WHERE `id`='$tableid'";
                $query_run = mysqli_query($conn, $query);
            
                if($query_run)
                {
                    $sql = "INSERT INTO attendances (`status`, `empid`, `date`, `time_out`) VALUES ('Present', ' $employeeid', ' $date_dtr', '$time_dtr')";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../../dtr_admin.php?msg=You Approved this Request Successfully");
                }
                else
                {
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