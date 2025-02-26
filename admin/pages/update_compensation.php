<?php
// update_compensation.php

// Include your database connection
include '../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeId = $_POST['employee_id'];
    $annualSalary = $_POST['annual_salary'];
    $bonus = $_POST['bonus'];
    $totalCompensation = $_POST['total_compensation'];

    // Update the employee's compensation details in the database
    $stmt = $conn->prepare("UPDATE run_payslip SET gross_salary = ?, bonus = ?, total_compensation = ? WHERE employee_user_id = ?");
    $stmt->bind_param('ssss', $annualSalary, $bonus, $totalCompensation, $employeeId);

    if ($stmt->execute()) {
        echo 'Compensation details updated successfully.';
    } else {
        echo 'Error updating compensation details.';
    }

    $stmt->close();
    $conn->close();
}
?>
