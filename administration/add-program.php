<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Program</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Program</li>
                <li class="breadcrumb-item active">Add Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Program</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="<?= $web_socket ?>includes/action.php">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Program Name</label>
                            <input type="text" class="form-control" name="prgm_name" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" required>

                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Program Type</label>
                           
                            <select class="form-select" name="prgm_type" aria-label="Default select example" required>
                                <option selected>--select--</option>
                                <option value="HS">HS</option>
                                <option value="UG-GENERAL">UG-General</option>
                                <option value="UG-PROFESSIONAL">UG-Professional</option>
                                <option value="PG-GENERAL">PG-General</option>
                                <option value="PG-PROFESSIONAL">PG-Professional</option>
                                <option value="PG-DIPLOMA">PG-Diploma</option>

                            </select>
                        </div>

                        <label for="validationCustom02" class="form-label">Program Dueration</label>
                        <div class="input-group col-md-12">
                        <input type="number" class="form-control" name="prgm_duer" required>
                            <select class="form-select" name="duer_peri" aria-label="Default select example" required>
                                <option selected>--select--</option>
                                <option value="Day">Day</option>
                                <option value="Months">Months</option>
                                <option value="Years">Years</option>
                            </select>
                        </div>



                        <div class="">

                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Program Per Semester Course</label>
                            <input type="number" class="form-control" name="prgm_sem_cost" required>

                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Program Admission Fees</label>
                            <input type="number" class="form-control" name="prgm_add_fees" required>

                        </div>


                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="add_prgm" type="submit">Submit form</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>



        </div>


    </section>





    <?php
    include('includes/footer.php');
    ?>