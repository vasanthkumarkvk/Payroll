<?php
session_start();
include "database.php"; // Ensure this includes your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['userpass'];

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin_login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['user_email'] = $user['email']; // Store the email or username in session
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            // Password is incorrect
            header("Location: index.php?error=Invalid password"); // Redirect to index with error
            exit();
        }
    } else {
        // Username not found
        header("Location: index.php?error=User not found"); // Redirect to index with error
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
