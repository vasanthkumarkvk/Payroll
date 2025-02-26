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
        /* General Layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 60px;
            margin: -2px;
        }

        .sidebar {
            width: 250px;
            /* background-color: #343a40; */
            color: #fff;
            min-height: 100vh;
        }

        .sidebar-header {
            padding: 20px;
            background-color: #007bff;
            text-align: center;
        }

        .sidebar-menu {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar-menu li {
            border-bottom: 1px solid #444;
        }

        .sidebar-menu a {
            color: #fff;
            padding: 15px 20px;
            display: block;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: #495057;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 4px;
        }

        .tab-btn.active {
            background-color: #0056b3;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        h2,
        h3 {
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #343a40;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        .btn-submit {
            padding: 10px 15px;
            background: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
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
                        <h1 class="welcome-text text-black fw-bold">Contract Employee Reimbursements</h1>
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
                    <!-- <div class="col-sm-12"> -->

                    <div class="container">
                        <h2>Contract Employee Reimbursement</h2>
                        <form action="#" method="POST" class="reimbursement-form">
                            <div class="form-group">
                                <label for="reimbursement-employee-id">Contract Employee ID</label>
                                <input type="text" id="reimbursement-employee-id" name="reimbursement-employee-id"
                                    placeholder="Enter Contract Employee ID" required>
                            </div>
                            <div class="form-group">
                                <label for="reimbursement-employee-name">Contract Employee Name</label>
                                <input type="text" id="reimbursement-employee-name" name="reimbursement-employee-name"
                                    placeholder="Enter Contract employee name" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" id="department" name="department" placeholder="Enter department"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" id="designation" name="designation" placeholder="Enter designation"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="reimbursement-amount">Reimbursement Amount</label>
                                <input type="number" id="reimbursement-amount" name="reimbursement-amount"
                                    placeholder="Enter reimbursement amount" required>
                            </div>
                            <div class="form-group">
                                <label for="reimbursement-date">Reimbursement Date</label>
                                <input type="date" id="reimbursement-date" style="cursor: pointer;"
                                    name="reimbursement-date" required>
                            </div>
                            <div class="form-group">
                                <label for="expense-type">Expense Type</label>
                                <select id="expense-type" name="expense-type" required>
                                    <option value="" disabled selected>Select expense type</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Food">Food</option>
                                    <option value="Office Supplies">Office Supplies</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" placeholder="Enter description"
                                    required></textarea>
                            </div>
                            <!-- <div class="form-group">
                            <label for="reference-number">Reference Number</label>
                            <input type="text" id="reference-number" name="reference-number"
                                placeholder="Enter reference number">
                        </div> -->
                            <div class="form-group">
                                <label for="tax-deductible">Tax Deductible</label>
                                <select id="tax-deductible" name="tax-deductible" required>
                                    <option value="" disabled selected>Select option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tax-amount">Tax Amount</label>
                                <input type="number" id="tax-amount" name="tax-amount" placeholder="Enter tax amount">
                            </div>
                            <div class="form-group">
                                <label for="net-amount">Net Amount</label>
                                <input type="number" id="net-amount" name="net-amount"
                                    placeholder="Final amount after tax">
                            </div>
                            <div class="form-group">
                                <label for="approval-status">Approval Status</label>
                                <select id="approval-status" name="approval-status" required>
                                    <option value="" disabled selected>Select status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Denied">Denied</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="approver-name">Approver Name</label>
                                <input type="text" id="approver-name" name="approver-name"
                                    placeholder="Enter approver name">
                            </div>
                            <div class="form-group">
                                <label for="approval-date">Approval Date</label>
                                <input type="date" id="approval-date" style="cursor: pointer;" name="approval-date">
                            </div>
                            <div class="form-group">
                                <label for="comments">Comments/Notes</label>
                                <textarea id="comments" name="comments" placeholder="Enter comments"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="supporting-docs">Supporting Documents</label>
                                <input type="file" id="supporting-docs" name="supporting-docs">
                            </div>
                            <div class="form-group">
                                <label for="last-updated">Last Updated</label>
                                <input type="text" id="last-updated" name="last-updated"
                                    placeholder="Timestamp of last update" readonly>
                            </div>
                            <div class="form-group">
                                <label for="admin-user">Admin User</label>
                                <input type="text" id="admin-user" name="admin-user"
                                    placeholder="Identification of admin user" required>
                            </div>
                            <div class="form-group">
                                <label for="payment-method">Payment Method</label>
                                <select id="payment-method" name="payment-method" required>
                                    <option value="" disabled selected>Select payment method</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Check">Check</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="transaction-id">Transaction ID</label>
                                <input type="text" id="transaction-id" name="transaction-id"
                                    placeholder="Enter transaction ID">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-submit">Submit Reimbursement</button>
                            </div>
                        </form>
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