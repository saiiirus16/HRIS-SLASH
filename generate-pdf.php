<?php
// Retrieve the PDF data from the request

include 'config.php';

// $pdfData = $_POST['pdfData'];
$pdfData = $_POST['pdfData'];
$emp_ID = $_POST['emp_ID'];
$name_cutOff_freq = $_POST['name_cutOff_freq'];
$name_cutOff_num = $_POST['name_cutOff_num'];
$name_numworks = $_POST['name_numworks'];
$name_cutoffID = $_POST['name_cutoffID'];

// $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
// $stmt->bind_param("siii", $contents, $emp_ID, $name_numworks, $name_cutoffID);
// $stmt->execute();

// echo 'Done';



// // Connect to the MySQL database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "hris_db";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // Prepare and execute the SQL statement to insert the PDF data into the database
// $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid) VALUES (?, ?)");
// $stmt->bind_param("ss", $pdfData, $emp_ID);
// $stmt->execute();
// echo 'hakdog';

// $stmt->close();
// $conn->close();

// if(isset($_POST['btn_download_pdf'])){
//  include 'config.php';
    
//     $emp_ID = $_POST['name_empID'];
//     $name_cutOff_freq = $_POST['name_cutOff_freq'];
//     $name_cutOff_num = $_POST['name_cutOff_num'];

// //     $col_strCutoff = $_POST['col_strCutoff'];
// //     $col_endCutoff = $_POST['col_endCutoff'];
// //     $col_totalHours = $_POST['col_totalHours'];
// //     $col_PaidAmount = $_POST['col_PaidAmount'];
// //     $col_total_HOURSOT = $_POST['col_total_HOURSOT'];
// //     $col_oTPaidAmount = $_POST['col_oTPaidAmount'];
// //     $col_totalAllowance = $_POST['col_totalAllowance'];
// //     $col_SSS_deduct = $_POST['col_SSS_deduct'];
// //     $col_PH_deduct = $_POST['col_PH_deduct'];
// //     $col_tin_deduct = $_POST['col_tin_deduct'];
// //     $col_pagibig_deduct = $_POST['col_pagibig_deduct'];
// //     $col_otherGOV_deduct = $_POST['col_otherGOV_deduct'];
// //     $col_LATEUT_deduct = $_POST['col_LATEUT_deduct'];
    

    if ($_POST['name_cutOff_freq'] === 'Monthly'){


    }else if($_POST['name_cutOff_freq'] === 'Semi-Month'){
      $first_cutOFf = '1';
      $last_cutoff ='2';
    }
    else if($_POST['name_cutOff_freq'] === 'Weekly'){
      $first_cutOFf = '1';
      $last_cutoff ='4';
    }







    if ($_POST['name_cutOff_freq'] === 'Monthly')
    {
        //for every cutoff loan deductions
        $query = "SELECT * FROM payroll_loan_tb WHERE empid = $emp_ID AND loan_status != 'PAID'";
        $result = $conn->query($query);

        // Check if any rows are fetched
        if ($result->num_rows > 0) 
        {
          $loanArray = array(); // Array to store the dates

        // Loop through each row
        while($row = $result->fetch_assoc()) 
        {
          $loan_ID = $row["id"];
          $loan_payable = $row["payable_amount"];
          $loan_amortization = $row["amortization"];
          $loan_BAL = $row["col_BAL_amount"] ;

            // echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
            // echo  'Payable:  ' .  $loan_payable . '<br>'; 
            // echo 'amortization ' . $loan_amortization . '<br>'; 
            // echo 'BalaNCE ' . $loan_BAL . '<br>'; 

            //echo 'balance: ' . ((int)$loan_payable - (int)$loan_amortization) . '<br><br><br>'; 

            $loanArray[] = array('ammortization' => $loan_amortization, 'loanID_tb' => $loan_ID, 'loan_balance' => $loan_BAL); 
            
        } //end while


          

            // Bind parameters and execute the statement for each loan
            foreach ($loanArray as $loan_data) {
              // Prepare the statement
                $sql = "UPDATE payroll_loan_tb SET col_BAL_amount = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);

                $diff_loan = ((int) $loan_data['loan_balance'] - (int) $loan_data['ammortization']);
                $stmt->bind_param("ii", $diff_loan, $loan_data['loanID_tb']);
                $stmt->execute();

                if($diff_loan <= 0){
                  $sql = "UPDATE payroll_loan_tb SET loan_status = ? WHERE id = ?";
                  $stmt = $conn->prepare($sql);

                  $loan_stats = 'PAID';
                  $stmt->bind_param("si", $loan_stats, $loan_data['loanID_tb']);
                  $stmt->execute();
                }  


            }

            


            // $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
            //         VALUES('$emp_ID', '$col_strCutof', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
            //         if(mysqli_query($conn,$sql)){
            //           header("Location: cutoff.php?msg= Successfully Generated the Payslip");
            //         }
            //         else{
            //           echo "Error";
            //         }
     // Prepare and execute the SQL statement to insert the PDF data into the database
$stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
$stmt->execute();
echo 'Done';


           
        } //end every_cutoff
        else {
        //   $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
        //             VALUES('$emp_ID', '$col_strCutof', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
        //             if(mysqli_query($conn,$sql)){
        //               header("Location: cutoff.php?msg= Successfully Generated the Payslip");
        //             }
        //             else{
        //               echo "Error";
        //             }
  // Prepare and execute the SQL statement to insert the PDF data into the database
  $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
$stmt->execute();
echo 'Done';



        }

    } //END IF MONTHLY
    else
    {
        if($name_cutOff_num === $first_cutOFf)
        {
          $query = "SELECT * FROM payroll_loan_tb WHERE empid = $emp_ID AND loan_status != 'PAID' AND (`applied_cutoff` = 'First Cutoff' OR `applied_cutoff` = 'Every Cutoff')";
          $result = $conn->query($query);
      
          // Check if any rows are fetched
          if ($result->num_rows > 0) 
          {
            $loanArray = array(); // Array to store the dates
    
          // Loop through each row
          while($row = $result->fetch_assoc()) 
          {
            $loan_ID = $row["id"];
            $loan_payable = $row["payable_amount"];
            $loan_amortization = $row["amortization"];
            $loan_BAL = $row["col_BAL_amount"] ;

            //   echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
            //   echo  'Payable:  ' .  $loan_payable . '<br>'; 
            //   echo 'amortization ' . $loan_amortization . '<br>'; 
            //   echo 'BalaNCE ' . $loan_BAL . '<br>'; 

              //echo 'balance: ' . ((int)$loan_payable - (int)$loan_amortization) . '<br><br><br>'; 
          
              $loanArray[] = array('ammortization' => $loan_amortization, 'loanID_tb' => $loan_ID, 'loan_balance' => $loan_BAL); 
              
          } //end while


            

              // Bind parameters and execute the statement for each loan
              foreach ($loanArray as $loan_data) {
                // Prepare the statement
                  $sql = "UPDATE payroll_loan_tb SET col_BAL_amount = ? WHERE id = ?";
                  $stmt = $conn->prepare($sql);

                  $diff_loan = ((int) $loan_data['loan_balance'] - (int) $loan_data['ammortization']);
                  $stmt->bind_param("ii", $diff_loan, $loan_data['loanID_tb']);
                  $stmt->execute();

                  if($diff_loan <= 0){
                    $sql = "UPDATE payroll_loan_tb SET loan_status = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
    
                    $loan_stats = 'PAID';
                    $stmt->bind_param("si", $loan_stats, $loan_data['loanID_tb']);
                    $stmt->execute();
                  }  


              }

              

            //   $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
            //         VALUES('$emp_ID', '$col_strCutoff', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
            //         if(mysqli_query($conn,$sql)){
            //           header("Location: cutoff.php?msg= Successfully Generated the Payslip");
            //         }
            //         else{
            //           echo "Error";
            //         }
         // Prepare and execute the SQL statement to insert the PDF data into the database
         $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
    $stmt->execute();
    echo 'Done';


          } //end first_cutoff
          else{
            // $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
            //         VALUES('$emp_ID', '$col_strCutoff', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
            //         if(mysqli_query($conn,$sql)){
            //           header("Location: cutoff.php?msg= Successfully Generated the Payslip");
            //         }
            //         else{
            //           echo "Error";
            //         }

           // Prepare and execute the SQL statement to insert the PDF data into the database
           $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
           $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
           $stmt->execute();
           echo 'Done';




      
          }
        }
        else if($name_cutOff_num === $last_cutoff)
        {
          $query = "SELECT * FROM payroll_loan_tb WHERE empid = $emp_ID AND loan_status != 'PAID' AND (`applied_cutoff` = 'Last Cutoff' OR `applied_cutoff` = 'Every Cutoff')";
          $result = $conn->query($query);
      
          // Check if any rows are fetched
          if ($result->num_rows > 0) 
          {
            $loanArray = array(); // Array to store the dates
    
          // Loop through each row
          while($row = $result->fetch_assoc()) 
          {
            $loan_ID = $row["id"];
            $loan_payable = $row["payable_amount"];
            $loan_amortization = $row["amortization"];
            $loan_BAL = $row["col_BAL_amount"] ;

            //   echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
            //   echo  'Payable:  ' .  $loan_payable . '<br>'; 
            //   echo 'amortization ' . $loan_amortization . '<br>'; 
            //   echo 'BalaNCE ' . $loan_BAL . '<br>'; 

              //echo 'balance: ' . ((int)$loan_payable - (int)$loan_amortization) . '<br><br><br>'; 
          
              $loanArray[] = array('ammortization' => $loan_amortization, 'loanID_tb' => $loan_ID, 'loan_balance' => $loan_BAL); 
              
          } //end while


            

              // Bind parameters and execute the statement for each loan
              foreach ($loanArray as $loan_data) {
                // Prepare the statement
                  $sql = "UPDATE payroll_loan_tb SET col_BAL_amount = ? WHERE id = ?";
                  $stmt = $conn->prepare($sql);

                  $diff_loan = ((int) $loan_data['loan_balance'] - (int) $loan_data['ammortization']);
                  $stmt->bind_param("ii", $diff_loan, $loan_data['loanID_tb']);
                  $stmt->execute();

                  if($diff_loan <= 0){
                    $sql = "UPDATE payroll_loan_tb SET loan_status = ? WHERE id = ?";
                    $stmt = $conn->prepare($sql);
    
                    $loan_stats = 'PAID';
                    $stmt->bind_param("si", $loan_stats, $loan_data['loanID_tb']);
                    $stmt->execute();
                  }  


              }

              

            //   $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
            //         VALUES('$emp_ID', '$col_strCutoff', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
            //         if(mysqli_query($conn,$sql)){
            //           header("Location: cutoff.php?msg= Successfully Generated the Payslip");
            //         }
            //         else{
            //           echo "Error";
            //         }
   // Prepare and execute the SQL statement to insert the PDF data into the database
   $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
   $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
    $stmt->execute();
    echo 'Done';




          } //end second_cutoff
         

          else{
            // $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
            //         VALUES('$emp_ID', '$col_strCutoff', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
            //         if(mysqli_query($conn,$sql)){
            //           header("Location: cutoff.php?msg= Successfully Generated the Payslip");
            //         }
            //         else{
            //           echo "Error";
            //         }

           // Prepare and execute the SQL statement to insert the PDF data into the database
           $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
           $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
            $stmt->execute();
            echo 'Done';

      
          }
        }
      
     
    } //END IF WEEKLY OR SEMI-Month

    $query = "SELECT * FROM payroll_loan_tb WHERE empid = $emp_ID AND loan_status != 'PAID' AND `applied_cutoff` = 'Every Cutoff'";
    $result = $conn->query($query);

    // Check if any rows are fetched
    if ($result->num_rows > 0) 
    {
    
          $loanArray = array(); // Array to store the dates
    
        // Loop through each row
        while($row = $result->fetch_assoc()) 
        {

          $loan_ID = $row["id"];
          $loan_payable = $row["payable_amount"];
          $loan_amortization = $row["amortization"];
          $loan_BAL = $row["col_BAL_amount"] ;

            // echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
            // echo  'Payable:  ' .  $loan_payable . '<br>'; 
            // echo 'amortization ' . $loan_amortization . '<br>'; 
            // echo 'BalaNCE ' . $loan_BAL . '<br>'; 

            //echo 'balance: ' . ((int)$loan_payable - (int)$loan_amortization) . '<br><br><br>'; 
        
            $loanArray[] = array('ammortization' => $loan_amortization, 'loanID_tb' => $loan_ID, 'loan_balance' => $loan_BAL); 
            
        } //end while


           

            // Bind parameters and execute the statement for each loan
            foreach ($loanArray as $loan_data) {
              // Prepare the statement
                $sql = "UPDATE payroll_loan_tb SET col_BAL_amount = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);

                $diff_loan = ((int) $loan_data['loan_balance'] - (int) $loan_data['ammortization']);
                $stmt->bind_param("ii", $diff_loan, $loan_data['loanID_tb']);
                $stmt->execute();

                if($diff_loan <= 0){
                  $sql = "UPDATE payroll_loan_tb SET loan_status = ? WHERE id = ?";
                  $stmt = $conn->prepare($sql);
  
                  $loan_stats = 'PAID';
                  $stmt->bind_param("si", $loan_stats, $loan_data['loanID_tb']);
                  $stmt->execute();
                }  


            }

           

            // $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
            //         VALUES('$emp_ID', '$col_strCutoff', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
            //         if(mysqli_query($conn,$sql)){
            //           header("Location: cutoff.php?msg= Successfully Generated the Payslip");
            //         }
            //         else{
            //           echo "Error";
            //         }
  // Prepare and execute the SQL statement to insert the PDF data into the database
  $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
    $stmt->execute();
    echo 'Done';
 

    }
    else{
    //   $sql = "INSERT into payslip_tb(`col_empid`, `col_strCutoff`, `col_endCutoff`, `col_totalHours`, `col_PaidAmount`, `col_total_HOURSOT`, `col_oTPaidAmount`, `col_totalAllowance`, `col_SSS_deduct`, `col_PH_deduct`, `col_tin_deduct`, `col_pagibig_deduct`, `col_otherGOV_deduct`, `col_LATEUT_deduct`) 
                    
    //                 VALUES('$emp_ID', '$col_strCutoff', '$col_endCutoff', '$col_totalHours', '$col_PaidAmount', '$col_total_HOURSOT', '$col_oTPaidAmount', '$col_totalAllowance','$col_SSS_deduct', '$col_PH_deduct', '$col_tin_deduct', '$col_pagibig_deduct ','$col_otherGOV_deduct', '$col_LATEUT_deduct')";
                    
    //                 if(mysqli_query($conn,$sql)){
    //                   header("Location: cutoff.php?msg= Successfully Generated the Payslip");
    //                 }
    //                 else{
    //                   echo "Error";
    //                 }
    // Prepare and execute the SQL statement to insert the PDF data into the database
    $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $pdfData, $emp_ID, $name_numworks, $name_cutoffID);
    $stmt->execute();
    echo 'Done';



    }

   
// } close isset



?>
