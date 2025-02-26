<?php

include "../database.php"; // Include your database connection file


    // Check if employee_user_id is set and not empty
    if (empty($_POST['employee_user_id'])) {
        die("Error: Employee user ID not provided. Value: " . print_r($_POST, true));
    }

    // Get employee user ID from the POST request
    $employee_user_id = $_POST['employee_user_id'];


    // Check if a file was uploaded
    if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
        $file_name = $_FILES['document']['name'];
        $file_tmp = $_FILES['document']['tmp_name'];
        $file_path = 'uploads/' . basename($file_name);


        // Ensure the uploads directory exists and is writable
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true); // Create uploads directory if it doesn't exist
        }

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Update the database with the document path using employee_user_id
            $sql = "UPDATE run_payslip SET document_path = ? WHERE employee_user_id = ?";
            $stmt = $conn->prepare($sql);

            // Check if prepare was successful
            if ($stmt === false) {
                die("Error preparing the SQL statement: " . $conn->error);
            }

            // Bind parameters (string for file_path, string for employee_user_id)
            $stmt->bind_param("ss", $file_path, $employee_user_id);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to 'people.php' after a successful insertion
                header("Location: people.php");
                exit();

            } else {
                die("Error updating the database: " . $stmt->error);
            }
        } else {
            die("Error moving the uploaded file.");
        }
    } else {
        die("No file uploaded or there was an error: " . ($_FILES['document']['error'] ?? 'Unknown error'));
    }

    // Close the statement and the database connection
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();

?>