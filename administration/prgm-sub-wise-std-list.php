<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Subject</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Subject</li>
                <li class="breadcrumb-item active">Add Subject</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Program Subject Wise Approved Student List</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="">
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Name</label>
                            <select class="form-select" name="dept_name" aria-label="Default select example" required>
                                <option selected>--select--</option>
                                <?php
                                $select = "SELECT * FROM `dept`";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                $sl = 1;
                                while ($fetch_dept = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $fetch_dept['dept_id'] ?>"><?= $fetch_dept['dept_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-12">

                            <a style="font-size:smaller" href="<?= $web_socket ?>administration/add-dept.php">To add a new Department click here </a>

                        </div>

                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="add_sub" type="submit">Submit form</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>



        </div>


    </section>





    <?php
    include('includes/footer.php');
    ?>