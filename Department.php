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
    <link rel="stylesheet" href="css/dept.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">   

    <!-- Para sa datatables -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
        <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- Para sa datatables END -->

    <title>Add New Department</title>
</head>
<body>
    
<style>
    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 289px;
        margin-left:-35px;
    }

    .sidebars ul{
       line-height:50px;
        height:100%;
    }

    .sidebars .first-ul{
       
    }

    .sidebars ul li ul li{
        width: 100%;
    }
</style>

<header>
<?php include 'header.php';
?>
</header>

    <!-- Modal -->
<div class="modal fade" id="add_deptMDL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action = "Data Controller/Department/insertcode.php" method="POST">
        <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Department</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- Modal header END -->
        <div class="modal-body">
                
                    <div class="mb-3">
                        <label for="adddept" class="col-form-label fs-6">Department Name :</label>
                        
                        <div class="input-group mb-3">
                            <input type="text" name="name_dept" class="form-control" id="id_Department" required>
                            <span class="input-group-text" id="basic-addon2">Department</span>
                        </div>
                    </div>
                
        </div> <!-- Modal Body END -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Department</button>
                </div> <!-- Modal footer END -->
        </div> <!-- Modal content END -->
    </form>
  </div> <!-- Modal DIALOg END -->
</div> <!-- Modal END -->


<!-------------------------------------------------------------------DELETE DEPT INFO MODAL-------------------------------------------------------->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Department/delete.php" method="POST">
      <div class="modal-body">

        <input type="hidden" name="delete_id" id="delete_id">
        <input type="hidden" name="designation" id="designate">

        <h4>Do you want to delete?</h4>

      </div> <!--Modal body div close tag-->
      <div class="modal-footer">
        <button type="submit" name="delete_data" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>


    </div>
  </div>
</div>
<!---------------------------------------------------END OF DELETE DEPT INFO MODAL------------------------------------------------------------------->


<div class="container mt-3">
    <div class="">

        <div class="card border-light" style="box-shadow: 10px 10px 10px 8px #888888; position:absolute; right:100px; bottom: 80px; width:75%; height:75%;" >
            <div class="card-header">
                
                
            </div> <!-- CARD Header END -->

            <div class="card-body">

            <div class="row">
                    <div class="col-6">
                        <h2 class="display-5">Department Records</h2>
                    </div>
                    <div class="col-6 mt-1 text-end">
                        <!-- Button trigger modal -->
                        <button class="btn_dept" data-bs-toggle="modal" data-bs-target="#add_deptMDL">
                            Add Department
                        </button>
                    </div>
            </div> <!-- Row END -->

                   <!-- ------------------para sa message na sucessful START -------------------->
                   <?php

                        if (isset($_GET['msg'])) {
                            $msg = $_GET['msg'];
                            echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            '.$msg.'
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }


                        ?>
                        <!-------------------- para sa message na sucessful ENd --------------------->


                        <!----------------------para sa message na error START --------------------->
                        <?php
                            if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            '.$error.'
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }

                    ?>
                        <!-------------------- para sa message na error ENd --------------------->

                    <div class="table-responsive mt-5">
                                      
                        <form action="departmentEmployee.php" method="post">
                                <input id="id_deptname_tb" name="name_deptID_tb" type="text" style="display: none;">
                                <input id="id_textdept" name="name_deptname_tb" type="text" style="display: none;">
                        <table id="order-listing" class="table" >
                            <thead >

                                <tr> 
                                        <th style= 'display: none;'> ID  </th>  
                                        <th> Department  </th>
                                        <th>Total Employee</th>
                                        <th>Action</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'config.php';

                                    // Query the department table to retrieve department names
                                    $dept_query = "SELECT col_ID,col_deptname FROM dept_tb";
                                    $dept_result = mysqli_query($conn, $dept_query);

                                    // Generate the HTML table header


                                    // Loop over the departments and count the employees
                                    while ($dept_row = mysqli_fetch_assoc($dept_result)) {
                                        $dept_id = $dept_row['col_ID'];
                                        $dept_name = $dept_row['col_deptname'];
                                        $emp_query = "SELECT COUNT(*) as count FROM employee_tb WHERE department_name = '$dept_id'";
                                        $emp_result = mysqli_query($conn, $emp_query);
                                        $emp_row = mysqli_fetch_assoc($emp_result);
                                        $emp_count = $emp_row['count'];

                                        // Generate the HTML table row
                                        echo "<tr>
                                                <td style= 'display: none;'>$dept_id</td>
                                                <td>$dept_name</td>
                                                <td>$emp_count</td>
                                                <td>
                                                    <button type='submit' name='view_data' class= 'border-0 viewbtn' title = 'View' style=' background: transparent;'>
                                                            <img src='icons/visible.png' alt='...'>
                                                    </button>
                                                    <button type='button' class= 'border-0 editbtn' title = 'Edit' data-bs-toggle='modal' data-bs-target='#update_deptMDL' style=' background: transparent;'>
                                                            <img src='icons/editing.png' alt='...'>
                                                    </button>
                                                    <button type='button' class= 'border-0 deletebtn' title = 'Delete' data-bs-toggle='modal' data-bs-target='#deletemodal' style=' background: transparent;'>
                                                            <img src='icons/delete.png' alt='...'>
                                                        </a>
                                                    </button> 
                                                </td>
                                            </tr>";
                                    }

                                    // Close the HTML table

                                    // Close the database connection
                                    mysqli_close($conn);
                                ?>
                            </tbody>
                        </form>   
                    </table>        
                </div> <!--table my-3 end-->   
                    <!-- Modal UPDATE DATA -->
                    <div class="modal fade" id="update_deptMDL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action = "actions/Department/update.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Department Name</h1>
                                        <input type="text" id="id_colId" name="name_id" style= "display: none;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> <!-- Modal header END -->
                                    <div class="modal-body">
                                    
                                        <div class="mb-3">
                                            <label for="adddept" class="col-form-label fs-6">Department Name :</label>
                                            
                                            <div class="input-group mb-3">
                                                <input type="text" id="id_Editdeptname" name="name_Editdept" class="form-control" id="id_Department" required>
                                            </div>
                                        </div>
                                    
                                    </div> <!-- Modal Body END -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="updatedata" class="btn btn-primary">Save Changes</button>
                                    </div> <!-- Modal footer END -->
                                </div> <!-- Modal content END -->
                            </form>
                        </div> <!-- Modal DIALOg END -->
                    </div> <!-- Modal END -->



                    
        </div>  <!-- CARD END -->

    </div> <!-- Jumbptron End -->
</div> <!-- Container End -->

    



<!-- para sa datatable -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<script src="bootstrap js/data-table.js"></script>  <!-- < Custom js for this page  -->
<!-- para sa datatable  END-->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


<!---------------------------------------Script sa pagpop-up ng modal para madelete--------------------------------------------->          
<script>
            $(document).ready(function (){
                $('.deletebtn').on('click' , function(){
                    $('#deletemodal').modal('show');


                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);
                    $('#designate').val(data[2]);
                    

                });
            });
        </script>
<!---------------------------------------End Script sa pagpop-up ng modal para madelete--------------------------------------------->

    <script> //FOR UPDATE TRANSFER MODAL 
        $(document).ready(function(){
                                $('.editbtn').on('click', function(){
                                    $('#update_deptMDL').modal('show');
                                    $tr = $(this).closest('tr');

                                    var data = $tr.children("td").map(function () {
                                        return $(this).text();
                                    }).get();

                                    console.log(data);
                                    //id_colId
                                    $('#id_colId').val(data[0]);
                                    $('#id_Editdeptname').val(data[1]);
                                });
                            });
            //FOR UPDATE TRANSFER MODAL END
    </script> 

    <script> //FOR VIEW TRANSFER MODAL 
            $(document).ready(function(){
                                    $('.viewbtn').on('click', function(){
                                        $('#IDview_deptMDL').modal('show');
                                        $tr = $(this).closest('tr');

                                        var data = $tr.children("td").map(function () {
                                            return $(this).text();
                                        }).get();

                                        console.log(data);
                                        //id_colId
                                        $('#id_textdept').val(data[1]);//deptname
                                        $('#id_deptname_tb').val(data[0]);//deptID
                                    });
                                });
            //FOR VIEW TRANSFER MODAL END
        </script>
</body>
<script src="js/dept.js"></script>
</html>