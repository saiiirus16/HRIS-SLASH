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

include_once 'config.php';

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Employee data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
    $alertStyle = 'style="font-size: 20px;"'; // add this line to set the font-size
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


    <link rel="stylesheet" href="css/dtRecords.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Daily Time Records</title>
</head>
<body>
<header>
    <?php
        include 'header.php';
    ?>
</header>

<style>
    .dl_excel:hover{
        color: white;
    }

    .pagination{
        margin-right: 78px !important;

        
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
<!-------------------------------------------- Modal Start Here ---------------------------------------------------------->
<div class="modal fade" id="upload_dtr_btn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DTR Correction Application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Daily Time Records/import.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="input-group mb-3">
                 <input type="file" name="file" class="form-control" id="inputGroupFile02">
                 <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
          </div>
      </div> <!--------Modal body div close tag--------->
      </form>
    </div>
  </div>
</div>
<!-------------------------------------------- Modal End Here ---------------------------------------------------------->


<!------------------------------------------------- Header ------------------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 15%; position: absolute; top:0;">
        <div class="content-wrapper mt-4" style="background-color: #f4f4f4">
          <div class="card mt-3" style=" width: 1550px; height:790px; box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);">
            <div class="card-body">
                <div class="pnl_home">
              
                <p class="header_prgph_DTR" style="font-size: 25px; padding: 10px">Employee DTR Management</p>
                
                <div class="btn-section" style="margin-left:70px;">
                     <!-- Button trigger modal -->
                    <button class="up-btn" data-bs-toggle="modal" data-bs-target="#upload_dtr_btn">Upload DTR File</button>
                    <button class="down-btn" id="downloadBtn"><a href="actions/Daily Time Records/export.php" class="dl_excel" style="text-decoration:none;"></i>Download Excel</a></button>
                  </div>
                  </div>
<!------------------------------------------------- End Of Header -------------------------------------------> 

<!---------------------------------------- Display status message ------------------------------------------->
<?php if(!empty($statusMsg)){ ?>
            <div class="col-xs-12 mt-2">
                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
            </div>
            <?php } ?>
<!---------------------------------------End Display status message ------------------------------------------->

<!----------------------------------------select button and text input--------------------------------------->
<div class="container-select" style="">
            <div class="input-container">
              <p class="demm-text">Department</p>
              <?php
                        include 'config.php';

                        // Fetch all values of empid and date from the database
                        $sql = "SELECT `department` FROM `daily_time_records_tb`";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select-btn form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                        echo "<option value='Select All Department' default>Select Department</option>"; // Add a default option
                        while ($row = mysqli_fetch_array($result)) {
                        $department = $row['department'];
                        echo "<option value='$department'>$department</option>"; // Set the value to emp_id|date
                        }
                        echo "</select>";
                      ?>
                </div>
                
                <div class="input-container">
                <p class="demm-text">Employee</p>
                    <?php
                            include 'config.php';

                            // Fetch all values of empid and date from the database
                            $sql = "SELECT `employee_id` FROM `daily_time_records_tb`";
                            $result = mysqli_query($conn, $sql);

                            // Generate the dropdown list
                            echo "<select class='select-btn form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                            echo "<option value='Select All Employee' default>Select Employee</option>"; // Add a default option
                            while ($row = mysqli_fetch_array($result)) {
                            $employee_id = $row['employee_id'];
                            echo "<option value='$employee_id'>$employee_id</option>"; // Set the value to emp_id|date
                            }
                            echo "</select>";
                        ?>
                </div>

                <div class="input-container">
                <p class="demm-text">Month From</p>
                <input class="select-btn" type="date" name="" id="datestart" required>
                </div>
                <div class="input-container">
                <div class="notif">
                <p class="demm-text">Month To</p>
                <p id="validate" class="validation">End date must beyond the start date</p>
                </div>
                <input class="select-btn" type="date" id="enddate" onchange="datefunct()" required>
                </div>
                <button id="arrowBtn" style="background-color:black;"> &rarr; Apply Filter</button>
            </div>
<!----------------------------------------select button and text input--------------------------------------->




<!-------------------------------------------------TABLE START------------------------------------------->
                <div class="row">
                    <div class="col-12 mt-5 ">
                        <div class="table-responsive" style=" height: 500px;">
                            <table id="order-listing" class="table" style="width: 100%;">
                                <thead style="background-color: #ececec; ">
                                        <tr>
                                            
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Department</th>
                                            <th>Schedule Type</th>
                                            <th>Time Entry</th>
                                            <th>Time Out</th>
                                            <th>Total Hours</th>
                                            <th>Tardiness</th>
                                            <th>Undertime</th>
                                            <th>Overtime</th>
                                            <th>Download File</th>
                                        </tr>
                                    </thead>
                            <tbody>
                            <?php
                            include 'config.php';
                            $result = $conn->query("SELECT * FROM daily_time_records_tb ORDER BY id DESC");
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                            ?>
                                        <tr>
                                            <td><?php echo $row['employee_id'];?></td>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['date_records'];?></td>
                                            <td><?php echo $row['department'];?></td>
                                            <td><?php echo $row['schedule_type'];?></td>
                                            <td><?php echo $row['time_entry'];?></td>
                                            <td><?php echo $row['time_out'];?></td>
                                            <td><?php echo $row['total_hours'];?></td>
                                            <td><?php echo $row['tardiness'];?></td>
                                            <td><?php echo $row['undertime'];?></td>
                                            <td><?php echo $row['overtime'];?></td>
                                            <td> <!-- added download button/link -->
                                                <a href="actions/Daily Time Records/download.php?<?php echo http_build_query($row); ?>" class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                    <!-- <tr><td colspan="5">No member(s) found...</td></tr> -->
                                <?php
                            }
                            ?>
                            </tbody>
                            </table>
                         </div>
                      </div>
                  </div>
               </div>
            </div>
         </div>
     </div>
 </div>      
<!-------------------------------------------------TABLE END------------------------------------------->

<!------------------------------------------------MESSAGE FUNCTION START------------------------------------------->
     <script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
<!------------------------------------------------MESSAGE FUNCTION END------------------------------------------->
<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 4000);
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