<?php
require_once('tcpdf/tcpdf.php');

$content = $_POST['content'];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Modal Content PDF');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();

$pdf->writeHTML($content, true, false, true, false, '');

$pdf->Output('modal-content.pdf', 'D');
?>
