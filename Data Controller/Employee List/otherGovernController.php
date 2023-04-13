<?php

$conn = mysqli_connect("localhost", "root", "", "hris_db");

$result = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id = '".$_POST['id']."'");
$row = mysqli_fetch_assoc($result);


if(isset($_POST['submit'])){

    $empid = $_POST['empid'];
    $other_govern = $_POST['other_govern'];
    $govern_amount = $_POST['govern_amount'];

    foreach($other_govern as $key => $value){ 
        $submit ="INSERT INTO governdeduct_tb(empid, other_govern,govern_amount)
                  VALUES ('".$empid[$key]."', '".$other_govern[$key]."', '".$govern_amount[$key]."')";

        $query = mysqli_query($conn,$submit);
        
        header("Location: ../../editempListForm.php?id=$row[id]");
    
    }
}




?>