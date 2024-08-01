<?php
$page = "list_postel";
include('includes/header.php');
include('includes/sidebar.php');
?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Programs</li>
                <li class="breadcrumb-item active">Manage Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body table-responsive-sm">
                        <h5 class="card-title">Programs List</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Program Name</th>
                                    <th scope="col">Program Duration</th>
                                    <th scope="col">Program sem Fess</th>
                                    <th scope="col">Admission Fees</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select = "SELECT * FROM `program`";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl = 1;
                                while ($fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?= $sl ?></th>
                                        <td><?= $fetch_prgm['prgm_name'] ?></td>
                                        <td><?= $fetch_prgm['prgm_dure'] ?></td>
                                        <td><?= $fetch_prgm['prgm_sem_cost'] ?></td>
                                        <td><?= $fetch_prgm['prgm_add_fees'] ?></td>

                                        
                                        <td>
                                            <form action="<?= $web_socket ?>administration/edit_program.php" method="post">
                                                <input type="hidden" name="prgm_id" value="<?= $fetch_prgm['prgm_id'] ?>">
                                                <button class="btn btn-primary my-2" name="prgm_edit" onclick="return confirm('Are you sure?')">Edit</button>
                                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')" name="delete_prgm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                    $sl++;
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