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
            echo "<script> alert('hello'); </script>";
            exit();
        }
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $sql = "SELECT COUNT(*) AS employee_count FROM employee_tb";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $employee_count = $row["employee_count"];

    mysqli_close($conn);
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
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- Link to the MDI CSS file -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <!-- Import the MDI font files using @font-face -->
    <style>
    @font-face {
        font-family: 'Material Design Icons';
        font-style: normal;
        font-weight: 400;
        src: url('https://cdn.materialdesignicons.com/5.4.55/fonts/materialdesignicons-webfont.woff2?v=5.4.55') format('woff2'),
            url('https://cdn.materialdesignicons.com/5.4.55/fonts/materialdesignicons-webfont.woff?v=5.4.55') format('woff');
    }
    </style>
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <title>HRIS | Dashboard</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <style>
    body{
        overflow: hidden;
        background-color: #F4F4F4;
    }

    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 287px;
        margin-left:-16px;
        line-height:30px;
       
    }

    .sidebars ul li .hoverable{
        height:55px;
    }

    .sidebars ul{
        height:100%;
    }

    .sidebars .first-ul{
        line-height:60px;
        height:100px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }

    .card-body{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }

    .card-header{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }
</style> 

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
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query the attendances table to count the number of present employees with an empid
    $query = "SELECT COUNT(*) AS present_count FROM attendances WHERE Status = 'Present' AND empid IS NOT NULL";
    $results = mysqli_query($conn, $query);
    
    // Check for errors
    if (!$results) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Fetch the result and store it in a variable
    $rows = mysqli_fetch_assoc($results);
    $present_count = $rows["present_count"];
    
    // Close the connection
    mysqli_close($conn);

    ?>


<!-------------------------------------------Modal of Announce Start Here--------------------------------------------->
<div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Summary of Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
       <form action="Data Controller/Announcement/insert_announce.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="company" class="form-label">Title</label>
                            <input type="text" name="announce_title" class="form-control" id="announce_title_id" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="announce_by" class="form-label">Name</label>
                            <input type="text" name="announce_by" class="form-control" id="announce_by_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_announcement" class="form-label">Date</label>
                            <input type="date" name="announce_date" class="form-control" id="announce_date_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">Description</label>
                            <textarea class="form-control" name="announce_description" id="announce_description_id"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">File Attachment</label>
                            <input type="file" name="file_upload" class="form-control" id="inputfile" >
                        </div>

                    </div><!--Modal body Close tag--->
                    <div class="modal-footer">
                <button type="submit" name="add_announcement" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </form>

      </div>
    </div>
  </div>
</div>
<!-------------------------------------------Modal of Announce End Here---------------------------------------------> 

<!-------------------------------------------Modal of View Summary Start Here--------------------------------------------->
<div class="modal fade" id="view_summary" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Attachment</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include 'config.php';

                            $query = "SELECT * FROM announcement_tb";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['announce_date']?></td>
                                <td><?php echo $row['announce_title']?></td>
                                <td><?php echo $row['description']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_announcement">Download</button>
                                </td>
                                <?php else: ?>
                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                                <td><?php echo $row['name']?></td>
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div><!---Modal Body Close Tag-->

    </div>
  </div>
</div>
<!-------------------------------------------Modal of View Summary End Here--------------------------------------------->
    
<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download_announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Download PDF File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/DTR Correction/download_dtr.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id_announce" id="id_table_announce">
        <input type="hidden" name="table_name_announce" id="name_table_announce">
        <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_dl" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!---------------------------------------Download Modal End Here --------------------------------------->

    <div class="dashboard-container">
        <div class="dashboard-content">
            <div class="dashboard-title" >
                <h1>DASHBOARD</h1>
            </div>
            <div class="row" id="dashboard-contents">
                <div class="col-6 ml-3 mt-2">
                    <div class="employee-status-overview">
                        <div class="emp-status-title">
                            <p>Employee Status Overview</p>
                            <p>Real time status</p>
                            <div></div>
                        </div>
                        <div class="emp-status-container">
                            <div>
                                <input type="text" name="present" value="<?php echo $present_count; ?>" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="present" >Present</label>
                            </div>
                            <div>
                                <input type="text" name="absent" value="32" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="absent" >Absent</label>
                            </div>
                            <div>
                                <?php 
                                
                                    include 'config.php';
                                    // Query the attendances table to count the number of ON LEAVE employees with an empid
                                    $query = "SELECT COUNT(DISTINCT empid) AS num_employees
                                                FROM attendances
                                                Where `status` = 'On-Leave' 
                                                GROUP BY empid";
                                    $results = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($results) > 0) {
                                        $rows = mysqli_fetch_assoc($results);
                                        $Leave_count = $rows["num_employees"];
                                        }
                                    else{
                                        $Leave_count = 0;
                                    }


                                    // Fetch the result and store it in a variable
                                    
                                    
                                    // Close the connection
                                    mysqli_close($conn);
                                ?>
                                <input type="text" name="on_leave" value="<?php echo $Leave_count?>" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="on_leave" >On Leave</label>
                            </div>
                            <div>
                                <input type="text" name="wfh" value="19" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="wfh" >Working Home</label>
                            </div>
                            <div>
                                <input type="text" name="late" value="20" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="late" >Late Today</label>
                            </div>
                        </div>
                    </div>

                    <div class="emp-request-list-container mt-4">
                        <div class="emp-btn-container">
                            <div class="emp-request-btn">
                                <div>
                                    <button class="mb-2">Employee Request List <p>20</p></button>
                                    <div style="border: black 1px solid;"></div>
                                </div>
                                <div> 
                                    <button>Leave</button>
                                </div>
                                <div>      
                                    <button>Loans</button>
                                </div>
                                <div>    
                                    <button>Overtime</button>
                                </div>
                            </div>
                        </div>    
                        <div> 
                            <table class="table table-borderless ml-5 mt-3">
                                <thead>
                                    <th class="emp-table-adjust">Type of Request</th>
                                    <th>Requestor</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: 400">Vacation Leave</td>
                                        <td style="font-weight: 400">Cyrus De Guzman</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 400">Sick Leave</td>
                                        <td style="font-weight: 400">Cyrus De Guzman</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                </div>
                <div>
                    <div class="announcement-container">
                            <h3 class="mb-0 d-inline-block mt-2 ml-2">Announcement</h3>
                            <i class="mdi mdi-arrow-down-drop-circle float-right mt-2 mr-2" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#announcement_modal" style="cursor: pointer;">Add Announcement</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#view_summary" style="cursor: pointer;">View Summary</a>
                            </div>
                            <?php
                            include 'config.php';

                            $query = "SELECT * FROM announcement_tb";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <h4 class="mt-2 ml-2"><?php echo $row['announce_title']?></h4>
                            <p class="ml-2"><span style="color: #7F7FDD; font-style: Italic;"><?php echo $row['name']?></span> - <?php echo $row['announce_date']?></p>
                            <p class="ml-2"><?php echo $row['description']?></p>
                            <?php
                            }
                            ?>
                    </div><!--announce close tag-->
                    <div class="event-container mt-4">
                        <div class="event-title">
                            <div>
                                <p><span class="fa-regular fa-calendar-days" style="margin-right:10px;"></span> Events</p>
                            </div>
                            <div>
                                <p class="fa-solid fa-chevron-down"></p>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div> 
    </div>



<!------------------------------------Script para lumabas ang download modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download_announcement').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#id_table_announce').val(data[0]);
                   $('#name_table_announce').val(data[2]);
               });
             });
</script>
<!---------------------------------End ng Script para lumabas ang download modal------------------------------------------>

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
        



    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<!-- Custom js for this page-->
<script src="bootstrap js/data-table.js"></script>
<!-- End custom js for this page-->
    <script src="main.js"></script>
</body>
</html>