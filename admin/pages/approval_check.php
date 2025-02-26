<?php
include '../database.php'; // Include your database connection

// Fetch pending approvals
$sql = "SELECT * FROM approvals WHERE status = 'Pending'";
$result = $conn->query($sql);

// Store the approvals in an array
$approvals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $approvals[] = $row;
    }
} else {
    $approvals = [];
}

// Close the database connection
$conn->close();
?>
