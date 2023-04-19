<?php

$conn = mysqli_connect("localhost", "root", "", "hris_db");

$result = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id = '".$_POST['id']."'");
$row = mysqli_fetch_assoc($result);


if(count($_POST) > 0){

    $id_emp = $_POST['id_emp'];
    $other_govern = $_POST['other_govern'];
    $govern_amount = $_POST['govern_amount'];

    foreach($id_emp as $key => $value){ 
        $submit ="INSERT INTO governdeduct_tb(id_emp, other_govern,govern_amount)
                  VALUES ('".$value."','".$other_govern[$key]."', '".$govern_amount[$key]."')";

        $query = mysqli_query($conn,$submit);
        
        header("Location: ../../editempListForm.php?id=$row[id]");
    
    }
}




?>