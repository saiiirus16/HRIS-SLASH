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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/position.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>POSITION</title>
</head>
<body>
<header>
  <?php
    include 'header.php';

   ?>
</header>

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

    .card{
      box-shadow: 5px 8px 10px 0 rgba(0, 0, 0, 0.3), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
      width: 1500px;
      height: 780px;

    }

    body{
      overflow:hidden;
    }


</style>

<!------------------------------------------------------ADD NEW POSITION MODAL-------------------------------------------------------->
<div class="modal fade" id="addnew_btn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Position</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="Data Controller/Position/position_conn.php" method="POST">
      <div class="modal-body">
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Position</label>
            <input name="position_text" type="text" class="form-control" id="date_input" required>
        </div>

      </div> <!--Modal body div close tag-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="add_data" class="btn btn-primary">Add</button>
      </div>
      </form>


    </div>
  </div>
</div>
<!-------------------------------------------------END OF ADD NEW POSTION MODAL-------------------------------------------------------->

<!-------------------------------------------------------------------EDIT MODAL-------------------------------------------------------->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Position/update_data.php" method="POST">
      <div class="modal-body">

        <input type="hidden" name="update_id" id="update_id">

        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Position</label>
            <input name="position_text" id="update_position" type="text" class="form-control" required>
        </div>

      </div> <!--Modal body div close tag-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" name="update_data" class="btn btn-primary">Update</button>
      </div>
      </form>


    </div>
  </div>
</div>
<!---------------------------------------------------END OF EDIT MODAL------------------------------------------------------------------->

<!-------------------------------------------------------------------DELETE MODAL-------------------------------------------------------->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Row</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Position/delete.php" method="POST">
      <div class="modal-body">

        <input type="hidden" name="delete_id" id="delete_id">
        <input type="hidden" name="designation" id="designate">
        <h4>Do you want to delete?</h4>

      </div> <!--Modal body div close tag-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" name="delete_data" class="btn btn-primary">Yes</button>
      </div>
      </form>


    </div>
  </div>
</div>
<!---------------------------------------------------END OF DELETE MODAL------------------------------------------------------------------->

<!-----------------------------------------ETO ANG HEADER INCLUDING ANG DROP-DOWN-------------------------------------------------------->
<div class="main-panel mt-2" style="margin-left: 15%;">
        <div class="content-wrapper mt-5">
          <div class="card">
            <div class="card-body">
            <div class="row">
                        <div class="col-6">
                            <h2>Position</h2>
                        </div>
                        <div class="col-6 mt-1 text-end">
                        <!-- Button trigger modal -->
                          <button type="button" class="add_dtr_btn" data-bs-toggle="modal" data-bs-target="#addnew_btn">
                            Add New Position
                            </button>
                        </div>
                    </div> <!--ROW END-->

                    <!-- <div class="mt-3">
                    <label for="Select_emp" class="form-label">Filter by Position:</label>
                             <?php //Eto yung pangFilter sa Position
                                    // include 'Data Controller/Position/position_conn.php';

                                    // // Fetch all values of position from the database
                                    // $sql = "SELECT position FROM positionn_tb";
                                    // $result = mysqli_query($conn, $sql);

                                    // // Generate the dropdown list
                                    // echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='name_emp' style='width: 350px;'>";
                                    // while ($row = mysqli_fetch_array($result)) {
                                    //     $pos_ition = $row['position'];
                                    //     echo "<option value='$position'>$pos_ition</option>";
                                    // }
                                    // echo "</select>";
                              ?>
                     </div>
                     <br> -->
<!-------------------------------------------------------END NG HEADER------------------------------------------------------------------->

<!-------------------------------------------------------MESSAGE ALERT------------------------------------------------------------------->
<?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div id="alert-message" class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        '.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>



<!------------------------------------------------------- END NG MESSAGE ALERT------------------------------------------------------------>


<!-------------------------------------------------------MESSAGE ERROR ALERT------------------------------------------------------------------->
<?php
    if (isset($_GET['error'])) {
        $err = $_GET['error'];
        echo '<div id="alert-message" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        '.$err.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>
<!-------------------------------------------------------END MESSAGE ERROR ALERT------------------------------------------------------------------->

<!------------------------------------------------------THIS IS CODE FOR TABLE------------------------------------------------------------------->
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="table-responsive" style="overflow: hidden;">
                      <form action="View_Position.php" method="post">
                      <input type="hidden" id="id_position_name" name="name_position">
                        <table id="order-listing" class="table">
                        <thead>
                            <tr>
                            <th style="display: none;">ID</th>
                            <th>Position</th>
                            <th>Designation</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                include 'config.php';

                                // Query the department table to retrieve department names
                                $dept_query = "SELECT id, position FROM positionn_tb";
                                $dept_result = mysqli_query($conn, $dept_query);

                                // Generate the HTML table header


                                // Loop over the departments and count the employees
                                while ($dept_row = mysqli_fetch_assoc($dept_result)) {
                                    $pos_id = $dept_row['id'];
                                    $pos_name = $dept_row['position'];
                                    $emp_query = "SELECT COUNT(*) as count FROM employee_tb WHERE empposition = '$pos_name'";
                                    $emp_result = mysqli_query($conn, $emp_query);
                                    $emp_row = mysqli_fetch_assoc($emp_result);
                                    $emp_count = $emp_row['count'];

                                    // Generate the HTML table row
                                    echo "<tr>
                                            <td style= 'display: none;'>$pos_id</td>
                                            <td>$pos_name</td>
                                            <td>$emp_count</td>
                                            <td>

                                                <button type='submit'  name='view_data' class='link-dark editbtn border-0 viewbtn' title = 'View'><i class='fa-solid fa-eye fs-5 me-3'></i></button>
                                                <button type='button' class='link-dark editbtn border-0' data-bs-toggle='modal' data-bs-target='#editmodal'><i class='fa-solid fa-pen-to-square fs-5 me-3' title='edit'></i></button> 
                                                <button type='button' class='link-dark deletebtn border-0' data-bs-toggle='modal' data-bs-target='#deletemodal'><i class='fa-solid fa-trash fs-5 me-3 title='delete'></i></button> 
                                            </td>
                                        </tr>";
                                }

                                // Close the HTML table

                                // Close the database connection
                                mysqli_close($conn);
                            ?>
                        
                                  </tbody>
                                </table>
                              </form>
                        </div>
                    </div>
                </div>

            </div> <!--Main Panel Close Tag-->
        </div>
    </div>
</div>
<!-------------------------------------------------------END NG CODE SA TABLE------------------------------------------------------------------->

        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="bootstrap js/template.js"></script>
        <!-- Custom js for this page-->
        <script src="bootstrap js/data-table.js"></script>
        <!-- End custom js for this page-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper/1.14.6/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


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



<!----------------------------------------------Script sa pagpop-up ng modal para maedit------------------------------------------------------->        
        <script>
            $(document).ready(function (){
                $('.editbtn').on('click' , function(){
                    $('#editmodal').modal('show');


                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[0]);
                    $('#update_position').val(data[1]);
                    

                });
            });
        </script>
<!----------------------------------------------End ng Script sa pagpop-up ng modal para maedit------------------------------------------------------->

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
                                        //$('#id_textdept').val(data[1]);
                                        $('#id_position_name').val(data[1]);
                                    });
                                });
            //FOR VIEW TRANSFER MODAL END
</script>


</body>
</html>