<?php

// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../database.php'; // Include your database connection

header('Content-Type: application/json'); // Ensure JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON payload
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Validate the payload
    if (!$data || empty($data['employee_id']) || empty($data['month'])) {
        http_response_code(400); // Bad request
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
        exit;
    }



    // Extract data
    $employeeId = $data['employee_id'];

    $employee_user_id = $data['employee_id'];


    $month = $data['month'];
    $grossSalary = $data['gross_salary'] ?? 0;
    $advanceAmount = $data['advance_amount'] ?? 0;
    $emiAmount = $data['emi_amount'] ?? 0;
    $totalDays = $data['total_days'] ?? 0;
    $presentDays = $data['present_days'] ?? 0;
    $absentDays = $data['absent_days'] ?? 0;
    $netSalary = $data['net_salary'] ?? 0;

    $current_year = date("Y");



    // Sanitize the employee_user_id
$employeeId = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($employeeId));

// Now use the sanitized and lowercase employee_user_id to construct the table name
$table_name = $employeeId . "_salary";




    try {
        // Start a transaction
        $conn->begin_transaction();

        // Prepare the first insert statement
        $stmt1 = $conn->prepare("INSERT INTO salary_details (employee_id, month, year, gross_salary, advance_amount, emi_amount, total_days, present_days, absent_days, net_salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt1) {
            throw new Exception("Prepare failed for salary_details: " . $conn->error);
        }

        // Prepare the second insert statement
        $stmt2 = $conn->prepare("INSERT INTO $table_name (employee_id, month, year, gross_salary, advance_amount, emi_amount, total_days, present_days, absent_days, net_salary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt2) {
            throw new Exception("Prepare failed for $table_name: " . $conn->error);
        }

        // Bind parameters for both statements
        $stmt1->bind_param("ssisiiiiid", $employee_user_id, $month, $current_year, $grossSalary, $advanceAmount, $emiAmount, $totalDays, $presentDays, $absentDays, $netSalary);
        $stmt2->bind_param("ssisiiiiid", $employee_user_id, $month, $current_year, $grossSalary, $advanceAmount, $emiAmount, $totalDays, $presentDays, $absentDays, $netSalary);

        // Execute both statements
        if (!$stmt1->execute()) {
            throw new Exception("Execution failed for salary_details: " . $stmt1->error);
        }

        if (!$stmt2->execute()) {
            throw new Exception("Execution failed for $table_name : " . $stmt2->error);
        }

        // Commit the transaction
        $conn->commit();

        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        // Rollback the transaction in case of any error
        $conn->rollback();

        // Return error message
        http_response_code(500); // Internal server error
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        // Close the connection and statements
        if (isset($stmt1)) $stmt1->close();
        if (isset($stmt2)) $stmt2->close();
        $conn->close();
    }
} else {
    // Handle unsupported HTTP methods
    http_response_code(405); // Method not allowed
    echo json_encode(['status' => 'error', 'message' => 'Unsupported request method']);
}

?>
