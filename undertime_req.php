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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/undertime.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Undertime Request - Employee</title>
</head>
<body>
<header>
     <?php
         include 'header.php';
     ?>
</header>

<style>
   
    .sidebars{
      height:110vh;
    
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
        margin-top: 150px;
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
<div class="modal fade" id="file_undertime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Undertime Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    
                    <form action="Data Controller/Undertime Request/under_request.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Select_emp" class="form-label">Employee Name</label>
                                <?php
                                    include 'config.php';
                                ?>
                                <input type="text" class="form-control" name="name_emp" value="<?php echo $_SESSION['empid'];?>" id="empid" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label for="company" class="form-label">Date</label>
                                <input type="date" name="date_undertime" class="form-control" id="date_id_undertime" required onchange="checkSchedule()">
                            </div>

                            <div class="form-group">
                                <label for="time_range" class="form-label mt-1">Time Range</label>
                                <div class="input-group mb-3">
                                    <input type="time" class="form-control" name="under_time_from" id="under_time_from_id" readonly>
                                    <span class="input-group-text">-</span>
                                    <input type="time" class="form-control" name="under_time_to" id="under_time_to_id" onchange="undertime_hours()">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ot_hours" class="form-label">Undertime Hours</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="total_undertime" id="under_id" readonly>
                                    <span class="input-group-text">hrs</span>
                                </div>
                            </div>

                            <div class="mb-3 mt-2">
                                <label for="text_area" class="form-label">Reason</label>
                                <textarea class="form-control" name="undertime_reason" id="view_under_reason"></textarea>
                            </div>

                                <div class="input-group mb-3">
                                    <input type="file" name="file_upload" class="form-control" id="inputfile" >
                                    <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                                </div>
                            </div> <!---Modal body close tag-->

                            <div class="modal-footer">
                            <button type="submit" name="add_undertime" id="undertime_add" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                    </form> 

             </div>
        </div>
     </div>
<!--------------------------------------Modal End Here----------------------------------------------->

<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download_undertime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Undertime Request/download_undertime.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id_undertime" id="id_table_undertime">
        <input type="hidden" name="table_name_undertime" id="name_table_undertime">
        <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_download_undertime" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!--------------------------------------------------Download Modal End Here---------------------------------------------------->

<!------------------------------------------------View ng whole data Modal ---------------------------------------------------->
<div class="modal fade" id="view_undertime_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" name="undertime_empid_view" class="form-control" id="undertime_empid_view_id" readonly>
                        </div>
                        <div class="col-6">
                            <label for="company" class="form-label">OT Date</label>
                            <input type="date" name="undertime_date_view" class="form-control" id="undertime_date_view_id" readonly>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                       <div class="col-6">
                            <label for="start" class="form-label">Start Time</label>
                            <input type="time" name="view_undertime_start" class="form-control" id="view_undertime_start_id" readonly>
                        </div>
                        <div class="col-6">
                           <label for="end" class="form-label">End Time</label>
                           <input type="time" name="view_undertime_end" class="form-control" id="view_undertime_end_id" readonly>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="ot_hours" class="form-label">Undertime Hours</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="view_total_undertime" id="view_total_undertime_id" readonly>
                            <span class="input-group-text">hrs</span>
                       </div>
                    </div>

                    <div class="mb-3">
                        <label for="text_area" class="form-label">Reason</label>
                        <textarea class="form-control" name="view_undertime_reason" id="view_undertime_reason_id" readonly></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="view_undertime_upload" class="form-control" id="view_undertime_upload_id" readonly>
                        <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                    </div>

                  <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">Date File</label>
                            <input type="text" name="view_datefiled" class="form-control" id="view_datefiled_id" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Status</label>
                            <input type="text" name="view_undertime_status" class="form-control" id="view_undertime_status_id" readonly>
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
                                    <h2>Undertime Request List</h2>
                                </div>
                                <div class="col-6 mt-1 text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="file_undertime" data-bs-toggle="modal" data-bs-target="#file_undertime">
                                    File Undertime
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
                    <div class="table-responsive">
                        <table id="order-listing" class="table" >
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th style="display: none;">Employee ID</th>
                                <th>Undertime Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Undertime Hours</th>
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
                         undertime_tb.id,
                         employee_tb.empid,
                         undertime_tb.date,
                         undertime_tb.start_time,
                         undertime_tb.end_time,
                         undertime_tb.total_undertime,
                         undertime_tb.file_attachment,
                         undertime_tb.reason,
                         undertime_tb.status,
                         undertime_tb.date_file
                         FROM
                            employee_tb
                         INNER JOIN undertime_tb ON employee_tb.empid = undertime_tb.empid;";
                         $result = mysqli_query($conn, $query);
                         while ($row = mysqli_fetch_assoc($result)){  
                         ?>
                         <tbody>
                            <tr>
                                <td style="display: none;"><?php echo $row['id']?></td>
                                <td style="display: none;"><?php echo $row['empid']?></td>
                                <td><?php echo $row['date']?></td>
                                <td><?php echo $row['start_time']?></td>
                                <td><?php echo $row['end_time']?></td>
                                <td><?php echo $row['total_undertime']?></td>
                                <td style="display: none;"><?php echo $row['reason']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_undertime">Download</button>
                                </td>
                                <?php else: ?>
                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                                <td><?php echo $row['status']?></td>
                                <td><?php echo $row['date_file']?></td>
                                <td><a href="" class="btn btn-primary viewbtn" data-bs-toggle="modal" data-bs-target="#view_undertime_modal">View</a></td>
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
function checkSchedule() {
    var date = document.getElementById("date_id_undertime").value;
    var addButton = document.getElementById("undertime_add");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if(response.error){
                alert(response.message);
                document.getElementById("under_time_from_id").value = '';
                addButton.disabled = true; // disable the Add button
            }else{
                document.getElementById("under_time_from_id").value = response.end_time;
                addButton.disabled = false; // enable the Add button
            }
        }
    };
    xhttp.open("POST", "actions/Undertime Request/schedule_check.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("date=" + date);
}
</script>
<!------------------------------------End Script for Checking date if may nabago-------------------------------------------------> 

<!------------------------------------Script para lumabas ang modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download_undertime').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#id_table_undertime').val(data[0]);
                   $('#name_table_undertime').val(data[2]);
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
                   $('#undertime_empid_view_id').val(data[1]);
                   $('#undertime_date_view_id').val(data[2]);
                   $('#view_undertime_start_id').val(data[3]);
                   $('#view_undertime_end_id').val(data[4]);
                   $('#view_total_undertime_id').val(data[5]);
                   $('#view_undertime_reason_id').val(data[6]);
                   $('#view_undertime_upload_id').val(data[7]);
                   var status = $tr.find('td:eq(8)').text();
                   $('#view_undertime_status_id').val(status);
                   $('#view_datefiled_id').val(data[9]);
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


<script src="js/undertime.js"></script>
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