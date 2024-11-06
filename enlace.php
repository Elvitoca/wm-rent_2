<?php


require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'U', 12);
$pdf->SetTextColor(0, 0, 255);

// Agregar un enlace con el método Cell
$pdf->Cell(0, 10, 'Visita nuestro sitio web', 0, 1, 'L', false, 'https://www.ejemplo.com');

// Agregar un enlace con el método Write
$pdf->Write(10, 'Haz clic aquí para visitar nuestro sitio', 'https://www.ejemplo.com');

$pdf->Output();
?>
