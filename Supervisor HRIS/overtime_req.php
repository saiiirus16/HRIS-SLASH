<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="css/overtime.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Overtime - Approver</title>
</head>
<body>
<header>
     <?php
         include 'header.php';
     ?>
</header>

<style>
   
   html{
        background-color: #f4f4f4 !important;
        overflow: hidden;
    }
    

    body{
        overflow: hidden;
        background-color: #f4f4f4;
    }

    .pagination{
        margin-right: 73px !important;

        
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

<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download_ot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Overtime Request/download_ot.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id" id="id_table">
        <input type="hidden" name="table_name" id="name_table">
        <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_download_ot" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!---------------------------------------Download Modal End Here --------------------------------------->

<!------------------------------------------------View ng whole data Modal ---------------------------------------------------->

<div class="modal fade" id="view_ot_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
                <div class="modal-body">
                    <div class="row" >
                     <div class="col-6">
                            <label for="" class="form-label">Employee ID</label>
                            <input type="text" name="empid_view" class="form-control" id="view_empid" readonly>
                        </div>
                        <div class="col-6">
                            <label for="company" class="form-label">OT Date</label>
                            <input type="date" name="view_date_choose" class="form-control" id="view_date_id" readonly>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                       <div class="col-6">
                            <label for="start" class="form-label">Time In</label>
                            <input type="time" name="view_time_start" class="form-control" id="view_start_time_id" readonly>
                        </div>
                        <div class="col-6">
                           <label for="end" class="form-label">Time Out</label>
                           <input type="time" name="view_time_end" class="form-control" id="view_end_time_id" readonly>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="ot_hours" class="form-label">Overtime Hours</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="view_total_overtime" id="view_ot_id" readonly>
                            <span class="input-group-text">hrs</span>
                       </div>
                    </div>

                    <div class="mb-3">
                            <label for="text_area" class="form-label">Reason</label>
                            <textarea class="form-control" name="view_reason" id="view_reason_id" readonly></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="view_file_upload" class="form-control" id="view_file_id" readonly>
                        <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                    </div>

                  <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">Date File</label>
                            <input type="text" name="datefile_viewing" class="form-control" id="view_datefile" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Status</label>
                            <input type="text" name="view_status" class="form-control" id="view_status_id" readonly>
                        </div>
                    </div>

                </div> <!---Modal Body End Tag-->
        </div>
    </div>
</div>

<!------------------------------------------------End ng View Modal ---------------------------------------------------->





<!------------------------------------Main Panel of data table------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 19%; position: absolute; top: 30px;">
        <div class=" mt-5">
          <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">  
<!------------------------------------Main Panel of data table------------------------------------------------->


<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Overtime Request List</h2>
                                </div>
                                <!-- <div class="col-6 mt-1 text-end"> -->
                                <!-- Button trigger modal -->
                                <!-- <button type="button" class="file_overtime" data-bs-toggle="modal" data-bs-target="#file_overtime">
                                    File Overtime
                                    </button>
                                </div> -->
                            </div> <!--ROW END-->
<!----------------------------------End Class ng header including the button for modal-------------------------------------------->

<!------------------------------------Message alert------------------------------------------------->
<?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
?>
<!------------------------------------End Message alert------------------------------------------------->

<!------------------------------------Message alert------------------------------------------------->
<?php
        if (isset($_GET['error'])) {
            $err = $_GET['error'];
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            '.$err.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
?>
<!------------------------------------End Message alert------------------------------------------------->

<!----------------------------------Syntax for Dropdown button------------------------------------------>
<div class="official_panel">
            <div class="child_panel">
              <p class="empo_date_text">Employee</p>
                     <?php
                        include 'config.php';

                        // Fetch all values of empid and date from the database
                        $sql = "SELECT `empid` FROM `overtime_tb`";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select_custom form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                        echo "<option value=''>Select Employee</option>"; // Add a default option
                        while ($row = mysqli_fetch_array($result)) {
                        $emp_id = $row['empid'];
                        echo "<option value='$emp_id'>$emp_id</option>"; // Set the value to emp_id|date
                        }
                        echo "</select>";
                      ?>
            </div>

            <div class="child_panel">
              <p class="empo_date_text">Status</p>
                     <?php
                        include 'config.php';

                        // Fetch all values of empid and date from the database
                        $sql = "SELECT `status` FROM `overtime_tb`";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select_custom form-select-m' aria-label='.form-select-sm example' name='status_emp''>";
                        echo "<option value=''>Select Employee</option>"; // Add a default option
                        while ($row = mysqli_fetch_array($result)) {
                        $status = $row['status'];
                        echo "<option value='$status'>$status</option>"; // Set the value to emp_id|date
                        }
                        echo "</select>";
                      ?>
            </div>
            <div class="child_panel">
            
            </div>
            <button class="btn_go" id="id_btngo">Go</button>
          </div>
<!------------------------------End Syntax for Dropdown button------------------------------------------------->

<!----------------------------------Button for Approve and Reject All------------------------------------------>
        <div class="btn-section">
                <form action="actions/Overtime Request/update_status.php" method="POST">
                <input type="hidden" name="Approve" value="approved">
                <button type="submit" name="approve_all" class="approve-btn">Approve All</button>
                </form>

                <form action="actions/Overtime Request/update_status.php" method="POST">
                <!-- <input type="hidden" name="status" value="rejected"> -->
                <button type="submit" name="reject_all" class="reject-btn">Reject All</button>
                </form>
        </div>
<!--------------------------------End Button for Approve and Reject All---------------------------------------->                 
               

<!------------------------------------------Syntax ng Table-------------------------------------------------->
<form action="actions/Overtime Request/approve_reject.php" method="POST">
        <div class="row" >
            <div class="col-12 mt-2">
                <input type="hidden" id="check_id" name="id_check" value="<?php echo $row['id']?>">
                    <div class="table-responsive">
                        <table id="order-listing" class="table" >
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>OT Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>OT Hours</th>
                                <th style="display: none;">Reason</th>
                                <th>File Attachment</th>
                                <th>Status</th>
                                <th>Date Filed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                         <?php
                         include '../config.php';
                         $aprrover_ID = $_SESSION['empid'];
                         
                         $query = "SELECT
                         overtime_tb.id,
                         employee_tb.empid,
                         CONCAT(employee_tb.`fname`, ' ', employee_tb.`lname`) AS `full_name`,
                         overtime_tb.work_schedule,
                         overtime_tb.time_in,
                         overtime_tb.time_out,
                         overtime_tb.ot_hours,
                         overtime_tb.total_ot,
                         overtime_tb.reason,
                         overtime_tb.file_attachment,
                         overtime_tb.status,
                         overtime_tb.date_filed
                         FROM
                            employee_tb
                         INNER JOIN overtime_tb ON employee_tb.empid = overtime_tb.empid 
                         WHERE employee_tb.`approver`= (SELECT empid FROM employee_tb WHERE empid = $aprrover_ID);";
                         $result = mysqli_query($conn, $query);
                         while ($row = mysqli_fetch_assoc($result)){  
                         ?>
                         <tbody>
                            <tr>
                                <td style="display: none;"><?php echo $row['id']?></td>
                                <td><?php echo $row['empid']?></td>
                                <td><?php echo $row['full_name']?></td>
                                <td><?php echo $row['work_schedule']?></td>
                                <td><?php echo date('h:i A', strtotime($row['time_in'])) ?></td>
                                <td><?php echo date('h:i A', strtotime($row['time_out'])) ?></td>
                                <td><?php echo $row['total_ot']?></td>
                                <td style="display: none;"><?php echo $row['reason']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_ot">Download</button>
                                </td>
                                <?php else: ?>
                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                                <td <?php if ($row['status'] == 'Approved') {echo 'style="color:green;"';} elseif ($row['status'] == 'Rejected') {echo 'style="color:red;"';} ?>><?php echo $row['status']; ?></td>
                                <td><?php echo $row['date_filed']?></td>
                                <td>     
                                    <?php if ($row['status'] === 'Approved' || $row['status'] === 'Rejected'): ?>
                                          <button type="submit" class="btn btn-outline-success viewbtn" name="approve_btn" style="display: none;" disabled>
                                            Approve
                                          </button>
                                          <button type="submit" class="btn btn-outline-danger viewbtn" name="reject_btn" style="display: none;" disabled>
                                            Reject
                                          </button>
                                        <?php else: ?>
                                          <button type="submit" class="btn btn-outline-success viewbtn" name="approve_btn">
                                            Approve
                                          </button>
                                          <button type="submit" class="btn btn-outline-danger viewbtn" name="reject_btn">
                                            Reject
                                          </button>
                                        <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                             } 
                            ?>
                         </tbody>
                      </table>
                      </form>  
<!------------------------------------End Syntax ng Table------------------------------------------------->                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-------------------------------Script para matest kung naseselect ba ang I.D---------------------------------------->        
<script> 
            $(document).ready(function(){
               $('.viewbtn').on('click', function(){
                 $().modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#check_id').val(data[0]);
               });
             });
</script>
<!-----------------------------End Script para matest kung naseselect ba ang I.D------------------------------------->
 

<!------------------------------------Script para lumabas ang modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download_ot').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#id_table').val(data[0]);
                   $('#name_table').val(data[2]);
               });
             });
</script>
<!---------------------------------End ng Script para lumabas ang modal------------------------------------------>

<!------------------------------------Script para sa whole view data ng modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.viewbtn').on('click', function(){
                 $('#view_ot_modal').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#view_empid').val(data[1]);
                   $('#view_date_id').val(data[2]);
                   $('#view_start_time_id').val(data[3]);
                   $('#view_end_time_id').val(data[4]);
                   $('#view_ot_id').val(data[5]);
                   $('#view_reason_id').val(data[6]);
                   $('#view_file_id').val(data[7]);
                   var status = $tr.find('td:eq(8)').text();
                   $('#view_status_id').val(status);
                   $('#view_datefile').val(data[9]);    
               });
             });
             </script>
<!---------------------------------End ng Script whole view data ng modal------------------------------------------>

<!---------------------------- Script para lumabas ang warning message na PDF File lang inaallow------------------------------------------>
<script>
  document.getElementById('inputfile').addEventListener('change', function(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    if (file.type !== 'application/pdf') {
      alert('Please select a PDF file.');
      fileInput.value = ''; // Clear the file input field
    }
  });
</script>
<!--------------------End ng Script para lumabas ang Script para lumabas ang warning message na PDF File lang inaallow--------------------->

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
                                    $('#empName').val(data[0]);
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

    <!-- <script src="overtime.js"></script> -->
    
</body>
</html>