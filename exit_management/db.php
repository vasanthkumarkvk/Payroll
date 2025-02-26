<?php
// Connection for Payroll Management database
$payroll_host = "localhost"; // Replace with the actual domain or IP
$payroll_user = "root";
$payroll_pass = "";
$payroll_db = "payy";

$payroll_conn = new mysqli($payroll_host, $payroll_user, $payroll_pass, $payroll_db);
if ($payroll_conn->connect_error) {
    die("Payroll connection failed: " . $payroll_conn->connect_error);
}

// Connection for Service Desk database
$servicedesk_host = "localhost"; // Replace with the actual domain or IP
$servicedesk_user = "root";
$servicedesk_pass = "";
$servicedesk_db = "service_desk";

$service_conn = new mysqli($servicedesk_host, $servicedesk_user, $servicedesk_pass, $servicedesk_db);
if ($service_conn->connect_error) {
    die("Service Desk connection failed: " . $service_conn->connect_error);
}


?>
