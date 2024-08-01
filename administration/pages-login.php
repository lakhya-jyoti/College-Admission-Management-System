<?php
require_once('../includes/dbconfig.php');

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
  <link href="<?= $web_socket ?>administration/assets/img/favicon.png" rel="icon">
  <link href="<?= $web_socket ?>administration/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= $web_socket ?>administration/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $web_socket ?>administration/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= $web_socket ?>administration/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= $web_socket ?>administration/assets/css/style.css" rel="stylesheet">

  <style>
    main {
      background-image: url('<?= $web_socket ?>images/bg.jpg');
      background-repeat: no-repeat;
      background-size: cover;

    }
  </style>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Admin Login</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>

                  </div>

                  <form class="row g-3 needs-validation" action="<?=$web_socket?>includes/action.php" method="POST">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email / Mobile no</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="admin_username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="admin_password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="admin_login" type="submit">Login</button>
                    </div>

                  </form>

                </div>
              </div>

              <div class="credits text-dark bg-light px-3" style="border-radius: 5px;">
                Designed by <a href="" class=" text-dark">Prakash Upadhyaya and Lakhya Borah</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="<?= $web_socket ?>administration/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Template Main JS File -->
  <script src="<?= $web_socket ?>administration/assets/js/main.js"></script>

</body>

</html>