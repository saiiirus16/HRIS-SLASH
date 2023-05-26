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
    <link rel="stylesheet" href="css/official_business.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Official Business - Admin</title>
</head>
<body>
    <header>
    <?php
        include 'header.php';
    ?>
    </header>

    <style>
    html{
      overflow:hidden;

    }

    .table-responsive{
      width: 98% !important;
      margin: auto !important;
      height: 450px !important;
      overflow-x: hidden !important; 
    }

    .pagination{
        margin-right: 79px !important;

        
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

<!---------------------------------------View Modal Start Here -------------------------------------->
<div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Reason</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="mb-3">
            <label for="text_area" class="form-label"></label>
            <textarea class="form-control" name="text_reason" id="view_reason1" readonly></textarea>
         </div>
      </div><!--Modal Body Close Tag-->

    </div>
  </div>
</div>
<!---------------------------------------View Modal End Here --------------------------------------->

<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Download PDF File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Official Business/download.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id" id="id_table">
        <input type="hidden" name="table_name" id="name_table">
        <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_download" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!---------------------------------------Download Modal End Here --------------------------------------->



<!---------------------------------------Main Panel Start Here --------------------------------------->
        <div class="main-panel mt-5" style="margin-left: 17%; position: absolute; top: 0;">
            <div class="content-wrapper mt-5">
                <div class="card" style= "width:1500px; height:800px; border-radius:20px;">
                    <div class="card-body" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);">
<!---------------------------------------Main Panel End Here --------------------------------------->
                        
<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Official Business</h2>
                                </div>
                            </div> <!--ROW END-->
<!----------------------------------End Class ng header including the button for modal-------------------------------------------->

<!-----------------------------------------Syntax for the alert Message----------------------------------------------------------->
<?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

?>
<!--------------------------------------End ng Syntax for the alert Message------------------------------------------------------->


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
                        $sql = "SELECT `employee_id` FROM `emp_official_tb`";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select_custom form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                        echo "<option value=''>Select Employee</option>"; // Add a default option
                        while ($row = mysqli_fetch_array($result)) {
                        $emp_id = $row['employee_id'];
                        echo "<option value='$emp_id'>$emp_id</option>"; // Set the value to emp_id|date
                        }
                        echo "</select>";
                      ?>
            </div>

            <div class="child_panel">
              <p class="empo_date_text">Month From</p>
              <input class="select_custom" type="date" name="" id="datestart" required>
            </div>
            <div class="child_panel">
              <div class="notif">
              <p class="empo_date_text">Month To</p>
              <p id="validate" class="validation">End date must beyond the start date</p>
            </div>
              <input class="select_custom" type="date" id="enddate" onchange="datefunct()" required>
            </div>
            <button class="btn_go" id="id_btngo">Go</button>
          </div>
<!------------------------------End Syntax for Dropdown button------------------------------------------------->

<!----------------------------------Button for Approve and Reject All------------------------------------------>
                <div class="btn-section">
                <form action="actions/Official Business/change_status.php" method="POST">
                <input type="hidden" name="Approve" value="approved">
                <button type="submit" name="approve_all" class="approve-btn">Approve All</button>
                </form>

                <form action="actions/Official Business/change_status.php" method="POST">
                <!-- <input type="hidden" name="status" value="rejected"> -->
                <button type="submit" name="reject_all" class="reject-btn">Reject All</button>
                </form>
                </div>
<!--------------------------------End Button for Approve and Reject All---------------------------------------->   

<!--------------------------------------------Syntax and Bootstrap class for table------------------------------------------------>
        <form action="actions/Official Business/approve_reject.php" method="POST">
                <div class="row">
                    <div class="col-12 mt-2">
                        <input type="hidden" id="check_id" name="id_check" value="<?php echo $row['id']?>">
                              <div class="table-responsive" style="height: 400px;">
                                    <table id="order-listing" class="table" style="">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">ID</th>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Company Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Location</th>
                                                <th>File Attachment</th>
                                                <th>Reason</th>
                                                <th style="display: none;">View Button</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                            $conn = mysqli_connect("localhost","root","","hris_db");

                                            $query = "SELECT
                                            emp_official_tb.id,
                                            employee_tb.empid,
                                            CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                            ) AS `full_name`,
                                            emp_official_tb.company_name,
                                            emp_official_tb.str_date,
                                            emp_official_tb.end_date,
                                            emp_official_tb.start_time,
                                            emp_official_tb.end_time,
                                            emp_official_tb.location,
                                            emp_official_tb.file_upl,
                                            emp_official_tb.reason,
                                            emp_official_tb.status
                                        FROM
                                            employee_tb
                                        INNER JOIN emp_official_tb ON employee_tb.empid = emp_official_tb.employee_id;";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td style="display: none;"><?php echo $row['id'];?></td>
                                                <td><?php echo $row['empid'];?></td>
                                                <td><?php echo $row['full_name'];?></td>
                                                <td><?php echo $row['company_name'];?></td>
                                                <td><?php echo $row['str_date'];?></td>
                                                <td><?php echo $row['end_date'];?></td>
                                                <td><?php echo $row['start_time'];?></td>
                                                <td><?php echo $row['end_time'];?></td>
                                                <td><?php echo $row['location'];?></td>
                                                <?php if(!empty($row['file_upl'])): ?>
                                                <td>
                                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download">Download</button>
                                                </td>
                                                <?php else: ?>
                                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                                <?php endif; ?>
                                                <td style="display: none;"><?php echo $row['reason'];?></td>
                                                <td>
                                                <a href="" class="btn btn-primary showbtn" data-bs-toggle="modal" data-bs-target="#viewmodal">View</a>   
                                                <td <?php if ($row['status'] == 'Approved') {echo 'style="color:green;"';} elseif ($row['status'] == 'Rejected') {echo 'style="color:red;"';} ?>><?php echo $row['status']; ?></td>
                                                <td>
                                                <?php if ($row['status'] === 'Approved' || $row['status'] === 'Rejected'): ?>
                                                  <button type="submit" class="btn btn-outline-success viewbtn" name="btn_approve" style="display: none;" disabled>
                                                    Approve
                                                  </button>
                                                  <button type="submit" class="btn btn-outline-danger viewbtn" name="btn_reject" style="display: none;" disabled>
                                                    Reject
                                                  </button>
                                                <?php else: ?>
                                                  <button type="submit" class="btn btn-outline-success viewbtn" name="btn_approve">
                                                    Approve
                                                  </button>
                                                  <button type="submit" class="btn btn-outline-danger viewbtn" name="btn_reject">
                                                    Reject
                                                  </button>
                                                <?php endif; ?>
                                                </td>
                                            </tr>
                                                 <?php
                                                    } 
                                                  ?>
                                    </table>
                                </div>
                            </div>
                        </div><!-----Close tag of row class------->
                    </form>  
<!------------------------------------------End Syntax and Bootstrap class for table---------------------------------------------->

                    </div><!------Main Panel Close Tag-------->
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
               $('.showbtn').on('click', function(){
                 $('#viewmodal').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#view_reason1').val(data[10]);
               });
             });
</script>
<!---------------------------------End ng Script para lumabas ang modal------------------------------------------>


<!------------------------------------Script para sa download modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download').modal('show');
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
<!---------------------------------End ng Script para download modal------------------------------------------>


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



<!-----------------------Script para sa automatic na pagdisapper ng alert message------------------------------->
<!-- <script>
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 2000);
</script> -->
<!---------------------End Script para sa automatic na pagdisapper ng alert message------------------------------>

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
<script src="js/official_emp.js"></script>
</body>
</html>