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
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">

                    <div class="section">
                        <div class="section-header">
                            <h3>Basic Information</h3>
                        </div>
                        <?php if (isset($employee) && !empty($employee)): ?>
                            <table>
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
                                    <td id="basicHiringDate"><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                                </tr>
                                <tr>
                                    <th>Designation:</th>
                                    <td id="basicDesignation"><?php echo htmlspecialchars($employee['designation']); ?></td>
                                </tr>

                                <tr>
                                    <th>Department:</th>
                                    <td id="basicDepartment"><?php echo htmlspecialchars($employee['department']); ?></td>
                                </tr>
                                <tr>
                                    <th>Manager:</th>
                                    <td id="basicManager"><?php echo htmlspecialchars($employee['manager']); ?></td>
                                </tr>
                                <tr>
                                    <th>Location:</th>
                                    <td><?php echo htmlspecialchars($employee['location']); ?></td>
                                </tr>
                            </table>
                       </div>


                    <div class="section">
                        <div class="section-header">
                            <h3>Compensation & Perquisites</h3>
                        </div>
                        <table>
                            <tr>
                                <th>Gross Salary:</th>
                                <td id="annualSalary"><?php echo htmlspecialchars($employee['gross_salary']); ?></td>
                            </tr>
                            <tr>
                                <th>Bonus:</th>
                                <td id="bonus"><?php echo htmlspecialchars($employee['bonus']); ?></td>
                            </tr>
                            <tr>
                                <th>Total Compensation:</th>
                                <td id="totalCompensation"><?php echo htmlspecialchars($employee['total_compensation']); ?></td>
                            </tr>
                        </table>
                    </div>


                    <div class="section">
                        <div class="section-header">
                            <h3>Employee Bank Details</h3>
                        </div>
                        <table>
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


                    <div class="section">
                        <div class="section-header">
                            <h3>Other Information</h3>
                        </div>
                        <table>
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


                    <div class="section">
                        <table>
                            <tr>
                                <th>Employee Type:</th>
                                <td id="employee_type"><?php echo htmlspecialchars($employee['employee_type']); ?></td>
                            </tr>
                        </table>
                    </div>


                <?php else: ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<?php include "footer.php"; ?>