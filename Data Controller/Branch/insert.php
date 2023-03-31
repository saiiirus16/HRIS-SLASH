<?php 
    include "../../config.php";

if(isset($_POST['submit'])) {
    $branch_name = $_POST['branch_name'];
    $branch_address = $_POST['branch_address'];
    $zip_code = $_POST['zip_code'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];


    $sql = "INSERT INTO `branch_tb`(`id`, `branch_name`, `branch_address`, `zip_code`, `email`, `telephone`) 
    VALUES (NULL,'$branch_name','$branch_address','$zip_code','$email','$telephone')";

    $result = mysqli_query($conn, $sql);

    if($result) {
        header("Location: branch.php?msg=New record created successfully");
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
    <link rel="stylesheet" href="branch.css"/>
    <title>Branch</title>
</head>
<body>

    <nav class="navbar navbar-light justify-content-center fs-3 mb-5">
    BRANCH DEPARTMENT
    </nav>

    <div class="container">
        <div class="text-center mb-4" >
            <h3>Add New</h3>
            <p class="text-muted">Complete the form below to add new</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Branch Name:</label>
                        <input type="text" class="form-control" name="branch_name" placeholder="Slash" required>
                    </div>

                    <div class="col">
                        <label class="form-label">Branch Address:</label>
                        <input type="text" class="form-control" name="branch_address" placeholder="Valenzuela city" required>
                    </div>

                    <div class="zip_code">
                        <label class="form-label">Zip Code:</label>
                        <input type="text" class="form-control" name="zip_code" placeholder="1400" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="slashtech@solution.com" required>
                    </div>

                    <div class="telephone">
                        <label class="form-label">Telephone:</label>
                        <input type="text" class="form-control" name="telephone" placeholder="0909*******" required>
                    </div>

                  

                    <div class="button_save">
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
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