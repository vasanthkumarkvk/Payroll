<?php
include "header.php";
include "db.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $original_id = $user_id;
    $user_id = str_replace('-', '', $user_id);
    include "admin/database.php";
    $employee_user_id =  $original_id;
    $sql = "SELECT * FROM run_payslip WHERE employee_user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employee_user_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $employee = $result->fetch_assoc();
        if (!$employee) {
            echo "No employee found with the ID: " . htmlspecialchars($employee_user_id);
        }
    } else {
        echo "SQL execution error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>


<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
    <div class="container mt-4">
    <div class="row">
        <!-- Basic Information -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($employee) && !empty($employee)): ?>
                        <table class="table table-bordered">
                            <tr>
                                <th>Employee ID:</th>
                                <td><?php echo htmlspecialchars($employee['employee_user_id']); ?></td>
                            </tr>
                            <tr>
                                <th>Name:</th>
                                <td><?php echo htmlspecialchars($employee['employee_name']); ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo htmlspecialchars($employee['email']); ?></td>
                            </tr>
                            <tr>
                                <th>Date of Hiring:</th>
                                <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                            </tr>
                            <tr>
                                <th>Designation:</th>
                                <td><?php echo htmlspecialchars($employee['designation']); ?></td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td><?php echo htmlspecialchars($employee['department']); ?></td>
                            </tr>
                            <tr>
                                <th>Manager:</th>
                                <td><?php echo htmlspecialchars($employee['manager']); ?></td>
                            </tr>
                            <tr>
                                <th>Location:</th>
                                <td><?php echo htmlspecialchars($employee['location']); ?></td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>

        <!-- Compensation & Perquisites -->
        <div class="col-md-6">
           <div class="rol-md-6">
           <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Compensation & Perquisites</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Gross Salary:</th>
                            <td><?php echo htmlspecialchars($employee['gross_salary']); ?></td>
                        </tr>
                        <tr>
                            <th>Bonus:</th>
                            <td><?php echo htmlspecialchars($employee['bonus']); ?></td>
                        </tr>
                        <tr>
                            <th>Total Compensation:</th>
                            <td><?php echo htmlspecialchars($employee['total_compensation']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
           </div>
            <div class="row-md-6 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Employee Bank Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Account Number:</th>
                            <td><?php echo htmlspecialchars($employee['account_number']); ?></td>
                        </tr>
                        <tr>
                            <th>IFSC Number:</th>
                            <td><?php echo htmlspecialchars($employee['ifsc_number']); ?></td>
                        </tr>
                        <tr>
                            <th>Bank Name:</th>
                            <td><?php echo htmlspecialchars($employee['bank_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Account Holder Name:</th>
                            <td><?php echo htmlspecialchars($employee['employee_name']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>

        <!-- Employee Bank Details -->
     

        <!-- Other Information -->
        <div class="col-md-6 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Other Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Date of Birth:</th>
                            <td><?php echo htmlspecialchars($employee['dob']); ?></td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td><?php echo htmlspecialchars($employee['gender']); ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number:</th>
                            <td><?php echo htmlspecialchars($employee['phone_number']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Employee Type -->
        <div class="col-md-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Employee Type</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Employee Type:</th>
                            <td><?php echo htmlspecialchars($employee['employee_type']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-danger text-center">No employee details found.</div>
        </div>
    <?php endif; ?>
    </div>
</div>

    </div>
</div>
</div>
</div>

<?php include "footer.php"; ?>