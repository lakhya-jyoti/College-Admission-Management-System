<?php
$page = "list_postel";
include('includes/header.php');
include('includes/sidebar.php');
?>



<main id="main" class="main" >

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Postel Codes</li>
                <li class="breadcrumb-item active">List Codes</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Postel Codes List</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pin Code</th>
                                    <th scope="col">District</th>
                                    <th scope="col">State</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "SELECT * FROM `postel_codes`";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                while ($fetch_codes = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $fetch_codes['pin_id'] ?></th>
                                        <td><?= $fetch_codes['PINCODE'] ?></td>
                                        <td><?= $fetch_codes['DISTRICT'] ?></td>
                                        <td><?= $fetch_codes['STATE'] ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>


</main><!-- End #main -->


<!-- ======= Footer ======= -->
<?php
include('includes/footer.php');
?>