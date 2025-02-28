<?php
include '../database.php'; // Include your database connection

// Get the employee email
$employee_email = isset($_GET['email']) ? $_GET['email'] : null;

// Get the selected year, default to the current year
$selected_year = isset($_GET['year']) ? (int)$_GET['year'] : date("Y");

if ($employee_email) {
    // Prepare the SQL query to fetch employee data
    $sql = "SELECT employee_name, employee_user_id, gross_salary FROM run_payslip WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $employee_email);
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
}

$normal_id= $employee_user_id;
// Sanitize the employee_user_id
$employee_user_id = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($employee_user_id));

// Now use the sanitized and lowercase employee_user_id to construct the table name
$table_name = $employee_user_id . "_salary";
// Fetch salary details for the matched employee_id and year
$salary_details = [];
if (isset($employee_user_id)) {
    $sql = "SELECT *FROM `$table_name` WHERE  `year` = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i",  $selected_year);
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
}
?>

<?php include "header.php"; ?>
<style>
    button#privious {
    border: none;
    padding: 6px;
    margin: 7px;
    border-radius: 5px;
    background-color: #0d6efd;
    color: white;
}
button#next_year{
    border: none;
    padding: 6px;
    margin: 7px;
    border-radius: 5px;
    background-color: white;
    color: #0d6efd;;
}
button#next_year:hover{

    background-color: #0d6efd;
    color: white;


}
button#privious:hover{
    background-color: white;
    color: #0d6efd;;
}
</style>
<body class="with-welcome-text">
    <div class="container-scroller">
        <?php include "top_nav.php"; ?>

        <div class="page-body-wrapper">
            <?php include "side_nav.php"; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <h2>
                            <span id="employeeName" style="color: red; font-weight: bold;">
                                <?php echo $employee_name; ?>
                                
                            </span>
                        </h2>

                        <!-- Year Selection -->
                        <div class="year-selector">
                            <button id="privious" onclick="changeYear(<?php echo $selected_year - 1; ?>)">Previous Year</button>
                            <span style="font-size: 20px; font-weight: bold;"><?php echo $selected_year; ?></span>
                            <button id="next_year" onclick="changeYear(<?php echo $selected_year + 1; ?>)">Next Year</button>
                            <button id="download-pdf" data-id="<?php echo $normal_id; ?>" class="btn btn-danger">Download PDF</button>

                        </div>


                        <!-- Employee Salary Details Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Gross Salary</th>
                                        <th>Advance Amount</th>
                                        <th>EMI Amount</th>
                                        <th>Total Days</th>
                                        <th>Present Days</th>
                                        <th>Absent Days</th>
                                        <th>Net Salary</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($salary_details)) { ?>
                                        <?php foreach ($salary_details as $salary) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($salary['id']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['month']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['year']); ?></td>
                                                <td><?php echo $gross_salary; ?></td>
                                                <td><?php echo htmlspecialchars($salary['advance_amount']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['emi_amount']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['total_days']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['present_days']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['absent_days']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['net_salary']); ?></td>
                                                <td><?php echo htmlspecialchars($salary['payment_status']); ?></td>
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
                </div>
            </div>
        </div>
    </div>

    <?php include "footer_view.php"; ?>


    <script>
    document.getElementById('download-pdf').addEventListener('click', function() {
        let normalId = this.getAttribute('data-id');
        window.location.href = 'export_to_pdf.php?normal_id=' + encodeURIComponent(normalId);
    });
</script>



    <script>
        function changeYear(year) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('year', year);
            window.location.search = urlParams.toString();
        }
    </script>
</body>
