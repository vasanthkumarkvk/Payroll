<?php
include '../database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $employee_name = isset($_POST['employee_name']) ? $_POST['employee_name'] : null;
    $gross_salary = isset($_POST['gross_salary']) ? $_POST['gross_salary'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $designation = isset($_POST['designation']) ? $_POST['designation'] : null;
    $hire_date = isset($_POST['hire_date']) ? $_POST['hire_date'] : null;
    $department = isset($_POST['department']) ? $_POST['department'] : null;
    $manager = isset($_POST['manager']) ? $_POST['manager'] : null;
    $location = isset($_POST['location']) ? $_POST['location'] : null;
    $ifsc_number = isset($_POST['ifsc_number']) ? $_POST['ifsc_number'] : null;
    $bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : null;
    $branch_name = isset($_POST['branch_name']) ? $_POST['branch_name'] : null;
    $account_number = isset($_POST['account_number']) ? $_POST['account_number'] : null;
    $account_type = isset($_POST['account_type']) ? $_POST['account_type'] : null;
    $dob = isset($_POST['dob']) ? $_POST['dob'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;
    $employee_type = isset($_POST['employee_type']) ? $_POST['employee_type'] : null;
    $qualifications = isset($_POST['qualifications']) ? $_POST['qualifications'] : null;
    $resigned_date = isset($_POST['resigned_date']) ? $_POST['resigned_date'] : null;

    if (empty($employee_name) || empty($gross_salary) || empty($email)) {
        die("Required fields must not be empty.");
    }

    // Get the last employee ID from the database
    $result = $conn->query("SELECT COUNT(employee_user_id) AS last_id FROM run_payslip");
    $row = $result->fetch_assoc();
    $last_id = (int) $row['last_id'] + 1; // Increment for new employee

    // Format the hire date to 'mmyyyy'
    $hire_date_formatted = date('mY', strtotime($hire_date));

    // Generate the unique employee ID
    $employee_user_id = "V" . $hire_date_formatted . $last_id;

    // Check if the employee ID is unique (ensure no duplicate exists)
    $check_duplicate = $conn->prepare("SELECT employee_user_id FROM run_payslip WHERE employee_user_id = ?");
    $check_duplicate->bind_param("s", $employee_user_id);
    $check_duplicate->execute();
    $check_duplicate->store_result();

    $max_attempts = 10; // Example limit
    $attempts = 0;

    // If the employee ID already exists, increment the ID and regenerate
    while ($check_duplicate->num_rows > 0 && $attempts < $max_attempts) {
        $last_id++;
        $employee_user_id = "V" . $hire_date_formatted . $last_id;
        $check_duplicate->bind_param("s", $employee_user_id);
        $check_duplicate->execute();
        $check_duplicate->store_result();
        $attempts++;
    }

    if ($attempts == $max_attempts) {
        die("Failed to generate a unique employee ID after multiple attempts.");
    }

    $check_duplicate->close();

    // Prepare the SQL INSERT statement for all the fields
    $stmt = $conn->prepare("INSERT INTO run_payslip 
        (employee_user_id, employee_name, gross_salary, email, designation, hire_date, department, manager, location, ifsc_number, bank_name, branch_name, account_number, account_type, dob, gender, phone_number, employee_type, qualifications, resigned_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param(
        "ssdsssssssssssssssss",
        $employee_user_id,
        $employee_name,
        $gross_salary,
        $email,
        $designation,
        $hire_date,
        $department,
        $manager,
        $location,
        $ifsc_number,
        $bank_name,
        $branch_name,
        $account_number,
        $account_type,
        $dob,
        $gender,
        $phone_number,
        $employee_type,
        $qualifications,
        $resigned_date
    );

    // Execute the statement
    if ($stmt->execute()) {
        // Now, create the salary table dynamically for the employee
        $salary_table_name = $employee_user_id . "_salary";

        $create_table_sql = "
        CREATE TABLE IF NOT EXISTS `$salary_table_name` (
        employee_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    month VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
    year INT(11) NOT NULL,
    gross_salary DECIMAL(10,2) DEFAULT NULL,
    advance_amount INT(11) DEFAULT NULL,
    emi_amount INT(11) DEFAULT NULL,
    total_days INT(11) DEFAULT NULL,
    present_days INT(11) DEFAULT NULL,
    absent_days INT(11) DEFAULT NULL,
    net_salary DECIMAL(10,2) DEFAULT NULL,
    payment_status VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'paid',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // Execute the create table query
        if ($conn->query($create_table_sql) === TRUE) {
            // Redirect to 'people.php' after both insertion and table creation
            header("Location: people.php?status=success");
            exit();
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Error executing statement: " . $stmt->error; // Display an error if execution fails
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>