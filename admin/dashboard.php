<?php
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


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VSM Payroll Management </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/custome_style.css">

  <!-- endinject -->
  <link rel="shortcut icon" href="img/vsmlogo-favicon.png" />
</head>

<body class="with-welcome-text">
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="dashboard.php">
            <img src="img\vsmlogo-favicon.png" alt="logo" />
          </a>

        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item fw-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Hello, <span class="text-black fw-bold">Admin!</span></h1>
            <h3 class="welcome-sub-text">Here's your weekly payroll summary and updates.</h3>
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
                <!-- <img class="img-md rounded-circle" src="as" alt="Profile image"> -->
                <p class="mb-1 mt-3 fw-semibold"><?php echo $admin_name; ?></p>
                <p class="fw-light text-muted mb-0"><?php echo $admin_email; ?></p>
              </div>
              <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                Profile <span class="badge badge-pill badge-danger">1</span></a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                Messages</a>
              <a class="dropdown-item"><i
                  class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                FAQ</a> -->
              <a href="logout.php" class="dropdown-item"><i
                  class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Log Out</a>
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

<?php  include "side_nav.php";  ?>


      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="CompanyOnboarding--progress-section">
                <div>
                  <h3 class="CompanyOnboarding--progress-header">Welcome to Admin Dashboard!</h3>
                  <div class="CompanyOnboarding--progress-bar-bg">
                    <div class="CompanyOnboarding--progress-bar" style='width:30%'></div>
                  </div>

                </div>

              </div>

              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#dashboard" role="tab"
                        aria-controls="dashboard" aria-selected="true">Dashboard</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab"
                        aria-selected="false">Summary</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#notification" role="tab"
                        aria-selected="false">Notification</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab"
                        aria-selected="false">More</a>
                    </li> -->
                  </ul>
                </div>
                <div class="tab-content tab-content-basic">
                  <!-- Dashboard -->
                  <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container">
                      <h2 class="text-center my-4">Payroll Dashboard</h2>

                      <!-- Summary Cards -->
                      <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                          <div class="card shadow">
                            <div class="card-header bg-info text-white">
                              <h5>Total Employees</h5>
                            </div>
                            <div class="card-body text-center">
                              <h3>5</h3>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                          <div class="card shadow">
                            <div class="card-header bg-warning text-white">
                              <h5>Total Payroll Expenses</h5>
                            </div>
                            <div class="card-body text-center">
                              <h3>Rs.</h3>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                          <div class="card shadow">
                            <div class="card-header bg-success text-white">
                              <h5>Total Bonuses Paid</h5>
                            </div>
                            <div class="card-body text-center">
                              <h3>Rs.</h3>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                          <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                              <h5>Active Projects</h5>
                            </div>
                            <div class="card-body text-center">
                              <h3>-</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Charts Section -->
                      <div class="row mb-4">
                        <div class="col-md-6 mb-4">
                          <div class="card shadow">
                            <div class="card-header bg-dark text-white">
                              <h5>Salary Trends</h5>
                            </div>
                            <div class="card-body">
                              <canvas id="salaryTrendChart"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- <div class="row mb-4">
      <div class="col-md-12">
        <div class="card shadow">
          <div class="card-header bg-dark text-white">
            <h5>Payroll Distribution</h5>
          </div>
          <div class="card-body">
            <canvas id="payrollDistributionChart"></canvas>
          </div>
        </div>
      </div>
    </div> -->
                      <!-- Notifications/Alerts Section -->




                    </div>
                  </div>

                  <!-- Chart.js Script (Include this in your HTML file to render the charts) -->
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                  <script>
                    // Sample data for charts
                    const salaryTrendCtx = document.getElementById('salaryTrendChart').getContext('2d');
                    const salaryTrendChart = new Chart(salaryTrendCtx, {
                      type: 'line',
                      data: {
                        labels: ['Employee 1', 'Employee 2', 'Employee 3', 'Employee 4', 'Employee 5'],
                        datasets: [{
                          label: 'Monthly Salary',
                          data: [15000, 12000, 9000, 9000, 9000],
                          borderColor: 'rgba(75, 192, 192, 1)',
                          borderWidth: 2,
                          fill: false
                        }]
                      },
                      options: {
                        responsive: true,
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });

                    const performanceComparisonCtx = document.getElementById('performanceComparisonChart').getContext('2d');
                    const performanceComparisonChart = new Chart(performanceComparisonCtx, {
                      type: 'bar',
                      data: {
                        labels: ['Employee 1', 'Employee 2', 'Employee 3', 'Employee 4', 'Employee 5'],
                        datasets: [{
                          label: 'Performance Ratings',
                          data: [5, 4, 3, 4, 5], // Assuming performance ratings from 1 to 5
                          backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          borderColor: 'rgba(54, 162, 235, 1)',
                          borderWidth: 1
                        }]
                      },
                      options: {
                        responsive: true,
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });

                    const payrollDistributionCtx = document.getElementById('payrollDistributionChart').getContext('2d');
                    const payrollDistributionChart = new Chart(payrollDistributionCtx, {
                      type: 'pie',
                      data: {
                        labels: ['Employee 1', 'Employee 2', 'Employee 3', 'Employee 4', 'Employee 5'],
                        datasets: [{
                          label: 'Payroll Distribution',
                          data: [12000, 10000, 9000, 9000, 9000],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 205, 86, 0.2)'
                          ],
                          borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 205, 86, 1)'
                          ],
                          borderWidth: 1
                        }]
                      },
                      options: {
                        responsive: true
                      }
                    });
                  </script>

                  <!-- Audiences -->
                  <div class="tab-pane fade" id="audiences" role="tabpanel" aria-labelledby="audiences">
                    <h2>Yearly Pay Roll Summary</h2>
                    <p>Here you can manage your audience segments.</p>
                    <!-- Yearly Payroll Summary Table -->
                    <div class="row mb-4">
                      <div class="col-12">
                        <!-- <h3 class="my-4 text-center">Yearly Payroll Summary</h3> -->
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                              <tr>
                                <th>Employee</th>
                                <th>Salary</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Employee 1</td>
                                <td>Rs.12,000</td>
                              </tr>
                              <tr>
                                <td>Employee 2</td>
                                <td>Rs.10,000</td>
                              </tr>
                              <tr>
                                <td>Employee 3</td>
                                <td>Rs.9,000</td>
                              </tr>
                              <tr>
                                <td>Employee 4</td>
                                <td>Rs.9,000</td>
                              </tr>
                              <tr>
                                <td>Employee 5</td>
                                <td>Rs.9,000</td>
                              </tr>
                              <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>Rs.59,000</strong></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- notification -->
                  <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification">
                    <h2>Notification</h2>
                    <p>Understand the notification of your audience.</p>
                    <div class="row mb-4">
                      <div class="col-12">
                        <div class="card shadow">
                          <div class="card-header bg-danger text-white">
                            <h5>Notifications</h5>
                          </div>
                          <div class="card-body">
                            <ul class="list-group">
                              <li class="list-group-item list-group-item-warning">Overdue Tasks: -</li>
                              <li class="list-group-item list-group-item-danger">Upcoming Payroll Date: 30th of every
                                month</li>
                              <li class="list-group-item list-group-item-success">New Employee Orientation: Next
                                Monday</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- More -->
              <!-- <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more">
                <h2>More Options</h2>
                <p>Explore additional features and tools available to you.</p>
              </div> -->

            </div>
          </div>
        </div>
      </div>
    </div>






    <!-- footer -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> <a
            href="https://www.vsmglobaltechnologies.com/" target="_blank">VSM Global Technologies.com</a>
        </span>
        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights
          reserved.</span>
      </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/chart.umd.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="assets/js/dashboard.js"></script>

</body>

</html>