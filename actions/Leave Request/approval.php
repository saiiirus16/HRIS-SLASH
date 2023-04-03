<?php
session_start();
include '../../config.php';

   //----------------------------------------------BREAK(FOR Approving)-----------------------------------------------------
     if(isset($_POST['name_approved'])){

        $IDLEAVE_TABLE = $_SESSION["ID_applyleave"];
       
//Para sa pag select ng mga data galing sa APPLYLEAVE TABLE
        $result = mysqli_query($conn, " SELECT
                                            *  
                                        FROM
                                            applyleave_tb
                                        WHERE col_ID=  $IDLEAVE_TABLE");
        $row = mysqli_fetch_assoc($result);
        //echo $row['col_LeaveType'];
//Para sa pag select ng mga data galing sa APPLYLEAVE TABLE (END)

//Para sa pag select ng mga data galing sa LEAVE INFO TABLE
        $employee_ID = $_SESSION["ID_empId"]; //employee ID
        $result_leaveINFO = mysqli_query($conn, " SELECT
            *  
        FROM
            leaveinfo_tb
        WHERE col_empID = $employee_ID");
        if(mysqli_num_rows($result_leaveINFO) > 0) {
            $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO);
            //echo $row__leaveINFO['col_vctionCrdt'];
          } else {
            echo "No results found.";
          }
//Para sa pag select ng mga data galing sa LEAVE INFO TABLE (END)
if($row['col_status'] === 'Approved' ){
    header("Location: ../../leavereq.php?error=You cannot APPROVED a request that is already APPROVED");
}
else if($row['col_status'] === 'Rejected' ){
    header("Location: ../../leavereq.php?error=You cannot APPROVED a request that is already REJECTED");
}
else{

//--------------------------------------------PARA SA PAG MINUS NG CREDITS IF firsthalf HALfDAY-------------------------------------------------

if($row['col_LeavePeriod'] === 'First Half'){
    if($row['col_LeaveType'] == 'Vacation Leave'){
        $minusVacationCredits0 = $row__leaveINFO['col_vctionCrdt'] - 0.5; //para mag minus sa credits sa IF Vacation
        $sql_minusvacationCredits0 ="UPDATE leaveinfo_tb SET col_vctionCrdt= $minusVacationCredits0 WHERE col_empID = $employee_ID";
        $query_run_minusCredits0 = mysqli_query($conn, $sql_minusvacationCredits0);
    }
    elseif($row['col_LeaveType'] == 'Bereavement Leave'){
        $minusBrvmntCredits0 = $row__leaveINFO['col_brvmntCrdt'] - 0.5; //para mag minus sa credits sa IF Vacation
        $sql_minusBrvmntCredits0 ="UPDATE leaveinfo_tb SET col_brvmntCrdt= $minusBrvmntCredits0 WHERE col_empID = $employee_ID";
        $query_run_BrvmntminusCredits0 = mysqli_query($conn, $sql_minusBrvmntCredits0);
    }
    elseif($row['col_LeaveType'] == 'Sick Leave'){
        $minusSickCredits0 = $row__leaveINFO['col_sickCrdt'] - 0.5; //para mag minus sa credits sa IF Vacation
        $sql_minusSickCredits0 ="UPDATE leaveinfo_tb SET col_sickCrdt= $minusSickCredits0 WHERE col_empID = $employee_ID";
        $query_run_SickminusCredits0 = mysqli_query($conn, $sql_minusSickCredits0);
    }


       //pra sa pag update ng action taken at status to approved

            // Get the current date and time
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('Asia/Manila'));
            $currentDateTime = $now->format('Y-m-d H:i:s');
            $Status = $_SESSION["col_status"];
            $reason = $_POST["name_approvedtResn"]; //dito ako nahinto (d nakapag insert)
            $IDLEAVE_TABLE = $_SESSION["ID_applyleave"];

            $sql1 = "INSERT into actiontaken_tb(`col_applyID`, `col_remarks`,`col_status`) 
            VALUES('$IDLEAVE_TABLE','$reason', 'Approved')";
              if(mysqli_query($conn,$sql1))
              {
                $sql ="UPDATE applyleave_tb SET col_status= 'Approved', col_dt_action= '$currentDateTime' WHERE col_ID = $IDLEAVE_TABLE";
                $query_run = mysqli_query($conn, $sql);
    
    
                    if($query_run){
                        header("Location: ../../leavereq.php?msg=Approved Successfully");
                    } 
                    else{
                        echo '<script> alert("Data Not Updated"); </script>';
                    }

              } 
              else{ 
                echo '<script> alert("Data Not Updated"); </script>';
              }
} //-----------------------------------PARA SA PAG MINUS NG CREDITS IF HALDAY firsthalf end----------------------------------------------
//--------------------------------------------PARA SA PAG MINUS NG CREDITS IF Second HALfDAY-------------------------------------------------

else if($row['col_LeavePeriod'] === 'Second Half'){
    if($row['col_LeaveType'] == 'Vacation Leave'){
        $minusVacationCredits0 = $row__leaveINFO['col_vctionCrdt'] - 0.5; //para mag minus sa credits sa IF Vacation
        $sql_minusvacationCredits0 ="UPDATE leaveinfo_tb SET col_vctionCrdt= $minusVacationCredits0 WHERE col_empID = $employee_ID";
        $query_run_minusCredits0 = mysqli_query($conn, $sql_minusvacationCredits0);
    }
    elseif($row['col_LeaveType'] == 'Bereavement Leave'){
        $minusBrvmntCredits0 = $row__leaveINFO['col_brvmntCrdt'] - 0.5; //para mag minus sa credits sa IF Vacation
        $sql_minusBrvmntCredits0 ="UPDATE leaveinfo_tb SET col_brvmntCrdt= $minusBrvmntCredits0 WHERE col_empID = $employee_ID";
        $query_run_BrvmntminusCredits0 = mysqli_query($conn, $sql_minusBrvmntCredits0);
    }
    elseif($row['col_LeaveType'] == 'Sick Leave'){
        $minusSickCredits0 = $row__leaveINFO['col_sickCrdt'] - 0.5; //para mag minus sa credits sa IF Vacation
        $sql_minusSickCredits0 ="UPDATE leaveinfo_tb SET col_sickCrdt= $minusSickCredits0 WHERE col_empID = $employee_ID";
        $query_run_SickminusCredits0 = mysqli_query($conn, $sql_minusSickCredits0);
    }


       //pra sa pag update ng action taken at status to approved
       $IDLEAVE_TABLE = $_SESSION["ID_applyleave"];

            // Get the current date and time
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('Asia/Manila'));
            $currentDateTime = $now->format('Y-m-d H:i:s');
            $Status = $_SESSION["col_status"];
            $reason = $_POST["name_approvedtResn"]; //dito ako nahinto (d nakapag insert)

            $sql1 = "INSERT into actiontaken_tb(`col_applyID`, `col_remarks`,`col_status`) 
            VALUES('$IDLEAVE_TABLE','$reason', 'Approved')";
              if(mysqli_query($conn,$sql1))
              {
                $sql ="UPDATE applyleave_tb SET col_status= 'Approved', col_dt_action= '$currentDateTime' WHERE col_ID = $IDLEAVE_TABLE";
                $query_run = mysqli_query($conn, $sql);
    
    
                    if($query_run){
                        header("Location: ../../leavereq.php?msg=Approved Successfully");
                    }
                    else{
                        echo '<script> alert("Data Not Updated"); </script>';
                    }

              }
              else{
                echo '<script> alert("Data Not Updated"); </script>';
              }
} //-----------------------------------PARA SA PAG MINUS NG CREDITS IF HALDAY firsthalf end----------------------------------------------
else{
//------------------------------------  CODE FOR UPDATING LEAVE REQUEST ACTION DATETIME, STATUS and MINUS LEAVE INFO CRDITS FUllday----------------------------------
    //para sa pag update from pending to approved and action time
        //PARA SA PAG UPDATE NG CREDITS SA APPLY TB
        $date1 = new DateTime($row['col_strDate']); // assuming 'date1' is the name of the first input field
        $date2 = new DateTime($row['col_endDate']); // assuming 'date2' is the name of the second input field
        $interval = $date1->diff($date2);
        //echo $interval->days . "  break";
        //echo "The number of days between the two dates is: " . $interval->days;

        if($row['col_LeaveType'] == 'Vacation Leave'){
            $minusVacationCredits = $row__leaveINFO['col_vctionCrdt'] - $interval->days; //para mag minus sa credits sa IF Vacation
            $sql_minusvacationCredits ="UPDATE leaveinfo_tb SET col_vctionCrdt= $minusVacationCredits WHERE col_empID = $employee_ID";
            $query_run_minusCredits = mysqli_query($conn, $sql_minusvacationCredits);
        }
        elseif($row['col_LeaveType'] == 'Bereavement Leave'){
            $minusBrvmntCredits = $row__leaveINFO['col_brvmntCrdt'] - $interval->days; //para mag minus sa credits sa IF Vacation
            $sql_minusBrvmntCredits ="UPDATE leaveinfo_tb SET col_brvmntCrdt= $minusBrvmntCredits WHERE col_empID = $employee_ID";
            $query_run_BrvmntminusCredits = mysqli_query($conn, $sql_minusBrvmntCredits);
        }
        elseif($row['col_LeaveType'] == 'Sick Leave'){
            $minusSickCredits = $row__leaveINFO['col_sickCrdt'] - $interval->days; //para mag minus sa credits sa IF Vacation
            $sql_minusSickCredits ="UPDATE leaveinfo_tb SET col_sickCrdt= $minusSickCredits WHERE col_empID = $employee_ID";
            $query_run_SickminusCredits = mysqli_query($conn, $sql_minusSickCredits);
        }

       
         //PARA SA PAG UPDATE NG CREDITS SA APPLY TB (END)
        
    //------------------------------------BREAK----------------------------------
    //pra sa pag update ng action taken at status to approved

            // Get the current date and time
            $now = new DateTime();
            $now->setTimezone(new DateTimeZone('Asia/Manila'));
            $currentDateTime = $now->format('Y-m-d H:i:s');
            $Status = $_SESSION["col_status"];
            $IDLEAVE_TABLE = $_SESSION["ID_applyleave"];

            $reason = $_POST["name_approvedtResn"]; //dito ako nahinto (d nakapag insert)

            $sql1 = "INSERT into actiontaken_tb(`col_applyID`, `col_remarks`,`col_status`) 
            VALUES('$IDLEAVE_TABLE','$reason', 'Approved')";
              if(mysqli_query($conn,$sql1))
              {
                $sql ="UPDATE applyleave_tb SET col_status= 'Approved', col_dt_action= '$currentDateTime' WHERE col_ID = $IDLEAVE_TABLE";
                $query_run = mysqli_query($conn, $sql);
    
    
                    if($query_run){
                        header("Location: ../../leavereq.php?msg=Approved Successfully");
                    }
                    else{
                        echo '<script> alert("Data Not Updated"); </script>';
                    }
              }
              else{
                echo '<script> alert("Data Not Updated"); </script>';
              }
           
//------------------------------------CODE FOR UPDATING LEAVE REQUEST ACTION DATETIME, STATUS and MINUS LEAVE INFO CRDITS END----------------------------------
}
}


    }    
//----------------------------------------------------------------------------BREAK(FOR Approving END)-----------------------------------------------------
/*
    //----------------------------------------------BREAK(FOR REJECTING)-----------------------------------------------------
    if(isset($_POST['name_rejected'])){
        $IDLEAVE_TABLE = $_SESSION["ID_applyleave"];
//Para sa pag select ng mga data galing sa APPLYLEAVE TABLE
        $result = mysqli_query($conn, " SELECT
                                            *  
                                        FROM
                                            applyleave_tb
                                        WHERE col_ID=  $IDLEAVE_TABLE");
        $row = mysqli_fetch_assoc($result);
        //echo $row['col_LeaveType'];
//Para sa pag select ng mga data galing sa APPLYLEAVE TABLE (END)

if($row['col_status'] === 'Approved' ){
    header("Location: leavereq.php?msg=You cannot REJECT a request that is already APPROVED");
}
else if($row['col_status'] === 'Rejected' ){
    header("Location: leavereq.php?msg=You cannot REJECT a request that is already REJECTED");
}
else{


        //para sa pag update from pending to approved and action time
          // Get the current date and time
          $now = new DateTime();
          $now->setTimezone(new DateTimeZone('Asia/Manila'));
          $currentDateTime1 = $now->format('Y-m-d H:i:s');

          //get the session for ID in applyleave selected employee
          $Status = $_SESSION["col_status"];
          $Applyleave_ID = $_SESSION["ID_applyleave"];

          $sql ="UPDATE applyleave_tb SET  col_status= 'Rejected', col_dt_action= '$currentDateTime1' WHERE col_ID = $Applyleave_ID";
          $query_run = mysqli_query($conn, $sql);


          if($query_run){
              header("Location: leavereq.php?msg=Rejected Successfully");
          }
          else{
              echo '<script> alert("Data Not Updated"); </script>';
          }
}

    
    }

    */
?>