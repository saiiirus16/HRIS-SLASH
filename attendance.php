
<?php
    session_start();
    if(isset($_SESSION['alert_msg'])){
        $alert_msg = $_SESSION['alert_msg'];
        echo "<script>alert('$alert_msg');</script>";
        unset($_SESSION['alert_msg']);
    }

    
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

 
    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "hris_db";

    $db = mysqli_connect($server, $user, $pass, $database);


    if(!empty($_GET['status'])){
        switch($_GET['status']){
            case 'succ':
                $statusType = 'alert-success';
                $statusMsg = 'Members data has been imported successfully.';
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
    }


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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List</title>
</head>
<script>
      // Function to display the current date in the specified format
      function displayCurrentDate() {
        // Get the current date
        const today = new Date();

        // Define the date format as "MM/DD/YYYY"
        const dateFormat = `${today.getMonth() + 1}/${today.getDate()}/${today.getFullYear()}`;

        // Update the content of the h1 element with the current date
        document.getElementById("current-date").innerHTML = `Today's date is <strong style=" color: rgb(154, 67, 224); ">${dateFormat}</strong>`;
      }
    </script>


<body onload="displayCurrentDate()">

<style>
    body{
        overflow: hidden;
    }

    .email-col {
        width: 25% !important; /* adjust the width as needed */
    }
    #order-listing th.email-col,
    #order-listing td.email-col {
        text-align: left; /* optional, aligns text to the left */
    }
    .pagination{
    border: black 1px solid !important;
    margin-right: 40px !important;
}

    #order-listing_pervious{
        height: 10px !important;
        background-color:red !important;
    }
    #order-listing_pervious a{
        font-size: 16px !important; 
    }
    .paginate_button {
        height: 60px !important;
    }
</style>

    <header>
        <?php include("header2.php")?>
    </header>

    <div class="attendace-container">
        <div class="attendance-title">
            <h1>Attendance</h1>
        </div>

        <div class="attendance-input">
            <div>
                <div class="att-emp">
                <?php
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";

                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT empid, fname, lname FROM employee_tb";
                        $result = mysqli_query($conn, $sql);

                        $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option value=' ". $row['empid'] . "'>". $row['empid'] . " ". " - ". " " .$row['fname']. " ".$row['lname']. "</option>";
                        }
                        ?>

                        <label for="emp">Select Employee
                        <select name="empname" id="" class="stat">
                            <option value disabled selected>Select Employee</option>
                            <?php echo $options; ?>
                        </select>
                        </label>
                </div>
              
                <div class="att-stat" >
                    <label for="Employee" >Status
                    <select name="" id="" class="custom-select" >
                        <option value="">All Status</option>
                    </select>   
                    </label>
                </div>
                

            </div>

            <div>
                <div class="att-range">                   
                        <label for="Employee">Date Range
                        <input type="date" name="" id="" placeholder="Start Date" style="padding:10px; ">
                        </label>
                </div>

                
                <input class="att-end" type="date" name="" id="" placeholder="End Date" style="padding:10px; ">
            </div>

            
                <div class="att-excel-input">
                    <form action="Data Controller/Attendance/attendanceController.php"  enctype="multipart/form-data" method="POST">
                            <input type="file" name="file" />
                            <input type="submit" value="Submit" name="importSubmit" class="btn btn-primary">
                    </form>
                </div>
          

        </div>

        <div id="att-listing" class="att-date">
            <h1 id="current-date"></h1>
        </div>
        

        <style>
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                max-height: 300px;
                height: 300px;
                
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

            .empid-width{
                width: 20% !important;
            }
        </style>
      
        <div style="width: 95%; margin:auto; margin-top: 30px;">
        <table id="order-listing" class="table" style="width: 100%;">
    <thead>
        <th>Status</th>
        <th class="empid-width">Employee ID</th>
        <th class="email-col">Name</th>
        <th>Date</th>
        <th>Time in</th>
        <th>Time out</th>
        <th>Late</th>
        <th>Undertime</th>
        <th>Overtime</th>
        <th>Total Work</th>
        <th>Total Rest</th>
        <th>Remarks</th>
    </thead>
    <tbody id="myTable" >
        <?php
        $result = $db->query("SELECT attendances.status, 
                                    attendances.empid,
                                    attendances.date,
                                    attendances.time_in,
                                    attendances.time_out,
                                    attendances.late,
                                    attendances.early_out,
                                    attendances.overtime,
                                    attendances.total_work,
                                    attendances.total_rest, 
                                    CONCAT(
                                                employee_tb.`fname`,
                                                ' ',
                                                employee_tb.`lname`
                                            ) AS `full_name`  
                                FROM attendances
                                INNER JOIN employee_tb ON employee_tb.empid = attendances.empid
                                ORDER BY date ASC");

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td style="font-weight: 400;"><?php echo $row['status']; ?></td>
                    <td class="empid-width" style="font-weight: 400;"><?php echo $row['empid']?></td>
                    <td class="email-col" style="font-weight: 400;"><?php echo $row['full_name']; ?> </td>
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
        } else{
            ?>
            <tr>
                <td colspan="11">No attendance found...</td>
            </tr>

        <?php
        }
        ?>
    </tbody>
</table>
    </div>

    
        <div class="att-export-btn">
         <p>Export options: <a href="excel-att.php" class="" style="color:green"></i>Excel</a><span> |</span> <button id="btnExport" style="background-color: inherit; border:none; color: red">Export to PDF</button></p>
         
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


    <!-- PDF -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>


    <script>
$(document).ready(function () {
    $("#btnExport").click(function () {
        $.ajax({
            url: "att-pdf.php",
            method: "POST",
            data: {format: 'pdf'},
            success: function(response){
                // Create a blob object from the PDF data returned by the server
                var blob = new Blob([response], {type: 'application/pdf'});
                // Generate a URL for the PDF blob object
                var url = URL.createObjectURL(blob);
                // Create a link element to download the PDF
                var link = document.createElement('a');
                link.href = url;
                link.download = "attendances.pdf";
                // Trigger the click event of the link element to start the download
                link.click();
            },
            error: function(){
                alert('Error generating PDF!');
            }
        });
    });
});
</script>

</body>
</html>