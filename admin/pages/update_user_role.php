<?php
// Ensure the form is submitted and the data is available
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get employee_id and updated employee_type from the form
    $employee_id = $_POST['employee_id'];
    $employee_type = $_POST['employee_type'];

    include "../database.php";

    // Update the employee's role in the database
    $sql = "UPDATE run_payslip SET employee_type = ? WHERE employee_user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $employee_type, $employee_id);

    // Execute the query
    if ($stmt->execute()) {
        echo "Success"; // Send a success response back to the JavaScript
    } else {
        echo "Error updating employee role.";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
