<?php
include('../administration/includes/header.php');
include('../administration/includes/sidebar.php');
// Delete a Department
if (isset($_POST['delete_dept'])) {
    $delete = "DELETE FROM `dept` WHERE dept_id = :dept_id";
    $stmt = $con->prepare($delete);
    $stmt->bindParam(':dept_id', $_POST['dept_id']);
    if ($stmt->execute()) {
?>
        <script>
            alert('Department Deleted Successfully');
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


// Department Edit
if (isset($_POST['dept_edit'])) {
    $dept_id = $_POST['dept_id'];
    $select = "SELECT * FROM `dept` WHERE `dept_id` = :dept_id";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':dept_id', $dept_id);
    $stmt->execute();
    $fetch_dept_det = $stmt->fetch(PDO::FETCH_ASSOC);
    $dept_duer = explode(" ", $fetch_dept_det['dept_dure']);
}

// Update
if (isset($_POST['updt_dept'])) {
    $dept_id = $_POST['dept_id'];
    $dept_name = $_POST['dept_name'];

    $update = "UPDATE `dept` SET `dept_name`=:dept_name WHERE dept_id = :dept_id";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':dept_id', $dept_id);
    $stmt->bindParam(':dept_name', $dept_name);
    if ($stmt->execute()) {
    ?>
        <script>
            alert('Department Updated Successfully');
            location.href = "manage-dept.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong');
            location.href = "manage-dept.php";
        </script>
<?php
    }
}

?>





<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Department</li>
                <li class="breadcrumb-item active">Manage Department</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Department</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="">
                        <div class="col-md-12">
                            <input type="hidden" name="dept_id" value="<?= $fetch_dept_det['dept_id'] ?>">
                            <label for="validationCustom01" class="form-label">Department Name</label>
                            <input type="text" class="form-control" name="dept_name" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" value="<?= $fetch_dept_det['dept_name'] ?>" required>

                        </div>


                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="updt_dept" type="submit">Submit form</button>
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