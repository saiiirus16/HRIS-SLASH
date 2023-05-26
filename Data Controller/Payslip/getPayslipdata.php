<?php
include '../../config.php';
$payslip_ID = $_GET['id'];

$sql = "SELECT `col_Payslip_pdf` FROM `payslip_tb` WHERE `col_ID` = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $payslip_ID);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $blobData);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Check if blob data was retrieved successfully
if ($blobData) {
    // Step 3: Display blob data in PHP
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=" . $payslip_ID . '.pdf');
    echo $blobData;
} else {
    echo "Error: Unable to retrieve blob data from the database.";
}




//         include '../../config.php';
// $payslip_ID = $_GET['id'];

// // Step 2: Retrieve blob data from the database
// $sql = "SELECT `col_Payslip_pdf` FROM `payslip_tb` WHERE `col_ID` = ?";
// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, "i", $payslip_ID); // $id is the ID of the blob data you want to retrieve
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);
// $row = mysqli_fetch_assoc($result);
// $blobData = $row['col_Payslip_pdf'];
// mysqli_stmt_close($stmt);

// // Step 3: Display blob data in PHP
// header("Content-type: application/pdf"); // Set appropriate content type for PDF
// header("Content-Disposition: inline; filename=" . $payslip_ID . '.pdf'); // Set the filename for the browser
// echo $blobData; // Output blob data to the browser
?>


