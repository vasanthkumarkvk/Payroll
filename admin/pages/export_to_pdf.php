<?php
require 'vendor/autoload.php';
require '../database.php';

// Start output buffering
ob_start();

// Check if month and employee_id exist
if (!isset($_GET['month']) || !isset($_GET['employee_id'])) {
    die("Invalid request: Month and Employee ID are required.");
}

// Get and sanitize input
$month = mysqli_real_escape_string($conn, $_GET['month']);
$employee_id = mysqli_real_escape_string($conn, $_GET['employee_id']);

// Create PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Employee Payslip');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Fetch salary details
$query = "SELECT * FROM salary_details WHERE month = ? AND employee_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $month, $employee_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("No salary details found for this month and employee.");
}
$salary_data = mysqli_fetch_assoc($result);

// Fetch employee details
$query2 = "SELECT * FROM run_payslip WHERE employee_user_id = ?";
$stmt2 = mysqli_prepare($conn, $query2);
mysqli_stmt_bind_param($stmt2, "s", $employee_id);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

if (mysqli_num_rows($result2) == 0) {
    die("No employee details found.");
}
$employee_data = mysqli_fetch_assoc($result2);

// Company Details
$company_logo = "";
$company_name = "VSM Global Technologies";
$company_address = "5A, AGNI MAPLE, Pada Salai St, Nookampalayam, nagar, Perumbakkam, Chennai, Tamil Nadu 600130";
$company_phone = "+91-97909 73187";
$company_email = " info@vsmglobaltechnologies.com";

// Calculate Pending Advance Salary
$pending_advance_salary = $employee_data['gross_salary'] - $salary_data['advance_amount'];

// HTML Structure with Inline CSS
$html = '
<style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    .header { text-align: center; font-size: 16px; font-weight: bold; padding: 10px; background-color:rgb(35, 89, 207); color: white; }
    .company-details { text-align: center; font-size: 12px; margin-bottom: 10px; }
    .company-logo { text-align: center; margin-bottom: 10px; }
    .section-title { font-size: 14px; font-weight: bold; background-color: #f2f2f2; padding: 5px; }
    .table { width: 100%; border-collapse: collapse; margin-top: 10px;padding:10px; }
    .table td, .table th { border: 1px solid #ddd; padding: 8px; text-align: left;padding:10px; }
    .table th { background-color: #008080; color: white;padding:10px; }
    .total { font-weight: bold; font-size: 14px;padding:10px; }
</style>

<div class="company-logo">
    <img src="' . $company_logo . '" width="100">
</div>
<div class="header">Employee Payslip</div>
<div class="company-details">
    <strong>' . $company_name . '</strong><br>
    ' . $company_address . '<br>
    Phone: ' . $company_phone . '<br>
    Email: ' . $company_email . '
</div>

<div  style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 20px;">
    Payslip for (' . $salary_data['month'] . '- ' . $salary_data['year'] . ')
</div>

<table class="table">
    <tr>
        <td><strong>Employee Name:</strong> ' . $employee_data['employee_name'] . '</td>
        <td><strong>Gender:</strong> ' . $employee_data['gender'] . '</td>
    </tr>
    <tr>
        <td><strong>Designation:</strong> ' . $employee_data['designation'] . '</td>
        <td><strong>Department:</strong> ' . $employee_data['department'] . '</td>
    </tr>
    <tr>
        <td><strong>Paid Days:</strong> ' . $salary_data['present_days'] . '</td>
        <td><strong>LOP Days:</strong> ' . $salary_data['absent_days'] . '</td>
    </tr>
</table>

<div class="section-title" >Salary Details</div>
<table class="table">
    <tr>
        <th>Gross Salary</th>
        <th>Advance Salary</th>
        <th>Pending Advance Salary</th>
        <th>Net Salary</th>
    </tr>
    <tr>
        <td>' . number_format($employee_data['gross_salary'], 2) . '</td>
        <td>' . number_format($salary_data['advance_amount'], 2) . '</td>
        <td>' . number_format($pending_advance_salary, 2) . '</td>
        <td class="total">' . number_format($salary_data['net_salary'], 2) . '</td>
    </tr>
</table>
';

// Write HTML to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Clean previous output and send the PDF
ob_end_clean();
$pdf->Output('payslip.pdf', 'D');
exit;
?>
