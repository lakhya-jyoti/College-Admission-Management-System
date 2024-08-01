<?php
require_once('../includes/dbconfig.php');

$admin_username = $_SESSION['admin_username'];
$select = "select * from applicants where std_email = :username or std_mob = :username";
$stmt = $con->prepare($select);
$stmt->bindParam(':username', $admin_username);
$stmt->execute();
$fetch_user = $stmt->fetch(PDO::FETCH_ASSOC);
$std_name = $fetch_user['std_f_name'] . " " . $fetch_user['std_m_name'] . " " . $fetch_user['std_l_name'];


if (isset($_SESSION['admin_loggedin']) != true) {

    header('location: includes/logout.php');
}
if (isset($_SESSION['user_status']) == $fetch_user['user_status'] && $fetch_user['user_status'] != "Admin") {

    header('location: includes/logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>North Lakhimpur College (Autonomus)</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=$web_socket?>administration/assets/img/favicon.png" rel="icon">
  <link href="<?=$web_socket?>administration/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=$web_socket?>administration/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=$web_socket?>administration/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=$web_socket?>administration/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=$web_socket?>administration/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=$web_socket?>administration/assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="<?=$web_socket?>administration/" class="logo d-flex align-items-center">
        <img src="<?=$web_socket?>administration/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NLC (A)</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?=$web_socket?>administration/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?=substr($fetch_user['std_f_name'], 0,1);?>. <?=$fetch_user['std_l_name']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?=$std_name?></h6>
              <span><?=$fetch_user['user_status']?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=$web_socket?>administration/users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?=$web_socket?>administration/includes/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->