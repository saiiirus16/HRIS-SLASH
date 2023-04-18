<?php

$conn = mysqli_connect("localhost", "root", "", "hris_db");

$result = mysqli_query($conn, "SELECT * FROM employee_tb WHERE id = '".$_POST['id']."'");
$row = mysqli_fetch_assoc($result);


if(count($_POST) > 0){

    $id_emp = $_POST['id_emp'];
    $other_allowance = $_POST['other_allowance'];
    $allowance_amount = $_POST['allowance_amount'];

    foreach($id_emp as $key => $value){ 
        $submit ="INSERT INTO allowancededuct_tb(id_emp, other_allowance,allowance_amount)
                  VALUES ('".$value."','".$other_allowance[$key]."', '".$allowance_amount[$key]."')";

        $query = mysqli_query($conn,$submit);
        
        header("Location: ../../editempListForm.php?id=$row[id]");
    
    }
}




?>