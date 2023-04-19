<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/leaveInfo.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
<!--sidebar
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css"> 
-->
</head>
<body>

<!--MODAL BOOTSTRAP-->
<header>
    <?php
    include 'header.php';
    ?>
</header>

<style>
    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 289px;
        margin-left:-32px;
       
    }

    .sidebars ul{
        height:100%;
    }

    .sidebars .first-ul{
        line-height:50px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }
</style>



<!-- Modal -->
<div class="modal fade" id="add_leaveMDL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 " id="exampleModalLabel" >Add Leave Credits</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="actions/Leave Information/insertcode.php" method="POST">
        <div class="modal-body">
        
            <div class="mb-3">
                <label for="Select_dept" class="form-label">Select Department</label>
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
                                echo "<select class='form-select form-select-m' aria-label='.form-select-sm example'>";
                                foreach ($dept_options as $dept_option){
                                    echo "<option value='$dept_option'>$dept_option</option>";
                                        }
                                echo "</select>";
                            ?>
            </div>
            <!--              line break                     -->
            <div class="mb-3">
                <label for="Select_emp" class="form-label">Select Employee</label>
                <?php
                    include 'config.php';

                    // Fetch all values of fname and lname from the database
                    $sql = "SELECT fname, lname, empid FROM employee_tb";
                    $result = mysqli_query($conn, $sql);

                    // Generate the dropdown list
                    echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='name_emp'>";
                    while ($row = mysqli_fetch_array($result)) {
                        $emp_id = $row['empid'];
                        $name = $row['empid'] . ' - ' . $row['fname'] . ' ' . $row['lname'];
                        echo "<option value='$emp_id'>$name</option>";
                    }
                    echo "</select>";
                ?>
            </div>
            <!--              line break                     -->
            <div class="mb-3">
                <label for="vctn_lve" class="form-label">Vacation Leave</label>
                    <div class="input-group mb-3">
                        <input type="number"  step="0.0" name="name_vctn_lve" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                        <span class="input-group-text">.0</span>
                    </div>
            </div>
            <!--              line break                     -->
            <div class="mb-3">
                <label for="sick_lve" class="form-label">Sick Leave</label>
                    <div class="input-group mb-3">
                        <input type="number" name="name_sick_lve" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                        <span class="input-group-text">.0</span>
                    </div>
            </div>
            <!--              line break                     -->
            <div class="mb-3">
                <label for="brvmnt_lve" class="form-label">Bereavement Leave</label>
                    <div class="input-group mb-3">
                        <input type="number" name="name_brvmnt_lve" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                        <span class="input-group-text">.0</span>
                    </div>
            </div>
            <!--              line break                     --> 
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="save_changes" class="btn btn-success">Add Credits</button>
      </div>
      </form>
    </div>
    
  </div>
</div> <!--MODAL BOOTSTRAP END-->




<!-- style="position: absolute; top: 150px; left: 350px;"-->
<div class="container mt-5 " style="position:absolute; bottom: 50px; right: 460px;">
    <div class="">  <!--MODAL BOOTSTRAP END-->
   
        <div class="card border-light" style="box-shadow: 10px 10px 10px 8px #888888; width: 1530px; height: 760px;"> <!--CARD2-->
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h2 class="display-5">Leave Records</h2>
                    </div>
                    <div class="col-6 mt-1 text-end">
                        <!-- Button trigger modal -->
                        <button class="btn_addLeave" data-bs-toggle="modal" data-bs-target="#add_leaveMDL">
                            Add Leave
                        </button>
                    </div>
                </div> <!--ROW END--> 
            </div>
            
                <div class="card-body">
                    <div class="row">
                    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Select_dept" class="form-label">Select Department</label>
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
                                            echo "<select class='form-select form-select-m' aria-label='.form-select-sm example'>";
                                            foreach ($dept_options as $dept_option){
                                                echo "<option value='$dept_option'>$dept_option</option>";
                                            }
                                            echo "</select>";
                                        ?>
                            </div>
                        </div>  <!--END COL_4--> 

                        <div class="col-6 mt-4">
                            <button type="button" class="btn btn-primary" style="--bs-btn-padding-y: 5px; --bs-btn-padding-x: 20px; --bs-btn-font-size: .75rem;">
                                GO
                            </button>
                        </div>  <!--END COL_4--> 
                    </div> <!--ROW END--> 
                    <div class="pnl_utop p-3 mb-2 bg-body-tertiary">
                        <h3 style= "font-size: 20px; font-weight: bold; font-family: 'Nunito', sans-serif; ">Leave Credits</h3>
                    </div>

                    <div class="row mt-3"> <!--ROW2 start--> 
                        <div class="col-6">
                            <div class="pnl_top">
                                <select class="slction_top">
                                    <option value="" disabled selected>10 Items Listed</option>
                                    <option value="1">Item Listed 1</option>
                                    <option value="2">Item Listed 2</option>
                                    <option value="3">Item Listed 3</option>
                                    <option value="4">Item Listed 4</option>
                                    <option value="5">Item Listed 5</option>
                                    <option value="6">Item Listed 6</option>
                                    <option value="7">Item Listed 7</option>
                                    <option value="8">Item Listed 8</option>
                                    <option value="9">Item Listed 9</option>
                                    <option value="10">Item Listed 10</option>
                                </select>
                            </div>

                            <style>
                                    :root {
                                        --background-gradient: linear-gradient(30deg, #f39c12 30%, #f1c40f);
                                        --gray: #EFB300;
                                        --white: #ffffff;
                                    }

                                    .slction_top {
                                        /* Reset Select */
                                        appearance: none;
                                        outline: 0;
                                        border: 0;
                                        box-shadow: none;
                                        /* Personalize */
                                        flex: 1;
                                        color: #000000;
                                        background-color: var(--white);
                                        background-image: none;
                                        cursor: pointer;
                                        font-size: 16px;
                                    }

                                    /* Remove IE arrow */
                                    .slction_top::-ms-expand {
                                        display: none;
                                    }

                                    /* Custom Select wrapper */
                                    .pnl_top {
                                        position: relative;
                                        display: flex;
                                        margin-left: 90px;
                                        width: 190px;
                                        height: 30px;
                                        overflow: hidden;
                                        font-size: xx-small;
                                        border-radius: 2px;
                                        background-color: #FFFFFF;
                                    }

                                    /* Arrow */
                                    .pnl_top::after {
                                        content: '\25BC';
                                        position: absolute;
                                        top: 0;
                                        right: 0;
                                        border-radius: 2px;
                                        padding: 9px;
                                        margin-top: 3px;
                                        background-color: #FFC921;
                                        transition: .25s all ease;
                                        pointer-events: none;
                                    }

                                    /* Transition */
                                    .pnl_top:hover::after {
                                        color: #ffffff;
                                    }
                                    th{
                                        color: #787BDB;
                                        font-size: 19px;
                                    }
                            </style>
                        </div><!--COL-6 END-->        
                        <div class="col-6 text-end">
                            <div class="pnl_search" >
                                <form action="" 
                                    style= "
                                        border: none;
                                        padding: 0;
                                        background-color: #ffffff;
                                            ">
                                    <input id="search_bar" type="text" placeholder="Search"
                                    style= "
                                            margin-right: 50px;
                                            width: 260px;
                                            border: 1px solid #adacac;
                                            border-radius: 5px;
                                            padding: 9px 4px 9px 40px;
                                            background: #FFFFFF url(icons/search.png) 
                                            no-repeat 13px center;
                                            ">
                                </form>
                            </div> 
                        </div><!--COL-6 END-->        
                    </div><!--ROW2 END--> 

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




  <!-- ------------------para sa message na error START -------------------->
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
                <div class="table my-3">
                  <table id="data_table" class="table table-sortable table-striped table-hover caption-top" style="width: 1500px;">
                    <caption>List of Employee Leave Credits</caption>
                        <thead>
                            <tr> <!--<img src="/icons/search.png" alt="Icon">-->
                                <th style= 'display: none;' id="header">ID</th>
                                <th id="header"> Employee ID  </th>
                                <th>Employee Name</th>
                                <th>Employee Department</th>
                                <th class= 'text-center'>Vacation Leave</th>
                                <th class= 'text-center'>Sick Leave</th>
                                <th class= 'text-center'>Bereavement Leave</th>
                                <th>Action</th>                            
                            </tr>
                        </thead>
                            <tbody>
                                <?php 
                                        include 'config.php';
                                        //select data db

                                        $sql = "SELECT
                                                    leaveinfo_tb.`col_ID`,
                                                    employee_tb.`empid`,
                                                    CONCAT(employee_tb.`fname`, ' ', employee_tb.`lname`) AS `full_name`,
                                                    employee_tb.department_name,
                                                    leaveinfo_tb.`col_vctionCrdt`,
                                                    leaveinfo_tb.`col_sickCrdt`,
                                                    leaveinfo_tb.`col_brvmntCrdt`
                                                FROM
                                                    employee_tb
                                                INNER JOIN leaveinfo_tb ON employee_tb.empid = leaveinfo_tb.`col_empID`;
                                                ";
                                        $result = $conn->query($sql);

                                        //read data
                                        while($row = $result->fetch_assoc()){

                                            $_SESSION["id"] =  $row['col_ID'];
                                            echo "<tr>
                                                <td style= 'display: none;'>" . $row['col_ID']. "</td>
                                                <td>" . $row['empid'] . "</td>
                                                <td>" . $row['full_name'] . "</td>
                                                <td>" . $row['department_name'] . "</td>
                                                <td class= 'text-center'>" . $row['col_vctionCrdt'] . "</td>
                                                <td class= 'text-center'>" . $row['col_sickCrdt'] . "</td>
                                                <td class= 'text-center'>" . $row['col_brvmntCrdt'] . "</td>
                                                <td>
                                                <button type='button' class= 'border-light editbtn' title = 'Edit' data-bs-toggle='modal' data-bs-target='#id_editmodal'>
                                                        <img src='icons/editing.png' alt='...'>
                                                </button>
                                                <button type='button' class= 'border-light' title = 'Delete'>
                                                    <a href='actions/Leave Information/delete.php?col_ID=" . $row['col_ID'] . "' class='link-dark'> <img src='icons/delete.png' alt='...'> </a>
                                                </button>
                                                    
                                                </td>
                                            </tr>"; 
                                        }
                                    ?>  
                            </tbody>   
                    </table>
                    
                            
                </div> <!--table my-3 end-->   
                
                    <!-- Modal EDIT -->
                    <div class="modal fade" id="id_editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <form action="actions/Leave Information/update.php" method="POST">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Leave Credits</h1>
                                        <input type="text" id="id_colId" name="name_id" style= "display: none;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body"> 
                                        
                                        <div class="mb-2">
                                            <label for="name_employee_fname" class="form-label">Employee Name :</label>
                                                <div class="input-group">
                                                    <input type="text" id= "id_fname" name="name_employee_fname" class="form-control bg-light" aria-label="Amount (to the nearest dollar)" disabled>
                                                </div>
                                        </div>
                                        <!--              line break                     --> 
                                        <div class="mb-2">
                                            <label for="name_employee_Dept" class="form-label">Employee Department :</label>
                                                <div class="input-group ">
                                                    <input type="text" id="id_dept" name="name_employee_Dept" class="form-control bg-light" aria-label="Amount (to the nearest dollar)" disabled>
                                                </div>
                                        </div>
                                        <!--              line break                     --> 
                                        <div class="mb-2">
                                            <label for="name_employee_Dept" class="form-label">Vacation Leave :</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name= "name_set_Vcrdt" id="id_v_crdt" class="form-control bg-light" aria-label="" readonly>
                                                <input type="float" name= "name_updt_Vcrdt" id="id_Tv_crdt" class="form-control" placeholder="00.0" required aria-label="" >
                                            </div>
                                        </div>
                                        <!--              line break                     --> 
                                        <div class="mb-2">
                                            <label for="name_employee_Dept" class="form-label">Sick Leave :</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name= "name_set_Scrdt" id="id_s_crdt" class="form-control bg-light" aria-label="" readonly>
                                                <input type="float" name= "name_updt_Scrdt" id="id_Ts_crdt" class="form-control" placeholder="00.0" required aria-label="">
                                            </div>
                                        </div>
                                        <!--              line break                     --> 
                                        <div class="mb-2">
                                            <label for="name_employee_Dept" class="form-label">Bereavement Leave :</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name= "name_set_Bcrdt" id="id_B_crdt" class="form-control bg-light" aria-label="" readonly>
                                                <input type="float" name= "name_updt_Bcrdt" id="id_TB_crdt" class="form-control" placeholder="00.0" required aria-label="">
                                            </div>
                                        </div>
                                        <!--              line break                     --> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" id= "id_btnUpdate" name="updatedata" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                    </div>
        </div><!--end Card2-->
    </div><!--end jumbotron-->
</div> <!--end Container-->





<script>
     $(document).ready(function(){
                            $('.editbtn').on('click', function(){
                                $('#id_editmodal').modal('show');
                                $tr = $(this).closest('tr');

                                var data = $tr.children("td").map(function () {
                                    return $(this).text();
                                }).get();

                                console.log(data);
                                //id_colId
                                $('#id_colId').val(data[0]);
                                $('#id_fname').val(data[2]);
                                $('#id_dept').val(data[3]);
                                $('#id_v_crdt').val(data[4]);
                                $('#id_s_crdt').val(data[5]);
                                $('#id_B_crdt').val(data[6]);
                            });
                        });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="js/leaveInfo.js"></script>
</body>
</html>