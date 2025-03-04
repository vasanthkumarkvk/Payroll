<?php
// Include your database connection file
include "../db.php";

// Start the session
session_start();

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to protected page if already logged in
    header("Location: ../index.php");
    exit();
}

// Check if login data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to avoid SQL injection
    $stmt = $service_conn->prepare("SELECT * FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if ($password === $user['password']) {
            // Set session variables for successful login
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];

            // Redirect to protected page
            header("Location: ../index.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['message'] = "Invalid email or password.";
            header("Location: index.php");
            exit();
        }
    } else {
        // No user found with that email
        $_SESSION['message'] = "Invalid email or password.";
        header("Location: index.php");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $service_conn->close();
}
?>
