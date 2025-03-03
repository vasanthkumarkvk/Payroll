<?php
include "header.php";
include "db.php";

if (!isset($_SESSION['user_email'])) {
    echo "User is not logged in.";
    exit();
}

$email = $_SESSION['user_email'];

// Get the selected year, default to the current year
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");

// Fetch employee details using email from session
$sql = "SELECT employee_name, employee_user_id, gross_salary FROM run_payslip WHERE email = ?";
$stmt = $payroll_conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employee_name = htmlspecialchars($row['employee_name']);
        $employee_user_id = htmlspecialchars($row['employee_user_id']);
        $gross_salary = htmlspecialchars($row['gross_salary']);
    } else {
        echo "No employee found with the given email.";
        exit();
    }
    $stmt->close();
} else {
    echo "Error preparing the statement.";
    exit();
}

// Sanitize employee_user_id to construct a safe table name
$normal_id = $employee_user_id;
$employee_user_id = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($employee_user_id));
$table_name = $employee_user_id . "_salary";

// Fetch salary details for the matched employee_id and year
$salary_details = [];
$sql = "SELECT * FROM `$table_name` WHERE `year` = ?";
$stmt = $payroll_conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $selected_year);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $salary_details[] = $row;
    }
    $stmt->close();
} else {
    echo "Error preparing the statement for salary details.";
    exit();
}

?>

<style>
    button {
        border: none;
        padding: 8px 12px;
        margin: 7px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    button#previous {
        background-color: #0d6efd;
        color: white;
    }

    button#next_year {
        background-color: white;
        color: #0d6efd;
        border: 1px solid #0d6efd;
    }

    button:hover {
        background-color: #0d6efd;
        color: white;
    }
</style>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container mt-4">
            <div class="row">
                <h2>
                    <span id="employeeName" style="color: red; font-weight: bold;">
                        <?php echo $employee_name; ?>
                    </span>
                </h2>

                <!-- Year Selection -->
                <div class="year-selector">
                    <button id="previous" onclick="changeYear(<?php echo $selected_year - 1; ?>)">Previous Year</button>
                    <span style="font-size: 20px; font-weight: bold;"><?php echo $selected_year; ?></span>
                    <button id="next_year" onclick="changeYear(<?php echo $selected_year + 1; ?>)">Next Year</button>
                </div>

                <!-- Employee Salary Details Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <!-- <th>Year</th> -->
                                <th>Gross Salary</th>
                                <th>Advance Amount</th>
                                <th>Total Days</th>
                                <th>Present Days</th>
                                <th>LOP</th>
                                <th>Net Salary</th>
                                <th>Payment Status</th>
                                <th>Payslip</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($salary_details)) { ?>
                                <?php foreach ($salary_details as $salary) { ?>
                                    <tr>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['month']); ?></td>
                                        <!-- <td><?php //echo htmlspecialchars($salary['year']); 
                                                    ?></td> -->
                                        <td class="table-padding-adjest"><?php echo $gross_salary; ?></td>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['advance_amount']); ?></td>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['total_days']); ?></td>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['present_days']); ?></td>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['absent_days']); ?></td>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['net_salary']); ?></td>
                                        <td class="table-padding-adjest"><?php echo htmlspecialchars($salary['payment_status']); ?></td>
                                        <td class="table-padding-adjest">
                                            <button type="button" class="payslip-download btn btn-primary"
                                                data-month="<?= htmlspecialchars($salary['month']) ?>"
                                                data-id="<?= htmlspecialchars($salary['employee_id']) ?>">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </button>
                                        </td>

                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="11">No salary details found for this employee in the selected year.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelectorAll(".payslip-download").forEach(button => {
                        button.addEventListener("click", function() {
                            let month = this.getAttribute("data-month");
                            let employeeId = this.getAttribute("data-id");

                            if (month && employeeId) {
                                window.location.href = `admin/pages/export_to_pdf.php?month=${encodeURIComponent(month)}&employee_id=${encodeURIComponent(employeeId)}`;
                            } else {
                                alert("Missing required data!");
                            }
                        });
                    });
                });
            </script>
            <script>
                function changeYear(year) {
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('year', year);
                    window.location.search = urlParams.toString();
                }
            </script>
        </div>

    </div>
</div>
</div>
</div>

<?php include "footer.php"; ?>