<?php 
session_start(); // Start session at the very top

if(isset($_GET['name']) && isset($_GET['id']) && isset($_GET['email'])){
    $_SESSION['name'] = htmlspecialchars($_GET['name']);
    $_SESSION['id'] = htmlspecialchars($_GET['id']);
    $_SESSION['email'] = htmlspecialchars($_GET['email']);

    // Redirect to remove query parameters (optional)
    header("Location: index.php");
    exit;
}

$name = isset($_SESSION['name']) ? $_SESSION['name'] : "Guest";
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : "N/A";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "Not provided";
?>

<!-- HTML CODE STARTS HERE -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>VSM Payroll Management</title>
  <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/custome_style.css">
  <link rel="shortcut icon" href="../img/vsmlogo-favicon.png" />
</head>

<body class="with-welcome-text">
  <div class="container-scroller">
    <!-- Navbar -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="img/vsmlogo-favicon.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="img/vsmlogo-favicon.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item fw-semibold d-none d-lg-block ms-0">
            <?php 
            date_default_timezone_set("Asia/Kolkata");
            $current_hour = date("H"); 
            if($current_hour >= 5 && $current_hour < 12){
              $greeting = "Good Morning";
            } elseif($current_hour >= 12 && $current_hour < 18){
              $greeting = "Good Afternoon";
            } else {
              $greeting = "Good Evening";
            }
            ?>
            <h1 class="welcome-text"><?php echo $greeting; ?>, <span class="text-black fw-bold"><?php echo $name; ?></span></h1>
            <h3 class="welcome-sub-text">Seriously want to exit the office?</h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-account-circle text-primary img-xs rounded-circle"></i> 
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <p class="fw-light text-muted mb-0"><?php echo $email; ?></p>
              </div>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
              <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- End of Navbar -->

    <!-- Sidebar -->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
        

          <li class="nav-item">
            <a class="nav-link" href="index.php" aria-expanded="false" aria-controls="charts">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Apply</span>
            </a>
          </li>
        </ul>
      </nav>
