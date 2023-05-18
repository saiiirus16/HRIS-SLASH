
<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    }
 
    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "hris_db";

    $db = mysqli_connect($server, $user, $pass, $database);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="vendors/feather/feather.css">
        <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/employee.css"> 
    <title>HRIS | Employee List</title>
</head>

<style>
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        max-height: 450px;
        height: 450px;  
    }
    tbody {
        display: table;
        width: 100%;
    }
    tr {
        width: 100% !important;
        display: table !important;
        table-layout: fixed !important;
    }
    th, td {
        text-align: left !important;
        width: 14.28% !important;
    }

    body{
        overflow:hidden;
    }
</style>

    <header>
        <?php include("header.php")?>
    </header>

    <div class="attendance-container">
        <div class="attendance-content">
            <div class="attendance-title" style="margin-top: 25px; margin-left: 30px;">
                <h1 style="color: blue">Attendance</h1>
            </div>
            <div class="attendance-date form-group">
                <label for="" style="margin-right: 18px; margin-top: 10px; margin-left: 40px;">Date Range</label>

                <input type="date" class="form-control" name="" id="" style="width: 250px; height: 50px; margin-right: 30px;">
                <input type="date" class="form-control" name="" id="" style="width: 250px; height: 50px; ">

                <button>Go</button>
            </div>
            <div class="attendance-table">
            <div style="width: 99%; margin:auto; margin-top: 30px;">
                <table id="order-listing" class="table" style="width: 100%;">
                    <thead style="background-color: #f4f4f4;">
                        <th>Status</th>
                        <th>empid</th>
                        <th>Date</th>
                        <th>Time Entry</th>
                        <th>Time Out</th>
                        <th>Late</th>
                        <th>Undertime</th>
                        <th>Overtime</th>
                        <th>Total Work</th>
                        <th>Total Rest</th>
                        <th>Remarks</th>
                    </thead>
                    <tbody>
                        <?php 
                            include 'config.php';

                            $empid = $_SESSION['empid'];

                            $sql = "SELECT * FROM attendances WHERE empid = $empid";

                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <td style="font-weight: 400;"><?php echo $row['status']; ?></td>
                                    <td style="font-weight: 400;"><?php echo $row['empid']; ?></td>
                                    <td style="font-weight: 400;"><?php echo $row['date']; ?></td>
                                            <!-------- td  for time out ----------->
                                    <td 
                                        <?php 
                                            if ($row['status'] === 'LWOP'){
                                                echo 'style="font-weight: 400; text-align: center;"';
                                            }
                                            else{
                                                if($row['time_in'] === '00:00:00')
                                                {
                                                    echo 'style="color: #FF5D5E;" ';
                                                }
                                                else
                                                {
                                                    echo 'style="font-weight: 400;"';
                                                }
                                                
                                            }
                                        ?>
                                    > <!--close td -->
                                        <?php 
                                            echo $row['time_in']; 
                                        ?>
                                    </td>
                                            <!-------- td  for time out ----------->
                                    <td  
                                        <?php 
                
                                            if ($row['status'] === 'LWOP'){
                                                echo 'style="font-weight: 400; text-align: center;"';
                                            }
                                            else{
                                                if($row['time_out'] === '00:00:00')
                                                {
                                                    echo 'style="color: #FF5D5E;" ';
                                                }
                                                else
                                                {
                                                    echo 'style="font-weight: 400;"';
                                                }
                                                
                                            }
                                           
                                        ?>
                                    > <!--close td -->
                                        <?php 
                                            echo $row['time_out']; 
                                        ?>
                                    </td>
                                    
                                    <td style="font-weight: 400; color:red;"><?php echo $row['late']; ?></td>
                                    <td style="font-weight: 400; color: blue"><?php echo $row['early_out']; ?></td>
                                    <td style="font-weight: 400; color: orange;"><?php echo $row['overtime']; ?></td>
                                    <td style="font-weight: 400; color:green;"><?php echo $row['total_work']; ?></td>
                                    <td style="font-weight: 400; color:gray;"><?php echo $row['total_rest']; ?></td>
                                    <td 
                                        <?php 
                                        if ($row['status'] === 'LWOP'){
                                            echo 'style="font-weight: 400; text-align: center;"';
                                        }
                                        else{
                                            if($row['time_in'] === '00:00:00' || $row['time_out'] === '00:00:00')
                                            {
                                                echo 'style="color: #FF5D5E;  text-align: center;"';
                                            } 
                                            else{
                                                echo 'style="font-weight: 400; text-align: center;"';
                                            }
                                            
                                        }
                                            
                                            
                                        ?> 
                                    > <!--close td -->
                                        <?php
                                            if($row['status'] === 'LWOP'){
                                                echo 'N/A';
                                            }else{
                                                if($row['time_in'] === '00:00:00')
                                                {
                                                    echo 'NO TIME IN';
                                                }
                                            else if($row['time_out'] === '00:00:00')
                                                {
                                                    echo 'NO TIME OUT';
                                                }
                                            else
                                                {
                                                    echo 'N/A';
                                                }
                                            }
                                            
                                         ?>
                                    </td>
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


    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>

    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="bootstrap js/template.js"></script>
    <script src="bootstrap js/data-table.js"></script>

</body>
</html>