

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

    <div class="empList-container">
        <div class="empList-title">
            <h1>Employee List</h1>
        </div>
        <div class="empList-create-search">
            <a href="empListForm.php" class="empList-btn" title="Create New">Create New</a>

            <input class="employeeList-search" type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome" id="search"/>
        </div>
        <table id="empList-table" class="table table-hover">
                <thead>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Employee Type</th>
                    <th></th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody id="myTable">
                    <?php
                        $conn =mysqli_connect("localhost", "root", "" , "hris_db");
                        $stmt = "SELECT * FROM employee_tb";
                        $result = $conn->query($stmt);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "
                                <tr class='lh-1'>
                                <td style='font-weight: 400;'>".$row["empid"]. "</td>
                                <td style='font-weight: 400;'>".$row["fname"]. " " .$row["lname"]. "</td>
                                <td style='font-weight: 400;'>".$row["email"]. "</td>
                                <td style='font-weight: 400;'>".$row["contact"]. "</td>
                                <td style='font-weight: 400;'>".$row["role"]." <td>
                                <td style='font-weight: 400;'>Active</td>
                                <td class='tbody-btn' style='width:120px;'>
                                    <button class='tb-view' style='border:none;background-color:inherit; outline:none;'><a href='editempListForm.php?id=$row[id]' style='color:gray;'>View</span></a></button>
                                   
                                </td>
                            </tr>";
                            }
                        }
                    ?>
                </tbody>
        </table>
    </div>

    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>

    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#search').keyup(function(){
                search_table($(this).val());
            });

            function search_table(value){
                $('#myTable tr').each(function(){
                    var found = 'false';
                    $(this).each(function(){
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase())>= 0){
                            found = 'true';
                        }
                    });
                    if(found == 'true'){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            }
        });

    </script>
</body>
</html>