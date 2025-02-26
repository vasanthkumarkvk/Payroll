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
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
