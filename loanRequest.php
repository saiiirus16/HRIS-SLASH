<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <div class="gen-payslip">
        <div class="loanreq-container">
            <div class="loanreq-title">
                <h1>Payroll Loans Request</h1>
                <div></div>
            </div>
            <div class="loanreq-input">
                <button><a style="color:white; text-decoration:none; outline:none;" href="loanRequestForm.php">Create New</a></button>
                <input class="employeeList-search" type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome" id="search"/>
            </div>

            <table class="table-hover table table-borderless" style="width:95%; margin:auto; margin-top: 20px; border:none; ">
                <thead style="background-color: #f4f4f4;">
                    <th>Name</th>
                    <th style="" >Loan Type</th>
                    <th>Loan Date</th>
                    <th>Date Files</th>
                    <th>Payable Amount</th>
                    <th>Amortization</th>
                    <th>Balance</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                       $db = mysqli_connect("localhost", "root", "" , "hris_db");
                       $result = $db->query("SELECT payroll_loan_tb.loan_type,
                                        payroll_loan_tb.year,
                                        payroll_loan_tb.month,
                                        payroll_loan_tb.cutoff_no,
                                        payroll_loan_tb.remarks,
                                        payroll_loan_tb.loan_date,
                                        payroll_loan_tb.payable_amount,
                                        payroll_loan_tb.amortization,
                                        payroll_loan_tb.applied_cutoff,
                                        payroll_loan_tb.timestamp,
                                        CONCAT(
                                             employee_tb.`fname`,
                                             ' ',
                                             employee_tb.`lname`   
                                            ) AS `full_name` 
                                FROM payroll_loan_tb
                                INNER JOIN employee_tb ON employee_tb.empid = payroll_loan_tb.empid
                                ORDER BY loan_date ASC");
                        
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){                       
                    ?>
                    <tr>  
                        <td style="font-weight: 400"><?php echo $row['full_name']?></td> 
                        <td style="font-weight: 400"><?php echo $row['loan_type']?></td>
                        <td style="font-weight: 400"><?php echo $row['loan_date']?></td>
                        <td style="font-weight: 400"><?php echo $row['timestamp']?></td>
                        <td style="font-weight: 400"><?php echo $row['payable_amount']?></td>
                        <td style="font-weight: 400"><?php echo $row['amortization']?></td>
                        <td style="font-weight: 400"><?php echo $row['payable_amount']?></td>
                        <td style="font-weight: 400; outline:none;"><button style="border: none; background-color:inherit; outline:none;"><a href="" style="text-decoration:none;">Edit</a></button></td>
                    </tr>
                    <?php 
                            }
                        } else{
                            ?>
                          <tr>
                            <td style="font-weight: 400">No Loan Requests found...</td>
                          </tr>
                          <?php  
                        }     
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <tr>

    
<script type="text/javascript">
        $(document).ready(function(){
            $('#search').keyup(function(){
                search_table($(this).val());
            });

            function search_table(value){
                $('#myTable tr').each(function(){
                    var found = 'false';
                    $(this).each(function(){
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase())>= 0){
                            found = 'true';
                        }
                    });
                    if(found == 'true'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
        });

</script> 

<script>
// sched form modal

let Modal = document.getElementById('schedules-modal-update');

//get open modal
let modalBtn = document.getElementById('sched-update');

//get close button modal
let closeModal = document.getElementsByClassName('sched-update-close')[0];

//event listener
modalBtn.addEventListener('click', openModal);
closeModal.addEventListener('click', exitModal);
window.addEventListener('click', clickOutside);

//functions
function openModal(){
    Modal.style.display ='block';
}

function exitModal(){
    Modal.style.display ='none';
}

function clickOutside(e){
    if(e.target == Modal){
        Modal.style.display ='none';    
    }
}
</script>


    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
