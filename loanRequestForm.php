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

    <form action="Data Controller/Loan Request/loanRequestFormController.php" method="POST">
    <div class="loan-req-form-container">
        <div class="payroll-loan-title">
            <h1>Payroll Loan Details</h1>
        </div>
        <div class="row" style="width:92%; margin: auto; margin-top:20px;">
            <div class="col-6" style="padding: 0 30px 0 30px;">  
                <div class="form-group">
                    <?php
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";

                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT * FROM employee_tb ORDER BY empid ASC";
                        $result = mysqli_query($conn, $sql);
                            
                        $options = "";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $options .= "<option value='".$row['empid']."'>".$row['empid']." - ".$row['fname']." ".$row['lname']."</option>";
                            }
                    ?>

                    <label for="employee">Employee</label><br>
                    <select name="empid" id="" class="form-control" style="height:50px;" required>
                        <option value disabled selected>Employee</option>
                        <?php echo $options; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="loan_type">Loan Type</label><br>
                    <select name="loan_type" class="form-control" style="height:50px;" required>
                        <option value="" selected="selected" class="selectTag" style="color: gray;" >Select Loan Type</option>
                        <option value="Company Emergency Loan">Company Emergency Loan</option>
                        <option value="Pag-ibig Emergency Loan">Pag-ibig Emergency Loan</option>
                        <option value="Company Loan Car"> Company Loan Car</option>
                        <option value="SSS Salary Loan">SSS Salary Loan</option>
                        <option value="GSIS Emergency Loan">GSIS Emergency Loan</option>
                        <option value="Company Motorcycle Loan">Company Motorcycle Loan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year</label><br>
                    <select name="year" class="form-control" style="height:50px;" required>
                        <option value="" disabled selected>Year</option>
                        <?php
                            $currentYear = date("Y");
                            for ($year = 1990; $year <= $currentYear; $year++) {
                                echo "<option value=\"$year\">$year</option>";
                            }
                            ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="month">Month</label>
                        <select name="month" id="" class="form-control" style="height:50px;" required>
                            <option value="" disabled selected>Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                </div>
                <div class="form-group cutoff-no" style="display:flex; flex-direction: row; height: 100px;">
                <div>
                    <label for="">Cutoff No.</label><br>
                    <select name="cutoff_no" id="cutoff_no" class="form-control" style="width: 378px; height:50px;" onchange="calculate()" required>
                        <option value="" selected disabled>0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="4">4</option>
                    </select>
                </div> 
                    <div style="display:flex; align-items:center; height: 60px; margin-top: 27px;">  
                        <button type="button" style="width: 240px; height:50px; margin-left: 10px; outline:none; border: none; border-radius: 5px; background-color: #e6e2e2; color: rgb(128, 55, 224); font-weight: 400; font-size: 20px; letter-spacing: 2px; " id="loanFormBtn">Forecast Payment</button>
                    </div>
                </div>
                <div class="form-group loan-remarks">
                    <label for="remarks">Remarks</label><br>
                    <textarea name="remarks" id="" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-6" style="padding: 0 30px 0 30px;">
                <div class="form-group">
                    <label for="loan_date">Loan Date</label><br>
                    <input type="date" name="loan_date" class="form-control" style="height:50px;" id="" required>
                </div>
                <div class="form-group">
                    <label for="payable_amount">Payable Amount</label><br>
                    <input type="number" name="payable_amount" class="form-control" style="height:50px;" id="payable_amount" oninput="calculate()" required> 
                </div>

                <div class="form-group">
                    <label for="amortization">Amortization</label><br>
                    <input type="text" name="amortization" class="form-control" id="amortization" style="height:50px" readonly>

                    <!-- hidden type  -->
                    <input type="hidden" name="loan_status" value="PENDING">
                    
                </div>
                <div class="form-group">
                    <label for="applied_cutoff">Applied Cutoff</label><br>
                    <select name="applied_cutoff" class="form-control" style="height:50px;" id="">
                        <option value="" selected disabled>Cutoff</option>
                        <option value="Every Cutoff">Every Cutoff</option>
                        <option value="First Cutoff">First Cutoff</option>
                        <option value="Last Cutoff">Last Cutoff</option>
                    </select>
                </div>
                <div class="form-group loan-req-btn">
                    <button><a href="loanRequest.php" style="text-decoration: none; color:black;">Cancel</a></button>
                    <button style="color: blue;">Save</button>
                </div>
            </div>   
        </div>
        </form>
        <div style="border: #ccc 1px solid; width: 95%; margin: auto; margin-top: 50px; margin-bottom: 50px;"></div>
        <div class="amortization-container">
            <div class="amortization-title">
                <h1>Amortization History</h1>
            </div>
            <div class="amortization-table">
                <table class="table-hover table table-borderless" style="width:95%; margin:auto; margin-top: 20px; border:none; ">
                    <thead style="background-color: #f4f4f4;">
                        <th>Year</th>
                        <th>Month</th>
                        <th>Cutoff No.</th>
                        <th>Amount</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: 400">2023</td>
                            <td style="font-weight: 400">April</td>
                            <td style="font-weight: 400">2</td>
                            <td style="font-weight: 400">200</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="loan-forecast-container" id="loanFormModal">
    <div class="loan-forecast-content">
        <div class="loan-forecast-title">
            <h1>Loan Forecast</h1>
            <div></div>
        </div>
        <div class="loan-forecast-balance">
            <p>Balance: 0</p>
        </div>
        <div class="loan-forecast-table">
            <table class="table table-hover table-bordered" style="margin-bottom: 50px;">
                <thead>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Cutoff No.</th>
                    <th>Amount</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "" , "hris_db");
                        $sql = "SELECT * FROM payroll_loan_tb AS payloan
                                INNER JOIN employee_tb AS emp
                                ON(payloan.empid = emp.empid)";
                        $results = $conn->query($sql);

                        if($results->num_rows > 0){
                            while($rows = $results->fetch_assoc()){
                                echo "<tr>
                                        <td style='font-weight:400'>".$rows['year']."</td>
                                        <td style='font-weight:400'>".$rows['month']."</td>
                                        <td style='font-weight:400'>".$rows['cutoff_no']."</td>
                                        <td style='font-weight:400'>".$rows['payable_amount']."</td>
                                        <td style='font-weight:400' >".$rows['loan_status']."</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No loan payments found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="loan-forecast-bar"></div>
        <div class="loan-forecast-btn">
            <button id="loanFormClose" class="loanFormClose">Cancel</button>
        </div>
    </div>
</div>


        <script>
    function calculate() {
        // Get values from the input and dropdown
        const payableAmount = document.getElementById("payable_amount").value;
        const cutoffNo = document.getElementById("cutoff_no").value;

        // Check if payableAmount is empty or 0
        if (!payableAmount || payableAmount == 0) {
            // Set amortization to 0 or empty
            document.getElementById("amortization").value = "";
            return;
        }

        // Calculate the amortization amount
        let amortization = 0;
        if (cutoffNo != 0) {
            amortization = (payableAmount / cutoffNo).toFixed(2).replace(/\.00$/, '');
        }

        // Display the result
        document.getElementById("amortization").value = `${amortization}`;
    }
</script>

<script>
// sched form modal

let Modal = document.getElementById('loanFormModal');

//get open modal
let modalBtn = document.getElementById('loanFormBtn');

//get close button modal
let closeModal = document.getElementsByClassName('loanFormClose')[0];

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
