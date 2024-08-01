<?php
include('includes/header.php');
include('includes/sidebar.php');

// Student Count
$status = "Admin";
$select = "select * from applicants where user_status != :admin";
$stmt = $con->prepare($select);
$stmt->bindParam(':admin', $status);
$stmt->execute();
$count_appli = $stmt->rowCount();

// Program Count
$select = "select * from program";
$stmt = $con->prepare($select);
$stmt->execute();
$count_prgm = $stmt->rowCount();

// Department Count
$select = "select * from dept";
$stmt = $con->prepare($select);
$stmt->execute();
$count_dept = $stmt->rowCount();

// Subjects Count
$select = "select * from subjects";
$stmt = $con->prepare($select);
$stmt->execute();
$count_sub = $stmt->rowCount();

// Merit student Count
$select = "select * from applicants_edu_det where m_status = 1";
$stmt = $con->prepare($select);
$stmt->execute();
$count_post = $stmt->rowCount();

// Admited Student Count
$select = "select * from students";
$stmt = $con->prepare($select);
$stmt->execute();
$count_stds = $stmt->rowCount();
?>



<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div>
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total Registered</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $count_appli ?></h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">



              <div class="card-body">
                <h5 class="card-title">Total Programs </h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $count_prgm ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-md-4">

            <div class="card info-card customers-card">



              <div class="card-body">
                <h5 class="card-title">Total Departments</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-share"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $count_dept ?></h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->


        </div>
      </div><!-- End Left side columns -->

    </div>
    <div class="row">

      <!-- Left side columns -->
      <div>
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total Subjects</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $count_sub ?></h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">



              <div class="card-body">
                <h5 class="card-title">Total Merit Student </h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-pin-map"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $count_post ?></h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-md-4">

            <div class="card info-card customers-card">



              <div class="card-body">
                <h5 class="card-title">Total Admissions</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $count_stds ?></h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->


        </div>
      </div><!-- End Left side columns -->

    </div>
  </section>

</main><!-- End #main -->

<?php
include('includes/footer.php');
?>