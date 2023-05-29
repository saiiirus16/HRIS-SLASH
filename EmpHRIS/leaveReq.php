<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/leavereq.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>

    <title>Leave Request</title>
</head>
<body>

<header>
    <?php include 'header.php';
    ?>
</header>

<style>
    body{
        list-style:none;
        text-decoration:none;
    }

    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 289px;
        margin-left:-32px;
        color:black;
       
    }

    .sidebars ul{
        height:100%;
        color:black;
    }

    .sidebars .first-ul{
        line-height:50px;
        color:black;
    }

    .sidebars ul li ul li{
        width: 100%;
        color:black;
    }
</style>


<div class="container-xxl mt-5 " style="position:absolute; TOP: 75px; right: 275px;">
        <div class="">

            <div class="card border-light" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.5); width: 1530px; height: 800px;">
                <div class="card-header">
                    

<!-------------------------------------------------------------- BREAK  for add  leave Type modal start------------------------------------------------------------------------------->

                        <div class="modal fade" id="id_addLeaveType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="add_LeaveType.php" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Leave Type</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <span class="input-group-text">Leave Type Name:</span>
                                                <input type="text" name="name_typeName" aria-label="Leave Type" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="name_btnAddLeaveType" class="btn btn-primary">Add Leave Type</button>
                                        </div>
                                    </div>
                                </form>    
                            </div>
                        </div>

<!-------------------------------------------------------------- BREAK  for add  leave Type modal END------------------------------------------------------------------------------->




<!-------------------------------------------------------------- BREAK  for add  credits modal start------------------------------------------------------------------------------->

                    <!-- Modal -->
                        <div class="modal fade" id="id_apply_leave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <form action="actions/Leave Request/insert.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create: Apply Leave</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                                
                                                    
                                            <!------------------------------ BREAK -------------------------------------->

                                        <div class="row">
                                        <input type="hidden" name='name_emp' readonly value=" <?php  echo $_SESSION['empid']; ?>">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="Select_dept" class="form-label">Leave Type :</label>
                                                        <select class='form-select form-select-m' onchange="leavetype()" id="leavetype_id" name="name_LeaveT" aria-label='.form-select-sm example' style=' cursor: pointer;'>
                                                            <option selected disabled value=''>Select</option>
                                                            <option value='Vacation Leave'>Vacation Leave</option>
                                                            <option value='Sick Leave'>Sick Leave</option>
                                                            <option value='Bereavement Leave'>Bereavement Leave</option>
                                                        </select>

                                                        <?php
                                                        /*
                                                            include 'config.php';

                                                            // Fetch all values of fname and lname from the database
                                                            $sql = "SELECT col_Leave_name FROM leavetype_tb";
                                                            $result = mysqli_query($conn, $sql);

                                                            // Generate the dropdown list
                                                            echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='name_emp'>";
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $Leave_id = $row['col_ID'];
                                                                $Leave_name = $row['col_Leave_name'];
                                                                echo "<option value='$Leave_id'>$Leave_name</option>";
                                                            }
                                                            echo "</select>";
                                                            */
                                                        ?>

                                                    </div> <!-- First mb-3 end-->
                                                </div> <!-- First col-6 end-->

                                                <!---------------------------------- BREAK ------------------------------>

                                                <div class="col-6">
                                                    <div class="mb-3">
                                                            <label for="Select_dept" class="form-label">Leave Period :</label>
                                                            <select style id="id_leavePeriod" disabled name="name_LeaveP" onchange="halfdaysides()" class='form-select form-select-m' aria-label='.form-select-sm example' style='cursor: pointer;'>
                                                                <option disabled selected value=''>Select</option>
                                                                <option value='Full Day'>Full Day</option>
                                                                <option value='Half Day'>Half Day</option> 
                                                            </select>
                                                    </div> <!-- Second mb-3 end-->
                                                </div> <!-- Second col-6 end-->
                                        </div>  <!-- Row end-->


                                            <!---------------------------------- BREAK ------------------------------>


                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group mb-3" id="id_chckfirsthalf" style="display: none;">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input mt-0" type="checkbox" name="firstHalf" value="First Half" aria-label="Checkbox for following text input">
                                                        </div>
                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" readonly value="First Half">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="input-group mb-3" id="id_chckSecondhalf" style="display: none;">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input mt-0" type="checkbox" name="secondHalf" value="Second Half" aria-label="Checkbox for following text input">
                                                        </div>
                                                        <input type="text" class="form-control" aria-label="Text input with checkbox" readonly value="Second Half">
                                                    </div>
                                                </div>
                                            </div>


                                             <!---------------------------------- BREAK ------------------------------>


                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-1">
                                                            <label for="id_inpt_strdate">Start Date :</label>
                                                            <input type="date" onchange =" strvalidate() "   name="name_STRdate" class="form-control" id="id_inpt_strdate" style='cursor: pointer;' disabled required>
                                                        </div> <!-- Second mb-3 end-->
                                                    </div>  <!-- col-6 end-->
                                                    <div class="col-6">
                                                        <div class="mb-1">
                                                            <label for="id_inpt_enddate">End Date :</label>
                                                            <input type="date" onchange =" endvalidate()" name="name_ENDdate" class="form-control" id="id_inpt_enddate"  style='  cursor: pointer;' required disabled>
                                                        </div> <!-- Second mb-3 end-->
                                                    </div> <!-- col-6 end-->
                                                </div> <!-- row end-->

                                                <div class="form-floating mt-3">
                                                    <textarea class="form-control" name="name_txtRSN" placeholder="Leave a comment here" id="id_reason" style=" max-width: 100% ; min-width: 100% ; max-height: 150px ; min-height: 150px ;"></textarea>
                                                    <label for="id_reason">Reason</label>
                                                </div>

                                                <!---------------------------------- BREAK ------------------------------>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group mt-3" id="id_wthPay">
                                                            <div class="input-group-text">
                                                                <input class="form-check-input mt-0" type="checkbox" name="name_wthPay" value="With Pay" id="checkbox_wthPay">
                                                            </div>
                                                            <input type="text" id="chnge_val" class="form-control" aria-label="Text input with checkbox" readonly value="Leave Without Pay" style= "background-color: red; color: #ffffff;">
                                                        </div>
                                                    </div>
                                                </div>
                                               

                                                 <!---------------------------------- BREAK ------------------------------>

                                                <div class="mt-3">
                                                    <label for="formFileMultiple" class="form-label fs-4">Attach File :</label>
                                                    <input class="form-control" name="name_file" type="file" id="formFileMultiple" multiple required>
                                                </div>

                                        </div>  <!-- end body-->
                                        <div class="modal-footer">
                                        
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="name_btnApply" id="id_btnsubmit"  class="btn btn-primary" disabled>Apply Leave</button>
                                        </div>  <!-- end modal footer -->
                                    </div> <!-- end Modal content -->
                                </form>
                            </div> <!-- end Modal dialog -->
                        </div><!-- end Modal -->


        <!-------------------------------------------------------------- BREAK modal end ----------------------------------------------------------------->
                    
                </div> 
                <div class="card-body">
                <div class="row">
                        <div class="col-6">
                            <h2 class="display-5">Leave Request</h2>
                        </div>
                        <div class="col-6 text-end mt-3">
                            <button class="btn_applyL" data-bs-toggle="modal" data-bs-target="#id_apply_leave">
                                Apply Leave
                            </button>
                          
                        </div>
                    </div> <!-- row end -->


                    <div class="row">
                        <div class="col-6">
                        <div class="mb-3">
                                <label for="Select_dept" class="form-label">Select Status</label>
                                        <select class='form-select form-select-m' aria-label='.form-select-sm example' style=' height: 50px; width: 400px; cursor: pointer;'>
                                            <option value='Pending'>Pending</option>
                                            <option value='Approved'>Approved</option>
                                            <option value='Declined'>Declined</option>
                                        </select>
                            </div> <!-- First mb-3 end-->
                          
                            

                        </div> <!-- first col- 6 end-->
                        <div class="col-6">
                            <label for="id_strdate" class="form-label">Date Range :</label>
                            <div class="mb-1">
                                <form class="form-floating">
                                    <input type="date" class="form-control" id="id_inpt_strdate" style=' height: 50px; width: 400px;cursor: pointer;' >
                                    <label for="id_inpt_strdate">Start Date :</label>
                                </form>
                            </div> <!-- Second mb-3 end-->
                        </div> <!-- second col- 6 end-->
                    </div><!--row end-->
                    
            <!----------------------------------Break------------------------------------->

                    <div class="row">
                        <div class="col-6">                         
                            <!-- for employee dropdown tinangal ko -->
                        </div> <!-- first col- 6 end-->
                        <div class="col-6">
                            <div class="mb-1 mt-3">
                                <form class="form-floating">
                                    <input type="date" class="form-control" id="id_inpt_enddate" style=' height: 50px; width: 400px; cursor: pointer;' >
                                    <label for="id_inpt_enddate">End Date :</label>
                                </form>
                            </div> <!-- Second mb-3 end-->
                        </div> <!-- second col- 6 end-->
                    </div><!--row end-->

            <!----------------------------------Break------------------------------------->

                    <div class="pnl_utop p-3 mb-2 bg-body-tertiary">
                        <h3 style= "font-size: 20px; font-weight: bold; font-family: 'Nunito', sans-serif; ">List All Leave</h3>
                    </div>
            <!----------------------------------Break------------------------------------->


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

            <div class="row mt-3"> <!--ROW start--> 
                        <div class="col-6 mb-3">
                            <div class="pnl_top">
                                <select class="slction_top" id="limit-select" name= "no_Limit_Listed">
                                    <option value="" disabled selected>Select No. Item To List</option>
                                    <option value="5">Item Listed 5</option>
                                    <option value="10">Item Listed 10</option>
                                    <option value="15">Item Listed 15</option>
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
                    </div><!--ROW END--> 
        <!----------------------------------Break------------------------------------->   
        
        
                    <div id="data_table" class="table table-responsive "  style="height: 300px; overflow-y: auto;">
                        <form action="actions/Leave Request/action.php" method="post">
                        <input id="id_ID_tb" name="name_ID_tb" type="text" style="display: none;">  <!--received the id of selected data in datatble and pass to calss action-->   
                        <input id="id_IDemp_tb" name="name_empID_tb" type="text" style="display: none;"> <!--received the employee_id of selected data in datatble and pass to calss action-->  
                        <table id="data_table" class="table table-sortable table-striped table-hover caption-top " >
                                <caption>List of Employee Leave Request</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Employee ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Leave Type</th>
                                            <th scope="col">Leave Date</th>
                                            <th scope="col">Date Filled</th>
                                            <th scope="col">Action Taken</th>
                                            <th scope="col">Approver</th>
                                            <th scope="col">File Reason</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                        <tbody id="table-body">
                                            <?php 
                                                    include 'config.php';
                                                    //select data db

                                                    $empid = $_SESSION['empid'];

                                                    $sql = "SELECT
                                                                applyleave_tb.col_ID,
                                                                applyleave_tb.`col_req_emp`,
                                                                CONCAT(
                                                                    employee_tb.`fname`,
                                                                    ' ',
                                                                    employee_tb.`lname`
                                                                ) AS `full_name`,
                                                                applyleave_tb.`col_LeaveType`,
                                                                applyleave_tb.`col_strDate`,
                                                                applyleave_tb.`_datetime`,
                                                                applyleave_tb.`col_dt_action`,
                                                                applyleave_tb.`col_approver`,
                                                                applyleave_tb.`col_status`
                                                            FROM
                                                                applyleave_tb
                                                            INNER JOIN employee_tb ON applyleave_tb.col_req_emp = employee_tb.empid WHERE applyleave_tb.col_req_emp = $empid
                                                            ORDER BY applyleave_tb.`_datetime` DESC
                                                            
                                                            ";
                                                    $result = $conn->query($sql);

                                                    //read data
                                                    while($row = $result->fetch_assoc()){
                                                        $approver = $row['col_approver'];
                                                        if ($approver === ''){
                                                            $approver_fullname = 'none';
                                                        }
                                                        else{
                                                            $result_approver = mysqli_query($conn, " SELECT
                                                            *  
                                                        FROM
                                                            employee_tb
                                                        WHERE empid = $approver");
                                                        if(mysqli_num_rows($result_approver) > 0) {
                                                            $row_approver = mysqli_fetch_assoc($result_approver);
                                                            //echo $row__leaveINFO['col_vctionCrdt'];
                                                            $approver_fullname = $row_approver['fname'] . " " . $row_approver['lname'];
                                                        } else {
                                                            $approver_fullname = 'Something Went Wrong';
                                                        } 
                                                        }
                                                       

                                                        

                                                        echo "<tr>
                                                                <td>" . $row['col_ID'] . "</td>
                                                                <td>" . $row['col_req_emp'] . "</td>
                                                                <td scope='row'>
                                                                    <button type='submit' name='view_data' class='viewbtn' title='View' style='border: none; background: transparent;
                                                                        text-transform: capitalize; text-decoration: underline; cursor: pointer; color: #787BDB; font-size: 19px;'>
                                                                        " . $row['full_name'] . "
                                                                    </button>
                                                                </td>
                                                                <td>" . $row['col_LeaveType'] . "</td>
                                                                <td>" . $row['col_strDate'] . "</td>
                                                                <td>" . $row['_datetime'] . "</td>
                                                                <td>" . $row['col_dt_action'] . "</td>
                                                                <td>" . $approver_fullname . "</td>
                                                                <td>
                                                                    <div class='row'>
                                                                        <div class='col-12'>
                                                                            <button type='button' class='border-0 btn_view_file' title='View' data-bs-toggle='modal' data-bs-target='#id_view_file' style='background: transparent;'>
                                                                                <img src='icons/view_file.png' alt='...'>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td" . ($row['col_status'] === 'Approved' ? " style='color: blue;'" :
                                                                            ($row['col_status'] === 'Rejected' ? " style='color: red;'" :
                                                                                ($row['col_status'] === 'Cancelled' ? " style='color: orange;'" :
                                                                                    ($row['col_status'] === 'Pending' ? " style='color: green;'" :
                                                                                    "") 
                                                                                )
                                                                            )
                                                                        ) . ">" . $row['col_status'] . "</td>
                                                            </tr>";

                                                    }
                                                ?>  
                                        </tbody>   
                                </table>
                                
                    
                        </form>
                    </div> <!--table my-3 end-->   
                <!----------------------------------Break------------------------------------->

                   <!---- Modal for View button for file reason ---->
                        <div class="modal fade" id="id_view_file" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="leave_req_fileReason.php" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">View File</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <input name="name_ID_tb" id="id_table" type="text" style="display:none;">
                                            <input name="name_empID_tb" id="id_EMPID" type="text" style="display:none;">
                                            <h3> Are you sure you want to view the valid reason uploaded as file?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="btn_yes_modal" class="btn btn-primary btn-lg">YES</button>
                                            </div>
                                        </div> <!---- Modal-content end---->
                                </form>    
                            </div><!---- Modal-dialog end---->
                        </div> <!---- Modal end---->
                    <!---- Modal for View button for file reason END---->
                </div> <!--card-body end-->

            </div> <!--Card end-->
                                                </div>
        </div>  <!--jummbotron end--> 
    </div> <!--container end-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
                
<script>
  document.getElementById('formFileMultiple').addEventListener('change', function(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    if (file.type !== 'application/pdf') {
      alert('Please select a PDF file.');
      fileInput.value = ''; // Clear the file input field
    }

  });
</script>

                <!---------------------------break --------------------------->
<script> //FOR VIEW TRANSFER 
            $(document).ready(function(){
                                    $('.viewbtn').on('click', function(){
                                        $('#id_modal_empreqLeave').modal('show');
                                        $tr = $(this).closest('tr');

                                        var data = $tr.children("td").map(function () {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);
                                        //id_colId
                                        $('#id_ID_tb').val(data[0]);
                                        $('#id_IDemp_tb').val(data[1]);
                                    });
                                });
            //FOR VIEW TRANSFER MODAL END
</script>
                <!---------------------------break --------------------------->

                <!---------------------------break --------------------------->
<script> //FOR VIEW FILE REASON  modal
            $(document).ready(function(){
                                    $('.btn_view_file').on('click', function(){
                                        $('#id_view_file').modal('show');
                                        $tr = $(this).closest('tr');

                                        var data = $tr.children("td").map(function () {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);
                                        
                                        $('#id_table').val(data[0]);
                                        $('#id_EMPID').val(data[2]);
                                    });
                                });
            //FOR VIEW FILE REASON modal END
</script>
                <!---------------------------break --------------------------->


<script>
//     $(document).ready(function() {
//     // listen to changes on the selection box
//     $('#limit-select').change(function() {
//         // get the selected value
//         var limit = $(this).val();

//         // get all table rows
//         var rows = $('#table-body tr');

//         // hide all rows
//         rows.hide();

//         // show only the first "limit" number of rows
//         rows.slice(0, limit).show();
//     });
// });

// </script>


</body>
<script src="js/leavereq.js"></script>
</html>