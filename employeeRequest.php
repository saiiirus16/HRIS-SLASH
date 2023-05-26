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
    <link rel="stylesheet" href="css/styles.css">
    <title>Employee Request</title>


   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">

        <!-- skydash -->

    <link rel="stylesheet" href="skydash/feather.css">
    <link rel="stylesheet" href="skydash/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="skydash/vendor.bundle.base.css">

    <link rel="stylesheet" href="skydash/style.css">

    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
   

    <link rel="stylesheet" href="css/try.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <?php 
        include 'header.php';
    ?>
</header>

<style>
    html{
        background-color: #f4f4f4;
    }
     .pagination{
        margin-right: 63px !important;

        
    }

    .pagination li a{
        color: #c37700;
    }

        .page-item.active .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-page .page-link, .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button a, .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-page a {
        z-index: 3;
        color: #fff;
        background-color: #000;
        border-color: #000;
    }

    
    
    #order-listing_next{
        margin-right: 28px !important;
        margin-bottom: -16px !important;

    }

</style>

<!-------------------------------------- BODY START CONTENT ----------------------------------------------->
<div class="main-panel" style="box-shadow: 10px 10px 10px 8px #888888; position:absolute; TOP: 125px; right: 100px; width:75%; height:800px;">
    <div class="card">
        <h3 style="margin-top: 20px; margin-left: 20px;">Employee Request</h3>
        <div class="row "style="margin-top: 20px; margin-left: 20px;">
            <div class="col-4">
                <div class="mb-3">
                    <label for="Select_emp" class="form-label">Select Employee :</label>
                        <?php
                            include 'config.php';

                            // Fetch all values of fname and lname from the database
                            $sql = "SELECT fname, lname, empid FROM employee_tb";
                            $result = mysqli_query($conn, $sql);

                            // Generate the dropdown list
                            echo "<select class='form-select form-select-m' id='' style=' height: 50px; width: 400px; cursor: pointer;'>";
                            echo "<option value='' disabled selected>Select Employee</option>";
                                while ($row = mysqli_fetch_array($result)) {
                                    $emp_id = $row['empid'];
                                    $name = $row['empid'] . ' - ' . $row['fname'] . ' ' . $row['lname'];
                                    echo "<option value='$emp_id'>$name</option>";
                                }
                            echo "</select>";
                        ?>
                </div>  <!--mb-3 end--->
                          
                            

                        </div> <!-- first col- 6 end-->
                        <div class="col-4">
                            <label for="id_strdate" class="form-label">Date Range :</label>
                            <div class="mb-1">
                                <form class="form-floating">
                                    <input type="date" class="form-control" id="id_inpt_strdate" style=' height: 50px; width: 400px;cursor: pointer;' >
                                    <label for="id_inpt_strdate">Start Date :</label>
                                </form>
                            </div> <!-- Second mb-3 end-->
                        </div> <!-- second col- 6 end-->
                        <div class="col-4">

                        </div>
                    </div><!--row end-->
                    
            <!----------------------------------Break------------------------------------->

                    <div class="row"style="margin-left: 20px;">
                        <div class="col-4">                         
                            <div class="mb-3">
                                    <label for="Select_dept" class="form-label">Select Status</label>
                                            <select class='form-select form-select-m' aria-label='.form-select-sm example' style=' height: 50px; width: 400px; cursor: pointer;'>
                                                <option value='Pending'>Pending</option>
                                                <option value='Approved'>Approved</option>
                                                <option value='Declined'>Declined</option>
                                            </select>
                                </div> <!-- First mb-3 end-->
                            </div> <!-- first col- 6 end-->
                            <div class="col-4">
                                <div class="mb-1 mt-3">
                                    <form class="form-floating">
                                        <input type="date" class="form-control" id="id_inpt_enddate" style=' height: 50px; width: 400px; cursor: pointer;' >
                                        <label for="id_inpt_enddate">End Date :</label>
                                    </form>
                                </div> <!-- Second mb-3 end-->
                               
                            </div> <!-- second col- 6 end-->
                            <div class="col-4">
                                <button type="button " class="btn btn-primary" style="--bs-btn-padding-y: 5px; --bs-btn-padding-x: 20px; --bs-btn-font-size: .75rem;">
                                    GO
                                </button>
                            </div>
                    </div><!--row end-->

            <!----------------------------------Break------------------------------------->

            <div class="p-4 mb-2 bg-secondary text-white ml-4 mr-4">List of all Leave</div>
                
            <div class="row mr-3 ml-3">
                <div class="table-responsive mt-5" style="overflow-y: scroll;  max-height: 400px;">
                    <form action="actions/Employee List/empreq.php" method="post">
                        <input type="hidden" name="name_reqType" id="id_reqType">
                            <table id="order-listing" class="table" >
                                <thead >
                                    <tr> 
                                        <th style= 'display: ;'> ID </th>  
                                        <th> Employee ID </th>
                                        <th> Name </th>
                                        <th> Positon </th> 
                                        <th> Department </th>
                                        <th> Date Filled </th>
                                        <th> Request Type </th>
                                        <th> Status </th>                             
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include 'config.php';


                                        $sql = "
                                        SELECT
                                            CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                                ) AS `full_name`,
                                            positionn_tb.position AS Position,
                                            dept_tb.col_deptname AS Department,
                                            applyleave_tb.col_ID AS col_ID,
                                            applyleave_tb.col_req_emp AS col_req_emp,
                                            applyleave_tb._datetime AS datetime,
                                            applyleave_tb.col_status AS col_status,
                                            'Leave Request' AS request_type
                                        FROM
                                            employee_tb
                                        INNER JOIN applyleave_tb ON employee_tb.empid = applyleave_tb.col_req_emp
                                        INNER JOIN positionn_tb ON employee_tb.empposition = positionn_tb.id
                                        INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID

                                        UNION
                                        SELECT
                                            CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                                ) AS `full_name`,
                                            positionn_tb.position AS Position,
                                            dept_tb.col_deptname AS Department,
                                            overtime_tb.id AS col_ID,
                                            overtime_tb.empid AS col_req_emp,
                                            overtime_tb.date_filed AS datetime,
                                            overtime_tb.status AS col_status,
                                            'OverTime Request' AS request_type
                                        FROM
                                            employee_tb
                                        INNER JOIN overtime_tb ON employee_tb.empid = overtime_tb.empid
                                        INNER JOIN positionn_tb ON employee_tb.empposition = positionn_tb.id
                                        INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID

                                        UNION
                                        SELECT
                                        CONCAT(
                                            employee_tb.`fname`,
                                            ' ',
                                            employee_tb.`lname`
                                            ) AS `full_name`,
                                            positionn_tb.position AS Position,
                                            dept_tb.col_deptname AS Department,
                                            undertime_tb.id AS col_ID,
                                            undertime_tb.empid AS col_req_emp,
                                            undertime_tb.date_file AS datetime,
                                            undertime_tb.status AS col_status,
                                            'Undertime Request' AS request_type
                                        FROM
                                            employee_tb
                                        INNER JOIN undertime_tb ON employee_tb.empid = undertime_tb.empid
                                        INNER JOIN positionn_tb ON employee_tb.empposition = positionn_tb.id
                                        INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID

                                        UNION
                                        SELECT
                                            CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                                ) AS `full_name`,
                                            positionn_tb.position AS Position,
                                            dept_tb.col_deptname AS Department,
                                            wfh_tb.id AS col_ID,
                                            wfh_tb.empid AS col_req_emp,
                                            wfh_tb.date_file AS datetime,
                                            wfh_tb.status AS col_status,
                                            'WFH Request' AS request_type
                                        FROM
                                            employee_tb
                                        INNER JOIN wfh_tb ON employee_tb.empid = wfh_tb.empid
                                        INNER JOIN positionn_tb ON employee_tb.empposition = positionn_tb.id
                                        INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID

                                        UNION
                                        SELECT
                                            CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                                ) AS `full_name`,
                                            positionn_tb.position AS Position,
                                            dept_tb.col_deptname AS Department,
                                            emp_official_tb.id AS col_ID,
                                            emp_official_tb.employee_id AS col_req_emp,
                                            emp_official_tb._dateTime AS datetime,
                                            emp_official_tb.status AS col_status,
                                            'Official Business' AS request_type
                                        FROM
                                            employee_tb
                                        INNER JOIN emp_official_tb ON employee_tb.empid = emp_official_tb.employee_id
                                        INNER JOIN positionn_tb ON employee_tb.empposition = positionn_tb.id
                                        INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID

                                        UNION
                                        SELECT
                                            CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                                ) AS `full_name`,
                                            positionn_tb.position AS Position,
                                            dept_tb.col_deptname AS Department,
                                            emp_dtr_tb.id AS col_ID,
                                            emp_dtr_tb.empid AS col_req_emp,
                                            emp_dtr_tb._dateTime AS datetime,
                                            emp_dtr_tb.status AS col_status,
                                            'DTR Request' AS request_type
                                        FROM
                                            employee_tb
                                        INNER JOIN emp_dtr_tb ON employee_tb.empid = emp_dtr_tb.empid
                                        INNER JOIN positionn_tb ON employee_tb.empposition = positionn_tb.id
                                        INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID";
                                    
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['col_ID'] . "</td>";
                                            echo "<td>" . $row['col_req_emp'] . "</td>";
                                            echo "<td scope='row'>
                                                    <button type='submit' name='view_data' class='viewbtn' title='View' style='border: none; background: transparent;
                                                        text-transform: capitalize; text-decoration: underline; cursor: pointer; color: #787BDB; font-size: 19px;'>
                                                        " . $row['full_name'] . "
                                                    </button>
                                                    </td>";
                                            echo "<td>" . $row['Position'] . "</td>";
                                            echo "<td>" . $row['Department'] . "</td>";
                                            echo "<td>" . $row['datetime'] . "</td>";
                                            echo "<td>" . $row['request_type'] . "</td>";
                                            echo "<td>" . $row['col_status'] . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table> 
                        </form>           
                </div> <!--table my-3 end-->   
            </div>

               
    </div><!--card end-->
    <footer>
               <div class="att-export-btn" style="background-color:">
                    <p>Export options: <a href="excel-att.php" class="" style="color:green"></i>Excel</a><span> |</span> <button id="btnExport" style="background-color: inherit; border:none; color: red">Export to PDF</button></p>
                </div>
               </footer>    
</div><!--main-panel end-->
    
<!-------------------------------------- BODY END CONTENT ------------------------------------------------>



<script> 
        $(document).ready(function(){
                                $('.viewbtn').on('click', function(){
                                    $('#update_deptMDL').modal('show');
                                    $tr = $(this).closest('tr');

                                    var data = $tr.children("td").map(function () {
                                        return $(this).text();
                                    }).get();

                                    console.log(data);
                                    //id_colId
                                    $('#id_reqType').val(data[6]);
                                });
                            });
            
    </script> 

    

<script> 
     $('.header-dropdown-btn').click(function(){
        $('.header-dropdown .header-dropdown-menu').toggleClass("show-header-dd");
    });

//     $(document).ready(function() {
//     $('.navbar-toggler').click(function() {
//     $('.nav-title').toggleClass('hide-title');
//     $('.dashboard-container').toggleClass('move-content');
  
//   });
// });
 $(document).ready(function() {
    var isHamburgerClicked = false;

    $('.navbar-toggler').click(function() {
    $('.nav-title').toggleClass('hide-title');
    // $('.dashboard-container').toggleClass('move-content');
    isHamburgerClicked = !isHamburgerClicked;

    if (isHamburgerClicked) {
      $('#schedule-list-container').addClass('move-content');
    } else {
      $('#schedule-list-container').removeClass('move-content');

      // Add class for transition
      $('#schedule-list-container').addClass('move-content-transition');
      // Wait for transition to complete before removing the class
      setTimeout(function() {
        $('#schedule-list-container').removeClass('move-content-transition');
      }, 800); // Adjust the timeout to match the transition duration
    }
  });
});
 

//     $(document).ready(function() {
//   $('.navbar-toggler').click(function() {
//     $('.nav-title').toggleClass('hide-title');
//   });
// });


    </script>

<script>
 //HEADER RESPONSIVENESS SCRIPT
 
 
$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
  $('.nav-link').on('click', function(e) {
    if ($(window).width() <= 390) {
      e.preventDefault();
      $(this).siblings('.sub-menu').slideToggle();
    }
  });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 390) {
      $('#sidebar').toggleClass('active-sidebars');
    }
  });
});


$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
  $('.nav-links').on('click', function(e) {
    if ($(window).width() <= 500) {
      e.preventDefault();
      $(this).siblings('.sub-menu').slideToggle();
    }
  });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 500) {
      $('#sidebar').toggleClass('active-sidebar');
    }
  });
});


</script>

<script> 
        $(document).ready(function(){
                $('.sched-update').on('click', function(){
                                    $('#schedUpdate').modal('show');
                                    $tr = $(this).closest('tr');

                                    var data = $tr.children("td").map(function () {
                                        return $(this).text();
                                    }).get();

                                    console.log(data);
                                    //id_colId
                                    $('#empid').val(data[8]);
                                    $('#sched_from').val(data[5]);
                                    $('#sched_to').val(data[6]);
                                });
                            });
            
    </script>



<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>

    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

           <!--skydash-->
    <script src="skydash/vendor.bundle.base.js"></script>
    <script src="skydash/off-canvas.js"></script>
    <script src="skydash/hoverable-collapse.js"></script>
    <script src="skydash/template.js"></script>
    <script src="skydash/settings.js"></script>
    <script src="skydash/todolist.js"></script>
     <script src="main.js"></script>
    <script src="bootstrap js/data-table.js"></script>


    

  
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
</body>
</html>