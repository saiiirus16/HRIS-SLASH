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
    <title>Work From Home - Request</title>
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
 <div class="modal fade" id="file_wfh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">WFH Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    
                    <form action="Data Controller/Wfh/wfh_insert.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                    <label for="Select_emp" class="form-label">Select Employee:</label>
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
                            </div>  <!--mb-3 end--->
                            
                                <div class="mb-3">
                                    <label for="company" class="form-label">Date</label>
                                    <input type="date" name="date_wfh" class="form-control" id="date_id" required>
                                </div>

                                <div class="mb-3">
                                    <label for="sched" class="form-label">Schedule Type</label>
                                    <input type="text" name="sched_type" class="form-control" id="sched_id" required>
                                </div>

                                <div class="form-group">
                                <label for="time_from_id">Time Range</label>
                                <div class="input-group mb-3">
                                    <input type="time" class="form-control" name="time_from" id="time_from_id">
                                    <span class="input-group-text">-</span>
                                    <input type="time" class="form-control" name="time_to" id="time_to_id">
                                </div>
                                </div>

                                <div class="mb-3 mt-2">
                                <label for="text_area" class="form-label">Request Description</label>
                                <textarea class="form-control" name="text_description" id="request_id"></textarea>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" name="file_upload" class="form-control" id="inputfile" >
                                    <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" name="add_wfh" id="submit-btn" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                    </form> 

             </div>
        </div>
     </div>
<!--------------------------------------Modal End Here----------------------------------------------->

<!------------------------------------------------View ng whole data Modal ---------------------------------------------------->

<div class="modal fade" id="view_wfh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Employee ID</label>
                            <input type="text" name="empid_view" class="form-control" id="view_empid" readonly>
                        </div>

                <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">Date</label>
                            <input type="text" name="date_viewing" class="form-control" id="view_date_id" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Schedule Type</label>
                            <input type="text" name="sched_viewing" class="form-control" id="view_sched" readonly>
                        </div>
                </div>

                <div class="form-group">
                        <label for="time_from_id" class="mt-2">Time Range</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="view_time_from" id="view_time_from_id" readonly>
                            <span class="input-group-text">-</span>
                            <input type="text" class="form-control" name="view_time_to" id="view_time_to_id" readonly>
                        </div>
                </div>

                <div class="mb-3">
                        <label for="" class="form-label">Request Description</label>
                        <input type="text" name="view_request" id="view_id_request" class="form-control" readonly></input>
                 </div>

                 <div class="mb-3">
                        <label for="" class="form-label">File Attachment</label>
                        <input type="text" name="file_viewing" class="form-control" id="view_file_id" readonly>
                  </div>

                  <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">Date File</label>
                            <input type="text" name="datefile_viewing" class="form-control" id="view_datefile" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Status</label>
                            <input type="text" name="status_viewing" class="form-control" id="view_status_id" readonly>
                        </div>
                    </div>

                </div> <!---Modal Body End Tag-->
        </div>
    </div>
</div>

<!------------------------------------------------End ng View Modal ---------------------------------------------------->

<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download_wfh" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Download PDF File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Wfh Request/download_wfh.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id" id="id_table">
        <input type="hidden" name="table_name" id="name_table">
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
<!---------------------------------------Download Modal End Here --------------------------------------->


<!------------------------------------Header and Button------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-5">
          <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">  
<!------------------------------------Header, Dropdown and Button------------------------------------------------->


<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Work From Home Request</h2>
                                </div>
                                <div class="col-6 mt-1 text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="file_overtime" data-bs-toggle="modal" data-bs-target="#file_wfh">
                                    File WFH
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
                                                <th>WFH Date</th>
                                                <th style="display: none;">Start Time</th>
                                                <th style="display: none;">End Time</th>
                                                <th style="display: none;">Schedule Type</th>
                                                <th>File Attachment</th>
                                                <th style="display: none;">Request Description</th>
                                                <th>Date Filed</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $conn = mysqli_connect("localhost","root","","hris_db");

                                        $query = "SELECT * FROM `wfh_tb`";
                                        $query_run = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($query_run)){
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td style="display: none;">ID</td>
                                                <td><?php echo $row['empid']?></td>
                                                <td><?php echo $row['wfh_date']?></td>
                                                <td style="display: none;"><?php echo $row['start_time']?></td>
                                                <td style="display: none;"><?php echo $row['end_time']?></td>
                                                <td style="display: none;"><?php echo $row['schedule_type']?></td>
                                                <?php if(!empty($row['upload_file'])):?>
                                                <td>
                                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download_dtr">Download</button>
                                                </td>
                                                <?php else: ?>
                                                <td>No File Attach</td> <!-- Show an empty cell if there is no file attachment -->
                                                <?php endif; ?>
                                                <td style="display: none;"><?php echo $row['reason']?></td>
                                                <td><?php echo $row['date_filed']?></td>
                                                <td><?php echo $row['status']?></td>
                                                <td>
                                                <a href="" class="btn btn-primary viewbtn" data-bs-toggle="modal" data-bs-target="#view_wfh">View</a> 
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
</div>


<!------------------------------------Script para lumabas ang download modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                 $('#download_dtr').modal('show');
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

<!------------------------------------Script para sa pag pop-up ng view modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.viewbtn').on('click', function(){
                 $('#view_dtr_modal').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#view_reason1').val(data[6]);
               });
             });
</script>
<!---------------------------------End ng Script para sa pag pop-up ng view modal------------------------------------------>


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
                   $('#input_id').val(data[0]);
               });
             });
        </script>
<!-----------------------------End Script para matest kung naseselect ba ang I.D------------------------------------->

<!------------------------------------Script para sa whole view data ng modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.viewbtn').on('click', function(){
                 $('#view_wfh').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#view_empid').val(data[1]);
                   $('#view_date_id').val(data[2]);
                   $('#view_time_from_id').val(data[3]);
                   $('#view_time_to_id').val(data[4]);
                   $('#view_sched').val(data[5]);
                   $('#view_emp_file').val(data[6]);
                   $('#view_id_request').val(data[7]);
                   $('#view_datefile').val(data[8])
                   var status = $tr.find('td:eq(9)').text();
                   $('#view_status_id').val(status);
               });
             });
             </script>
<!---------------------------------End ng Script whole view data ng modal------------------------------------------>


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