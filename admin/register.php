<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Payroll Management </title>
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
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/custome_style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="img/vsmlogo-favicon.png" />
</head>
<!-- Custom CSS for styling -->
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #6a11cb, #2575fc);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .signup-container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    width: 900px;
    max-width: 100%;
  }

  .signup-image {
    width: 50%;
  }

  .signup-form {
    width: 50%;
    padding: 40px;
  }

  .signup-form h2 {
    margin-bottom: 30px;
    font-weight: bold;
    color: #333;
  }

  .form-control {
    border-radius: 50px;
    padding: 15px;
  }

  .btn-signup {
    background: linear-gradient(to right, #ff512f, #dd2476);
    border: none;
    border-radius: 50px;
    padding: 15px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  .btn-signup:hover {
    background: linear-gradient(to right, #dd2476, #ff512f);
  }

  .terms {
    font-size: 12px;
    color: #6c757d;
  }

  .terms a {
    color: #ff512f;
  }

  .sign-in-link {
    text-align: center;
    margin-top: 20px;
  }

  .sign-in-link a {
    color: #ff512f;
    text-decoration: none;
  }

  .sign-in-link a:hover {
    text-decoration: underline;
  }
</style>

<body>

  <div class="signup-container">
    <!-- Left Side Image -->
    <div class="signup-image">
      <img style="height: 100%; width: 100%" src="../img/admin-login.png" alt="logo">

    </div>

    <!-- Sign Up Form -->
    <div class="signup-form">
      <h2>Sign Up</h2>
      <form method="POST" action="register_check.php">
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Full Name" name="full_name" required>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" placeholder="Email address" name="email" required>
        </div>
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Repeat Password" name="confirm_password" required>
        </div>
        <div class="form-check mb-4">
          <label class="form-check-label terms" for="termsCheck">
          </label>
        </div>
        <button type="submit" class="btn btn-signup w-100">Sign Up</button>
      </form>
      <div class="sign-in-link text-center mt-3" style="color:black;">
        <p>Already have an account? <a href="index.php" class="text-primary">Sign In</a></p>
      </div>
    </div>
  </div>



  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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