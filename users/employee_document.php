<?php
// Include your database connection
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $conformation_process = 1 ;

    // Process uploaded files
    function processFileUpload($fileKey, $upload_dir) {
        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $file_name = time() . "_" . basename($_FILES[$fileKey]['name']);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $file_path)) {
            return $file_path;
        }

        return null;
    }

    $certificate_path = processFileUpload('certificate', $upload_dir);
    $exp_certificate_path = processFileUpload('exp_certificate', $upload_dir);
    $course_certificate_path = processFileUpload('course_certificate', $upload_dir);

    // Check if the user already exists
    $check_stmt = $payroll_conn->prepare("SELECT COUNT(*) FROM run_payslip WHERE employee_user_id = ?");
    $check_stmt->bind_param('s', $user_id);
    $check_stmt->execute();
    $check_stmt->bind_result($exists);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($exists > 0) {
        // Update existing record
        $update_stmt = $payroll_conn->prepare("
            UPDATE run_payslip
            SET degree_certificate = ?, experiance_certificate = ?, course_certificate = ?, conformation_process = ?
            WHERE employee_user_id = ?
        ");
        $update_stmt->bind_param(
            'sssss',
            $certificate_path,
            $exp_certificate_path,
            $course_certificate_path,
            $conformation_process,
            $user_id
        );

        if ($update_stmt->execute()) {

            header("location: ../dashboard.php");

        } else {
            echo "Error: " . $update_stmt->error;
        }

        $update_stmt->close();
    } 

    $payroll_conn->close();
} else {
    echo "Invalid request.";
}
