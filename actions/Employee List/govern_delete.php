<?php
    
    $conn = mysqli_connect("localhost", "root", "", "hris_db");
    if (isset($_GET['other_govern'])) {
        $other_govern = $_GET['other_govern'];
        $id = $_GET['id']; // add this line to get the id from the URL
    
        $results = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id = '$id'");
        $rows = mysqli_fetch_assoc($results);
    
        $sql = "DELETE FROM `governdeduct_tb` WHERE other_govern='$other_govern'";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            // If the delete was successful, redirect back to the edit form
            if($results){
                header("Location: ../../editempListForm.php?id=$id"); // use $id here
            exit;
            }
        } else {
            // If the delete failed, display an error message
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        // If no id was provided in the URL, display an error message
        echo "No id specified";
    }
?>
