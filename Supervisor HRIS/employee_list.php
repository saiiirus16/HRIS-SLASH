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
    <link rel="stylesheet" href="css/.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Overtime - Approver</title>
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




<div class="main-panel mt-5" style="margin-left: 15%;">
    <div class="content-wrapper">
        <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1300px; height:700px; border-radius:20px;">
            <div class="card-body">

                                            <div class="row">
                                                    <div class="col-6">
                                                        <h2>Employee List</h2>
                                                    </div>
                                                </div> <!--ROW END-->


                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <div class="table-responsive">
                                                    <table id="order-listing" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="display:none;">ID</th>
                                                                <th>Employee ID</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Contact</th>
                                                                <th>Department</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        include '../config.php';
                                                        $aprrover_ID = $_SESSION['empid'];
                                                        $query = "SELECT employee_tb.id,
                                                        CONCAT(
                                                            employee_tb.`fname`,
                                                            ' ',
                                                            employee_tb.`lname`
                                                        ) AS `full_name`,
                                                        employee_tb.empid,
                                                        employee_tb.address,
                                                        employee_tb.contact,
                                                        employee_tb.department_name,
                                                        employee_tb.email,
                                                        dept_tb.col_deptname
                                                        FROM employee_tb INNER JOIN dept_tb ON employee_tb.department_name = dept_tb.col_ID
                                                        WHERE employee_tb.`approver`= (SELECT empid FROM employee_tb WHERE empid = $aprrover_ID);";
                                                        $result = mysqli_query($conn, $query);
                                                        while($row = mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <td style="display:none;"><?php echo['id']?></td>
                                                                <td><?php echo $row['empid']?></td>
                                                                <td><?php echo $row['full_name']?></td>
                                                                <td><?php echo $row['email']?></td>
                                                                <td><?php echo $row['contact']?></td>
                                                                <td><?php echo $row['col_deptname']?></td>
                                                            </tr>
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