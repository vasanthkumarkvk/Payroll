<?php include 'approval_check.php'; ?> <!-- Include the PHP file for fetching approvals -->




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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 100%;
            background-color: #fff;

        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-container button {
            margin-left: 10px;
            padding: 10px 15px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-container button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            color: black;
        }


        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-btn {

            /* padding: 10px 15px; */

        }

        .approve-btn {
            background-color: #28a745;
            cursor: pointer;
            border-radius: 5px;
            color: white;
            border: none;
            margin: 4px;

        }

        .deny-btn {
            background-color: red;
            cursor: pointer;
            border-radius: 5px;
            color: white;
            border: none;
            margin: 4px;


        }

        .action-btn:hover {
            background-color: #218838;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                text-align: right;
                position: relative;
                padding-left: 50%;
                color: black;
            }

            .action-btn {
                padding: 7px 5px;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                text-align: left;
                font-weight: bold;
            }
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
                        <h1 class="welcome-text text-black fw-bold">Approvals</h1>
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
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">category</li>
                    <li class="nav-item">
                        <a class="nav-link" href="people.php">
                            <i class="menu-icon mdi mdi-account-multiple"></i> <!-- People icon -->
                            <span class="menu-title">People</span>
                        </a>
                    </li>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#payEmployees" aria-expanded="false"
                                aria-controls="payEmployees">
                                <i class="menu-icon mdi mdi-currency-usd"></i> <!-- USD currency icon -->
                                <span class="menu-title">Pay Employees</span>
                                <i class="menu-arrow"></i> <!-- Optional arrow icon for indication -->
                            </a>
                            <div class="collapse" id="payEmployees">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="run_pay.php">
                                            <span class="menu-title">Run Payroll</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="one_time_payment.php">
                                            <span class="menu-title">One-time Payment</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="advance_salary.php">
                                            <span class="menu-title">Advance Salary</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="reimbursement.php">
                                            <span class="menu-title">Reimbursements</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" href="loans.php">
                                            <span class="menu-title">Loans</span>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                    </ul>

                    <!-- <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#contractor-payment" aria-expanded="false"
                            aria-controls="contractor-payment">
                            <i class="menu-icon mdi mdi-account-cash"></i>
                            <span class="menu-title">Pay Contractor</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="contractor-payment">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="contract_payment.php">
                                        <span class="menu-title">Payments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contract_reimbursement.php">
                                        <span class="menu-title">employee Reimbursements</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> -->



                    <li class="nav-item">
                        <a class="nav-link" href="approval.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-check-circle"></i> <!-- Check circle icon -->
                            <span class="menu-title">Approvals</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="report.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-chart-bar"></i> <!-- Chart bar icon -->
                            <span class="menu-title">Reports</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="company_detail.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-account"></i> <!-- Account icon -->
                            <span class="menu-title">Company Details</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="setting.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-cog"></i> 
                            <span class="menu-title">Settings</span>
                        </a>
                    </li> -->




                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- <div class="row"> -->
                    <div class="container">
                        <h2>Pending Approvals</h2>
                        <div class="btn-container">
                            <button onclick="window.location.href='add_Approval.php'"><i class="fas fa-plus"></i>Add new
                                approval</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Request ID</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Request Type</th>
                                    <th>Amount</th>
                                    <th>Submission Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($approvals) > 0): ?>
                                    <?php foreach ($approvals as $approval): ?>
                                        <!-- Placeholder for dynamically generated table rows from your database -->
                                        <tr>
                                            <td data-label="Request ID"><?php echo $approval['request_id']; ?></td>
                                            <td data-label="Employee ID"><?php echo $approval['employee_user_id']; ?></td>
                                            <td data-label="Employee Name"><?php echo $approval['employee_name']; ?></td>
                                            <td data-label="Request Type"><?php echo $approval['request_type']; ?></td>
                                            <td data-label="Amount"><?php echo '$' . number_format($approval['amount'], 2); ?></td>
                                            <td data-label="Submission Date"><?php echo $approval['submission_date']; ?></td>
                                            <td data-label="Status"><?php echo $approval['status']; ?></td>
                                            <td data-label="Actions">
                                                <button class="approve-btn">Approve</button>
                                                <button class="deny-btn">Deny</button>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                <?php else: ?>
                                <?php endif; ?>

                                <!-- End of static row -->
                            </tbody>
                        </table>
                    </div>
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