<?php
include '../database.php';  // Assuming this is the relative path

// Fetch company data
$sql = "SELECT * FROM company_info WHERE id = 1"; // Fetch the first company's details
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VSM Payroll Management </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/custome_style.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/img/vsmlogo-favicon.png" />


    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 60px;

        }

        .section {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); */
        }

        h2,
        h3 {
            color: black;
            margin-bottom: 15px;

        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }

        .section-header h3 {
            margin: 0;
            font-size: 20px;
        }

        .edit-btn {
            color: #007bff;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
        }

        table th {
            color: black;
            background-color: white;
            width: 30%;
        }

        table td {
            color: black;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
            font-size: 16px;
            margin: 5px;
            min-width: 150px;
        }

        .btn.dismiss {
            background-color: #ffcc00;
        }

        .btn.dismiss:hover {
            background-color: #e6b800;
            transform: scale(1.05);
        }

        .btn.delete {
            background-color: #ff4d4f;
        }

        .btn.delete:hover {
            background-color: #e60000;
            transform: scale(1.05);
        }

        .btn.stop-salary {
            background-color: #f56a00;
        }

        .btn.stop-salary:hover {
            background-color: #d95e00;
            transform: scale(1.05);
        }

        .btn.disable-login {
            background-color: #008cba;
        }

        .btn.disable-login:hover {
            background-color: #007bb5;
            transform: scale(1.05);
        }

        .resend-email {
            color: #007bff;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            margin-left: 20px;
        }
    </style>
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="dashboard.php">
                        <img src="..\img\vsmlogo-favicon.png" alt="logo" />
                    </a>

                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text text-black fw-bold">Company Details</h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-none d-lg-block">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-account-circle people-icon"></i> <!-- People icon -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <p class="mb-1 mt-3 fw-semibold"><?php echo $admin_name; ?></p>
                                <p class="fw-light text-muted mb-0"><?php echo $admin_email; ?></p>
                            </div>
                            <a href="logout.php" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>

        <!-- end of header  -->


        <!-- sidebar  -->
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include "side_nav.php"?>



            <div class="main-panel">
                <div class="content-wrapper">
                <div class="container">
                    <!-- Basic Information Section -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Basic Information</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Company Name:</th>
                                <td><?php echo isset($row['company_name']) ? $row['company_name'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Registered Address:</th>
                                <td><?php echo isset($row['company_address']) ? $row['company_address'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Company Email:</th>
                                <td><?php echo isset($row['company_email']) ? $row['company_email'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Contact Number:</th>
                                <td><?php echo isset($row['company_phone']) ? $row['company_phone'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Website URL:</th>
                                <td><?php echo isset($row['company_website']) ? $row['company_website'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Company Registration Number:</th>
                                <td><?php echo isset($row['company_registration_number']) ? $row['company_registration_number'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Tax Identification Number (TIN):</th>
                                <td><?php echo isset($row['company_tin']) ? $row['company_tin'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>GSTIN / VAT Number:</th>
                                <td><?php echo isset($row['company_gstin']) ? $row['company_gstin'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>

                    <!-- financial Information Section -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Financial Information</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Bank Name:</th>
                                <td><?php echo isset($row['bank_name']) ? $row['bank_name'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Bank Account Number:</th>
                                <td><?php echo isset($row['bank_account_number']) ? $row['bank_account_number'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>IFSC Code / SWIFT Code:</th>
                                <td><?php echo isset($row['ifsc_swift_code']) ? $row['ifsc_swift_code'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Bank Branch:</th>
                                <td><?php echo isset($row['bank_branch']) ? $row['bank_branch'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Payment Terms:</th>
                                <td><?php echo isset($row['payment_terms']) ? $row['payment_terms'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Currency:</th>
                                <td><?php echo isset($row['currency']) ? $row['currency'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>

                    <!-- employee information -->

                    <div class="section">
                        <div class="section-header">
                            <h3>Employee Information</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Total Number of Employees:</th>
                                <td><?php echo isset($row['total_employees']) ? $row['total_employees'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Active Employees:</th>
                                <td><?php echo isset($row['active_employees']) ? $row['active_employees'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Employee Types:</th>
                                <td><?php echo isset($row['employee_types']) ? $row['employee_types'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Department Distribution:</th>
                                <td><?php echo isset($row['department_distribution']) ? $row['department_distribution'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>

                    <!-- payroll structure details -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Payroll Structure</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Salary Cycle:</th>
                                <td><?php echo isset($row['salary_cycle']) ? $row['salary_cycle'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Salary Components:</th>
                                <td><?php echo isset($row['salary_components']) ? $row['salary_components'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Deductions:</th>
                                <td><?php echo isset($row['deductions']) ? $row['deductions'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Bonus and Incentive Policies:</th>
                                <td><?php echo isset($row['bonus_incentive_policies']) ? $row['bonus_incentive_policies'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Leave and Attendance Policies:</th>
                                <td><?php echo isset($row['leave_attendance_policies']) ? $row['leave_attendance_policies'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>

                    <!-- Company Compliance & Legal Information -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Compliance & Legal Information</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Provident Fund Account Number:</th>
                                <td><?php echo isset($row['pf_account_number']) ? $row['pf_account_number'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Employee State Insurance (ESI) Number:</th>
                                <td><?php echo isset($row['esi_number']) ? $row['esi_number'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Professional Tax Registration:</th>
                                <td><?php echo isset($row['tax_registration']) ? $row['tax_registration'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>EPF Employer Contribution Rate:</th>
                                <td><?php echo isset($row['epf_employer_rate']) ? $row['epf_employer_rate'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>ESI Employer Contribution Rate:</th>
                                <td><?php echo isset($row['esi_employer_rate']) ? $row['esi_employer_rate'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>


                    <!-- tax information section -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Tax Information</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Tax Year Start:</th>
                                <td><?php echo isset($row['tax_year_start']) ? $row['tax_year_start'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Tax Year End:</th>
                                <td><?php echo isset($row['tax_year_end']) ? $row['tax_year_end'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Corporate Tax Details:</th>
                                <td><?php echo isset($row['corporate_tax_details']) ? $row['corporate_tax_details'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Tax Filing Frequency:</th>
                                <td><?php echo isset($row['tax_filing_frequency']) ? $row['tax_filing_frequency'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Employer Contribution to Employee Taxes:</th>
                                <td><?php echo isset($row['employer_tax_contribution']) ? $row['employer_tax_contribution'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>

                    <!-- other information about company -->
                    <div class="section">
                        <div class="section-header">
                            <h3>Other Information</h3>
                            <span class="edit-btn">Edit</span>
                        </div>
                        <table>
                            <tr>
                                <th>Working Hours Policy:</th>
                                <td><?php echo isset($row['working_hours_policy']) ? $row['working_hours_policy'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Overtime Policy:</th>
                                <td><?php echo isset($row['overtime_policy']) ? $row['overtime_policy'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Holidays List:</th>
                                <td><?php echo isset($row['holidays_list']) ? $row['holidays_list'] : ''; ?></td>
                                </tr>
                            <tr>
                                <th>Company Policy Documents</th>
                                <td><?php echo isset($row['company_policy_docs']) ? $row['company_policy_docs'] : ''; ?></td>
                                </tr>
                        </table>
                    </div>


                    <!-- Action Buttons -->
                    <!-- <div class="action-buttons">
                                <button class="btn dismiss">Dismiss Employee</button>
                                <button class="btn delete">Delete Employee</button>
                                <button class="btn stop-salary">Stop Salary</button>
                                <button class="btn disable-login">Disable Login</button>
                            </div> -->

                </div>




                <!-- </div> -->
                </div>
            </div>

        </div>





        <!-- footer -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> <a
                        href="https://www.vsmglobaltechnologies.com/" target="_blank">VSM Global
                        Technologies.com</a>
                </span>
                <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights
                    reserved.</span>
            </div>
        </footer>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../assets/js/dashboard.js"></script>

</body>

</html>