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
    <link rel="stylesheet" href="css/dept.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Department</title>


    <title>Add New Department</title>
</head>
<body>
    
<style>
    .header-container .header-type .user-name{
      margin-top:1px;
    }

    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 289px;
        margin-left:-16px;
       
    }

    .sidebars ul{
        height:100%;
    }

    .sidebars ul li .hoverable{
        height:55px;
    }


    .sidebars .first-ul{
        line-height:50px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }


    .card-body{
        width: 95%;
        overflow: hidden;
    }

    .table{
        width: 99.8%;
        
    }

</style>

<header>
<?php include 'header.php';
?>
</header>

<!-----------------------------------------------------Modal-------------------------------------------------->
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
<!-----------------------------------------------------Modal End-------------------------------------------------->


<!-----------------------------------------------Modal UPDATE DATA------------------------------------------------->
                    <div class="modal fade" id="update_deptMDL" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action = "actions/Department/update.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Department Name</h1>
                                        <input type="text" id="id_colId" name="name_id" style= "display: none;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> <!--Modal header END-->
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
                                    </div> <!--Modal footer END -->
                                </div>  <!--Modal content END--> 
                            </form>
                        </div> 
                    </div> 
<!-----------------------------------------------Modal UPDATE END------------------------------------------------->



                            <div class="main-panel mt-5" style="margin-left: 15%;">
                                <div class="content-wrapper mt-5">
                                    <div class="card">
                                        <div class="card-body" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1550px; height:800px; border-radius:20px;">
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



                                            <div class="row">
                                                <div class="col-12 mt-5">
                                                    <div class="table-responsive">
                                                    <form action="departmentEmployee.php" method="post">
                                                        <input id="id_deptname_tb" name="name_deptname_tb" type="text" style="display: none;">
                                                            <table id="order-listing" class="table">
                                                                <thead>
                                                                    <tr>
                                                                    <th style= 'display: none;'>ID</th>
                                                                    <th>Department</th>
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
                                                                        
                                                                    //    Loop over the departments and count the employees
                                                                        while ($dept_row = mysqli_fetch_assoc($dept_result)) {
                                                                            $dept_id = $dept_row['col_ID'];
                                                                            $dept_name = $dept_row['col_deptname'];
                                                                            $emp_query = "SELECT COUNT(*) as count FROM employee_tb WHERE department_name = '$dept_name'";
                                                                            $emp_result = mysqli_query($conn, $emp_query);
                                                                            $emp_row = mysqli_fetch_assoc($emp_result);
                                                                            $emp_count = $emp_row['count'];
                                                                    echo "<tr>    
                                                                        <td style= 'display: none;'>$dept_id</td>
                                                                        <td>$dept_name</td>
                                                                        <td>$emp_count</td>
                                                                        <td>
                                                                            <button type='submit' name='view_data' class='link-dark editbtn border-0 viewbtn' title = 'View'><i class='fa-solid fa-eye fs-5 me-3'></i></button>
                                                                            <button type='button' class='link-dark editbtn border-0' data-bs-toggle='modal' data-bs-target='#update_deptMDL'><i class='fa-solid fa-pen-to-square fs-5 me-3' title='Edit'></i></button> 
                                                                            <button type='button' class= 'link-dark border-0' title = 'Delete'><a href='actions/Department/delete.php?col_ID=$dept_id&dsgntn_count=$emp_count'></a><i class='fa-solid fa-trash fs-5 me-3 title='delete'></i>
                                                                            </button>
                                                                        </td>
                                                                        </tr>";
                                                                    }
                                        
                                                                        // Close the database connection
                                                                        mysqli_close($conn);
                                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                              </form>
                                                           </div>
                                                        </div>
                                                    </div><!--Row Class in Table Close tag-->

                                        </div><!--Main Panel Close tag-->
                                    </div>
                                </div>
                            </div>


<!-----------------------------------------------AJAX MODAL TO UPDATE ------------------------------------------------->
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
<!-----------------------------------------------AJAX MODAL TO UPDATE END------------------------------------------------->

<!-----------------------------------------------AJAX MODAL TO VIEW  ------------------------------------------------->
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
<!-----------------------------------------------AJAX MODAL TO VIEW END------------------------------------------------->    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script>
<!-- Custom js for this page-->
<script src="bootstrap js/data-table.js"></script>
<script src="javascript/dept.js"></script>
</body>
</html>