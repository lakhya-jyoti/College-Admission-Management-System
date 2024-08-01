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
                <li class="breadcrumb-item">Department</li>
                <li class="breadcrumb-item active">Add Department</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Department</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="<?= $web_socket ?>includes/action.php">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Department Name</label>
                            <input type="text" class="form-control" name="dept_name" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" required>

                        </div>
                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary mx-auto" name="add_dept" type="submit">Add Department</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>



        </div>


    </section>





    <?php
    include('includes/footer.php');
    ?>