<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";


    $conn = mysqli_connect($servername, $username,  $password, $dbname);

if(isset($_POST['add_data']))
{
    $position = $_POST['position_text'];


    $query = "INSERT INTO positionn_tb (`position`) VALUES ('$position')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header("Location: ../../Position.php?msg=New record created successfully");
    }
    else
    {
        echo "Failed: " . mysqli_error($conn);
    }

}



?>