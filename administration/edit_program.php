<?php
include('../administration/includes/header.php');
include('../administration/includes/sidebar.php');
// Delete a program
if (isset($_POST['delete_prgm'])) {
    $delete = "DELETE FROM `program` WHERE prgm_id = :prgm_id";
    $stmt = $con->prepare($delete);
    $stmt->bindParam(':prgm_id', $_POST['prgm_id']);
    if ($stmt->execute()) {
?>
        <script>
            alert('Program Deleted Successfully');
            history.go(-1);
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something Went Wrong');
            history.go(-1);
        </script>
    <?php
    }
}


// Program Edit
if (isset($_POST['prgm_edit'])) {
    $prgm_id = $_POST['prgm_id'];
    $select = "SELECT * FROM `program` WHERE `prgm_id` = :prgm_id";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':prgm_id', $prgm_id);
    $stmt->execute();
    $fetch_prgm_det = $stmt->fetch(PDO::FETCH_ASSOC);
    $prgm_duer = explode(" ", $fetch_prgm_det['prgm_dure']);
}

// Update
if (isset($_POST['updt_prgm'])) {
    $prgm_id = $_POST['prgm_id'];
    $prgm_name = $_POST['prgm_name'];
    $prgm_duer = $_POST['prgm_duer'];
    $prgm_sem_cost = $_POST['prgm_sem_cost'];
    $prgm_add_fees = $_POST['prgm_add_fees'];
    $duer_peri = $_POST['duer_peri'];
    $tot_duer = $prgm_duer . " " . $duer_peri;

    $update = "UPDATE `program` SET `prgm_name`=:prgm_name,`prgm_dure`=:prgm_duer,`prgm_sem_cost`=:prgm_sem_cost,`prgm_add_fees`=:prgm_add_fess WHERE prgm_id = :prgm_id";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':prgm_id', $prgm_id);
    $stmt->bindParam(':prgm_name', $prgm_name);
    $stmt->bindParam(':prgm_duer', $tot_duer);
    $stmt->bindParam(':prgm_sem_cost', $prgm_sem_cost);
    $stmt->bindParam(':prgm_add_fess', $prgm_add_fees);
    if ($stmt->execute()) {
    ?>
        <script>
            alert('Program Updated Successfully');
            location.href = "manage-program.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong');
            location.href = "manage-program.php";
        </script>
<?php
    }
}

?>





<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Program</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Program</li>
                <li class="breadcrumb-item active">Manage Program</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Program</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="">
                        <div class="col-md-12">
                            <input type="hidden" name="prgm_id" value="<?= $fetch_prgm_det['prgm_id'] ?>">
                            <label for="validationCustom01" class="form-label">Program Name</label>
                            <input type="text" class="form-control" name="prgm_name" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" value="<?= $fetch_prgm_det['prgm_name'] ?>" required>

                        </div>


                        <label for="validationCustom02" class="form-label">Program Dueration</label>
                        <div class="input-group col-md-12">
                            <input type="number" class="form-control" name="prgm_duer" value="<?= $prgm_duer[0] ?>" required>
                            <select class="form-select" name="duer_peri" aria-label="Default select example" required>
                                <option value="<?= $prgm_duer[1] ?>"><?= $prgm_duer[1] ?></option>
                                <option value="Day">Day</option>
                                <option value="Months">Months</option>
                                <option value="Years">Years</option>
                            </select>
                        </div>



                        <div class="">

                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Program Per Semester Course</label>
                            <input type="number" class="form-control" value="<?= $fetch_prgm_det['prgm_sem_cost'] ?>" name="prgm_sem_cost" required>

                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Program Admission Fees</label>
                            <input type="number" value="<?= $fetch_prgm_det['prgm_add_fees'] ?>" class="form-control" name="prgm_add_fees" required>

                        </div>


                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="updt_prgm" type="submit">Submit form</button>
                        </div>
                    </form><!-- End Custom Styled Validation -->

                </div>
            </div>



        </div>


    </section>

</main>


<?php

include('../administration/includes/footer.php');
?>