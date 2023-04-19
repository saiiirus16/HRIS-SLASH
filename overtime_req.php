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
 <div class="modal fade" id="file_off_btn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Overtime Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    
                    <form action="" method="POST" enctype="multipart/form-data">
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
                                    <input type="date" name="date" class="form-control" id="date_id" required>
                                </div>


                                <div class="mb-3">
                                <label for="" class="form-label">Work Schedule</label>
                                <?php
                                    include 'config.php';

                                    // Fetch all dates from the empschedule_tb table
                                    $sql = "SELECT DISTINCT sched_from FROM empschedule_tb";
                                    $result = mysqli_query($conn, $sql);

                                    // If there is at least one date in the database, display it in a read-only input field
                                    if(mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $date = $row['sched_from'];
                                        echo "<input type='text' class='form-control' name='date' value='$date' readonly>";
                                    } else {
                                        echo "<p>No dates found in the database.</p>";
                                    }
                                ?>
                            </div>


                                <div class="row" >
                                    <div class="col-6">
                                    <label for="time_range" class="form-label mt-2">Time Range</label>
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
                                    <label class="input-group-text"  for="inputGroupFile02">Upload</label>
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



<!------------------------------------Header and Button------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-5">
          <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">  
<!------------------------------------Header, Dropdown and Button------------------------------------------------->


<!----------------------------------Class ng header including the button for modal---------------------------------------------->                    
                            <div class="row">
                                <div class="col-6">
                                    <h2>Overtime Request List</h2>
                                </div>
                                <div class="col-6 mt-1 text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="file_overtime" data-bs-toggle="modal" data-bs-target="#file_dtr_btn">
                                    File Overtime
                                    </button>
                                </div>
                            </div> <!--ROW END-->
<!----------------------------------End Class ng header including the button for modal-------------------------------------------->

<!------------------------------------Message alert------------------------------------------------->
<?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
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
                                <th>Date Filed</th>
                                <th>Employee ID</th>
                                <th>OT Date</th>
                                <th>Time</th>
                                <th>OT Hours</th>
                                <th>Reason</th>
                                <th>File Attachment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                         <tbody>
                            <tr>
                                <td style="display: none;">ID</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
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
               $('.showbtn').on('click', function(){
                 $('#viewmodal').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#view_emp_id').val(data[1]);
                   $('#view_emp_name').val(data[2]);
                   $('#view_emp_date').val(data[3]);
                   $('#view_emp_time').val(data[4]);
                   $('#view_emp_type').val(data[5]);
                   $('#view_employee_r').val(data[6]);
                   $('#view_emp_file').val(data[7]);
                   var status = $tr.find('td:eq(8) p').text();
                   $('#view_emp_stats').val(status);
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