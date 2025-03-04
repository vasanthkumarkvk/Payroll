<?php

require '../mailer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "db.php";

session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../login/index.php");
    exit();
}

$name = $_SESSION['name'];

// Retrieve employee data from the database
$sql = "SELECT * FROM employees WHERE name = ?";
$stmt = $service_conn->prepare($sql);
$stmt->bind_param("s", $name);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $name = $row['name'];
        $employee_email = $row['email'];
        $releve_apply_date = date("d-m-Y");

        // Insert the record into releve_apply table
        $insert_sql = "INSERT INTO releve_apply (user_id, name, apply_date) VALUES (?, ?, ?)";
        $insert_stmt = $payroll_conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $user_id, $name, $releve_apply_date);
        
        if ($insert_stmt->execute()) {
            // Send email to HR
            $mail = new PHPMailer(true);
            try {
                // SMTP settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Set SMTP server (replace with your SMTP host)
                $mail->SMTPAuth = true;
                $mail->Username = 'vasanthkvk248@gmail.com'; // SMTP username
                $mail->Password = 'yeap jjvh xyjj qhts'; // SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Email content to HR
                $mail->setFrom('vasanthkvk248@gmail.com', 'Exit Management System');
                $mail->addAddress('bdm@vsmglobaltechnologies.com'); // HR email address (replace with actual HR email)
                $mail->Subject = 'Employee Exit Request Notification';
                $mail->Body = "Dear HR,\n\nThis is to inform you that the following employee has requested to exit:\n\n"
                            . "Name: $name\n"
                            . "Employee ID: $user_id\n"
                            . "Exit Request Date: $releve_apply_date\n\n"
                            . "Please take the necessary actions.\n\nBest regards,\nExit Management System";

                // Send email to HR
                if ($mail->send()) {
                    // Send email to employee
                    $mail->clearAddresses();  // Clear previous recipient (HR)
                    $mail->addAddress($employee_email); // Add employee's email as recipient
                    $mail->Subject = 'Exit Request Acknowledgment';
                    $mail->Body = "Dear $name,\n\nYour exit request has been submitted successfully. It is now under review by HR.\n\nPlease wait for further updates regarding your request.\n\nThank you for your patience.\n\nBest regards,\nExit Management System";

                    // Send email to employee
                    if ($mail->send()) {

                        header("Location: http://payroll.vsmglobaltechnologies.com/exit_management/index.php?name=$name&id=$user_id&email=$employee_email");
                        exit();
                    } else {
                        echo "Error sending email to employee.";
                    }
                } else {
                    echo "Error sending email to HR.";
                }
            } catch (Exception $e) {
                echo "Error: " . $mail->ErrorInfo;
            }
        } else {
            echo "Error inserting into releve_apply table.";
        }
    }
} else {
    echo "Error executing query.";
}
?>
