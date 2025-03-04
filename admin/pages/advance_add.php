<?php
include "../database.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data with proper escaping
    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $employee_user_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    $advance_amount = mysqli_real_escape_string($conn, $_POST['advance_amount']);
    $emi_amount = mysqli_real_escape_string($conn, $_POST['emi_amount']);
    $advance_date = mysqli_real_escape_string($conn, $_POST['starting_date']);

    // Extract advance month & year
    $advance_month = date("m", strtotime($advance_date));
    $advance_year = date("Y", strtotime($advance_date));

    // Calculate remaining EMIs (assuming full repayment in EMIs)
    $remaining_emi = ceil($advance_amount / $emi_amount);

    // Check if the employee already exists in the `advance_salary` table
    $check_query = "SELECT * FROM advance_salary WHERE employee_user_id = '$employee_user_id' AND employee_name = '$employee_name'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Employee exists, update the existing row
        $update_query = "UPDATE advance_salary SET 
                            advance_amount = '$advance_amount', 
                            emi_amount = '$emi_amount', 
                            advance_date = '$advance_date', 
                            advance_month = '$advance_month', 
                            advance_year = '$advance_year', 
                            remaining_emi = '$remaining_emi', 
                            created_at = NOW() 
                         WHERE employee_user_id = '$employee_user_id' 
                         AND employee_name = '$employee_name'";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Advance Salary Updated Successfully!'); window.location.href='your_page.php';</script>";
        } else {
            echo "<script>alert('Error updating record: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // If no existing record, do nothing
        echo "<script>alert('No record found for this employee. No updates were made.'); window.location.href='your_page.php';</script>";
    }
}

mysqli_close($conn);
?>
