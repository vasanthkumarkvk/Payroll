<?php
require 'vendor/autoload.php';
require '../database.php';

// Start output buffering to prevent errors
ob_start();

// Get normal_id from URL and sanitize it
if (!isset($_GET['normal_id']) || empty($_GET['normal_id'])) {
    die("Invalid request: normal_id is required.");
}

$normal_id = mysqli_real_escape_string($conn, $_GET['normal_id']); // Prevent SQL injection

// Create a new PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Salary Details');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Title
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(190, 10, 'Salary Details Report', 0, 1, 'C');
$pdf->Ln(5);

// Table header
$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(15, 8, 'ID', 1, 0, 'C', true);
$pdf->Cell(25, 8, 'Month', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Year', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Gross Salary', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Advance', 1, 0, 'C', true);
$pdf->Cell(25, 8, 'EMI', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Net Salary', 1, 1, 'C', true);

// Fetch salary details for the given normal_id
$query = "SELECT * FROM salary_details WHERE employee_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $normal_id); // Use "s" because normal_id is a string
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if data exists
if (mysqli_num_rows($result) == 0) {
    die("No salary details found for this normal_id.");
}

// Table content
$pdf->SetFont('helvetica', '', 10);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(15, 8, $row['id'], 1, 0, 'C');
    $pdf->Cell(25, 8, $row['month'], 1, 0, 'C');
    $pdf->Cell(20, 8, $row['year'], 1, 0, 'C');
    $pdf->Cell(30, 8, $row['gross_salary'], 1, 0, 'C');
    $pdf->Cell(30, 8, $row['advance_amount'], 1, 0, 'C');
    $pdf->Cell(25, 8, $row['emi_amount'], 1, 0, 'C');
    $pdf->Cell(20, 8, $row['net_salary'], 1, 1, 'C');
}

// Clean previous output and send the PDF
ob_end_clean();
$pdf->Output('salary_details.pdf', 'D');
exit;
?>
