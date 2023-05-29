<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/official_emp.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Official Business - Employee</title>
</head>
<body>
    <header>
    <?php
        include 'header.php';
    ?>
    </header>

    <style>

</style>
   <!------------------------------------Modal Start Here----------------------------------------------->
 <div class="modal fade" id="file_off_btn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Official Business Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    
                    <form action="Data Controller/Official Employee/official_conn.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                        <div class="mb-3" style="display: none;">
                            <label for="Select_emp" class="form-label">Employee Name</label>
                            <?php
                                include 'config.php';
                                    // Fetch all values of fname and lname from the database
                                    // $sql = "SELECT empid,
                                    //         CONCAT(
                                    //         `fname`,
                                    //         ' ',
                                    //         `lname`
                                    //         ) AS `full_name`
                                    //         FROM employee_tb";
                                    //         $result = mysqli_query($conn, $sql);
                                    //         $row = mysqli_fetch_assoc($result)
                                    // if(isset($_SESSION['empid'])){ // check if the empid key is set in the session array
                                    //     $empid = $_SESSION['empid'];
                                    // }else{
                                    //     $empid = 'Error'; // set default value to empty string if empid key is not set
                                    // }
                                    ?>
                            <input type="text" class="form-control" name="name_emp" value="<?php echo $_SESSION['empid'];?>" id="empid" readonly>
                        </div>  <!--mb-3 end--->
                            
                            <div class="mb-3">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control" id="location_id" required>
                                </div>


                            <div class="row">
                                <div class="col-6">
                                <label for="start" class="form-label">Start Date</label>
                                <input type="date" name="str_date" class="form-control" id="start_date" required>
                                </div>
                                <div class="col-6">
                                <label for="end" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" onchange = "datevalidate()" required>
                                 </div>
                            </div>

                                <div class="row" >
                                    <div class="col-6">
                                    <label for="timer_start" class="form-label mt-2">Start Time</label>
                                    <input type="time" name="str_time" class="form-control" id="start_time" required>
                                    </div>
                                    <div class="col-6">
                                    <label for="timer_end" class="form-label mt-2">End Time</label>
                                    <input type="time" name="end_time" class="form-control" id="end_time" onchange = "timevalidate()" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label mt-2">Location</label>
                                    <input type="text" name="locate" class="form-control" id="location_id" required>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" name="file_upload" class="form-control" id="inputfile" >
                                </div>

                                <div class="mb-3">
                                <label for="text_area" class="form-label">Reason</label>
                                <textarea class="form-control" name="text_reason" id="view_reason"></textarea>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="savedata" id="submit-btn" class="btn btn-primary">Add</button>
                        </div>
                    </form> 

             </div>
        </div>
     </div>
<!--------------------------------------Modal End Here----------------------------------------------->


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
        <div class="main-panel mt-5" style="margin-left: 15%;">
            <div class="content-wrapper mt-5">
                <div class="card">
                    <div class="card-body">
<!---------------------------------------Main Panel End Here --------------------------------------->
                        
<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Official Business</h2>
                                </div>
                                <div class="col-6 mt-1 text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="add_off_btn" data-bs-toggle="modal" data-bs-target="#file_off_btn">
                                    File Official Business
                                    </button>
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

<!---------------------------------------------Style to resize/design table------------------------------------------------------->
                        <style>
                        .card-body{
                            width: 102%;
                            box-shadow: 10px 10px 10px 8px #888888;
                        }

                        .table{
                            width: 100%;
                        }

                        .content-wrapper{
                            width: 90%
                        }
                        </style>
<!------------------------------------------End Style to resize/design table------------------------------------------------------>

<!--------------------------------------------Syntax and Bootstrap class for table------------------------------------------------>
                        <div class="row">
                            <div class="col-12 mt-5">
                                <div class="table-responsive" style="">
                                    <table id="order-listing" class="table">
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
                                            </tr>
                                        </thead>
                                        <?php 
                                            $conn = mysqli_connect("localhost","root","","hris_db");
                                            $employeeid = $_SESSION['empid'];

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
                                        INNER JOIN emp_official_tb ON employee_tb.empid = emp_official_tb.employee_id WHERE emp_official_tb.employee_id = $employeeid;";
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
                                                <td> 
                                                <label class=""><?php echo $row['status'];?></label>
                                                </td>
                                            </tr>
                                                 <?php
                                                    } 
                                                  ?>
                                    </table>
                                </div>
                            </div>
                        </div><!-----Close tag of row class------->
<!------------------------------------------End Syntax and Bootstrap class for table---------------------------------------------->

                    </div><!------Main Panel Close Tag-------->
                </div>
            </div>
        </div>



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

<!------------------------------------Script para lumabas download ang modal------------------------------------------------->
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
<!---------------------------------End ng Script para lumabas ang modal------------------------------------------>


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
<script src="js/official_emp.js"></script>
</body>
</html>