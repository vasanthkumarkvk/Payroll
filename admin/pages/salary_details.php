<?php

include "../database.php"; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect POST data
    $employee_user_id = isset($_POST['employee_user_id']) ? $_POST['employee_user_id'] : null;
    $month = isset($_POST['month']) ? $_POST['month'] : null;
    $year = isset($_POST['year']) ? $_POST['year'] : null;
    $present_days = isset($_POST['present_days']) ? $_POST['present_days'] : null;
    $absent_days = isset($_POST['absent_days']) ? $_POST['absent_days'] : null;
    $total_paid_days = isset($_POST['total_paid_days']) ? $_POST['total_paid_days'] : null;

    if (empty($employee_user_id) || empty($month) || empty($year) || empty($present_days)) {
        die("Required fields must not be empty.");
    }

    // Fetch the employee's gross salary and advance amount from their salary table
    $salary_table_name = $employee_user_id . "_salary"; // Table name is dynamic based on employee_user_id
    $query = "SELECT gross_salary, advance_amount, emi_amount, advance_amount_start FROM $salary_table_name WHERE month = ? AND year = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $month, $year);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data for the employee
        $row = $result->fetch_assoc();
        $gross_salary = $row['gross_salary'];
        $advance_amount = $row['advance_amount'];
        $emi_amount = $row['emi_amount'];
        $advance_amount_start = $row['advance_amount_start'];
        
        // Calculate daily salary (assuming a 30-day month for simplicity)
        $total_days_in_month = 30;
        $daily_rate = $gross_salary / $total_days_in_month;

        // Calculate the net salary
        $attendance_salary = $present_days * $daily_rate;
        $net_salary = $attendance_salary - $emi_amount - $advance_amount;

        // Calculate yearly net salary
        $net_salary_yearly = $net_salary * 12; 

        // Calculate remaining advance amount
        $remaining_emi = $advance_amount_start - ($emi_amount * $year); // Assuming monthly EMI deduction

        // Insert the calculated data into the employee's salary table
        $insert_query = "INSERT INTO $salary_table_name 
            (employee_user_id, gross_salary, advance_amount, emi_amount, month, year, present_days, absent_days, net_salary, total_paid_days, total_days_in_month, remaining_emi, gross_salary_yearly, net_salary_yearly, payment_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssdddiiiidddd", 
            $employee_user_id, 
            $gross_salary, 
            $advance_amount, 
            $emi_amount, 
            $month, 
            $year, 
            $present_days, 
            $absent_days, 
            $net_salary, 
            $total_paid_days, 
            $total_days_in_month, 
            $remaining_emi, 
            $gross_salary_yearly, 
            $net_salary_yearly);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Salary details saved successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error saving salary details.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Employee not found in the salary table for the given month and year.']);
    }

    // Close the statement
    $stmt->close();
}

$conn->close();

?>
