<?php
include "../database.php"; // Include your database connection file

// Prepare the response
$response = ['found' => false, 'details' => []];

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);
$email = isset($data['email']) ? filter_var($data['email'], FILTER_SANITIZE_EMAIL) : '';



if (!empty($email)) {
    // Query to check if the email exists in the manual_update table
    $query = "SELECT * FROM manual_update WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
 
    if ($result && $result->num_rows > 0) {
        // Email found, fetch details
        $response['found'] = true;
        $response['details'] = $result->fetch_assoc();
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the database connection

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
