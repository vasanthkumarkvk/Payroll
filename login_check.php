<?php
session_start();
include "db.php"; // Include both database connections

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['userpass'];

    // If not found, check employees table in Service Desk database
    $stmt = $service_conn->prepare("SELECT * FROM employees WHERE email = ?");
    $stmt->bind_param("s", $username); // Assuming username is email
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            // Set session variables
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id']; // Corrected this line

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php?error=Invalid password");
            exit();
        }
    }

    // If user not found in either database
    header("Location: index.php?error=User not found");
    exit();
}
?>
