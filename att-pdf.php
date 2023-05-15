<?php
require('fpdf.php');
require_once('config.php');

// Fetch the attendance records from the database
$query = "SELECT * FROM attendance ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// If attendance records found, create the PDF
if (mysqli_num_rows($result) > 0) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,10,'Attendance Report');

    // Add a table
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 10, 'ID', 1);
    $pdf->Cell(40, 10, 'Name', 1);
    $pdf->Cell(30, 10, 'Date', 1);
    $pdf->Cell(20, 10, 'Time In', 1);
    $pdf->Cell(20, 10, 'Time Out', 1);
    $pdf->Cell(20, 10, 'Hours', 1);

    while ($row = mysqli_fetch_array($result)) {
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 10, $row['id'], 1);
        $pdf->Cell(40, 10, $row['name'], 1);
        $pdf->Cell(30, 10, $row['date'], 1);
        $pdf->Cell(20, 10, $row['time_in'], 1);
        $pdf->Cell(20, 10, $row['time_out'], 1);
        $pdf->Cell(20, 10, $row['hours'], 1);
    }

    // Output the PDF
    ob_end_clean();
    $pdf->Output();
} else {
    // If no attendance records found, display message in the PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,10,'No attendance records found.');
    ob_end_clean();
    $pdf->Output();
}

mysqli_close($conn);
?>