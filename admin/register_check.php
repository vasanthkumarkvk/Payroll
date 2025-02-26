<?php
// Database connection settings
include "database.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $conn->real_escape_string(trim($_POST['full_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Check if email already exists
    $check_email_sql = "SELECT email FROM admin_login WHERE email = ?";
    $check_stmt = $conn->prepare($check_email_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Email already registered
        echo "<script> alert('already exit');window.location.href='index.php';</script>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL statement
        $sql = "INSERT INTO admin_login (full_name, email, username, password) VALUES (?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $full_name, $email, $username, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful, redirect to dashboard.php
            header("Location: dashboard.php");
            exit(); // Terminate the script to prevent further execution
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close check statement and connection
    $check_stmt->close();
    $conn->close();
}
?>