<?php
    if(isset($_POST['btn_addEmp_modal'])){
        $cutOff_emp = $_POST['add_name_emp']; //ito ang senelect sa drop na e add sa cut off na employee
        $cutOffID = $_POST['name_AddEMp_CutoffID'];

        include '../../config.php';

        $result_dept = mysqli_query($conn, " SELECT
            *  
        FROM
            `empschedule_tb`
        WHERE `empid` = $cutOff_emp");

        if(mysqli_num_rows($result_dept) <= 0) {
            $row__dept = mysqli_fetch_assoc($result_dept);
            header("Location: ../../cutoff.php?error=You cannot add a employee that has no schedule");
          } 
          else{

               #sql query to insert into database
               $sql = "INSERT into empcutoff_tb(`cutOff_ID`, `emp_ID`) 
               VALUES('$cutOffID', '$cutOff_emp')";

               if(mysqli_query($conn,$sql)){
                  header("Location: ../../cutoff.php?msg=Successfully Added");
               }
               else{
                  echo "Error";
               }

          }
    }
?>