<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Include database connection
include '../database.php';

// Fetch salary details from the database
$query = "SELECT * FROM salary_details";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headers
$sheet->setCellValue('A1', 'ID')
      ->setCellValue('B1', 'Month')
      ->setCellValue('C1', 'Year')
      ->setCellValue('D1', 'Gross Salary')
      ->setCellValue('E1', 'Advance Amount')
      ->setCellValue('F1', 'EMI Amount')
      ->setCellValue('G1', 'Total Days')
      ->setCellValue('H1', 'Present Days')
      ->setCellValue('I1', 'Absent Days')
      ->setCellValue('J1', 'Net Salary')
      ->setCellValue('K1', 'Payment Status');

// Populate data rows
$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['id'])
          ->setCellValue('B' . $rowNumber, $row['month'])
          ->setCellValue('C' . $rowNumber, $row['year'])
          ->setCellValue('D' . $rowNumber, $row['gross_salary'])
          ->setCellValue('E' . $rowNumber, $row['advance_amount'])
          ->setCellValue('F' . $rowNumber, $row['emi_amount'])
          ->setCellValue('G' . $rowNumber, $row['total_days'])
          ->setCellValue('H' . $rowNumber, $row['present_days'])
          ->setCellValue('I' . $rowNumber, $row['absent_days'])
          ->setCellValue('J' . $rowNumber, $row['net_salary'])
          ->setCellValue('K' . $rowNumber, $row['payment_status']);
    $rowNumber++;
}

$writer = new Xlsx($spreadsheet);

// Set headers to prompt download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="salary_details.xlsx"');
$writer->save('php://output');
exit;
?>
