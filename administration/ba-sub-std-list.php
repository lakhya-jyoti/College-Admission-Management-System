<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Capacity</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Report Generation</li>
                <li class="breadcrumb-item active">BA Admitted Students (Subject Wise)</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">BA Admitted Students (Subject Wise)</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="all-applicants-list.php" target="_blank">



                        <label for="validationCustom02" class="form-label">Select Subject</label>
                        <div class="input-group col-md-12">

                            <select class="form-select" name="cr_name" aria-label="Default select example" required>
                                <option value="">--select--</option>
                                <?php
                                $select = "SELECT sub_name FROM `subjects`";
                                $stmt = $con->prepare($select);
                                $stmt->execute();

                                while ($fetch_merit = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $fetch_merit['prgm_id'] ?>"><?= $fetch_merit['prgm_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="generate_all_list" type="submit">Export</button>
                        </div>
                    </form>


                </div>
            </div>



        </div>


    </section>
    <!-- <script>
    function redirect(){
        open('all-applicants-list.php');
    }
</script> -->




    <?php
    include('includes/footer.php');
    ?>