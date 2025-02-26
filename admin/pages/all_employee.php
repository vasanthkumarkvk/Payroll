<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VSM Payroll Management </title>
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/custome_style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/img/vsmlogo-favicon.png" />
    <style>
        .view-btn {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .view-btn:hover {
            background-color: #0056b3;
        }

        .view-btn:focus {
            outline: none;
            box-shadow: 0 0 4px #0056b3;
        }

        span.icon-menu {
            color: black;
        }

        .green-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #f95f53;
            border-radius: 50%;
            margin-left: 5px;
            vertical-align: middle;
        }
    </style>
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../dashboard.php">
                        <img src="../img/vsmlogo-favicon.png" alt="logo" />
                    </a>

                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h6 class="welcome-text text-black fw-bold">Pay Slip</h6>
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
                            <i class="mdi mdi-account-circle people-icon"></i>
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
        <div class="container-fluid page-body-wrapper">
            <?php include "side_nav.php"; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-container" style="overflow-y: scroll; max-height: 700px;">
                                <h2 class="text-center mb-4">Employee Payslip Details</h2>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Gross Salary</th>
                                            <th>Email ID</th>
                                            <th>Designation</th>
                                            <th>View Pay Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "../database.php";
                                        // First query for Full-time employees
                                        $sql = "SELECT * FROM run_payslip WHERE employee_type = 'Full-time'";
                                        $result = $conn->query($sql);
                                        // Display Full-time employees first
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                // Generate a green dot for active employees
                                                $greenDot = "<span class='green-dot'></span>"; // Full-time employees are always active
                                                echo "<tr class='all-employee-table-row'>";
                                                echo "<td class='id'>" . htmlspecialchars($row['employee_user_id']) . $greenDot . "</td>"; // Employee ID with green dot
                                                echo "<td><a href='employee_detail.php?id=" . htmlspecialchars($row['employee_user_id']) . "' class='no-underline'>" . htmlspecialchars($row['employee_name']) . "</a></td>"; // Employee Name
                                                echo "<td>₹" . number_format($row['gross_salary'], 2) . "</td>"; // Formatted Gross Salary
                                                echo "<td>" . htmlspecialchars($row['email']) . "</td>"; // Email ID
                                                echo "<td>" . htmlspecialchars($row['designation']) . "</td>"; // Designation
                                                echo "<td><button type='button' class='view-btn' onclick='redirectToPaySlip(" .
                                                    number_format($row['gross_salary'], 2, '.', '') . ", " .
                                                    json_encode($row['email']) . ", " .
                                                    json_encode($row['pay_month']) . ", " .
                                                    json_encode($row['employee_user_id']) . ")'>Salary History</button></td>";

                                                echo "</tr>";
                                            }
                                        }
                                        // Then query for other employees (not Full-time)
                                        $sql = "SELECT * FROM run_payslip WHERE employee_type != 'Full-time'";
                                        $result = $conn->query($sql);

                                        // Display other employees
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {

                                                // No green dot for non-full-time employees
                                                $greenDot = "";

                                                echo "<tr class='all-employee-table-row'>";
                                                echo "<td>" . htmlspecialchars($row['employee_user_id']) . $greenDot . "</td>"; // Employee ID without green dot
                                                echo "<td><a href='employee_detail.php?id=" . htmlspecialchars($row['employee_user_id']) . "' class='no-underline'>" . htmlspecialchars($row['employee_name']) . "</a></td>"; // Employee Name
                                                echo "<td>₹" . number_format($row['gross_salary'], 2) . "</td>"; // Formatted Gross Salary
                                                echo "<td>" . htmlspecialchars($row['email']) . "</td>"; // Email ID
                                                echo "<td>" . htmlspecialchars($row['designation']) . "</td>"; // Designation

                                                echo "<td><button type='button' class='view-btn' onclick='redirectToPaySlip(" .
                                                    number_format($row['gross_salary'], 2, '.', '') . ", " .
                                                    json_encode($row['email']) . ", " .
                                                    json_encode($row['pay_month']) . ", " .
                                                    json_encode($row['employee_user_id']) . ")'>Salary History</button></td>";

                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
                                        }

                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function redirectToPaySlip(grossSalary, email, payMonth, id) {
                fetch('check_mail.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.found) {
                            window.location.href = `previous.php?gross=${grossSalary}&email=${encodeURIComponent(email)}&pay_month=${encodeURIComponent(payMonth)}&user_id=${encodeURIComponent(id)}&type=manual`;
                        } else {
                            let url = `payment_history.php?gross=${grossSalary}&email=${encodeURIComponent(email)}&pay_month=${encodeURIComponent(payMonth)}&user_id=${encodeURIComponent(id)}`;
                            window.location.href = url;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>
        <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="../assets/vendors/chart.js/chart.umd.js"></script>
        <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/template.js"></script>
        <script src="../assets/js/settings.js"></script>
        <script src="../assets/js/hoverable-collapse.js"></script>
        <script src="../assets/js/todolist.js"></script>
        <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
        <script src="../assets/js/dashboard.js"></script>
</body>

</html>