<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    } else {
        // Check if the user's role is not "admin"
        if($_SESSION['role'] != 'admin'){
            // If the user's role is not "admin", log them out and redirect to the logout page
            session_unset();
            session_destroy();
            header("Location: logout.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Cutoff</title>

    <link rel="stylesheet" href="css/cutOff.css">
    <link rel="stylesheet" href="css/gnrate_payroll.css">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!--  para sa pag pass sa colID sa modal in delete -->


    <!-- para sa font ng net pay -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    </style>
  


</head>
<body>

<header>
    <?php 
        include 'header.php';
    ?>
</header>
<!-- Modal -->
<div class="modal fade" id="modal_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Cutoff</h1>

       

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    <form action="Data Controller/Payroll/Save_cutOff.php" method="post">
        <div class="modal-body">
            
            <!-- <div class="row mt-1">
                    <div class="col-6"  style="border: 1px solid #D1D1D1; padding: 10px;">
                        Company : 
                    </div>
                    <div class="col-6"  style="border: 1px solid #D1D1D1; padding: 10px;">
                        Slastech Solutions INC.
                    </div>
            </div> END row1 -->
            <!---------------- BREAK -------------->

            <div class="row" style=" border: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-6 mt-2">
                        Type : 
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <select id="" required name="name_type" class='form-select form-select-m' aria-label='.form-select-sm example' style='cursor: pointer;'>
                                <option selected value='Standard'>Standard</option>
                                <option value='Off Cycle'>Off Cycle</option>
                            </select>
                        </div> <!-- Second mb-3 end-->
                    </div> <!-- col-6 end-->
            </div> <!--END row2 -->
            <!---------------- BREAK -------------->

            <div class="row" style=" border-bottom: 1px solid #D1D1D1; border-right: 1px solid #D1D1D1; border-left: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-6 mt-2">
                        Frequency : 
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <select id="frequency" required name="name_frequency" class='form-select form-select-m' aria-label='.form-select-sm example' style='cursor: pointer;'>
                                <option selected value='Monthly'>Monthly</option>
                                <option value='Semi-Month'>Semi-Month</option>
                                <option value='Weekly'>Weekly</option>
                            </select>
                        </div> <!-- Second mb-3 end-->
                    </div> <!-- col-6 end-->
            </div> <!--END row3 -->
            <!---------------- BREAK -------------->

            <div class="row" style=" border-bottom: 1px solid #D1D1D1; border-right: 1px solid #D1D1D1; border-left: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-3 mt-3">
                        Month : 
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <select id="" required name="name_Month" class='form-select form-select-m' aria-label='.form-select-sm example' style='cursor: pointer;'>
                                <option disabled selected value=''>Pick a Month</option>
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
                        </div> <!-- Second mb-3 end-->
                    </div> <!-- col-6 end-->

                    <div class="col-3 mt-3">
                        Year : 
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <select id="" required name="name_year" class='form-select form-select-m' aria-label='.form-select-sm example' style='cursor: pointer;'>
                                <option disabled selected value=''>Pick a Year</option>
                                <option value='2023'>2023</option>
                            </select>
                        </div> <!-- Second mb-3 end-->
                    </div> <!-- col-6 end-->
            </div> <!--END row4 -->
            <!---------------- BREAK -------------->

            <div class="row" style=" border-bottom: 1px solid #D1D1D1; border-right: 1px solid #D1D1D1; border-left: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-6 mt-2">
                        Start Date : 
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <input type="date" required name="name_strDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div> <!-- col-6 end-->
            </div> <!--END row5 -->
            <!---------------- BREAK -------------->
            <div class="row" style=" border-bottom: 1px solid #D1D1D1; border-right: 1px solid #D1D1D1; border-left: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-6 mt-2">
                        End Date : 
                    </div>
                    <div class="col-6">
                        <div class="input-group mb-3">
                            <input type="date" required  name="name_endDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div> <!-- col-6 end-->
            </div> <!--END row6 -->
            <!---------------- BREAK -------------->
            <div class="row" style=" border-bottom: 1px solid #D1D1D1; border-right: 1px solid #D1D1D1; border-left: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-6 mt-2">
                        Cut Off Number : 
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <select id="cutoff" required name="name_cutoffNum" class='form-select form-select-m' aria-label='.form-select-sm example' style='cursor: pointer;'>
                                <option selected value='1'>1</option>
                            </select>
                        </div> <!-- Second mb-3 end-->
                    </div> <!-- col-6 end-->
            </div> <!--END row3 -->
            <!---------------- BREAK -------------->

            <div class="row" style=" border-bottom: 1px solid #D1D1D1; border-right: 1px solid #D1D1D1; border-left: 1px solid #D1D1D1; padding-top: 10px;">
                    <div class="col-6 mt-2">
                        Employees : 
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            
                            <?php
                            include 'config.php';

                            //   // Fetch all values of fname and lname from the database
                              $sql = "SELECT `fname`, `lname`, `empid` FROM employee_tb";
                              $result = mysqli_query($conn, $sql);
                                echo '<div class="dropdown form-select form-select-m">';
                                    echo '<input disabled class="slction_emp" type="text" id="items_EMP" placeholder="All Employees">';
                                    echo '<button type="button" class="dropdown-btn">&#x25BC;<i class="fa fa-caret-down"></i></button>';
                                echo '<div class="dropdown-content">';
                                echo '<label><input class="emp_lblchckbox" type="checkbox" name="All Employee" value="All Employee">All Employee</label>';
                             // Generate the list of checkboxes
                             while ($row = mysqli_fetch_array($result)) {
                                $emp_id = $row['empid'];
                                $name = $row['fname'] . ' ' . $row['lname'];
                                echo '<label><input class="emp_lblchckbox" type="checkbox" name="name_empId" value="' . $emp_id .'"> ' . $name . ' </label>';
                                }            
                                echo '</div>';
                                echo '</div>';
                            ?>
                        </div>  <!--mb-3 end--->
                    </div> <!-- col-6 end-->
            </div> <!--END row3 -->
            <!---------------- BREAK -------------->

        </div> <!--END Modal-Body -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div> <!--END Modal-Content -->
  </div><!--END Modal-Dialog -->
</div> <!--END Modal -->


<div class="container mt-5">
    <div class="card">
        <div class="card-body">

        <h3 class="mt-2">Cutoff List</h3>
        <button class="btn_Create mt-3" data-bs-toggle="modal" data-bs-target="#modal_create" style="margin-left: 15px;">
            Create New
        </button>
            <!-- ------------------para sa message na sucessful START -------------------->
            <?php

            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }


            ?>
            <!-------------------- para sa message na sucessful ENd --------------------->


            <!----------------------para sa message na error START --------------------->
            <?php
                if (isset($_GET['error'])) {
                $error = $_GET['error'];
                echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                '.$error.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }

            ?>
            <!-------------------- para sa message na error ENd --------------------->

        <ul class="nav nav-tabs mt-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" data-bs-toggle="tab" href="#Standard">Standard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Allowance">----</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#Loan">----</a>
                    </li>
                </ul>

                <div class="tab-content">
                <form action="gnrate_payroll.php" method="post">
    <div class="tab-pane" id="Standard">
        <div class="scroll" style="max-height:500px; overflow: scroll;">
            <?php 
                include 'config.php';
                // Fetch data from the MySQL table
                $sql = "SELECT * FROM cutoff_tb WHERE col_type ='Standard'";
                $result = mysqli_query($conn, $sql);
                // Display data in div elements
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="stndrd_div">';
                            echo '<div class="head">';
                                echo '<h3 class="ml-3 mt-4">'. $row["col_month"] .'</h3>';
                                echo '<h3 class="ml-3 mt-4">'. $row["col_year"] .'</h3>';
                                echo '<p class="tag">Preview</p>';
                            echo '</div>';
                            echo '<p class="type ml-3 mt-3">'. $row["col_type"] .'</p>';
                            echo '<div class="div">';
                                echo '<div class="head">';
                                    echo '<p class="c1 ml-3 mt-4">Cutoff No. :</p>';
                                    echo '<p class="c1 ml-2 mt-4">'. $row["col_cutOffNum"] .'</p>';
                                echo '</div>';
                                echo '<div class="head">';
                                    echo '<p class="c1 ml-3">Period :</p>';
                                    echo '<p class="c1 ml-2">'. $row["col_startDate"] . ' to '.'</p>';
                                    echo '<p class="c1 ml-2">'. $row["col_endDate"] .'</p>';
                                echo '</div>';
                                echo '<div class="head">';
                                    echo '<p class="c1 ml-3">Frequency :</p>';
                                    echo '<p class="c1 ml-2">'. $row["col_frequency"] .'</p>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="foot">';
                                echo '<button type="submit" name="name_btnview" value="'. $row["col_ID"] .'" class="btnq">[ View ]</button>';
                                echo '<button type="button" class="btnq btn-delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="' . $row["col_ID"] . '">[ Delete ]</button>';
                                echo '<button type="button" class="btnq btn-addEmp" data-bs-toggle="modal" data-bs-target="#modal_addEMp" data-id1="' . $row["col_ID"] . '">[ Add Employee ]</button>';
                            echo '</div>';
                        echo '</div>';
                    }
                } else {
                    // No data found
                }
                // Close connection
                mysqli_close($conn);  
            ?>
        </div>
    </div>
</form>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="actions/Payroll/delete.php" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="name_CutoffID" id="modal-input">
                Are you sure you want to delete this cutoff?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="btn_delete_modal"  class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </form>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_addEMp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="actions/Payroll/addEmp.php" method="post">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="name_AddEMp_CutoffID" id="ID_AddEMp_CutoffID">
        
            <div class="mb-3">
                <label for="Select_dept" class="form-label">Select Employee :</label>
                <?php
                    include 'config.php';

                    // Fetch all values of fname and lname from the database
                    $sql = "SELECT fname, lname, empid FROM employee_tb";
                    $result = mysqli_query($conn, $sql);

                    // Generate the dropdown list
                    echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='add_name_emp' style=' height: 50px; width: 400px; cursor: pointer;'>";
                    while ($row = mysqli_fetch_array($result)) {
                            $emp_id = $row['empid'];
                            $name = $row['empid'] . ' - ' . $row['fname'] . ' ' . $row['lname'];
                            echo "<option value='$emp_id'>$name</option>";
                                            }
                          echo "</select>";
                ?>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="btn_addEmp_modal" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

                    <div class="tab-pane" id= "Allowance">
                        Allowance
                    </div>
                    <div class="tab-pane" id= "Loan">
                            Loan
                    </div>

                    

                    
                </div>
                
        </div>  <!-- End Card-Body -->
    </div> <!-- End Card -->
 </div> <!-- End Container -->


    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>



    <!-- para sa datatable -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="bootstrap js/template.js"></script>
    <script src="bootstrap js/data-table.js"></script>  <!-- < Custom js for this page  -->
</body>
<script src="js/cutoff.js"></script>
</html>