<?php 
    include "../../config.php";
    
    $id = $_GET['id'];

if(isset($_POST['submit'])) {
    $branch_name = $_POST['branch_name'];
    $branch_address = $_POST['branch_address'];
    $zip_code = $_POST['zip_code'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];


    $sql = "UPDATE `branch_tb` SET `branch_name`='$branch_name',`branch_address`='$branch_address',
    `zip_code`='$zip_code',`email`='$email',`telephone`='$telephone' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if($result) {
        header("Location: ../../Branch.php?msg=Data updated successfully");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/Branch.css"/>
    <link rel="stylesheet" href="../../css/styles.css"/>
    <title>Branch</title>
</head>
<body>

<header>
    <?php include '../../header.php'?>
</header>

    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
    BRANCH DEPARTMENT
    </nav>

    <div class="container" style="margin-top:100px;  box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); ">
        <div class="text-center mb-4" >
            <h3>Edit Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php

            $sql = "SELECT * FROM `branch_tb` WHERE `id` = '$id' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

        ?>


        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Branch Name:</label>
                        <input type="text" class="form-control" name="branch_name" value="<?php echo $row['branch_name'] ?>" >
                    </div>

                    <div class="col">
                        <label class="form-label">Branch Address:</label>
                        <input type="text" class="form-control" name="branch_address" value="<?php echo $row['branch_address'] ?>" >
                    </div>

                    <div class="zip_code">
                        <label class="form-label">Zip Code:</label>
                        <input type="text" class="form-control" name="zip_code" value="<?php echo $row['zip_code'] ?>" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" >
                    </div>


                    <div class="telephone">
                        <label class="form-label">Telephone:</label>
                        <input type="text" class="form-control" name="telephone" value="<?php echo $row['telephone'] ?>">
                    </div>

                    <div class="button_save">
                        <button type="submit" class="btn btn-success" name="submit">Update</button>
                        <a href="../../Branch.php" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    


    <!--Bootstrap Js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>