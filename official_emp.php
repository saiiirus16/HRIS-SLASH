<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
}
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
</head>
<body>
    <header>
    <?php
        include 'header.php';
    ?>
    </header>
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
                            <div class="row">
                                <div class="col-6">
                                <label for="start" class="form-label">Start Date</label>
                                <input type="date" name="str_date" class="form-control" id="start_date" required>
                                </div>
                                <div class="col-6">
                                <label for="end" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" required>
                                 </div>
                            </div>

                                <div class="row" >
                                    <div class="col-6">
                                    <label for="timer_start" class="form-label">Start Time</label>
                                    <input type="time" name="str_time" class="form-control" id="start_time" required>
                                    </div>
                                    <div class="col-6">
                                    <label for="timer_end" class="form-label">End Time</label>
                                    <input type="time" name="end_time" class="form-control" id="end_time" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="locate" class="form-control" id="location_id" required>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" name="file_upload" class="form-control" id="inputGroupFile02" >
                                    <label class="input-group-text"  for="inputGroupFile02">Upload</label>
                                </div>

                                <div class="mb-3">
                                <label for="text_area" class="form-label">Reason</label>
                                <textarea class="form-control" name="text_reason" id="text_area"></textarea>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="savedata" class="btn btn-primary">Add</button>
                        </div>
                    </form> 

             </div>
        </div>
     </div>
<!--------------------------------------Modal End Here----------------------------------------------->

        <div class="main-panel mt-5" style="margin-left: 15%;">
            <div class="content-wrapper mt-5">
                <div class="card">
                    <div class="card-body">
                        
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
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                                <div class="table-responsive">
                                    <table id="order-listing" class="table">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Location</th>
                                                <th>File Attachment</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                                <?php
                                                    $conn = mysqli_connect("localhost","root","", "hris_db");

                                                    $query = "SELECT * FROM emp_official_tb";
                                                    $result = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    
                                                ?> 
                                            <tr>
                                                <td><?php echo $row['employee_id'];?></td>
                                                <td>Joseph</td>
                                                <td><?php echo $row['str_date'];?></td>
                                                <td><?php echo $row['end_date'];?></td>
                                                <td><?php echo $row['start_time'];?></td>
                                                <td><?php echo $row['end_time'];?></td>
                                                <td><?php echo $row['location'];?></td>
                                                <td><?php echo $row['file_upl'];?></td>
                                                <td><?php echo $row['reason'];?></td>
                                                <td> 
                                                <label class="  "><?php echo $row['status'];?> </label>
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





<!-----------------------Script para sa automatic na pagdisapper ng alert message------------------------------->
<script>
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 2000);
</script>
<!---------------------End Script para sa automatic na pagdisapper ng alert message------------------------------>

<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<!-- Custom js for this page-->
<script src="bootstrap js/data-table.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>