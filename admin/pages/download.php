<?php
require '../../assets/vendors/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['salary_data'])) {
    // Decode the JSON data received from JavaScript
    $salaryData = json_decode($_POST['salary_data'], true);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Employee Salary Details');

    // Define the header for the Excel file
    $headers = ['Details', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $sheet->fromArray($headers, NULL, 'A1');

    // Initialize row index
    $rowIndex = 2;

    // Define rows for each category
    $categories = [
        'Employee ID',
        'Gross Salary',
        'Total Days',
        'Present Days',
        'Absent Days',
        'Total Paid Days',
        'Net Salary'
    ];

    // Iterate over each category and populate monthly data
    foreach ($categories as $key => $category) {
        $row = [$category];

        foreach ($salaryData as $data) {
            // Fill in monthly data for each category
            switch ($category) {
                case 'Employee ID': $row[] = $data['employee_id']; break;
                case 'Gross Salary': $row[] = $data['gross_salary']; break;
                case 'Total Days': $row[] = $data['total_days']; break;
                case 'Present Days': $row[] = $data['present_days']; break;
                case 'Absent Days': $row[] = $data['absent_days']; break;
                case 'Total Paid Days': $row[] = $data['total_paid_days']; break;
                case 'Net Salary': $row[] = "₹ " . $data['net_salary']; break;
            }
        }
        $sheet->fromArray($row, NULL, 'A' . $rowIndex++);
    }

    // Set headers to force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="employee_salary_detail.xlsx"');
    header('Cache-Control: max-age=0');

    // Create the Excel file
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
