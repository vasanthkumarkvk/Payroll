<?php
include "header.php";
include "db.php"; 

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];


  $original_id = $user_id ;
  // Remove hyphen from the user ID (if applicable)
  $user_id = str_replace('-', '', $user_id);

  // Define the table name based on user ID
  $table_name = $user_id . "_salary";
  
  // Default value for modal flag
  $show_modal = false;

  // Query to check if the user's salary table exists
  $query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ?";
  $table_exists = 0;

  if ($stmt = $payroll_conn->prepare($query)) {
      $stmt->bind_param("s", $table_name); 
      $stmt->execute();
      $stmt->bind_result($table_exists);
      $stmt->fetch();
      $stmt->close();
  }

  // Query to check the conformation_process value
  $query2 = "SELECT conformation_process FROM run_payslip WHERE employee_user_id = ?";
  $conformation_process = null;

  if ($stmt2 = $payroll_conn->prepare($query2)) {
      $stmt2->bind_param("s", $original_id);
      $stmt2->execute();
      $stmt2->bind_result($conformation_process);
      $stmt2->fetch();
      $stmt2->close();
  }

// Check if the table does not exist or conformation_process is NULL or 0
if ($table_exists == 0 || $conformation_process == 0 || $conformation_process === NULL) {
    $show_modal = true;
}

// If the table exists and conformation_process is 1, allow the user to proceed
if ($table_exists == 1 && $conformation_process == 1) {
    // Allow user to proceed without modal
    $show_modal = false;
}

  
}
?>

<!-- Modal -->
<?php if ($show_modal): ?>
  <div id="profile-modal" class="modal" style="display: block;">
    <div class="modal-content">
      <span class="close" onclick="document.getElementById('profile-modal').style.display='none'">&times;</span>
      <h2>You must set up your profile first!</h2>
      <p>Please complete your profile setup to proceed. <?php  echo $user_id; ?></p>
      <a href="users/add_details.php" id="edit_profile">Set Profile Here</a>
    </div>
  </div>
<?php endif; ?>

<script>
  // Automatically show the modal after 2 seconds if it is required
  setInterval(function() {
    var modal = document.getElementById("profile-modal");
    if (modal) {
      modal.style.display = "block";
    }
  }, 2000);
</script>

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#dashboard" role="tab"
                  aria-controls="dashboard" aria-selected="true">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab"
                  aria-selected="false">Audiences</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab"
                  aria-selected="false">Demographics</a>
              </li>
              <li class="nav-item">
                <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab"
                  aria-selected="false">More</a>
              </li>
            </ul>
          </div>
          <div class="tab-content tab-content-basic">
            <!-- Dashboard -->
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="home-tab">
              <div class="row">
                <div class="col-sm-12">
                  <div class="dashboard-content">
                    <h2>Your Payment Information</h2>
                    <div class="payment-details">
                      <p><strong>Monthly Salary:</strong> $4,500</p>
                      <p><strong>Bonus:</strong> $500</p>
                      <p><strong>Total Earnings:</strong> $5,000</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Audiences -->
            <div class="tab-pane fade" id="audiences" role="tabpanel" aria-labelledby="audiences">
              <h2>Audiences</h2>
              <p>Here you can manage your audience segments.</p>
            </div>

            <!-- Demographics -->
            <div class="tab-pane fade" id="demographics" role="tabpanel" aria-labelledby="demographics">
              <h2>Demographics</h2>
              <p>Understand the demographics of your audience.</p>
            </div>

            <!-- More -->
            <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more">
              <h2>More Options</h2>
              <p>Explore additional features and tools available to you.</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include "footer.php"; ?>
