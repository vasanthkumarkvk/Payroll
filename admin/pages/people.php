<?php
// Include your database connection
include "../database.php";

// Fetch data from the employee table
$sql = "SELECT * FROM run_payslip"; // Fetch only the needed columns
$result = $conn->query($sql);

$employees = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
$conn->close(); // Close the database connection

session_start(); // Start the session
// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    // User is not logged in, redirect to login page
    header("Location: index.php"); // Change 'login.php' to your actual login page
    exit(); // Stop executing the rest of the script
}
$admin_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'admin@example.com'; // Default email if not set
$admin_name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; // Default name if not set

?>


<?php include "header.php";?>

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
                        <h1 class="welcome-text text-black fw-bold">People</h1>
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
                                <p class="mb-1 mt-3 fw-semibold">Name</p>
                                <p class="fw-light text-muted mb-0">Email</p>
                            </div>
                            <a href="../logout.php" class="dropdown-item"><i
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
        <div class=" page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include "side_nav.php";?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-bar">
                                <input type="text" placeholder="Search by name, email or employee id" />
                                <button>Search</button>
                                <!-- <a class="add-employee-btn" onclick="window.location.href = 'add_people.php'">
                                    <p><strong>Add <span></span><i class="bi bi-person-plus"></i></strong></p>
                                </a> -->
                            </div>



                            <div class="home-tab " style="padding: 0;">
                                <div
                                    class="tab-menu d-sm-flex align-items-center justify-content-between border-bottom" style="margin-top:18px";>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                href="#dashboard" role="tab" aria-controls="dashboard"
                                                aria-selected="true">All </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences"
                                                role="tab" aria-selected="false">Employees</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                href="#notification" role="tab" aria-selected="false">Contractors
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="more-tab" data-bs-toggle="tab" href="#more"
                                                role="tab" aria-selected="false">Dismissed </a>
                                        </li>
                                    </ul>
                                </div>



                                <div class="tab-content tab-content-basic">
                                    <!-- All Employees Section -->
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="employee-list" id="employee">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Employee ID</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Hired Date</th> <!-- New Hire Date Header -->
                                                        <th>Details</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($employees)): ?>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($employee['employee_user_id']); ?>
                                                                </td>
                                                                <td>
                                                                    <a href='employee_detail.php?id=<?php echo htmlspecialchars($employee['employee_user_id']); ?>'
                                                                        class='no-underline'>
                                                                        <?php echo htmlspecialchars($employee['employee_name']); ?>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo htmlspecialchars($employee['designation']); ?>
                                                                </td>
                                                                <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                                                                
                                                                <td>
                                                                    <button type="button" class="styled-button" onclick="window.location.href='employee_detail.php?id=<?php echo htmlspecialchars($employee['employee_user_id']); ?>'" >
                                                                        View
                                                                    </button>
                                                                </td>    
                                                                <!-- New Hire Date Column -->

                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="2" class="text-center">No records found</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>



                                    <!-- Employees Section -->

                                    <div class="tab-pane fade" id="audiences" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <div class="employee-list" id="employeeDetails">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Employee ID</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Hired Date</th> <!-- New Hire Date Header -->


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($employees)): ?>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <?php if ($employee['employee_type'] == 'Full-time'): ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars($employee['employee_user_id']); ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href='employee_detail.php?id=<?php echo htmlspecialchars($employee['employee_user_id']); ?>'
                                                                            class='no-underline'>
                                                                            <?php echo htmlspecialchars($employee['employee_name']); ?>
                                                                        </a>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($employee['designation']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>

                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="3" class="text-center">No records found</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Contractor Section -->
                                    <div class="tab-pane fade" id="notification" role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        <div class="employee-list" id="contractorDetails">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Employee ID</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Hired Date</th> <!-- New Hire Date Header -->


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($employees)): ?>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <?php if ($employee['employee_type'] == 'Contract'): ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars($employee['employee_user_id']); ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href='employee_detail.php?employee_user_id=<?php echo htmlspecialchars($employee['employee_user_id']); ?>'
                                                                            class='no-underline'>
                                                                            <?php echo htmlspecialchars($employee['employee_name']); ?>
                                                                        </a>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($employee['designation']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>

                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="3" class="text-center">No records found</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Dismissed Section -->
                                    <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">
                                        <div class="employee-list" id="dismissedDetails">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Employee ID</th>
                                                        <th>Name</th>
                                                        <th>Designation</th>
                                                        <th>Hired Date</th> <!-- New Hire Date Header -->


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($employees)): ?>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <?php if ($employee['employee_type'] == 'Dismissed'): ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars($employee['employee_user_id']); ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href='employee_detail.php?employee_user_id=<?php echo htmlspecialchars($employee['employee_user_id']); ?>'
                                                                            class='no-underline'>
                                                                            <?php echo htmlspecialchars($employee['employee_name']); ?>
                                                                        </a>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($employee['designation']); ?>
                                                                    </td>
                                                                    <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>

                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="3" class="text-center">No records found</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <script>
                                    function filterEmployees(type) {
                                        var rows = document.querySelectorAll('#employee table tbody tr');
                                        rows.forEach(function (row) {
                                            if (type === 'all' || row.querySelector('td:nth-child(3)').textContent.toLowerCase() === type) {
                                                row.style.display = ''; 
                                            } else {
                                                row.style.display = 'none';
                                            }
                                        });
                                    }

                                    document.addEventListener('DOMContentLoaded', function () {
                                        document.getElementById('allTab').addEventListener('click', function () {
                                            filterEmployees('all');
                                        });

                                        document.getElementById('employeeTab').addEventListener('click', function () {
                                            filterEmployees('employee');
                                        });

                                        document.getElementById('contractorTab').addEventListener('click', function () {
                                            filterEmployees('contractor');
                                        });

                                        document.getElementById('dismissedTab').addEventListener('click', function () {
                                            filterEmployees('dismissed');
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


 
        </div>


        <!-- footer -->
        <?php include "footer.php";?>

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