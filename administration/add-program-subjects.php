<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Program Subject</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Program</li>
                <li class="breadcrumb-item active">Add Program Subject</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Subject</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="<?= $web_socket ?>includes/action.php">


                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Program Name</label>
                            <select class="form-select" name="prgm_name" aria-label="Default select example" required>
                                <option selected>--select--</option>
                                <?php
                                $select = "SELECT * FROM `program`  order by prgm_name asc";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl = 1;
                                while ($fetch_prgm = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $fetch_prgm['prgm_id'] ?>"><?= $fetch_prgm['prgm_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Subject Name</label>
                            <select class="form-select" name="sub_name" aria-label="Default select example" required>
                                <option selected>--select--</option>
                                <?php
                                $select = "SELECT * FROM `subjects` order by sub_name asc";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl = 1;
                                while ($fetch_sub = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $fetch_sub['sub_id'] ?>"><?= $fetch_sub['sub_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                      </div>

                      <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Intake Capacity</label>
                            <input type="number" class="form-control" name="int_cap" required>

                        </div>
                        <div class="col-md-12">

                            <a style="font-size:smaller" href="<?= $web_socket ?>administration/add-subject.php">To add new subject click here</a>

                        </div>
                        <!-- code to be used -->




                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="add_sub_prgm" type="submit">Submit form</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>



        </div>


    </section>





    <?php
    include('includes/footer.php');
    ?>