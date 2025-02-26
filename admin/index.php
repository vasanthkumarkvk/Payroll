<?php

include "database.php"; // Include your database connection file

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Payroll Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a82fb, #fc5c7d);
            height: 100vh;
            color: black;
        }


        .login-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin: auto;
            max-width: 400px;
        }

        .logo-img {
            width: 120px;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(to right, #1e90ff, #00c6ff);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #00c6ff, #1e90ff);
        }

        .footer-text {
            margin-top: 20px;
            font-size: 14px;
            color: black;
            text-align: center;
        }

        @media (max-width: 576px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="login-container mt-5">
        <a href="index.php" class="text-center d-block">
            <img src="../img/vsmlogo-favicon.png" alt="Logo" class="logo-img">
        </a>
        <h4 class="text-center">Admin Login</h4>
        <p class="text-center text-muted">Access your Payroll Management System</p>
        <form method="POST" action="login_check.php">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name </label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="username" required>
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="userpass" required>
            </div>
            <div class="row m-t-20">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary btn-lg w-100" value="Sign In" name="loginsubmit"
                        id="login">
                </div>
            </div>
            <?php
            if (isset($_GET['error'])) {
                echo "<p style='color: red; font-weight: bold;'>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>

        </form>
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="register.php" class="text-primary">Sign Up</a></p>
        </div>
        <div class="footer-text">
            <p>© 2024 VSM Global Technologies. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>