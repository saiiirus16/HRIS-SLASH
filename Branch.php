<?php

session_start();

include ("config.php");

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
    <link rel="stylesheet" href="css/branch.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>Branch</title>

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

    .card-body{
        box-shadow: 10px 10px 10px 8px #888888;
    }

    .content-wrapper{
          width: 80%;
    }

    .table {
         width: 99.7%;
    }
</style>


<!------------------------------------------------------ADD NEW BRANCH MODAL-------------------------------------------------------->
<div class="modal fade" id="addnew_btn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Branch</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="Data Controller/Branch/insert.php" method="POST">
         <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <label for="branch_n" class="form-label">Branch Name</label>
                    <input type="text" name="branch_name" class="form-control" id="start_date" required>
                </div>
                <div class="col-6">
                    <label for="branch_a" class="form-label">Branch Address</label>
                    <input type="text" name="branch_address" class="form-control" id="end_date" required>
                </div>
            </div>

             <div class="row mt-2">
                <div class="col-6">
                     <label for="zip" class="form-label">Zip Code:</label>
                     <input type="number" name="zip_code" class="form-control" id="start_time" required>
                </div>
             <div class="col-6">
                     <label for="email" class="form-label">Email:</label>
                     <input type="email" name="email" class="form-control" id="end_time" required>
             </div>
                </div>

                  <div class="mb-3 mt-2">
                     <label for="tele_phone" class="form-label">Telephone:</label>
                     <input type="number" name="telephone" class="form-control" id="location_id" required>
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
<!-------------------------------------------------END OF ADD NEW BRANCH MODAL-------------------------------------------------------->

<!-------------------------------------------------------------------EDIT BRANCH INFO MODAL-------------------------------------------------------->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Branch Action/edit.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="update_id" id="update_id">
         <div class="row">
                <div class="col-6">
                    <label for="branch_n" class="form-label">Branch Name</label>
                    <input type="text" name="branch_name" class="form-control" id="update_branch_name" required>
                </div>
                <div class="col-6">
                    <label for="branch_a" class="form-label">Branch Address</label>
                    <input type="text" name="branch_address" class="form-control" id="update_branch_address" required>
                </div>
            </div>

             <div class="row mt-2">
                <div class="col-6">
                     <label for="zip" class="form-label">Zip Code:</label>
                     <input type="number" name="zip_code" class="form-control" id="update_branch_zip" required>
                </div>
             <div class="col-6">
                     <label for="email" class="form-label">Email:</label>
                     <input type="email" name="email" class="form-control" id="update_branch_email" required>
             </div>
                </div>

                  <div class="mb-3 mt-2">
                     <label for="tele_phone" class="form-label">Telephone:</label>
                     <input type="number" name="telephone" class="form-control" id="update_branch_telephone" required>
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
<!---------------------------------------------------END OF EDIT BRANCH INFO MODAL------------------------------------------------------------------->

<!-------------------------------------------------------------------DELETE BRANCH INFO MODAL-------------------------------------------------------->
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Row</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Branch Action/delete.php" method="POST">
      <div class="modal-body">

        <input type="hidden" name="delete_id" id="delete_id">

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
<!---------------------------------------------------END OF DELETE BRANCH INFO MODAL------------------------------------------------------------------->


<div class="main-panel mt-5" style="margin-left: 15%;">
        <div class="content-wrapper mt-5">
          <div class="card" style="width:1550px; height: 780px;">
            <div class="card-body">
            <div class="row">
                        <div class="col-6">
                            <h2>Branch</h2>
                        </div>
                        <div class="col-6 mt-2 text-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="add_new_btn" data-bs-toggle="modal" data-bs-target="#addnew_btn">
                        Add New
                        </button>
                        </div>
                    </div> <!--ROW END-->


<!-------------------------------------------------------MESSAGE ALERT------------------------------------------------------------------->
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

        ?>
<!------------------------------------------------------- END NG MESSAGE ALERT------------------------------------------------------------>


<!-------------------------------------------------------ERROR MESSAGE ALERT------------------------------------------------------------------->
<?php
    if (isset($_GET['error'])) {
        $err = $_GET['error'];
        echo '<div id="alert-message" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        '.$err.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>
<!------------------------------------------------------- END NG ERROR MESSAGE ALERT------------------------------------------------------------>

                        <!-- <div class="mt-3">
                                <label for="Select_emp" class="form-label">Filter by Branch:</label>
                                <?php // Eto ang Filter sa branch
                                    // include 'config.php';  

                                    // // Fetch all values of fname and lname from the database
                                    // $sql = "SELECT branch_name FROM branch_tb";
                                    // $result = mysqli_query($conn, $sql);

                                    // // Generate the dropdown list
                                    // echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='name_emp' style='width: 350px;'>";
                                    // while ($row = mysqli_fetch_array($result)) {
                                    //     $branchname = $row['branch_name'];
                                    //     echo "<option value='$branch_name'>$branchname</option>";
                                    // }
                                    // echo "</select>";
                                ?>

                            </div> -->




            <div class="row">
                <div class="col-12 mt-5">
                    <div class="table-responsive">
                        <table id="order-listing" class="table" >
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th>Branch Name</th>
                                <th>Branch Address</th>
                                <th>Zip Code</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php 
                            include "config.php";

                            $sql = "SELECT * FROM `branch_tb`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                         ?>
                                        <tr>
                                        <td style="display: none;"><?php echo $row['id']?></td>
                                        <td><?php echo $row['branch_name']?></td>
                                        <td><?php echo $row['branch_address']?></td>
                                        <td><?php echo $row['zip_code']?></td>
                                        <td><?php echo $row['email']?></td>
                                        <td><?php echo $row['telephone']?></td>
                                        <td>
                                                <button class='link-dark editbtn border-0'><i class='fa-solid fa-pen-to-square fs-5 me-3' title='EDIT'></i></button> 
                                                <button class='link-dark deletebtn border-0'><i class='fa-solid fa-trash fs-5 me-3' title='DELETE'></i></button> 
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
        </div>
    </div>
</div>
    


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
                    $('#update_branch_name').val(data[1]);
                    $('#update_branch_address').val(data[2]);
                    $('#update_branch_zip').val(data[3]);
                    $('#update_branch_email').val(data[4]);
                    $('#update_branch_telephone').val(data[5]);

                    

                });
            });
        </script>
<!----------------------------------------------End ng Script sa pagpop-up ng modal para maedit------------------------------------------------------->

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
                    

                });
            });
        </script>
<!---------------------------------------End Script sa pagpop-up ng modal para madelete--------------------------------------------->




    <!--Bootstrap Js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

    

</body>
</html>