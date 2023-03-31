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
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
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
</style>

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
                        <a href="Data Controller/Branch/insert.php" class="add_new_btn">Add New</a>
                        </div>
                    </div> <!--ROW END-->


        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            '.$msg.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

        ?>

                        <div class="mt-3">
                                <label for="Select_emp" class="form-label">Filter by Branch:</label>
                                <?php
                                    include 'config.php';

                                    // Fetch all values of fname and lname from the database
                                    $sql = "SELECT branch_name FROM branch_tb";
                                    $result = mysqli_query($conn, $sql);

                                    // Generate the dropdown list
                                    echo "<select class='form-select form-select-m' aria-label='.form-select-sm example' name='name_emp' style='width: 350px;'>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        $branchname = $row['branch_name'];
                                        echo "<option value='$branch_name'>$branchname</option>";
                                    }
                                    echo "</select>";
                                ?>

                            </div>
                            
                            <style>
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
                                            <a href="actions/Branch Action/edit.php?id=<?php echo $row['id']?>" class="link-dark"> <i class="fa-solid fa-pen-to-square fs-5 me-3" title='edit'></i></a>
                                            <a href="actions/Branch Action/delete.php?id=<?php echo $row['id']?>" class="link-dark"> <i class="fa-solid fa-trash fs-5" title='delete'></i> </a>
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