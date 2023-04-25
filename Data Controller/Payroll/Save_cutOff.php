<?php
 include '../../config.php';
    
    if(isset($_POST['btn_save'])){
        $empID = $_POST['name_empId'];
        $type = $_POST['name_type'];
        $frequency = $_POST['name_frequency'];
        $month = $_POST['name_Month'];
        $year = $_POST['name_year'];
        $strDate = $_POST['name_strDate'];
        $endDate = $_POST['name_endDate'];
        $Cut_num = $_POST['name_cutoffNum'];
      


       $result_dept = mysqli_query($conn, " SELECT
            *  
        FROM
            `cutoff_tb`
        WHERE `col_startDate` = '$strDate' and `col_endDate` = '$endDate' and `col_cutOffNum` = $Cut_num");

        if(mysqli_num_rows($result_dept) > 0) {
            $row__dept = mysqli_fetch_assoc($result_dept);
            header("Location: ../../cutoff.php?error=You cannot add a cutoff name that is already exist");
          } 
          else{

                // Prepare the SQL statement
                $sql = "INSERT INTO cutoff_tb (`col_empId`, `col_type`, col_frequency, `col_month`, `col_year`, `col_startDate`, `col_endDate`, `col_cutOffNum`)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                // Sanitize the data

                $I_empID = mysqli_real_escape_string($conn, $empID);
                $I_type = mysqli_real_escape_string($conn, $type);
                $I_frequency = mysqli_real_escape_string($conn, $frequency);
                $I_month = mysqli_real_escape_string($conn, $month);
                $I_year = mysqli_real_escape_string($conn, $year);
                $I_strDate = mysqli_real_escape_string($conn, $strDate);
                $I_endDate = mysqli_real_escape_string($conn, $endDate);
                $I_Cut_num = mysqli_real_escape_string($conn, $Cut_num);

                // Bind the values to the prepared statement
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ssssssss',$I_empID, $I_type, $I_frequency, $I_month, $I_year, $I_strDate, $I_endDate, $I_Cut_num);

                // Execute the statement and check for errors
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: ../../cutoff.php?msg=Successfully Added");
                
                } else {
                    echo "Error inserting data: " . mysqli_error($conn);
                }
 
                // Close the statement and the connection
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

          }


    }

    // if(isset($_POST['empIds'])) {
    //     $empIds = $_POST['empIds'];
    //     foreach($empIds as $empId) {
    //         $stmt = $conn->prepare("INSERT INTO cutoff_tb (col_empId) VALUES (?)");
    //         $stmt->bind_param("i", $empId);
    //         $stmt->execute();
    //         $stmt->close();
    //     }
    // }
    // $conn->close();

?>