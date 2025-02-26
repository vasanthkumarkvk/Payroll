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
            background-color: #1c1e29;
            color: white;
            margin: 0;
            padding: 0;
        }

        .reports-section h2 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .report-card {
            background-color: #1f3bb3;
            padding: 19px;
            margin-bottom: 13px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 90%;
            padding-left: 32px;
            margin-left: 58px;
        }

        .report-card:hover {
            background-color: #3b3f50;
        }

        .report-card h3 {
            margin: 0;
            font-size: 18px;
        }

        .report-card p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #aaa;
        }

        .report-details {
            display: none;
            background-color: #3c3c3c;
            width: 90%;
            margin-left: 58px;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .close-btn {
            color: #black;
            cursor: pointer;
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
                        <h1 class="welcome-text text-black fw-bold">Bonus Report</h1>
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
                        <a class="nav-link" href="../pages/people.php">
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
                                        <a class="nav-link" href="../pages/run_pay.php">
                                            <span class="menu-title">Run Payroll</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../pages/one_time_payment.php">
                                            <span class="menu-title">One-time Payment</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../pages/advance_salary.php">
                                            <span class="menu-title">Advance Salary</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../pages/reimbursement.php">
                                            <span class="menu-title">Reimbursements</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="../pages/loans.php">
                                            <span class="menu-title">Loans</span>
                                        </a>
                                    </li>
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
                        <a class="nav-link" href="../pages/approval.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-check-circle"></i> <!-- Check circle icon -->
                            <span class="menu-title">Approvals</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../pages/report.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-chart-bar"></i> <!-- Chart bar icon -->
                            <span class="menu-title">Reports</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../pages/company_detail.php" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-account"></i> <!-- Account icon -->
                            <span class="menu-title">Company Details</span>
                        </a>
                    </li>


                </ul>
            </nav>


            <div class="main-panel col-lg-12">
                <div class="reports-section row">
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