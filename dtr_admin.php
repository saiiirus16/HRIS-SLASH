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
    <link rel="stylesheet" href="css/dtr_ad.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>DTR Correction - Admin</title>
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


<!------------------------------------Header and Button------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-5">
          <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">
                <div class="row">
                        <div class="col-6">
                            <h2>DTR Correction</h2>
                        </div>
                        </div>  
<!------------------------------------Header, Dropdown and Button------------------------------------------------->

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

<!----------------------------------Syntax for Dropdown button------------------------------------------>
    <div class="official_panel">
            <div class="child_panel">
              <p class="empo_date_text">Employee</p>
                     <?php
                        include 'config.php';

                        // Fetch all values of empid and date from the database
                        $sql = "SELECT `emp_id` FROM `emp_dtr_tb`";
                        $result = mysqli_query($conn, $sql);

                        // Generate the dropdown list
                        echo "<select class='select_custom form-select-m' aria-label='.form-select-sm example' name='name_emp''>";
                        echo "<option value=''>Select Employee</option>"; // Add a default option
                        while ($row = mysqli_fetch_array($result)) {
                        $emp_id = $row['emp_id'];
                        echo "<option value='$emp_id'>$emp_id</option>"; // Set the value to emp_id|date
                        }
                        echo "</select>";
                      ?>
            </div>

            <div class="child_panel">
              <p class="empo_date_text">Month From</p>
              <input class="select_custom" type="date" name="" id="datestart" required>
            </div>
            <div class="child_panel">
              <div class="notif">
              <p class="empo_date_text">Month To</p>
              <p id="validate" class="validation">End date must beyond the start date</p>
            </div>
              <input class="select_custom" type="date" id="enddate" onchange="datefunct()" required>
            </div>
            <button class="btn_go" id="id_btngo">Go</button>
          </div>
<!------------------------------End Syntax for Dropdown button------------------------------------------------->

<!----------------------------------Button for Approve and Reject All------------------------------------------>
                <div class="btn-section">
                <form action="actions/DTR Correction/update_status.php" method="POST">
                <input type="hidden" name="Approve" value="approved">
                <button type="submit" name="approve_all" class="approve-btn">Approve All</button>
                </form>

                <form action="actions/DTR Correction/update_status.php" method="POST">
                <!-- <input type="hidden" name="status" value="rejected"> -->
                <button type="submit" name="reject_all" class="reject-btn">Reject All</button>
                </form>
                </div>
<!--------------------------------End Button for Approve and Reject All---------------------------------------->                 

<!------------------------------------------Syntax ng Table-------------------------------------------------->
<form action="actions/DTR Correction/approval.php" method="POST">
        <div class="row" >
            <div class="col-12 mt-2">
                <input style="display: none;" type="text" id="input_id" name="input">
                    <div class="table-responsive">
                        <table id="order-listing" class="table" >
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Reason</th>
                                <th>File Attachment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                      <tbody>
                        <?php 

                            $conn = mysqli_connect("localhost","root","","hris_db");

                            $query = "SELECT
                            emp_dtr_tb.id,
                            employee_tb.empid,
                            CONCAT(
                                employee_tb.`fname`,
                                ' ',
                                employee_tb.`lname`
                            ) AS `full_name`,
                            emp_dtr_tb.date,
                            emp_dtr_tb.time,
                            emp_dtr_tb.type,
                            emp_dtr_tb.reason,
                            emp_dtr_tb.upl_file,
                            emp_dtr_tb.status
                        FROM
                            employee_tb
                        INNER JOIN emp_dtr_tb ON employee_tb.empid = emp_dtr_tb.emp_id;";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                         ?>
                         
                                        <tr>
                                        <td class="unique_id" style="display: none;"><?php echo $row['id']?></td>
                                        <td><?php echo $row['empid']?></td>
                                        <td><a href="" class="showbtn" data-bs-toggle="modal" data-bs-target="#viewmodal"><?php echo $row['full_name']?></a></td>
                                        <td><?php echo $row['date']?></td>
                                        <td><?php echo $row['time']?></td>
                                        <td><?php echo $row['type']?></td>
                                        <td><?php echo $row['reason']?></td>
                                        <td><?php echo $row['upl_file']?></td>
                                        <td> 
                                            <p data-status="<?php echo $row['status']?>"><?php echo $row['status']?></p>
                                        </td>
                                        <td>
                                        <button type="submit" name="approve_btn" class="btn btn-outline-success viewbtn">Approve</button>
                                        <button type="submit" name="reject_btn" class="btn btn-outline-danger viewbtn">Reject</button>
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


<!------------------------------------------------ Modal ---------------------------------------------------->

<div class="modal fade" id="viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" name="employee_id" class="form-control" id="view_emp_id" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="employee_name" class="form-control" id="view_emp_name" readonly>
                        </div>
                </div>

                <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">DATE</label>
                            <input type="date" name="employee_date" class="form-control" id="view_emp_date" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">TIME</label>
                            <input type="time" name="employee_time" class="form-control" id="view_emp_time" readonly>
                        </div>
                </div>

                <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">TYPE</label>
                            <input type="text" name="employee_type" class="form-control" id="view_emp_type" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Reason</label>
                            <input name="employee_r" id="view_employee_r" class="form-control" readonly></input>
                        </div>
                </div>

                <div class="row" >
                        <div class="col-6">
                            <label for="" class="form-label">FILE ATTACHMENT</label>
                            <input type="text" name="employee_file" class="form-control" id="view_emp_file" readonly>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Status</label>
                            <input type="text" name="employee_stats" class="form-control" id="view_emp_stats" readonly>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<!------------------------------------------------End ng Modal ---------------------------------------------------->



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
<!---------------------------------End ng Script para lumabas ang modal------------------------------------------>

<!---------------------------------Script to Change the value of status------------------------------------------>
<!-- <script>
    // Get the buttons
    const approveAllBtn = document.querySelector('.approve-btn');
    const rejectAllBtn = document.querySelector('.reject-btn');

    // Add event listeners to the buttons
    approveAllBtn.addEventListener('click', () => updateAllStatus('Approved'));
    rejectAllBtn.addEventListener('click', () => updateAllStatus('Rejected'));

    // Function to update the status of all entries in the database
    function updateAllStatus(status) {
        // Send an AJAX request to the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'actions/DTR Correction/update_status.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Reload the page to show the updated data
                location.reload();
            } else {
                console.error(xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send('status=' + status);
    }
</script> -->
<!-------------------------------End Script to Change the value of status---------------------------------------->


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