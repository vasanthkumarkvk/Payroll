<?php
include "../database.php"; // Include your database connection file

if (isset($_POST['employee_user_id'], $_POST['current_gross_salary'], $_POST['new_gross_salary'], $_POST['description'])) {
    $employee_user_id = $_POST['employee_user_id'];
    $current_gross_salary = $_POST['current_gross_salary'];
    $new_gross_salary = $_POST['new_gross_salary'];
    $description = $_POST['description'];

    // Begin a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Insert the data into the salary_update table
        $query = "INSERT INTO salary_update (employee_user_id, current_gross_salary, new_gross_salary, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdds", $employee_user_id, $current_gross_salary, $new_gross_salary, $description);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting data into salary_update table");
        }

        // Update the gross_salary in the employees table
        $updateQuery = "UPDATE employees SET gross_salary = ? WHERE employee_user_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ds", $new_gross_salary, $employee_user_id);

        if (!$updateStmt->execute()) {
            throw new Exception("Error updating gross_salary in employees table");
        }

        // Commit the transaction
        $conn->commit();

        echo "<script>alert('Salary updated successfully!'); window.location.href='people.php';</script>";
    } catch (Exception $e) {
        // Roll back the transaction if any query fails
        $conn->rollback();
        echo "<script>alert('Error updating salary: " . $e->getMessage() . "'); window.location.href='people.php';</script>";
    }

    // Close the statements if they were successfully initialized
    if (isset($stmt))
        $stmt->close();
    if (isset($updateStmt))
        $updateStmt->close();

    // Close the connection
    $conn->close();
} else {
    echo "<script>alert('Missing required form data.'); window.location.href='view_payslip.php';</script>";
}
?>