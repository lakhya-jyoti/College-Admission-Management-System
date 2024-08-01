<?php
include('includes/header.php');
include('includes/sidebar.php');


if (isset($_POST['generate_list'])) {
    $capacity = $_POST['capacity'];
    $category = $_POST['category'];
    $update = 'update merit_list set no_of_std = :capacity where category = :category';
    $stmt = $con->prepare($update);
    $stmt->bindParam(':capacity', $capacity);
    $stmt->bindParam(':category', $category);
    if ($stmt->execute()) {
?>
        <script>
            alert('Added Successfully');
            location.href = 'merit-list-selection.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something Went Wrong');
            location.href = 'merit-list-selection.php';
        </script>
<?php
    }
}
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add Capacity</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">List Master</li>
                <li class="breadcrumb-item active">Add Capacity</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Capacity</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="">



                        <label for="validationCustom02" class="form-label">Intake Capacity</label>
                        <div class="input-group col-md-12">
                            <input type="number" class="form-control" placeholder="%" name="capacity" required>
                            <select class="form-select" name="category" aria-label="Default select example" required>
                                <option selected>--select--</option>
                                <?php
                                $select = "SELECT * FROM `merit_list`";
                                $stmt = $con->prepare($select);
                                $stmt->execute();

                                while ($fetch_merit = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?= $fetch_merit['category'] ?>"><?= $fetch_merit['category'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="generate_list" type="submit">Submit form</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>



        </div>


    </section>





    <?php
    include('includes/footer.php');
    ?>