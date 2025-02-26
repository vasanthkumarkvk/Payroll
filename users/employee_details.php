<?php

include "../db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST['user_id'];
    $employee_name = $_POST['employee_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $account_number = $_POST['account_number'];
    $ifsc_number = $_POST['ifsc_number'];
    $bank_name = $_POST['bank_name'];

    // Insert employee details into the `run_payslip` table
    $sql = "INSERT INTO run_payslip (employee_user_id, employee_name, dob, gender, phone_number, email, location, account_number, ifsc_number, bank_name)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $payroll_conn->prepare($sql)) {
        $stmt->bind_param("ssssssssss", $user_id, $employee_name, $dob, $gender, $phone_number, $email, $address, $account_number, $ifsc_number, $bank_name);

        if ($stmt->execute()) {

            // Sanitize the user_id for use in the table name
            $table_name = preg_replace('/[^a-zA-Z0-9]/', '', $user_id) . "_salary"; // Remove invalid characters

            // Create a dynamic table for the employee salary details
            $create_table_sql = "CREATE TABLE IF NOT EXISTS $table_name (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                employee_id VARCHAR(255) NOT NULL,
                month VARCHAR(50) NOT NULL,
                year INT(11) NOT NULL,
                gross_salary VARCHAR(225) NOT NULL,
                advance_amount DECIMAL(10, 2) NOT NULL,
                emi_amount DECIMAL(10, 2) NOT NULL,
                total_days INT(11) NOT NULL,
                present_days INT(11) NOT NULL,
                absent_days INT(11) NOT NULL,
                net_salary DECIMAL(10, 2) NOT NULL,
                payment_status VARCHAR(50) NOT NULL DEFAULT 'Paid'
            )";

            if ($payroll_conn->query($create_table_sql) === TRUE) {
            } else {
                echo "Error creating salary table: " . $payroll_conn->error;
            }

            // Insert data into `advance_salary` table (only employee_name and user_id)
            $insert_advance_salary_sql = "INSERT INTO advance_salary (employee_name, employee_user_id) 
                                          VALUES (?, ?)";

            if ($stmt_advance = $payroll_conn->prepare($insert_advance_salary_sql)) {
                $stmt_advance->bind_param("ss", $employee_name, $user_id);
                
                if ($stmt_advance->execute()) {

                    header("location:add_details.php");

                } else {
                    echo "Error inserting advance salary: " . $stmt_advance->error;
                }

                $stmt_advance->close();
            } else {
                echo "Error preparing advance salary query: " . $payroll_conn->error;
            }

        } else {
            echo "Error inserting employee details: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the query: " . $payroll_conn->error;
    }

    $payroll_conn->close();
}
?>
