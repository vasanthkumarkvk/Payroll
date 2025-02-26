<?php
// Include database connection
include('../database.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and ensure the employee_id is set
    if (isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
        $employee_id = $_POST['employee_id'];
    } else {
        echo "User ID is not created.";
        exit;  // Stop further execution if employee_id is missing
    }

    $employee_name = $_POST['employee_name'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $basic_salary = $_POST['basic_salary'];
    $allowances = $_POST['allowances'];
    $deductions = $_POST['deductions'];
    $advance_salary = $_POST['advance_salary'] ?? 0; // Default to 0 if not provided
    $gross_salary = $_POST['gross_salary'];
    $net_salary = $_POST['net_salary'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $total_allowances_yearly = $_POST['total_allowances_yearly'] ?? 0;
    $total_deductions_yearly = $_POST['total_deductions_yearly'] ?? 0;
    $payment_date = $_POST['payment_date'];
    $bonus = $_POST['bonus'] ?? 0;
    $overtime = $_POST['overtime'] ?? 0;

    // Generate table name dynamically
    $salary_table_name = $employee_id . "_salary";

    // Insert form data into the salary table
    $insert_sql = "
        INSERT INTO `$salary_table_name` (
            employee_name, designation, department, basic_salary, allowances, deductions,
            advance_salary, gross_salary, net_salary, year, month, total_allowances_yearly,
            total_deductions_yearly, payment_date, bonus, overtime
        ) VALUES (
            '$employee_name', '$designation', '$department', '$basic_salary', '$allowances', '$deductions',
            '$advance_salary', '$gross_salary', '$net_salary', '$year', '$month', '$total_allowances_yearly',
            '$total_deductions_yearly', '$payment_date', '$bonus', '$overtime'
        )";

    if ($conn->query($insert_sql) === TRUE) {
        header("Location: add_salary.php"); 
        echo "Salary details saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
