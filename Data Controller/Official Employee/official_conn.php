<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

    if(isset($_POST['savedata']))
    {
        $employee_id = $_POST ['name_emp'];
        $name_company = $_POST ['company_name'];
        $start_date = $_POST['str_date'];
        $end_date = $_POST['end_date'];
        $start_time = $_POST['str_time'];
        $end_time = $_POST['end_time'];
        $location = $_POST['locate'];
        $file_upl = $POST['file_upload'];
        $reason = $_POST['text_reason'];
    
        // #file name with a random number so that similar dont get replaced
        // $file_upl = $_FILES["file_upload"]["name"];
    
        // #temporary file name to store file
        // $tname = $_FILES["file_upload"]["tmp_name"];

        // #upload directory path
        // $uploads_dir = 'Upload_files';
        // #TO move the uploaded file to specific location
        // move_uploaded_file($tname, $uploads_dir.'/'.$file_upl);

        $query = "INSERT INTO emp_official_tb (`employee_id`, `company_name`,`str_date`,`end_date`,`start_time`,`end_time`,`location`,`file_upl`,`reason`,`status`)
        VALUES ('$employee_id', '$name_company', '$start_date','$end_date','$start_time','$end_time','$location','$file_upl','$reason','Pending')";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            header("Location: ../../official_emp.php?msg=Successfully Added");
        }
        else
        {
            echo "Failed: " . mysqli_error($conn);
        }

    }
?>