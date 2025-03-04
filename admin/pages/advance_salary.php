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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
            background-color:#dbf9ff;
            color: black;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 30px;
        }

        .tab-btn.active {
            background-color: #0056b3;
            color: white;
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
                        <h1 class="welcome-text text-black fw-bold">Advance Salary</h1>
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
        <?php
include "../database.php"; 
// Fetch full-time employees
$query = "SELECT employee_user_id, employee_name FROM run_payslip WHERE employee_type = 'full-time'";
$result = mysqli_query($conn, $query);
$employees = [];
while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
}
?>
        <div class="container-fluid page-body-wrapper">
            <?php include "side_nav.php";?>
            <div class="main-panel">
                <div class="content-wrapper">
                <div class="container">
                    <div id="new-advance" class="tab-content active">
                        <h2>New Advance</h2>
                   
                        <form action="advance_add.php" method="POST" class="advance-salary-form">
    <!-- Employee Name Dropdown -->
    <div class="form-group">
        <label for="employee_name">Employee Name</label>
        <select id="employee_name" name="employee_name" required>
            <option value="">Select Employee</option>
            <?php foreach ($employees as $employee) { ?>
                <option value="<?= $employee['employee_name'] ?>" data-user-id="<?= $employee['employee_user_id'] ?>">
                    <?= $employee['employee_name'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <!-- Employee ID (Auto-filled) -->
    <div class="form-group">
        <label for="employee_id">Employee ID</label>
        <input type="text" id="employee_id" name="employee_id" placeholder="Auto-filled Employee ID" readonly required>
    </div>

    <div class="form-group">
        <label for="amount">Advance Amount</label>
        <input type="number" id="amount" name="advance_amount" placeholder="Enter amount" required>
    </div>

    <div class="form-group">
        <label for="emi">Monthly EMI Amount</label>
        <input type="number" id="emi" name="emi_amount" placeholder="Enter EMI amount" required>
    </div>

    <div class="form-group">
        <label for="advance_date">Advance Date</label>
        <input type="date" id="advance_date" name="starting_date" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn-submit">Submit</button>
    </div>
</form>

<script>
// Auto-fill Employee ID based on the selected Employee Name
document.getElementById("employee_name").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    document.getElementById("employee_id").value = selectedOption.getAttribute("data-user-id");
});
</script>


                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date", {
            dateFormat: "Y-m-d", // Customize format as needed
            allowInput: true // Allow input so users can type dates
        });</script>

    <script>
        // JavaScript for tab functionality
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTab = button.getAttribute('data-tab');

                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.remove('active');
                });

                // Remove 'active' class from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                });

                // Show the selected tab content
                document.getElementById(targetTab).classList.add('active');

                // Add 'active' class to the clicked button
                button.classList.add('active');
            });
        });
    </script>


<!-- Include jQuery for AJAX (if you don’t have it already) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// When the employee name field changes (when typing)
$('#employee-name').on('input', function() {
    var employee_name = $(this).val(); // Get the entered employee name

    // Check if the employee name is not empty
    if (employee_name) {
        // Make an AJAX request to fetch the employee ID
        $.ajax({
            url: 'fetch_employee_id.php', // The script we just created
            type: 'GET',
            data: { employee_name: employee_name }, // Send the employee name
            success: function(response) {
                var data = JSON.parse(response);
                if (data.employee_user_id) {
                    // Autofill the employee ID field
                    $('#employee-id').val(data.employee_user_id);
                } else {
                    // Clear the employee ID if no match found
                    $('#employee-id').val('');
                }
            }
        });
    } else {
        // If employee name is empty, clear the employee ID field
        $('#employee-id').val('');
    }
});
</script>   





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