<?php
include "../database.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $employee_user_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    $bonus_amount = mysqli_real_escape_string($conn, $_POST['bonous_amount']);
    $bonus_date = mysqli_real_escape_string($conn, $_POST['bonous_date']);

    // Check if the employee already exists in the run_payslip table
    $check_query = "SELECT * FROM run_payslip WHERE employee_user_id = '$employee_user_id' AND employee_name = '$employee_name'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Employee exists, update the existing row
        $update_query = "UPDATE run_payslip SET 
                        bonus = '$bonus_amount', 
                        bonous_date = '$bonus_date'
                        WHERE employee_user_id = '$employee_user_id' AND employee_name = '$employee_name'";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Bonus Updated Successfully!'); window.location.href='../dashboard.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
