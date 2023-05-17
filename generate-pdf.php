<?php
// require_once('tcpdf/tcpdf.php');

// $content = $_POST['content'];

// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// $pdf->SetCreator(PDF_CREATOR);
// $pdf->SetAuthor('Your Name');
// $pdf->SetTitle('Modal Content PDF');

// $pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);

// $pdf->AddPage();

// $pdf->writeHTML($content, true, false, true, false, '');

// $pdf->Output('modal-content.pdf', 'D');

if(isset($_POST['btn_download_pdf'])){
    include 'config.php';
    
    $emp_ID = $_POST['name_empID'];
    $name_cutOff_freq = $_POST['name_cutOff_freq'];
    $name_cutOff_num = $_POST['name_cutOff_num'];
    

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

            echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
            echo  'Payable:  ' .  $loan_payable . '<br>'; 
            echo 'amortization ' . $loan_amortization . '<br>'; 
            echo 'BalaNCE ' . $loan_BAL . '<br>'; 

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

            // Close the statement and connection
            $stmt->close();
            $conn->close();

            header("Location: cutoff.php?msg= Successfully Generated the Payslip");
        } //end every_cutoff
        else {
          header("Location: cutoff.php?msg= Successfully Generated the Payslip");
        }

    }
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

              echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
              echo  'Payable:  ' .  $loan_payable . '<br>'; 
              echo 'amortization ' . $loan_amortization . '<br>'; 
              echo 'BalaNCE ' . $loan_BAL . '<br>'; 

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

              // Close the statement and connection
              $stmt->close();
              $conn->close();

              header("Location: cutoff.php?msg= Successfully Generated the Payslip");
          } //end first_cutoff
          else{
            header("Location: cutoff.php?msg= Successfully Generated the Payslip");
      
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

              echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
              echo  'Payable:  ' .  $loan_payable . '<br>'; 
              echo 'amortization ' . $loan_amortization . '<br>'; 
              echo 'BalaNCE ' . $loan_BAL . '<br>'; 

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

              // Close the statement and connection
              $stmt->close();
              $conn->close();

              header("Location: cutoff.php?msg= Successfully Generated the Payslip");
          } //end second_cutoff

          else{
            header("Location: cutoff.php?msg= Successfully Generated the Payslip");
      
          }
        }
      
     
    }

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

            echo  'COL_ID:  ' .  $loan_ID . '<br>'; 
            echo  'Payable:  ' .  $loan_payable . '<br>'; 
            echo 'amortization ' . $loan_amortization . '<br>'; 
            echo 'BalaNCE ' . $loan_BAL . '<br>'; 

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

            // Close the statement and connection
            $stmt->close();
            $conn->close();

            header("Location: cutoff.php?msg= Successfully Generated the Payslip");

    }
    else{
      header("Location: cutoff.php?msg= Successfully Generated the Payslip");

    }

   
}

?>