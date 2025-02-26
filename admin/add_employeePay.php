<?php
include "database.php"; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect data from the form
    $employee_name = $_POST['employee_name'];
    $gross_salary = $_POST['gross_salary'];
    // $availability_days = $_POST['availability_days'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];

    // Split pay_month_year into month and year
    $pay_month_year = $_POST['pay_month_year']; // format: YYYY-MM
    $pay_year = substr($pay_month_year, 0, 4);
    $pay_month = substr($pay_month_year, 5, 2);

    // SQL insert statement
    $sql = "INSERT INTO run_payslip (employee_name, gross_salary, email, designation, pay_month, pay_year)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsssi", $employee_name, $gross_salary, $email, $designation, $pay_month, $pay_year);

    // Execute statement
    if ($stmt->execute()) {
        // Use the PRG pattern
        header("Location: pages/run_pay.php"); // Redirect to the index page after sending
        exit(); // Ensure no further script execution
    }
    
    
    $stmt->close();
    $conn->close();
}
?>
