<?php
// Ensure the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include your database connection file (change the path as needed)
    include "../users/db.php";

    // Collect and sanitize the form data
    $employee_id = isset($_POST['employee_id']) ? mysqli_real_escape_string($conn, $_POST['employee_id']) : NULL;
    $employee_name = isset($_POST['employee_name']) ? mysqli_real_escape_string($conn, $_POST['employee_name']) : NULL;
    $reason_select = isset($_POST['reason_select']) ? mysqli_real_escape_string($conn, $_POST['reason_select']) : NULL;
    $other_reason = isset($_POST['other_reason']) ? mysqli_real_escape_string($conn, $_POST['other_reason']) : NULL;
    $role = isset($_POST['role']) ? mysqli_real_escape_string($conn, $_POST['role']) : NULL;
    $other_role = isset($_POST['other_role']) ? mysqli_real_escape_string($conn, $_POST['other_role']) : NULL;
    $additional_info = isset($_POST['additional_info']) ? mysqli_real_escape_string($conn, $_POST['additional_info']) : NULL;
    $join_date = isset($_POST['join_date']) ? mysqli_real_escape_string($conn, $_POST['join_date']) : NULL;
    $relieving_date = isset($_POST['relieving_date']) ? mysqli_real_escape_string($conn, $_POST['relieving_date']) : NULL;

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO reason_exit (employee_id, employee_name, reason, other_reason, role, other_role, additional_info, join_date, relieving_date, created_at)
            VALUES ('$employee_id', '$employee_name', '$reason_select', '$other_reason', '$role', '$other_role', '$additional_info', '$join_date', '$relieving_date', NOW())";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
