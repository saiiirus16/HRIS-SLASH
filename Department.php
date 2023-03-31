<?php
    session_start();
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
    <link rel="stylesheet" href="styles.css">

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


<div class="container mt-3">
    <div class="">

        <div class="card border-light" style="box-shadow: 10px 10px 10px 8px #888888; position:absolute; right:100px; bottom: 80px; width:75%; height:75%;" >
            <div class="card-header">
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
            </div> <!-- CARD Header END -->

            <div class="card-body">

                <div class="pnl_utop p-3 mb-2 bg-body-tertiary">
                        <h3 style= "font-size: 20px; font-weight: bold; font-family: 'Nunito', sans-serif; ">Company Departments</h3>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                                <div class="pnl_search" >
                                    <form action="" 
                                        style= "
                                            border: none;
                                            padding: 0;
                                            background-color: #ffffff;
                                                ">
                                        <input id="search_bar" type="text" placeholder="Search"
                                        style= "
                                                margin-left: 50px;
                                                width: 320px;
                                                border: 1px solid #adacac;
                                                border-radius: 5px;
                                                padding: 9px 4px 9px 40px;
                                                background: #FFFFFF url(icon/search.png) 
                                                no-repeat 13px center;
                                                ">
                                    </form>
                                </div> 
                    </div><!--COL-6 END-->   
                </div> <!--ROW END-->

                <div class="table table-responsive">
                    <form action="departmentEmployee.php" method="post">
                     <input id="id_deptname_tb" name="name_deptname_tb" type="text" style="display: none;">
                  <table id="data_table" class="table table-sortable table-striped table-hover caption-top">
                    <caption class="text-end">List of Company Department</caption>
                    <thead style="color: #787BDB;
                                font-size: 19px;">
                          <tr> <!--<img src="/icons/search.png" alt="Icon">--> 
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
                                    $emp_query = "SELECT COUNT(*) as count FROM employee_tb WHERE department_name = '$dept_name'";
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
                                                <button type='button' class= 'border-0' title = 'Delete' style=' background: transparent;'>
                                                    <a href='actions/Department/delete.php?col_ID=$dept_id' class='link-dark'>
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

    






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

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
                                        $('#id_textdept').val(data[1]);
                                        $('#id_deptname_tb').val(data[1]);
                                    });
                                });
            //FOR VIEW TRANSFER MODAL END
        </script>
</body>
<script src="javascript/dept.js"></script>
</html>