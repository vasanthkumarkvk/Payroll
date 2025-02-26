<?php
include '../database.php'; // Include the database connection

// Get the employee email from the URL and check if it's set
$employee_email = isset($_GET['email']) ? $_GET['email'] : null;

if ($employee_email) {
    // Prepare the SQL query to fetch employee details from the manual_salary table
    $sql = "SELECT * FROM manual_salary WHERE email = ? ORDER BY year DESC, month DESC";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the employee email as a string
        $stmt->bind_param("s", $employee_email);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Initialize an array to store monthly data
        $salary_data = [];
        // Check if any data was returned
        if ($result && $result->num_rows > 0) {
            // Fetch the employee details (user_id, name, etc.)
            $row = $result->fetch_assoc();
            $user_id = htmlspecialchars($row['user_id']);
            $employee_name = htmlspecialchars($row['name']); // Assuming 'name' is available in the manual_salary table

            // Store the data in an array for monthly processing
            do {
                $month = $row['month'];
                $year = $row['year'];
                $gross = $row['gross'];
                $salary = $row['salary'];
                $incentive = $row['incentive'] ?? '0.00'; // Add incentive with default value


                // Store monthly data in an associative array
                $salary_data[$year][$month] = [
                    'gross' => $gross,
                    'salary' => $salary,
                    'incentive' => $incentive // Store incentive in the array

                ];


            } while ($row = $result->fetch_assoc());
        } else {
            $user_id = "No employee found with the given email.";
            $employee_name = $user_id;
        }

        // Close the statement
        $stmt->close();
    } else {
        $user_id = "Error preparing the statement.";
        $employee_name = $user_id;
    }
} else {
    $user_id = "No employee email provided.";
    $employee_name = $user_id;
}

// Close the database connection
$conn->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Ensure FontAwesome is linked if using icons -->



    <style>
        /* General Layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;

        }



        h2 {
            color: black;
            font-size: bold;
        }



        /* download */

        .button-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .download-btn {
            background-color: #1f3bb3;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            position: relative;
            /* width: 100px;
            height: 100px; */
            justify-content: center;
            cursor: pointer;
            outline: none;
            transition: transform 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 30px;

        }

        .animatee .svg-path {
            animation: draw 0.5s ease forwards;
        }

        .hidden_ani {
            display: none;
        }

        @keyframes draw {
            0% {
                stroke-dasharray: 0, 100;
                /* Start hidden */
            }

            100% {
                stroke-dasharray: 100, 0;
                /* Fully drawn */
            }
        }

        .btn-r {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;

        }

        .download-btn:hover {
            transform: scale(1.1);
        }






        .circle {
            width: 50px;
            height: 50px;
            fill: none;
            stroke-width: 3px;
            stroke-linecap: round;
            stroke-linejoin: round;
            transform: rotate(90deg);
        }

        .download-btn:hover .circle {
            stroke: #45a049;
        }


        .icon {
            position: absolute;
            width: 25px;
            height: 25px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 9px;
            color: white;
            /* padding-bottom: 36px; */
            align-items: center;
        }




        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
            max-width: 95%;
            padding-right: calc(var(--bs-gutter-x)* 0.5);
            padding-left: calc(var(--bs-gutter-x)* 0.5);
            /* margin-top: 16px; */
            margin-left: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 0;


        }

        #salaryTable {
            width: 100%;
            border-collapse: collapse;

            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            text-align: left;
        }

        #salaryTable th,
        #salaryTable td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        #salaryTable th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }


        #salaryTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #salaryTable caption {
            font-size: 1.5em;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }


        .content-wrapper {
            padding: 0;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        .table th {
            background-color: #f2f5f9;
            font-weight: bold;
            color: #333;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        /* Hover effect for rows */
        .table tbody tr:hover {
            background-color: #e6f7ff;
            cursor: pointer;
        }

        /* Excel-like grid lines and alignment */
        .table th,
        .table td {
            border: 1px solid #ddd;
            box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.05);
        }

        .back-btn {
            background: #1F3BB3;
            color: #ffffff;
            width: 50px;
            height: 50px;
            border-radius: 30px;
            margin: 20px;
            border: none;

        }

        .table th:first-child,
        .table td:first-child {
            background-color: #f2f5f9;
            font-weight: bold;
            text-align: left;
            padding-left: 15px;
        }

        /* Responsive styling for mobile devices */
        @media (max-width: 768px) {

            .container {
                padding: 5px;
            }

            .table {
                width: 95%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                font-size: 14px;
                max-width: 100%;
                padding-right: calc(var(--bs-gutter-x)* 0.5);
                padding-left: calc(var(--bs-gutter-x)* 0.5);
                /* margin-top: 16px; */
                margin-left: 11px;
                overflow-x: scroll;
                padding: 0;

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
                    <a class="navbar-brand brand-logo" href="../dashboard.php">
                        <img src="..\img\vsmlogo-favicon.png" alt="logo" />
                    </a>

                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h6 class="welcome-text text-black fw-bold">Pay Details</h6>
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


                </ul>
            </nav>



            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="btn-r">
                            <button id="backButton" class="back-btn" onclick="window.location.href='all_employee.php'">
                                <i class="fas fa-arrow-left"></i>
                            </button>



                            <button id="downloadButton" class="download-btn">
                                <svg class="circle" viewBox="0 0 100 100">
                                    <path class="svg-path hidden_ani" id="download_path"
                                        d="M 50, 50 m -48, 0 a 48,48 0 1,0 96,0 a 48,48 0 1,0 -96,0" />
                                </svg>
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                        stroke="white" stroke-width="2" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 3v18m0 0l-6-6m6 6l6-6" />
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                        <script>
                            document.getElementById('downloadButton').addEventListener('click', function () {
                                // Add animation class
                                this.classList.add('animatee');
                                const path = document.getElementById('download_path');
                                path.classList.remove("hidden_ani");

                                // Collect salary data from the table
                                const table = document.getElementById('salaryTable');
                                const rows = table.querySelectorAll('tbody tr');
                                const salaryData = {};
                                let employeeID = '';
                                let employeeName = '';

                                rows.forEach(row => {
                                    const cells = row.querySelectorAll('td');
                                    employeeID = cells[0].textContent.trim();       // Employee ID
                                    employeeName = cells[1].textContent.trim();     // Employee Name
                                    const year = cells[2].textContent.trim();       // Year
                                    const month = cells[3].textContent.trim();      // Month
                                    const grossSalary = cells[4].textContent.trim(); // Gross Salary
                                    const incentive = cells[5].textContent.trim();   // Incentive
                                    const netSalary = cells[6].textContent.trim();   // Net Salary

                                    // Organize data in a nested structure
                                    if (!salaryData[year]) {
                                        salaryData[year] = {};
                                    }

                                    salaryData[year][month] = {
                                        gross: grossSalary,
                                        incentive: incentive,
                                        salary: netSalary
                                    };
                                });

                                // Send the collected data to the PHP script using fetch()
                                fetch('manual_salary_download.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        salary_data: salaryData,
                                        employee_id: employeeID,
                                        employee_name: employeeName
                                    })
                                })
                                    .then(response => response.blob())  // Expecting a Blob (Excel file)
                                    .then(blob => {
                                        // Create a link element to download the file
                                        const link = document.createElement('a');
                                        link.href = URL.createObjectURL(blob);
                                        link.download = 'employee_salary_details.xlsx'; // Set file name
                                        link.click();
                                    })
                                    .catch(error => {
                                        console.error('Error downloading the file:', error);
                                    });

                                // Optionally, remove the animation class after a delay
                                setTimeout(() => {
                                    this.classList.remove('animatee');
                                }, 500);
                            });
                        </script>





                        <h2><span id="employeeName" style="color: red; font-weight: bold;"><?php echo $employee_name; ?>
                            </span> Salary Details - <span id="currentYearDisplay"></span></h2>
                        <script>
                            document.getElementById("currentYearDisplay").textContent = new Date().getFullYear();
                        </script>



                        <!-- Employee Salary Details Table -->
                        <div class="table">
                            <table id="salaryTable">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Gross Salary</th>
                                        <th>Incentive</th>
                                        <th>Net Salary</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php if ($employee_email && isset($salary_data[$year][$month])): ?>
                                        <!-- <table border="1"> -->

                                    <tbody>
                                        <?php
                                        // Loop through each year and month to display salary data
                                        foreach ($salary_data as $year => $months) {
                                            foreach ($months as $month => $data) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($user_id) . "</td>"; // Display employee_id
                                                echo "<td>" . htmlspecialchars($employee_name) . "</td>"; // Display employee_name
                                                echo "<td>" . htmlspecialchars($year) . "</td>";
                                                echo "<td>" . htmlspecialchars($month) . "</td>";
                                                echo "<td>" . htmlspecialchars($data['gross']) . "</td>";
                                                echo "<td>" . htmlspecialchars($data['incentive'] ?? '0.00') . "</td>"; // Display incentive or default to 0.00
                                                echo "<td>" . htmlspecialchars($data['salary']) . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <!-- </table> -->
                                <?php else: ?>
                                    <p><?php echo htmlspecialchars($employee_name); ?></p>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>









        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
        <script>
            const svgPath = document.querySelector(".svg-path");
            const countElem = document.querySelector(".counter");

            gsap.set(svgPath, { stroke: "cyan", strokeWidth: 2, strokeDasharray: "301", strokeDashoffset: 301 });

            gsap.to(svgPath, {
                strokeDashoffset: 0,
                duration: 3,
                delay: 0.5,
                ease: "power1.inOut",
            });


        </script>



    

        <script>
            function disableSubmitButton() {
                document.getElementById("submit-button").disabled = true; // Disable the button
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    </div>
    </div>
    <!-- partial -->
    </div>
    <!-- footer -->
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
    <script src="../assets/js/plate.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../assets/js/dashboard.js"></script>

</body>

</html>