

<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    } else {
        // Check if the user has the role of "employee"
        if($_SESSION['role'] == 'employee'){
            // If the user has the role of "employee", log them out and redirect to the logout page
            session_unset();
            session_destroy();
            header("Location: logout.php");
            exit();
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

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>Employee List</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>
    <style>
    .email-col {
        width: 25% !important; /* adjust the width as needed */
    }
    #order-listing th.email-col,
    #order-listing td.email-col {
        text-align: left; /* optional, aligns text to the left */
    }
</style>

    <div class="empList-container">
        <div class="empList-title">
            <h1>Employee List</h1>
        </div>
        <div class="empList-create-search">
            <a href="empListForm.php" class="empList-btn" title="Create New">Create New</a>
        </div>

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
        </style>
        
        
        <div style="width: 95%; margin:auto; margin-top: 30px;">
        <table id="order-listing" class="table" style="width: 100%" >
                <thead>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th class="email-col">Email</th>
                    <th>Contact No.</th>
                    <th>Employee Type</th>
                    
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody id="myTable">
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "hris_db");
                        $stmt = "SELECT * FROM employee_tb";
                        $result = $conn->query($stmt);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='lh-1'>";
                                echo "<td style='font-weight: 400;'>" . $row["empid"] . "</td>";
                                echo "<td style='font-weight: 400;'>" . $row["fname"] . " " . $row["lname"] . "</td>";
                                echo "<td style='font-weight: 400;' class='email-col'>" . $row["email"] . "</td>";
                                echo "<td style='font-weight: 400;'>" . $row["contact"] . "</td>";
                                echo "<td style='font-weight: 400;'>" . $row["role"] . " </td>";
                                if ($row["status"] == "Active") {
                                    echo "<td style='font-weight: 400; color: blue;'>" . $row["status"] . "</td>";
                                } else {
                                    echo "<td style='font-weight: 400; color: red;'>" . $row["status"] . "</td>";
                                }
                                echo "<td class='tbody-btn' style='width:120px;'>";
                                echo "<button class='tb-view' style='border:none;background-color:inherit; outline:none;'><a href='editempListForm.php?empid=$row[empid]' style='color:gray;'>View</a></button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </tbody>
        </table>
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