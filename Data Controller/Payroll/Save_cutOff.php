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
            `empschedule_tb`
        WHERE `empid` = $empID");

        if(mysqli_num_rows($result_dept) <= 0) {
            $row__dept = mysqli_fetch_assoc($result_dept);
            header("Location: ../../cutoff.php?error=You cannot add a employee that has no schedule");
          } 
          else{

                // Prepare the SQL statement
                $sql = "INSERT INTO cutoff_tb (`col_type`, col_frequency, `col_month`, `col_year`, `col_startDate`, `col_endDate`, `col_cutOffNum`)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

                // Sanitize the data

                $I_type = mysqli_real_escape_string($conn, $type);
                $I_frequency = mysqli_real_escape_string($conn, $frequency);
                $I_month = mysqli_real_escape_string($conn, $month);
                $I_year = mysqli_real_escape_string($conn, $year);
                $I_strDate = mysqli_real_escape_string($conn, $strDate);
                $I_endDate = mysqli_real_escape_string($conn, $endDate);
                $I_Cut_num = mysqli_real_escape_string($conn, $Cut_num);

                // Bind the values to the prepared statement
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sssssss', $I_type, $I_frequency, $I_month, $I_year, $I_strDate, $I_endDate, $I_Cut_num);

                // Execute the statement and check for errors
                if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_query($conn, "SELECT
                            *
                        FROM
                            `cutoff_tb`
                        ORDER BY
                            col_ID
                        DESC
                        LIMIT 1;");

                        if(mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $ID =  $row['col_ID'];

                                // Prepare the SQL statement
                                $sql = "INSERT INTO empcutoff_tb (`cutOff_ID`, `emp_ID`)
                                VALUES (?, ?)";

                                // Sanitize the data

                                $cutOff_ID = mysqli_real_escape_string($conn, $ID);
                                $EmpID = mysqli_real_escape_string($conn, $empID);
                            

                                // Bind the values to the prepared statement
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_bind_param($stmt, 'ss', $cutOff_ID, $EmpID);

                                // Execute the statement and check for errors
                                if (mysqli_stmt_execute($stmt)) {
                                        header("Location: ../../cutoff.php?msg=Successfully Added");
                                }else{
                                    echo "Error inserting data: " . mysqli_error($conn);
                                }
                        } 
                        else{
                            echo "Error selecting data: " . mysqli_error($conn);
                        }
                
                } else {
                    echo "Error inserting data: " . mysqli_error($conn);
                }
 
                // Close the statement and the connection
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

          }


    }


?>