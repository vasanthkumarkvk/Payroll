<?php
include "header.php";
include "db.php"; 

// Fetch employee details from run_payslip table
$query = "SELECT * FROM run_payslip WHERE employee_user_id = ?";
$stmt = $payroll_conn->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

if ($employee) {
    $designation = $employee['designation'] ?? 'N/A';
    $department = $employee['department'] ?? 'N/A';
    $gender = $employee['gender'] ?? 'N/A';
    $salary = $employee['gross_salary'] ?? 'N/A';
    $joining_date = $employee['hire_date'] ?? 'N/A';
} else {
    $name = "N/A";
    $designation = "N/A";
    $department = "N/A";
    $gender = "N/A";
    $salary = "N/A";
    $joining_date = "N/A";
}

// Check if the user has already submitted an exit request
$query2 = "SELECT * FROM exit_office WHERE user_id = ?";
$stmt2 = $payroll_conn->prepare($query2);
$stmt2->bind_param("s", $user_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$confirm = $result2->fetch_assoc();

// Handle null value issue
$appy_id = isset($confirm['user_id']) ? $confirm['user_id'] : null;
$hr_approvel = isset($confirm['hr_approvel']) ? $confirm['hr_approvel'] : null;
$validate = "Not-Accept";
?>

<style>
  .form-check .form-check-input {
    margin: 0px !important;
  }
  select.form-select{
    color: black !important;
  }
  textarea{
    height: 100px !important;
  }
</style>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

    <?php if ($user_id === $appy_id && $hr_approvel === $validate) { ?>
    <!-- Bootstrap Modal -->
    <div class="modal fade exit-approval-modal" id="exitApprovalModal" tabindex="-1" aria-labelledby="exitApprovalModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center">
            <img src="sad-image.png" alt="Sad Face" class="sad-image">
            <h4 class="text-danger mt-3">Your exit approval is under HR process</h4>
            <p class="text-muted">Please wait for HR's response.</p>
            <button type="button" class="btn btn-danger" id="modalClose">OK</button>
          </div>
        </div>
      </div>
    </div>

    <style>
      .exit-approval-modal .modal-content {
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
      }
      .exit-approval-modal .modal-body {
        padding: 20px;
      }
      .sad-image {
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
      }
      .exit-approval-modal h4 {
        font-weight: bold;
      }
      .exit-approval-modal .btn {
        padding: 10px 20px;
        font-size: 16px;
      }
    </style>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var exitApprovalModal = new bootstrap.Modal(document.getElementById("exitApprovalModal"));
        exitApprovalModal.show();

        document.getElementById("modalClose").addEventListener("click", function() {
          window.location.href = '../index.php';
        });
      });
    </script>
<?php } else { ?>


      
      <div class="col-md-10">
        <div class="card shadow-lg">
          <div class="card-body">
            <h3 class="card-title text-center text-danger">Exit Request Form</h3>
            <p class="text-center text-muted">Fill out the details for your resignation request.</p>
            <form method="POST" action="get_details.php">
              <div class="row">
                <!-- Employee Details (Read-Only) -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Employee Name:</label>
                    <input type="text" class="form-control" name="employee_name" value="<?php echo htmlspecialchars($name); ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Designation:</label>
                    <input type="text" class="form-control" name="designation" value="<?php echo htmlspecialchars($designation); ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Department:</label>
                    <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($department); ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Gender:</label>
                    <input type="text" class="form-control" name="gender" value="<?php echo htmlspecialchars($gender); ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Salary:</label>
                    <input type="number" class="form-control" name="salary" value="<?php echo htmlspecialchars($salary); ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Employee ID:</label>
                    <input type="text" name="user_id" class="form-control" value="<?php echo htmlspecialchars($user_id); ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Leaving Date:</label>
                    <input type="date" name="last_working_day" class="form-control" value="<?php echo date('Y-m-d', strtotime('+60 days')); ?>" required>
                    <small class="text-muted">Default is 60 days notice period <span style="color: red;">*</span></small>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Reason for Resigning:</label>
                    <select name="reason" id="reason" class="form-select" onchange="showOtherReason()" required>
                      <option value="Professional Growth">Professional Growth</option>
                      <option value="Personal Reason">Personal Reason</option>
                      <option value="HR Meeting">I need an HR meeting to discuss one-on-one</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                </div>

                <!-- Other Reason (Hidden Initially) -->
                <div class="col-md-12">
                  <div id="other_reason_div" class="mb-3" style="display:none;">
                    <label class="form-label fw-bold">Other Reason:</label>
                    <textarea name="other_reason" rows="3" class="form-control" placeholder="Enter your reason"></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="salary_hold" required>
                    <label class="form-check-label text-danger fw-bold">
                      I acknowledge my salary will be on hold until clearance.
                    </label>
                  </div>
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-danger w-100">Submit Exit Request</button>
                </div>
              </div>
            </form>

            <script>
              function showOtherReason() {
                var reason = document.getElementById("reason").value;
                var otherReasonDiv = document.getElementById("other_reason_div");
                if (reason === "Others") {
                  otherReasonDiv.style.display = "block";
                } else {
                  otherReasonDiv.style.display = "none";
                }
              }
            </script>

          </div>
        </div>

   <?php } ?>
      </div>
    </div>

<?php include "footer.php"; ?>
