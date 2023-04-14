<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Payroll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Para sa datatables -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
        <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- Para sa datatables END -->

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/gnrate_payroll.css">
</head>
<body>
  
<header>
    <?php 
        include 'header.php';
    ?>
</header>

<!---------------------------------------- MAIN CONTAINER START ------------------------------------------->
            <div class="container mt-5" >
                    <div class="card">
                        <div class="card-body">
                            <h2 class="head_text">Generate Payroll</h2>

                            <div class="row">
                    
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="Select_dept" class="form-label">Select Employee :</label>
                                        <?php
                                            include 'config.php';

                                            // Fetch all values of fname and lname from the database
                                            $sql = "SELECT fname, lname, empid FROM employee_tb";
                                            $result = mysqli_query($conn, $sql);

                                            // Generate the dropdown list
                                            echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='name_emp' style=' height: 50px; width: 400px; cursor: pointer;'>";
                                            while ($row = mysqli_fetch_array($result)) {
                                                $emp_id = $row['empid'];
                                                $name = $row['empid'] . ' - ' . $row['fname'] . ' ' . $row['lname'];
                                                echo "<option value='$emp_id'>$name</option>";
                                            }
                                            echo "</select>";
                                        ?>
                                    </div>
                                </div>  <!--END COL-4--> 

                                                    <!----------------------BREAK--------------------------> 
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="Select_dept" class="form-label">Select Month :</label>
                                                <select class='form-select form-select-m' aria-label='.form-select-sm example' style=' height: 50px; width: 400px; cursor: pointer;'>
                                                    <option value='January'>January</option>
                                                    <option value='Febuary'>Febuary</option>
                                                    <option value='March'>March</option>
                                                    <option value='April'>April</option>
                                                    <option value='May'>May</option>
                                                    <option value='June'>June</option>
                                                    <option value='July'>July</option>
                                                    <option value='August'>August</option>
                                                    <option value='September'>September</option>
                                                    <option value='October'>October</option>
                                                    <option value='November'>November</option>
                                                    <option value='December'>December</option>
                                                </select>
                                    </div> <!-- First mb-3 end-->

                                </div><!--END COL-4--> 
                                                    <!----------------------BREAK--------------------------> 

                                <div class="col-4 mt-4">
                                    <button type="button" class="btn btn-primary" style="--bs-btn-padding-y: 5px; --bs-btn-padding-x: 20px; --bs-btn-font-size: .75rem;">
                                        GO
                                    </button>
                                </div>  <!--END COL_4--> 
                                                    
                            </div> <!--ROW END--> 
                                             <!--------------------------------------BREAK-------------------------------------------> 

                             <div class="mb-3"> <!-- PARA SA DROPDOWN DEPARTMENT -->
                                        <label for="Select_dept" class="form-label">Select Department :</label>
                                        <?php
                                            include 'config.php';

                                            // Fetch all values of col_deptname from the database
                                            $sql = "SELECT col_deptname FROM dept_tb";
                                            $result = mysqli_query($conn, $sql);

                                            // Store all values in an array
                                            $dept_options = array();
                                            while($row = mysqli_fetch_array($result)){
                                                $dept_options[] = $row['col_deptname'];
                                            }

                                            // Generate the dropdown list
                                            echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' style=' height: 50px; width: 400px; cursor: pointer;'>";
                                            foreach ($dept_options as $dept_option){
                                                echo "<option value='$dept_option'>$dept_option</option>";
                                            }
                                            echo "</select>";
                                        ?>
                                    </div> <!-- PARA SA DROPDOWN DEPARTMENT END-->

                                            <!--------------------------------------BREAK-------------------------------------------> 


                                           
                                    <div class=" p-3 mb-2 " style= "background-color: #F2F2F2;">  <!-- PARA SA RANGE MONTHS LABEL -->
                                    <div class="input-group flex-nowrap">
                                    <h3 style= "font-size: 20px; font-weight: bold; font-family: 'Nunito', sans-serif; ">Payslip Information For </h3>
                                        <h3 style= "color: #747BDA; font-size: 20px; font-weight: bold; font-family: 'Nunito', sans-serif; margin-left: 15px;  margin-right: 15px;"> Month </h3>        
                                        <h3 style= "font-size: 20px; font-weight: bold; font-family: 'Nunito', sans-serif; "> 2023</h3>      
                                    </div>
                                                                     
                                    </div> <!-- PARA SA RANGE MONTHS LABEL END-->





                                    <div class="table-responsive" style = "overflow-y: scroll;  max-height: 500px;">
                                        <form action="gnrate_payroll_view.php" method="post">
                                        <input id="employeeID" name="Name_employeeID" type="text">         
                                            <table id="order-listing" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Employee ID</th>
                                                        <th>Employee Name</th>
                                                        <th>Net Salary</th> 
                                                        <th>Allowances</th>
                                                        <th>Deductions</th>
                                                        <th>Action</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php 
                                        include 'config.php';
                                        //select data db

                                      

                                        $sql = "SELECT
                                                    employee_tb.`empid`,
                                                    CONCAT(
                                                        employee_tb.`fname`,
                                                        ' ',
                                                        employee_tb.`lname`
                                                    ) AS `full_name`,
                                                    SUM(employee_tb.`drate`) AS NetPay,
                                                    employee_tb.`emptranspo` + employee_tb.`empmeal` + employee_tb.`empmeal` + employee_tb.`allowance_amount` AS Total_allowance,
                                                    employee_tb.`sss_amount` + employee_tb.`tin_amount` + employee_tb.`pagibig_amount` + employee_tb.`philhealth_amount` + employee_tb.`govern_amount` AS Total_deduct,
                                                    attendances.late
                                                FROM
                                                    employee_tb
                                                INNER JOIN attendances ON employee_tb.empid = attendances.empid
                                                WHERE attendances.status = 'Present'
                                                GROUP BY
                                                    employee_tb.`empid`,
                                                    `full_name`;
                                            ";
                                    $result = $conn->query($sql);



                                        

                                        //read data
                                        while($row = $result->fetch_assoc()){
                                            echo "<tr>
                                                <td>" . $row['empid'] . "</td>
                                                <td>" . $row['full_name'] . "</td>
                                                <td>" . $row['NetPay'] . "</td>
                                                <td class= 'text-center'>" . $row['Total_allowance'] . "</td>
                                                <td class= 'text-center'>" . $row['Total_deduct'] . "</td>
                                                <td>
                                                <button type='submit' name='name_btnView' class='border-light viewbtn' title='View'>
                                                    <img src='icons/visible.png' alt='...'>
                                                </button>
                                            </td>
                                            
                                            </tr>"; 
                                        }
                                    ?>  
                             
                                                </tbody>
                                            </table>
                                        </form>
                                    </div> <!--table-responsive END-->
                           
                            

                        </div> <!--  END CARD BODY -->
                    </div> <!--  END CARD -->
            </div> <!--  END MAIN PANEL -->


<script> //FOR VIEW GET EMP ID PUT INTO MODAL PAYROLL
            $(document).ready(function(){
                                    $('.viewbtn').on('click', function(){
                                        $('#view_payslip').modal('show');
                                        $tr = $(this).closest('tr');

                                        var data = $tr.children("td").map(function () {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);
                                        //id_colId
                                        $('#employeeID').val(data[0]);
                                    });
                                });
            //FOR VIEW GET EMP ID PUT INTO MODAL PAYROLL END
</script>







<!---------------------------------------- MAIN CONTAINER END ------------------------------------------->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>



<!-- para sa datatable -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<script src="bootstrap js/data-table.js"></script>  <!-- < Custom js for this page  -->
<!-- para sa datatable  END-->
    
</body>
</html>