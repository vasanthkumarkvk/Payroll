<?php
include "../database.php";


session_start(); // Start the session
// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}
$admin_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'admin@example.com';
$admin_name = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';


$user_id = null; // Default value if not set


if (isset($_GET['id'])) {
    // Retrieve the 'id' value
    $user_id = $_GET['id'];

    // Display or use the 'id' as needed
    echo "User ID: " . htmlspecialchars($user_id); // Use htmlspecialchars for security
} else {
    // Handle the case where 'id' is not present
    echo "User ID is not provided in the URL.";
}

$sql = "SELECT * FROM run_payslip"; // Fetch only the needed columns
$result = $conn->query($sql);

$employees = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}



$conn->close();


?>





<?php include "header.php"; ?>

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
                    <a class="navbar-brand brand-logo" href="dashboard.php">
                        <img src="..\img\vsmlogo-favicon.png" alt="logo" />
                    </a>

                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text text-black fw-bold">Add Salary</h1>
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
        <div class=" page-body-wrapper">
            <?php include "side_nav.php"; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="text-center mb-4">Enter Employee Salary Details</h3>

                            <form action="process_salary.php" method="POST">
                                <div class="row">
                                    <!-- Column 1 -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="employee_id">Employee ID</label>
                                            <input type="text" class="form-control" id="employee_id"
                                                value="<?php echo htmlspecialchars($user_id); ?>" disabled>
                                            <input type="hidden" id="employee_id" name="employee_id"
                                                value="<?php echo htmlspecialchars($user_id); ?>">

                                        </div>
                                        <div class="form-group">
                                            <label for="employee_name">Employee Name</label>
                                            <input type="text" class="form-control" id="employee_name"
                                                name="employee_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="basic_salary">Basic Salary</label>
                                            <input type="number" class="form-control" id="basic_salary"
                                                name="basic_salary" step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deductions">Deductions</label>
                                            <input type="number" class="form-control" id="deductions" name="deductions"
                                                step="0.01">
                                        </div>
                                    </div>

                                    <!-- Column 2 -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="month">Month</label>
                                            <select class="form-control" id="month" name="month" required>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="gross_salary">Gross Salary</label>
                                            <input type="number" class="form-control" id="gross_salary"
                                                name="gross_salary" step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="net_salary">Net Salary</label>
                                            <input type="number" class="form-control" id="net_salary" name="net_salary"
                                                step="0.01" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_date">Payment Date</label>
                                            <input type="date" class="form-control" id="payment_date"
                                                name="payment_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bonus">Bonus</label>
                                            <input type="number" class="form-control" id="bonus" name="bonus"
                                                step="0.01">
                                        </div>
                                    </div>
                                </div>



                                <!-- Submit Button -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Submit Salary Details</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <!-- footer -->
        <?php include "footer.php"; ?>
    </div>
    </div>


</body>

</html>