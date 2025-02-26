<?php
// Database connection
include "../database.php"; // Include your database connection file


// Check if employee_user_id is set
if (isset($_GET['employee_user_id'])) {
    $employee_user_id = $_GET['employee_user_id'];

    // Prepare the SQL statement
    $sql = "SELECT document_path FROM run_payslip WHERE employee_user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employee_user_id);

    // Execute the statement
    if ($stmt->execute()) {
        $stmt->bind_result($document_path);
        $stmt->fetch();

        if ($document_path) {
            // Document exists, display it
            // echo '<h2>Uploaded Document:</h2>';
            echo '<iframe src="' . htmlspecialchars($document_path) . '" width="100%" height="100%"></iframe>';
        } else {
            echo "No document found for this employee.";
        }
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "Employee user ID not provided.";
}

$conn->close();
?>
