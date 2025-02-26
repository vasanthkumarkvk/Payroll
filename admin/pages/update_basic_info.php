<?php


include  "../database.php";


// update_basic_info.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $designation = $_POST['designation'];
    $department = $_POST['department'];
    $manager = $_POST['manager'];
    $hire_date = $_POST['hire_date'];

  

    // Update query
    $sql = "UPDATE run_payslip SET designation=?, department=?, manager=?, hire_date=? WHERE employee_user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $designation, $department, $manager, $hire_date, $employee_id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
