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
            padding: 16px;
            margin-bottom: 6px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 88%;
            padding-left: 30px;
            margin-left: 28px;
        }

        a {
            text-decoration: none;
        }

        h3 {
            color: white;
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

    <?php  include "top_nav.php";  ?>

        <div class="container-fluid page-body-wrapper">
            <?php include "side_nav.php"; ?>

            <div class="main-panel col-lg-12">
                <div class="reports-section row">
                    <h2>Reports</h2>
                    <div class="col-lg-6">
                        <!-- Salary Register -->
                        <a href="../report/salary.php">
                            <div class="report-card" onclick="showDetails('salaryRegister')">
                                <h3>Salary Register</h3>
                                <p>View details of past and upcoming payrolls</p>
                            </div>
                        </a>

                        <!-- Master CTC Report -->
                        <a href="../report/master_ctc.php">
                            <div class="report-card" onclick="showDetails('masterCtcReport')">
                                <h3>Master CTC Report</h3>
                                <p>View CTC with a breakup for employees</p>
                            </div>
                        </a>

                        <!-- HR Register -->
                        <a href="../report/hr.php">
                            <div class="report-card" onclick="showDetails('hrRegister')">
                                <h3>HR Register</h3>
                                <p>View past & current employees and contractors</p>
                            </div>
                        </a>

                        <!-- documents Reports ... -->
                        <a href="../report/documents.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Documents</h3>
                                <p>View all documents for current employees</p>
                            </div>
                        </a>

                        <!-- attendance Reports ... -->
                        <a href="../report/attendance.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Attendance</h3>
                                <p>view all your employees attendance</p>
                            </div>
                        </a>


                    </div>

                    <div class="col-lg-6">
                        <!-- audit  Reports ... -->
                        <a href="../report/audit.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Audit Report</h3>
                                <p>View all the changes made by your employees</p>
                            </div>
                        </a>

                        <!-- reimbursements Reports ... -->
                        <a href="../report/reimbursement_report.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Reimbursements</h3>
                                <p>View all reimbursements report </p>
                            </div>
                        </a>

                        <!-- ledger Reports ... -->
                        <!-- <a href="../report/ledger.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Ledger</h3>
                                <p>View account transactions</p>
                            </div>
                        </a> -->

                        <!-- loan summary Reports ... -->
                        <a href="../report/loan_summary.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Loan summary</h3>
                                <p>View Loan : active and closed</p>
                            </div>
                        </a>

                        <!-- bonus Reports ... -->
                        <a href="../report/bonus.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Bonus Report</h3>
                                <p>View all employees Bonus </p>
                            </div>
                        </a>

                        <!-- tax Reports ... -->
                        <a href="../report/tax_deduction.php">
                            <div class="report-card" onclick="showDetails('')">
                                <h3>Tax Deductions</h3>
                                <p>View all your employees tax Deductions</p>
                            </div>
                        </a>
                    </div>










                    <!-- <div id="salaryRegister" class="report-details">
                        <h3>Salary Register Details</h3>
                        <p>Here you can view all the past and upcoming payrolls.</p>
                        <span class="close-btn" onclick="hideDetails('salaryRegister')">Close</span>
                    </div>

                    <div id="masterCtcReport" class="report-details">
                        <h3>Master CTC Report Details</h3>
                        <p>This report shows a detailed CTC breakup for each employee.</p>
                        <span class="close-btn" onclick="hideDetails('masterCtcReport')">Close</span>
                    </div>

                    <div id="hrRegister" class="report-details">
                        <h3>HR Register Details</h3>
                        <p>Here you can view the details of past and current employees and contractors.</p>
                        <span class="close-btn" onclick="hideDetails('hrRegister')">Close</span>
                    </div> -->

                </div>
            </div>


            <!-- <script>
                function showDetails(reportId) {
                    const reports = document.querySelectorAll('.report-details');
                    reports.forEach(report => report.style.display = 'none');

                    document.getElementById(reportId).style.display = 'block';
                }

                function hideDetails(reportId) {
                    document.getElementById(reportId).style.display = 'none';
                }
            </script> -->
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