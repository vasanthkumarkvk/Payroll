<?php
// Connection for Payroll Management database

// $servername = "localhost"; 
// $username = "u826147358_payroll_admin";        
// $password = "Vsm_Payroll@123";           
// $dbname = "u826147358_payroll";    

$servername = "localhost"; 
$username = "root";        
$password = "";           
$dbname = "pay";   

// Create connection
$payroll_conn = mysqli_connect($servername, $username, $password, $dbname);

if ($payroll_conn->connect_error) {
    die("Payroll connection failed: " . $payroll_conn->connect_error);
}





// Connection for Service Desk database

// $servername = "localhost";
// $username = "u826147358_service_desk";
// $password = "Vsmglobal@123";
// $dbname = "u826147358_service_desk"; 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test"; 

$service_conn = new mysqli($servername, $username, $password, $dbname);


if ($service_conn->connect_error) {
    die("Service Desk connection failed: " . $service_conn->connect_error);
}




?>
