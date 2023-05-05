<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    } else {
        // Check if the user's role is not "admin"
        if($_SESSION['role'] != 'admin'){
            // If the user's role is not "admin", log them out and redirect to the logout page
            session_unset();
            session_destroy();
            header("Location: logout.php");
            echo "<script> alert('hello'); </script>";
            exit();
        }
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $sql = "SELECT COUNT(*) AS employee_count FROM employee_tb";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $employee_count = $row["employee_count"];

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>HRIS | Dashboard</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <style>
    body{
        overflow: hidden;
        background-color: #F4F4F4;
    }
    </style>


    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query the attendances table to count the number of present employees with an empid
    $query = "SELECT COUNT(*) AS present_count FROM attendances WHERE Status = 'Present' AND empid IS NOT NULL";
    $results = mysqli_query($conn, $query);
    
    // Check for errors
    if (!$results) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Fetch the result and store it in a variable
    $rows = mysqli_fetch_assoc($results);
    $present_count = $rows["present_count"];
    
    // Close the connection
    mysqli_close($conn);

    ?>

    

    <div class="dashboard-container">
        <div class="dashboard-content">
            <div class="dashboard-title" >
                <h1>DASHBOARD</h1>
            </div>
            <div class="row" id="dashboard-contents">
                <div class="col-6 ml-3 mt-2">
                    <div class="employee-status-overview">
                        <div class="emp-status-title">
                            <p>Employee Status Overview</p>
                            <p>Real time status</p>
                            <div></div>
                        </div>
                        <div class="emp-status-container">
                            <div>
                                <input type="text" name="present" value="<?php echo $present_count; ?>" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="present" >Present</label>
                            </div>
                            <div>
                                <input type="text" name="absent" value="32" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="absent" >Absent</label>
                            </div>
                            <div>
                                <input type="text" name="on_leave" value="11" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="on_leave" >On Leave</label>
                            </div>
                            <div>
                                <input type="text" name="wfh" value="19" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="wfh" >Working Home</label>
                            </div>
                            <div>
                                <input type="text" name="late" value="20" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: blue;"><?php echo $employee_count?> </span></p>
                                <label for="late" >Late Today</label>
                            </div>
                        </div>
                    </div>

                    <div class="emp-request-list-container mt-4">
                        <div class="emp-btn-container">
                            <div class="emp-request-btn">
                                <div>
                                    <button class="mb-2">Employee Request List <p>20</p></button>
                                    <div style="border: black 1px solid;"></div>
                                </div>
                                <div> 
                                    <button>Leave</button>
                                </div>
                                <div>      
                                    <button>Loans</button>
                                </div>
                                <div>    
                                    <button>Overtime</button>
                                </div>
                            </div>
                        </div>    
                        <div> 
                            <table class="table table-borderless ml-5 mt-3">
                                <thead>
                                    <th class="emp-table-adjust">Type of Request</th>
                                    <th>Requestor</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: 400">Vacation Leave</td>
                                        <td style="font-weight: 400">Cyrus De Guzman</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 400">Sick Leave</td>
                                        <td style="font-weight: 400">Cyrus De Guzman</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     </div>
                </div>
                <div>
                    <div class="announcement-container">

                    </div>
                    <div class="event-container mt-4">
                        <div class="event-title">
                            <div>
                                <p><span class="fa-regular fa-calendar-days" style="margin-right:10px;"></span> Events</p>
                            </div>
                            <div>
                                <p class="fa-solid fa-chevron-down"></p>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div> 
    </div>



        



    
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>