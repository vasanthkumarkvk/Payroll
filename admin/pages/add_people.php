

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="path/to/your/style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


  <style>
    label {
    color: #000000;
    font-weight: bold;
    font-size: 17px !important;
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
                        <h1 class="welcome-text text-black fw-bold">Add Employee</h1>
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
                                <p class="mb-1 mt-3 fw-semibold">name</p>
                                <p class="fw-light text-muted mb-0">email</p>
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

                   

                </ul>
            </nav>

            <div class="main-panel">
                       




                        <form id="employeeForm" method="POST" action="check_people.php">
    <div class="container">
        <div class="row" style="padding:20px;">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="employee_name">Employee Name:</label>
                    <input type="text" id="employee_name" name="employee_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label id="dob-label">Date of Birth:</label>
                    <input type="date" id="dob" style="cursor: pointer;" name="dob" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="" disabled selected>Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gross_salary">Gross Salary:</label>
                    <input type="number" id="gross_salary" name="gross_salary" class="form-control" required>
                </div>
              
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" id="designation" name="designation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label id="hire-label">Hire Date:</label>
                    <input type="date" id="hire_date" style="cursor: pointer;" name="hire_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="department">Department:</label>
                    <select id="department" name="department" class="form-control" required>
                        <option value="" disabled selected>Select a department</option>
                        <option value="development">Development</option>
                        <option value="design">Design</option>
                        <option value="marketing & Sales">Marketing & Sales</option>
                        <option value="customer_support">Customer Support</option>
                        <option value="finance">Finance</option>
                        <option value="it_operations">IT Operations</option>
                        <option value="data_analytics">Data Analytics</option>
                        <option value="research_development">Business Development Management</option>
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="other-location" name="other-location" placeholder="City, State" class="form-control">
                </div>
                <div class="form-group">
                    <label for="account_number">Account Number:</label>
                    <input type="text" id="account_number" name="account_number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ifsc_number">IFSC Number:</label>
                    <input type="text" id="ifsc_number" name="ifsc_number" class="form-control">
                </div>
                <div class="form-group">
                    <label for="bank_name">Bank Name:</label>
                    <input type="text" id="bank_name" name="bank_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="branch_name">Branch Name:</label>
                    <input type="text" id="branch_name" name="branch_name" class="form-control">
                </div>
            
                <div class="form-group">
                    <label for="account_type">Account Type:</label>
                    <input type="text" id="account_type" name="account_type" class="form-control">
                </div>
      
                <div class="form-group">
                    <label for="employee_type">Employee Type:</label>
                    <select id="employee_type" name="employee_type" class="form-control" required>
                        <option value="" disabled selected>Select Employment type</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Dismissed">Dismissed</option>  
                    </select>
                </div>
                <div class="form-group">
                    <label for="qualifications">Qualifications:</label>
                    <input type="text" id="qualifications" name="qualifications" class="form-control">
                </div>
                <div class="form-group " hidden>
                    <label id="resigned-label">Resigned Date:</label>
                    <input type="text" id="resigned_date" style="cursor: pointer;" name="resigned_date" class="form-control">
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button type="submit" class="btn btn-primary">Add Employee</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='people.php'">Cancel</button>
        </div>
    </div>
</form>






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