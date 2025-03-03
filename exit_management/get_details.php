<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];  // Ensure you pass `user_id` in a hidden input
    $name = $_POST['employee_name'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $gender = $_POST['gender'];
    $salary = $_POST['salary'];
    $last_working_day = $_POST['last_working_day'];
    $reason = $_POST['reason'];
    $other_reason = isset($_POST['other_reason']) ? $_POST['other_reason'] : null;
    $salary_hold = isset($_POST['salary_hold']) ? 'Yes' : 'No';

    // If the selected reason is "Others", store the other reason
    if ($reason !== "Others") {
        $other_reason = null;
    }

    // Insert data into the database
    $sql = "INSERT INTO exit_office (user_id, name, designation, department, gender, salary, last_working_day, reason, other_reason, salary_hold) 
            VALUES ('$user_id', '$name', '$designation', '$department', '$gender', '$salary', '$last_working_day', '$reason', '$other_reason', '$salary_hold')";

    if (mysqli_query($payroll_conn, $sql)) {
        echo "<script>alert('Exit request submitted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($payroll_conn);
    }
}
?>
