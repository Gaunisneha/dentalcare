<?php
session_start();
require('../fpdf186/fpdf.php');

if (!isset($_SESSION['appointment_details']) || empty($_SESSION['appointment_details'])) {
    die("No appointment details found.");
}

$appointment = $_SESSION['appointment_details'];

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Clinic Header
$pdf->Cell(190, 10, 'Dental Health Care', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 7, ',S.S Agrawal, Navsari, Inida', 0, 1, 'C');
$pdf->Cell(190, 7, 'Phone: 7043824447', 0, 1, 'C');
$pdf->Ln(5);
$pdf->Cell(190, 5, '--------------------------------------------------------', 0, 1, 'C');
$pdf->Ln(5);

// Invoice Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, "Invoice No: " . rand(1000, 9999), 0, 0);
$pdf->Cell(90, 10, "Date: " . date("d-m-Y"), 0, 1);

// Patient Details
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Patient Details', 1, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(95, 10, "Patient Name: " . $appointment['patientname'], 1);
$pdf->Cell(95, 10, "Email: " . $appointment['emailid'], 1, 1);
$pdf->Cell(95, 10, "Doctor: " . $_SESSION['docname'], 1);
$pdf->Cell(95, 10, "Service: " . $appointment['service'], 1, 1);
$pdf->Cell(95, 10, "Appointment Date: " . $appointment['appdate'], 1);
$pdf->Cell(95, 10, "Appointment Time: " . $appointment['apptime'], 1, 1);
$pdf->Ln(5);

// Billing Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Billing Details', 1, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(140, 10, "Service", 1);
$pdf->Cell(50, 10, "Amount (Rs.)", 1, 1);
$pdf->Cell(140, 10, $appointment['service'], 1);
$pdf->Cell(50, 10, "Rs." . $appointment['price'], 1, 1);

// Total Amount
$pdf->Cell(140, 10, "Total", 1);
$pdf->Cell(50, 10, "Rs." . $appointment['price'], 1, 1);
$pdf->Ln(10);

// Payment Status
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Payment Status: ' . $_SESSION['status'], 1, 1, 'C');
$pdf->Ln(10);

// Signature Section
$pdf->Cell(190, 10, "Authorized Signature: _______________", 0, 1, 'R');

$pdf->Output('D', 'Dental_Invoice.pdf'); // Forces download
?>
