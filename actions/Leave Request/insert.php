
<?php
    include '../../config.php';
     #--------------------------------START IF SA HALFDAY FIRST OR SECOND HALF--------------------------------
     if (isset($_POST['firstHalf'])) {

        
                                $empname = $_POST["name_emp"];
                                $leave_type =  $_POST['name_LeaveT'];
                                $leave_period = $_POST['firstHalf'];
                                $str_date = $_POST['name_STRdate'];
                                $end_date = $_POST['name_ENDdate'];
                                $reason_txt = $_POST['name_txtRSN'];
                                #file name with a random number so that similar dont get replaced
                                $reason_file = rand(1000,10000)."-".$_FILES["name_file"]["name"];

                                #temporary file name to store file
                                $tname = $_FILES["name_file"]["tmp_name"];
                        
                            #upload directory path
                            $uploads_dir = 'file_reason';
                            #TO move the uploaded file to specific location
                            move_uploaded_file($tname, $uploads_dir.'/'.$reason_file);

                            //Para sa pag select ng mga data galing sa LEAVE INFO TABLE
                                $result_leaveINFO = mysqli_query($conn, "SELECT
                                    *  
                                FROM
                                    leaveinfo_tb
                                WHERE col_empID = $empname");
                                if(mysqli_num_rows($result_leaveINFO) > 0) {
                                    $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO);
                                    //echo $row__leaveINFO['col_vctionCrdt'];
                                } else {
                                    echo "No results found.";
                                }
                            //Para sa pag select ng mga data galing sa LEAVE INFO TABLE (END)

                        
                            //------------------------------------------------START VALIDATION ONLY ONE REQUEST-----------------------------------------------------
                       
            //Para sa pag select ng mga data galing sa apply leave TABLE  (PARA MAG CHECK IF EXIST)
                                $result_leaveINFO = mysqli_query($conn, " SELECT
                                *  
                                FROM
                                    applyleave_tb
                                WHERE col_req_emp = $empname
                                AND col_LeavePeriod = '$leave_period'
                                AND col_status = 'Pending'");
                                if(mysqli_num_rows($result_leaveINFO) > 0) {
                                    $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO);
                                    header("Location: ../../leavereq.php?msg= Cannot apply another request due to Pending Request");
                                } else {                                                  
                                                    $minusVacationCredits = $row__leaveINFO['col_vctionCrdt'] - 0.5;
                                                    $minusSickCredits = $row__leaveINFO['col_sickCrdt'] - 0.5;
                                                    $minusBvrvmntCredits = $row__leaveINFO['col_brvmntCrdt'] - 0.5; 
                                            
                                                    if($leave_type == 'Vacation Leave'){
                                                        if($minusVacationCredits < 0 ){
                                                            header("Location: ../../leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Vacation Leave");
                                                        }
                                                        else{
                                                                #sql query to insert into database
                                                            $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                                            VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                                            
                                                                if(mysqli_query($conn,$sql)){
                                                                    header("Location: ../../leavereq.php?msg=Successfully Added");
                                                                }
                                                                else{
                                                                echo "Error";
                                                                }
                                                            }
                                                    } //end if statement in Vacation
                                                    elseif($leave_type == 'Bereavement Leave'){
                                                        if($minusBvrvmntCredits < 0 ){
                                                            header("Location: ../../leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Bereavement Leave");
                                                        }
                                                        else{
                                                                #sql query to insert into database
                                                            $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                                            VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                                            
                                                                if(mysqli_query($conn,$sql)){
                                                                header("Location: ../../leavereq.php?msg=Successfully Added");
                                                                }
                                                                else{
                                                                echo "Error";
                                                                }
                                                            }
                                                    } //end if statement in Bereavement Leave
                                                    elseif($leave_type == 'Sick Leave'){
                                                        if($minusSickCredits < 0 ){
                                                            header("Location: ../../leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Sick Leave");
                                                        }
                                                        else{
                                                                #sql query to insert into database
                                                            $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                                            VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                                            
                                                                if(mysqli_query($conn,$sql)){
                                                                header("Location: ../../leavereq.php?msg=Successfully Added");
                                                                }
                                                                else{
                                                                echo "Error";
                                                                }
                                                            }
                                                    } //end if statement in Sick Leave

                                }

            //Para sa pag select ng mga data galing sa apply leave TABLE  (PARA MAG CHECK IF EXIST)




                            //------------------------------------------------START VALIDATION ONLY ONE REQUEST END-----------------------------------------------------
                            

        }
    else if (isset($_POST['secondHalf'])) {


                                    $empname = $_POST["name_emp"];
                                    $leave_type =  $_POST['name_LeaveT'];
                                    $leave_period = $_POST['secondHalf'];
                                    $str_date = $_POST['name_STRdate'];
                                    $end_date = $_POST['name_ENDdate'];
                                    $reason_txt = $_POST['name_txtRSN'];
                                    #file name with a random number so that similar dont get replaced
                                    $reason_file = rand(1000,10000)."-".$_FILES["name_file"]["name"];

                                    #temporary file name to store file
                                    $tname = $_FILES["name_file"]["tmp_name"];
                            
                                #upload directory path
                                $uploads_dir = 'file_reason';
                                #TO move the uploaded file to specific location
                                move_uploaded_file($tname, $uploads_dir.'/'.$reason_file);

                                //Para sa pag select ng mga data galing sa LEAVE INFO TABLE
                                    $result_leaveINFO = mysqli_query($conn, "SELECT
                                        *  
                                    FROM
                                        leaveinfo_tb
                                    WHERE col_empID = $empname");
                                    if(mysqli_num_rows($result_leaveINFO) > 0) {
                                        $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO);
                                        //echo $row__leaveINFO['col_vctionCrdt'];
                                    } else {
                                        echo "No results found.";
                                    }
                                //Para sa pag select ng mga data galing sa LEAVE INFO TABLE (END)

   
    //------------------------------------------------START VALIDATION ONLY ONE REQUEST-----------------------------------------------------
                        //Para sa pag select ng mga data galing sa apply leave TABLE
                        $result_leaveINFO1 = mysqli_query($conn, " SELECT
                        *  
                        FROM
                            applyleave_tb
                        WHERE col_req_emp = $empname
                        AND col_LeavePeriod = '$leave_period'
                        AND col_status = 'Pending'");
                        if(mysqli_num_rows($result_leaveINFO1) > 0) {
                            $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO1);
                            header("Location: ../../leavereq.php?msg= Cannot apply another request due to Pending Request");
                        } else {


                            $minusVacationCredits = $row__leaveINFO['col_vctionCrdt'] - 0.5;
                            $minusSickCredits = $row__leaveINFO['col_sickCrdt'] - 0.5;
                            $minusBvrvmntCredits = $row__leaveINFO['col_brvmntCrdt'] - 0.5; 
                                    
                                            if($leave_type == 'Vacation Leave'){
                                                if($minusVacationCredits < 0 ){
                                                    header("Location: leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Vacation Leave");
                                                }
                                                else{
                                                        #sql query to insert into database
                                                    $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                                    VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                                    
                                                        if(mysqli_query($conn,$sql)){
                                                            header("Location: leavereq.php?msg=Successfully Added");
                                                        }
                                                        else{
                                                        echo "Error";
                                                        }
                                                    }
                                            } //end if statement in Vacation
                                            elseif($leave_type == 'Bereavement Leave'){
                                                if($minusBvrvmntCredits < 0 ){
                                                    header("Location: leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Bereavement Leave");
                                                }
                                                else{
                                                        #sql query to insert into database
                                                    $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                                    VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                                    
                                                        if(mysqli_query($conn,$sql)){
                                                        header("Location: leavereq.php?msg=Successfully Added");
                                                        }
                                                        else{
                                                        echo "Error";
                                                        }
                                                    }
                                            } //end if statement in Bereavement Leave
                                            elseif($leave_type == 'Sick Leave'){
                                                if($minusSickCredits < 0 ){
                                                    header("Location: leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Sick Leave");
                                                }
                                                else{
                                                        #sql query to insert into database
                                                    $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                                    VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                                    
                                                        if(mysqli_query($conn,$sql)){
                                                        header("Location: leavereq.php?msg=Successfully Added");
                                                        }
                                                        else{
                                                        echo "Error";
                                                        }
                                                    }
                                            } //end if statement in Sick Leave
                                         //--------------------------BREAK END IF FULLDAY ANG REQUEST---------------------- 
           }
   //Para sa pag select ng mga data galing sa apply leave TABLE (END)




    //------------------------------------------------START VALIDATION ONLY ONE REQUEST END-----------------------------------------------------

    }#--------------------------------END IF SA HALFDAY FIRST OR SECOND HALF--------------------------------
    else { //------------------------------------pARA if full day
         
        $empname = $_POST["name_emp"];
        $leave_type =  $_POST['name_LeaveT'];
        $leave_period = $_POST['name_LeaveP'];
        $str_date = $_POST['name_STRdate'];
        $end_date = $_POST['name_ENDdate'];
        $reason_txt = $_POST['name_txtRSN'];
        #file name with a random number so that similar dont get replaced
        $reason_file = rand(1000,10000)."-".$_FILES["name_file"]["name"];

        #temporary file name to store file
        $tname = $_FILES["name_file"]["tmp_name"];
   
    #upload directory path
    $uploads_dir = 'file_reason';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$reason_file);

    //Para sa pag select ng mga data galing sa LEAVE INFO TABLE
        $result_leaveINFO = mysqli_query($conn, "SELECT
            *  
        FROM
            leaveinfo_tb
        WHERE col_empID = $empname");
        if(mysqli_num_rows($result_leaveINFO) > 0) {
            $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO);
            //echo $row__leaveINFO['col_vctionCrdt'];
        } else {
            echo "No results found.";
        }
    //Para sa pag select ng mga data galing sa LEAVE INFO TABLE (END)

   
    //------------------------------------------------START VALIDATION ONLY ONE REQUEST-----------------------------------------------------
           //Para sa pag select ng mga data galing sa apply leave TABLE
        $result_leaveINFO = mysqli_query($conn, " SELECT
           *  
           FROM
               applyleave_tb
           WHERE col_req_emp = $empname
           AND col_LeavePeriod = '$leave_period'
           AND col_status = 'Pending'");
           if(mysqli_num_rows($result_leaveINFO) > 0) {
               $row__leaveINFO = mysqli_fetch_assoc($result_leaveINFO);
               header("Location: ../../leavereq.php?msg= Cannot apply another request due to Pending Request");
           } else {
                            //---------------BREAK START IF FULLDAY ANG REQUEST----------------
                            $date1 = new DateTime($str_date); // value ng start date 
                            $date2 = new DateTime($end_date); // value ng end date 
                            $interval = $date1->diff($date2);
                            echo $interval->days . "  break";
                            $minusVacationCredits = $row__leaveINFO['col_vctionCrdt'] - $interval->days;
                            $minusSickCredits = $row__leaveINFO['col_sickCrdt'] - $interval->days;
                            $minusBvrvmntCredits = $row__leaveINFO['col_brvmntCrdt'] - $interval->days;
                    
                            if($leave_type == 'Vacation Leave'){
                                if($minusVacationCredits < 0 ){
                                    header("Location: ../../leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Vacation Leave");
                                }
                                else{
                                        #sql query to insert into database
                                    $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                    VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                    
                                        if(mysqli_query($conn,$sql)){
                                            header("Location: ../../leavereq.php?msg=Successfully Added");
                                        }
                                        else{
                                        echo "Error";
                                        }
                                    }
                            } //end if statement in Vacation
                            elseif($leave_type == 'Bereavement Leave'){
                                if($minusBvrvmntCredits < 0 ){
                                    header("Location: ../../leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Bereavement Leave");
                                }
                                else{
                                        #sql query to insert into database
                                    $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                    VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                    
                                        if(mysqli_query($conn,$sql)){
                                        header("Location: ../../leavereq.php?msg=Successfully Added");
                                        }
                                        else{
                                        echo "Error";
                                        }
                                    }
                            } //end if statement in Bereavement Leave
                            elseif($leave_type == 'Sick Leave'){
                                if($minusSickCredits < 0 ){
                                    header("Location: ../../leavereq.php?msg=You cannot apply request from the range date provide. Lack of credits for Sick Leave");
                                }
                                else{
                                        #sql query to insert into database
                                    $sql = "INSERT into applyleave_tb(`col_req_emp`, `col_LeaveType`, `col_LeavePeriod`, `col_strDate`, `col_endDate`, `col_reason`, `col_file`, `col_status`) 
                                    VALUES('$empname', '$leave_type', '$leave_period', '$str_date', '$end_date', '$reason_txt', '$reason_file', 'Pending')";
                    
                                        if(mysqli_query($conn,$sql)){
                                        header("Location: ../../leavereq.php?msg=Successfully Added");
                                        }
                                        else{
                                        echo "Error";
                                        }
                                    }
                            } //end if statement in Sick Leave
                                         //--------------------------BREAK END IF FULLDAY ANG REQUEST---------------------- 
           }
   //Para sa pag select ng mga data galing sa apply leave TABLE (END)



    //------------------------------------------------START VALIDATION ONLY ONE REQUEST END-----------------------------------------------------
        
    }


      
?>