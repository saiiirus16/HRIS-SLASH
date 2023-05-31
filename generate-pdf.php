<?php
// Retrieve the PDF data from the request

include 'config.php';

$pdfData = $_POST['pdfData'];
$emp_ID = $_POST['emp_ID'];
$name_cutOff_freq = $_POST['name_cutOff_freq'];
$name_cutOff_num = $_POST['name_cutOff_num'];
$name_numworks = $_POST['name_numworks'];
$name_cutoffID = $_POST['name_cutoffID'];

$decodedPdfData = base64_decode($pdfData);

date_default_timezone_set('Asia/Manila');
$currentDateTime = date('His');

$result_emp = mysqli_query($conn, " SELECT
                                        CONCAT(
                                            employee_tb.`fname`,
                                                ' ',
                                            employee_tb.`lname`
                                            ) AS `full_name`
                                            FROM 
                                            `employee_tb`
                                            WHERE `empid`=  '$emp_ID'");
 $row_emp= mysqli_fetch_assoc($result_emp);

 $pdfFilePath = 'Payslip PDF/' . $row_emp['full_name'] . $currentDateTime . "_" . $name_cutOff_num . '.pdf'; // Generate a unique filename for the PDF
 $file = fopen($pdfFilePath, 'wb'); // Open the file in write mode
 fwrite($file, $decodedPdfData); // Write the PDF data to the file
 fclose($file); // Close the file
    

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

           

            $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
            $stmt->execute();

            echo 'Done';


           
        } //end every_cutoff
        else {
            
            $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
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


            $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
            $stmt->execute();

            echo 'Done';


          } //end first_cutoff
          else{
            
            $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
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


    $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
    $stmt->execute();

    echo 'Done';




          } //end second_cutoff
         

          else{

            $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
            $stmt->execute();

            echo 'Done';

      
          }
        }
        else if($name_cutOff_num === '2' || $name_cutOff_num === '3' )
        {
            

                //-----------------------------------BREAK FOR DEDUCTION EVERY CUTOFF (MAY ERROR PAG NAG DODOUBLE DOWNLOAD AT INSERT PAG FIRST CUT OFF AT LAST)---------------------------------------

                    
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
            
                        $pdfFilePath = 'Payslip PDF/' . $row_emp['full_name'] . "_" . $name_cutOff_num . '.pdf'; // Generate a unique filename for the PDF
                        $file = fopen($pdfFilePath, 'wb'); // Open the file in write mode
                        fwrite($file, $decodedPdfData); // Write the PDF data to the file
                        fclose($file); // Close the file
                        
                        $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
                        $stmt->execute();
                        
                        echo 'Done';
              
            
                }
                else{
            
                    $pdfFilePath = 'Payslip PDF/' . $row_emp['full_name'] . "_" . $name_cutOff_num . '.pdf'; // Generate a unique filename for the PDF
                    $file = fopen($pdfFilePath, 'wb'); // Open the file in write mode
                    fwrite($file, $decodedPdfData); // Write the PDF data to the file
                    fclose($file); // Close the file
                    
                    $stmt = $conn->prepare("INSERT INTO payslip_tb (col_Payslip_pdf, col_empid, col_numDaysWork, col_cutoffID) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("siii", $pdfFilePath, $emp_ID, $name_numworks, $name_cutoffID);
                    $stmt->execute();
                    
                    echo 'Done';
            
                }
        } //EMD IF 2 and 3 ang cutoff

       
    
      
     
    } //END IF WEEKLY OR SEMI-Month




?>
