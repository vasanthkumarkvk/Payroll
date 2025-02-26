<?php
require '../../assets/vendors/vendor/autoload.php'; // Path to PhpSpreadsheet autoload.php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['salary_data']) && !empty($data['salary_data'])) {
        $salaryData = $data['salary_data'];

      

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Employee Salary Details');

        // Define headers for the Excel file and set bold font style
        $headers = ['Employee ID', 'Employee Name', 'Year', 'Month', 'Gross Salary', 'Incentive', 'Net Salary'];
        $sheet->fromArray($headers, NULL, 'A1');
        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // Set headers bold

        // Initialize the row index where data will start
        $rowIndex = 2;

        $employeeID = isset($data['employee_id']) ? $data['employee_id'] : '';  
        $employeeName = isset($data['employee_name']) ? $data['employee_name'] : '';

        // Populate data for each year and month in the salary data array
        foreach ($salaryData as $year => $months) {
            foreach ($months as $month => $data) {
                $row = [
                    $employeeID, // Employee ID
                    $employeeName, // Employee Name
                    $year, // Year
                    $month, // Month
                    $data['gross'], // Gross Salary
                    $data['incentive'] ?? '0.00',  // Include incentive value or default to 0.00 if not present
                    "₹ " . number_format($data['salary'], 2) // Net Salary with currency and formatting
                ];

                // Insert row data into the Excel sheet
                $sheet->fromArray($row, NULL, 'A' . $rowIndex++);
            }
        }

        // Auto-size columns for better readability
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set headers for downloading the file as an Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="employee_salary_details.xlsx"');
        header('Cache-Control: max-age=0');

        // Write and output the Excel file
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } else {
        echo "No salary data provided!";
    }
} else {
    echo "Invalid request method!";
}
?>
