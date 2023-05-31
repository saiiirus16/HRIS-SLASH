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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/overtime.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Overtime - Employee</title>
</head>
<body>
<header>
     <?php
         include 'header.php';
     ?>
</header>

<style>
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

    .table{
         width: 99.6%;
    }

    .content-wrapper{
         width: 85%
    }
</style>

 <!------------------------------------Modal Start Here----------------------------------------------->
 <div class="modal fade" id="file_overtime" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Overtime Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    
                    <form action="Data Controller/Overtime Request/ot_insert.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
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
                            
                            <div class="mb-3">
                                <label for="company" class="form-label">Date</label>
                                <input type="date" name="date_choose" class="form-control" id="date_id" required onchange="checkSchedule()">
                            </div>

                            <div class="mb-3">
                                <label for="schedule" class="form-label">Work Schedule</label>
                                <input type="text" class="form-control" name="schedule" id="schedule_id" readonly>
                            </div>
                            
                            <div class="row" >
                                <div class="col-6">
                                    <label for="start" class="form-label">Start Time</label>
                                    <input type="time" name="time_start" class="form-control" id="start_time_id" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="end" class="form-label">End Time</label>
                                    <input type="time" name="time_end" class="form-control" id="end_time_id" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_from" class="form-label mt-1">Time Range</label>
                                <div class="input-group mb-3">
                                    <input type="time" class="form-control" name="time_from" id="time_from_id" readonly>
                                    <span class="input-group-text">-</span>
                                    <input type="time" class="form-control" name="time_to" id="time_to_id" onchange="min_hours()">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ot_hours" class="form-label">Overtime Hours</label>
                                <div class="input-group mb-3">
                                    <input type="time" class="form-control" name="total_overtime" id="ot_id" readonly>
                                    <span class="input-group-text">hrs</span>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <label for="text_area" class="form-label">Reason</label>
                                <textarea class="form-control" name="file_reason" id="view_reason"></textarea>
                            </div>

                                <div class="input-group mb-3">
                                    <input type="file" name="file_upload" class="form-control" id="inputfile" >
                                    <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                                </div>
                            </div> <!---Modal body close tag-->

                            <div class="modal-footer">
                            <button type="submit" name="add_overtime" id="overtime_add" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                    </form> 

             </div>
        </div>
     </div>
<!--------------------------------------Modal End Here----------------------------------------------->

<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download_ot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Download PDF File</h1>
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

<div class="modal fade" id="view_ot_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    <div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-5">
          <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">  
<!------------------------------------Main Panel of data table------------------------------------------------->


<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Overtime Request List</h2>
                                </div>
                                <div class="col-6 mt-1 text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="file_overtime" data-bs-toggle="modal" data-bs-target="#file_overtime">
                                    File Overtime
                                    </button>
                                </div>
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
               

<!------------------------------------------Syntax ng Table-------------------------------------------------->
<form action="" method="POST">
        <div class="row" >
            <div class="col-12 mt-5">
                <input style="display: none;" type="text" id="input_id" name="input">
                    <div class="table-responsive">
                        <table id="order-listing" class="table" >
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th>Employee ID</th>
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
                         $conn = mysqli_connect("localhost","root","","hris_db");
                         
                         $query = "SELECT
                         overtime_tb.id,
                         employee_tb.empid,
                         overtime_tb.date,
                         overtime_tb.work_schedule,
                         overtime_tb.time_in,
                         overtime_tb.time_out,
                         overtime_tb.out_time,
                         overtime_tb.ot_hours,
                         overtime_tb.total_ot,
                         overtime_tb.reason,
                         overtime_tb.file_attachment,
                         overtime_tb.status,
                         overtime_tb.date_filed
                         FROM
                            employee_tb
                         INNER JOIN overtime_tb ON employee_tb.empid = overtime_tb.empid;";
                         $result = mysqli_query($conn, $query);
                         while ($row = mysqli_fetch_assoc($result)){  

                         ?>

                         <tbody>
                            <tr>
                                <td style="display: none;"><?php echo $row['id']?></td>
                                <td><?php echo $row['empid']?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['time_in']?></td>
                                <td><?php echo $row['time_out']?></td>
                                <td><?php echo $row['total_ot']?></td>
                                <td style="display: none;"><?php echo $row['reason']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_ot">Download</button>
                                </td>
                                <?php else: ?>
                                <td>No File Attach</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                                <td><?php echo $row['status']?></td>
                                <td><?php echo $row['date_filed']?></td>
                                <td><a href="" class="btn btn-primary viewbtn" data-bs-toggle="modal" data-bs-target="#view_ot_modal">View</a></td>
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



<!------------------------------------Script for Checking date if may nabago------------------------------------------------->               
<script>
// function checkSchedule() {
//     var date = document.getElementById("date_id").value;

//     // AJAX request to check if there is a schedule for the selected date
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var schedule = this.responseText;
//             // Remove double quotes from schedule
//             schedule = schedule.replace(/"/g, "");
//             if (schedule == "no schedule") {
//                 alert("Sorry, you don't have a schedule on that date.");
//                 document.getElementById("schedule_id").value = "";
//             } else {
//                 document.getElementById("schedule_id").value = schedule;

//                 // Parse the schedule value to get the time out
//                 var timeOut = schedule.split(' - ')[1];

//                 // Set the value of the time_from_id input field to the time out
//                 document.getElementById("time_from_id").value = timeOut;
//             }
//         }
//     };
//     xhttp.open("POST", "check_schedule.php", true);
//     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhttp.send("date=" + date);
// }

function checkSchedule() {
    var date = document.getElementById("date_id").value;
    var addButton = document.getElementById("overtime_add");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if(response.error){
                alert(response.message);
                document.getElementById("schedule_id").value = '';
                document.getElementById("start_time_id").value = '';
                document.getElementById("end_time_id").value = '';
                document.getElementById("time_from_id").value = '';
                addButton.disabled = true; // disable the Add button
            }else{
                document.getElementById("schedule_id").value = response.schedule;
                document.getElementById("start_time_id").value = response.start_time;
                document.getElementById("end_time_id").value = response.end_time;
                document.getElementById("time_from_id").value = response.end_time;
                addButton.disabled = false; // enable the Add button
            }
        }
    };
    xhttp.open("POST", "actions/Overtime Request/check_schedule.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("date=" + date);
}
</script>
<!------------------------------------End Script for Checking date if may nabago-------------------------------------------------> 

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


<script src="js/overtime.js"></script>
<!-- End custom js for this page-->
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


</body>
</html>