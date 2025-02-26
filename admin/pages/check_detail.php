<?php
// Database connection (assuming you already have this part)
include '../database.php';

// Get the employee ID from the URL, ensure it's set
$employee_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($employee_id) {
    // Prepare the SQL query to fetch employee data
    $sql = "SELECT * FROM run_payslip WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $employee_id); // Bind the employee ID as integer
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if any data was returned
        if ($result->num_rows > 0) {
            // Fetch the employee data
            $employee = $result->fetch_assoc();
        } else {
            // Handle case where no data is found for the given employee ID
            echo "No employee found with the given ID.";
            $employee = null;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement.";
    }
} else {
    // Handle case where employee ID is not passed in the URL
    echo "No employee ID provided.";
    $employee = null;
}

// Close the database connection
$conn->close();
?>
