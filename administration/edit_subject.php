<?php
include('../administration/includes/header.php');
include('../administration/includes/sidebar.php');
// Delete a Subject
if (isset($_POST['delete_sub'])) {
    $delete = "DELETE FROM `subjects` WHERE sub_id = :sub_id";
    $stmt = $con->prepare($delete);
    $stmt->bindParam(':sub_id', $_POST['sub_id']);
    if ($stmt->execute()) {
?>
        <script>
            alert('Subject Deleted Successfully');
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


// Subject Edit
if (isset($_POST['sub_edit'])) {
    $sub_id = $_POST['sub_id'];
    $select = "SELECT * FROM `subjects` INNER JOIN dept ON dept.dept_id=subjects.dept_id where sub_id = :sub_id";
    $stmt = $con->prepare($select);
    $stmt->bindParam(':sub_id', $sub_id);
    $stmt->execute();
    $fetch_sub_det = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update
if (isset($_POST['updt_sub'])) {
    $sub_id = $_POST['sub_id'];
    $sub_name = $_POST['sub_name'];
$dept_name = $_POST['dept_name'];
    $update = "UPDATE `subjects` SET `sub_name`=:sub_name, `dept_id` = :dept_id WHERE sub_id = :sub_id";
    $stmt = $con->prepare($update);
    $stmt->bindParam(':sub_id', $sub_id);
    $stmt->bindParam(':sub_name', $sub_name);
    $stmt->bindParam(':dept_id', $dept_name);
    if ($stmt->execute()) {
    ?>
        <script>
            alert('Subject Updated Successfully');
            location.href = "manage-subject.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Something went wrong');
            location.href = "manage-subject.php";
        </script>
<?php
    }
}

?>





<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Subject</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $web_socket ?>administration">Home</a></li>
                <li class="breadcrumb-item">Subject</li>
                <li class="breadcrumb-item active">Manage Subject</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">

        <div class="col-lg-6 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add New Subject</h5>

                    <!-- Custom Styled Validation -->
                    <form class="row g-3 needs-validation" method="post" action="">
                        <div class="col-md-12">
                        <input type="hidden" name="sub_id" value="<?= $fetch_sub_det['sub_id'] ?>">
                            <label for="validationCustom01" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" name="sub_name" onkeyup="this.value = this.value.toUpperCase();" onblur="this.value = this.value.toUpperCase();" value="<?=$fetch_sub_det['sub_name']?>" required>

                        </div>
                        <div class="col-md-12">
                            <select class="form-select" name="dept_name" aria-label="Default select example" required>
                                <option value="<?=$fetch_sub_det['dept_id']?>"><?=$fetch_sub_det['dept_name']?></option>
                                <?php
                                $select = "SELECT * FROM `dept` order by dept_name asc";
                                $stmt = $con->prepare($select);
                                $stmt->execute();
                                while ($fetch_dept = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <option value="<?=$fetch_dept['dept_id']?>"><?=$fetch_dept['dept_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>



                        <div class="col-12 mx-auto">
                            <button class="btn btn-primary" name="updt_sub" type="submit">Submit form</button>
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