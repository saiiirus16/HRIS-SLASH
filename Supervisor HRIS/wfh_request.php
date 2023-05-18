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
    <link rel="stylesheet" href="css/wfh.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Work From Home Request</title>
</head>
<body>
    <?php
        include 'header.php';
    ?>

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


<!------------------------------------------------View ng whole data Modal ---------------------------------------------------->
<div class="modal fade" id="view_wfh_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" name="wfh_empid_view" class="form-control" id="wfh_empid_view_id" readonly>
                        </div>
                        <div class="col-6">
                            <label for="company" class="form-label">WFH Date</label>
                            <input type="date" name="wfh_date_view" class="form-control" id="wfh_date_view_id" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                              <label for="time_range" class="form-label mt-1">Time Range</label>
                              <div class="input-group mb-3">
                              <input type="time" class="form-control" name="wfh_from" id="wfh_time_from_id" readonly>
                              <span class="input-group-text">-</span>
                              <input type="time" class="form-control" name="wfh_time_to" id="wfh_time_to_id" readonly>
                          </div>
                      </div>

                    <div class="mb-3">
                        <label for="text_area" class="form-label">Reason</label>
                        <textarea class="form-control" name="view_wfh_reason" id="view_wfh_reason_id" readonly></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="view_wfh_upload" class="form-control" id="view_wfh_upload_id" readonly>
                        <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                    </div>

                    <div class="mb-3" style="display: none;">
                        <label for="text_area" class="form-label">Schedule Type</label>
                        <input type="text" class="form-control" name="view_wfh_sched_type" id="view_wfh_sched_type_id" readonly>
                    </div>

                  <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">Date File</label>
                            <input type="text" name="view_datefile" class="form-control" id="view_datefile_id" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Status</label>
                            <input type="text" name="view_wfh_status" class="form-control" id="view_wfh_status_id" readonly>
                        </div>
                    </div>

                </div> <!---Modal Body End Tag-->
        </div>
    </div>
</div>
<!------------------------------------------------End ng View Modal ---------------------------------------------------->

<!-----------------------------------Modal For Download starts here------------------------------------------>
<div class="modal fade" id="download_wfh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Download PDF File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="actions/Wfh Request/download_wfh.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
            <input type="hidden" name="table_id_wfh" id="id_table_wfh">
            <input type="hidden" name="table_name_wfh" id="name_table_wfh">
            <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_download_wfh" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!-------------------------------------Modal For Download end here------------------------------------------>

<div class="main-panel mt-5" style="margin-left: 15%;">
    <div class="content-wrapper mt-5">
        <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">

<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Work From Home Request List</h2>
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

<!----------------------------------Syntax for Dropdown button------------------------------------------>
<div class="official_panel">
            <div class="child_panel">
              <p class="empo_date_text">Employee</p>
                     <?php
                        include 'config.php';

                        // Fetch all values of empid and date from the database
                        $sql = "SELECT `empid` FROM `wfh_tb`";
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
                        $sql = "SELECT `status` FROM `wfh_tb`";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select_custom form-select-m' aria-label='.form-select-sm example' name='status_emp''>";
                        echo "<option value=''>Select Status</option>"; // Add a default option
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
                <form action="actions/Wfh Request/status_change.php" method="POST">
                <input type="hidden" name="Approve" value="approved">
                <button type="submit" name="approve_all" class="approve-btn">Approve All</button>
                </form>

                <form action="actions/Wfh Request/status_change.php" method="POST">
                <!-- <input type="hidden" name="status" value="rejected"> -->
                <button type="submit" name="reject_all" class="reject-btn">Reject All</button>
                </form>
        </div>
<!--------------------------------End Button for Approve and Reject All----------------------------------------> 

<form action="actions/Wfh Request/approval.php" method="POST">
        <div class="row">
            <div class="col-12 mt-2">
                <input type="hidden" id="check_id" name="id_check" value="<?php echo $row['id']?>">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th style="display: none;">Employee ID</th>
                                <th>WFH Date</th>
                                <th>Start Time</th>
                                <th >End Time</th>
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
                                wfh_tb.id,
                                employee_tb.empid,
                                wfh_tb.date,
                                wfh_tb.schedule_type,
                                wfh_tb.start_time,
                                wfh_tb.end_time,
                                wfh_tb.reason,
                                wfh_tb.file_attachment,
                                wfh_tb.status,
                                wfh_tb.date_file
                            FROM
                                employee_tb
                            INNER JOIN wfh_tb ON employee_tb.empid = wfh_tb.empid;";
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
                                <td style="display: none;"><?php echo $row['reason']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_wfh">Download</button>
                                </td>
                                <?php else: ?>
                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                                <td <?php if ($row['status'] == 'Approved') {echo 'style="color:green;"';} elseif ($row['status'] == 'Rejected') {echo 'style="color:red;"';} ?>><?php echo $row['status']; ?></td>
                                <td><?php echo $row['date_file']?></td>
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
              </div>
          </div>
      </div>


            </div>
        </div>
    </div>
</div><!---Main Panel Close Tag-->


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

<!------------------------------------Script para sa whole view data ng modal------------------------------------------------->
<!-- <script>
     $(document).ready(function(){
               $('.viewbtn').on('click', function(){
                 $('#view_wfh_modal').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#wfh_empid_view_id').val(data[1]);
                   $('#wfh_date_view_id').val(data[2]);
                   $('#wfh_time_from_id').val(data[3]);
                   $('#wfh_time_to_id').val(data[4]);
                   $('#view_wfh_reason_id').val(data[5]);
                   $('#view_wfh_upload_id').val(data[6]);
                   var status = $tr.find('td:eq(7)').text();
                   $('#view_wfh_status_id').val(status);
                   $('#view_datefile_id').val(data[8]);
               });
             });
             </script> -->
<!---------------------------------End ng Script whole view data ng modal------------------------------------------>

<!------------------------------Script para lumabas download ang modal--------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download_wfh').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#id_table_wfh').val(data[0]);
                   $('#name_table_wfh').val(data[2]);
               });
             });
</script>
<!-------------------------------End ng Script para lumabas download ang modal------------------------------------->

<!--------------------Script para lumabas ang warning message na PDF File lang inaallow---------------------------->
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
<!--------------------End ng Script para lumabas ang warning message na PDF File lang inaallow--------------------->

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