<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>Employee Information</title>
</head>
<body>
   
        <header>
            <?php include 'header.php';
            ?>
</header>
    
<div class="container mt-5" style="position:absolute; width: 100%; right: 250px; bottom: 50px; height: 80%;  box-shadow: 10px 10px 10px 8px #888888;">
    <div class="">
        <div class="card border-light">
            
<a href=""></a>
    

            <?php

                    if(isset($_POST['view_data'])){

                        $emp_dept = $_POST['name_deptname_tb'];
                        
                            echo "
                            <div class='card-header'>
                            <div class='row'>
                                <div class='col-6'>

                                    <h2 class='display-5'>";
                                    echo $emp_dept;
                                    echo"
                                    </h2>
                                </div> <!--first col-6 end-->
                                <div class='col-6 text-end' style=''>
                                    <a href='Department.php' class='btn btn-outline-danger'>Go back</a>
                                </div> <!--sec col-6 end-->
                            </div> <!--row end-->

                            </div> <!-- card-header end-->
                            <div class='card-body'>
                                <div class='table my-3 table-responsive '>
                                    <table id='data_table' class='table table-sortable table-striped table-hover caption-top'>
                                        <thead style='color: #787BDB;
                                                    font-size: 19px;'>
                                            <tr> 
                                                    <th> Employee ID </th>  
                                                    <th> Employee FullName  </th>
                                                    <th> Employee Department </th>                   
                                            </tr>
                                        </thead>
                                        <tbody>";
                                                include 'config.php';

                                                // Query the department table to retrieve department names
                                                $dept_query = "SELECT * FROM employee_tb WHERE department_name = '$emp_dept'";

                                                $result = mysqli_query($conn, $dept_query);

                                                // Generate the HTML table header

                                                // Loop over the departments and count the employees
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $fullname = $row['fname'] . ' ' . $row['lname'];

                                                    // Generate the HTML table row
                                                    echo "<tr>
                                                        <td>" . $row['empid'] . "</td>
                                                        <td>" . $fullname . "</td>
                                                        <td>" . $row['department_name'] . "</td>

                                                        </tr>";
                                                }

                                                // Close the HTML table

                                                // Close the database connection
                                                mysqli_close($conn);
                            echo "          
                                        </tbody>   
                                    </table>        
                                </div> <!--table my-3 end-->  
                            </div> <!--card Body END-->
                                ";
                    }
                ?>
        </div> <!-- card end-->
    </div> <!-- jumbotron end-->
</div> <!-- container end-->


<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>