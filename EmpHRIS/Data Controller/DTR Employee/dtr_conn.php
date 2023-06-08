<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

    if(isset($_POST['add_data']))
    {
        $employee_id = $_POST ['name_emp'];
        $date_dtr = $_POST ['date_dtr'];
        $time = $_POST['time_dtr'];
        $type = $_POST['select_type'];
        $reason = $_POST['text_reason'];

        if(isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
            $contents = file_get_contents($_FILES['file_upload']['tmp_name']);
            $escaped_contents = mysqli_real_escape_string($conn, $contents);
        } else {
            $escaped_contents = "";
        }
        
        $sql = "SELECT * FROM emp_dtr_tb WHERE `empid` = '$employee_id' AND `date` = '$date_dtr' AND `type` = '$type'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            header("Location: ../../dtr_emp.php?error=Same date is not Allow");
        }else{
            $query = "INSERT INTO emp_dtr_tb (`empid`,`date`,`time`,`type`,`reason`,`file_attach`,`status`)
            VALUES ('$employee_id','$date_dtr','$time','$type','$reason','$escaped_contents','Pending')";
            $query_run = mysqli_query($conn, $query);

            if($query_run)
            {
                header("Location: ../../dtr_emp.php?msg=Successfully Added");
            }
            else
            {
                echo "Failed: " . mysqli_error($conn);
            }
        }





    }
?>