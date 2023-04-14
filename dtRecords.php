<?php
session_start();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
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
    <div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-4">
          <div class="card mt-3" style="width: 1550px; height:800px box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);">
            <div class="card-body">
                <div class="pnl_home">
                <a href="dashboard.php">Home</a>
                <p class="header_slash">\</p>
                <p class="header_prgph_DTR">EmployeeDTRManagement</p>
                
                <div class="btn-section">
                     <!-- Button trigger modal -->
                    <button class="up-btn" data-bs-toggle="modal" data-bs-target="#upload_dtr_btn">Upload DTR File</button>
                    <button class="down-btn" id="downloadBtn"><a href="actions/Daily Time Records/export.php" class="dl_excel"></i>Download Excel</a></button>
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
<div class="container-select">
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
            <button id="arrowBtn"> &rarr; Apply Filter</button>
          </div>
<!----------------------------------------select button and text input--------------------------------------->




<!-------------------------------------------------TABLE START------------------------------------------->
                <div class="row">
                    <div class="col-12 mt-5 ">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                        <tr>
                                            
                                            <th>Employee ID</th>
                                            <th>Name</th>
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
                            $result = $conn->query("SELECT * FROM daily_time_records_tb ORDER BY id DESC");
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                            ?>
                                        <tr>
                                            <td><?php echo $row['employee_id'];?></td>
                                            <td><?php echo $row['name'];?></td>
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




        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="bootstrap js/template.js"></script>
        <!-- Custom js for this page-->
        <script src="bootstrap js/data-table.js"></script>
        <!-- End custom js for this page-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>